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
class Pg_guest extends CI_Model{
    //put your code here
    function __construct()
        {
             // Call the Model constructor
             parent::__construct();
             
        }

public function upload_image($user_id,$adhaar_frontpath,$adhaar_backpath,$DL_frontpath,$DL_backpath,$LA_frontpath,$PAN_frontpath,$PSP_frontpath)
  {  
	 
	  $query_get_mobilenumber = $this->db->query("SELECT * FROM guest_user_profile where g_uid=".$user_id);
	  foreach ($query_get_mobilenumber->result() as $row)
      {
		$getmobileno = $row->mobile_no;
		$adhaar_pdf = FCPATH."application/images/AdharCardPDF/AdharCard_".$getmobileno. ".pdf";
		$DL_pdf = FCPATH."application/images/DrivingLicencePDF/DrivingLicence_".$getmobileno. ".pdf";
		$LA_pdf = FCPATH."application/images/LocalAddressPDF/LocalAddress_".$getmobileno. ".pdf";
		$PAN_pdf = FCPATH."application/images/PanPDF/PAN_".$getmobileno. ".pdf";
		$PSP_pdf = FCPATH."application/images/PassportSizePhotoPDF/PassportSizePhoto_".$getmobileno. ".pdf";
	  }

	  $values = array('AAadhar_front'=>$adhaar_frontpath,'AAadhar_back'=>$adhaar_backpath,'AAadhar_pdf'=>$adhaar_pdf,
					  'DL_Front'=>$DL_frontpath,'DL_Back'=>$DL_backpath,'DL_pdf'=>$DL_pdf,
					  'LA_front'=>$LA_frontpath,'LA_pdf'=>$LA_pdf,
					  'pan_front'=>$PAN_frontpath,'pan_pdf'=>$PAN_pdf,
					  'passport_size_photo'=>$PSP_frontpath,'passport_size_photo_pdf'=>$PSP_pdf
					 ); 
 	  $this->db->where('g_uid',$user_id);
 	  if( $this->db->update('guest_user_profile',$values))
      {
        return true;
      }
      else
      {
        return false;
      }
		$this->db->query($query_insert);
  }  
	
	public function getGuestMobileno($user_id)  
  {  
    $query = $this->db->query("SELECT * FROM guest_user_profile where g_uid=".$user_id);
    return $query;  
  } 
	
	public function get_alluploadedImages($user_id)  
  {  
    $query = $this->db->query("SELECT * FROM guest_user_profile where g_uid=".$user_id);
    return $query;  
  }
	 public function getGuestuserinfo($user_id)  
  {  
    $query = $this->db->query("SELECT * FROM guest_user_info where g_uid=".$user_id);
    return $query;  
  } 
	
	   function select_info($table_name,$cond = array(),$order = array(),$page=0,$perpage=0)
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
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
	function select_PGownerEmail($user_id)
  {	
		$this->db->select('*');
		$this->db->from("guest_user_info AS GU");
		$this->db->join("pg_company AS PC", "PC.company_id=GU.company_id");
		$this->db->join("user_info AS UI", "UI.id=PC.user_id");
		$this->db->where("GU.g_uid", $user_id);
		$query = $this->db->get();
		return ($query->num_rows() > 0)?$query->result_array():FALSE;
	}
}
