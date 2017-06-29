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
 class SearchPG extends CI_Model {

            function __construct()
            {
                // Call the Model constructor
                parent::__construct();
            }

            function search_pg_list($table_name,$cond = array(),$order = array(),$page=0,$perpage=0)
        {
			if($perpage):
				$page = $page-1;
				if ($page<0) { 
					$page = 0;
				}
				$from = $page*$perpage;
				$this->db->limit($perpage, $from);
			endif;
            $this->db->select('*');
            $this->db->from($table_name);
            if(!empty($cond)){ foreach ($cond as $key => $value)$this->db->where($key,$value); } 
            if(!empty($order)){ foreach ($order as $key => $value)$this->db->order_by($key,$value); } 
            $query = $this->db->get();        
            return ($query->num_rows() > 0)?$query->result():FALSE;
			
        }

    }
