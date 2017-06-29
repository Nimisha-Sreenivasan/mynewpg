<?php $this->load->view('pg_guest/header'); ?>
<?php
if(!empty($guestuser_dtl['passport_size_photo'])):
 ?>   
<style>
    .picture-element-principal{  background:url("<?php echo $guestuser_dtl['passport_size_photo']; ?>") no-repeat 50% 50% !important;  background-size: 167px 148px !important;  }
    </style>
 <?php   
endif;
?>

<body class=" sidebar_main_open sidebar_main_swipe">
    <?php $this->load->view('pg_guest/menues'); ?>
    <div id="page_content" >
        <div id="page_content_inner">
			<div class="md-card">
                <div class="md-card-content">
		
					
					<div class="uk-accordion" data-uk-accordion>
						
						<h3 class="uk-accordion-title"><b>User Profile</b></h3>
					<div class="uk-grid uk-accordion-content" data-uk-grid-margin>
						 <div class="uk-width-medium-1-3">
                            <div style="padding:15px;">
                                <div class="uk-animation-toggle">
                                    <div class="uk-card uk-card-default uk-card-body uk-animation-scale-up">
                                        <p class="uk-text-center">
                                            <!-- upload image -->
                            <div class="form-group">                                            
                                            <div id="container_photo"></div>
								<?php $getPhoto = base_url($guestuser_dtl[0]['passport_size_photo']);
									
								
									  $getdefaultimage =base_url('application/icon_images/profilephoto.png');
								if (file_exists($guestuser_dtl[0]['passport_size_photo'])) { ?>
									<img src='<?php echo $getPhoto;?>' alt='profilephoto' width='100%' height='100%'/>		
							<?php 
						} else {?>
								<img src='<?php echo $getdefaultimage;?>' alt='' style='vertical-align: super;height:213px'/>			 
						<?php }?>
								</div>
                            <!-- upload image /-->  
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-4-6">
						<form name="company_profile" id="company_profile">
						
						<div class="uk-width-medium-1-2 floatl">
                            <div style="padding:15px;">
                                
                                <div class="uk-form-row">
                                    <label for="total_bed">First Name <span class="required"></span></label>
                                    <input class="md-input" type="text" value="<?php echo $guestuser_dtl[0]['first_name']; ?>" id="company_name" name="company_name"  readonly/>
                                </div>
								 <div class="uk-form-row">
                                    <label for="total_bed">Gender<span class="required"></span></label>
                                    <input class="md-input" type="text" value="<?php echo $guestuser_dtl[0]['gender']; ?>" id="company_name" name="company_name" readonly />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_line_2">Mobile Number <span class="required"></span></label>
                                    <input class="md-input" type="text" id="company_PAN" value="<?php echo $guestuser_dtl[0]['mobile_no']; ?>" name="company_PAN" readonly/>
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_state">City </label>
                                    <input class="md-input" type="text" id="company_service_tx_no"  value="<?php echo $guestuser_dtl[0]['city']; ?>" name="company_service_tx_no" readonly />
                                </div>
								<div class="uk-form-row">
                                    <label for="pg_address_line_2">Country <span class="required"></span></label>
                                    <input class="md-input" type="text"  value="<?php echo $guestuser_dtl[0]['gust_country']; ?>"  id="company_contact_no" name="company_contact_no"  readonly/>
                                </div>
                               <div class="uk-form-row">
                                    <label for="pg_address_line_2">Blood Group <span class="required"></span></label>
                                    <input class="md-input" type="text"  value="<?php echo $guestuser_dtl[0]['gust_blood_group']; ?>"  id="company_contact_no" name="company_contact_no"  readonly/>
                                </div>
								<div class="uk-form-row">
                                    <label for="pg_address_line_2">Profile ID <span class="required"></span></label>
                                    <input class="md-input" type="text"  value="<?php echo $guestuser_dtl[0]['g_prof_id']; ?>"  id="company_contact_no" name="company_contact_no"  readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2 floatl">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="total_bed">Last Name <span class="required"></span></label>
                                    <input class="md-input" type="text"  value="<?php echo $guestuser_dtl[0]['last_name']; ?>"  id="company_email" name="company_email"  readonly/>
                                </div>
								<div class="uk-form-row">
                                    <label for="total_bed">Birth Date<span class="required"></span></label>
                                    <input class="md-input" type="text" value="<?php echo $guestuser_dtl[0]['gust_birth']; ?>" id="company_name" name="company_name"  readonly/>
                                </div>
								 <div class="uk-form-row">
                                    <label for="pg_address_pincode">Email </label>
                                    <input class="md-input" type="text"  value="<?php echo $guestuserinfo_dtl[0]['email_id']; ?>"  id="company_tan" name="company_tan" readonly/>
                                </div>
                               
                                <div class="uk-form-row">
                                    <label for="pg_address_state">State </label>
                                    <input class="md-input" type="text"  value="<?php echo $guestuser_dtl[0]['state']; ?>"  id="company_website" name="company_website" readonly/>
                                </div>
								 <div class="uk-form-row">
                                    <label for="pg_address_state">Pin Code </label>
                                    <input class="md-input" type="text"  value="<?php echo $guestuser_dtl[0]['pincode']; ?>"  id="company_website" name="company_website" readonly/>
                                </div>
								 <div class="uk-form-row">
                                    <label for="pg_address_line_2">Address <span class="required"></span></label>
                                    <input class="md-input" type="text"  value="<?php echo $guestuser_dtl[0]['address']; ?>"  id="company_contact_no" name="company_contact_no"  readonly/>
                                </div>
								<div class="uk-form-row">
                                    <label for="pg_address_state">Emergency Mobile Number </label>
                                    <input class="md-input" type="text"  value="<?php echo $guestuser_dtl[0]['emergency_contact_no']; ?>"  id="company_police_station_name" name="company_police_station_name" readonly/>
                                </div>
                                
                            </div>
                        </div>
                       </form> 
                    </div>
					</div>

					<h3 class="uk-accordion-title"><b>Parents/Guardians Details</b></h3>
						<div class="uk-accordion-content" data-uk-grid-margin >
					  <form name="company_bankaddress" id="company_bankaddress">
						 <input type="hidden" value="" id="abcompany_id" name="company_id" readonly/>
					  <div class="uk-grid uk-margin-medium-top" data-uk-grid-margin>
					  <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
								<div class="uk-form-row">
                                    <label for="total_bed">Father Name <span class="required"></span></label>
                                   <input class="md-input" type="text" id="FatherName"  value="<?php echo $guestuser_dtl[0]['guest_father_name']; ?>" name="FatherName" readonly/>
                                </div>
                                <div class="uk-form-row">
                                    <label for="total_bed">Mother Name <span class="required"></span></label>
                                   <input class="md-input" type="text" id="MotherName"  value="<?php echo $guestuser_dtl[0]['guest_mother_name']; ?>" name="MotherName" readonly />
                                </div>
								<div class="uk-form-row">
                                    <label for="total_bed">Father Occupation <span class="required"></span></label>
                                   <input class="md-input" type="text" id="FatherOccu"  value="<?php echo $guestuser_dtl[0]['guest_father_occ']; ?>" name="FatherOccu" readonly />
                                </div>
                                 <div class="uk-form-row">
                                    <label for="pg_address_line_2">Father Mobile Number <span class="required"></span></label>
                                    <input class="md-input" type="text" id="FatherNo"  value="<?php echo $guestuser_dtl[0]['guest_father_mob']; ?>" name="FatherNo"readonly />
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
								<div class="uk-form-row">
                                    <label for="total_bed">Father Email <span class="required"></span></label>
                                   <input class="md-input" type="text" id="FatherEmail"  value="<?php echo $guestuser_dtl[0]['guest_father_email']; ?>" name="FatherEmail" readonly />
                                </div>
								<div class="uk-form-row">
                                    <label for="pg_address_line_2">Mother Email  <span class="required"></span></label>
                                    <input class="md-input" type="text" id="MotherEmail"  value="<?php echo $guestuser_dtl[0]['guest_mother_email']; ?>" name="MotherEmail" readonly/>
                                </div>
								<div class="uk-form-row">
                                    <label for="pg_address_line_2">Mother Occupation  <span class="required"></span></label>
                                    <input class="md-input" type="text" id="MotherOccu"  value="<?php echo $guestuser_dtl[0]['guest_mother_occ']; ?>" name="MotherOccu" readonly/>
                                </div>
								 <div class="uk-form-row">
                                    <label for="pg_address_line_2">Mother Mobile Number <span class="required"></span></label>
                                    <input class="md-input" type="text" id="MotherNo"  value="<?php echo $guestuser_dtl[0]['guest_mother_mob']; ?>" name="MotherNo"readonly />
                                </div>
                            </div>
                        </div>
                        
					  </div>
					  </form>
						  </div>
   
				</div><!--end .accordion-->
        </div>
    </div>
             
<!-- model /-->

  <?php $this->load->view('pg_guest/footerjs'); ?>
</body>
</html>
<script>
	 $('#dashboard_menu').addClass('current_section'); 
$(document).ready(function() {	
    // check client side validation of company profiles 
	    $("#company_profile").validate({
			errorElement: 'div',
			errorClass: 'parsley-errors-list filled',
			highlight: function(element) {
			   $(element).addClass('md-input-danger');
			   $(element).parent('div').addClass('md-input-wrapper-danger');
		   },
		   unhighlight: function(element) {
			   $(element).removeClass('md-input-danger');
			   $(element).parent('div').removeClass('md-input-wrapper-danger');
		   },
			rules: {				
				company_name: "required",								
				company_email: {
					required: true,
					email: true,
					validemail:true
				},	
				company_PAN: {
					 required: true,
					 pan: true					 
					},
				company_contact_no: {
					required: true,
					specialChars: true,
					number: true,
					minlength: 10,	
					maxlength: 10,			

					}
				
			},
			messages: {
				
				company_name: "Please provide your company name",							
				company_email: {
					required: "Please provide your email address",
					email:"Please provide a valid email address",
					validemail:"Please provide a valid email address",
					},
				company_PAN: {required: "Please provide your pan card no", pan:"Please provide a valid pan card no"},
				company_contact_no: {
					required: "Please provide your contact number",
					specialChars:"please use only alphanumeric or alphabetic characters",
					number: "Please enter a valid contact number.",			
					minlength: "Contact number should be 10 digits",
					maxlength: "Contact number should be 10 digits",	
				}
			},
			errorElement: "div",
						errorPlacement: function(error, element) {
							element.parent('div').after(error);
			}
		});
	 // check client side validation of Address & Account Details
	    $("#company_bankaddress").validate({
			errorElement: 'div',
			errorClass: 'parsley-errors-list filled',
			highlight: function(element) {
			   $(element).addClass('md-input-danger');
			   $(element).parent('div').addClass('md-input-wrapper-danger');
		    },
		    unhighlight: function(element) {
			   $(element).removeClass('md-input-danger');
			   $(element).parent('div').removeClass('md-input-wrapper-danger');
		    },
			rules: {
				company_address:"required",
				company_city:"required",
				company_state:"required",
				company_pin_code:{
					required: true,	
					zipcode:true,
				},				
				company_bank_name:"required",
				company_bank_acc_no: {
					required: true,					
					number: true,
					minlength: 11,	
					maxlength: 15,	
				},
				company_ifsc: {
					required: true,					
					ifsccode: true
				}
			},
			messages: {
				company_address:"Please provide your company address",
				company_city:"Please provide your city",
				company_state:"Please provide your state",
				company_pin_code:{
					required:"Please provide your zip code",
					zipcode:"Please enter valid PIN code",
				},
				company_bank_name:"Please provide your bank name",
				company_bank_acc_no: {
					required:"Please enter your bank account number",
					number:"Please enter a valid account number",							
					minlength: "Bank account number consist of min. 11 digits",
					maxlength: "Bank account number consist of max. 15 digits",
				},
				company_ifsc: {
					required:"Please enter your bank account number",
					ifsccode:"Please enter a valid IFSC Code"						
					
				}	
			},
			errorElement: "div",
						errorPlacement: function(error, element) {
							element.parent('div').after(error);
			}
		});		
 });
</script>
<script src="http://picturecut.tuyoshi.com.br/dependencies/jquery-ui-1.11.1.custom/jquery-ui.min.js"></script>
 <script src="<?php echo asset_url("jquery.picture.cut/src/jquery.picture.cut.js"); ?>"></script>  

    <script>
    $("#container_photo").PictureCut({                    
    InputOfImageDirectory       : "image",
    PluginFolderOnServer        : "/assets/jquery.picture.cut/",
    FolderOnServer              : "/assets/temp_img/",    
    EnableCrop                  : true,
    CropWindowStyle             : "Bootstrap",              
});

function initveriables(){
     var profile_id =  '<?php echo $secured_data['company_id']; ?>';
     localStorage.setItem("profile_id",profile_id);     
 }
 initveriables();
 function finalise_upload(){ 
     $.post( "<?php echo base_url()."pg_admin/dashboard/saveCompanyLogo"; ?>", { profile_id: localStorage.getItem('profile_id'), img_name: localStorage.getItem('image_name') }).done(function( data ) { $("#respimg").html(data); });
						  }
</script>