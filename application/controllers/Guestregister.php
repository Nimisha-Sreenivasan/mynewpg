<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guestregister extends CI_Controller {
    
   public function __construct(){
        parent::__construct();
        $this->load->model("pgadmin"); 
        $this->load->library('form_validation');
        $this->load->library("session");    
            
    }
    
   public function index()
	{
		
		//  Gusted register page load setps after email & varification code submited 
		$data = array();
		$email = '';
               
		$entrycode = '';
		$raw_data = $this->input->get('rand');
		$raw_data = str_replace(" ", "+", $raw_data);
		$getdata = $this->encrypt->decode($raw_data, VERI_KEY);
		if($getdata){
			parse_str($getdata,$param); //query string into variables:
			$email = $param['email'];
                       
			$entrycode = $param['entrycode'];
			$check_exits = $this->pgadmin->select_last_row('pg_invitation','id',array('guest_email'=>$email,'entrycode'=>$entrycode,'status'=>0));
			$data['rand'] = $raw_data;
			$data['email'] = $email;
			if(count($check_exits)>0 && $check_exits!=FALSE){			
				$gust_userinfo = $this->pgadmin->select_info('guest_user_info',array('email_id'=>$email));			
				if($gust_userinfo==FALSE){
					$data['status'] = 'success';
					$data['guest_name'] = $check_exits[0]['guest_name'];
					$data['guest_mobile'] = $check_exits[0]['guest_mobile'];
											
				}else{
					$this->session->set_userdata(array('flash'=>'This email address is already registered with us. Please enter your UserID and Password below. If you cannot gain access with your credentials, please contact your administrator'));				
					redirect('GuestLogin');
					 
				}
				
			}
			else{
				$data['status'] = 'fail';
				$data['msg'] = 'Something Wrong, The page you requested was not found';
			}
		}
		else{
			$data['status'] = 'fail';
			$data['msg'] = 'Something Wrong, The page you requested was not found';
		}		
		$this->load->view('site/guest_register',$data);
	}
    
	/* Gust Verification on page load
	 * Email/SMS page laod after email link click
	 * @param
	*/ 
   public function guest_verify()
	{		
		$data = array();
		$email = '';
		$entrycode = '';
                $pg_id = '';
		$raw_data = $this->input->get('rand');
		if($raw_data){
			$raw_data = str_replace(" ", "+", $raw_data);
			$getdata = $this->encrypt->decode($raw_data, VERI_KEY);
			
			if($getdata){
				parse_str($getdata,$param); //query string into variables:
				$email = $param['email'];
				$entrycode = $param['entrycode'];
                                $pg_id = $param['pg_id'];
				$check_exits = $this->pgadmin->select_last_row('pg_invitation','id',array('guest_email'=>$email,'entrycode'=>$entrycode,'status'=>0));
				
				if(count($check_exits)>0 && $check_exits!=FALSE){					
					$data['email'] = $email;
					$data['entrycode'] = $entrycode;
                                        $data['pg_id'] = $pg_id;
				}else{					
					$data['msg'] = '<div class="alert alert-success">
										Your account already registered with us, Please go to login page and login with your account ceridancial.
									 </div>';
				}
			}
			else{
				$data['msg'] = 'This url is not valid';
			}
		}
		
		$record['data'] = $data;
		$this->load->view('site/guest_email_sms_verify',$record);
	}
	
	/* Continue Gust register
	 * Process to continue guest invitaion registration
	 * @parama / email & entrycode
	*/
	public function continue_guestresgister(){
		$this->form_validation->set_rules('guest_email', 'Email ID', 'required');
		$this->form_validation->set_rules('entrycode', 'Enter Code', 'required');
		if ($this->form_validation->run() == FALSE) { 
				$errorall =  validation_errors();
				$arr_err = array('status'=>'fail','data'=>$errorall);
				 echo json_encode($arr_err);
				return false;
			}
			
		$email =  $this->input->post('guest_email',TRUE);
		$entrycode =  $this->input->post('entrycode',TRUE);
                $pg_id =  $this->input->post('pg_id',TRUE);
		$check_exits = $this->pgadmin->select_last_row('pg_invitation','id',array('guest_email'=>$email,'entrycode'=>$entrycode));
		if(isset($check_exits) && count($check_exits) > 0 && $check_exits != FALSE){
			
			$passval = "entrycode=".$entrycode."&email=".$email."&pg_id=".$pg_id;            
         $encrypted_string = $this->encrypt->encode($passval, VERI_KEY);
			$arr_err = array('status'=>'success','data'=>$encrypted_string);			
		}
		else{
			$errorall =  '<div class="alert alert-danger"><strong>Oops !</strong> there are some problems with input!
								<ul>
								   <li>These credentials do not match our records.</li>
							   </ul>
                        </div>';
			$arr_err = array('status'=>'fail','data'=>$errorall);			
			
		}
		 echo json_encode($arr_err);
	}
	
	/* Continue Gust register
	 * Process to continue guest invitaion registration
	 * @parama / email & entrycode
	*/
	
	public function guestregistration(){	
		if(isset($_POST) & !empty($_POST)){			
		$raw_data = $this->input->post('rand');
		$raw_data = str_replace(" ", "+", $raw_data);
		$getdata = $this->encrypt->decode($raw_data, VERI_KEY);
		parse_str($getdata,$param); //query string into variables:
		$email = $param['email'];
        $pg_id = $param['pg_id'];
		$entrycode = $param['entrycode'];
		$check_exits = $this->pgadmin->select_last_row('pg_invitation','id',array('guest_email'=>$email,'entrycode'=>$entrycode));
		$data = array();
		$passwd = $this->pgadmin->get_random_password();
		$company_id_dlt = $this->pgadmin->select_info('pg_invitation',array('guest_email'=>$email));//add companyid and pgid
		$getcompany_id = $company_id_dlt[0]['company_id'];
		if(count($check_exits)>0){
			
			$data_user_info = array(
											'username' => $this->input->post('gust_email',TRUE),
											'email_id'=> $this->input->post('gust_email',TRUE),
											'password' => md5($passwd),
                                             'mypg_id'  => $pg_id,
                                             'company_id' =>$getcompany_id,
											'emailver_code' => $entrycode,
											'status' => 1,											
											);
			$data_array =  array(               
                'first_name'=>  $this->input->post('first_name',TRUE),
                'last_name'=>  $this->input->post('last_name',TRUE),
                'address'=>  $this->input->post('gust_address',TRUE),
                'city'=>  $this->input->post('gust_city',TRUE),
                'state'=>  $this->input->post('gust_state',TRUE),
                'pincode'=>  $this->input->post('gust_zip',TRUE),
                'gust_country'=>  $this->input->post('gust_country',TRUE),
                'gust_birth'=>  $this->input->post('gust_birth',TRUE),
                'you_are'=>  $this->input->post('you_are',TRUE),
                'gender'=>  $this->input->post('gender',TRUE),	
					 'mobile_no'=>  $this->input->post('gust_phone',TRUE),
					 'emergency_contact_no'=>  $this->input->post('emergency_contact_no',TRUE),
					 'gust_property_address'=>  $this->input->post('gust_property_address',TRUE),
					 'gust_permanent_address'=>  $this->input->post('gust_permanent_address',TRUE),
					 'gust_passport_no'=>  $this->input->post('gust_passport_no',TRUE),
					 'gust_voter_id'=>  $this->input->post('gust_voter_id',TRUE),
					 'gust_pan_no'=>  $this->input->post('gust_pan_no',TRUE),
					 'gust_enroll_id'=>  $this->input->post('gust_enroll_id',TRUE),
					 'gust_blood_group'=>  $this->input->post('gust_blood_group',TRUE),					 
					 'guest_father_name'=>  $this->input->post('guest_father_name',TRUE),
					 'guest_mother_name'=>  $this->input->post('guest_mother_name',TRUE),
					 'guest_father_occ'=>  $this->input->post('guest_father_occ',TRUE),
					 'guest_mother_occ'=>  $this->input->post('guest_mother_occ',TRUE),
					 'guest_mother_mob'=>  $this->input->post('guest_mother_mob',TRUE),
				 	 'guest_father_mob'=>  $this->input->post('guest_father_mob',TRUE),
					 'guest_father_email'=>  $this->input->post('guest_father_email',TRUE),					 
					 'guest_mother_email'=>  $this->input->post('guest_mother_email',TRUE)					 
                );
			// insert data in gust user info table 
			$gust_user_info_id = $this->pgadmin->insert_info('guest_user_info',$data_user_info);
			if($gust_user_info_id){
				$data_array['g_uid'] = $gust_user_info_id;
				// Insert data in user profile with gust id 
				$gust_user_profile_id = $this->pgadmin->insert_info('guest_user_profile',$data_array);
				if($gust_user_profile_id){
					// Flag set in gust invitation table for  entered email id & aslso set all same email as entered email
					$pginvite =  $this->pgadmin->update_info('pg_invitation',array('status'=>'r'),array('guest_email'=>$email));
					
					// Send email to gust user
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
					$this->email->from(EMAIL_FROM, EMAIL_FROM_NAME);

					$path = 'JSON_DATA/email/1002.json';
					$email_subject = '';
					$email_msg = '';
					$guestname = $data_array['first_name']. ' '.$data_array['last_name'];
					if(file_exists($path))
               {
						$json_file = file_get_contents($path);
						$jfo = json_decode($json_file);
						$email_subject = $jfo->template->subject_en;
						$email_msg = str_replace(array("[GUESTNAME]","[USERNAME]","[PASSWORD]"), array($guestname,  $data_user_info['username'],$passwd), $jfo->template->body_en);
				   }
					$this->email->to($email);
               $this->email->subject($email_subject);
					$message = '';
               $this->email->message($email_msg);
			
               $this->email->set_newline("\r\n");
               $this->email->send() ;
					 if($pginvite){						
						 redirect('guestregister/thankyou');
					 }
					 else{
						redirect('guestregister/thankyou');
					 }
					 
					
					
				}
			}
		}
		else{
			echo "Something wrong";
		}
		}
		else{
			echo "You are not authorized to access this page";
		}
		
	}
	
	
	/* Gust register thank you page 
	 * 
	 * 
	*/
	
	public function thankyou(){
			$this->load->view('site/thankyou');
	}
	    
}

?>