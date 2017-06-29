<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("pgadmin"); 
//            $this->load->database();
            $this->load->library('form_validation');
            $this->load->library("session");       
            $this->load->library('encrypt'); 
                     
        }
	public function index()
	{
         /*   $data = array();
            // check  for session  is available
            $user_id = $this->session->userdata('user_id');
            $role_id = $this->session->userdata('role_id'); 
            if(!isset($user_id)):
                redirect('registration/pglogin');
               return TRUE; 
            endif;
            
            
                // check if PG ADMIN have company details
                $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
                if($company_dtl == FALSE && $role_id == ROLE_PG_ADMIN):
                    $this->load->view('pg_admin/company_profile_first_visit',$data);
                    return TRUE;
                else:
                    $this->load->view('pg_admin/dashboard',$data);
                endif;
            */
		
		    $user_id = $this->session->userdata('user_id');
            $userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
            $data['userdetails'] = $userdetails;
            if(isset($user_id)):
                $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
                $userEmail = $this->pgadmin->select_info('user_info',array('id'=>$user_id));
                $getTotalBed = $this->pgadmin->select_info('my_pgs',array('pg_company_id'=>$company_dtl[0]['company_id']));
				$companyID=$company_dtl[0]['company_id'];
                if(!empty($companyID) && !empty($getTotalBed)){
                $getTotalBeds = $this->pgadmin->calculateTotalBed($companyID);
				foreach ($getTotalBeds->result() as $row)
					{
					$calculateTotalBeds = $row->value_sum;
					}
                
                $data['userEmail'] = $userEmail;
                $data['getTotalBed'] = $getTotalBed;
                $data['calculateTotalBeds'] = $calculateTotalBeds;
                }else{
					   $data['userEmail'] = $userEmail;
					   $data['getTotalBed'] = 0;
                       $data['calculateTotalBeds'] = 0;
				}
				$data['companyLogo']=$company_dtl[0]['company_logo'];
                $data['images']=array('company_logo'=>  empty($company_dtl[0]['company_logo'])? "": asset_url("company_logo/".$company_dtl[0]['company_logo']));
                ///var/www/ourpg.co/public_html/CodeIgniter/assets/company_logo
                $data['company_dtl'] = $company_dtl;
                $data['secured_data'] = array(
                                            'company_id'=>$this->encrypt->encode($company_dtl[0]['company_id'], VERI_KEY)                                            
                                            );
		// State & city
		$path = 'state_city/cities.json';
		if(file_exists($path)):
	           $json_file = file_get_contents($path);
		   // convert the string to a json object
                   //Decode JSON
			$json_data = json_decode($json_file,true);
			
			$tmp = array();
			foreach($json_data as $jsondata)
			{
			    $tmp[$jsondata['state']][] = $jsondata['name'];
			}
			foreach($tmp as $type => $labels)
			{
			    $output[] = $type;
			}
			
			$data['state'] = $output;
		endif;
		
                
                $this->load->view('pg_admin/company_profile',$data);
            else :
                redirect('PGownerLogin');
                return TRUE;   
            endif;    
	}
        
	public function saveCompanyDetails() {
            $op = array();
            $user_id = $this->session->userdata('user_id');
            
            if(isset($user_id)):
            $company_name = $this->input->post('company_name',TRUE);   
            //$company_PAN = $this->input->post('company_PAN',TRUE);   
           // $company_service_tx_no = $this->input->post('company_service_tx_no',TRUE);   
           // $company_tan = $this->input->post('company_tan',TRUE);   
           // $company_email = $this->input->post('company_email',TRUE);   
           // $company_contact_no = $this->input->post('company_contact_no',TRUE);   
            $company_website = $this->input->post('company_website',TRUE);   
            $company_address = $this->input->post('company_address',TRUE);   
            $company_city = $this->input->post('company_city',TRUE);   
            $company_state = $this->input->post('company_state',TRUE);   
            $company_pin_code = $this->input->post('company_pin_code',TRUE);   
            $company_police_station_name = $this->input->post('company_police_station_name',TRUE);   
            $enc_company_id = $this->input->post('company_id',TRUE); 
            $company_id = isset($enc_company_id) ? $this->encrypt->decode($enc_company_id, VERI_KEY) :"";
           
             /* Set validation rule for name field in the form */ 
			$this->form_validation->set_rules('company_name', 'Company Name', 'required'); 
			$this->form_validation->set_rules('company_address', 'Company Address', 'required'); 
			$this->form_validation->set_rules('company_city', 'City', 'trim|required'); 
			$this->form_validation->set_rules('company_state', 'State', 'trim|required'); 
			$this->form_validation->set_rules('company_pin_code', 'Zip code', 'trim|numeric|required'); 
			//$this->form_validation->set_rules('company_PAN', 'Company PAN', 'trim|required|xss_clean|regex_match[/^[A-Z]{5}\d{4}[A-Z]{1}$/]'); 
			//$this->form_validation->set_rules('company_email', 'Company email address', 'trim|required|xss_clean|regex_match[/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/]'); 
			//$this->form_validation->set_rules('company_contact_no', 'Contact No', 'trim|numeric|required'); 
			
			if ($this->form_validation->run() == FALSE) { 
				$errorall =  validation_errors();
				$arr_err = array('status'=>'fail','errordata'=>$errorall);
				 echo json_encode($arr_err);
				return false;
			} 
			
            $data_array =  array(
                                'user_id'=>$user_id,
                                'company_name'=>$company_name,
                                //'company_PAN'=>$company_PAN,
                                //'company_service_tx_no'=>$company_service_tx_no,
                               // 'company_tan'=>$company_tan,
                               // 'company_email'=>$company_email,
                               // 'company_contact_no'=>$company_contact_no,
                                'company_website'=>$company_website,
                                'company_address'=>$company_address,
                                'company_city'=>$company_city,
                                'company_state'=>$company_state,
                                'company_pin_code'=>$company_pin_code,
                                'company_police_station_name'=>$company_police_station_name
                    );
            $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
			$userEmail = $this->pgadmin->select_info('user_info',array('id'=>$user_id));
                if($company_dtl == FALSE):
                   // insert new record 
                   $company_id = $this->pgadmin->insert_info('pg_company',$data_array);
                   $encrypted_company_id = $this->encrypt->encode($company_id, VERI_KEY);
                   $op['record_id'] = $encrypted_company_id;
				    $op['insertorupdate'] ="inserted";
                   $op['status'] = isset($company_id) ?"success" : "fail";
                else:
                    // update record
                    $this->pgadmin->update_info('pg_company',$data_array,array('user_id'=>$user_id,'company_id'=>$company_id));
                    $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id,'company_id'=>$company_id));
					$userEmail = $this->pgadmin->select_info('user_info',array('id'=>$user_id));
            		$op['userEmail'] = $userEmail;
                    $encrypted_company_id = $this->encrypt->encode($company_dtl[0]['company_id'], VERI_KEY);
                    $op['record_id'] = $encrypted_company_id;
					$op['insertorupdate'] ="updated";
                    $op['status'] = isset($company_dtl[0]['company_id']) ?"success" : "fail";
                endif;
            
            
            endif;
            echo json_encode($op);   
        }
   /* public function saveCompanyBankAddress() {
            $op = array();
            $user_id = $this->session->userdata('user_id');
            
            if(isset($user_id)):
            $company_address = $this->input->post('company_address',TRUE);   
            $company_bank_acc_no = $this->input->post('company_bank_acc_no',TRUE);   
            $company_bank_name = $this->input->post('company_bank_name',TRUE);   
            $company_city = $this->input->post('company_city',TRUE);   
            $company_state = $this->input->post('company_state',TRUE);   
            $company_ifsc = $this->input->post('company_ifsc',TRUE);   
            $company_pin_code = $this->input->post('company_pin_code',TRUE);   
            $enc_company_id = $this->input->post('company_id',TRUE); 
            $company_id = isset($enc_company_id) ? $this->encrypt->decode($enc_company_id, VERI_KEY) :"";
           
             /* Set validation rule for name field in the form */ 
		/*	$this->form_validation->set_rules('company_address', 'Company Address', 'required'); 
			$this->form_validation->set_rules('company_city', 'City', 'trim|required'); 
			$this->form_validation->set_rules('company_state', 'State', 'trim|required'); 
			$this->form_validation->set_rules('company_pin_code', 'Zip code', 'trim|numeric|required'); 
			$this->form_validation->set_rules('company_bank_name', 'Company Bank Name', 'trim|required'); 
			$this->form_validation->set_rules('company_bank_acc_no', 'Bank Account No.', 'trim|required');
			$this->form_validation->set_rules('company_ifsc', 'Bank IFSC Code.', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) { 
				$errorall =  validation_errors();
				$arr_err = array('status'=>'fail','errordata'=>$errorall);
				 echo json_encode($arr_err);
				return false;
			} 
			
            $data_array =  array(
                                'user_id'=>$user_id,
                                'company_address'=>$company_address,
                                'company_bank_acc_no'=>$company_bank_acc_no,
                                'company_bank_name'=>$company_bank_name,
                                'company_city'=>$company_city,
                                'company_state'=>$company_state,
                                'company_ifsc'=>$company_ifsc,
                                'company_pin_code'=>$company_pin_code
                    );
            $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
                if($company_dtl == FALSE):
                   // insert new record 
                   $company_id = $this->pgadmin->insert_info('pg_company',$data_array);
                   $encrypted_company_id = $this->encrypt->encode($company_id, VERI_KEY);
                   $op['record_id'] = $encrypted_company_id;
                   $op['status'] = isset($company_id) ?"success" : "fail";
                else:
                    // update record
                    $this->pgadmin->update_info('pg_company',$data_array,array('user_id'=>$user_id,'company_id'=>$company_id));
                    $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id,'company_id'=>$company_id));
                    $encrypted_company_id = $this->encrypt->encode($company_dtl[0]['company_id'], VERI_KEY);
                    $op['record_id'] = $encrypted_company_id;
                    $op['status'] = isset($company_dtl[0]['company_id']) ?"success" : "fail";
                endif;
            
            
            endif;
            echo json_encode($op);
            
            
        }*/
    public function companyprofile() {
            
            $user_id = $this->session->userdata('user_id');
            
		
            if(isset($user_id)):
                $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
				$userEmail = $this->pgadmin->select_info('user_info',array('id'=>$user_id));
            	$data['userEmail'] = $userEmail;
                $userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));
                
               	$data['userdetails'] = $userdetails;
                $data['images']=array('company_logo'=>  empty($company_dtl[0]['company_logo'])? "": asset_url("company_logo/".$company_dtl[0]['company_logo']));
                ///var/www/ourpg.co/public_html/CodeIgniter/assets/company_logo
                $data['company_dtl'] = $company_dtl;
                $data['secured_data'] = array(
                                            'company_id'=>$this->encrypt->encode($company_dtl[0]['company_id'], VERI_KEY)                                            
                                            );
		// State & city
		$path = 'state_city/cities.json';
		if(file_exists($path)):
	           $json_file = file_get_contents($path);
		   // convert the string to a json object
                   //Decode JSON
			$json_data = json_decode($json_file,true);
			
			$tmp = array();
			foreach($json_data as $jsondata)
			{
			    $tmp[$jsondata['state']][] = $jsondata['name'];
			}
			foreach($tmp as $type => $labels)
			{
			    $output[] = $type;
			}
			
			$data['state'] = $output;
		endif;
		
                
                $this->load->view('pg_admin/company_profile',$data);
            else :
                redirect('PGownerLogin');
                return TRUE;   
            endif;
        }
	public function CityListBystate(){
		echo '<option value="a">Item A</option>';
	}
    public function saveCompanyLogo() {
		$user_id = $this->session->userdata('user_id');
		$flag = "update";
		$company_id = $this->encrypt->decode($this->input->post('profile_id'), VERI_KEY) ;
		$img_name = $this->input->post('img_name');
		$message = "";
		
		if(empty($company_id)){
		   $company_dtl =  $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
		   $company_id = empty($company_dtl[0]['company_id']) ? "":$company_dtl[0]['company_id'];
		}
		
		if (empty($company_id) || empty($img_name))
		{
			$message = '<div class="alert alert-info">
						<strong>Info!</strong> No Information updated.</div>';  
			
			if(!empty($img_name)){
				$flag = "insert";
			} else{
				echo $message;
			   return TRUE; 
			}                
		}            
		
		$command = 'mv '.COMPANY_LOGO_TEMP_PATH.'/'.$img_name.' '.COMPANY_LOGO_PATH;
	   
		$output = shell_exec($command);
		
		if (empty($output)){
		$message .='<div class="alert alert-success"><strong>Success!</strong> Profile image updated successfully.</div>';  
			if($flag == "update"){
			   $this->pgadmin->update_info("pg_company",array('company_logo'=>$img_name),array("company_id"=>$company_id)); 
			} else{
				 $this->pgadmin->insert_info("pg_company",array('company_logo'=>$img_name,"user_id"=>$user_id)); 
			}
		
		} else {$message .='<div class="alert alert-info">
						<strong>Info!</strong>'.$output.'</div>';     }

		echo $message;
	}
    public function skipaddcompany() {
		
		$user_id = $this->session->userdata('user_id');
		
		if(isset($user_id)):
			$company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
		  if($company_dtl == FALSE):
			  $company_id = $this->pgadmin->insert_info('pg_company',array('user_id'=>$user_id));
		  endif;
			
		endif;
		echo json_encode(array('status'=>'success','URL'=> base_url().'pg_admin/dashboard/'));
	}
	public function checkOldPass()
	{
		
		
		$user_id = $this->session->userdata('user_id');
		if(isset($user_id)):		
			$this->db->select('id');
			$this->db->where('id',$this->session->userdata('user_id'));
			$this->db->where('password',md5($this->input->post('password')));
			$query=$this->db->get('user_info');
			
			if($query->num_rows() > 0)
				 echo "true";
			else
				echo "false";
			
		else:
			echo "false";		
		endif;
	}

	public function changePassword() {
		$op = array();
        $user_id = $this->session->userdata('user_id');
		
		if(isset($user_id)):
			$password = $this->input->post('password',TRUE);   
            $new_password = $this->input->post('new_password',TRUE);   
			$confirm_password = $this->input->post('confirm_password',TRUE);  
			
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'required|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
			
			if ($this->form_validation->run() == FALSE) { 
				$errorall =  validation_errors();
				$arr_err = array('status'=>'fail','errordata'=>$errorall);
				echo json_encode($arr_err);
				return false;
			}
			$data_array =  array(
                                'password'=>md5($new_password),                                
                    );
			$this->pgadmin->update_info('user_info',$data_array,array('id'=>$user_id));
			$arr_data = array('status'=>'success','msg'=>'Your Password Changed Successfully');
			 
		else:
			$arr_data = array('status'=>'fail','msg'=>'Something Went Wrong, Password Not Changed');			
		endif;
		echo json_encode($arr_data);
		
	}
	
	public function addFeatureList(){
 	$user_id = $this->session->userdata('user_id');
	$profile_id= $this->input->post('profile_id',TRUE);
	$company_id = isset($profile_id) ? $this->encrypt->decode($profile_id, VERI_KEY) :"";//get company id
	$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
    $data['userdetails'] = $userdetails;
	$f1= $this->input->post('f1',TRUE);
	$f2= $this->input->post('f2',TRUE);
	$f3= $this->input->post('f3',TRUE);
	$f4= $this->input->post('f4',TRUE);
	$f5= $this->input->post('f5',TRUE);
	$f6= $this->input->post('f6',TRUE);
	$f7= $this->input->post('f7',TRUE);
	$f8= $this->input->post('f8',TRUE);
	$f9= $this->input->post('f9',TRUE);
	$f10= $this->input->post('f10',TRUE);
	$f11= $this->input->post('f11',TRUE);
	$enc_company_id = $this->input->post('company_id',TRUE); 
    $encrypted_company_id = $this->encrypt->encode($company_id, VERI_KEY);
    $data['record_id'] = $encrypted_company_id; 
	
   $this->pgadmin->addFeaturelistdata($f1,$f2,$f3,$f4,$f5,$f6,$f7,$f8,$f9,$f10,$f11,$company_id);		
   $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id,'company_id'=>$company_id));
   $userEmail = $this->pgadmin->select_info('user_info',array('id'=>$user_id));
   $data['userEmail'] = $userEmail;
   $data['company_dtl'] = $company_dtl;	
   $data['secured_data'] = array('company_id'=>$this->encrypt->encode($company_dtl[0]['company_id'], VERI_KEY));
   echo json_encode($data);
 //$this->load->view('pg_admin/company_profile',$data);
   } 
	
	
	public function profileUpload(){
		 
		 $user_id = $this->session->userdata('user_id');
		 $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
          $logo=$company_dtl[0]['company_logo'];		 
		/* $profilePath = FCPATH.'application/images/profile';//profile photo
		if (!file_exists($profilePath)) {
		mkdir(FCPATH.'application/images/profile');
		chmod($profilePath, 0777);
		}
*/
		if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){		

		$config = array(
                'upload_path' => 'assets/company_logo',
                'log_threshold' => 1,
                'allowed_types' => 'jpg|png|jpeg',
                'max_size' => '0',
                'overwrite' => false
            );
		$this->load->library('upload', $config);
		$filename =  $_FILES['file']['name'];
		$getfileName_withoutext = pathinfo($filename, PATHINFO_FILENAME );
		$getfileName_withext = pathinfo($filename, PATHINFO_EXTENSION);
		$newname = $getfileName_withoutext."_".date('m-d-Y_H:i:s').'.'.$getfileName_withext;
		


	$_FILES['userFile']['name'] = $newname;
    $_FILES['userFile']['type'] = $_FILES['file']['type'];
    $_FILES['userFile']['tmp_name'] = $_FILES['file']['tmp_name'];
    $_FILES['userFile']['error'] = $_FILES['file']['error'];
    $_FILES['userFile']['size'] = $_FILES['file']['size'];
		
		
	$Ufile_name = 	$_FILES['file']['name'];
	$Ufile_type = 	$_FILES['file']['type'];
	$ext= strtolower((pathinfo($Ufile_name, PATHINFO_EXTENSION)));

		if ( $ext!= "jpg" && $ext != "png" && $ext != "jpeg" )
		{
		$data["error"] = "ERROR!!! Only .jpg, .png and .jpeg Extention Are Allowed.";
		$error = true;
		}else{
		$data["error"] = "";
		$error = false;
		}
		
		
    $this->upload->initialize($config);
		
	if ($this->upload->do_upload('file'))
        {	
          $data['uploads'] = $this->upload->data();

			$profileimage = $data['uploads']['file_name'];
			$profilefull_path = $data['uploads']['full_path'];
			$profile_path = $profileimage;
			$data_array =  array(
                                'user_id'=>$user_id,
                                'company_logo'=>$profile_path
                                
                    );
            if($logo!=""){
				unlink(FCPATH.$logo);
			}
		 	
			if($company_dtl == FALSE){
                   // insert new record 
                   $company_id = $this->pgadmin->insert_info('pg_company',$data_array);
                   $encrypted_company_id = $this->encrypt->encode($company_id, VERI_KEY);
                   $op['record_id'] = $encrypted_company_id;
                   $op['status'] = isset($company_id) ?"success" : "fail";
			}else{
                    // update record
                    $this->pgadmin->update_info('pg_company',$data_array,array('user_id'=>$user_id));
                   
			}
        }
        else
        {
          $data['upload_errors'] = $this->upload->display_errors();
		   
        }
   
	
	}
	   
	 }   
	
}
