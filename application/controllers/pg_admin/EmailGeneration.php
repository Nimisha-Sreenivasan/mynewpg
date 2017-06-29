<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailGeneration extends CI_Controller {
        public function __construct(){
            parent::__construct();
           
            $this->load->model("pgadmin"); 
            $this->load->library("session");       
            $this->load->helper('file');
        }
         public function index() {
          //  $this->load->view('pg_admin/viewemployee');
          $path = 'JSON_DATA/email/1001.json';
              if(file_exists($path))
              {
                 $json_file = file_get_contents($path);
                // convert the string to a json object
                $jfo = json_decode($json_file);
                echo $jfo->template->email_code;
                echo $jfo->template->name_en;
                echo $jfo->template->subject_en;
                
                echo $msg = str_replace(array("XXXXXX6","baseimageurl"), array("pvningalkar@gmail.com",  asset_url()), $jfo->template->body_en);
              }
                
        }
        public function  emailtemplate(){
            // check  for session  is available
            $user_id = $this->session->userdata('user_id');
			$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
            $data['userdetails'] = $userdetails;
            if(!isset($user_id)):
                redirect('PGownerLogin');
               return TRUE; 
            endif;
            
            // Fetch data form email_templates table
            $data =  array();
			$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
			$data['userdetails'] = $userdetails;
             $data['emailtemplate'] = $this->pgadmin->select_column("id,email_code,name_en,status",'email_templates');
            $this->load->view('pg_admin/email_templates',$data);  
        }
        public function addEmailtemplate(){
                $this->load->view('pg_admin/email_templates');
        }
        public function editEmailtemplate($id=0){
                
            // check  for session  is available
            $user_id = $this->session->userdata('user_id');
			$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
            $data['userdetails'] = $userdetails;
            if(!isset($user_id)):
                redirect('PGownerLogin');
               return TRUE; 
            endif;
            $data = array();
            $data['emailtemplate'] = $this->pgadmin->select_info('email_templates',array('id'=>$id));

            
            $this->load->view('pg_admin/edit_email_template',$data);
        }
        
        public function generateEmailTemplates() {
            
            $templates = $this->pgadmin->select_info('email_templates');
            
            foreach ($templates as $key => $value) {
                $template_data =  array(
                    'email_code'=>$value['email_code'],
                    'name_en'=>$value['name_en'],
                    'subject_en'=>$value['subject_en'],
                    'help_en'=>$value['help_en'],
                    'body_en'=>$value['body_en']
                                        );
                $response['template']= $template_data;
                
                // write json to new file
                $fp = fopen('./JSON_DATA/email/'.$value['email_code'].'.json', 'w');
                fwrite($fp, json_encode($response));
                if ( ! write_file('./JSON_DATA/email/'.$value['email_code'].'.json', json_encode($response)))
                    {
                        echo 'Unable to write the file';
                    }
                    else
                    {
                        echo 'file written';
                    }   
            }
        }

        
}