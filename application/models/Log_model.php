<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log_model extends CI_Model
{
	var $table = 'log_oee';
	var $column_order = array('id', 'timestamp', 'batch_id', 'lot_number', 'line_name', 'sku_code', 'item_counter', 'NG_count', 'status', 'delta_down_time', 'pic_name', 'remark', 'detail', 'pic_name_2', 'remark_2', 'detail_2', 'location', null, null); //set column field database for datatable orderable
	var $column_search = array('id', 'timestamp', 'batch_id', 'lot_number', 'line_name', 'sku_code', 'item_counter', 'NG_count', 'status', 'delta_down_time', 'pic_name', 'remark', 'detail', 'pic_name_2', 'remark_2', 'detail_2', 'location'); //set column field database for datatable searchable 
	var $order = array('id' => 'asc'); // default order 
	// var $sql_table = "select * from (SELECT *,(LAG(status, 1) OVER (PARTITION BY line_name ORDER BY timestamp)) as prev_status FROM log_oee) as t where status!=prev_status and status='BREAKDOWN'";
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($datetimerange)
	{
		// $this->db->select('machine_info.*,station_info.name as station_name');
		$this->db->select('*');
		$this->db->where('status !=prev_status');
		$this->db->where('(status = "DOWN TIME" or status = "BREAKDOWN")');
		$datetimeexplode = explode(' to ', $datetimerange);
		$datetimestart = $datetimeexplode[0];
		$datetimeend = $datetimeexplode[1];
		$this->db->where('timestamp >=', $datetimestart);
		$this->db->where('timestamp <=', $datetimeend);
		// $this->db->from('(SELECT *,(LAG(status, 1) OVER (PARTITION BY line_name ORDER BY timestamp)) as prev_status FROM log_oee) as t');
		$this->db->from($this->table);
		// select * from (SELECT *,(LAG(status, 1) OVER (
		// PARTITION BY line_name
		// ORDER BY timestamp)) as prev_status FROM log_oee) as t where status!=prev_status and status='BREAKDOWN';
		// $sql = 
		// $this->db->query($this->sql_table);
		// $this->db->from($this->table);
		// $this->get_breakdown_log();

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

		//single column search
		for ($i = 0; $i < sizeof($this->column_search) - 1; $i++) {
			if ($_POST['columns'][$i]['search']['value']) {
				$this->db->like($this->column_search[$i], $_POST['columns'][$i]['search']['value']);
			}
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_count($datetimerange)
	{
		// $this->db->select('machine_info.*,station_info.name as station_name');
		$this->db->select('count(id) as counted');
		$this->db->where('status !=prev_status');
		$this->db->where('(status = "DOWN TIME" or status = "BREAKDOWN")');
		$datetimeexplode = explode(' to ', $datetimerange);
		$datetimestart = $datetimeexplode[0];
		$datetimeend = $datetimeexplode[1];
		$this->db->where('timestamp >=', $datetimestart);
		$this->db->where('timestamp <=', $datetimeend);
		// $this->db->from('(SELECT *,(LAG(status, 1) OVER (PARTITION BY line_name ORDER BY timestamp)) as prev_status FROM log_oee) as t');
		$this->db->from($this->table);
		// select * from (SELECT *,(LAG(status, 1) OVER (
		// PARTITION BY line_name
		// ORDER BY timestamp)) as prev_status FROM log_oee) as t where status!=prev_status and status='BREAKDOWN';
		// $sql = 
		// $this->db->query($this->sql_table);
		// $this->db->from($this->table);
		// $this->get_breakdown_log();

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

		//single column search
		for ($i = 0; $i < sizeof($this->column_search) - 1; $i++) {
			if ($_POST['columns'][$i]['search']['value']) {
				$this->db->like($this->column_search[$i], $_POST['columns'][$i]['search']['value']);
			}
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($datetimerange)
	{
		$this->_get_datatables_query($datetimerange);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		// var_dump($query->result());
		return $query->result();
	}

	function count_filtered($datetimerange)
	{
		$this->_get_datatables_query_count($datetimerange);
		$query = $this->db->get();
		return $query->row()->counted;
	}

	public function count_all()
	{
		$this->db->select('*');
		$this->db->where('status !=prev_status');
		$this->db->where('(status = "DOWN TIME" or status = "BREAKDOWN")');
		// $this->db->from('(SELECT *,(LAG(status, 1) OVER (PARTITION BY line_name ORDER BY timestamp)) as prev_status FROM log_oee) as t');
		$this->db->from($this->table);
		// $this->db->query($this->sql_table);
		return $this->db->count_all_results();
	}

	public function edit_log($data)
	{
		// $this->db->set('sku_code', $data['sku_code']);
		$this->db->set('pic_name', $data['pic_name']);
		$this->db->set('remark', $data['remark']);
		$this->db->set('detail', $data['detail']);
		$this->db->set('pic_name_2', $data['pic_name_2']);
		$this->db->set('remark_2', $data['remark_2']);
		$this->db->set('detail_2', $data['detail_2']);
		$this->db->where('id', $data['id']);
		$this->db->update('log_oee');
		return $this->db->affected_rows();
	}
	public function get_log_info()
	{
		$this->db->select('*');
		$this->db->from('log_oee');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_log_by_id($data)
	{
		$this->db->select('*');
		$this->db->from('log_oee');
		$this->db->where('id', $data);
		$query = $this->db->get();
		return $query->result_array();
	}
	// public function get_sku_by_line($data)
	// {
	//     $this->db->select('*');
	//     $this->db->from('sku_list');
	//     $this->db->where('line_name', $data);
	//     $query = $this->db->get();
	//     // var_dump($query->row());
	//     return $query->row();
	// }

	public function get_breakdown_log()
	{
		$this->db->select('*');
		$this->db->where('status !=prev_status');
		// $this->db->where('(status = "DOWN TIME" or status = "SMALL STOP")');
		$this->db->where('(status = "DOWN TIME" or status = "BREAKDOWN")');
		// $this->db->from('(SELECT *,(LAG(status, 1) OVER (PARTITION BY line_name ORDER BY timestamp)) as prev_status FROM log_oee) as t');
		$this->db->from($this->table);
		$query = $this->db->get();
		// return $query->result_array();
		return $query->num_rows();
	}
	public function get_log_by_range($json_arr)
	{
		$datetimeexplode = explode(' to ', $json_arr['datetimerange']);
		// echo $datetimeexplode[0];
		$datetimestart = $datetimeexplode[0];
		$datetimeend = $datetimeexplode[1];
		$this->db->select('*');
		$this->db->where('timestamp >=', $datetimestart);
		$this->db->where('timestamp <=', $datetimeend);
		// $this->db->select('*');
		if ($json_arr['line_name'] != 'All') {
			$this->db->where('line_name', $json_arr['line_name']);
		}
		$this->db->from('log_oee');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_summary($data)
	{
		$datetimeexplode = explode(' to ', $data['datetimerange']);
		// echo $datetimeexplode[0];
		$datetimestart = $datetimeexplode[0];
		$datetimeend = $datetimeexplode[1];
		$this->db->select('avg(performance_24h),avg(availability_24h),avg(quality_24h)');
		if ($data['line_name'] != 'All') {
			$this->db->where('line_name', $data['line_name']);
		}
		if ($data['sku_code'] != 'All') {
			$this->db->where('sku_code', $data['sku_code']);
		}
		$this->db->where('timestamp >=', $datetimestart);
		$this->db->where('timestamp <=', $datetimeend);
		$this->db->from('log_oee');
		$query = $this->db->get();
		return (array)$query->row();
	}
	public function get_line_list($json_arr)
	{
		$this->db->select('*');
		if ($json_arr['line_name'] != 'All') {
			$this->db->where('line_name', $json_arr['line_name']);
		}
		$this->db->from('manufacturing_line');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_chart($json_arr)
	{
		$datetimeexplode = explode(' to ', $json_arr['datetimerange']);
		// echo $datetimeexplode[0];
		$datetimestart = $datetimeexplode[0];
		$datetimeend = $datetimeexplode[1];
		$this->db->select('*');
		if ($json_arr['line_name'] != 'All') {
			$this->db->where('line_name', $json_arr['line_name']);
		}
		$this->db->from('manufacturing_line');
		$query = $this->db->get();
		$return_arr = array();
		foreach ($query->result_array() as $data) {
			$this->db->select('max(id)');
			$this->db->where('line_name', $data['line_name']);
			if ($json_arr['sku_code'] != 'All') {
				$this->db->where('sku_code', $json_arr['sku_code']);
			}
			$this->db->where('timestamp >=', $datetimestart);
			$this->db->where('timestamp <=', $datetimeend);
			$this->db->group_by('date(timestamp),line_name');
			$this->db->from('log_oee');
			$subQuery = $this->db->get_compiled_select();

			$this->db->select("*,date(timestamp) as forDate");
			$this->db->order_by("timestamp", "desc");
			$this->db->from('log_oee');
			$this->db->where("`id` IN ($subQuery)", NULL, FALSE);
			$query2 = $this->db->get();
			$result2 = $query2->result_array();
			// foreach ($result2 as $row) {
			// }
			$return_arr[$data['id']] = $result2;
		}
		return $return_arr;
	}
}
