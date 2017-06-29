<?php $this->load->view('pg_admin/header'); ?>
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues'); ?>
    <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">Contact List</h3>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-vertical-align">
                                <div class="uk-vertical-align-middle">
                                    <ul id="contact_list_filter" class="uk-subnav uk-subnav-pill uk-margin-remove">
                                        <li class="uk-active" data-uk-filter=""><a href="#">All</a></li>
                                        <?php foreach ($pg_name_dtl as $key => $value) {
                                            echo '<li data-uk-filter="'.$value['pg_name'].'"><a href="#">'.$value['pg_name'].'</a></li>';
                                        } ?>
                                        
<!--                                        <li data-uk-filter="goodwin-nienow"><a href="#">Goodwin-Nienow</a></li>
                                        <li data-uk-filter="strosin groupa"><a href="#">Strosin Groupa</a></li>
                                        <li data-uk-filter="schamberger plc"><a href="#">Schamberger PLC </a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <label for="contact_list_search">Search... (min 3 char.)</label>
                            <input class="md-input" type="text" id="contact_list_search"/>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="heading_b uk-text-center grid_no_results" style="display:none">No results found</h3>

            <div class="uk-grid-width-medium-1-2 uk-grid-width-large-1-3 hierarchical_show" id="contact_list">
                <?php foreach ($pg_employee_dtl as $key => $value) {    ?>
                
                    <div data-uk-filter="<?php echo $value['emp_fname']." ".$value['emp_lname'].", ".$value['pg_name']; ?> ">
                        <?php //  print_r($value) ?>
                    <div class="md-card md-card-hover md-card-horizontal">
                        <div class="md-card-head">
                            <div class="md-card-head-menu" data-uk-dropdown="{pos:'bottom-left'}">
                                <i class="md-icon material-icons">&#xE5D4;</i>
                                <div class="uk-dropdown uk-dropdown-small">
                                    <ul class="uk-nav">
                                        <li><a href="<?php echo base_url()."pg_admin/Profile/index/".$value['user_id']; ?>">View</a></li>
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Remove</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="uk-text-center">
                                <img class="md-card-head-avatar" src="<?php echo asset_url('pg_admin/assets/img/avatars/avatar_10.png') ?>" alt=""/>
                            </div>
                            <h3 class="md-card-head-text uk-text-center">
                                <?php echo $value['emp_fname']." ".$value['emp_lname']; ?>                                <span class="uk-text-truncate"><?php echo $value['pg_name']; ?> </span>
                                                     
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <ul class="md-list">
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading">Emp Id</span>
                                        <span class="uk-text-small uk-text-muted"><?php echo $value['company_employee_id']; ?> </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading">Email</span>
                                        <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo $value['emp_email']; ?> </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading">Phone</span>
                                        <span class="uk-text-small uk-text-muted"><?php echo $value['emp_mobile']; ?> </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
                <?php } ?>

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