<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("pgadmin"); 
            $this->load->library("session");       
            $this->load->library("email");  
                     
        }
         public function index() {
             $account_uid = $this->session->userdata('user_id');
             $profile_uid =  $this->uri->segment(4); 
             
             $user_info = $this->pgadmin->select_employee_profile(array('mpg.user_id'=>$profile_uid));
             $profile_info =  array();
             foreach ($user_info as $key => $value) {
              $profile_info['pg_company_id'] =  $value['pg_company_id'];   
              $profile_info['my_pg_id'] =  $value['my_pg_id'];   
              $profile_info['company_employee_id'] =  $value['company_employee_id'];   
              $profile_info['emp_fname'] =  $value['emp_fname'];   
              $profile_info['emp_lname'] =  $value['emp_lname'];   
              $profile_info['profile_pic'] =  $value['profile_pic'];   
              $profile_info['emp_email'] =  $value['emp_email'];   
              $profile_info['emp_mobile'] =  $value['emp_mobile'];   
              $profile_info['emp_emg_no'] =  $value['emp_emg_no'];   
              $profile_info['emp_permanent_add'] =  $value['emp_permanent_add'];   
              $profile_info['emp_present_add'] =  $value['emp_present_add'];   
              $profile_info['emp_aadhar_number'] =  $value['emp_aadhar_number'];   
              $profile_info['role'] =  $value['role'];   
              $profile_info['profile_id'] =  $value['profile_id'];   
              $profile_info['adress_up'] =  $value['adress_up'];   
              $profile_info['area_up'] =  $value['area_up'];   
              $profile_info['city_up'] =  $value['city_up'];   
              $profile_info['state_up'] =  $value['state_up'];   
              $profile_info['pincode_up'] =  $value['pincode_up'];   
//              $profile_info['profile_pic_up'] = !empty($value['profile_pic_up']) ? $value['profile_pic_up'] : "";  
              if($value['role']== ROLE_PG_ADMIN || $value['role']== ROLE_PG_MANAGER ){
                  $profile_info['pic'] = !empty($value['profile_pic_up']) ? $value['profile_pic_up'] : "";   
                  $profile_info['pofile_address'] = $value['adress_up'];   
                  $profile_info['pofile_area_up'] = $value['area_up'];   
                  $profile_info['pofile_city_up'] = $value['city_up'];   
                  $profile_info['pofile_state_up'] = $value['state_up'];   
                  $profile_info['pofile_pincode_up'] = $value['pincode_up'];   
              } else {
                   $profile_info['pic'] = !empty($value['profile_pic']) ? $value['profile_pic'] : "";   
              }
              
             }
             unset($user_info);
             $data['profile_info']=$profile_info;
			 $userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$account_uid));   
           	 $data['userdetails'] = $userdetails;
             $this->load->view('pg_admin/userprofile',$data);
        }
}