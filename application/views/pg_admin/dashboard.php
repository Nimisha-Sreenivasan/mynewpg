<?php $this->load->view('pg_admin/header'); ?>
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues'); ?>
    <div id="page_content">
        <div id="page_content_inner">
            <!-- statistics (small charts) -->
            <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">64/100</span></div>
                            <span class="uk-text-muted uk-text-small">Orders Completed</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>80</noscript></span>%</h2>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


   

    
  <?php $this->load->view('pg_admin/footerjs'); ?>

</body>
</html>
<script>
    $('#dashboard_menu').addClass('current_section'); 
</script>