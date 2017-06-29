
<?php $this->load->view('pg_guest/header'); ?>
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_guest/menues'); ?>
    <div id="page_content">
        <div id="page_content_inner">
            <h2><span class="alert_msg" style="float:right; font-size:14px; color:red;"></span></h2><br/>
            <div class="uk-grid data-uk-grid-margin data-uk-grid-match" id="user_profile">
                <div class="uk-width-large">
                    <div class="md-card">
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#"  data-flag="1" id="mypglist">Receipts</a></li>
                          </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                    <div class="1md-card uk-margin-medium-bottom">
                                        <div class="md-card-content">
                                            <div class="uk-overflow-container">
											<div id="success_msg"></div>
											 <table class="uk-table  table_check">
												<thead>
												<tr>
													<th class="uk-width-1-10 uk-text-center small_col">Receipt No</th>
													<th class="uk-width-1-10 uk-text-center">Rent</th>
													<th class="uk-width-1-10 uk-text-center">Month&Year</th>
													<th class="uk-width-2-10 uk-text-center">Comments</th>
													<th class="uk-width-1-10 uk-text-center">Receipt </th>
                                                                                                        <th class="uk-width-1-10 uk-text-center">Generated Date </th>
													
												</tr>
												</thead>
												<tbody id="tmypglist">
												 <?php if(isset($my_receipt_dtl) && count($my_receipt_dtl) > 0 && $my_receipt_dtl != FALSE) {
													foreach ($my_receipt_dtl as $key => $value) {  ?>
													<tr>
														<td class="uk-text-center uk-table-middle small_col"><?php echo $value["rcpt_no"]; ?></td>
														<td class="uk-text-center"><?php echo $value["rent"]; ?></td>
                                                                                                                 <td class="uk-text-center"><?php echo $value["month"].'-'.$value["year"]; ?></td>
                                                                                                                <td class="uk-text-center" style="word-break: break-all;"><?php echo $value["comments"]; ?></td>
														                                                           
														
														<td class="uk-text-center">
                                                                                                                    <?php if(($value["pdf_location"] != " ") || ($value["pdf_location"] != null)) { ?>
                                                                                                                    <a  target="_blank" href="<?php echo base_url().$value['pdf_location']; ?>"><img src="<?php echo site_url()."assets/images/pdf.png"; ?>" width="32" height="32"></a>
                                                                                                                    <?php } ?>						
														</td>
                                                                                                                <td class="uk-text-center"><?php echo $value["date"]; ?></td>
                                                                                                               </tr>
													<?php } } ?>
												</tbody>
											</table>
											 <!--Pagination -->
											 <?php  echo $this->pagination->create_links(); ?>
											  
					</div>
                                        </div>
                                    </div>
                                </li>
                              
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
            
    </div>


  <?php $this->load->view('pg_guest/footerjs'); ?>

 
</body>
</html>
<script>
    $('#receipt').addClass('current_section'); 
</script>
