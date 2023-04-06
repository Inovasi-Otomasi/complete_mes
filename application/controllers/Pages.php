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
