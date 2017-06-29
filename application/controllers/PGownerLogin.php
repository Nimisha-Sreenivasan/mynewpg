<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PGownerLogin extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("login"); 
//            $this->load->database();
            $this->load->library('form_validation');
            $this->load->library("session");    
            
        }
	public function index()
	{
		$this->load->view('site/login');
	}
	public function pglogin()
	{
		$this->load->view('site/login');
	}
        //registration view
	public function pgowner()
	{
                $this->load->view('site/registration');
	}
        // make registration
	public function pgownerregister()
	{
            
            $this->form_validation->set_rules('first_name', 'first_name', 'trim|required',array('required' => 'You must provide a %s.'));
            $this->form_validation->set_rules('last_name', 'last_name', 'trim|required',array('required' => 'You must provide a %s.'));
            $this->form_validation->set_rules('mobile_no', 'mobile_no', 'trim|required',array('required' => 'You must provide a %s.'));            
            $this->form_validation->set_rules('pg_contact_email', 'Email', 'trim|required|valid_email|xss_clean',array('required' => 'You must provide a %s.'));
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|required', array('required' => 'You must provide a %s.'));
            if ($this->form_validation->run() == TRUE):
                
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $mobile_no = $this->input->post('mobile_no');
                $pg_contact_email = $this->input->post('pg_contact_email');
                $password = $this->input->post('password');
                // check  for is mobile allready register or not
                $chk_mobile_result = $this->login->select_info('user_profile',array('mobile_no'=>$mobile_no));

                if($chk_mobile_result) :
                    $this->session->set_flashdata('message', "Mobile number allready registered.");
                    $this->load->view('site/registration'); 
                    return TRUE;
                endif;
                $firstmd = md5($password);
                // insert data in user_info
                $ver_code = rand(0,9999);
                $data_user_info = array(
                    'username'=>$pg_contact_email,
                    'email_id'=>$pg_contact_email,
                    'password'=>md5($firstmd),
                    'role_id'=>2,
                    'emailver_code'=>$ver_code,
                    'status'=>0
                    );
                $user_id = $this->login->insert_info('user_info',$data_user_info);
                
                if(isset($user_id)) :
                    
                
                $data_user_profile =  array(
                    'user_id'=>$user_id,
                    'first_name'=>$first_name,
                    'last_name'=>$last_name,
                    'mobile_no'=>$mobile_no
                );
                $this->login->insert_info('user_profile',$data_user_profile);
		$fullname = $first_name.' '.$last_name;
                // send verification email 
                $this->sendverificationEmail($pg_contact_email,$user_id,$ver_code,$fullname);
		$this->sendEmailToAdmin($fullname,$mobile_no,$pg_contact_email);
                $data['userinfo'] = array('name'=>$first_name,'email'=>$pg_contact_email);
                //$this->load->view('site/varificationlinksent',$data);
                $this->session->set_flashdata('flsh_msg', 'Registered Successfully. Please verify your email.');
                $this->load->view('site/registration');                 
                endif;                
                else :                  
                $this->load->view('site/registration'); 
            endif;
            
            
	}
	public function checkusername()
	{
            $this->form_validation->set_rules('pg_contact_email', 'Email', 'trim|required|valid_email|xss_clean',array('required' => 'You must provide a %s.'));
            if ($this->form_validation->run() == TRUE):
               $data_array =  array('username'=>$this->input->post('pg_contact_email'));  
                if($this->login->select_info('user_info',$data_array)):
                    echo '<div class="email_id haserror">Username is not available <i class="fa fa-times" aria-hidden="true"></i></div>';
                else :
                    echo "<div class='email_id successemail'><label>Username</label><br/>".$this->input->post('pg_contact_email') ." <i class='icon-check-sign'></i></div>";
                endif;
                
                else: 
                    echo form_error('pg_contact_email');
            endif;
	}
        
        public function checkMobileNo()
	{
            $this->form_validation->set_rules('mobile_no', 'Mobile', 'trim|required|min_length[10]|xss_clean',array('required' => 'You must provide a %s.'));
            if ($this->form_validation->run() == TRUE):
               $data_array =  array('mobile_no'=>$this->input->post('mobile_no'));  
                if($this->login->select_info('user_profile',$data_array)):
                    echo '<div class="mobile_no haserror">Mobile Number is already register with us <i class="fa fa-times" aria-hidden="true"></i></div>';
                else :
                    echo "<div class='mobile_no successmobile'><label>Mobile Number</label><br/>".$this->input->post('mobile_no') ." looks fine  <i class='icon-check-sign'></i></div>";
                endif;
                
                else: 
                    echo form_error('mobile_no');
            endif;
	}
        
        
         public function ajax_signup()
        {
        $op=$status= $error= array();
        // Validation code
        $this->form_validation->set_rules('username', 'Email', 'trim|required|valid_email|xss_clean',array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'You must provide a %s.'));
        
        //is_unique check the unique email value in users table
        $firstmd = md5($this->input->post('password'));
        if ($this->form_validation->run() == TRUE):
             $data_array =  array('username'=>$this->input->post('username'),
                                 'password'=>md5($firstmd));
        
            // chk auth
               $responce = $this->login->select_info('user_info',$data_array);
//               echo $this->db->last_query();
////               var_dump($responce); die;
                if($responce ==  FALSE):
                $error['credentialerror'] = "Please check  your credentials";   
                $status['Status'] = "wrong";  
                
                    elseif(count($responce) > 0):
					$data_array =  array('user_id'=> $responce[0]['id'],'username'=>$responce[0]['username'],'role_id'=>$responce[0]['role_id']);
                    $this->session->set_userdata($data_array);
                    $status['Status'] = "success";
                    $url = base_url()."pg_admin/dashboard/";
                    $status['URL'] = $url;
                    
                
             endif;
             
        else :
            
            $error['username'] = form_error('username');
            $error['password'] = form_error('password');
            $status['Status'] = "fail";     
            
        endif;
        
        $op['errormsg'] =  isset($error) ? $error : " " ;
        $op['status']=$status;
        echo json_encode($op);
        }
        
        public function emailVerification() {          
          $encrypted_string = "";           
          
            $raw_data = $this->input->get('rand');
            $raw_data = str_replace(" ", "+", $raw_data);

         $msg = $this->encrypt->decode($raw_data, VERI_KEY); 
          
          parse_str($msg,$param);
            $userid = $param['userid'];
            $code = $param['code'];            
            if($this->login->update_info('user_info',array('status'=>2,'emailver_code'=>'0'),array('id'=>$userid,'emailver_code'=>$code))) :
               echo 'Your account is verified';
	       redirect('PGownerLogin');
            else:
               echo 'OOPS Link  Expired';  
            endif;
         
        }
        public function sendverificationEmail($email_to,$user_id,$code,$name) {
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
            $path = 'JSON_DATA/email/1001.json';
			if(file_exists($path))
              {
                 $json_file = file_get_contents($path);
                // convert the string to a json object
                $jfo = json_decode($json_file);
                
                $msg = str_replace(array("[UERNAME]","[BASEIMAGEURL]","[VERIFYLINK]"), array($name,asset_url(),$verlink), $jfo->template->body_en); //  msg creation
				  
				  
		$this->email->from(EMAIL_FROM, EMAIL_FROM_NAME);
                $this->email->to($email_to);
                $this->email->subject($jfo->template->subject_en); 				  
			  	$this->email->message($msg);
				$this->email->set_newline("\r\n");
                if (!$this->email->send()) {
                  show_error($this->email->print_debugger()); }
                else {
//                  echo 'Your e-mail has been sent!';
                }
              }
                
        }
       
        public function sendEmailToAdmin($fullname,$mobile_no,$pg_contact_email) {
            // load encryption library            
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
            $path = 'JSON_DATA/email/1004.json';
			if(file_exists($path))
              {
                 $json_file = file_get_contents($path);
                // convert the string to a json object
                $jfo = json_decode($json_file);
                
                $msg = str_replace(array("[PGOWNERNAME]","[EMAIL]","[PHONE]"), array($fullname,$pg_contact_email,$mobile_no), $jfo->template->body_en); //  msg creation
				  
				  
		$this->email->from(EMAIL_FROM, EMAIL_FROM_NAME);
                $this->email->to('chetak.al@cyberpact.in,vallabha.desai@cyberpact.in');
		//$this->email->cc('email1@test.com,email2@test.com,email3@test.com');
                $this->email->subject($jfo->template->subject_en); 				  
			  	$this->email->message($msg);
				$this->email->set_newline("\r\n");
                if (!$this->email->send()) {
                  show_error($this->email->print_debugger()); }
                else {
//                  echo 'Your e-mail has been sent!';
                }
              }
                
        }
        
        public function userAgreement(){
            $this->load->view('site/useragreement');
        }
        
        public function privacy(){
            $this->load->view('site/privacy');
        }
       
       
        public function testemail() {
            // load encryption library
          
            $msg= "test";
			
$from = 'info@cyberpact.in';
$to   = 'vallabha.desai@cyberpact.in';
$subject = 'your subject';
$message = 'your message';

$this->load->library('email');

$config['mailtype'] = 'html';
$config['smtp_port']='587';
$config['smtp_timeout'] = 5;
$config['charset']='utf-8'; // Default should be utf-8 (this should be a text field) 
$config['newline']="\r\n"; //"\r\n" or "\n" or "\r". DEFAULT should be "\r\n" 
$config['crlf'] = "\r\n"; //"\r\n" or "\n" or "\r" DEFAULT should be "\r\n" 
 
$config['charset']='utf-8';
$config['protocol'] = 'smtp';
$config['smtp_crypto'] = 'ssl';
			
$config['smtp_host'] = EMAIL_SMTP_HOST;
$config['smtp_user'] = "info@cyberpact.in";//"info@cyberpact.in";
$config['smtp_pass'] = "Test@321!";

 
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);
$this->email->from($from);
$this->email->to($to);
$this->email->subject($subject);
$this->email->message($message);
$this->email->set_newline("\r\n");
// Sending Email
if (!$this->email->send()) {
			  show_error($this->email->print_debugger()); }
			else {
			  echo 'Your e-mail has been sent!';
			}


             /*$config = Array( 
                'protocol' => 'smtp',
				 'mailpath'=>'/usr/sbin/sendmail',
				 'wordwrap'=>TRUE,
				'charset' => 'iso-8859-1',
                'smtp_host' => EMAIL_SMTP_HOST, 
                'smtp_port' => EMAIL_PORT, 
                'smtp_user' => EMAIL_FROM, 
                'smtp_pass' => EMAIL_PWD ); 
            $this->load->library('email',$config);
            
            $this->email->set_newline("\r\n");
                $this->email->from(EMAIL_FROM, EMAIL_FROM_NAME);
                $this->email->to("pvningalkar@gmail.com");
                $this->email->subject('Its verification '); 
                $this->email->message('Its Verification Link aaaaa');
                if (!$this->email->send()) {
                  show_error($this->email->print_debugger()); }
                else {
//                  echo 'Your e-mail has been sent!';
                }*/
        }
        public function logout() {
            $this->session->sess_destroy();
            redirect('PGownerLogin');
        }
        

}
