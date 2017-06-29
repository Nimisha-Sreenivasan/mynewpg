<?php $this->load->view('pg_admin/header'); ?>
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues'); ?>
      <div id="page_content">
        <div id="page_content_inner">
            <div class="md-card uk-margin-medium-bottom">                
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Editing Email Template / <?php echo $emailtemplate[0]['name_en'];?></h3>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">                           
                             <div class="uk-form-row">
                                <label>Template Title</label>
                                <input type="text" class="md-input" name="name_en" value="<?php echo $emailtemplate[0]['name_en'];?>"  />
                            </div> 
                        </div>
                        <div class="uk-width-medium-1-2">
                             <div class="uk-form-row">
                                <label>Email Subject</label>
                                <input type="text" class="md-input" name="subject_en" value="<?php echo $emailtemplate[0]['subject_en'];?>" />
                            </div>
                            
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-1-12">
                            <div class="uk-form-row">
                              <textarea id="wysiwyg_ckeditor" name="body_en" cols="30" rows="20"><?php echo $emailtemplate[0]['body_en'];?></textarea>
                            </div>
                        </div>                        
                    </div>
                     <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-1-12">
                            <p class="wojo error note">Do Not Replace Variables Between [ ]</p>
                        </div>
                     </div>
                     
                      <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <div class="parsley-row">
                                    <label for="message">Message (20 chars min, 100 max)</label>
                                    <textarea class="md-input" name="message" cols="10" rows="8" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-validation-threshold="10" data-parsley-minlength-message = "Come on! You need to enter at least a 20 caracters long comment.."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <button type="submit" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Update Email Template</button>
                            </div>
                        </div>
                </div>
            </div> 
            </div>
        </div>
      </div>
<?php $this->load->view('pg_admin/footerjs'); ?>
    
     <!-- ckeditor -->
    <script src="<?php echo asset_url('pg_admin/bower_components/ckeditor/ckeditor.js');?>"></script>
    <script src="<?php echo asset_url('pg_admin/bower_components/ckeditor/adapters/jquery.js');?>"></script>

    <!--  wysiwyg editors functions -->
    <script src="<?php echo asset_url('pg_admin/assets/js/pages/forms_wysiwyg.min.js');?>"></script>
</body>
</html>