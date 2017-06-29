<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author pavaningalkar
 */
class Login extends CI_Model{
    //put your code here
    function __construct()
        {
             // Call the Model constructor
             parent::__construct();
             
        }
    function select_info($table_name,$cond = array())
        {
            $this->db->select('*');
            $this->db->from($table_name);
            if(!empty($cond)){ foreach ($cond as $key => $value)$this->db->where($key,$value); } 
            $query = $this->db->get();        
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    function insert_info($table_name,$data)
        {
            $this->db->insert($table_name, $data);
            return $this->db->insert_id();
        }
    function update_info($tbl_name,$data_array,$cond)
    {        
        if(!empty($cond)){
            foreach ($cond as $key => $value) {
            $this->db->where($key,$value);
            }
        }
        $this->db->update($tbl_name,$data_array);
        return $this->db->affected_rows();
    }
    function insert_batch_record($table_name,$data)
    {
        $this->db->insert_batch($table_name, $data);
        return $this->db->insert_id();
    }
    
}
