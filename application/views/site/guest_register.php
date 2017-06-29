<?php $this->load->view('pg_admin/header'); ?>
<body class="top_menu">
    <!-- main header -->
   <?php $this->load->view('site/menues'); ?>


<div id="page_content">
    <div id="page_content_inner">

        <h2 class="heading_b uk-margin-bottom">Gust Registration</h2>

            <div class="md-card uk-margin-large-bottom">
                <div class="md-card-content">
                  <?php if($status=='success'):?>
                    <form class="uk-form-stacked" id="wizard_advanced_form" action="<?php echo base_url().'guestregister/guestregistration' ?>" name="wizard_advanced_form" method="post">
                        <div id="wizard_advanced">

                            <!-- first section -->
                            <h3>Gust information</h3>
                            <section>
                                <h2 class="heading_a">
                                    Gust Basic Information                                    
                                </h2>
                                <hr class="md-hr"/>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-2 parsley-row">
                                        <label for="first_name">First Name<span class="req">*</span></label>
                                        <input type="text" name="first_name" id="first_name" value="<?php echo (isset($guest_name)) ?$guest_name :''; ?>" required class="md-input" />
                                    </div>
                                    <div class="uk-width-medium-1-2 parsley-row">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="md-input" />
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-1 parsley-row">
                                        <label for="gust_address">Address<span class="req">*</span></label>
                                        <input type="text" name="gust_address" id="gust_address" required class="md-input" />
                                    </div>
                                </div>
                                <div class="uk-grid">                                 
                                    <div class="uk-width-medium-1-4 parsley-row">
                                        <label for="gust_city">City<span class="req">*</span></label>
                                        <input type="text" name="gust_city" id="gust_city" required class="md-input" />
                                    </div>
                                    <div class="uk-width-medium-1-4 parsley-row">
                                        <label for="gust_state">State<span class="req">*</span></label>
                                        <input type="text" name="gust_state" id="gust_state" required class="md-input" />
                                    </div>
                                    <div class="uk-width-medium-1-4 parsley-row">
                                        <label for="gust_zip">ZIP<span class="req">*</span></label>
                                        <input type="text" name="gust_zip" id="gust_zip" required class="md-input" />
                                    </div>
                                    <div class="uk-width-medium-1-4 parsley-row">
                                        <label for="gust_country">Country<span class="req">*</span></label>
                                        <input type="text" name="gust_country" id="gust_country" value="india" required class="md-input" />
                                    </div>
                               
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3 parsley-row">
                                        <label for="gust_birth">Birth Date<span class="req">*</span></label>
                                        <input type="text" name="gust_birth" id="gust_birth" required class="md-input" data-uk-datepicker="{format:'YYYY-MM-DD'}" />
                                    </div>
                                    <div class="uk-width-medium-1-3 parsley-row">
                                        <label class="uk-form-label">You Are<span class="req">*</span></label>
                                        <span class="icheck-inline">
                                            <input type="radio" name="you_are" id="you_are" required class="wizard-icheck" value="e" />
                                            <label for="you_are_employee" class="inline-label">Employee</label>
                                        </span>
                                        <span class="icheck-inline">
                                            <input type="radio" name="you_are" id="you_are_studet" class="wizard-icheck" value="s" />
                                            <label for="you_are_studet" class="inline-label">Student</label>
                                        </span>
                                    </div>
                                    <div class="uk-width-medium-1-3 parsley-row">
                                        <label class="uk-form-label">Gender<span class="req">*</span></label>
                                        <span class="icheck-inline">
                                            <input type="radio" name="gender" id="gender_male" required class="wizard-icheck" value="m" />
                                            <label for="gender_male" class="inline-label">Male</label>
                                        </span>
                                        <span class="icheck-inline">
                                            <input type="radio" name="gender" id="gender_female" class="wizard-icheck" value="f" />
                                            <label for="gender_female" class="inline-label">Female</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-width-medium-1-2 uk-grid-width-large-1-4" data-uk-grid-margin>
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            <i class="material-icons">&#xE0CD;</i>
                                        </span>
                                        <label for="gust_phone">Mobile Number<span class="req">*</span></label>
                                        <input type="text" class="md-input" name="gust_phone" value="<?php echo (isset($guest_mobile)) ? $guest_mobile :''; ?>"  id="gust_phone" required />
                                    </div>
                                    <div class="parsley-row">
                                        <div class="uk-input-group parsley-row">
                                            <span class="uk-input-group-addon">
                                                <i class="material-icons">&#xE0BE;</i>
                                            </span>
                                            <label for="gust_email">Email <span class="req">*</span></label>
                                            <input type="text" class="md-input" name="gust_email" value="<?php echo (isset($email)) ? $email :''; ?>" id="gust_email" required />
                                        </div>
                                    </div>
                                    <div class="uk-input-group parsley-row">
                                        <span class="uk-input-group-addon">
                                            <i class="material-icons">&#xE0CD;</i>
                                        </span>
                                        <label for="emergency_contact_no">Emergency Contact Number</label>
                                        <input type="text" class="md-input" name="emergency_contact_no" id="emergency_contact_no" required="true" />
                                    </div>
                                </div>
                            </section>

                            <!-- second section -->
                            <h3>Additional information</h3>
                            <section>
                                <h2 class="heading_a">
                                    Additional information
                                    <span class="sub-heading">Fill the additional details</span>
                                </h2>
                                <hr class="md-hr"/>
                                 <div class="uk-grid">
                                    <div class="uk-width-medium-1-1 parsley-row">
                                        <label for="gust_property_address">“Off Campus Living” Property Address / Office Address</label>
                                        <input type="text" name="gust_property_address" id="gust_property_address" required class="md-input" />
                                    </div>
                                </div>
                                 <div class="uk-grid">
                                    <div class="uk-width-medium-1-1 parsley-row">
                                        <label for="gust_permanent_address">Permanent Address </label>
                                        <input type="text" name="gust_permanent_address" id="gust_permanent_address" required class="md-input" />
                                    </div>
                                </div>
                                 
                                <div class="uk-grid uk-grid-width-large-1-2 uk-grid-width-xlarge-1-4" data-uk-grid-margin>
                                    <div class="parsley-row">
                                        <label for="gust_passport_no">Passport Number</label>
                                        <input type="text" name="gust_passport_no" id="gust_passport_no"  class="md-input" />
                                    </div>
                                    <div class="parsley-row">
                                        <label for="gust_voter_id">Voter ID Card Nummber</label>
                                        <input type="text" name="gust_voter_id" id="gust_voter_id"  class="md-input" />
                                    </div>
                                    <div class="parsley-row">
                                        <label for="gust_pan_no">Pan Card Number</label>
                                        <input type="text" name="gust_pan_no" id="gust_pan_no"  class="md-input" />
                                    </div>
                                    <div class="parsley-row">
                                        <label for="gust_enroll_id">College Enrollment No./ Employess Id</label>
                                        <input type="text" name="gust_enroll_id" id="gust_enroll_id"  class="md-input" />
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-xlarge-1-6" data-uk-grid-margin>
                                    <div class="parsley-row">
                                        <label for="gust_blood_group">Blood Group</label>
                                        <input type="text" name="gust_blood_group" id="gust_blood_group"  class="md-input" />
                                    </div>
                                </div>
                            </section>

                            <!-- third section -->
                            <h3>Background information</h3>
                            <section>
                                <h2 class="heading_a">
                                    Background information
                                    <span class="sub-heading"></span>
                                </h2>
                                <hr class="md-hr"/>
                               
                                 <div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-xlarge-1-4" data-uk-grid-margin>
                                    <div class="parsley-row">
                                        <label for="guest_father_name">Father Name<span class="req">*</span></label>
                                        <input type="text" name="guest_father_name" id="guest_father_name" required class="md-input" />
                                    </div>
                                    <div class="parsley-row">
                                        <label for="guest_mother_name">Mother Name<span class="req">*</span></label>
                                        <input type="text" name="guest_mother_name" id="guest_mother_name"  required class="md-input" />
                                    </div>
                                    <div class="parsley-row">
                                        <label for="guest_father_occ">Father Occupation</label>
                                        <input type="text" name="guest_father_occ" id="guest_father_occ"  class="md-input" />
                                    </div>
                                    <div class="parsley-row">
                                        <label for="wizard_vehicle_body">Mother Occupation</label>
                                        <input type="text" name="guest_mother_occ" id="guest_mother_occ"  class="md-input" />
                                    </div>
                                    <div class="parsley-row">
                                        <label for="wizard_vehicle_axles">Father Mobile No.</label>
                                        <input type="text" name="guest_father_mob" id="guest_father_mob" required class="md-input" />
                                    </div>
                                    <div class="parsley-row">
                                        <label for="guest_mother_mob">Mother Mobile No.</label>
                                        <input type="text" name="guest_mother_mob" id="guest_mother_mob" class="md-input" />
                                    </div>
                                    <div class="parsley-row">
                                        <label for="guest_father_email">Father Email Address</label>
                                        <input type="text" name="guest_father_email" id="guest_father_email" class="md-input" />
                                    </div>
                                    <div class="parsley-row">
                                        <label for="guest_mother_email">Mother Email Address</label>
                                        <input type="text" name="guest_mother_email" id="guest_mother_email" class="md-input" />
                                    </div>
                                </div>
                                <span class="uk-alert uk-alert-info"> <input type="checkbox" required name="agree" id="d_form_phone{{ counter }}" data-switchery /> <a href="<?php echo base_url().'content/terms_conditions' ?>" style="color:#fff;">By clicking here you agree to Term & Condition</a></span>                              
                            </section>

                        </div>
                        <input type="hidden" name="rand" value="<?php echo $rand; ?>"/>
                    </form>
                  <?php else:
                  echo '<p>'.$msg.'</p>';
                  endif;
                  ?>
                </div>
            </div>
     

    </div>
</div>
 <?php $this->load->view('pg_admin/footerjs'); ?>
  <!-- parsley (validation) -->
    <script>
    // load parsley config (altair_admin_common.js)
     altair_forms.parsley_validation_config();
    // load extra validators
    altair_forms.parsley_extra_validators();
    </script>
    <script src="<?php echo asset_url('pg_admin/bower_components/parsleyjs/dist/parsley.min.js');?>"></script>
  <!-- jquery steps -->
    <script src="<?php echo asset_url('pg_admin/assets/js/custom/wizard_steps.min.js');?>"></script>

    <!--  forms wizard functions -->
    <script src="<?php echo asset_url('pg_admin/assets/js/pages/forms_wizard.min.js');?>"></script>
</body>
</html>