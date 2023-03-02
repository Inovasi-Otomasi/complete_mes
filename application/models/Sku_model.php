<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sku_model extends CI_Model
{
    var $table = 'sku_list';
    var $column_order = array('id', 'sku_code', 'line_rules', 'material', null, null); //set column field database for datatable orderable
    var $column_search = array('id', 'sku_code', 'line_rules', 'material'); //set column field database for datatable searchable 
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

    public function add_sku($data)
    {
        $this->db->insert('sku_list', $data);
        return $this->db->affected_rows();
    }
    public function delete_sku($data)
    {
        $this->db->where('id', $data);
        $this->db->delete('sku_list');
        return $this->db->affected_rows();
    }
    public function edit_sku($data)
    {
        // $this->db->set('line_name', $data['line_name']);
        $this->db->set('sku_code', $data['sku_code']);
        // $this->db->set('setup_time', $data['setup_time']);
        $this->db->set('line_rules', $data['line_rules']);
        $this->db->set('material', $data['material']);
        $this->db->where('id', $data['id']);
        $this->db->update('sku_list');
        return $this->db->affected_rows();
    }
    public function quantity_check($sku_code, $minus)
    {
        $this->db->select('*');
        $this->db->where('sku_code', $sku_code);
        $this->db->from('sku_list');
        $quantity = $this->db->get()->row()->quantity;
        if ($quantity >= $minus) {
            return true;
        } else {
            return false;
        }
        // return $query->result_array();
    }
    public function subtraction($sku_code, $minus)
    {
        $this->db->set('quantity', "quantity-" . $minus, false);
        $this->db->where('sku_code', $sku_code);
        $this->db->update('sku_list');
        return $this->db->affected_rows();
    }
    public function addition($sku_code, $plus)
    {
        $this->db->set('quantity', "quantity+" . $plus, false);
        $this->db->where('sku_code', $sku_code);
        $this->db->update('sku_list');
        return $this->db->affected_rows();
    }
    public function get_sku_info()
    {
        $this->db->select('*');
        $this->db->from('sku_list');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_sku_by_id($data)
    {
        $this->db->select('*');
        $this->db->from('sku_list');
        $this->db->where('id', $data);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_sku_by_name($data)
    {
        $this->db->select('*');
        $this->db->from('sku_list');
        $this->db->where('sku_code', $data);
        $query = $this->db->get();
        // var_dump($query->row());
        return $query->row();
    }
}
