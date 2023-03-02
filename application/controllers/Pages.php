<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
// require 'vendor/autoload.php';



class Pages extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function in_array_any($needles, $haystack)
    {
        return !empty(array_intersect($needles, $haystack));
    }
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('line_model');
        $this->load->model('sku_model');
        $this->load->model('pic_model');
        $this->load->model('remark_model');
        $this->load->model('order_model');
        $this->load->model('inventory_model');
        $this->load->model('FG_model');
        $this->load->model('fetch_model');
        $this->load->model('event_model');
    }
    function login()
    {
        if ($this->session->userdata('username') != '') {
            $this->dashboard();
        } else {
            $data['mainpage'] = 'login';
            $this->load->view("pages/login", $data);
        }
    }
    function login_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            //true  
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            //model function  
            $this->load->model('validation_model');
            $privileges = $this->validation_model->getPrivileges($username);
            if ($this->validation_model->can_login($username, $password)) {
                $session_data = array(
                    'username'     =>     $username,
                    'privileges' => $privileges
                );
                $this->session->set_userdata($session_data);
                redirect(base_url() . 'pages/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid Username and Password');
                redirect(base_url() . 'pages/login');
            }
        } else {
            //false  
            $this->login();
        }
    }
    function change_password_validation()
    {
        if ($this->session->userdata('username') != '') {
            $this->load->model('validation_model');
            $username = $this->session->userdata('username');
            $password = md5($this->input->post('password'));
            $new_password = md5($this->input->post('new_password'));
            $re_new_password = md5($this->input->post('re_new_password'));
            if ($new_password == $re_new_password) {
                if ($this->validation_model->can_login($username, $password)) {
                    $this->validation_model->change_password($username, $password, $new_password);
                    $this->event_model->add_event(array("event" => "Password for " . $username . " has changed."));
                    $this->logout();
                } else {
                    $this->session->set_flashdata('error', 'Invalid Password');
                    redirect(base_url() . 'pages/change_password');
                }
            } else {
                $this->session->set_flashdata('error', 'Must Confirm The Correct Password');
                redirect(base_url() . 'pages/change_password');
            }
        } else {
            redirect(base_url() . 'pages/login');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('username');
        redirect(base_url() . 'pages/login');
    }

    public function dashboard()
    {
        if ($this->session->userdata('username') != '') {
            if ($this->in_array_any(['admin', 'view_dashboard'], $this->session->userdata('privileges'))) {
                $data['mainpage'] = 'dashboard';
                $data['lines'] = $this->line_model->get_line_info();
                $data['sku_list'] = $this->sku_model->get_sku_info();
                $data['remark_list'] = $this->remark_model->get_remark_info();
                $data['order_list'] = $this->order_model->get_order_info();
                $data['privileges'] = $this->session->userdata('privileges');
                // var_dump($data['order_list']);
                $this->load->view('layouts/header', $data);
                $this->load->view('pages/dashboard', $data);
                $this->load->view('layouts/footer');
                if ($this->input->post('line_setup')) {
                    $status_line = $this->line_model->get_line_status($this->input->post('line_id'));
                    if ($status_line == 'STOP') {
                        $single_order = $this->order_model->get_order_by_id($this->input->post('order_id'));
                        // $single_sku = $this->sku_model->get_sku_by_name($single_order->sku_code);
                        $single_remark = $this->remark_model->get_remark_by_detail($this->input->post('setup_detail'));
                        $line_rules = json_decode($single_order->line_rules, true);
                        $line_name = $this->line_model->get_line_by_id($this->input->post('line_id'))->line_name;
                        $ct = array_column($line_rules, null, "line_name")[$line_name]['cycle_time'];
                        $quantity = array_column($line_rules, null, "line_name")[$line_name]['quantity'] * $single_order->quantity;
                        $arr_query = array(
                            'id' => $this->input->post('line_id'),
                            'sku_code' => $single_order->sku_code,
                            'order_id' => $single_order->id,
                            'setup_time' => $single_remark->remark_time,
                            'cycle_time' => $ct ?: 0,
                            'target' => $quantity,
                            'remark' => $single_remark->detail
                        );
                        $result = $this->line_model->edit_line($arr_query);
                        if ($result > 0) {
                            $current_line = $this->line_model->get_line_by_id($arr_query['id']);
                            $this->event_model->add_event(array("event" => "Line " . $current_line->line_name . " has been assigned for order " . $arr_query['order_id'] . "."));
                            $this->session->set_flashdata("success", "Edit Line " . $arr_query['id'] . " Success");
                            redirect(base_url() . 'pages/dashboard');
                        } else {
                            $this->session->set_flashdata("failed", "Edit Line " . $arr_query['id'] . " Failed");
                            redirect(base_url() . 'pages/dashboard');
                        }
                    } else {
                        $this->session->set_flashdata("failed", "Line still operating");
                        redirect(base_url() . 'pages/dashboard');
                    }
                } elseif ($this->input->post('start_operation')) {
                    if ($this->input->post('order_id') != 0 && $this->input->post('prev_status') == 'STOP') {
                        $arr_query = array(
                            'id' => $this->input->post('line_id'),
                            'status' => 'SETUP'
                        );
                        $result = $this->line_model->change_line_status($arr_query);
                        if ($result > 0) {
                            $single_order = $this->order_model->get_order_by_id($this->input->post('order_id'));
                            // $single_sku = $this->sku_model->get_sku_by_name($single_order->sku_code);
                            $line_name = $this->line_model->get_line_by_id($this->input->post('line_id'))->line_name;
                            //update start job
                            $line_rules = json_decode($single_order->line_rules, true);
                            $new_line_rules = array();
                            foreach ($line_rules as $rule) {
                                if ($rule['line_name'] == $line_name) {
                                    $rule['start_job'] = 1;
                                }
                                array_push($new_line_rules, $rule);
                            }
                            $arr_query1 = array(
                                'order_id' => $this->input->post('order_id'),
                                'status' => 'Work In Progress',
                                // 'estimation' => $single_sku->cycle_time * $single_order->quantity,
                                'line_rules' => json_encode($new_line_rules)
                            );
                            $result1 = $this->order_model->change_order_status($arr_query1);
                            if ($result1 > 0) {
                                $current_line = $this->line_model->get_line_by_id($arr_query['id']);
                                $this->event_model->add_event(array("event" => "Line " . $current_line->line_name . "'s job is starting."));
                                $this->session->set_flashdata("success", "Edit Line " . $arr_query['id'] . " Success");
                                redirect(base_url() . 'pages/dashboard');
                            } else {
                                $this->session->set_flashdata("failed", "Edit Order " . $arr_query1['id'] . " Failed");
                                redirect(base_url() . 'pages/dashboard');
                            }
                        } else {
                            $this->session->set_flashdata("failed", "Edit Line " . $arr_query['id'] . " Failed");
                            redirect(base_url() . 'pages/dashboard');
                        }
                    } else {
                        $this->session->set_flashdata("failed", "Check setup");
                        redirect(base_url() . 'pages/dashboard');
                    }
                } elseif ($this->input->post('stop_operation')) {
                    $arr_query = array(
                        'id' => $this->input->post('line_id'),
                        'status' => 'STOP'
                    );
                    $line_status = $this->line_model->get_line_by_id($this->input->post('line_id'))->status;
                    if ($line_status != "STOP") {
                        $result = $this->line_model->change_line_status($arr_query);
                        if ($result > 0) {
                            $single_order = $this->order_model->get_order_by_id($this->input->post('order_id'));
                            $line_name = $this->line_model->get_line_by_id($this->input->post('line_id'))->line_name;

                            $line_rules = json_decode($single_order->line_rules, true);
                            $new_line_rules = array();
                            foreach ($line_rules as $rule) {
                                if ($rule['line_name'] == $line_name) {
                                    $rule['stop_job'] = 1;
                                }
                                array_push($new_line_rules, $rule);
                            }
                            $mapped_rules = array_map(function ($rule) {
                                return $rule['stop_job'];
                            }, $new_line_rules);
                            $progress = number_format(array_count_values($mapped_rules)['1'] * 100 / sizeof($mapped_rules), 2);
                            $arr_query1 = array();
                            if (!in_array(0, $mapped_rules)) {
                                //full completed
                                $arr_query1 = array(
                                    'order_id' => $this->input->post('order_id'),
                                    'status' => 'Completed',
                                    'line_rules' => json_encode($new_line_rules),
                                    'progress' => $progress
                                );
                            } else {
                                $arr_query1 = array(
                                    'order_id' => $this->input->post('order_id'),
                                    'status' => 'Partial Complete',
                                    'line_rules' => json_encode($new_line_rules),
                                    'progress' => $progress
                                );
                            }
                            $result1 = $this->order_model->change_order_status($arr_query1);
                            if ($result1 > 0) {
                                $current_line = $this->line_model->get_line_by_id($arr_query['id']);
                                $this->event_model->add_event(array("event" => "Line " . $current_line->line_name . "'s job stopped."));
                                $this->session->set_flashdata("success", "Edit Line " . $arr_query['id'] . " Success");
                                redirect(base_url() . 'pages/dashboard');
                            } else {
                                $this->session->set_flashdata("failed", "Edit Order " . $arr_query1['id'] . " Failed");
                                redirect(base_url() . 'pages/dashboard');
                            }
                        } else {
                            $this->session->set_flashdata("failed", "Edit Line " . $arr_query['id'] . " Failed");
                            redirect(base_url() . 'pages/dashboard');
                        }
                    } else {
                        $this->session->set_flashdata("failed", "Edit Line " . $arr_query['id'] . " Failed");
                        redirect(base_url() . 'pages/dashboard');
                    }
                } elseif ($this->input->post('standby_operation')) {
                    if ($this->input->post('prev_status') != 'STOP') {
                        $remark_id = $this->input->post('remark_id');
                        $arr_query = array(
                            'id' => $this->input->post('line_id'),
                            'status' => 'STANDBY',
                            'order_id' => $this->input->post('order_id'),
                            'standby_time' => $this->remark_model->get_remark_by_id($remark_id)->remark_time, //time from db,
                            'remark' => $this->remark_model->get_remark_by_id($remark_id)->detail //remark from db
                        );
                        $result = $this->line_model->change_line_status($arr_query);
                        if ($result > 0) {
                            $current_line = $this->line_model->get_line_by_id($arr_query['id']);
                            $this->event_model->add_event(array("event" => "Line " . $current_line->line_name . "'s job on standby."));
                            $this->session->set_flashdata("success", "Edit Line " . $arr_query['id'] . " Success");
                            redirect(base_url() . 'pages/dashboard');
                        } else {
                            $this->session->set_flashdata("failed", "Edit Line " . $arr_query['id'] . " Failed");
                            redirect(base_url() . 'pages/dashboard');
                        }
                    } else {
                        $this->session->set_flashdata("failed", "Line must be running");
                        redirect(base_url() . 'pages/dashboard');
                    }
                } elseif ($this->input->post('reset_operation')) {
                    $arr_query = array(
                        'id' => $this->input->post('line_id'),
                    );
                    $result = $this->line_model->reset_line($arr_query);
                    if ($result > 0) {
                        $this->session->set_flashdata("success", "Edit Line " . $arr_query['id'] . " Success");
                        redirect(base_url() . 'pages/dashboard');
                    } else {
                        $this->session->set_flashdata("failed", "Edit Line " . $arr_query['id'] . " Failed");
                        redirect(base_url() . 'pages/dashboard');
                    }
                } elseif ($this->input->post('stop_all')) {
                    $this->event_model->add_event(array("event" => "All line's job stopped."));
                    $this->session->set_flashdata("success", "All line's job stopped");
                    foreach ($data['lines'] as $line) {
                        $arr_query = array(
                            'id' => $line['id'],
                            'status' => 'STOP'
                        );
                        $result = $this->line_model->change_line_status($arr_query);
                        if ($result > 0) {
                            $single_order = $this->order_model->get_order_by_id($this->input->post('order_id'));
                            $line_name = $this->line_model->get_line_by_id($this->input->post('line_id'))->line_name;
                            $line_rules = json_decode($single_order->line_rules, true);
                            $new_line_rules = array();
                            foreach ($line_rules as $rule) {
                                if ($rule['line_name'] == $line_name) {
                                    $rule['stop_job'] = 1;
                                }
                                array_push($new_line_rules, $rule);
                            }
                            $mapped_rules = array_map(function ($rule) {
                                return $rule['stop_job'];
                            }, $new_line_rules);
                            $progress = number_format(array_count_values($mapped_rules)['1'] * 100 / sizeof($mapped_rules), 2);
                            $arr_query1 = array();
                            if (!in_array(0, $mapped_rules)) {
                                //full completed
                                $arr_query1 = array(
                                    'order_id' => $this->input->post('order_id'),
                                    'status' => 'Completed',
                                    'line_rules' => json_encode($new_line_rules),
                                    'progress' => $progress
                                );
                            } else {
                                $arr_query1 = array(
                                    'order_id' => $this->input->post('order_id'),
                                    'status' => 'Partial Complete',
                                    'line_rules' => json_encode($new_line_rules),
                                    'progress' => $progress
                                );
                            }
                            $result1 = $this->order_model->change_order_status($arr_query1);
                        }
                    }
                    // $this->session->set_flashdata("success", "All line stopped");
                    redirect(base_url() . 'pages/dashboard');
                } else if ($this->input->post('ng_edit')) {
                    $arr_query = array(
                        'id' => $this->input->post('line_id'),
                        'NG_count' => $this->input->post('ng_count')
                    );
                    $result = $this->line_model->edit_ng($arr_query);
                    if ($result > 0) {
                        $current_line = $this->line_model->get_line_by_id($arr_query['id']);
                        $this->event_model->add_event(array("event" => "NG count for line " . $current_line->line_name . " has been changed. [" . $arr_query['NG_count'] . "]"));
                        $this->session->set_flashdata("success", "Edit Line " . $arr_query['id'] . " Success");
                        redirect(base_url() . 'pages/dashboard');
                    } else {
                        $this->session->set_flashdata("failed", "Edit Line " . $arr_query['id'] . " Failed");
                        redirect(base_url() . 'pages/dashboard');
                    }
                }
            } else {
                $this->session->set_flashdata("failed", "Need Privilage");
                redirect(base_url() . 'pages/logout'); //need to change to dashboard
            }
        } else {
            redirect(base_url() . 'pages/login');
        }
    }
    public function order()
    {
        if ($this->session->userdata('username') != '') {
            if ($this->in_array_any(['admin', 'view_order'], $this->session->userdata('privileges'))) {
                $data['sku_code'] = $this->sku_model->get_sku_info();
                $data['mainpage'] = 'order';
                $data['privileges'] = $this->session->userdata('privileges');
                $this->load->view('layouts/header', $data);
                $this->load->view('pages/order', $data);
                $this->load->view('layouts/footer');
            } else {
                $this->session->set_flashdata("failed", "Need Privilage");
                redirect(base_url() . 'pages/dashboard'); //need to change to dashboard
            }
        } else {
            redirect(base_url() . 'pages/login');
        }
    }
    public function oee_management()
    {
        if ($this->session->userdata('username') != '') {
            if ($this->in_array_any(['admin', 'view_oee_management'], $this->session->userdata('privileges'))) {
                $data['lines'] = $this->line_model->get_line_info();
                $data['sku_code'] = $this->sku_model->get_sku_info();
                $data['inventory_info'] = $this->inventory_model->get_inventory_info();
                $data['mainpage'] = 'oee_management';
                $data['privileges'] = $this->session->userdata('privileges');
                $this->load->view('layouts/header', $data);
                $this->load->view('pages/oee_management', $data);
                $this->load->view('layouts/footer');
            } else {
                $this->session->set_flashdata("failed", "Need Privilage");
                redirect(base_url() . 'pages/dashboard'); //need to change to dashboard
            }
        } else {
            redirect(base_url() . 'pages/login');
        }
    }
    public function warehouse_management()
    {
        if ($this->session->userdata('username') != '') {
            if ($this->in_array_any(['admin', 'view_warehouse_management'], $this->session->userdata('privileges'))) {
                $data['mainpage'] = 'warehouse_management';
                $data['privileges'] = $this->session->userdata('privileges');
                $this->load->view('layouts/header', $data);
                $this->load->view('pages/storage_management', $data);
                $this->load->view('layouts/footer');
            } else {
                $this->session->set_flashdata("failed", "Need Privilage");
                redirect(base_url() . 'pages/dashboard'); //need to change to dashboard
            }
        } else {
            redirect(base_url() . 'pages/login');
        }
    }
    public function product_cycle_tracking()
    {
        if ($this->session->userdata('username') != '') {
            if ($this->in_array_any(['admin', 'view_pct'], $this->session->userdata('privileges'))) {
                $data['sku_code'] = $this->sku_model->get_sku_info();
                $data['mainpage'] = 'product_cycle_tracking';
                $data['privileges'] = $this->session->userdata('privileges');
                $data['order_list'] = $this->order_model->get_order_info_for_pct();
                $data['tracker_list'] = $this->fetch_model->request_tracker();
                $this->load->view('layouts/header', $data);
                $this->load->view('pages/product_cycle_tracking', $data);
                $this->load->view('layouts/footer');
            } else {
                $this->session->set_flashdata("failed", "Need Privilage");
                redirect(base_url() . 'pages/dashboard'); //need to change to dashboard
            }
        } else {
            redirect(base_url() . 'pages/login');
        }
    }
    public function event_log()
    {
        if ($this->session->userdata('username') != '') {
            if ($this->in_array_any(['admin', 'view_event_log'], $this->session->userdata('privileges'))) {
                $data['mainpage'] = 'event_log';
                $data['privileges'] = $this->session->userdata('privileges');
                $this->load->view('layouts/header', $data);
                $this->load->view('pages/event_log', $data);
                $this->load->view('layouts/footer');
            } else {
                $this->session->set_flashdata("failed", "Need Privilage");
                redirect(base_url() . 'pages/dashboard'); //need to change to dashboard
            }
        } else {
            redirect(base_url() . 'pages/login');
        }
    }
    public function breakdown_log()
    {
        if ($this->session->userdata('username') != '') {
            if ($this->in_array_any(['admin', 'view_breakdown_log'], $this->session->userdata('privileges'))) {
                $data['pic_list'] = $this->pic_model->get_pic_info();
                $data['remark_list'] = $this->remark_model->get_remark_info();
                $data['mainpage'] = 'breakdown_log';
                $data['privileges'] = $this->session->userdata('privileges');
                $this->load->view('layouts/header', $data);
                $this->load->view('pages/breakdown_log', $data);
                $this->load->view('layouts/footer');
            } else {
                $this->session->set_flashdata("failed", "Need Privilage");
                redirect(base_url() . 'pages/dashboard'); //need to change to dashboard
            }
        } else {
            redirect(base_url() . 'pages/login');
        }
    }
    public function reporting()
    {
        if ($this->session->userdata('username') != '') {
            if ($this->in_array_any(['admin', 'view_reporting'], $this->session->userdata('privileges'))) {
                $data['lines'] = $this->line_model->get_line_info();
                $data['mainpage'] = 'reporting';
                $data['privileges'] = $this->session->userdata('privileges');
                $this->load->view('layouts/header', $data);
                $this->load->view('pages/reporting', $data);
                $this->load->view('layouts/footer');
            } else {
                $this->session->set_flashdata("failed", "Need Privilage");
                redirect(base_url() . 'pages/dashboard'); //need to change to dashboard
            }
        } else {
            redirect(base_url() . 'pages/login');
        }
    }
    public function admin_panel()
    {
        if ($this->session->userdata('username') != '') {
            if ($this->in_array_any(['admin'], $this->session->userdata('privileges'))) {
                $data['mainpage'] = 'admin_panel';
                $data['privileges'] = $this->session->userdata('privileges');
                $data['lines'] = $this->line_model->get_line_info();
                $this->load->view('layouts/header', $data);
                $this->load->view('pages/admin_panel', $data);
                $this->load->view('layouts/footer');
            } else {
                $this->session->set_flashdata("failed", "Need Privilage");
                redirect(base_url() . 'pages/dashboard'); //need to change to dashboard
            }
        } else {
            redirect(base_url() . 'pages/login');
        }
    }
}
