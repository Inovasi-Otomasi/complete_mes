<?php
class Validation_model extends CI_Model
{
    function can_login($username, $password)
    {
        $this->db->where('user_name', $username);
        // $this->db->where('user_password', $password);
        $query = $this->db->get('user_account');
        //SELECT * FROM users WHERE username = '$username' AND password = '$password'  
        // if ($query->num_rows() > 0) {
        //     return true;
        // } else {
        //     return false;
        // }
        $verified = password_verify($password, $query->row()->user_password);
        return $verified;
    }
    function change_password($username, $password, $new_password)
    {
        // $this->db->where('user_name', $username);
        // $this->db->where('user_password', $password);
        // $query = $this->db->get('user_account');
        $this->db->set('user_password', $new_password);
        $this->db->where('user_name', $username);
        $this->db->where('user_password', $password);
        $this->db->update('user_account');
        //SELECT * FROM users WHERE username = '$username' AND password = '$password'  
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function getLevel($username)
    {
        $this->db->select('user_level');
        $this->db->where('user_name', $username);
        $query = $this->db->get('user_account');
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
        // return $query->result_array();
    }
    function getPrivileges($username)
    {
        $this->db->select('privileges');
        $this->db->where('user_name', $username);
        $query = $this->db->get('user_account');
        // if ($query->num_rows() > 0) {
        //     $row = $query->row_array();
        //     return $row;
        // }
        return json_decode($query->row()->privileges, true);
        // return json_decode($query->row()->privileges, true);
    }
}
