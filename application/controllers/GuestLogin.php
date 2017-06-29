<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuestLogin extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("login"); 
            $this->load->library('form_validation');
            $this->load->library("session");    
            
        }
        public function index() {
          
            $this->load->view('site/guestlogin');
        }
        public function ajax_signup() {
        $op=$status= $error= array();
        // Validation code
        $this->form_validation->set_rules('username', 'Email', 'trim|required|valid_email|xss_clean',array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'You must provide a %s.'));
        
        //is_unique check the unique email value in users table

        if ($this->form_validation->run() == TRUE):
             $data_array =  array('username'=>$this->input->post('username'),
                                 'password'=>md5($this->input->post('password')));
        
            // chk auth
               $responce = $this->login->select_info('guest_user_info',$data_array);
//               echo $this->db->last_query();
////               var_dump($responce); die;
                if($responce ==  FALSE):
		     $error['credentialerror'] = "Please check  your credentials";   
		     $status['Status'] = "wrong";                  
                elseif(count($responce) > 0):
		     $data_array =  array('gust_user_id'=> $responce[0]['g_uid'],'username'=>$responce[0]['username'],'role_id'=>$responce[0]['role_id']);
                    $this->session->set_userdata($data_array);
                    $status['Status'] = "success";
                    $url = base_url()."pg_guest/dashboard/";
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
	public function logout() {
            $this->session->sess_destroy();
           $this->load->view('site/guestlogin');
        }
}