<?php $this->load->view('pg_admin/header'); ?>
	  <link rel="stylesheet" href="<?php echo asset_url('pg_admin/assets/skins/dropify/css/dropify.css'); ?>">
<?php
if(!empty($companyLogo)){
$companylogo= asset_url('company_logo/'.$companyLogo);

}else{
	$companylogo= "";
}
if(!empty($images['company_logo'])):
 ?>   
<style>
    .picture-element-principal{  background:url("<?php echo $images['company_logo']; ?>") no-repeat 50% 50% !important;  background-size: 167px 148px !important;  }
    </style>

 <?php   
endif;
?>

<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues',$userdetails); ?>
    <div id="page_content">
        <div id="page_content_inner">
			<div class="md-card">
                <div class="md-card-content">
					<div class="uk-accordion" data-uk-accordion>
					<h3 class="heading_c uk-accordion-title">Company Profile</h3>
					<div class="uk-grid uk-accordion-content" data-uk-grid-margin>
						 <div class="uk-width-medium-1-3">
                            <div style="padding:15px;">
                                <div class="uk-animation-toggle">
                                    <div class="uk-card uk-card-default uk-card-body uk-animation-scale-up">
                                        <p class="uk-text-center">
                                            <!-- upload image -->
                            <div class="form-group">                                            
                                           <input type='file' name='profilepic'id="uploadFile" class='dropify' data-default-file='<?php echo $companylogo;?>' data-disable-remove="true" width='100%'  height='100px'/>
                                            <i>Click on image to change company logo</i>
                                        </div>
                            <!-- upload image /-->  
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                                                     
                           
                        </div>
                        <div class="uk-width-medium-4-6">
						<form name="company_profile" id="company_profile">
						 <input type="hidden" value="<?php echo $secured_data['company_id']; ?>" id="company_id" name="company_id" />
						<div class="uk-width-medium-1-2 floatl"><br/>
                            <div style="margin: 43px -4px -4px -38px;">
                                
                                <div class="uk-form-row">
                                    <label for="pg_company_name">Company Name <span class="required">*</span></label>
                                    <input class="md-input" type="text" value="<?php echo $company_dtl[0]['company_name']; ?>" id="company_name" name="company_name"  />
                                </div>
								 <div class="uk-form-row">
                                    <label for="userEmail">Email <span class="required"></span></label>
                                    <input class="md-input" type="text"  value="<?php echo $userEmail[0]['email_id']; //echo $company_dtl[0]['company_email']; ?>"  id="company_email" name="company_email"  readonly/>
                                </div>
								 <div class="uk-form-row">
                                    <label for="pg_company_address">Company Address <span class="required">*</span></label>
                                    <textarea class="md-input" type="text" id="company_address"  name="company_address"  ><?php echo $company_dtl[0]['company_address']; ?></textarea>
                                </div>
								<div class="uk-form-row">
                                    <label for="pg_address_state">State <span class="required">*</span></label>
                                    <input class="md-input" type="text" id="company_state"   value="<?php echo $company_dtl[0]['company_state']; ?>"  name="company_state" />
                                </div>
								<div class="uk-form-row">
                                    <label for="pg_total_beds">Total Number of beds <span class="required"></span></label>
                                    <input class="md-input" type="text" id="total_beds"   value="<?php echo $calculateTotalBeds; ?>"  name="total_beds" readonly />
                                </div>
                            </div>
                        </div>
					<a class="md-fab md-fab-small md-fab-accent edit_pg_profile" style="float:right">
                        <i id="saveprofile" class="material-icons md-color-white"></i>
                    </a><!-- button for save company details-->
							
                        <div class="uk-width-medium-1-2 floatl">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="pg_address_web">WEB URL </label>
                                    <input class="md-input" type="text"  value="<?php echo $company_dtl[0]['company_website']; ?>"  id="company_website" name="company_website" />
                                </div>
								 <div class="uk-form-row">
                                    <label for="pg_address_line_2">Contact No <span class="required"></span></label>
                                    <input class="md-input" type="text"  value="<?php echo $userdetails[0]['mobile_no']; //echo $company_dtl[0]['company_contact_no']; ?>"  id="company_contact_no" name="company_contact_no" readonly />
                                </div>
								   <div class="uk-form-row">
                                    <label for="pg_address_line_2">City <span class="required">*</span></label>
                                    <input class="md-input" type="text" id="company_city"  value="<?php echo $company_dtl[0]['company_city']; ?>" name="company_city" />
                                </div>
								
								 <div class="uk-form-row">
                                    <label for="pg_address_pincode">Zip Code <span class="required">*</span></label>
                                    <input class="md-input" type="text" id="company_pin_code"   value="<?php echo $company_dtl[0]['company_pin_code']; ?>"  name="company_pin_code" />
                                </div>
								<div class="uk-form-row">
                                    <label for="pg_address_state">Police Station Name </label>
                                    <input class="md-input" type="text"  value="<?php echo $company_dtl[0]['company_police_station_name']; ?>"  id="company_police_station_name" name="company_police_station_name" />
                                </div>
                               
                            </div>
                        </div>
                       </form> 
                    </div>
					</div>
					  <h3 class="heading_c uk-margin-large-top uk-accordion-title">List of Features
					  </h3>
					  <form name="featureList" id="featureList" method="post">
					  <div class="uk-grid uk-margin-medium-top uk-accordion-content" data-uk-grid-margin>
					  <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
                              <input type="hidden" value="<?php echo $secured_data['company_id']; ?>" id="company_id" name="company_id" />  
							  <input type="hidden" value="<?php echo $company_dtl[0]['company_id']; ?>" id="companyID" name="companyID" />  
                               <div class="uk-form-row">
                             			<label><input name="f1" class="chkbox" id="f1" <?php echo ($company_dtl[0]['FullyFurnishedNewLuxuryrooms'] == '1' ? 'checked' : null); ?> type="checkbox">Fully Furnished New Luxury rooms</label>
                                </div>
                               <div class="uk-form-row">
                             			<label><input name="f2" class="chkbox" id="f2" <?php echo ($company_dtl[0]['LEDTVineveryroom'] == '1' ? 'checked' : null); ?> type="checkbox">LED TV in every room</label>
                                </div>
								<div class="uk-form-row">
                             			<label><input name="f3" class="chkbox" id="f3" <?php echo ($company_dtl[0]['Wi-FiConnectivity'] == '1' ? 'checked' : null); ?> type="checkbox">Wi-Fi Connectivity</label>
                                </div>
								<div class="uk-form-row">
                             			<label><input name="f4" class="chkbox"  id="f4" <?php echo ($company_dtl[0]['North&SouthIndianFood'] == '1' ? 'checked' : null); ?> type="checkbox">North & South Indian Food</label>
                                </div>
								<div class="uk-form-row">
                             			<label><input name="f5" class="chkbox"  id="f5" <?php echo ($company_dtl[0]['3timesfood'] == '1' ? 'checked' : null); ?> type="checkbox">3 times food</label>
                                </div>
								<div class="uk-form-row">
                             			<label><input name="f6" class="chkbox"  id="f6" <?php echo ($company_dtl[0]['WashingMachine,Fridge'] == '1' ? 'checked' : null); ?> type="checkbox">Washing Machine, Fridge</label>
                                </div>
                               
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
						<a id="save_featureList" class="md-fab md-fab-small md-fab-accent edit_pg_profile" style="float:right">
							<i class="material-icons md-color-white"></i>
						</a><!-- button for save Address details-->
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                             			<label><input name="f7" class="chkbox"  id="f7" <?php echo ($company_dtl[0]['AttachedBathrooms'] == '1' ? 'checked' : null); ?> type="checkbox">Attached Bathrooms</label>
                                </div>
                               <div class="uk-form-row">
                             			<label><input name="f8" class="chkbox"  id="f8" <?php echo ($company_dtl[0]['24hrsHOTwater'] == '1' ? 'checked' : null); ?> type="checkbox">24hrs HOT water</label>
                                </div>
								<div class="uk-form-row">
                             			<label><input name="f9" class="chkbox" id="f9" <?php echo ($company_dtl[0]['2&4Wheeervehicleparking'] == '1' ? 'checked' : null); ?>  type="checkbox">2 & 4 Wheeer vehicle parking</label>
                                </div>
								<div class="uk-form-row">
                             			<label><input name="f10" class="chkbox"  id="f10" <?php echo ($company_dtl[0]['24hrsSecurity'] == '1' ? 'checked' : null); ?> type="checkbox">24hrs Security</label>
                                </div>
								<div class="uk-form-row">
                             			<label><input name="f11" class="chkbox"  id="f11" <?php echo ($company_dtl[0]['123Sharing'] == '1' ? 'checked' : null); ?> type="checkbox">1, 2 , 3 Sharing</label>
                                </div>
							</div>
                        </div>
					  </div>
					  </form>

				 <h3 class="heading_c uk-margin-large-top uk-accordion-title">Online Payment Details to CyberPact Solutions</h3>
					  <form name="online_payment_details" id="online_payment_details">
						 <input type="hidden" value="<?php echo $secured_data['company_id']; ?>" id="abcompany_id" name="company_id" />
					  <div class="uk-grid uk-margin-medium-top uk-accordion-content" data-uk-grid-margin>
					  <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
								<div class="uk-form-row">
                                    <label for="card_name">Bank Name</label>
                                    <input class="md-input" type="text" id="card_name"  value="<?php echo "Karnataka Bank"; ?>"  name="card_name" readonly/>
                                </div>
								 <div class="uk-form-row">
                                    <label for="company_ifsc">IFSC Code</label>
                                    <input class="md-input" type="text" id="company_ifsc"  value="<?php echo "KARB0000907"; ?>"  name="company_ifsc" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
								 <div class="uk-form-row">
                                    <label for="company_ifsc">Account Number</label>
                                    <input class="md-input" type="text" id="company_card_state"  value="<?php echo "9072000100042201"; ?>"  name="company_card_state" readonly/>
                                </div>
								 <div class="uk-form-row">
                                    <label for="card_number">Pan Card Number</label>
                                    <input class="md-input" type="text" id="card_number"  value="<?php echo "AALFC6912A"; ?>" name="card_number" readonly/>
                                </div>
                            </div>
                        </div>
                        
					  </div>
					  </form>
				</div>
        </div>
        </div><!-- end accordion-->
    </div>
             
<!-- model /-->

  <?php $this->load->view('pg_admin/footerjs'); ?>
      <script src="<?php echo asset_url('pg_admin/assets/js/custom/dropify/dist/js/dropify.min.js'); ?>"></script>

    <!--  form file input functions -->
    <script src="<?php echo asset_url('pg_admin/assets/js/pages/forms_file_input.min.js'); ?>"></script>
</body>
</html>
<script>

		
$(document).ready(function() {	
   $('#mcprofile').addClass('current_section'); 
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
				company_address: "required",					
				company_city: "required",					
				company_state: "required",					
				company_pin_code:{
					required: true,	
					zipcode:true,
				}			
				/*company_email: {
					required: true,
					email: true,
					validemail:true
				},*/	
				/*company_PAN: {
					 required: true,
					 pan: true					 
					},*/
			/*	company_contact_no: {
					required: true,
					specialChars: true,
					number: true,
					minlength: 10,	
					maxlength: 10,			

					}*/
				
			},
			messages: {
				
				company_name: "Please provide your company name",				
				company_address: "Please provide your company address",				
				company_city: "Please provide your company city",				
				company_state: "Please provide your company state",				
				company_pin_code:{
					required:"Please provide your zip code",
					zipcode:"Please enter valid PIN code",
				},			
				/*company_email: {
					required: "Please provide your email address",
					email:"Please provide a valid email address",
					validemail:"Please provide a valid email address",
					},*/
				/*company_PAN: {required: "Please provide your pan card no", pan:"Please provide a valid pan card no"},*/
				/*company_contact_no: {
					required: "Please provide your contact number",
					specialChars:"please use only alphanumeric or alphabetic characters",
					number: "Please enter a valid contact number.",			
					minlength: "Contact number should be 10 digits",
					maxlength: "Contact number should be 10 digits",	
				}*/
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
		
		$('#saveprofile').click(function(){
			var form = $( "#company_profile" );
			if(form.valid()==true){
				jQuery.ajax({
					type: "POST",
					url: "<?php echo site_url('pg_admin/dashboard/saveCompanyDetails') ?>",    
					data: $("#company_profile").serialize(),
					success: function(res) {
						var data = JSON.parse(res);                 
						  $("#company_id").val(data.record_id);
						if(data.insertorupdate == "inserted"){
						UIkit.modal.alert("Company profile saved successfully.");
						}
						else{
						UIkit.modal.alert("Company profile updated successfully.");
						}
						   
						   //$(location).attr('href',data.status.URL);
					}
                });
			}
        });
		
var chk1=0; 
var chk2=0; 
var chk3=0; 
var chk4=0;
var chk5=0;
var chk6=0;
var chk7=0;
var chk8=0;
var chk9=0;
var chk10=0;
var chk11=0;
	
	$('#save_featureList').click(function(){
		var form = $( "#featureList" );
		var getcompanyID= $('#companyID').val();
		if(getcompanyID == '')
		{
		UIkit.modal.alert('Please add your company details.');    
		return false;
		}
		else{
		if($("#f1").prop("checked") == true){chk1 = 1; }
		if($("#f2").prop("checked") == true){ chk2 = 1; }
		if($("#f3").prop("checked") == true){ chk3 = 1; }

		if($("#f4").prop("checked") == true){ chk4 = 1; }
		if($("#f5").prop("checked") == true){ chk5 = 1; }
		if($("#f6").prop("checked") == true){ chk6 = 1; }

		if($("#f7").prop("checked") == true){ chk7 = 1; }
		if($("#f8").prop("checked") == true){ chk8 = 1; }
		if($("#f9").prop("checked") == true){ chk9 = 1; }
		if($("#f10").prop("checked") == true){ chk10 = 1; }
		if($("#f11").prop("checked") == true){ chk11 = 1; }
		var profile_id =  '<?php echo $secured_data['company_id']; ?>';	

		if(form.valid()==true){
			jQuery.ajax({
				type:"POST",
				url: "<?php echo site_url('pg_admin/dashboard/addFeatureList') ?>",    
				data:{f1: chk1,f2: chk2,f3: chk3,f4: chk4,f5: chk5,f6: chk6,f7: chk7,f8: chk8,f9: chk9,f10: chk10,f11: chk11,profile_id:profile_id},
				success: function(res) {
				var data = JSON.parse(res);
					$("#company_id").val(data.record_id);
					UIkit.modal.alert('Feature list updated successfully');    
				}
		});
		}
	}//end else
		});



			
 });
	
	
	//$('input[type="checkbox"]').change(function(){
  //  this.value ^= 1;
//});
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
<script type="text/javascript">
$(function() {
    $("#uploadFile").on("change", function()
    {
		var file_data = $('#uploadFile').prop('files')[0]; 
         var form_data = new FormData();                  
         form_data.append('file', file_data);
	 $.ajax({
                type: "POST",
                url: "<?php echo site_url('pg_admin/dashboard/profileUpload') ?>",
                processData: false,
                contentType: false,
                data: form_data,     
            //data: {
              //      fileupload: fileupload,
               //     a: 'naddressupload'},
                
                success: function(msg){
				console.log('success uploaded');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                   console.log('not success upload');
                }
                });   	
     

    });
});
</script>