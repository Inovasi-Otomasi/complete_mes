<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_model extends CI_Model
{
    var $table = 'inventory_list';
    var $column_order = array('id', 'inventory_name', 'inventory_code', 'quantity', 'created_at', null, null); //set column field database for datatable orderable
    var $column_search = array('id', 'inventory_name', 'inventory_code', 'quantity', 'created_at'); //set column field database for datatable searchable 
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

    public function add_inventory($data)
    {
        $this->db->insert('inventory_list', $data);
        return $this->db->affected_rows();
    }
    public function delete_inventory($data)
    {
        $this->db->where('id', $data);
        $this->db->delete('inventory_list');
        return $this->db->affected_rows();
    }
    public function edit_inventory($data)
    {
        $this->db->set('inventory_name', $data['inventory_name']);
        $this->db->set('inventory_code', $data['inventory_code']);
        $this->db->set('quantity', $data['quantity']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('id', $data['id']);
        $this->db->update('inventory_list');
        return $this->db->affected_rows();
    }
    public function get_inventory_info()
    {
        $this->db->select('*');
        $this->db->from('inventory_list');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_inventory_by_id($data)
    {
        $this->db->select('*');
        $this->db->from('inventory_list');
        $this->db->where('id', $data);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_inventory_by_code($data)
    {
        $this->db->select('*');
        $this->db->from('inventory_list');
        $this->db->where('inventory_code', $data);
        $query = $this->db->get();
        return $query->row();
    }
}
