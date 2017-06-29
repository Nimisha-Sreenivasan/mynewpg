<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyEmployee extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("pgadmin"); 
            $this->load->library("session");  
		}
	public function index() {
            
            $user_id = $this->session->userdata('user_id'); 
            $role_id = $this->session->userdata('role_id'); //die;
            $company_pg_employee = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));              
            
            if($role_id == ROLE_PG_ADMIN){ // for admin    
                
                if($company_pg_employee != FALSE){            
                $employee = $this->pgadmin->select_company_employee(array('cpe.pg_company_id'=>$company_pg_employee[0]['company_id']));
                
                if($employee != FALSE){                
                // get PG name
                    $data = $pg_name_dtl_raw = $pg_name_dtl = $employee_dtl =  array();
                            foreach ($employee as $key => $value) {
                                $pg_name_dtl_raw[$value['my_pg_id']]['pg_name'] = $value['pg_name'];
                                $pg_name_dtl_raw[$value['my_pg_id']]['my_pg_id'] = $value['my_pg_id'];
                            }
                            $i=0;
                            foreach ($pg_name_dtl_raw as $key => $value) {
                                $pg_name_dtl[$i]['pg_name'] = $value['pg_name'];
                                $pg_name_dtl[$i]['my_pg_id'] = $value['my_pg_id'];
                                $i++;
                            }
                    unset($pg_name_dtl_raw);
                    $data['pg_name_dtl'] = $pg_name_dtl;
                    $data['pg_employee_dtl'] = $employee;
					$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
            		$data['userdetails'] = $userdetails;

                     $this->load->view('pg_admin/viewemployee',$data);
                     unset($pg_name_dtl);
                     unset($employee); 
                    } 
                else {
					$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
           	      $data['userdetails'] = $userdetails;
                  $this->load->view('pg_admin/noemployee',$data);
                }
                 }
				else {
					$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
           	      $data['userdetails'] = $userdetails;
                  $this->load->view('pg_admin/nopg',$data);
                }
            } else if($role_id == ROLE_PG_MANAGER)
            {  // get the name of PG Manager associate   
                
               $employee = $this->pgadmin->select_company_employee(array('pge.user_id'=>$user_id)); 
               
               
               if($employee != FALSE){                
                // get PG name
                $data = $pg_name_dtl_raw = $pg_name_dtl = $employee_dtl =  array();
                        foreach ($employee as $key => $value) {
                            $pg_name_dtl_raw[$value['my_pg_id']]['pg_name'] = $value['pg_name'];
                            $pg_name_dtl_raw[$value['my_pg_id']]['my_pg_id'] = $value['my_pg_id'];
                        }
                        $i=0;
                        foreach ($pg_name_dtl_raw as $key => $value) {
                            $pg_name_dtl[$i]['pg_name'] = $value['pg_name'];
                            $pg_name_dtl[$i]['my_pg_id'] = $value['my_pg_id'];
                            $i++;
                        }
                    unset($pg_name_dtl_raw);
                    $data['pg_name_dtl'] = $pg_name_dtl;
                    $data['pg_employee_dtl'] = $employee;
					$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
            		$data['userdetails'] = $userdetails;
                     $this->load->view('pg_admin/viewemployee',$data);
                     unset($pg_name_dtl);
                     unset($employee); 
                    }
                else {
                        //print_r("Please add employee first");
				  $userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
           	      $data['userdetails'] = $userdetails;
                  $this->load->view('pg_admin/noemployee',$data);
                }
            }
           
        }
}