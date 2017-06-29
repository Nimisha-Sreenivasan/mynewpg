<?php $this->load->view('pg_admin/header'); ?>
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues'); ?>
<div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-7-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_menu hidden-print">
                                <div class="uk-display-inline-block" data-uk-dropdown="{pos:'left-top'}">
                                    <i class="md-icon material-icons md-icon-light">&#xE5D4;</i>
                                    <div class="uk-dropdown uk-dropdown-small">
                                        <ul class="uk-nav">
                                            <li><a href="#">Action 1</a></li>
                                            <li><a href="#">Action 2</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="uk-display-inline-block"><i class="md-icon md-icon-light material-icons" id="page_print">&#xE8ad;</i></div>
                            </div>
                            <div class="user_heading_avatar">
                                <div class="thumbnail">
                                    <img src="<?php echo $profile_info['pic'] ?>" alt="user avatar"/>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $profile_info['emp_fname'] ." ".$profile_info['emp_lname'];  ?></span></h2>
                                <ul class="user_stats">
                                    <li>
                                        <h4 class="heading_a"><?php echo  $profile_info['company_employee_id'] ?> </h4>
                                    </li>
<!--                                    <li>
                                        <h4 class="heading_a">120 <span class="sub-heading">Photos</span></h4>
                                    </li>-->
                                    <!--
                                    <li>
                                        <h4 class="heading_a">284 <span class="sub-heading">Following</span></h4>
                                    </li>-->
                                </ul>
                            </div>
                            <!--<a class="md-fab md-fab-small md-fab-accent hidden-print" href="page_user_edit.html">
                                <i class="material-icons">&#xE150;</i>
                            </a> -->
                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#">About</a></li>                                
                                <li><a href="#">Documents</a></li>
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                                                        <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">Contact Info</h4>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $profile_info['emp_email'] ; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Email</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $profile_info['emp_mobile'] ; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Phone</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $profile_info['emp_emg_no'] ; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Emergency NO</span>
                                                    </div>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">My groups</h4>
                                            <ul class="md-list">
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Present Address</a></span>
                                                        <span class="uk-text-small uk-text-muted"><?php echo $profile_info['emp_present_add']; ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Parmanant </a></span>
                                                        <span class="uk-text-small uk-text-muted"><?php echo $profile_info['emp_permanent_add'] ; ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Profile Address</a></span>
                                                        <span class="uk-text-small uk-text-muted"><?php echo $profile_info['pofile_address']."<br/>".$profile_info['pofile_area_up']."<br/>".$profile_info['pofile_city_up']."<br/>".$profile_info['pofile_state_up']."<br/>".$profile_info['pofile_pincode_up']; ?></span>
                                                    </div>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>                                    
                                </li>                                
                                <li>
                                    <ul class="md-list"></ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-3-10 hidden-print">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-margin-medium-bottom">
                                <h3 class="heading_c uk-margin-bottom">Alerts</h3>
                                <ul class="md-list md-list-addon">
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Voluptatem quia maiores.</span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate">Id et illum ea facere repellendus ratione.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons uk-text-success">&#xE88F;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Nam ipsam.</span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate">Ut occaecati perspiciatis non.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons uk-text-danger">&#xE001;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Eos id debitis.</span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate">Enim officiis asperiores nesciunt dolorum.</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>                            
                            <a class="md-btn md-btn-flat md-btn-flat-primary" href="#">Show all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php  $this->load->view('pg_admin/footerjs'); ?>    
  
</body>
</html>
<script>
    $('#pgemployee').addClass('current_section'); 
</script>