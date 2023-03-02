<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Remark_model extends CI_Model
{
    var $table = 'remark_list';
    var $column_order = array('id', 'status', 'detail', 'remark_time', null, null); //set column field database for datatable orderable
    var $column_search = array('id', 'status', 'detail', 'remark_time'); //set column field database for datatable searchable 
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

    public function add_remark($data)
    {
        $this->db->insert('remark_list', $data);
        return $this->db->affected_rows();
    }
    public function delete_remark($data)
    {
        $this->db->where('id', $data);
        $this->db->delete('remark_list');
        return $this->db->affected_rows();
    }
    public function edit_remark($data)
    {
        $this->db->set('status', $data['status']);
        $this->db->set('detail', $data['detail']);
        $this->db->set('remark_time', $data['remark_time']);
        $this->db->where('id', $data['id']);
        $this->db->update('remark_list');
        return $this->db->affected_rows();
    }
    public function get_remark_info()
    {
        $this->db->select('*');
        $this->db->from('remark_list');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_remark_by_id($data)
    {
        $this->db->select('*');
        $this->db->from('remark_list');
        $this->db->where('id', $data);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_remark_by_detail($data)
    {
        $this->db->select('*');
        $this->db->from('remark_list');
        $this->db->where('detail', $data);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_remark_by_status($data)
    {
        $this->db->select('*');
        $this->db->from('remark_list');
        $this->db->where('status', $data);
        $query = $this->db->get();
        // var_dump($query->row());
        return $query->row();
    }
}
