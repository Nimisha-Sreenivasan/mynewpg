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
		<link rel="icon" type="image/png" href="<?php  echo asset_url('pg_admin/assets/img/favicon.png'); ?>" sizes="32x32">
                <style>
                    .entirebox{
                           text-align:center;
                            margin: 50px 0 100px 0;
                    }
                    .box{
                      background: rgba(9, 74, 128, 0.78);
                      
                      
                       min-height: 300px; 
                       padding: 100px 50px 50px 50px;
                       box-shadow: 2px 4px 4px #9a9898;
                    }
                    .box:hover{
                        opacity: 1.0;
                        
                    }
                    .link{
                        color:#fff;
                    }
                    .link a{
                        color:#fff;
                        text-decoration: none;
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
                            <div class="container">
                                <div class="row">
                                     <div class="col-md-12 entirebox">
                                          <div class="col-md-3 box">
                                         <div class="link">
                                             <p>If you are PG owner and don't have account click here to register
                                             <h3><a href="<?php echo base_url().'register' ?>"><button class="btn btn-success">Register</button></a></h3>
                                             </p>
                                         </div>
                                     </div>
                                     <div class="col-md-1"></div>
                                         <div class="col-md-3 box">
                                             <div class="link">
                                                 <p>If you are a PG owner click here to Login
                                                 <h3><a href="<?php echo base_url().'PGownerLogin' ?>"><button class="btn btn-success">PG Owner Login</button></a></h3>
                                                 </p>
                                             </div>
                                         </div>
                                          <div class="col-md-1"></div>
                                    <div class="col-md-3 box">
                                        <div class="link">
                                            <p>If you are a Guest click here to Login
                                            <h3><a href="<?php echo base_url().'GuestLogin' ?>"><button class="btn btn-success">Guest Login</button></a></h3>
                                            </p>
                                        </div>
                                    </div>
                                     <div class="col-md-1"></div>
                                    
                                    </div>
                                </div> 
                           </div>
                      
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
                       $('#click_form').click(function(){
                        jQuery.ajax({
                        type: "POST",
                        url: "<?php echo site_url('PGownerLogin/ajax_signup') ?>",    
                        data: $("#login").serialize(),
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
                                $('#usernameerror').html("");
                                $('#passerror').html("");
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