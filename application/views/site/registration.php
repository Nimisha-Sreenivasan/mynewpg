<!doctype html>
<html>
	<head>
		<link href="<?php echo asset_url('css/bootstrap.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
	    <link href="<?php echo asset_url('css/bootstrap-toggle.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset_url('css/font-awesome.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset_url('css/font-awesome.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset_url('css/main.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset_url('css/jquery.loading-indicator.css'); ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo asset_url('pg_admin/bower_components/uikit/css/uikit.almost-flat.min.css'); ?>" media="all">
		<link rel="icon" type="image/png" href="<?php  echo asset_url('pg_admin/assets/img/favicon.png'); ?>" sizes="32x32">
                <style>
                    .wrapper{
                        margin-top:0;
                    }
                   
                </style>
	</head>
        <body>
	<div class="container">
   <div class="top_logo">
      <img src="<?php echo asset_url('images/logo.jpg'); ?>">
   </div>
   <!--Login-->
   <div class="wrapper">
      <form class="form-signin" id="regform" name="regform" method="POST" action="<?php echo base_url()."register" ?>" >
         <?php if(!empty($this->session->flashdata('flsh_msg'))){ ?>
         <div class="uk-alert uk-alert-success" data-uk-alert="">
            <a href="" class="uk-alert-close uk-close"></a>
            <p><?php echo $this->session->flashdata('flsh_msg'); ?> </p>
         </div>
         <?php  } ?>
         <div style="color:red;"id="alldata"></div>
         <div class="new-input">
            <div class="row">
               <div class="col-sm-6 form-group">
                  <input type="text" id="first_name" name="first_name" placeholder="Enter First Name Here.." class="form-control" maxlength="25" required="" />
               </div>
               <div class="col-sm-6 form-group">
                  <input type="text"id="last_name"  name="last_name" placeholder="Enter Last Name Here.." class="form-control" maxlength="25" required="" />
               </div>
               <div class="errorMessage"><?php echo form_error('first_name'); ?></div>
               <div class="errorMessage"><?php echo form_error('last_name'); ?></div>
            </div>
            <div class="form-group">
               <input  id="mobile_no" name="mobile_no" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');if(this.value.length<=0) {$('#onlynumber').html('Character not allowed')}else{$('#onlynumber').html('')};" title="Enter your mobile number"  type="text" maxlength="10" autocomplete="off"  placeholder="Enter Phone Number Here.. eg 9XXXXXXXX8" class="form-control" required="" />
               <div class="errorMessage"><?php echo form_error('mobile_no'); ?></div>
            </div>
            <div class="row">
               <div class="col-sm-6 form-group">
                  <input type="text" autocomplete="off" id="pg_contact_email" name="pg_contact_email" placeholder="Enter Email Here.. eg. abc@pq.co" class="form-control"  required="" />
               </div>
               <div class="col-sm-6 form-group" id="usernameresult">
                  <div id="emailmessage"></div>
                  <div id="mobilemessage"></div>
                  <div style="color:red;"id="onlynumber"></div>
               </div>
            </div>
            <div class="form-group">
               <input name="password" type="password" placeholder="Enter Password" class="form-control" required=""  id="password" />
            </div>
            <div class="form-group">
               <input name="conform_password"  type="password" placeholder="Confirm Your Password Here.." class="form-control" required="" id="confirm_password"  />
               <div class="errorMessage"><?php echo form_error('password'); ?></div>
            </div>
            <div class="form-group col-md-12" style="display: inline-flex;">
               <div class=""> <input name="terms_service" class="terms_service"  style="height:25px;" type="checkbox" placeholder="Confirm Your Password Here.."  required="" id="terms_service"  />
               </div>
               <div class="" style="padding: 6px 8px;" > I agree to the <a style="text-decoration:underline;" target="_blank" href="<?php echo base_url()."PGownerLogin/useragreement" ?>">terms of service</a>
               </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block nwbtn" disabled="disabled" >Register</button>					
         </div>
      </form>
   </div>
   <!--Login-End-->	
   <div class="form_footer">
      <div class="col-md-4">Veraion 1.0.10</div>
      <div class="col-md-5 midcontfooter">
         <p>2017 CyberPact solutions</p>
         <a target="_blank" href="<?php echo base_url()."PGownerLogin/useragreement" ?>">User Agreement</a>
         <a target="_blank" href="<?php echo base_url()."PGownerLogin/privacy" ?>">Privacy Policy</a>
         IP Pending
      </div>
      <div class="col-md-3 ritflt"><?php echo anchor("http://www.cyberpact.in", "www.cyberpact.in", 'target="_blank"'); ?></div>
   </div>
</div>

		<script src="<?php echo asset_url('js/jquery.min.js'); ?>"></script>  
		<script src="<?php echo asset_url('js/jquery.loading-indicator.js'); ?>"></script>
                <script src="<?php echo asset_url('js/bootstrap.min.js'); ?>"></script>
                    <script type="text/javascript">
                    
$(document).ready(function() {
    
   
     $('#terms_service').on('click',function(){
             // pg username chk
     var ckbox = $('#terms_service');
     var first_name = $("#first_name").val();
     var last_name = $("#last_name").val();
     var mobile_no = $("#mobile_no").val();
     var pg_contact_email = $("#pg_contact_email").val();
     var password = $("#password").val();
     var confirm_password = $("#confirm_password").val();
    
     if(($('.email_id').hasClass('successemail')) && ($('.mobile_no').hasClass('successmobile')) && (first_name !== '') && (last_name !== '') && (mobile_no !== '') && (pg_contact_email !== '') &&  (password !== '') && (confirm_password !== '' )){
         $('.nwbtn').removeAttr('disabled');
		 $("#alldata").html('');
     }else{
          $('.nwbtn').attr('disabled','disabled');
		  document.getElementById("terms_service").checked = false;
		   $("#alldata").html('Please enter all the fields');
		   
     }
       });
     
  // $('#pg_contact_email').bind('copy paste', function (e) {
    //    e.preventDefault();
    //});
    $("#mobile_no").keyup(function(){
       var mobile = $(this).val(); 
       if(mobile.length > 3)
        {  
         $("#mobilemessage").html('checking...');
         $.post("PGownerLogin/checkMobileNo", $("#regform").serialize())
                  .done(function(data){        
           $("#mobilemessage").html(data);
          });
        } else
        {
         $("#mobilemessage").html('');
        }
   });
   

   $("#pg_contact_email").keyup(function(){
       var name = $(this).val(); 
       if(name.length > 3)
        {  
         $("#emailmessage").html('checking...');
         $.post("PGownerLogin/checkusername", $("#regform").serialize())
                  .done(function(data){
                    
           $("#emailmessage").html(data);
       
          });
        } else
        {
         $("#emailmessage").html('');
        }
   });
    
    });
    // conform password
    var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;


</script>
	</body>
</html>