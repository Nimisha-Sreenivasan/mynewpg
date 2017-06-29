<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 use Dompdf\Dompdf;   
 use Dompdf\Options;
class Dashboard extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("pgadmin"); 
			$this->load->model('Pg_guest');
            $this->load->library('form_validation');
            $this->load->library("session");       
            $this->load->library('encrypt'); 
			$this->load->library('Dompdf_gen');
            $this->load->library("pagination"); 
        }
	public function index()
	{
            $data = array();
            // check  for session  is available
            $user_id = $this->session->userdata('gust_user_id');
            $role_id = $this->session->userdata('role_id'); 
			$userdetails = $this->pgadmin->select_info('guest_user_profile',array('g_uid'=>$user_id));
            $data['userdetails'] = $userdetails;
       
		 if(isset($user_id)):
                $guestuser_dtl = $this->Pg_guest->select_info('guest_user_profile',array('g_uid'=>$user_id));
                $guestuserinfo_dtl = $this->Pg_guest->select_info('guest_user_info',array('g_uid'=>$user_id));

                $data['guestuser_dtl'] = $guestuser_dtl;
                $data['guestuserinfo_dtl'] = $guestuserinfo_dtl;

                $this->load->view('pg_guest/dashboard',$data);
            else :
                redirect('GuestLogin/index');
                return TRUE;   
            endif;
	}
	
        public function document() {
           $data= array();
			$data["error"] = "";
			$user_id = $this->session->userdata('gust_user_id');
            $role_id = $this->session->userdata('role_id'); 
			$userdetails = $this->pgadmin->select_info('guest_user_profile',array('g_uid'=>$user_id));
            $data['userdetails'] = $userdetails;
            if(!isset($user_id)):
                redirect('GuestLogin');
               return TRUE; 
            endif;
			
			$this->load->model('Pg_guest');
    		$query = $this->Pg_guest->get_alluploadedImages($user_id);
			foreach ($query->result() as $row)
			{
			$getAAadhar_front = $row->AAadhar_front; //Aadhar
			$getAAadhar_back = $row->AAadhar_back;
			$data['AAadhar_front'] = $getAAadhar_front;
			$data['AAadhar_back'] = $getAAadhar_back;
			
			$getDL_Front = $row->DL_Front;//DL
			$getDL_Back = $row->DL_Back;
			$data['DL_Front'] = $getDL_Front;
			$data['DL_Back'] = $getDL_Back;
				
			$getLA_Front = $row->LA_front;//LA
			$data['LA_Front'] = $getLA_Front;	
			
			$getPAN_Front = $row->pan_front;//PAN
			$data['PAN_Front'] = $getPAN_Front;
			
			$getpassport_size_photo = $row->passport_size_photo;//PSP
			$data['passport_size_photo'] = $getpassport_size_photo;
			}
			   
			$company_dtl = $this->pgadmin->select_info('pg_company',array('user_id'=>$user_id));
                if($company_dtl == FALSE && $role_id == ROLE_PG_ADMIN):
                    $this->load->view('pg_admin/company_profile_first_visit',$data);
                    return TRUE;
                else:
                    $this->load->view('pg_guest/documents',$data);
                endif;    
        }
	
          public function searchPG($area="",$city="") {
			$area = $this->input->get("area");
			$city = $this->input->get("city");

			$my_pg_dtl = $this->pgadmin->search_pg_list('my_pgs',array('area'=>$area,'pg_address_city'=>$city));
			$data['my_pg_dtl'] = $my_pg_dtl;
            $this->load->view('pg_guest/searchPG',$data);
                
        }
	
	  public function invoice() {
             $data = array();
            // check  for session  is available
            $user_id = $this->session->userdata('gust_user_id');
		  	$userdetails = $this->pgadmin->select_info('guest_user_profile',array('g_uid'=>$user_id));
            $data['userdetails'] = $userdetails;
            $my_pg_dtl = $this->pgadmin->select_info('my_pgs',array('pg_company_id'=>15),[],0,0);
            $data['my_pg_dtl'] = ($my_pg_dtl) ? $my_pg_dtl : 0;
            $this->load->view('pg_guest/invoice',$data);
        }
	
	public function file_view(){
		$this->load->view('pg_guest/documents', array('error' => ' ' ));
}
		
public function do_upload()
    {
		$user_id = $this->session->userdata('gust_user_id'); 
		$userdetails = $this->pgadmin->select_info('guest_user_profile',array('g_uid'=>$user_id));
        $data['userdetails'] = $userdetails;
		$this->load->model('Pg_guest');
        $query = $this->Pg_guest->get_alluploadedImages($user_id);
			foreach ($query->result() as $row)
			{
			$getAAadhar_front = $row->AAadhar_front; //Aadhar
			$getAAadhar_back = $row->AAadhar_back;
			$data['AAadhar_front'] = $getAAadhar_front;
			$data['AAadhar_back'] = $getAAadhar_back;
			
			$getDL_Front = $row->DL_Front;//DL
			$getDL_Back = $row->DL_Back;
			$data['DL_Front'] = $getDL_Front;
			$data['DL_Back'] = $getDL_Back;
				
			$getLA_Front = $row->LA_front;//LA
			$data['LA_Front'] = $getLA_Front;	
			
			$getPAN_Front = $row->pan_front;//PAN
			$data['PAN_Front'] = $getPAN_Front;
			
			$getpassport_size_photo = $row->passport_size_photo;//PSP
			$data['passport_size_photo'] = $getpassport_size_photo;
			}				
			
	
		$adhaarfull_path1='';
		$adhaarfull_path2='';
		$adhaar_frontpath='';
		$adhaar_backpath='';
		$adhaarfrontimage='';
		$adhaarbackimage='';
		$data['upload_errors']='';
		//*****************************************************************
		if(isset($_FILES['adhaarcard1']['name']) && $_FILES['adhaarcard1']['name']!=""){		


		$filesCount_adhaarcard = count($_FILES['adhaarcard1']['name']);//Aadhaar Card
		$config = array(
                'upload_path' => 'application/images/AdharCardImages',
                'log_threshold' => 1,
                'allowed_types' => 'jpg|png|jpeg',
                'max_size' => '0',
                'overwrite' => false
            );
		$this->load->library('upload', $config);
		
		/*Adding mobile number to file name*/
		$query = $this->Pg_guest->getGuestMobileno($user_id);	
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		}
		$filename =  $_FILES['adhaarcard1']['name'];
		$getfileName_withoutext = pathinfo($filename, PATHINFO_FILENAME );
		$getfileName_withext = pathinfo($filename, PATHINFO_EXTENSION);
		date_default_timezone_set('Asia/calcutta');
		$newname=$getfileName_withoutext."_".$getmobileno."_";
		$newname.=date("Y-m-d-H-i-s").".".$getfileName_withext;
			
		$_FILES['userFile']['name'] = $newname;
		$_FILES['userFile']['type'] = $_FILES['adhaarcard1']['type'];
		$_FILES['userFile']['tmp_name'] = $_FILES['adhaarcard1']['tmp_name'];
		$_FILES['userFile']['error'] = $_FILES['adhaarcard1']['error'];
		$_FILES['userFile']['size'] = $_FILES['adhaarcard1']['size'];


		$Ufile_name = 	$_FILES['adhaarcard1']['name'];
		$Ufile_type = 	$_FILES['adhaarcard1']['type'];
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
		
	if ($this->upload->do_upload('userFile'))
        {
			
          $data['uploads'] = $this->upload->data();
	
			$adhaarfrontimage = $data['uploads']['file_name'];
			$adhaarfull_path1 = $data['uploads']['full_path'];
			$adhaar_frontpath = 'application/images/AdharCardImages/'.$adhaarfrontimage;
			$data['AAadhar_front'] = $adhaar_frontpath;
			if($getAAadhar_front!='')
			 unlink(FCPATH.$getAAadhar_front);
        }
        else
        {
          $data['upload_errors'] = $this->upload->display_errors();
		   
        }
	}else{
		$adhaar_frontpath=$getAAadhar_front;
		
	}
	
	if(isset($_FILES['adhaarcard2']['name']) && $_FILES['adhaarcard2']['name']!='' ){	
   
	$filesCount_adhaarcard = count($_FILES['adhaarcard2']['name']);//Aadhaar Card
   
		//for($i=0; $i<count($_FILES['adhaarcard']['name']); $i++) {
		$config = array(
                'upload_path' => 'application/images/AdharCardImages',
                'log_threshold' => 1,
                'allowed_types' => 'jpg|png|jpeg',
                'max_size' => '0',
                'overwrite' => false
            );
		$this->load->library('upload', $config);
		
		/*Adding mobile number to file name*/
		$query = $this->Pg_guest->getGuestMobileno($user_id);	
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		}
		$filename =  $_FILES['adhaarcard2']['name'];
		$getfileName_withoutext = pathinfo($filename, PATHINFO_FILENAME );
		$getfileName_withext = pathinfo($filename, PATHINFO_EXTENSION);
		date_default_timezone_set('Asia/calcutta');
		$newname=$getfileName_withoutext."_".$getmobileno."_";
		$newname.=date("Y-m-d-H-i-s").".".$getfileName_withext;
		
	

		$_FILES['userFile']['name'] = $newname;
		$_FILES['userFile']['type'] = $_FILES['adhaarcard2']['type'];
		$_FILES['userFile']['tmp_name'] = $_FILES['adhaarcard2']['tmp_name'];
		$_FILES['userFile']['error'] = $_FILES['adhaarcard2']['error'];
		$_FILES['userFile']['size'] = $_FILES['adhaarcard2']['size'];


		$Ufile_name = 	$_FILES['adhaarcard2']['name'];
		$Ufile_type = 	$_FILES['adhaarcard2']['type'];
		$ext= strtolower((pathinfo($Ufile_name, PATHINFO_EXTENSION)));

			if ( $ext!= "jpg" && $ext != "png" && $ext != "jpeg" )
			{
			$data["error"] = " Extension is not allowed";
			$error = true;
			}else{
			$data["error"] = "";
			$error = false;
			}
		
		
    $this->upload->initialize($config);
		
	if ($this->upload->do_upload('userFile'))
        {
			
          $data['uploads'] = $this->upload->data();
		
		 
		
			$adhaarbackimage  =$data['uploads']['file_name'];
			$adhaarfull_path2  =$data['uploads']['full_path'];
			$adhaar_backpath  = 'application/images/AdharCardImages/'.$adhaarbackimage;
			$data['AAadhar_back'] = $adhaar_backpath;	
             if($getAAadhar_back!='')			
		     unlink(FCPATH.$getAAadhar_back);
		
        }
        else
        {
          $data['upload_errors'] = $this->upload->display_errors();
        }
          
    
	
	}else{
		
		$adhaar_backpath=$getAAadhar_back;
	}
	
	
	//***********************************************************************************
	$DLfrontimage='';
	$DLfull_path1='';
	$DL_frontpath='';
	$DLbackimage='';
	$DLfull_path2='';
	$DL_backpath='';
	//******************************************************************************
	if(isset($_FILES['drivinglicense1']['name']) && $_FILES['drivinglicense1']['name']!=""){
	$filesCount_drivinglicense = count($_FILES['drivinglicense1']['name']);//DL 
		$configDL = array(
                'upload_path' => 'application/images/DrivingLicenceImages',
                'log_threshold' => 1,
                'allowed_types' => 'jpg|png|jpeg',
                'max_size' => '0',
                'overwrite' => false
            );
		$this->load->library('upload', $configDL);
		
		/*Adding mobile number to file name*/
		$query = $this->Pg_guest->getGuestMobileno($user_id);	
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		}
		$filename =  $_FILES['drivinglicense1']['name'];
		$getfileName_withoutext = pathinfo($filename, PATHINFO_FILENAME );
		$getfileName_withext = pathinfo($filename, PATHINFO_EXTENSION);
		date_default_timezone_set('Asia/calcutta');
		$newname=$getfileName_withoutext."_".$getmobileno."_";
		$newname.=date("Y-m-d-H-i-s").".".$getfileName_withext;
		
		$_FILES['userDLFile']['name'] = $newname;
    	$_FILES['userDLFile']['type'] = $_FILES['drivinglicense1']['type'];
    	$_FILES['userDLFile']['tmp_name'] = $_FILES['drivinglicense1']['tmp_name'];
    	$_FILES['userDLFile']['error'] = $_FILES['drivinglicense1']['error'];
    	$_FILES['userDLFile']['size'] = $_FILES['drivinglicense1']['size'];
		
		
    $this->upload->initialize($configDL);
		
	if ($this->upload->do_upload('userDLFile'))
        {
          $datas['uploads'] = $this->upload->data();
		 
		   $DLfrontimage = $datas['uploads']['file_name'];
		   $DLfull_path1 = $datas['uploads']['full_path'];
		   $DL_frontpath = 'application/images/DrivingLicenceImages/'.$DLfrontimage;
		   $data['DL_Front'] = $DL_frontpath;
		    if($getDL_Front!='')
		    unlink(FCPATH.$getDL_Front);
				
        }
        else
        {
          $data['upload_errors'] = $this->upload->display_errors();
        }
        

	}
	else{
		$DL_frontpath = $getDL_Front;
		
	}
	
		if(isset($_FILES['drivinglicense2']['name'])&& $_FILES['drivinglicense2']['name']!=""){
	$filesCount_drivinglicense = count($_FILES['drivinglicense2']['name']);//DL 	
		$configDL = array(
                'upload_path' => 'application/images/DrivingLicenceImages',
                'log_threshold' => 1,
                'allowed_types' => 'jpg|png|jpeg',
                'max_size' => '0',
                'overwrite' => false
            );
		$this->load->library('upload', $configDL);
		
		/*Adding mobile number to file name*/
		$query = $this->Pg_guest->getGuestMobileno($user_id);	
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		}
		$filename =  $_FILES['drivinglicense2']['name'];
		$getfileName_withoutext = pathinfo($filename, PATHINFO_FILENAME );
		$getfileName_withext = pathinfo($filename, PATHINFO_EXTENSION);
		date_default_timezone_set('Asia/calcutta');
		$newname=$getfileName_withoutext."_".$getmobileno."_";
		$newname.=date("Y-m-d-H-i-s").".".$getfileName_withext;
		
		$_FILES['userDLFile']['name'] = $newname;
    	$_FILES['userDLFile']['type'] = $_FILES['drivinglicense2']['type'];
    	$_FILES['userDLFile']['tmp_name'] = $_FILES['drivinglicense2']['tmp_name'];
    	$_FILES['userDLFile']['error'] = $_FILES['drivinglicense2']['error'];
    	$_FILES['userDLFile']['size'] = $_FILES['drivinglicense2']['size'];
		
		
    $this->upload->initialize($configDL);
		
	if ($this->upload->do_upload('userDLFile'))
        {
          $datas['uploads'] = $this->upload->data();
		 
		
			$DLbackimage  = $datas['uploads']['file_name'];
			$DLfull_path2  = $datas['uploads']['full_path'];
			$DL_backpath  = 'application/images/DrivingLicenceImages/'.$DLbackimage;
			$data['DL_Back'] = $DL_backpath;
			  if($getDL_Back!='')
	         unlink(FCPATH.$getDL_Back);
        }
        else
        {
          $data['upload_errors'] = $this->upload->display_errors();
        }
        

	}
	else{
		
		$DL_backpath  = $getDL_Back;
	}
 ///***************************************************************************	
		$LAfrontimage='';
		$LAfull_path1='';
		$LA_frontpath='';
		if(isset($_FILES['localaddress']['name']) && $_FILES['localaddress']['name']!="" ){

		$configLA = array(
                'upload_path' => 'application/images/LocalAddressImages',
                'log_threshold' => 1,
                'allowed_types' => 'jpg|png|jpeg',
                'max_size' => '0',
                'overwrite' => false
            );
		$this->load->library('upload', $configLA);
			
		/*Adding mobile number to file name*/
		$query = $this->Pg_guest->getGuestMobileno($user_id);	
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		}
		$filename =  $_FILES['localaddress']['name'];
	
		$getfileName_withoutext = pathinfo($filename, PATHINFO_FILENAME );
		$getfileName_withext = pathinfo($filename, PATHINFO_EXTENSION);
		date_default_timezone_set('Asia/calcutta');
		$newname=$getfileName_withoutext."_".$getmobileno."_";
		$newname.=date("Y-m-d-H-i-s").".".$getfileName_withext;
			
		$_FILES['userLAFile']['name'] = $newname;
    	$_FILES['userLAFile']['type'] = $_FILES['localaddress']['type'];
    	$_FILES['userLAFile']['tmp_name'] = $_FILES['localaddress']['tmp_name'];
    	$_FILES['userLAFile']['error'] = $_FILES['localaddress']['error'];
    	$_FILES['userLAFile']['size'] = $_FILES['localaddress']['size'];
		
		
    $this->upload->initialize($configLA);
		
	if ($this->upload->do_upload('userLAFile'))
        {
          $datasLA['uploads']= $this->upload->data();
		 $LAfrontimage  = $datasLA['uploads']['file_name'];
			$LAfull_path1  = $datasLA['uploads']['full_path'];
			$LA_frontpath = 'application/images/LocalAddressImages/'.$LAfrontimage;
			$data['LA_Front'] = $LA_frontpath;	
			 if($getLA_Front!='')
			unlink(FCPATH.$getLA_Front);
        }
        else
        {
          $data['upload_errors'] = $this->upload->display_errors();
        }
        

	
	}else{
		$LA_frontpath =$getLA_Front;
	}
	
	$PANfrontimage='';
	$PANfull_path1='';
	$PAN_frontpath='';
	if(isset($_FILES['pancard']['name'])&&$_FILES['pancard']['name']!=""){ 
		$configPAN = array(
                'upload_path' => 'application/images/PanImages',
                'log_threshold' => 1,
                'allowed_types' => 'jpg|png|jpeg',
                'max_size' => '0',
                'overwrite' => false
            );
		$this->load->library('upload', $configPAN);
		
		/*Adding mobile number to file name*/
		$query = $this->Pg_guest->getGuestMobileno($user_id);	
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		}
		$filename =  $_FILES['pancard']['name'];
		$getfileName_withoutext = pathinfo($filename, PATHINFO_FILENAME );
		$getfileName_withext = pathinfo($filename, PATHINFO_EXTENSION);
		date_default_timezone_set('Asia/calcutta');
		$newname=$getfileName_withoutext."_".$getmobileno."_";
		$newname.=date("Y-m-d-H-i-s").".".$getfileName_withext;
			
		$_FILES['userPANFile']['name'] = $newname;
    	$_FILES['userPANFile']['type'] = $_FILES['pancard']['type'];
    	$_FILES['userPANFile']['tmp_name'] = $_FILES['pancard']['tmp_name'];
    	$_FILES['userPANFile']['error'] = $_FILES['pancard']['error'];
    	$_FILES['userPANFile']['size'] = $_FILES['pancard']['size'];
		
		
    $this->upload->initialize($configPAN);
		
	if ($this->upload->do_upload('userPANFile'))
        {
          $datasPAN['uploads'] = $this->upload->data();
		  $PANfrontimage  = $datasPAN['uploads']['file_name'];
		  $PANfull_path1  = $datasPAN['uploads']['full_path'];
		  $PAN_frontpath = 'application/images/PanImages/'.$PANfrontimage;
		  $data['PAN_Front'] = $PAN_frontpath;
		  if($getPAN_Front!='')
		  unlink(FCPATH.$getPAN_Front);
        }
        else
        {
          $data['upload_errors'] = $this->upload->display_errors();
        }
        
   
	
	}else{
		$PAN_frontpath =$getPAN_Front;
	}
	
	
	$PSPfrontimage='';
    $PSPfull_path1='';	
	$PSP_frontpath='';
	if(isset($_FILES['passportphoto']['name']) && $_FILES['passportphoto']['name']!=""){
		$configPSP = array(
                'upload_path' => 'application/images/PassportPhotoImages',
                'log_threshold' => 1,
                'allowed_types' => 'jpg|png|jpeg',
                'max_size' => '0',
                'overwrite' => false
            );
		$this->load->library('upload', $configPSP);
		
		/*Adding mobile number to file name*/
		$query = $this->Pg_guest->getGuestMobileno($user_id);	
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		}
		$filename =  $_FILES['passportphoto']['name'];
		$getfileName_withoutext = pathinfo($filename, PATHINFO_FILENAME );
		$getfileName_withext = pathinfo($filename, PATHINFO_EXTENSION);
		date_default_timezone_set('Asia/calcutta');
		$newname=$getfileName_withoutext."_".$getmobileno."_";
		$newname.=date("Y-m-d-H-i-s").".".$getfileName_withext;
		
		$_FILES['userPSPFile']['name'] = $newname; 
    	$_FILES['userPSPFile']['type'] = $_FILES['passportphoto']['type'];
    	$_FILES['userPSPFile']['tmp_name'] = $_FILES['passportphoto']['tmp_name'];
    	$_FILES['userPSPFile']['error'] = $_FILES['passportphoto']['error'];
    	$_FILES['userPSPFile']['size'] = $_FILES['passportphoto']['size'];
		
		
    $this->upload->initialize($configPSP);
		
	if ($this->upload->do_upload('userPSPFile'))
        {
          $datasPSP['uploads'] = $this->upload->data();
		  $PSPfrontimage = $datasPSP['uploads']['file_name'];
		  $PSPfull_path1 = $datasPSP['uploads']['full_path'];
		  $PSP_frontpath = 'application/images/PassportPhotoImages/'.$PSPfrontimage;
		  $data['passport_size_photo'] = $PSP_frontpath;
		  if($getpassport_size_photo!='')
		   unlink(FCPATH.$getpassport_size_photo);
        }
        else
        {
          $data['upload_errors']= $this->upload->display_errors();
        }
        

	
	}	
	else{
		$PSP_frontpath =$getpassport_size_photo;
	}
	

		//$query = $this->Pg_guest->getGuestMobileno($user_id);	
		
	$this->Pg_guest->upload_image($user_id,$adhaar_frontpath,$adhaar_backpath,$DL_frontpath,$DL_backpath,$LA_frontpath,$PAN_frontpath,$PSP_frontpath);	
		if($data['upload_errors']==""){
		if($adhaar_frontpath!='' && $adhaar_backpath!='' && $DL_frontpath!='' && $DL_backpath!='' && $LA_frontpath!='' && $PAN_frontpath!='' && $PSP_frontpath!=''){
	 
		$ext1 = strtolower((pathinfo(base_url($adhaar_frontpath), PATHINFO_EXTENSION)));
		$ext2 = strtolower((pathinfo(base_url($adhaar_backpath), PATHINFO_EXTENSION)));
		
		 $source1 = base_url($adhaar_frontpath);
		 $source2 = base_url($adhaar_backpath);
   		 $destination1 = FCPATH.'application/images/AdharCardPDF/'.$adhaarfrontimage;
   		 $destination2 = FCPATH.'application/images/AdharCardPDF/'.$adhaarbackimage;
		
	/*	if ($ext1 == "pdf" && $ext2 == "pdf"){
			copy($source1, $destination1);
			copy($source2, $destination2);
			//unlink($source1);
			//unlink($source2);
		}*/
		//else{
		//convert Aadhar images to PDF
	
		require_once('dom/autoload.inc.php');
		$options = new Options();
        $options->set('isRemoteEnabled', TRUE);
   

		if($_FILES['adhaarcard1']['name']!='' || $_FILES['adhaarcard2']['name']!=''){
		$createAadharPDF = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                   <html xmlns="http://www.w3.org/1999/xhtml">
                   <head>
                       <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                       <style type="text/css">
                           body {
                               font-family: Arial, Verdana, Helvetica, sans-serif;
                               font-size: 16px;
                           }
                       </style>
                   </head>
                   <body>
                      <img src="'.base_url($adhaar_frontpath).'" alt="filepath" title="filepath" />
					  <br/><br/>
                      <img src="'.base_url($adhaar_backpath).'" alt="filepath" title="filepath" />
                   </body>
                    </html>';
		
     
        
        $dompdfAdhar = new Dompdf($options);
        $dompdfAdhar->loadHtml($createAadharPDF);
        $dompdfAdhar->render();
       
		$pdfAdhar = $dompdfAdhar->output();
		
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		date_default_timezone_set('Asia/calcutta');	
		$fname =date("Y-m-d-H-i-s").".pdf";
       	$file_location = "application/images/AdharCardPDF/AdharCard_".$getmobileno. "_".$fname;
		
		$getAAadhar_front = $row->AAadhar_front;
		$getAAadhar_back = $row->AAadhar_back;
		$getDL_Front = $row->DL_Front;
		$data['AAadhar_front'] = $getAAadhar_front;
		$data['AAadhar_back'] = $getAAadhar_back;
		}
       	file_put_contents($file_location, $pdfAdhar);
		//}
		}
		
		if($_FILES['drivinglicense1']['name']!='' || $_FILES['drivinglicense2']['name']!=''){
			
		//convert DL images to PDF
		$createDLPDF = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                   <html xmlns="http://www.w3.org/1999/xhtml">
                   <head>
                       <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                       <style type="text/css">
                           body {
                               font-family: Arial, Verdana, Helvetica, sans-serif;
                               font-size: 16px;
                           }
                       </style>
                   </head>
                   <body>
                      <img src="'.base_url($DL_frontpath).'" alt="filepath" title="filepath" />
					  <br/><br/>
                      <img src="'.base_url($DL_backpath).'" alt="filepath" title="filepath" />
                   </body>
                    </html>';
		
		$dompdf = new Dompdf($options);
        $dompdf->loadHtml($createDLPDF);
        $dompdf->render();
       
		$pdfDL = $dompdf->output();
		
		/*$dompdf = new DOMPDF();
		$dompdf->load_html($createDLPDF);
    	$dompdf->render();
       	$pdfDL = $dompdf->output(); */
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		date_default_timezone_set('Asia/calcutta');	
		$fname =date("Y-m-d-H-i-s").".pdf";
       	$file_locationDL = "application/images/DrivingLicencePDF/DrivingLicence_".$getmobileno."_".$fname;
		}
       	file_put_contents($file_locationDL, $pdfDL);
		}
		//convert LA images to PDF
		
		if($_FILES['localaddress']['name']!='' ){
		$createLAPDF = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                   <html xmlns="http://www.w3.org/1999/xhtml">
                   <head>
                       <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                       <style type="text/css">
                           body {
                               font-family: Arial, Verdana, Helvetica, sans-serif;
                               font-size: 16px;
                           }
                       </style>
                   </head>
                   <body>
                      <img src="'.base_url($LA_frontpath).'" alt="filepath" title="filepath" />
					  <br/><br/>
                   </body>
                    </html>';
		
		$dompdfLA = new Dompdf($options);
        $dompdfLA->loadHtml($createLAPDF);
        $dompdfLA->render();
       
		$pdfLA = $dompdfLA->output();
		/*$dompdfLA = new DOMPDF();
		$dompdfLA->load_html($createLAPDF);
    	$dompdfLA->render();
       	$pdfLA = $dompdfLA->output(); */
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		date_default_timezone_set('Asia/calcutta');	
		$fname =date("Y-m-d-H-i-s").".pdf";
       	$file_locationLA = "application/images/LocalAddressPDF/LocalAddress_".$getmobileno. "_".$fname;
		}
       	file_put_contents($file_locationLA, $pdfLA);
		
		}
		//convert PAN images to PDF
		 if($_FILES['pancard']['name']!='' ){
		$createPanPDF = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                   <html xmlns="http://www.w3.org/1999/xhtml">
                   <head>
                       <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                       <style type="text/css">
                           body {
                               font-family: Arial, Verdana, Helvetica, sans-serif;
                               font-size: 16px;
                           }
                       </style>
                   </head>
                   <body>
                      <img src="'.base_url($PAN_frontpath).'" alt="filepath" title="filepath" />
					  <br/><br/>
                   </body>
                    </html>';
		$dompdfPAN = new Dompdf($options);
        $dompdfPAN->loadHtml($createPanPDF);
        $dompdfPAN->render();
       	
		$pdfPAN = $dompdfPAN->output();
		
		/*$dompdfPAN = new DOMPDF();
		$dompdfPAN->load_html($createPanPDF);
    	$dompdfPAN->render();
       	$pdfPAN = $dompdfPAN->output(); */
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		date_default_timezone_set('Asia/calcutta');	
		$fname =date("Y-m-d-H-i-s").".pdf";
       	$file_locationLA = "application/images/PanPDF/PAN_".$getmobileno. "_".$fname;
		}
       	file_put_contents($file_locationLA, $pdfPAN);
		 }
		//convert PSP images to PDF
		if($_FILES['passportphoto']['name']!='' ){
		$createPspPDF = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                   <html xmlns="http://www.w3.org/1999/xhtml">
                   <head>
                       <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                       <style type="text/css">
                           body {
                               font-family: Arial, Verdana, Helvetica, sans-serif;
                               font-size: 16px;
                           }
                       </style>
                   </head>
                   <body>
                      <img src="'.base_url($PSP_frontpath).'" alt="filepath" title="filepath" />
					  <br/><br/>
                   </body>
                    </html>';
		$dompdfPSP = new Dompdf($options);
        $dompdfPSP->loadHtml($createPspPDF);
        $dompdfPSP->render();
       	
		$pdfPSP = $dompdfPSP->output();
		/*
		$dompdfPSP = new DOMPDF();
		$dompdfPSP->load_html($createPspPDF);
    	$dompdfPSP->render();
       	$pdfPSP = $dompdfPSP->output(); */
		foreach ($query->result() as $row)
    	{
		$getmobileno = $row->mobile_no;
		date_default_timezone_set('Asia/calcutta');	
		$fname =date("Y-m-d-H-i-s").".pdf";
       	$file_locationLA = "application/images/PassportSizePhotoPDF/PassportSizePhoto_".$getmobileno. "_".$fname;
		}
       	file_put_contents($file_locationLA, $pdfPSP);
		}
	 }
			
		$query = $this->Pg_guest->getGuestuserinfo($user_id);	
		foreach ($query->result() as $row1)
    	{
		$getemail = $row1->email_id;
		$getid = $row1->g_uid;
      
		}
		
		$getGuestdetails = $this->pgadmin->select_info('guest_user_profile',array('g_uid'=>$getid));
	   	$first_nameGU = $getGuestdetails[0]['first_name'];
		$last_nameGU = $getGuestdetails[0]['last_name'];
	
		 $gpgowner_dtl = $this->Pg_guest->select_PGownerEmail($user_id);	
		 $pgownerEmail = $gpgowner_dtl[0]['email_id'];
		 $pgownerId = $gpgowner_dtl[0]['id'];
		 $getOwnerdetails = $this->pgadmin->select_info('user_profile',array('user_id'=>$pgownerId));
		 $first_namePO = $getOwnerdetails[0]['first_name'];
		 $last_namePO = $getOwnerdetails[0]['last_name'];
			
			if($data['upload_errors']==""){
				
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

		$subject = 'Document Uploads';
		$pgownername=$first_namePO . ' ' . $last_namePO;
		$pgguestname= $first_nameGU . ' ' . $last_nameGU;
		
				
       $PGownertemplate ='<!doctype html>
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                           <link rel="stylesheet" href="https://www.eidesign.net/wp-content/themes/eidesign/bootstrap/css/bootstrap.css" >
                           </head>
                        <body>
            <div style="width: 600px; border-radius: 5px;">
            <div class="logo" style="float: right;">
                 <img src="'.asset_url('images/logo_email.jpg').'">
            </div> 
            <div style="clear: both; display: block;"></div>
            <div style="font-family: arial; font-size: 14px; padding: 18px 0 0 0;">
                <p>Dear '.ucwords($pgownername).',</p><p style="padding: 18px 0 0 0;">Your Guest '.ucwords($pgguestname).' has uploaded the documents. Please verify the documents uploaded by the Guest.</p>
                 <p style="padding: 18px 0 0 0;">Please find the attachment for your reference.<br></p></div>
                      
            <div style="font-family: arial; font-size: 14px; padding: 18px 0 6px 0;"><p>Thank You.</p>
                          <p>OurPG.co Team</p></div>
                                   
                                </div>

</body>
</html>';
				
		 $PGguesttemplate ='<!doctype html>
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                           <link rel="stylesheet" href="https://www.eidesign.net/wp-content/themes/eidesign/bootstrap/css/bootstrap.css" >
                           </head>
                        <body>
            <div style="width: 600px; border-radius: 5px;">
            <div class="logo" style="float: right;">
                 <img src="'.asset_url('images/logo_email.jpg').'">
            </div>
                      
            <div style="clear: both; display: block;"></div>
            <div style="font-family: arial; font-size: 14px; padding: 18px 0 0 0;">
                <p>Dear '.ucwords($pgguestname).',</p><p style="padding: 18px 0 0 0;">Thank you for submitting the documents successfully on OURPG.CO.</p>
				<p>Please find attached the files uploaded by you.</p>
</div>       
            <div style="font-family: arial; font-size: 14px; padding: 18px 0 6px 0;"><p>Thank You.</p>
                          <p>OurPG.co Team</p></div>     
                                </div>

</body>
</html>';
// Also, for getting full html you may use the following internal method:

			$this->email->initialize($config);
            $this->email->from(EMAIL_FROM, EMAIL_FROM_NAME);
           
                $this->email->to($pgownerEmail);
                //$this->email->CC($getemail);
                $this->email->subject($subject); 
                $this->email->message($PGownertemplate);	
                $this->email->attach(base_url($adhaar_frontpath));
                $this->email->attach(base_url($adhaar_backpath));
                $this->email->attach(base_url($DL_frontpath));
                $this->email->attach(base_url($DL_backpath));
                $this->email->attach(base_url($LA_frontpath));
                $this->email->attach(base_url($PAN_frontpath));
                $this->email->attach(base_url($PSP_frontpath));
                $this->email->send();
				
		
                $this->email->to($getemail);
                $this->email->subject($subject); 
                $this->email->message($PGguesttemplate);	
                $this->email->attach(base_url($adhaar_frontpath));
                $this->email->attach(base_url($adhaar_backpath));
                $this->email->attach(base_url($DL_frontpath));
                $this->email->attach(base_url($DL_backpath));
                $this->email->attach(base_url($LA_frontpath));
                $this->email->attach(base_url($PAN_frontpath));
                $this->email->attach(base_url($PSP_frontpath));
                $this->email->send();


			
		$data['error']="";
		
		//$this->load->view('pg_guest/dashboard/document/');
		 redirect('pg_guest/dashboard/document/');
			}
		
    	} else {
        //$error = array('error' => $this->upload->display_errors());
		$data['error']="Sorry something went wrong.";
       $this->load->view('pg_guest/documents',$data);	
      }
   }
	
  
  public function receipt() {
             $data = array();
            // check  for session  is available
            $user_id = $this->session->userdata('gust_user_id');
            $userdetails = $this->pgadmin->select_info('guest_user_profile',array('g_uid'=>$user_id));
            $data['userdetails'] = $userdetails;
            $my_receipt_dtl = $this->pgadmin->select_info('receipt',array('g_uid'=>$user_id),[],0,0);
            $data['my_receipt_dtl'] = ($my_receipt_dtl) ? $my_receipt_dtl : 0;
            //print_r($data);
            //exit;
            $this->load->view('pg_guest/receipt',$data);
        }
	

	
}
