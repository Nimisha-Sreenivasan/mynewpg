<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 use Dompdf\Dompdf;   
 use Dompdf\Options;
class MyGuest extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("pgadmin"); 
            $this->load->library("session");       
            $this->load->library("email");  
            $this->load->helper('date');
            $this->load->library("pagination");
                     
        }
         public function index() {
          
        }
        public function addGuest() {
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
               $data['pg_cnt'] = ($my_pg_dtl) ? count($my_pg_dtl) : 0;
               $receipt_dtl = $this->pgadmin->select_info('receipt',array('com_id'=>$company_dtl[0]['company_id']));
            
               $data['receipt_dtl'] = ($receipt_dtl) ? $receipt_dtl : 0;
            endif;
            $this->load->view('pg_admin/addguest',$data);
        }
        
          //To show users of pgowner 
        public function myGuests(){
            $pg_id = $this->input->post('data');
            $my_guest_dtl = $this->pgadmin->select_myguest_profile(array('gui.mypg_id'=>$pg_id));
            
            echo json_encode($my_guest_dtl);
           
        }
        
         public function generatedRcpt(){
            $pg_id = $this->input->post('data');
           
            $genreceipt_dtl = $this->pgadmin->select_myguest_receipts(array('pg_id'=>$pg_id));
            
            echo json_encode($genreceipt_dtl);
        }
        
        
        public function generateInvoice(){
            $guser_id = $this->input->post('guser_id');
            $gname    = $this->input->post('recpt_gname');
            $rent = $this->input->post('recpt_gamnt');
            $company_id = $this->input->post('company_id');
            $month = $this->input->post('recpt_month');
            $year  = $this->input->post('recpt_year');
            $comments  = $this->input->post('recpt_cmnt');
            $rcpt_id = $this->input->post('rcpt_id');
            $pg_id = $this->input->post('pg_id');
            $pdf_attachment = $this->pdfCreation($rcpt_id,$guser_id,$rent,$company_id,$pg_id,$month,$year,$comments); 
            $file_loc = $pdf_attachment['file_location'];
            $email = $pdf_attachment['email'];
            
            $recpt_email = $this->sendReceiptEmail($email,$gname,$month,$year,$file_loc);
             
            if(!empty($file_loc)){  
                $this->session->set_flashdata('flsh_msg', 'Receipt Generated Successfully.');
            }else{
                $this->session->set_flashdata('flsh_msg', 'Some errors occured.');
            }
            
            redirect('pg_admin/MyGuest/addguest#rcpt'); 
            
            //echo $this->email->print_debugger(); 
            //echo "<script>console.log(".$pdf_attachment.")</script>";
            
          
        }
        
        public function sendReceiptEmail($email,$gname,$month,$year,$pdf_attachment){
           
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
            
                $subject = 'Payment Details -'.' '.$month.'-'.$year;
                $message = '<p>This message has been sent for testing purposes.</p>';
              
              
                $html ='<!doctype html>
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">

                            <title>PG Administration | Manage your PG Bussiness | Manage better than before</title>
                            <!-- uikit -->
                           <!-- Latest compiled and minified CSS -->
                           <link rel="stylesheet" href="https://www.eidesign.net/wp-content/themes/eidesign/bootstrap/css/bootstrap.css" >
                           </head>
                        <body>
            <div style="width: 600px; border-radius: 5px;">
            <div class="logo" style="float: right;">
                 <img src="'.asset_url('images/logo_email.jpg').'">
            </div>
                      
            <div style="clear: both; display: block;"></div>
            <div style="font-family: arial; font-size: 14px; padding: 18px 0 0 0;">
                <p>Dear '.$gname.',</p><p style="padding: 18px 0 0 0;">Thank you for your payment,Your payment details are attached with this mail. </p>
                    <p style="padding: 18px 0 0 0;">Please find the attachment.<br>
                             </p></div>
                      
            <div style="font-family: arial; font-size: 14px; padding: 18px 0 6px 0;"><p>Thank You.</p>
                          <p>OurPG.co Team</p></div>
                                   
                                </div>

</body>
</html>';
       
            $this->email->initialize($config);
            $this->email->from(EMAIL_FROM, EMAIL_FROM_NAME);
           
                $this->email->to($email);
                $this->email->subject($subject); 
                $this->email->message($html);			
                $this->email->attach($pdf_attachment);
                $this->email->send() ;
      
             $op['msg'] = $pdf_attachment;
            
            if(!empty($pdf_attachment)){
             $data['msg'] = $pdf_attachment;   
            }
        }
        
        
        public function pdfCreation($rcpt_id='',$uid,$rent,$com_id,$pg_id,$month,$year,$comments) {
        $guser_dtl = $this->pgadmin->select_guestuser_details(array('gup.g_uid' => $uid));
        $uid = $uid;
        $billing_to_user    = $guser_dtl['first_name'];
        $billing_to_address = $guser_dtl['address'];
        $userid             = $guser_dtl['g_uid'];
        $email              = $guser_dtl['email_id'];
        $total_amount       = $rent;
        
        // $last_receipt_id = $this->pgadmin->select_last_record('receipt','id','desc');
         $unique_id = uniqid();
      
         $receipt_no = $unique_id;
        
         $date = date('d-m-Y');
        $gpgowner_dtl = $this->pgadmin->get_pgowner_details(array('company_id' => $com_id));
        $billing_from_user    = $gpgowner_dtl['first_name'];
        $billing_company_name  = $gpgowner_dtl['company_name'];
        $billing_from_address = $gpgowner_dtl['adress'];
         $billing_company_address  = $gpgowner_dtl['company_address'];
        $subject = "Invoice pdf";
        if(!empty($gpgowner_dtl['company_logo'])){
        //$img = '<img src="'.site_url().'assets/company_logo/'.$gpgowner_dtl['company_logo'].'">';
        }else{
            //$img ='';
        }
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
   
                        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <!-- Remove Tap Highlight on Windows Phone IE -->
                        <meta name="msapplication-tap-highlight" content="no"/>

                        <title>' . html_escape($subject) . '</title>
                        <style type="text/css">
                            body {
                                font-family: Arial, Verdana, Helvetica, sans-serif;
                                font-size: 14px;
                            }
                            .uk-grid{
             clear:both;
             margin: 7px 3px;
        }
        .user_content{
           
            margin:2px;
        } 
        .left{
            width:60%;
            float:left;    
        }
        .right{
            width:40%;
            float:right;
            text-align:right;
        }
        .head{
            color:#8e1f1f;
        }
        hr.head{
                display: block;
                height: 2px;
                border: 0;
                border-top: 2px solid #8e1f1f;
                margin: 1em 0;
                padding: 0; 
        }
        .logo_regular{
                width: 50%;
    
                padding: 25px 0;
                float: right;
        }
            
        thead tr{
            height: 35px;  
        }
        tbody tr td{
             padding:  10px;
             background: #eee;
             border-right: 4px solid #fff;
        }
        table {width:100%;text-align: left; border:0; border-collapse:separate; border-spacing:0 20px;}
        thead tr th{ border-bottom: 2px solid #8e1f1f; border-collapse:separate; border-spacing:5px 5px;}
         
        .cmp_logo{
            
           
        }
        .cmp_logo img{
            width:48px;
           
        }
      
  
                        </style>
                    </head>
                    <body>
                       <div class="user_content">
                            <div class="uk-grid">
                               <div style="width:100%;text-align: center;">
                                        <h2>RECEIPT</h2>
                                    </div>
                            </div>
                            <div class="uk-grid">
                                <div class="left">
                              
                           <div class="cmp_logo">
                                   
                          
                          <p style="font-size:16px;">' . $billing_company_name . '</p>
                          
                           <p style="width:350px;font-size:12px;word-wrap:break-word;">' . $billing_company_address . '</p>
                               </div>
                           </div> 
                                <div class="right">
                                   
                           <p>Receipt No:'.' '.$receipt_no.'</p>
                           <p>DATE :'.' '.$date.'</p>
                                </div>
                            </div>
                         
                            
                              
                            <div class="uk-grid">
                                <div>
                                 <table class="table table-default">   
                                     <thead>
                                         <tr>
                              <th>Rent For</th>
                              <th>Billing To</th>
                              <th>Address</th>
                              <th>Mobile No</th>
                              <th>Price</th>
                              <th>Total</th>
                                         </tr>
                               </thead>
                           
                           <tbody>
                               <tr>
                            <td> <b>' . $month .'  '.$year . '</b></td>
                             <td>' . $billing_to_user . '</td>
                         
                           <td>' . $billing_to_address . '</td>
                           <td>'. $guser_dtl['mobile_no'].'</td> 
                           
                           <td><b>Rs.' . $total_amount . '</b></td>
                           <td><b>Rs.' . $total_amount . '</b></td>
                               </tr>
                           </tbody>
                             </table>
                          
                                </div>
                            </div>
                            
                            
                              
                            <div class="uk-grid">
                                <div style="width:100%;">
                                    <strong class="head">Comments</strong>
                           <hr class="head">
                           <p style="word-wrap: break-word;">' . $comments . ' </p>
                         
                         
                           
                          
                             
                            </div>
                            </div>
                            
                        </div>
                     
                    </body>
                     </html>';
  
       
        
       $pdf_attachment = array();  
 
       require_once('dom/autoload.inc.php');
       $options = new Options();
  
       $options->set('isRemoteEnabled', TRUE);
   
       $dompdf = new Dompdf($options);
      // $dompdf = new Dompdf();
       $dompdf->loadHtml($html);
       $dompdf->setPaper('A5','landscape');
       $dompdf->render();
      
   // $dompdf->stream("welcome.pdf");
    //  exit;
   
        $pdf_name = "receipt";
        $pdf = $dompdf->output();
        $t = time(); /*Add Timestamp if needed*/
       
        
       if(!empty($rcpt_id)){
        $file_location = "assets/receiptpdf/" . $pdf_name ."_".$rcpt_id."_".$t. ".pdf";
        file_put_contents($file_location, $pdf);
             $data_guser_info= array(
                    
                    'g_uid'=>$uid,
                    'g_name'=>$billing_to_user,
                    'com_id'=>$com_id,
                    'rent' => $rent,
                    'month'=> $month,
                    'year' => $year,           
                    'comments'=>$comments,
                    'pdf_location'=>$file_location,
                    'date'        => $date 
                );
        $update_receipt_det = $this->pgadmin->update_info('receipt',$data_guser_info,array('rcpt_no'=>$rcpt_id));
       }else{
           $file_location = "assets/receiptpdf/" . $pdf_name ."_".$unique_id."_".$t. ".pdf";
        file_put_contents($file_location, $pdf);
        $data_guser_info= array(
                    'rcpt_no' => $unique_id,
                    'g_uid'=>$uid,
                    'g_name'=>$billing_to_user,
                    'com_id'=>$com_id,
                    'pg_id'=>$pg_id,
                    'rent' => $rent,
                    'month'=> $month,
                    'year' => $year,           
                    'comments'=>$comments,
                    'pdf_location'=>$file_location,
                    'date'        => $date 
                );
        $insert_receipt_det = $this->pgadmin->insert_info('receipt',$data_guser_info);
       }
       
        $pdf_attachment['file_location'] = $file_location ;
        $pdf_attachment['email'] = $email;
        return $pdf_attachment;
    }

    
     public function changeGuestStatus() {
	  
            $op =  array();
            $guest_status = $this->input->post('guest_status');
            $email = $this->input->post('email');
            
            $update_info = $this->pgadmin->update_info('guest_user_info',array('guest_status'=>$guest_status),array('email_id'=>$email));
          
            if($update_info){
                $op['status']="success";
                $op['status']="Guest status updated successfully" ;
            } else {
                $op['status']="fail";
                $op['status']="Somthing went Wrong";
            }
          
            
            echo json_encode($op);            
        }
        
        public function sendNotification() {
	    $company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$this->session->userdata('user_id')));	
	    $company_id = $company_dtl[0]['company_id'];
            $op =  array();
            $guest_name = $this->input->post('guest_name');
            $guest_email = $this->input->post('guest_email');
            $guest_mobile = $this->input->post('guest_mobile');
            $guest_branch = $this->input->post('guest_branch');
            $guest_doj = $this->input->post('guest_doj');
            $info_array =  array();
            foreach ($guest_name as $key => $value) {
                $info_array[$key]['pg_id']= $guest_branch[$key];
				$info_array[$key]['company_id'] = $company_id;
                $info_array[$key]['guest_name']=$value;
                $info_array[$key]['guest_email']=$guest_email[$key];
                $info_array[$key]['guest_mobile']=$guest_mobile[$key];
                $info_array[$key]['guest_doj']= date('Y-m-d',strtotime(str_replace(".", "-", $guest_doj[$key])));
                $info_array[$key]['entrycode']= rand(0,99999999);
				$info_array[$key]['status']= 0;
            }
            
			$email_exists_in_pginvitaion = $this->pgadmin->select_column('guest_email','pg_invitation',array('guest_email'=>$guest_email[0])); //check exits in pg invitation table
            $mobile_exists_in_pginvitaion = $this->pgadmin->select_column('guest_mobile','pg_invitation',array('guest_mobile'=>$guest_mobile[0]));//check exits in pg invitation table
			
            if(empty($email_exists_in_pginvitaion[0]['guest_email']) && empty($mobile_exists_in_pginvitaion[0]['guest_mobile']))
			{
			$insert_info = $this->pgadmin->insert_batch_record('pg_invitation',$info_array);
            $this->sendEmailInvitation($info_array); //  send email invitation
            $this->sendSMSInvitation($info_array); //  send sms invitation
            
            if($insert_info){
                $op['status']="success";
                $op['status']="Invitation sent successfully" ;
            } else {
                $op['status']="fail";
                $op['status']="Somthing went Wrong";
            }
            }
            
			 if(!empty($mobile_exists_in_pginvitaion[0]['guest_mobile'])){
                $op['status']="fail";
                $op['status']="Invitation already sent to this mobile number";
            }
            
            if(!empty($email_exists_in_pginvitaion[0]['guest_email'])){
                $op['status']="fail";
                $op['status']="Invitation already sent to this email id";
            }
           
                
            echo json_encode($op);           
        }
        function sendSMSInvitation($info_array) {
            $username=SMS_UNAME;
            $password=SMS_PWD;            
            $sender=SMS_SENDER; 
            
            foreach ($info_array as $key => $value) {
                $mobile_number=$value['guest_mobile'];
                $message="Hello ".$value['guest_name']."\n"." Your PG Owner sent you invitation to complete your profile.\n Email:".$value['guest_email']." Ver Code: ".$value['entrycode'];
                $url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($mobile_number)."&message=".urlencode($message)."&sender=".urlencode($sender)."&type=".urlencode('3');
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $responce_data = curl_exec($ch);
                curl_close($ch);                 
                $json = json_decode($responce_data, true);
                 $user_id = $this->session->userdata('user_id');
                $sms_log[$key]['sender_uid'] = $user_id;
                $sms_log[$key]['mobilenumbers'] = $json['mobilenumbers'];
                $sms_log[$key]['refid'] = $json['refid'];
                $sms_log[$key]['senttime'] = $json['senttime'];
                $sms_log[$key]['type'] = "GUEST_INVIT";        
                $sms_log[$key]['status'] = $json['status'];
            }
			if(count($sms_log) > 0):
               $this->pgadmin->insert_batch_record('pg_sms_log',$sms_log);
           endif;
            
        }
        function sendEmailInvitation($info_array) {
            
            // send verification email
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
            
            foreach ($info_array as $key => $value) {
                // link generation
            $msg= "entrycode=".$value['entrycode']."&email=".$value['guest_email']."&pg_id=".$value['pg_id'];            
            $encrypted_string = $this->encrypt->encode($msg, VERI_KEY);
            $verlink = base_url()."guestregister/guest_verify?rand=".$encrypted_string;                
                
                $path = 'JSON_DATA/email/1003.json';
		$email_msg = '';
		if(file_exists($path))
                {
                   $json_file = file_get_contents($path);
                   // convert the string to a json object
                   $jfo = json_decode($json_file);
                   $emailcode =  $jfo->template->email_code;
                   $email_name  = $jfo->template->name_en;
                   $email_subject =  $jfo->template->subject_en;                
                   $email_msg = str_replace(array("[GUESTNAME]","[VERIFY_URL]"), array($value['guest_name'], $verlink ), $jfo->template->body_en);
		}	
		
                $this->email->to($value['guest_email']);
                $this->email->subject('Hi '.$value['guest_name']); 
                $this->email->message($email_msg);			
                $this->email->set_newline("\r\n");
                $this->email->send() ;
                 
            }   
        }
	
	public function testmsg() {
         
          /*  $username=SMS_UNAME;
            $password=SMS_PWD;            
            $sender=SMS_SENDER; 
            $user_id = $this->session->userdata('user_id');
            $info_array[0]['guest_name']="pavan";
            $info_array[0]['guest_mobile']="9421019656";
            $info_array[0]['guest_email']="pvningalkar@gmail.com";
            $info_array[0]['entrycode']="888558";
            
            $info_array[1]['guest_name']="vallabh";
            $info_array[1]['guest_mobile']="9845713350";
            $info_array[1]['guest_email']="pvningalkar@gmail.com";
            $info_array[1]['entrycode']="888558";
            $sms_log = array();
            foreach ($info_array as $key => $value) {
                $mobile_number=$value['guest_mobile'];
                $message="Hello ".$value['guest_name']."\n"." Your PG Owner sent you invitation to complete your profile.\n Email:".$value['guest_email']." Ver Code: ".$value['entrycode'];
                $url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($mobile_number)."&message=".urlencode($message)."&sender=".urlencode($sender)."&type=".urlencode('3');
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $responce_data = curl_exec($ch);
                curl_close($ch);                 
                $json = json_decode($responce_data, true);
                
                $sms_log[$key]['sender_uid'] = $user_id;
                $sms_log[$key]['mobilenumbers'] = $json['mobilenumbers'];
                $sms_log[$key]['refid'] = $json['refid'];
                $sms_log[$key]['senttime'] = $json['senttime'];
                $sms_log[$key]['type'] = "GUEST_INVIT";        
                $sms_log[$key]['status'] = $json['status'];
            }            
            
           if(count($sms_log) > 0):
               $this->pgadmin->insert_batch_record('pg_sms_log',$sms_log);
           endif; */
            
        }
}