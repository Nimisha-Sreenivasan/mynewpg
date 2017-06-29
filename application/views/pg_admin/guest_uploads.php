<?php $this->load->view('pg_admin/header'); ?>
<style>
/*table
{
    counter-reset: rowNumber;
}

table tr > td:first-child
{
    counter-increment: rowNumber;
}
                
table tr td:first-child::before
{
    content: counter(rowNumber);
    min-width: 1em;
    margin-right: 0.5em;
}*/

</style>
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues'); ?>
      <div id="page_content">
        <div id="page_content_inner">
			
			          <div class="md-card uk-margin-medium-bottom">
                                        <div class="pgbranch uk-grid">
                                                <div class="uk-width-medium-1-6 uk-row-first">
                                                    <div class="md-input-wrapper">
                                                <label for="pglist">Select Your Branch: </label>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-3">
                                                  <div class="md-input-wrapper">
                                            <select id="yourpgbranch" name="pg_branch" class="md-input">
                                                <option value="---">Select PG Branch</option>
                                                <?php if(isset($my_pg_dtl) && count($my_pg_dtl) > 0 && $my_pg_dtl != FALSE) {
													foreach ($my_pg_dtl as $key => $value) { ?>
                                                <option value="<?php echo $value['mypg_id']; ?>"><?php echo $value['pg_name']; ?></option>
                                                <?php } } ?>
                                            </select>
                                            <span class="md-input-bar "></span>
                                            </div>
                                                </div>
                                        </div>
                                        <div class="md-card-content">
                                            <div class="uk-overflow-container">
											<div id="success_msg"></div>
											 <table class="uk-table uk-table-nowrap table_check">
												 <thead>
												<tr>
													<th class="uk-width-1-10 uk-text-center small_col">Sl.No</th>
													<th class="uk-width-1-10 uk-text-center">Guest Name</th>
													<th class="uk-width-1-10">Aadhar Card</th>
													<th class="uk-width-1-10">Driving Licence</th>
													<th class="uk-width-1-10">Local Address</th>
													<th class="uk-width-1-10">PAN Card</th>
													<th class="uk-width-1-10">Guest Photo</th>
												</tr>
												</thead>
												<tbody id="tmyguestlist">
												
													
													
												</tbody>
											</table>
											 <!--Pagination -->
											 <?php  echo $this->pagination->create_links(); ?>
											  
					</div>
                                        </div>
                                    </div>
        </div>
      </div>
            <?php $this->load->view('pg_admin/footerjs'); ?>
</body>
</html>
<script>
    $('#addguest').addClass('current_section'); 
	
	$('#yourpgbranch').change(function(){
       var pg_id = $('#yourpgbranch').val();
       var baseURL = <?php echo json_encode(base_url()); ?>;
       //alert(pg_id);
      $.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'pg_admin/MyGuest/myGuests' ?>",    
                        data: {
                        data: pg_id
                        },
                        dataType: 'json',
                        success: function(data) {
                            var data = jQuery.parseJSON(JSON.stringify(data));
                          //  console.log(data);
                            if(data.guests.length >= 1)
                            {
                              //var receiptmodal = " '#generatereceipt' ";
                              var html ="";
                              var j = 1;
                              for (var i = 0; i < data.guests.length; i++) {                                    
                                    html +='<tr><td class=" uk-table-middle small_col">'+ j +'</td>';
                                    html +='<td class=""><label>'+data.guests[i].first_name+'</label></td>';
                                    html +='<td class="">'
                                    if(data.guests[i].AAadhar_front == "") {
									html +='<label>No Record</label><br/>' 
									} else{
								    html +=	'<a title="" href="'+baseURL+data.guests[i].AAadhar_front+'" target="_blank">AAadhar1</a><br/>';
									}
								   if(data.guests[i].AAadhar_back == "") {
									html +='<label>No Record</label><br/>' 
									} else{
								    html +=	'<a title="" href="'+baseURL+data.guests[i].AAadhar_back+'" target="_blank">AAadhar2</a></td>';
									}
								     html +='<td class="">'
                                   if(data.guests[i].DL_Front == "") {
									html +='<label>No Record</label><br/>' 
									} else{
								    html +=	'<a title="" href="'+baseURL+data.guests[i].DL_Front+'" target="_blank">DL1</a><br/>';
									}
								   if(data.guests[i].DL_Back == "") {
									html +='<label>No Record</label><br/>' 
									} else{
								    html +=	'<a title="" href="'+baseURL+data.guests[i].DL_Back+'" target="_blank">DL2</a></td>';
									}
								     html +='<td class="">'
                                     if(data.guests[i].LA_front == "") {
									html +='<label>No Record</label><br/>' 
									} else{
								    html +=	'<a title="" href="'+baseURL+data.guests[i].LA_front+'" target="_blank">Local Addr.</a></td>';
									}
								     html +='<td class="">'
                                      if(data.guests[i].pan_front == "") {
									html +='<label>No Record</label><br/>' 
									} else{
								    html +=	'<a title="" href="'+baseURL+data.guests[i].pan_front+'" target="_blank">PAN</a></td>';
									}
								   html +='<td class="">'
                                       if(data.guests[i].passport_size_photo == "") {
									html +='<label>No Record</label><br/>' 
									} else{
								    html +=	'<a title="" href="'+baseURL+data.guests[i].passport_size_photo+'" target="_blank">Photo</a></td>';
									}
                                    j++;
                               }
                              $('#tmyguestlist').html(html);
                            } else if(data.guests.length == 0)
                            {
                                
                            }
                         }
                        });			 
  
   });
</script>