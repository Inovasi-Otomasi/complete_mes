<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
	var $table = 'order_list';
	var $column_order = array('id', 'batch_id', 'lot_number', 'line_rules', 'sku_code', 'quantity',  'created_at', 'started_at', 'finished_at', 'storage', 'status', 'progress', null); //set column field database for datatable orderable
	var $column_search = array('id', 'batch_id', 'lot_number', 'line_rules', 'sku_code', 'quantity',  'created_at', 'started_at', 'finished_at', 'storage', 'status', 'progress'); //set column field database for datatable searchable 
	var $order = array('id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$this->db->from($this->table);

		$i = 0;

		foreach ($this->column_search as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function add_order($data)
	{
		$this->db->insert('order_list', $data);
		return $this->db->affected_rows();
	}
	public function delete_order($data)
	{
		$this->db->where('id', $data);
		$this->db->delete('order_list');
		return $this->db->affected_rows();
	}
	public function edit_order($data)
	{
		// $this->db->set('line_name', $data['line_name']);
		// $this->db->set('sku_code', $data['sku_code']);
		// $this->db->set('setup_time', $data['setup_time']);
		$this->db->set('quantity', $data['quantity']);
		$this->db->where('id', $data['id']);
		$this->db->update('order_list');
		return $this->db->affected_rows();
	}
	public function change_order_status($data)
	{


		$this->db->set('line_rules', $data['line_rules']);
		if ($data['status'] == 'Work In Progress') {
			$this->db->set('status', $data['status']);
			// $this->db->set('line_rules', $data['line_rules']);
			$this->db->set('started_at', 'now()', false);
			// $this->db->set('estimation', 'TIMESTAMPADD(SECOND,' . $data['estimation'] . ',NOW())', false);
		} elseif ($data['status'] == 'Completed') {
			$this->db->set('status', $data['status']);
			// $this->db->set('line_rules', $data['line_rules']);
			$this->db->set('finished_at', 'now()', false);
			$this->db->set('progress', $data['progress']);
			// $this->add_sku_quantity($data['order_id']);
		} elseif ($data['status'] == 'Partial Complete') {
			$this->db->set('progress', $data['progress']);
			// $this->db->set('line_rules', $data['line_rules']);
		}
		$this->db->where('id', $data['order_id']);
		$this->db->update('order_list');
		return $this->db->affected_rows();
	}
	// public function add_sku_quantity($order_id)
	// {
	//     // get order info
	//     $order_info = $this->get_order_by_id($order_id);
	//     // var_dump($order_info);
	//     // $this->db->set('quantity', $order_info->item_counter - $order_info->NG_count);
	//     $this->db->set('quantity', 50);
	//     // $this->db->set('quantity_updated_at', 'now()', false);
	//     // $this->db->where('sku_code', $order_info->sku_code);
	//     $this->db->where('sku_code', 'KCNG-001');
	//     $this->db->update('sku_list');
	//     // return $this->db->affected_rows();
	// }
	public function get_order_info()
	{
		$this->db->select('*');
		$this->db->from('order_list');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_order_info_for_pct()
	{
		$this->db->select('*');
		$this->db->from('order_list');
		$this->db->where('delivered', 0);
		$this->db->where('storage', 0);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_order_by_id($data)
	{
		$this->db->select('*');
		$this->db->from('order_list');
		$this->db->where('id', $data);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_order_by_line($data)
	{
		$this->db->select('*');
		$this->db->from('order_list');
		$this->db->where('line_name', $data);
		$query = $this->db->get();
		return $query->row();
	}
	public function delivered($data)
	{
		$this->db->set('delivered', 1);
		$this->db->where('id', $data);
		$this->db->update('order_list');
		return $this->db->affected_rows();
	}
	public function undelivered($data)
	{
		$this->db->set('delivered', 0);
		$this->db->where('id', $data);
		$this->db->update('order_list');
		return $this->db->affected_rows();
	}
}
