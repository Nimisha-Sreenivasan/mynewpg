 <!-- Change password This is the modal -->
    <div id="change_password_modal" class="uk-modal">
	<form action="#" method="post" id="changepassword_form" name="changepassword_form">    
        <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close add_guest_close" id="closemodal"></a>
			<div class="chnagepass"></div>
            <h2 style="border-bottom: 1px solid #ccc; padding: 5px;">Fill the details <span class="change_pwd_alert_msg" style="float:right; font-size:14px; color:red;"></span></h2>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1">
                        <div class="md-input-wrapper"><label>Old Password<span style="color:red">*</span></label>
						<input type="password" class="md-input old_password" name="password" autocomplete="off"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1">
                        <div class="md-input-wrapper"><label>New Password<span style="color:red">*</span></label>
						<input type="password" name="new_password" id="epasscheck" class="md-input new_password" autocomplete="off"><span class="md-input-bar"></span></div>
                    </div>
                    
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium">
                        <div class="md-input-wrapper"><label>Confirm New Password<span style="color:red">*</span></label>
						<input type="password" name="confirm_password" class="md-input confirm_new_password" autocomplete="off"><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            
            <div style="width:100%; text-align:center;    margin-top: 15px;">
                <button class="btn_change_password md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" style="width:100px;">Change</button>
            </div>
        </div>
	</form>
    </div>
<!-- google web fonts -->
<script>
	WebFontConfig = {
		google: {
			families: [
				'Source+Code+Pro:400,700:latin',
				'Roboto:400,300,500,700,400italic:latin'
			]
		}
	};
	(function() {
		var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
		'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
	})();
</script>
    <!-- common functions -->
    <script src="<?php echo asset_url('pg_admin/assets/js/common.min.js'); ?>"></script>
    <!-- uikit functions -->
    <script src="<?php echo asset_url('pg_admin/assets/js/uikit_custom.min.js'); ?>"></script>
    <!-- altair common functions/helpers -->
    <script src="<?php echo asset_url('pg_admin/assets/js/altair_admin_common.min.js'); ?>"></script>

    <!-- page specific plugins -->
        <!-- d3 -->
        <script src="<?php echo asset_url('pg_admin/bower_components/d3/d3.min.js'); ?>"></script>
        <!-- metrics graphics (charts) -->
        <script src="<?php echo asset_url('pg_admin/bower_components/metrics-graphics/dist/metricsgraphics.min.js'); ?>"></script>
        <!-- chartist (charts) -->
        <script src="<?php echo asset_url('pg_admin/bower_components/chartist/dist/chartist.min.js'); ?>"></script>
        <!-- maplace (google maps) -->
        <script src="http://maps.google.com/maps/api/js"></script>
        <script src="<?php echo asset_url('pg_admin/bower_components/maplace-js/dist/maplace.min.js'); ?>"></script>
        <!-- peity (small charts) -->
        <script src="<?php echo asset_url('pg_admin/bower_components/peity/jquery.peity.min.js'); ?>"></script>
        <!-- easy-pie-chart (circular statistics) -->
        <script src="<?php echo asset_url('pg_admin/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js'); ?>"></script>
        <!-- countUp -->
        <script src="<?php echo asset_url('pg_admin/bower_components/countUp.js/dist/countUp.min.js'); ?>"></script>
        <!-- handlebars.js -->
        <script src="<?php echo asset_url('pg_admin/bower_components/handlebars/handlebars.min.js'); ?>"></script>
        <script src="<?php echo asset_url('pg_admin/assets/js/custom/handlebars_helpers.min.js'); ?>"></script>
        <!-- CLNDR -->
        <script src="<?php echo asset_url('pg_admin/bower_components/clndr/clndr.min.js'); ?>"></script>

        <!--  dashbord functions -->
        <script src="<?php echo asset_url('pg_admin/assets/js/pages/dashboard.min.js'); ?>"></script>
    
    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "bower_components/dense/src/dense.js", function() {
                    // enable hires images
                    altair_helpers.retina_images();
                })
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>
	<script type="text/javascript" src="<?php echo asset_url('pg_admin/js/jquery.validate.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo asset_url('pg_admin/js/custom.js'); ?>"></script>
	<script>
	 // add New PG
 $("#changepassword_form").validate({
	errorElement: 'span',
	rules: {
		password: {
			required: true,
			minlength: 4,
			remote:{url:"<?php echo site_url('pg_admin/dashboard/checkOldPass') ?>", type:"post"}
		},		
		new_password: {
			required: true,
			minlength: 8
		},
		confirm_password: {
			required: true,
			minlength: 8,
			equalTo: "#epasscheck"
		},
	},
	messages: {
		password: {
			required: "Please provide a password",
			minlength: "Your password must be at least 5 characters long",
			remote: "Your old password didn't match"
		},
		
		new_password: {
			required: "Please provide a New password",
			minlength: "The Password field must be at least 8 characters in length."
		},
		confirm_password: {
			required: "Please retype new password",
			minlength: "The Password field must be at least 8 characters in length.",
			equalTo: "Please enter the same password as above"
		},
		
	},
	submitHandler: function(form) {
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url().'pg_admin/dashboard/changePassword'; ?>",    
		data: $("#changepassword_form").serialize(),
		success: function(data) {
			var data = JSON.parse(data);
			if(data.status == "fail")
			{
				$('.errors').html('<div class="alert alert-danger" role="alert">'+data.msg+'</div>');
			} else
			{
				$('.chnagepass').html('<div class="alert alert-danger" role="alert">'+data.msg+'</div>');
				$("#changepassword_form")[0].reset();
				setTimeout(function(){ $('#closemodal').trigger('click');
					$('.chnagepass').empty();
				}, 3000);
				
			}
		}
		});	
	}
});
</script>

