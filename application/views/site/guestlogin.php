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
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>		
		<link rel="icon" type="image/png" href="<?php  echo asset_url('pg_admin/assets/img/favicon.png'); ?>" sizes="32x32">
	</head>

        <body>
		
			<div class="container">
		 <div class="top_logo">
			<img src="<?php echo asset_url('images/logo.jpg'); ?>">
		  </div>
		
		
		<!--Login-->
			<div class="wrapper">
			    <form class="form-signin" id="guestlogin" name="login" method="post">
			    	<div class="top_head"><p>Indias first SAAS based</p></div>		       
			      <h2 class="form-signin-heading newhead">Paying Guest Management System</h2>
			      <h1 style="font-size:20px;margin-bottom: 30px;">Guest Login</h1>
					<p><?php
					if(isset($_SESSION['flash'])):
						echo $_SESSION['flash'];
						unset($_SESSION['flash']); //flash is one time only
					endif;
					?>
			      <div class="newinput">
			      	<input type="text" class="form-control" id="login_username" name="username" placeholder="User ID" required="" autofocus="" autocomplete="off"/>
                                <div id="usernameerror" class="errorMessage"></div>
			      	<input type="password" class="form-control" id="login_password" name="password" placeholder="Password" required="" autocomplete="off" />  
                                <div id="passerror" class="errorMessage"></div>     
			      </div>
					<div id="credentialerror" class="errorMessage"></div>
			       <button class="btn btn-lg btn-primary btn-block nwbtn" type="button" id="click_form">Login</button> 
					<!--<a href="<?php //echo site_url('get_password/index/'.$rs); ?>"style="color:black;text-decoration:none" target="_blank">Forgot Password</a>-->

			      <div class="center_line">
			      	<p>Empower your business never before.</p> 
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
<!-- common functions -->
    <script src="<?php echo asset_url('pg_admin/assets/js/common.min.js'); ?>"></script>
    <!-- uikit functions -->
    <script src="<?php echo asset_url('pg_admin/assets/js/uikit_custom.min.js'); ?>"></script>
    <!-- altair core functions -->
    <script src="<?php echo asset_url('pg_admin/assets/js/altair_admin_common.min.js'); ?>"></script>
    <!-- altair login page functions -->
    <script src="<?php echo asset_url('pg_admin/assets/js/pages/login.min.js'); ?>"></script>
		<script src="<?php echo asset_url('js/jquery.min.js'); ?>"></script>  
		<script src="<?php echo asset_url('js/jquery.loading-indicator.js'); ?>"></script>
                <script src="<?php echo asset_url('js/bootstrap.min.js'); ?>"></script>
			    
                <script type="text/javascript">
					  // check for theme
        if (typeof(Storage) !== "undefined") {
            var root = document.getElementsByTagName( 'html' )[0],
                theme = localStorage.getItem("altair_theme");
            if(theme == 'app_theme_dark' || root.classList.contains('app_theme_dark')) {
                root.className += ' app_theme_dark';
            }
        }
                      $(document).ready(function() { 
          $('#guestlogin').click(function(){
                
                        jQuery.ajax({
                        type: "POST",
                        url: "<?php echo site_url('GuestLogin/ajax_signup') ?>",    
                        data: $(this).serialize(),
                        success: function(res) {
                            var data = JSON.parse(res);
                            if(data.status.Status == "success")
                            {  
                                $('#credentialerror').html("");
                                $('#usernameerror').html("");
                                $('#passerror').html("");
                               $(location).attr('href',data.status.URL);
                            } else if(data.status.Status == "wrong"){
                                $('#credentialerror').html(data.errormsg.credentialerror);
                                $('#usernameerror').html(data.errormsg.username);
                                $('#passerror').html(data.errormsg.password);
                            }
                            else{
                                $('#usernameerror').html(data.errormsg.username);
                                $('#passerror').html(data.errormsg.password);
                                $('#credentialerror').html("");
                            }
                         }
                        });
                      
            });
        });
            </script>
	</body>
</html>