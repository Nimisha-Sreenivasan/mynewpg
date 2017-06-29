<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyPG extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("pgadmin"); 
	    $this->load->library('form_validation');
            $this->load->library("session");       
            $this->load->library("email");  
            $this->load->helper('date');
	    $this->load->library("pagination"); // pagination lib  load
	                         
        }
        public function index() {
            
        }
        public function details() {
	    
	    $data =  array();
            // check  for session  is available
            $user_id = $this->session->userdata('user_id');
			$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
            $data['userdetails'] = $userdetails;
            if(!isset($user_id)):
                redirect('PGownerLogin');
               return TRUE; 
            endif;            
            // check if user have company details
            $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
	    // Pagination start
	    $config = array();
	    $config["base_url"] = base_url() . "/pg_admin/MyPG/details/";
            $config["total_rows"] = $this->pgadmin->record_count('my_pgs',array('pg_company_id'=>$company_dtl[0]['company_id']));
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
	    $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);
	    $config['use_page_numbers'] = true; // use page numbers, or use the current row number (limit offset)
	    $page = ($this->uri->segment($config["uri_segment"] )) ? $this->uri->segment($config["uri_segment"] ) : 0;
	     $config['full_tag_open'] = '<ul class="uk-pagination uk-margin-medium-top">';
             $config['full_tag_close'] = '</ul>';
             $config['first_link'] = false;
             $config['last_link'] = false;
             $config['first_tag_open'] = '<li>';
             $config['first_tag_close'] = '</li>';
             $config['prev_link'] = '<i class="uk-icon-angle-double-left"></i>';
             $config['prev_tag_open'] = '<li class="prev">';
             $config['prev_tag_close'] = '</li>';
             $config['next_link'] = '<i class="uk-icon-angle-double-right"></i>';
             $config['next_tag_open'] = '<li><a href="#">';
             $config['next_tag_close'] = '</a></li>';
             $config['last_tag_open'] = '<li>';
             $config['last_tag_close'] = '</li>';
             $config['cur_tag_open'] = '<li class="uk-active"><span>';
             $config['cur_tag_close'] = '</span></li>';
             $config['num_tag_open'] = '<li>';
             $config['num_tag_close'] = '</li>';
	    
	    $this->pagination->initialize($config);
	    $this->data["pagination"] = $this->pagination->create_links();	    
	    
	    // END
            
            if($company_dtl == FALSE):
                $data['company_dtl']=array('status'=>'fail','msg'=>'please create your company profile');
              //  return TRUE;
            else:
                $company_id = $this->encrypt->encode($company_dtl[0]['company_id'], VERI_KEY);
                $data['company_dtl']=array('status'=>'success','msg'=>'','company_id'=>$company_id);
                
                $emp_array =  array();
                $company_emp_dtl = $this->pgadmin->select_info('pg_employee',array('status'=>1,'company_id'=>$company_dtl[0]['company_id']));
                if(count($company_emp_dtl) > 0 && $company_emp_dtl != FALSE){
                foreach ($company_emp_dtl as $key => $value) {
                   $emp_array[$key]['emp_id'] = $this->encrypt->encode($value['emp_id'], VERI_KEY);
                   $emp_array[$key]['emp_fname'] = $value['emp_fname'];
                   $emp_array[$key]['emp_lname'] = $value['emp_lname'];
                   $emp_array[$key]['company_employee_id'] = $value['company_employee_id'];
                }}
                $data['employee_detail'] = $emp_array;
                
                // get data for pg 
               $my_pg_dtl = $this->pgadmin->select_info('my_pgs',array('pg_company_id'=>$company_dtl[0]['company_id']),[],$page,$config["per_page"]);
               $data['my_pg_dtl'] = ($my_pg_dtl) ? $my_pg_dtl : 0;
            endif;
            $this->load->view('pg_admin/pgdetailslist',$data);
            
        }
        public function saveMyPg() {   
            $op['status'] = "";
            $op['msg'] = "";
            $user_id = $this->session->userdata('user_id');
			$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
            $data['userdetails'] = $userdetails;
            $role_id = $this->session->userdata('role_id');			
            $pg_name = $this->input->post('pg_name',TRUE);
            if(empty($user_id) || empty($role_id) || empty($pg_name)):
                $op['status'] = "fail";
                $op['msg'] = "Something Went Wrong";
                return TRUE;
            endif;
            // Add PG Branch
            $this->db->trans_start();
            $company_id = $this->encrypt->decode($this->input->post('company_id'),VERI_KEY);
			
			/* Set validation rule for name field in the form */ 
			$this->form_validation->set_rules('pg_name', 'PG Name', 'required'); 
			$this->form_validation->set_rules('pg_address_line_1', 'PG Address line 1', 'required'); 
			$this->form_validation->set_rules('pg_address_city', 'City', 'required'); 
			$this->form_validation->set_rules('pg_country', 'Country', 'required'); 
			$this->form_validation->set_rules('pg_address_state', 'State', 'required'); 
			$this->form_validation->set_rules('pg_address_pincode', 'PIN Code', 'required'); 
			
			if ($this->form_validation->run() == FALSE) { 
				$errorall =  validation_errors();
				$arr_err = array('status'=>'fail','msg'=>$errorall);
				 echo json_encode($arr_err);
				return false;
			} 
			
            $data_array =  array(
                'pg_company_id'=>  $company_id,
                'pg_name'=>  $this->input->post('pg_name',TRUE),
                'total_bed'=>  $this->input->post('total_bed',TRUE),
                'pg_country'=>  $this->input->post('pg_country',TRUE),
                'pg_address_state'=>  $this->input->post('pg_address_state',TRUE),
                'pg_address_pincode'=>  $this->input->post('pg_address_pincode',TRUE),
                'pg_address_line_1'=>  $this->input->post('pg_address_line_1',TRUE),
                'pg_address_line_2'=>  $this->input->post('pg_address_line_2',TRUE),
                'pg_address_city'=>  $this->input->post('pg_address_city',TRUE),
                'latitude'=>  $this->input->post('latitude',TRUE),
                'longitude'=>  $this->input->post('longitude',TRUE),
		'pg_bill_cycle_date'=>  $this->input->post('pg_bill_cycle_date',TRUE)
                );
            $data_array = array_filter($data_array); // filter array 
            $pg_id = $this->pgadmin->insert_info('my_pgs',$data_array);
	    
            // add employee in PG
            $addpgemployee = $this->input->post('addpgemployee');
            
            if(isset($addpgemployee) && isset($pg_id)):                
                foreach ($addpgemployee as $key => $value) {
                   $emp_id = $this->encrypt->decode($value,VERI_KEY);
                   if(isset($emp_id)):
                      $this->pgadmin->insert_info('company_pg_employee',array('pg_company_id'=>$company_id,'my_pg_id'=>$pg_id,'emp_id'=>(int)$emp_id)); 
                   endif;                   
                }                              
                
            endif;
            $this->db->trans_complete();   // check  transaction  
            if ($this->db->trans_status() === FALSE):
                        $this->db->trans_rollback();
                        $op['status'] = "fail";
                        $op['msg'] = "Something Went Wrong";
                    else:
                        $this->db->trans_commit();
				$company_emp_dtl = $this->pgadmin->select_last_row('pg_employee','emp_id',array('status'=>1,'company_id'=>$company_id));						
                        $op['status']="success";
				$op['data'] = $company_emp_dtl;
                        $op['msg']="PG Added Successfully";
                endif;
                
            echo json_encode($op);
            
        }
        
        public function addemployeedetail() {
            $op = array();
            $op['status'] = "";
            $op['msg'] = "";
            $user_id = $this->session->userdata('user_id');
			$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
            $data['userdetails'] = $userdetails;
            $emp_aadhar_number =$this->input->post('emp_aadhar_number',TRUE);
            $emp_email =$this->input->post('emp_email',TRUE);
            $emp_emg_no =$this->input->post('emp_emg_no',TRUE);
            $emp_fname =$this->input->post('emp_fname',TRUE);
            $emp_lname =$this->input->post('emp_lname',TRUE);
            $emp_mobile =$this->input->post('emp_mobile',TRUE);
            $emp_permanent_add =$this->input->post('emp_permanent_add',TRUE);
            $emp_present_add =$this->input->post('emp_present_add',TRUE);
            $role =$this->input->post('role',TRUE);
            $company_id =$this->encrypt->decode($this->input->post('company_id'), VERI_KEY) ;
            $company_id_dtl = $this->generateCompanyID($company_id);
            //print_r($company_id_dtl); 
            $company_employee_id ="";
                if( $company_id_dtl['status']== FALSE):
                    $op['status'] = "fail";
                    $op['msg'] = "Something Went Wrong";
                    echo json_encode($op);
                    return TRUE;
                endif;
            $company_employee_id = $company_id_dtl['empcode'];
                if(empty($company_id) || empty($user_id))
                {
                    $op['status'] = "fail";
                    $op['msg'] = "Something Went Wrong";
                    echo json_encode($op);
                    return TRUE;
                }            
            
            if($role == ROLE_PG_MANAGER) {
            //select email available in user_info
            $userinfo = $this->pgadmin->select_info('user_info',array('username'=>$emp_email,'email_id'=>$emp_email));
            if($userinfo == FALSE): // add new employee
                $ver_code = rand(0,9999);
                $data_user_info= array(
                    'username'=>$emp_email,
                    'email_id'=>$emp_email,
                    'password'=>md5($ver_code),
                    'role_id'=>$role,
                    'emailver_code'=>$ver_code
                );
                    $user_id_new = $this->pgadmin->insert_info('user_info',$data_user_info);
                    if(isset($user_id_new)) :                    
                
                        $data_user_profile =  array(
                            'user_id'=>$user_id_new,
                            'first_name'=>$emp_fname,
                            'last_name'=>$emp_lname,
                            'mobile_no'=>$emp_mobile,
                            'adharno'=>$emp_aadhar_number
                        );
                        $this->pgadmin->insert_info('user_profile',$data_user_profile);
                        // send verification email 
                        if($this->sendverificationEmail($emp_fname,$emp_email,$user_id_new,$ver_code)): // verification email sent sucessfully
                            $op['status']="success";
                            $op['msg'] = "Verification Mail Send Successfull to your Manager";                          
                            
                            else: // generate Ticket
                               
                        endif;                           
                    // insert details in pg_employee
                            $data_array = array(
                            'company_employee_id'=>$company_employee_id,
                            'emp_aadhar_number'=> $emp_aadhar_number,
                            'emp_email'=>$emp_email,
                            'emp_emg_no'=>$emp_emg_no,
                            'emp_fname'=>$emp_fname,
                            'emp_lname'=>$emp_lname,
                            'emp_mobile'=>$emp_mobile,
                            'emp_permanent_add'=>$emp_permanent_add,
                            'emp_present_add'=>$emp_present_add,
                            'role'=>$role,
							'user_id'=>$user_id_new,
                            'added_by'=>$user_id,
                            'company_id'=>$company_id
                            );
                            $data_array = array_filter($data_array); // filter array 
                            $emp_id = $this->pgadmin->insert_info('pg_employee',$data_array);
                            
                    endif;
                else: // allready added user with this email
                    $op['status']="confuse";
                    $op['msg'] = "<p>This Email allready registered</p>";
            endif;
            } else if($role == ROLE_PG_CARETAKER)
            {
                
                $data_array = array(
                    'company_employee_id'=> $company_employee_id,
                    'emp_aadhar_number'=> $emp_aadhar_number,
                    'emp_email'=>$emp_email,
                    'emp_emg_no'=>$emp_emg_no,
                    'emp_fname'=>$emp_fname,
                    'emp_lname'=>$emp_lname,
                    'emp_mobile'=>$emp_mobile,
                    'emp_permanent_add'=>$emp_permanent_add,
                    'emp_present_add'=>$emp_present_add,
                    'role'=>$role,
                    'added_by'=>$user_id,
                    'company_id'=>$company_id
                    );
                $data_array = array_filter($data_array); // filter array 
                $user_id = $this->pgadmin->insert_info('pg_employee',$data_array);
                $op['status']="success";
                $op['msg'] = "Caretaker added Successfully Employee Code:".$company_employee_id;                          
            }
            
            if($op['status'] == "success"):
                // get the list of employee who are registered
                $emp_array =  array();
                $company_emp_dtl = $this->pgadmin->select_info('pg_employee',array('status'=>1,'company_id'=>$company_id));
                foreach ($company_emp_dtl as $key => $value) {
                   $emp_array[$key]['emp_id'] = $this->encrypt->encode($value['emp_id'], VERI_KEY);
                   $emp_array[$key]['emp_fname'] = $value['emp_fname'];
                   $emp_array[$key]['emp_lname'] = $value['emp_lname'];
                   $emp_array[$key]['company_employee_id'] = $value['company_employee_id'];
                }
                $op['emp_data'] = $emp_array;
            endif;
            
            echo json_encode($op);
            
        }
	
        function sendverificationEmail($emp_fname,$email_to,$user_id,$code) {
            // load encryption library
            
            $msg= "userid=".$user_id."&code=".$code;
            
            $encrypted_string = $this->encrypt->encode($msg, VERI_KEY);
            
            $verlink = base_url()."PGownerLogin/emailVerification?rand=".$encrypted_string;
            
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$config['smtp_port']=EMAIL_PORT;
			$config['smtp_timeout'] = 5;
			$config['charset']='utf-8'; // Default should be utf-8 (this should be a text field) 
			$config['newline']="\r\n"; //"\r\n" or "\n" or "\r". DEFAULT should be "\r\n" 
			$config['crlf'] = "\r\n"; //"\r\n" or "\n" or "\r" DEFAULT should be "\r\n" 

			$config['charset']='utf-8';
			$config['protocol'] = 'smtp';
			$config['smtp_crypto'] = 'ssl';

			$config['smtp_host'] = EMAIL_SMTP_HOST;
			$config['smtp_user'] = EMAIL_FROM;
			$config['smtp_pass'] = EMAIL_PWD;


			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		$path = 'JSON_DATA/email/1005.json';
		if(file_exists($path))
                {
			$json_file = file_get_contents($path);
		       // convert the string to a json object
		       $jfo = json_decode($json_file);
		       
		       $msg = str_replace(array("[PGMANAGER]","[VERIFICATION_LINK]","[BASEIMAGEURL]"), array($emp_fname,$verlink,asset_url()), $jfo->template->body_en); //  msg creation
					 
					 
		       $this->email->from(EMAIL_FROM, EMAIL_FROM_NAME);
		       $this->email->to($email_to);
		       //$this->email->cc('email1@test.com,email2@test.com,email3@test.com');
		       $this->email->subject($jfo->template->subject_en); 				  
				       $this->email->message($msg);
				       $this->email->set_newline("\r\n");
		       if (!$this->email->send()) {
			 show_error($this->email->print_debugger());
			 return FALSE;
			 }
		       else {
			return TRUE;
       //                  echo 'Your e-mail has been sent!';
		       }
               }
	      
               
        }
        function generateCompanyID($company_id) {
            
            $prefix = "";
            $company_details =  $this->pgadmin->select_info('pg_company',array('company_id'=>$company_id));
            
            if($company_details == FALSE):
                return array('status'=>FALSE,'msg'=>'Please complete your company profile.');
            else:
                $company_name = str_replace(" ", "", $company_details[0]['company_name']);
                if(!empty($company_name)):
                  $prefix =  strtoupper(substr($company_name, 0, 3));
                  $employees =$this->pgadmin->select_last_record('pg_employee','emp_id','DESC');                  
                    if(count($employees) > 0 && $employees != FALSE) :                          
                        $empcode = $prefix."".sprintf('%06d',(++$employees[0]['emp_id']));
                      return  array('status'=>TRUE,'empcode'=>$empcode);
                        else :
                         $empcode = $prefix."".sprintf('%06d',(1));
                      return  array('status'=>TRUE,'empcode'=>$empcode);
                    endif;
                  endif;
                
            endif;
            
        }
	/* Edit PG page 
	 *@Parama
	 **/ 
	function editpg($id=0){ 
		$user_id = $this->session->userdata('user_id');
		$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
        $data['userdetails'] = $userdetails;
		 if(isset($user_id)): 
			$data['pgdata'] = $this->pgadmin->select_info('my_pgs',array('mypg_id'=>$id));
			$data['company_id'] = $this->encrypt->encode($data['pgdata'][0]['pg_company_id'], VERI_KEY);
			$emp_array =  array();
			
			// company pg employee mapping for checkbox
			 $com_pg_emp = array();
			$company_pg_employee = $this->pgadmin->select_info('company_pg_employee',array('pg_company_id'=>$data['pgdata'][0]['pg_company_id'],'my_pg_id'=>$id));
			if(count($company_pg_employee) > 0 && $company_pg_employee != FALSE){
			    
			     foreach ($company_pg_employee as $cpmkey => $cpmvalue) {
				$com_pg_emp[] = $cpmvalue['emp_id'];
				
			     }
			}
			
			$company_emp_dtl = $this->pgadmin->select_info('pg_employee',array('status'=>1,'company_id'=>$data['pgdata'][0]['pg_company_id']));
			if(count($company_emp_dtl) > 0 && $company_emp_dtl != FALSE){
			foreach ($company_emp_dtl as $key => $value) {
			
			   $emp_array[$key]['emp_id'] = $this->encrypt->encode($value['emp_id'], VERI_KEY);
			   $emp_array[$key]['emp_checked'] = (in_array($value['emp_id'],$com_pg_emp)) ? true : false;
			   $emp_array[$key]['emp_fname'] = $value['emp_fname'];
			   $emp_array[$key]['emp_lname'] = $value['emp_lname'];
			   $emp_array[$key]['company_employee_id'] = $value['company_employee_id'];
			}}
			$data['employee_detail'] = $emp_array;			
			
			
			
			
			
			//print_r($com_pg_emp);
			
			$data['company_pg_employee'] = $com_pg_emp;
			
			$this->load->view('pg_admin/editpg',$data);
		else :
		    redirect('PGownerLogin');
		    return TRUE;   
		endif;
	}
	
	public function editemployeedetail(){
		
		$emp_id = $this->encrypt->decode($this->input->post('id'),VERI_KEY);
		 $op = array();
		if($emp_id):
		     $pg_emp_details = $this->pgadmin->select_info('pg_employee',array('emp_id'=>$emp_id));
		     $op['status']="success";
		     $op['data'] = $pg_emp_details;
		else:
		    $op['status'] = "fail";
                    $op['msg'] = "Something Went Wrong";
                    
		endif;
		echo json_encode($op);
	}
	// Update page details
	public function UpdateMyPg() {
		
            $op['status'] = "";
            $op['msg'] = "";
            $user_id = $this->session->userdata('user_id');
            $role_id = $this->session->userdata('role_id');			
            $pg_name = $this->input->post('pg_name',TRUE);
            if(empty($user_id) || empty($role_id) || empty($pg_name)):
                $op['status'] = "fail";
                $op['msg'] = "Something Went Wrong";
                return TRUE;
            endif;
            // Update PG Branch
            $this->db->trans_start();
		$company_id = $this->encrypt->decode($this->input->post('company_id'),VERI_KEY);
			
		/* Set validation rule for name field in the form */ 
		$this->form_validation->set_rules('pg_name', 'PG Name', 'required'); 
		$this->form_validation->set_rules('pg_address_line_1', 'PG Address line 1', 'required'); 
		$this->form_validation->set_rules('pg_address_city', 'City', 'required'); 
		$this->form_validation->set_rules('pg_country', 'Country', 'required'); 
		$this->form_validation->set_rules('pg_address_state', 'State', 'required'); 
		$this->form_validation->set_rules('pg_address_pincode', 'PIN Code', 'required'); 
		
		if ($this->form_validation->run() == FALSE) { 
			$errorall =  validation_errors();
			$arr_err = array('status'=>'fail','msg'=>$errorall);
			 echo json_encode($arr_err);
			return false;
		} 
		$mypg_id = $this->input->post('mypg_id',true);	
		$data_array =  array(		
                'pg_name'=>  $this->input->post('pg_name',TRUE),
                'total_bed'=>  $this->input->post('total_bed',TRUE),
                'pg_country'=>  $this->input->post('pg_country',TRUE),
                'pg_address_state'=>  $this->input->post('pg_address_state',TRUE),
                'pg_address_pincode'=>  $this->input->post('pg_address_pincode',TRUE),
                'pg_address_line_1'=>  $this->input->post('pg_address_line_1',TRUE),
                'pg_address_line_2'=>  $this->input->post('pg_address_line_2',TRUE),
                'pg_address_city'=>  $this->input->post('pg_address_city',TRUE),
                'latitude'=>  $this->input->post('latitude',TRUE),
                'longitude'=>  $this->input->post('longitude',TRUE),
		'pg_bill_cycle_date' => $this->input->post('pg_bill_cycle_date',TRUE)
                );
	    // Update PG data 
             $data_array = array_filter($data_array); // filter array
	     $this->pgadmin->update_info('my_pgs',$data_array,array('mypg_id'=>$mypg_id));
            
            // Delte old data and add employee in PG
            $addpgemployee = $this->input->post('addpgemployee');
            
            if(isset($addpgemployee) && isset($mypg_id)):
	    
		// first of all Delete all data of pg and insert new record
		$this->pgadmin->delete_info('company_pg_employee',array('pg_company_id'=>$company_id,'my_pg_id'=>$mypg_id));
		
                foreach ($addpgemployee as $key => $value) {
                   $emp_id = $this->encrypt->decode($value,VERI_KEY);
                   if(isset($emp_id)):
                      $this->pgadmin->insert_info('company_pg_employee',array('pg_company_id'=>$company_id,'my_pg_id'=>$mypg_id,'emp_id'=>(int)$emp_id)); 
                   endif;                   
                }   
            endif;
	    
            $this->db->trans_complete();   // check  transaction  
            if ($this->db->trans_status() === FALSE):
                        $this->db->trans_rollback();
                        $op['status'] = "fail";
                        $op['msg'] = "Something Went Wrong";
                    else:
                        $this->db->trans_commit();
				$company_emp_dtl = $this->pgadmin->select_last_row('pg_employee','emp_id',array('status'=>1,'company_id'=>$company_id));						
                        $op['status']="success";
				$op['data'] = $company_emp_dtl;
                        $op['msg']="PG updated Successfully";
                endif;
                
            echo json_encode($op);
            
        }
	// Function to Delete pg selected record from database.
	function deletePG($id) {			
		$this->pgadmin->delete_info('my_pgs',array('mypg_id'=>$id));
		
		echo json_encode(array("success" => true)); 
	}
	
	public function updateemployeedetail(){
	    $op = array();
            $op['status'] = "";
            $op['msg'] = "";
            $user_id = $this->session->userdata('user_id');
	    $emp_id = $this->input->post('emp_id',TRUE);     
            $emp_aadhar_number =$this->input->post('emp_aadhar_number',TRUE);            
            $emp_emg_no =$this->input->post('emp_emg_no',TRUE);
            $emp_fname =$this->input->post('emp_fname',TRUE);
            $emp_lname =$this->input->post('emp_lname',TRUE);
            $emp_mobile =$this->input->post('emp_mobile',TRUE);
            $emp_permanent_add =$this->input->post('emp_permanent_add',TRUE);
            $emp_present_add =$this->input->post('emp_present_add',TRUE);
           
            $data_array = array(                    
                    'emp_aadhar_number'=> $emp_aadhar_number,
                    'emp_emg_no'=>$emp_emg_no,
                    'emp_fname'=>$emp_fname,
                    'emp_lname'=>$emp_lname,
                    'emp_mobile'=>$emp_mobile,
                    'emp_permanent_add'=>$emp_permanent_add,
                    'emp_present_add'=>$emp_present_add,                   
                    );
            $this->pgadmin->update_info('pg_employee',$data_array,array('emp_id'=>$emp_id));
	    $op['status']="success";
            echo json_encode($op);
	}
}