<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operation extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('line_model');
		$this->load->model('sku_model');
		$this->load->model('log_model');
		$this->load->model('pic_model');
		$this->load->model('remark_model');
		$this->load->model('export_model');
		$this->load->model('order_model');
		$this->load->model('inventory_model');
		$this->load->model('FG_model');
		$this->load->model('tracking_model');
		$this->load->model('fetch_model');
		$this->load->model('event_model');
		$this->load->model('account_model');
	}

	function in_array_any($needles, $haystack)
	{
		return !empty(array_intersect($needles, $haystack));
	}

	public function setup_line()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'view_dashboard'], $this->session->userdata('privileges'))) {
				$status_line = $this->line_model->get_line_status($this->input->post('line_id'));
				if ($status_line == 'STOP') {
					$single_order = $this->order_model->get_order_by_id($this->input->post('order_id'));
					// $single_sku = $this->sku_model->get_sku_by_name($single_order->sku_code);
					$single_remark = $this->remark_model->get_remark_by_detail($this->input->post('setup_detail'));
					$small_stop_remark = $this->remark_model->get_remark_by_detail($this->input->post('small_stop_detail'));
					$line_rules = json_decode($single_order->line_rules, true);
					$line_name = $this->line_model->get_line_by_id($this->input->post('line_id'))->line_name;
					$ct = array_column($line_rules, null, "line_name")[$line_name]['cycle_time'];
					$quantity = array_column($line_rules, null, "line_name")[$line_name]['quantity'] * $single_order->quantity;
					$arr_query = array(
						'id' => $this->input->post('line_id'),
						'sku_code' => $single_order->sku_code,
						'order_id' => $single_order->id,
						'batch_id' => $single_order->batch_id,
						'lot_number' => $single_order->lot_number,
						'setup_time' => $single_remark ? $single_remark->remark_time : 0,
						'cycle_time' => $ct ?: 0,
						'target' => $quantity,
						'remark' => $single_remark ? $single_remark->detail : 'None',
						'small_stop_time' => $small_stop_remark ? $small_stop_remark->remark_time : 0,
						'small_stop_detail' => $small_stop_remark ? $small_stop_remark->detail : 'None',
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
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/order'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}

	public function start_operation()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'view_dashboard'], $this->session->userdata('privileges'))) {
				if ($this->input->post('order_id') != 0 && $this->input->post('prev_status') == 'STOP') {
					$arr_query = array(
						'id' => $this->input->post('line_id'),
						'status' => 'SETUP'
					);
					$result = $this->line_model->change_line_status($arr_query);
					if ($result > 0) {
						$single_order = $this->order_model->get_order_by_id($this->input->post('order_id'));
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
			}
		}
	}
	public function stop_operation()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'view_dashboard'], $this->session->userdata('privileges'))) {
				$arr_query = array(
					'id' => $this->input->post('line_id'),
					'status' => 'STOP'
				);
				$line_status = $this->line_model->get_line_by_id($this->input->post('line_id'))->status;
				if ($line_status != "STOP") {
					$current_line = $this->line_model->get_line_by_id($this->input->post('line_id'));
					$line_counter = $current_line->item_counter;
					$line_performance = $current_line->performance;
					$line_availability = $current_line->availability;
					$line_quality = $current_line->quality;
					$single_order = $this->order_model->get_order_by_id($this->input->post('order_id'));
					$line_name = $this->line_model->get_line_by_id($this->input->post('line_id'))->line_name;
					$line_rules = json_decode($single_order ? $single_order->line_rules : (object)array(), true) ?: array();
					$result = $this->line_model->change_line_status($arr_query);
					if ($result > 0) {

						$new_line_rules = array();
						foreach ($line_rules as $rule) {
							if ($rule['line_name'] == $line_name) {
								$rule['stop_job'] = 1;
								$rule['counter'] = $line_counter;
								$rule['performance'] = $line_performance;
								$rule['availability'] = $line_availability;
								$rule['quality'] = $line_quality;
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
			}
		}
	}
	public function standby_operation()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'view_dashboard'], $this->session->userdata('privileges'))) {
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
			}
		}
	}
	public function breakdown_operation()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'view_dashboard'], $this->session->userdata('privileges'))) {
				if ($this->input->post('prev_status') != 'STOP' && $this->input->post('prev_status') != 'DOWN TIME') {
					$arr_query = array(
						'id' => $this->input->post('line_id'),
						'status' => 'DOWN TIME',
						'order_id' => $this->input->post('order_id'),
						'cycle_time' => $this->line_model->get_line_by_id($this->input->post('line_id'))->cycle_time, //time from db,
					);
					$result = $this->line_model->change_line_status($arr_query);
					if ($result > 0) {
						$current_line = $this->line_model->get_line_by_id($arr_query['id']);
						$this->event_model->add_event(array("event" => "Line " . $current_line->line_name . "'s job on breakdown."));
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
			}
		}
	}
	public function start_all()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'view_dashboard'], $this->session->userdata('privileges'))) {
				$this->event_model->add_event(array("event" => "All line's job started."));
				$this->session->set_flashdata("success", "All line's job started");
				$data['lines'] = $this->line_model->get_line_info();
				foreach ($data['lines'] as $line) {
					if ($line['order_id'] != 0 && $line['status'] == 'STOP') {
						$arr_query = array(
							'id' => $line['id'],
							'status' => 'SETUP'
						);
						$result = $this->line_model->change_line_status($arr_query);
						if ($result > 0) {
							$single_order = $this->order_model->get_order_by_id($line['order_id']);
							// $single_sku = $this->sku_model->get_sku_by_name($single_order->sku_code);
							$line_name = $this->line_model->get_line_by_id($line['id'])->line_name;
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
								'order_id' => $line['order_id'],
								'status' => 'Work In Progress',
								// 'estimation' => $single_sku->cycle_time * $single_order->quantity,
								'line_rules' => json_encode($new_line_rules)
							);
							$result1 = $this->order_model->change_order_status($arr_query1);
						}
					}
				}
				redirect(base_url() . 'pages/dashboard');
			}
		}
	}
	public function stop_all()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'view_dashboard'], $this->session->userdata('privileges'))) {
				$this->event_model->add_event(array("event" => "All line's job stopped."));
				$this->session->set_flashdata("success", "All line's job stopped");
				$data['lines'] = $this->line_model->get_line_info();
				foreach ($data['lines'] as $line) {
					$arr_query = array(
						'id' => $line['id'],
						'status' => 'STOP'
					);
					$current_line = $this->line_model->get_line_by_id($line['id']);
					$line_counter = $current_line->item_counter;
					$line_performance = $current_line->performance;
					$line_availability = $current_line->availability;
					$line_quality = $current_line->quality;
					$single_order = $this->order_model->get_order_by_id($line['order_id']);
					$line_name = $this->line_model->get_line_by_id($line['id'])->line_name;
					$line_rules = json_decode($single_order ? $single_order->line_rules : (object)array(), true) ?: array();
					// $line_rules = json_decode($this->order_model->get_order_by_id($line['order_id'])->line_rules ?: (object)array(), true) ?: array();
					$result = $this->line_model->change_line_status($arr_query);
					if ($result > 0) {
						$new_line_rules = array();
						foreach ($line_rules as $rule) {
							if ($rule['line_name'] == $line_name) {
								$rule['stop_job'] = 1;
								$rule['counter'] = $line_counter;
								$rule['performance'] = $line_performance;
								$rule['availability'] = $line_availability;
								$rule['quality'] = $line_quality;
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
								'order_id' => $line['order_id'],
								'status' => 'Completed',
								'line_rules' => json_encode($new_line_rules),
								'progress' => $progress
							);
						} else {
							$arr_query1 = array(
								'order_id' => $line['order_id'],
								'status' => 'Partial Complete',
								'line_rules' => json_encode($new_line_rules),
								'progress' => $progress
							);
						}
						$result1 = $this->order_model->change_order_status($arr_query1);
					}
				}
				redirect(base_url() . 'pages/dashboard');
			}
		}
	}
	public function ng_edit()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'view_dashboard'], $this->session->userdata('privileges'))) {
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
		}
	}

	public function additional_operation()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'view_dashboard'], $this->session->userdata('privileges'))) {
				$arr_query = array(
					'id' => $this->input->post('line_id'),
					'additional' => $this->input->post('additional')
				);
				$result = $this->line_model->edit_additional($arr_query);
				if ($result > 0) {
					$current_line = $this->line_model->get_line_by_id($arr_query['id']);
					$this->event_model->add_event(array("event" => "Additional count for line " . $current_line->line_name . " has been changed. [" . $arr_query['additional'] . "]"));
					$this->session->set_flashdata("success", "Edit Line " . $arr_query['id'] . " Success");
					redirect(base_url() . 'pages/dashboard');
				} else {
					$this->session->set_flashdata("failed", "Edit Line " . $arr_query['id'] . " Failed");
					redirect(base_url() . 'pages/dashboard');
				}
			}
		}
	}
}
