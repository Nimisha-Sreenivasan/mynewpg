<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuestUploads extends CI_Controller {
        public function __construct(){
            parent::__construct();
           
            $this->load->model("pgadmin"); 
            $this->load->library("session");       
            $this->load->helper('file');
			$this->load->library("pagination");
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
        /*  public function  viewuploads(){
            // check  for session  is available
            $user_id = $this->session->userdata('user_id');
			$company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
			$companyID=$company_dtl[0]['company_id'];
			 
            if(!isset($user_id)):
                redirect('PGownerLogin');
               return TRUE; 
            endif;
            
            // Fetch data form email_templates table
            $data =  array();
			$getGuestUsers = $this->pgadmin->getPG_guestList($companyID);  
		
			$userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
			$data['userdetails'] = $userdetails;
			
            $data['viewuploads'] = $getGuestUsers->result();
            //$data['viewuploads'] = $this->pgadmin->select_column("first_name,AAadhar_front,AAadhar_back,DL_Front,DL_Back,LA_front,pan_front,passport_size_photo",'guest_user_profile');
            $this->load->view('pg_admin/guest_uploads',$data);  
        }*/
	public function  viewuploads(){
            // check  for session  is available
            $user_id = $this->session->userdata('user_id');
			$company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
			$companyID=$company_dtl[0]['company_id'];
			 
            if(!isset($user_id)):
                redirect('PGownerLogin');
               return TRUE; 
            endif;
            
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
			  
			$this->pagination->initialize($config);
	    $this->data["pagination"] = $this->pagination->create_links();	    
			  
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
			  
               $userdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$user_id));   
			$data['userdetails'] = $userdetails;
			 
                // get data for pg 
               $my_pg_dtl = $this->pgadmin->select_info('my_pgs',array('pg_company_id'=>$company_dtl[0]['company_id']),[],$page,$config["per_page"]);
               $data['my_pg_dtl'] = ($my_pg_dtl) ? $my_pg_dtl : 0;
               $receipt_dtl = $this->pgadmin->select_info('receipt');
            
               $data['receipt_dtl'] = ($receipt_dtl) ? $receipt_dtl : 0;
            endif;
            $this->load->view('pg_admin/guest_uploads',$data);  
			  
			
        }
        public function addEmailtemplate(){
                $this->load->view('pg_admin/email_templates');
        }
        public function editEmailtemplate($id=0){
                
            // check  for session  is available
            $user_id = $this->session->userdata('user_id');
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