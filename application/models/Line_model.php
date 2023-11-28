<?php

use phpDocumentor\Reflection\Types\Null_;

defined('BASEPATH') or exit('No direct script access allowed');

class Line_model extends CI_Model
{
	public function add_line($data)
	{
		$this->db->insert('manufacturing_line', $data);
		return $this->db->affected_rows();
	}
	public function delete_line($data)
	{
		$this->db->where('id', $data);
		$this->db->delete('manufacturing_line');
		return $this->db->affected_rows();
	}
	public function edit_line($data)
	{
		$this->db->set('sku_code', $data['sku_code']);
		$this->db->set('order_id', $data['order_id']);
		$this->db->set('batch_id', $data['batch_id']);
		$this->db->set('lot_number', $data['lot_number']);
		$this->db->set('target', $data['target']);
		$this->db->set('setup_time', $data['setup_time']);
		$this->db->set('cycle_time', $data['cycle_time']);
		$this->db->set('remark', $data['remark']);
		$this->db->set('small_stop_time', $data['small_stop_time']);
		$this->db->set('small_stop_detail', $data['small_stop_detail']);
		$this->db->where('id', $data['id']);
		$this->db->update('manufacturing_line');
		return $this->db->affected_rows();
	}
	public function change_line_status($data)
	{
		$this->db->set('status', $data['status']);
		if ($data['status'] == 'STANDBY') {
			$this->db->set('standby_time', $data['standby_time']);
			$this->db->set('remark', $data['remark']);
		} elseif ($data['status'] == 'STOP' || $data['status'] == 'BREAKDOWN') {
			$this->db->set('sku_code', 'None');
			$this->db->set('small_stop_detail', '');
			$this->db->set('small_stop_time', 0);
			$this->db->set('small_stop_sum', 0);
			$this->db->set('setup_time_sum', 0);
			$this->db->set('order_id', 0);
			$this->db->set('batch_id', 0);
			$this->db->set('lot_number', 0);
			$this->db->set('setup_time', 0);
			$this->db->set('cycle_time', 0);
			$this->db->set('run_time', 0);
			// $this->db->set('down_time', 0);
			//disabled for engine use
			$this->db->set('temp_time', 0);
			$this->db->set('item_counter', 0);
			$this->db->set('prev_item_counter', 0);
			$this->db->set('NG_count', 0);
			$this->db->set('target', 0);
			$this->db->set('status', $data['status']);
			$this->db->set('standby_time', 0);
			$this->db->set('performance', 0);
			$this->db->set('availability', 0);
			$this->db->set('progress', 0);
			$this->db->set('quality', 0);
			$this->db->set('remark', '');
			$this->db->set('acc_standby_time', 0);
			$this->db->set('acc_setup_time', 0);
			$this->db->set('additional', 0);
		}
		$this->db->where('id', $data['id']);
		$this->db->update('manufacturing_line');
		return $this->db->affected_rows();
	}
	public function breakdown_line($data)
	{
		$this->db->set('temp_time', $data['cycle_time']);
		$this->db->where('id', $data['id']);
		$this->db->update('manufacturing_line');
		return $this->db->affected_rows();
	}
	public function change_line_status_all($data)
	{
		//foreach start check assigned order id
		$this->db->set('status', $data['status']);
		if ($data['status'] == 'STOP') {
			$this->db->set('sku_code', 'None');
			$this->db->set('order_id', 0);
			$this->db->set('small_stop_detail', '');
			$this->db->set('small_stop_time', 0);
			$this->db->set('order_id', 0);
			$this->db->set('batch_id', 0);
			$this->db->set('lot_number', 0);
			$this->db->set('setup_time', 0);
			$this->db->set('cycle_time', 0);
			$this->db->set('run_time', 0);
			// $this->db->set('down_time', 0);
			//disabled for engine use
			$this->db->set('temp_time', 0);
			$this->db->set('item_counter', 0);
			$this->db->set('prev_item_counter', 0);
			$this->db->set('NG_count', 0);
			$this->db->set('target', 0);
			$this->db->set('status', 'STOP');
			$this->db->set('standby_time', 0);
			$this->db->set('performance', 0);
			$this->db->set('availability', 0);
			$this->db->set('quality', 0);
			$this->db->set('progress', 0);
			$this->db->set('remark', '');
			$this->db->set('acc_standby_time', 0);
			$this->db->set('acc_setup_time', 0);
			$this->db->set('additional', 0);
		}
		$this->db->update('manufacturing_line');
		return $this->db->affected_rows();
	}
	public function reset_line($data)
	{
		$this->db->set('run_time', 0);
		$this->db->set('down_time', 0);
		$this->db->set('temp_time', 0);
		$this->db->set('item_counter', 0);
		$this->db->set('prev_item_counter', 0);
		$this->db->set('NG_count', 0);
		$this->db->set('status', 'STOP');
		$this->db->where('id', $data['id']);
		$this->db->update('manufacturing_line');
		return $this->db->affected_rows();
	}
	public function get_line_info()
	{
		$this->db->select('*');
		$this->db->from('manufacturing_line');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_line_by_id($data)
	{
		$this->db->select('*');
		$this->db->from('manufacturing_line');
		$this->db->where('id', $data);
		$query = $this->db->get()->row();
		return $query;
	}
	public function get_line_by_name($data)
	{
		$this->db->select('*');
		$this->db->from('manufacturing_line');
		$this->db->where('line_name', $data);
		$query = $this->db->get()->row();
		return $query;
	}
	public function get_line_status($data)
	{
		$this->db->select('*');
		$this->db->from('manufacturing_line');
		$this->db->where('id', $data);
		$query = $this->db->get()->row()->status;
		return $query;
	}
	public function plus_ng($data)
	{
		$this->db->select('*');
		$this->db->from('manufacturing_line');
		$this->db->where('id', $data);
		$ng = $this->db->get()->row()->NG_count;
		$ng++;
		$this->db->set('NG_count', $ng);
		$this->db->where('id', $data);
		$this->db->update('manufacturing_line');
		return [$this->db->affected_rows(), $ng];
	}
	public function minus_ng($data)
	{
		$this->db->select('*');
		$this->db->from('manufacturing_line');
		$this->db->where('id', $data);
		$ng = $this->db->get()->row()->NG_count;
		if ($ng > 0) {
			$ng--;
		}
		$this->db->set('NG_count', $ng);
		$this->db->where('id', $data);
		$this->db->update('manufacturing_line');
		return [$this->db->affected_rows(), $ng];
	}
	public function double_plus_ng($data)
	{
		$this->db->select('*');
		$this->db->from('manufacturing_line');
		$this->db->where('id', $data);
		$ng = $this->db->get()->row()->NG_count;
		$ng += 10;
		$this->db->set('NG_count', $ng);
		$this->db->where('id', $data);
		$this->db->update('manufacturing_line');
		return [$this->db->affected_rows(), $ng];
	}
	public function double_minus_ng($data)
	{
		$this->db->select('*');
		$this->db->from('manufacturing_line');
		$this->db->where('id', $data);
		$ng = $this->db->get()->row()->NG_count;
		if ($ng >= 10) {
			$ng -= 10;
		}
		$this->db->set('NG_count', $ng);
		$this->db->where('id', $data);
		$this->db->update('manufacturing_line');
		return [$this->db->affected_rows(), $ng];
	}
	public function edit_ng($data)
	{
		$this->db->set('NG_count', $data['NG_count']);
		$this->db->where('id', $data['id']);
		$this->db->update('manufacturing_line');
		return $this->db->affected_rows();
	}
	public function edit_additional($data)
	{
		$this->db->set('additional', $data['additional']);
		$this->db->where('id', $data['id']);
		$this->db->update('manufacturing_line');
		return $this->db->affected_rows();
	}
	public function get_avg_oee()
	{
		$this->db->select('(avg(performance)*avg(availability)*avg(quality))/10000 as avg_oee');
		$this->db->from('manufacturing_line');
		$avg = $this->db->get()->row()->avg_oee;
		return round($avg, 2);
	}
	public function get_avg_performance()
	{
		$this->db->select('avg(performance) as avg_performance');
		$this->db->from('manufacturing_line');
		$avg = $this->db->get()->row()->avg_performance;
		return round($avg, 2);
	}
	public function get_avg_availability()
	{
		$this->db->select('avg(availability) as avg_availability');
		$this->db->from('manufacturing_line');
		$avg = $this->db->get()->row()->avg_availability;
		return round($avg, 2);
	}
	public function get_avg_quality()
	{
		$this->db->select('avg(quality) as avg_quality');
		$this->db->from('manufacturing_line');
		$avg = $this->db->get()->row()->avg_quality;
		return round($avg, 2);
	}
}
