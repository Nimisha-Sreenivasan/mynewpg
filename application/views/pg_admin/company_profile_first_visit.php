<?php $this->load->view('pg_admin/header'); ?>
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues'); ?>
    <div id="page_content" >
        <div id="page_content_inner">

            <!-- statistics (small charts) -->
            <h2><span class="alert_msg" style="float:right; font-size:14px; color:red;"></span></h2><br/>
            <form name="company_profile" id="company_profile">
            <div class="md-card">
                           
                <h3 class="pg_profile_heading_bar">
                    Company Profile
                    <a class="md-fab md-fab-small md-fab-accent edit_pg_profile" style="float:right">
                        <i id="saveprofile" class="material-icons md-color-white"></i>
                    </a>
                </h3>
                
                <div class="uk-form-row">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-3">
                            <div style="padding:15px;">
                                <div class="uk-animation-toggle">
                                    <div class="uk-card uk-card-default uk-card-body uk-animation-scale-up">
                                        <p class="uk-text-center">
                                            <!-- upload image -->
                            <div class="form-group">                                            
                                            <div id="container_photo"></div>
                                            <i>Click on image to change company logo</i>
                                        </div>
                            <!-- upload image /--> 
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- upload image -->
                            
                            <!-- upload image /-->                            
                            <input type="hidden" value="" id="company_id" name="company_id" />
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div style="padding:15px;">
                                
                                <div class="uk-form-row">
                                    <label for="total_bed">Company Name<span style="color:red">*</span></label>
                                    <input class="md-input" type="text" id="company_name" name="company_name"  />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_line_2">Company PAN</label>
                                    <input class="md-input" type="text" id="company_PAN" name="company_PAN" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_state">Service Tax No.<span style="color:red">*</span></label>
                                    <input class="md-input" type="text" id="company_service_tx_no" name="company_service_tx_no" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_pincode">TAN<span style="color:red">*</span></label>
                                    <input class="md-input" type="text" id="company_tan" name="company_tan" />
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="total_bed">Email<span style="color:red">*</span></label>
                                    <input class="md-input" type="text" id="company_email" name="company_email"  />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_line_2">Contact No</label>
                                    <input class="md-input" type="text" id="company_contact_no" name="company_contact_no" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_state">WEB URL<span style="color:red">*</span></label>
                                    <input class="md-input" type="text" id="company_website" name="company_website" />
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </form>
           
            <div class="md-card ">
                <h3 class="pg_profile_heading_bar">
                    Address & Account Details
                    <a class="md-fab md-fab-small md-fab-accent edit_pg_profile" style="float:right">
                        <i class="material-icons md-color-white"></i>
                    </a>
                </h3>
                
                <div class="uk-form-row">
                    <div class="uk-grid">
                        
                        <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="total_bed">Company Address<span style="color:red">*</span></label>
                                    <textarea class="md-input" type="text" id="company_address" name="company_address"  ></textarea>
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_line_2">City</label>
                                    <input class="md-input" type="text" id="company_city" name="company_city" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_state">State<span style="color:red">*</span></label>
                                    <input class="md-input" type="text" id="company_state" name="company_state" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_pincode">Zip Code<span style="color:red">*</span></label>
                                    <input class="md-input" type="text" id="company_pin_code" name="company_pin_code" />
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="total_bed">Company Bank Name</label>
                                    <input class="md-input" type="text" id="company_bank_name" name="company_bank_name"  />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_line_2">Account  Number</label>
                                    <input class="md-input" type="text" id="company_bank_acc_no" name="company_bank_acc_no" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_state">IFSC Code<span style="color:red">*</span></label>
                                    <input class="md-input" type="text" id="company_ifsc" name="company_ifsc" />
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
           

        </div>
    </div>
             <!-- model -->
                <div id="lslslsn" class="uk-modal" >
                    <div class="uk-modal-dialog uk-modal-body">
                        <h2 class="uk-modal-title">Success</h2>
                        <p>Your Company profile is created</p>
                        <p>You can edit company profile in <i>company profile</i> menu.</p>
                        <p class="uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                            <button onclick="location.href = '<?php echo base_url()."pg_admin/dashboard/companyprofile" ?>';"  class="uk-button uk-button-primary" type="button">Company profile</button>
                        </p>
                    </div>
                </div>
            <!-- model -->
             <!-- model -->
                <div id="firstvisit" class="uk-modal" >
                    <div class="uk-modal-dialog uk-modal-body">
                        <h2 class="uk-modal-title">Attention</h2>
                        <p>Add your PG Company Details.</p>
                        <p>You can edit company profile in <i>company profile</i> menu.</p>
                        <p class="uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                            <button onclick="skipcompany()"  class="uk-button uk-button-primary" type="button">Will Add Later</button>
                        </p>
                    </div>
                </div>
            <!-- model -->
<!--<a class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light make_payment" data-uk-modal="{target:'#lslslsn'}" style="float:right;margin-top: -25px;">Create Receipt</a>-->
<!-- model /-->

  <?php $this->load->view('pg_admin/footerjs'); ?>

</body>
</html>
<script>
    $('#dashboard_menu').addClass('current_section'); 
    UIkit.modal("#firstvisit").show();
    //UIkit.modal.alert("response.text");
     $('#saveprofile').click(function(){
                        jQuery.ajax({
                        type: "POST",
                        url: "<?php echo site_url('pg_admin/dashboard/saveCompanyDetails') ?>",    
                        data: $("#company_profile").serialize(),
                        success: function(res) {
                            var data = JSON.parse(res);
                            if(data.status == "success")
                            {                                
                               $("#company_id").val(data.record_id);
                               UIkit.modal("#lslslsn").show();
                               //$(location).attr('href',data.status.URL);
                            } 
                         }
                        });
                      });
    function skipcompany()
    {      
        jQuery.ajax({
        type: "POST",
        url: "<?php echo site_url('pg_admin/dashboard/skipaddcompany') ?>",    
        data: "",
        success: function(res) {
            var data = JSON.parse(res);
            if(data.status == "success")
            { 
               $(location).attr('href',data.URL);
            } 
         }
        });
                        
    }
</script>

<script src="http://picturecut.tuyoshi.com.br/dependencies/jquery-ui-1.11.1.custom/jquery-ui.min.js"></script>
 <script src="<?php echo asset_url('jquery.picture.cut/src/jquery.picture.cut.js'); ?>"></script>  

    <script>
    $("#container_photo").PictureCut({                    
    InputOfImageDirectory       : "image",
    PluginFolderOnServer        : "/assets/jquery.picture.cut/",
    FolderOnServer              : "/assets/temp_img/",    
    EnableCrop                  : true,
    CropWindowStyle             : "Bootstrap",              
});

function initveriables(){
     var profile_id =  '';
     localStorage.setItem("profile_id",profile_id);     
 }
 initveriables();
 function finalise_upload(){ 
     $.post( "<?php echo base_url()."pg_admin/dashboard/saveCompanyLogo"; ?>", { profile_id: localStorage.getItem('profile_id'), img_name: localStorage.getItem('image_name') }).done(function( data ) { $("#respimg").html(data); });
						  }
                       
</script>