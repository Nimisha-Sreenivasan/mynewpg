<?php $this->load->view('pg_admin/header'); ?>
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues'); ?>
    <div id="page_content">
        <div id="page_content_inner">
            <!-- statistics (small charts) -->
            <h2><span class="alert_msg" style="float:right; font-size:14px; color:red;"></span></h2><br/>
            <div class="md-card">
                <h3 class="pg_profile_heading_bar">
                    PG Profile
                    <a class="md-fab md-fab-small md-fab-accent edit_pg_profile" style="float:right">
                        <i class="material-icons md-color-white"></i>
                    </a>
                </h3>

                <div class="uk-form-row">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="pg_name">PG Name<span class="required">*</span></label>
                                    <input class="md-input" type="text" id="pg_name" name="pg_name" />
                                </div>
                                <div class="uk-form-row md-input-filled">
                                    <label for="pg_address_line_1">Address Line-1<span class="required">*</span></label>
                                    <input class="md-input" type="text" id="pg_address_line_1" name="pg_address_line_1" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_city">City<span class="required">*</span></label>
                                    <input class="md-input" type="text" id="pg_address_city" name="pg_address_city" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_country">Country<span class="required">*</span></label>
                                    <input class="md-input" type="text" id="pg_country" name="pg_country" value="India" />
                                </div>
                                
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="total_bed">Total Bed available<span class="required">*</span></label>
                                    <input class="md-input" type="text" id="total_bed" name="total_bed" maxlength="4" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_line_2">Address Line-2</label>
                                    <input class="md-input" type="text" id="pg_address_line_2" name="pg_address_line_2" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_state">State<span class="required">*</span></label>
                                    <input class="md-input" type="text" id="pg_address_state" name="pg_address_state" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_address_pincode">PIN Code<span class="required">*</span></label>
                                    <input class="md-input" type="text" id="pg_address_pincode" name="pg_address_pincode" maxlength="6" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <h3 class="pg_profile_heading_bar">Contact Details</h3>
                <div class="uk-form-row">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="pg_contact_fname">First Name<span class="required">*</span></label>
                                    <input class="md-input" type="text" id="pg_contact_fname" name="pg_contact_fname" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="contact_mobile">Mobile<span class="required">*</span></label>
                                   <input class="md-input" type="text" id="contact_mobile" name="contact_mobile" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"maxlength="10" />
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="pg_contact_lname">Last Name</label>
                                    <input class="md-input" type="text" id="pg_contact_lname" name="pg_contact_lname" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="contact_email">Email Id<span class="required">*</span></label>
                                    <input class="md-input" type="text" id="contact_email" name="contact_email" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="pg_profile_heading_bar">Social Links</h3>
                <div class="uk-form-row">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="pg_facebook">Facebook</label>
                                    <input class="md-input" type="text" id="pg_facebook" name="pg_facebook" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_linkedin">Linked In</label>
                                    <input class="md-input" type="text" id="pg_linkedin" name="pg_linkedin" />
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div style="padding:15px;">
                                <div class="uk-form-row">
                                    <label for="pg_twitter">Twitter</label>
                                    <input class="md-input" type="text" id="pg_twitter" name="pg_twitter" />
                                </div>
                                <div class="uk-form-row">
                                    <label for="pg_google_plus">Google Plus</label>
                                    <input class="md-input" type="text" id="pg_google_plus" name="pg_google_plus" />
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    <!-- This is the modal -->
    <div id="change_password_modal" class="uk-modal">
        <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close add_guest_close"></a>
            <h2 style="border-bottom: 1px solid #ccc; padding: 5px;">Fill the details <span class="change_pwd_alert_msg" style="float:right; font-size:14px; color:red;"></span></h2>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1">
                        <div class="md-input-wrapper"><label>Old Password<span style="color:red">*</span></label><input type="password" class="md-input old_password" autocomplete="off"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1">
                        <div class="md-input-wrapper"><label>New Password<span style="color:red">*</span></label><input type="password" class="md-input new_password" autocomplete="off"><span class="md-input-bar"></span></div>
                    </div>
                    
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium">
                        <div class="md-input-wrapper"><label>Confirm New Password<span style="color:red">*</span></label><input type="password" class="md-input confirm_new_password" autocomplete="off"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            
            <div style="width:100%; text-align:center;    margin-top: 15px;">
                <button class="btn_change_password md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" style="width:100px;">Change</button>
            </div>
        </div>
    </div>


    <!-- This is the modal -->
    <div id="global_add_guest" class="uk-modal">
        <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close add_guest_close"></a>
            <h2 style="border-bottom: 1px solid #ccc; padding: 5px;">Fill the details <span class="alert_msg" style="float:right; font-size:14px; color:red;"></span></h2>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>First Name <span style="color:red">*</span></label><input type="text" class="md-input guest_fname"><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Last Name</label><input type="text" class="md-input guest_lname"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Mobile Number <span style="color:red">*</span></label><input type="text" class="md-input guest_mobile" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" maxlength="10"><span class="md-input-bar" ></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Email Id <span style="color:red">*</span></label><input type="text" class="md-input guest_email"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium">
                        <div class="md-input-wrapper"><label>Permanent Address<span style="color:red">*</span></label><input type="text" class="md-input guest_address"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1">
                        <div class="md-input-wrapper"><label>Company working at - Name and Address </label><input type="text" class="md-input guest_company_address"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div style="width:100%; text-align:center;    margin-top: 15px;">
                <button class="add_guest_save md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" style="width:100px;">Save</button>
            </div>
        </div>
    </div>


    <!-- This is the modal -->
    <div id="global_make_payment" class="uk-modal">
        <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close add_guest_close"></a>
            <h2 style="border-bottom: 1px solid #ccc; padding: 5px;">Fill the details <span class="alert_msg" style="float:right; font-size:14px; color:red;"></span></h2>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"> <label>Name <span style="color:red">*</span></label><input type="text" class="md-input payment_name"><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Amount<span style="color:red">*</span></label><input type="text" class="md-input payment_amount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>

            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium">
                        <div class="md-input-wrapper md-input-filled"><label>Payment Description</label><input type="text" class="md-input payment_description" value="Monthly Rent"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Discount if Any (in Rupees) <span style="color:red"></span></label><input type="text" value="0" class="md-input payment_discount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Final Amount<span style="color:red"></span></label><input type="text" class="md-input payment_final_amount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly="readonly"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div style="width:100%; text-align:center;    margin-top: 15px;">
                <button class="payment_submit md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" style="width:100px;">Pay</button>
            </div>
        </div>
    </div>
  <?php $this->load->view('pg_admin/footerjs'); ?>
<script type="text/javascript" src="<?php echo asset_url('pg_admin/js/jquery.validate.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('pg_admin/js/custom.js'); ?>"></script>

</body>
</html>