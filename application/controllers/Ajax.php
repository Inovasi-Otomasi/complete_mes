<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
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

	public function get_line_info()
	{
		if ($this->session->userdata('username') != '') {
			$list = $this->line_model->get_line_info();
			echo json_encode($list);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function get_avg_info()
	{
		if ($this->session->userdata('username') != '') {
			$list = array(
				'avg_oee' => $this->line_model->get_avg_oee(),
				'avg_performance' => $this->line_model->get_avg_performance(),
				'avg_availability' => $this->line_model->get_avg_availability(),
				'avg_quality' => $this->line_model->get_avg_quality()
			);
			echo json_encode($list);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function order_list()
	{
		if ($this->session->userdata('username') != '') {
			$lists = $this->order_model->get_datatables();
			$data = array();
			foreach ($lists as $list) {
				$line_names = '<ul>';
				foreach (json_decode($list->line_rules, true) as $line) {
					$color = '';
					if ($line["start_job"] && $line["stop_job"]) {
						$color = 'text-success';
					} elseif ($line["start_job"] && !$line["stop_job"]) {
						$color = 'text-warning';
					}
					$line_names .= '<li>' . $line["line_name"] . '&nbsp;<i class="fas fa-circle ' . $color . '"></i><br/>P:' . (isset($line["performance"]) ? $line["performance"] : 0) . ', A:' . (isset($line["availability"]) ? $line["availability"] : 0) . ', Q:' . (isset($line["quality"]) ? $line["quality"] : 0) . ', C:' . (isset($line["counter"]) ? $line["counter"] : 0) . '</li><hr/>';
				}
				$line_names .= '</ul>';
				$row = array();
				$row[] = $list->id;
				$row[] = $list->batch_id;
				$row[] = $list->lot_number;
				$row[] = $line_names;
				$row[] = $list->sku_code;
				$row[] = $list->quantity;
				// $row[] = $list->item_counter;
				// $row[] = $list->NG_count;
				$row[] = $list->created_at;
				$row[] = $list->started_at;
				// $row[] = $list->estimation;
				$row[] = $list->finished_at;
				$row[] = $list->storage ? 'Yes' : 'No';
				$row[] = $list->status;
				if ($list->progress >= 100) {
					$row[] = '<div>' . $list->progress . '%</div><div class="progress"><div class="progress-bar bg-gradient-success" role="progressbar" style="width:' . $list->progress . '%;"></div></div>';
				} else {
					$row[] = '<div>' . $list->progress . '%</div><div class="progress"><div class="progress-bar bg-gradient-warning" role="progressbar" style="width:' . $list->progress . '%;"></div></div>';
				}

				$row[] =  $this->load->view('jquery/modal_delete_order', $list, TRUE);
				// $row[] =  $this->load->view('jquery/modal_sku', $list, TRUE);
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->order_model->count_all(),
				"recordsFiltered" => $this->order_model->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function add_order()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'add_order'], $this->session->userdata('privileges'))) {
				$single_sku = $this->sku_model->get_sku_by_name($this->input->post("sku_code"));
				$data = array(
					"sku_code" => $this->input->post("sku_code"),
					"line_rules" => $single_sku->line_rules,
					"batch_id" => $this->input->post("batch_id"),
					"lot_number" => $this->input->post("lot_number"),
					"quantity" => $this->input->post("quantity"),
					"storage" => $this->input->post("storage")
				);
				$result = $this->order_model->add_order($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "New order has been created. [" . $data['sku_code'] . ": " . $data['quantity'] . " pcs]"));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/order');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/order');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/order'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function delete_order()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'delete_order'], $this->session->userdata('privileges'))) {
				$id = $_GET['id'];
				$singel_order = $this->order_model->get_order_by_id($id);
				if ($singel_order->status != 'Work In Progress') {
					$result = $this->order_model->delete_order($id);
					if ($result > 0) {
						$this->event_model->add_event(array("event" => "Order ID " . $id . " has been deleted. [" . $singel_order->sku_code . ": " . $singel_order->quantity . " pcs]"));
						$this->session->set_flashdata("success", "Order ID " . $id . " Succesfully Deleted");
						redirect(base_url() . 'pages/order');
					} else {
						$this->session->set_flashdata("failed", "Delete Failed");
						redirect(base_url() . 'pages/order');
					}
				} else {
					$this->session->set_flashdata("failed", "Delete Failed, Work in progress");
					redirect(base_url() . 'pages/order');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/order'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function sku_list()
	{
		if ($this->session->userdata('username') != '') {
			$lists = $this->sku_model->get_datatables();
			$data = array();
			foreach ($lists as $list) {
				$list->lines = $this->line_model->get_line_info();
				$list->inv = $this->inventory_model->get_inventory_info();
				$list->self_inv = json_decode($list->material, true);
				$list->self_lines = json_decode($list->line_rules, true);
				$material_list = '<ul>';
				foreach (json_decode($list->material, true) as $inv) {
					// if ($this->inventory_model->get_inventory_by_id($list['inventory_id'])) {
					$material_list .= '<li>' . $inv["inventory_code"] . ' (' . $inv["quantity"] . ' pcs)</li>';
					// }
				}
				$material_list .= '</ul>';
				$line_names = '<ul>';
				foreach (json_decode($list->line_rules, true) as $line) {
					// if ($this->inventory_model->get_inventory_by_id($list['inventory_id'])) {
					$line_names .= '<li>' . $line["line_name"] . ' (' . $line["cycle_time"] . ' s, ' . $line["quantity"] . ' pcs)</li>';
					// }
				}
				$line_names .= '</ul>';

				$row = array();
				$row[] = $list->id;
				$row[] = $list->sku_code;
				$row[] =  $line_names;
				// $row[] = $list->line_name;

				// $row[] = $list->setup_time;
				// $row[] = $list->cycle_time;
				$row[] = $material_list;
				if ($list->sku_code != 'None') {
					$row[] =  $this->load->view('jquery/modal_sku', $list, TRUE);
					$row[] =  $this->load->view('jquery/modal_delete_sku', $list, TRUE);
				} else {
					$row[] = '';
					$row[] = '';
				}
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->sku_model->count_all(),
				"recordsFiltered" => $this->sku_model->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function add_sku()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'add_sku'], $this->session->userdata('privileges'))) {
				$required_inv = $this->input->post('inv') ?: array();
				$requirements = array();
				foreach ($required_inv as $inv) {
					$ching = array(
						'inventory_code' => $this->inventory_model->get_inventory_by_id($inv)->inventory_code,
						'quantity' => intval($this->input->post('quantity_' . $inv))
					);
					array_push($requirements, $ching);
				}
				$line_ids = $this->input->post("line_id");
				$line_rules = array();
				foreach ($line_ids as $id) {
					$chong = array(
						'line_name' => $this->line_model->get_line_by_id($id)->line_name,
						'cycle_time' => floatval($this->input->post("cycle_time_" . $id)),
						'quantity' => floatval($this->input->post("quantity_sku_" . $id)),
						'start_job' => 0,
						'stop_job' => 0,
						'performance' => 0,
						'availability' => 0,
						'quality' => 0,
						'counter' => 0
					);
					array_push($line_rules, $chong);
				}
				$data = array(
					// "line_name" => json_encode($line_names),
					"sku_code" => $this->input->post("sku_code"),
					// "setup_time" => $this->input->post("setup_time"),
					// "cycle_time" =>  json_encode($cycle_times),
					"line_rules" => json_encode($line_rules),
					"material" => json_encode($requirements)
				);
				// var_dump($data);
				$result = $this->sku_model->add_sku($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "New SKU has been created. [" . $data['sku_code'] . "]"));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/oee_management');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/oee_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/oee_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function edit_sku()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'edit_sku'], $this->session->userdata('privileges'))) {
				$required_inv = $this->input->post('inv') ?: array();
				$requirements = array();
				foreach ($required_inv as $inv) {
					$ching = array(
						'inventory_code' => $this->inventory_model->get_inventory_by_id($inv)->inventory_code,
						'quantity' => intval($this->input->post('quantity_' . $inv))
					);
					array_push($requirements, $ching);
				}
				$line_ids = $this->input->post("line_id");
				$line_rules = array();
				foreach ($line_ids as $id) {
					$chong = array(
						'line_name' => $this->line_model->get_line_by_id($id)->line_name,
						'cycle_time' => floatval($this->input->post("cycle_time_" . $id)),
						'quantity' => floatval($this->input->post("quantity_sku_" . $id)),
						'start_job' => 0,
						'stop_job' => 0,
						'performance' => 0,
						'availability' => 0,
						'quality' => 0,
						'counter' => 0
					);
					array_push($line_rules, $chong);
				}

				$data = array(
					"id" => $this->input->post("id"),
					// "line_name" => $this->input->post("line_name"),
					"sku_code" => $this->input->post("sku_code"),
					"line_rules" => json_encode($line_rules),
					"material" => json_encode($requirements)
				);
				$result = $this->sku_model->edit_sku($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "SKU ID " . $data['id'] . " has been changed."));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/oee_management');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/oee_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/oee_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function delete_sku()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'delete_sku'], $this->session->userdata('privileges'))) {
				$id = $_GET['id'];
				$single_sku = $this->sku_model->get_sku_by_id($id);
				$result = $this->sku_model->delete_sku($id);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "SKU ID " . $id . " has been deleted. [" . $single_sku->sku_code . "]"));
					$this->session->set_flashdata("success", "SKU ID " . $id . " Succesfully Deleted");
					redirect(base_url() . 'pages/oee_management');
				} else {
					$this->session->set_flashdata("failed", "Delete Failed");
					redirect(base_url() . 'pages/oee_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/oee_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function log_list()
	{
		if ($this->session->userdata('username') != '') {
			$lists = $this->log_model->get_datatables();
			// $lists->pic_list = $this->pic_model->get_pic_info();
			// $lists->remark_list = $this->remark_model->get_remark_info();
			$data = array();
			foreach ($lists as $list) {
				$list->pic_list = $this->pic_model->get_pic_info();
				$list->remark_list = $this->remark_model->get_remark_info();
				$row = array();
				$row[] = $list->id;
				$row[] = $list->timestamp;
				$row[] = $list->batch_id;
				$row[] = $list->lot_number;
				$row[] = $list->line_name;
				$row[] = $list->sku_code;
				$row[] = $list->item_counter;
				$row[] = $list->NG_count;
				$row[] = $list->status;
				$row[] = $list->delta_down_time;
				$row[] = $list->pic_name;
				$row[] = $list->remark;
				$row[] = $list->detail;
				$row[] = $list->pic_name_2;
				$row[] = $list->remark_2;
				$row[] = $list->detail_2;
				$row[] = $list->location;
				// $row[] = $list->performance;
				// $row[] = $list->availability;
				// $row[] = $list->quality;
				$row[] =  $this->load->view('jquery/modal_log', $list, TRUE);
				// $row[] = '<a class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" href="' . base_url('ajax/delete_sku?id=') . $list->id . '"><i class="fas fa-trash-alt"></i></a>';
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->log_model->count_all(),
				"recordsFiltered" => $this->log_model->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function edit_log()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'edit_breakdown_log'], $this->session->userdata('privileges'))) {
				$data = array(
					"id" => $this->input->post("id"),
					"pic_name" => $this->input->post("pic_name"),
					"remark" => $this->input->post("remark"),
					"detail" => $this->input->post("detail"),
					"pic_name_2" => $this->input->post("pic_name_2"),
					"remark_2" => $this->input->post("remark_2"),
					"detail_2" => $this->input->post("detail_2"),
				);
				$result = $this->log_model->edit_log($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "Down Time log ID " . $data['id'] . " has been changed."));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/breakdown_log');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/breakdown_log');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/breakdown_log'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function pic_list()
	{
		if ($this->session->userdata('username') != '') {
			$lists = $this->pic_model->get_datatables();
			$data = array();
			foreach ($lists as $list) {
				$row = array();
				$row[] = $list->id;
				$row[] = $list->pic_name;
				$row[] = $list->employee_id;
				$row[] = $list->contact;
				$row[] =  $this->load->view('jquery/modal_pic', $list, TRUE);
				$row[] =  $this->load->view('jquery/modal_delete_pic', $list, TRUE);
				// $row[] = '<a class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" href="' . base_url('ajax/delete_pic?id=') . $list->id . '"><i class="fas fa-trash-alt"></i></a>';
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->pic_model->count_all(),
				"recordsFiltered" => $this->pic_model->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function add_pic()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'add_pic'], $this->session->userdata('privileges'))) {
				$data = array(
					"pic_name" => $this->input->post("pic_name"),
					"employee_id" => $this->input->post("employee_id"),
					"contact" => $this->input->post("contact")
				);
				$result = $this->pic_model->add_pic($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "New PIC has been created. [" . $data['pic_name'] . "]"));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/oee_management');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/oee_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/oee_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function edit_pic()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'edit_pic'], $this->session->userdata('privileges'))) {
				$data = array(
					"id" => $this->input->post("id"),
					"pic_name" => $this->input->post("pic_name"),
					"employee_id" => $this->input->post("employee_id"),
					"contact" => $this->input->post("contact")
				);
				$result = $this->pic_model->edit_pic($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "PIC ID " . $data['id'] . " has been changed."));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/oee_management');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/oee_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/oee_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function delete_pic()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'delete_pic'], $this->session->userdata('privileges'))) {
				$id = $_GET['id'];
				$result = $this->pic_model->delete_pic($id);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "PIC ID " . $id . " has been deleted."));
					$this->session->set_flashdata("success", "PIC ID " . $id . " Succesfully Deleted");
					redirect(base_url() . 'pages/oee_management');
				} else {
					$this->session->set_flashdata("failed", "Delete Failed");
					redirect(base_url() . 'pages/oee_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/oee_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function remark_list()
	{
		if ($this->session->userdata('username') != '') {
			$lists = $this->remark_model->get_datatables();
			$data = array();
			foreach ($lists as $list) {
				$row = array();
				$row[] = $list->id;
				$row[] = $list->status;
				$row[] = $list->detail;
				$row[] = $list->remark_time;
				$row[] =  $this->load->view('jquery/modal_remark', $list, TRUE);
				$row[] =  $this->load->view('jquery/modal_delete_remark', $list, TRUE);
				// $row[] = '<a class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" href="' . base_url('ajax/delete_remark?id=') . $list->id . '"><i class="fas fa-trash-alt"></i></a>';
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->remark_model->count_all(),
				"recordsFiltered" => $this->remark_model->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function add_remark()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'add_remark'], $this->session->userdata('privileges'))) {
				$data = array(
					"status" => $this->input->post("status"),
					"detail" => $this->input->post("remark"),
					"remark_time" => $this->input->post("remark_time")
				);
				$result = $this->remark_model->add_remark($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "New remark has been created. [" . $data['status'] . ": " . $data['detail'] . "]"));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/oee_management');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/oee_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/oee_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function edit_remark()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'edit_remark'], $this->session->userdata('privileges'))) {
				$data = array(
					"id" => $this->input->post("id"),
					"status" => $this->input->post("status"),
					"detail" => $this->input->post("remark"),
					"remark_time" => $this->input->post("remark_time")
				);
				$result = $this->remark_model->edit_remark($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "Remark ID " . $data['id'] . " has been changed."));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/oee_management');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/oee_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/oee_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function delete_remark()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'delete_remark'], $this->session->userdata('privileges'))) {
				$id = $_GET['id'];
				$result = $this->remark_model->delete_remark($id);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "Remark ID " . $id . " has been deleted."));
					$this->session->set_flashdata("success", "Remark ID " . $id . " Succesfully Deleted");
					redirect(base_url() . 'pages/oee_management');
				} else {
					$this->session->set_flashdata("failed", "Delete Failed");
					redirect(base_url() . 'pages/oee_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/oee_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function inventory_list()
	{
		if ($this->session->userdata('username') != '') {
			$lists = $this->inventory_model->get_datatables();
			$data = array();
			foreach ($lists as $list) {
				$row = array();
				$row[] = $list->id;
				$row[] = $list->inventory_name;
				$row[] = $list->inventory_code;
				$row[] = $list->quantity;
				$row[] = $list->updated_at;
				$row[] =  $this->load->view('jquery/modal_inventory', $list, TRUE);
				$row[] =  $this->load->view('jquery/modal_delete_inventory', $list, TRUE);
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->inventory_model->count_all(),
				"recordsFiltered" => $this->inventory_model->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function add_inventory()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'add_inventory'], $this->session->userdata('privileges'))) {
				$data = array(
					"inventory_name" => $this->input->post("inventory_name"),
					"inventory_code" => $this->input->post("inventory_code"),
					"quantity" => $this->input->post("quantity")
				);
				$result = $this->inventory_model->add_inventory($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "New inventory has been added. [" . $data['inventory_code'] . ": " . $data['quantity'] . " pcs]"));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/warehouse_management');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/warehouse_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/warehouse_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function edit_inventory()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'edit_inventory'], $this->session->userdata('privileges'))) {
				$data = array(
					"id" => $this->input->post("id"),
					"inventory_name" => $this->input->post("inventory_name"),
					"inventory_code" => $this->input->post("inventory_code"),
					"quantity" => $this->input->post("quantity")
				);
				$result = $this->inventory_model->edit_inventory($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "Inventory ID " . $data['id'] . " has been changed."));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/warehouse_management');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/warehouse_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/warehouse_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function delete_inventory()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'delete_inventory'], $this->session->userdata('privileges'))) {
				$id = $_GET['id'];
				$result = $this->inventory_model->delete_inventory($id);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "Inventory ID " . $id . " has been deleted."));
					$this->session->set_flashdata("success", "Inventory ID " . $id . " Succesfully Deleted");
					redirect(base_url() . 'pages/warehouse_management');
				} else {
					$this->session->set_flashdata("failed", "Delete Failed");
					redirect(base_url() . 'pages/warehouse_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/warehouse_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}

	public function finished_goods_list()
	{
		if ($this->session->userdata('username') != '') {
			$lists = $this->FG_model->get_datatables();
			$data = array();
			foreach ($lists as $list) {
				$row = array();
				$row[] = $list->id;
				$row[] = $list->sku_code;
				$row[] = $list->quantity;
				$row[] = $list->quantity_updated_at;
				$row[] =  $this->load->view('jquery/modal_FG', $list, TRUE);
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->FG_model->count_all(),
				"recordsFiltered" => $this->FG_model->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}

	public function edit_FG()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'edit_FG'], $this->session->userdata('privileges'))) {
				$data = array(
					"id" => $this->input->post("id"),
					"quantity" => $this->input->post("quantity"),
				);
				$result = $this->FG_model->edit_FG($data);
				if ($result > 0) {
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/warehouse_management');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/warehouse_management');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/warehouse_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function tracking_list()
	{
		if ($this->session->userdata('username') != '') {
			$lists = $this->tracking_model->get_datatables();
			$external_link = $this->fetch_model->get_link();
			$data = array();
			foreach ($lists as $list) {
				$items = json_decode($list->items);
				$items_show = "";
				// var_dump($post_data['items']->order_id);
				if ($items->order_id) {
					$items_show .= "Order ID: <br/>";
					foreach ($items->order_id as $order) {
						$items_show .= "- " . $order . "<br/>";
					}
				}
				if ($items->sku) {
					$items_show .= "SKU: <br/>";
					foreach ($items->sku as $sku) {
						$items_show .= "- " . $sku->sku_code . " (" . $sku->quantity . ")<br/>";
					}
				}

				//update db status
				$fetch_res = "";
				$row = array();
				$row[] = $list->id;
				$row[] = $list->tracking_number;
				$row[] = $items_show;
				// $row[] = $list->quantity;
				$row[] = $list->customer;
				$row[] = $list->address;
				$fetch_status = $this->fetch_model->get_status_by_id($list->tracking_number);
				if ($fetch_status != 'error') {
					if ($fetch_status->success) {
						$fetch_res = count($fetch_status->list) != 0 ? $fetch_status->list[0]->status : 'Not Found';
					} else {
						$fetch_res = 'Not Found';
					}
				} else {
					$fetch_res = 'Error Fetching';
				}
				$row[] = $fetch_res;
				// kudu update db here
				$this->tracking_model->edit_delivery(array('id' => $list->id, 'status' => $fetch_res));
				// $row[] = $list->status . '<a class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" href="' . base_url('ajax/synchronize?id=') . $list->tracking_number . '"><i class="fas fa-sync"></i></a>';
				$row[] = $list->created_at;
				$row[] = $list->from_time;
				$row[] = $list->to_time;
				$row[] = '<a class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" target="_blank" href="' . $external_link . $list->tracking_number . '"><i class="fas fa-map-marker-alt"></i></a>';
				$row[] =  $this->load->view('jquery/modal_delete_delivery', $list, TRUE);
				// $row[] =  $this->load->view('jquery/modal_pic', $list, TRUE);
				// $row[] = '<a class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" href="' . base_url('ajax/delete_delivery?id=') . $list->id . '&external_id=' . $list->tracking_number . '"><i class="fas fa-trash-alt"></i></a>';
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->tracking_model->count_all(),
				"recordsFiltered" => $this->tracking_model->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function add_delivery()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'add_delivery'], $this->session->userdata('privileges'))) {
				// array_map('strval', $a);
				$choosen_orders = array_map('intval', $this->input->post('items_order') ?: array());
				$choosen_sku = $this->input->post('items_sku') ?: array();
				$items = array();
				$combined_sku = array();
				foreach ($choosen_sku as $sku) {
					// $combined_sku = array();
					$sku_id = $this->sku_model->get_sku_by_name($sku)->id;
					$ching = array(
						'sku_code' => $sku,
						'quantity' => $this->input->post('quantity_sku_' . $sku_id)
					);
					array_push($combined_sku, $ching);
				}
				$items['order_id'] = $choosen_orders;
				$items['sku'] = $combined_sku;
				$tracking_number = "IOT/" . date("Y/m/d/his");
				$data = array(
					"tracking_number" => $tracking_number,
					"items" => json_encode($items),
					"customer" => $this->input->post("customer"),
					"tracker_id" => $this->input->post("tracker_id"),
					"from_time" => $this->input->post("from_time"),
					"to_time" => $this->input->post("to_time"),
					"address" => $this->input->post("address"),
					"lat" => $this->input->post("lat"),
					"lng" => $this->input->post("lng"),
				);
				$result = $this->tracking_model->add_delivery($data);
				if ($result > 0) {
					$fetch_res = $this->fetch_model->post_delivery($data);
					if (!$fetch_res->success) {
						$this->tracking_model->delete_delivery_by_number($tracking_number);
						$this->session->set_flashdata("failed", "Send to external server failed");
						//     //     //delete
					} else {
						if ($items['order_id']) {
							foreach ($items['order_id'] as $order) {
								$this->order_model->delivered($order);
							}
						}
						$this->event_model->add_event(array("event" => "New delivery has been created. [Customer: " . $data['customer'] . "]"));
						$this->session->set_flashdata("success", "Your changes have been saved.");
					}
					redirect(base_url() . 'pages/product_cycle_tracking');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/product_cycle_tracking');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/storage_management'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function delete_delivery()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'delete_delivery'], $this->session->userdata('privileges'))) {
				$id = $_GET['id'];
				$external_id = $_GET['external_id'];
				$delivery = $this->tracking_model->get_delivery_by_id($id);
				$items = json_decode($delivery->items, true);
				if ($items['order_id']) {
					foreach ($items['order_id'] as $order) {
						$this->order_model->undelivered($order);
					}
				}
				$result = $this->tracking_model->delete_delivery($id);
				if ($result > 0) {
					$this->fetch_model->delete_task($external_id);
					$this->event_model->add_event(array("event" => "Delivery ID " . $id . " with tracking number " . $external_id . " has been deleted."));
					$this->session->set_flashdata("success", "Delivery " . $id . " Succesfully Deleted");
					redirect(base_url() . 'pages/product_cycle_tracking');
				} else {
					$this->session->set_flashdata("failed", "Delete Failed");
					redirect(base_url() . 'pages/product_cycle_tracking');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/product_cycle_tracking'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function event_list()
	{
		if ($this->session->userdata('username') != '') {
			$lists = $this->event_model->get_datatables();
			$data = array();
			foreach ($lists as $list) {
				$row = array();
				$row[] = $list->id;
				$row[] = $list->event;
				$row[] = $list->created_at;
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->event_model->count_all(),
				"recordsFiltered" => $this->event_model->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function account_list()
	{
		if ($this->session->userdata('username') != '') {
			$lists = $this->account_model->get_datatables();
			$lines = $this->line_model->get_line_info();
			$data = array();
			foreach ($lists as $list) {
				$list->lines = $lines;
				$row = array();
				$row[] = $list->id;
				$row[] = $list->user_name;
				$row[] = $this->load->view('jquery/modal_change_password', $list, TRUE);
				if ($list->id == 1) {
					$row[] = '';
					$row[] = '';
				} else {
					$row[] =  $this->load->view('jquery/modal_account', $list, TRUE);
					$row[] =  $this->load->view('jquery/modal_delete_account', $list, TRUE);
				}
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->account_model->count_all(),
				"recordsFiltered" => $this->account_model->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function add_account()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin'], $this->session->userdata('privileges'))) {
				$data = array(
					"user_name" => $this->input->post("user_name"),
					"user_password" => password_hash($this->input->post("user_password"), PASSWORD_BCRYPT),
					"privileges" => json_encode($this->input->post("privileges") ?: array())
				);
				$result = $this->account_model->add_account($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "New Account has been created. [" . $data['user_name'] . "]"));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/admin_panel');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/admin_panel');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/admin_panel'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function edit_account()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin'], $this->session->userdata('privileges'))) {
				$data = array(
					"id" => $this->input->post("id"),
					"privileges" => json_encode($this->input->post("privileges") ?: array())
				);
				$result = $this->account_model->edit_account($data);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "Account ID " . $data['id'] . " has been changed."));
					$this->session->set_flashdata("success", "Your changes have been saved.");
					redirect(base_url() . 'pages/admin_panel');
				} else {
					$this->session->set_flashdata("failed", "Your changes cannot be saved.");
					redirect(base_url() . 'pages/admin_panel');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/admin_panel'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function change_password()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin'], $this->session->userdata('privileges'))) {
				if ($this->input->post("password") == $this->input->post("confirm_password")) {
					$data = array(
						"id" => $this->input->post("id"),
						"password" => password_hash($this->input->post("password"), PASSWORD_BCRYPT)
					);
					$result = $this->account_model->change_password($data);
					if ($result > 0) {
						$this->event_model->add_event(array("event" => "Account ID " . $data['id'] . " has been changed."));
						$this->session->set_flashdata("success", "Your changes have been saved.");
						redirect(base_url() . 'pages/admin_panel');
					} else {
						$this->session->set_flashdata("failed", "Your changes cannot be saved.");
						redirect(base_url() . 'pages/admin_panel');
					}
				} else {
					$this->session->set_flashdata("failed", "Confirm password failed.");
					redirect(base_url() . 'pages/admin_panel');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/admin_panel'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function delete_account()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin'], $this->session->userdata('privileges'))) {
				$id = $_GET['id'];
				$result = $this->account_model->delete_account($id);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "Account ID " . $id . " has been deleted."));
					$this->session->set_flashdata("success", "Account ID " . $id . " Succesfully Deleted");
					redirect(base_url() . 'pages/admin_panel');
				} else {
					$this->session->set_flashdata("failed", "Delete Failed");
					redirect(base_url() . 'pages/admin_panel');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/admin_panel'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}

	//ajax from dashboard
	public function plus_ng()
	{
		if ($this->session->userdata('username') != '') {
			$json = file_get_contents('php://input');
			$id = json_decode($json)->id;
			$result = $this->line_model->plus_ng($id);
			if ($result[0] > 0) {
				$res = array(
					'status' => 'success',
					'ng' => $result[1]
				);
				echo json_encode($res);
			} else {
				$res = array(
					'status' => 'failed'
				);
				echo json_encode($res);
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function minus_ng()
	{
		if ($this->session->userdata('username') != '') {
			$json = file_get_contents('php://input');
			$id = json_decode($json)->id;
			$result = $this->line_model->minus_ng($id);
			if ($result[0] > 0) {
				$res = array(
					'status' => 'success',
					'ng' => $result[1]
				);
				echo json_encode($res);
			} else {
				$res = array(
					'status' => 'failed'
				);
				echo json_encode($res);
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function double_plus_ng()
	{
		if ($this->session->userdata('username') != '') {
			$json = file_get_contents('php://input');
			$id = json_decode($json)->id;
			$result = $this->line_model->double_plus_ng($id);
			if ($result[0] > 0) {
				$res = array(
					'status' => 'success',
					'ng' => $result[1]
				);
				echo json_encode($res);
			} else {
				$res = array(
					'status' => 'failed'
				);
				echo json_encode($res);
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function double_minus_ng()
	{
		if ($this->session->userdata('username') != '') {
			$json = file_get_contents('php://input');
			$id = json_decode($json)->id;
			$result = $this->line_model->double_minus_ng($id);
			if ($result[0] > 0) {
				$res = array(
					'status' => 'success',
					'ng' => $result[1]
				);
				echo json_encode($res);
			} else {
				$res = array(
					'status' => 'failed'
				);
				echo json_encode($res);
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function breakdown_log()
	{
		if ($this->session->userdata('username') != '') {
			// $json = file_get_contents('php://input');
			// $id = json_decode($json)->id;
			$output = $this->log_model->get_breakdown_log();
			echo json_encode($output);
			// echo 'tai';
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function add_line()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'add_line'], $this->session->userdata('privileges'))) {
				$arr_query = array(
					'line_name' => $this->input->post('line_name'),
				);
				$result = $this->line_model->add_line($arr_query);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "New Line has been created. [" . $arr_query['line_name'] . "]"));
					$this->session->set_flashdata("success", "Input Success");
					redirect(base_url() . 'pages/dashboard');
				} else {
					$this->session->set_flashdata("failed", "Input Failed");
					redirect(base_url() . 'pages/dashboard');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/dashboard'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function delete_line()
	{
		if ($this->session->userdata('username') != '') {
			if ($this->in_array_any(['admin', 'delete_line'], $this->session->userdata('privileges'))) {
				$arr_query = array(
					'id' => $this->input->post('line_id')
				);
				$current_line = $this->line_model->get_line_by_id($arr_query['id']);
				$result = $this->line_model->delete_line($arr_query['id']);
				if ($result > 0) {
					$this->event_model->add_event(array("event" => "Line " . $current_line->line_name . " has been deleted."));
					$this->session->set_flashdata("success", "Delete Line " . $arr_query['id'] . " Success");
					redirect(base_url() . 'pages/dashboard');
				} else {
					$this->session->set_flashdata("failed", "Delete Line " . $arr_query['id'] . " Failed");
					redirect(base_url() . 'pages/dashboard');
				}
			} else {
				$this->session->set_flashdata("failed", "Need Privilage");
				redirect(base_url() . 'pages/dashboard'); //need to change to dashboard
			}
		} else {
			redirect(base_url() . 'pages/login');
		}
	}
	public function export()
	{
		// $json = file_get_contents('php://input');
		// var_dump($json);
		// datetimerange: "2023-04-04 10:00:00 to 2023-04-13 18:00:00"
		// line_name: "All"
		$data = array(
			"datetimerange" => $this->input->post("datetimerange"),
			"line_name" => $this->input->post("line"),
			"sku_code" => $this->input->post("sku"),
		);
		// var_dump($data);
		$this->export_model->Export($data);
	}
	// public function export_api()
	// {
	//     // $fromepoch = date("Y-m-d H:i:s", ($_GET['from'] / 1000) + 5 * 60 * 60);
	//     // $toepoch = date("Y-m-d H:i:s", ($_GET['to'] / 1000) + 5 * 60 * 60);
	//     $fromepoch = date("Y-m-d H:i:s", ($_GET['from'] / 1000) + 7 * 60 * 60);
	//     $toepoch = date("Y-m-d H:i:s", ($_GET['to'] / 1000) + 7 * 60 * 60);
	//     $datetimerange = $fromepoch . ' to ' . $toepoch;
	//     // var_dump($datetimerange);
	//     $export_data = array(
	//         'datetimerange' => $datetimerange
	//     );
	//     $this->export_model->Export($export_data);
	// }
}
