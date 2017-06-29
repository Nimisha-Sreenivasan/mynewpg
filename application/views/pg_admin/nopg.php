<?php $this->load->view('pg_admin/header');?>

<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues'); ?>
    <div id="page_content">
        <div id="page_content_inner">
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-vertical-align">
                                <div class="uk-vertical-align-middle">
                                   <h3> Please add a company first</h3>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>

  

            <div class="uk-grid-width-medium-1-2 uk-grid-width-large-1-3 hierarchical_show" id="contact_list">
            

        </div>
    </div>
    </div>

  <?php $this->load->view('pg_admin/footerjs'); ?>
    <script src="<?php echo asset_url('pg_admin/js/pages/page_contact_list.min.js'); ?>"></script>
    <script>//
//        $(function() {
//            if(isHighDensity()) {
//                $.getScript( "<?php // echo asset_url('pg_admin/bower_components/dense/src/dense.js'); ?>", function() {
//                    // enable hires images
//                    altair_helpers.retina_images();
//                })
//            }
//            if(Modernizr.touch) {
//                // fastClick (touch devices)
//                FastClick.attach(document.body);
//            }
//        });
//        $window.load(function() {
//            // ie fixes
//            altair_helpers.ie_fix();
//        });
//    </script>
</body>
</html>
<script>
    $('#pgemployee').addClass('current_section'); 
</script>