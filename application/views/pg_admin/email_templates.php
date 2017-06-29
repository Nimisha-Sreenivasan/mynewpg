<?php $this->load->view('pg_admin/header'); ?>
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues'); ?>
      <div id="page_content">
        <div id="page_content_inner">
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check">
                            <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-text-center small_col">#</th>
                                <th class="uk-width-1-10 uk-text-center">Template Title</th>
                                <th class="uk-width-2-10">Email Code</th>
                                <th class="uk-width-2-10 uk-text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                 <?php if(isset($emailtemplate) && count($emailtemplate) > 0 && $emailtemplate != FALSE):
								 foreach ($emailtemplate as $key => $value): ?>
                                    <tr>
                                        <td class="uk-text-center uk-table-middle ;small_col">1</td>
                                        <td class="uk-text-center"><?php echo $value['name_en']; ?></td>
                                        <td><?php echo $value['email_code']; ?></td>
                                        <td class="uk-text-center">
                                            <a href="<?php echo base_url()."pg_admin/EmailGeneration/editEmailtemplate/".$value['id']; ?>"><i class="md-icon material-icons">&#xE254;</i></a>                                        
                                        </td>
                                    </tr>
                                <?php
                                 endforeach;
                                 endif
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Section-->
                </div>
            </div>
        </div>
      </div>
            <?php $this->load->view('pg_admin/footerjs'); ?>
</body>
</html>