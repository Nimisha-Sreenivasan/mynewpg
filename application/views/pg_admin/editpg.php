<?php $this->load->view('pg_admin/header'); ?>
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_admin/menues'); ?>
      <div id="page_content">
        <div id="page_content_inner">
            <h2><span class="alert_msg" style="float:right; font-size:14px; color:red;"></span></h2><br/>
            <div class="uk-grid data-uk-grid-margin data-uk-grid-match" id="user_profile">
                <div class="uk-width-large">
                    <div class="md-card">
                        <div class="user_content">
									<div class="1md-card uk-margin-medium-bottom">
										 <div class="md-card-content">
											  <div class="uk-overflow-container">
												<!-- add new PG --> 
												<form id="pgupdate" name="pgupdate">
												  <h3 class="pg_profile_heading_bar">Edit PG Profile / <?php echo $pgdata[0]['pg_name'];?></h3>  
											  <div class="uk-form-row">
											 <div class="uk-grid">
												<div class="errors uk-width-medium-1-1"></div>
												  <div class="uk-width-medium-1-3">
														<div style="padding:15px;">
															 <div class="uk-form-row">
																  <label for="pg_name">PG Name<span class="req">*</span></label>
																  <input class="md-input" type="text" id="pg_name" name="pg_name" value="<?php echo $pgdata[0]['pg_name'];?>" />
															 </div>
															 <div class="uk-form-row md-input-filled">
																  <label for="pg_address_line_1">Address Line-1<span class="req">*</span></label>
																  <input class="md-input" type="text" id="pg_address_line_1" name="pg_address_line_1" value="<?php echo $pgdata[0]['pg_address_line_1'];?>"  />
															 </div>
															 <div class="uk-form-row">
																  <label for="pg_address_city">City<span class="req">*</span></label>
																  <input class="md-input" type="text" id="pg_address_city" name="pg_address_city" value="<?php echo $pgdata[0]['pg_address_city'];?>" />
															 </div>
															 <div class="uk-form-row">
																  <label for="pg_country">Country<span class="req">*</span></label>
																  <input class="md-input" type="text" id="pg_country" name="pg_country" value="<?php echo $pgdata[0]['pg_country'];?>"/>
															 </div>
															 <div class="uk-form-row">
																	<select id="select_demo_5" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Bill Cycle Day" name="pg_bill_cycle_date">
																		<option value="">Select...</option>
																		<?php for($i=1; $i<=31;$i++):
																		   $sel = ($pgdata[0]['pg_bill_cycle_date']==$i) ? 'selected="selected"' : '';
																			echo '<option value="'.$i.'" '. $sel.' >'.$i.'</option>';
																		endfor; ?>
																	</select>
																	<span class="uk-form-help-block">Bill Cycle Day</span>
                                               </div>
														</div>
												  </div>
												  <div class="uk-width-medium-1-3">
														<div style="padding:15px;">
															 <div class="uk-form-row">
																  <label for="total_bed">Total Bed available<span class="req">*</span></label>
																  <input class="md-input"  type="number" id="total_bed" name="total_bed" value="<?php echo $pgdata[0]['total_bed'];?>" min="1" max="1000" maxlength="4" />
															 </div>
															 <div class="uk-form-row">
																  <label for="pg_address_line_2">Address Line-2</label>
																  <input class="md-input" type="text" id="pg_address_line_2" name="pg_address_line_2" value="<?php echo $pgdata[0]['pg_address_line_2'];?>" />
															 </div>
															 <div class="uk-form-row">
																  <label for="pg_address_state">State<span class="req">*</span></label>
																  <input class="md-input" type="text" id="pg_address_state" name="pg_address_state" value="<?php echo $pgdata[0]['pg_address_state'];?>" />
															 </div>
															 <div class="uk-form-row">
																  <label for="pg_address_pincode">PIN Code<span class="req">*</span></label>
																  <input class="md-input" type="text" id="pg_address_pincode" name="pg_address_pincode" value="<?php echo $pgdata[0]['pg_address_pincode'];?>" maxlength="6" />
															 </div>
														</div>
												  </div>
												  <div class="uk-width-medium-1-3">                                                   
														<a  class="md-fab md-fab-small md-fab-accent uk-toggle"  data-uk-modal="{target:'#locationadder'}" ><i class="material-icons">location_on</i></a>                                                   
														<textarea class="md-input" id="locationaddress" readonly="">We detect your address</textarea>
														<input type="hidden" name="latitude" id="latitude" value="<?php echo $pgdata[0]['latitude'];?>" />
														<input type="hidden" name="longitude" id="longitude" value="<?php echo $pgdata[0]['longitude'];?>" />
														<input  type="hidden" value="<?php echo $company_id; ?>" name="company_id" />
														<input type="hidden" name="mypg_id" value="<?php echo $pgdata[0]['mypg_id'];?>">
												  </div>
											 </div>
										</div>
											  <h3 class="pg_profile_heading_bar">Contact Details </h3> 
                                               <i>Name of employee ie manager, contact person</i> 
                                               <div class="uk-form-row">                                                  
                                                   <div class="uk-margin uk-grid-small uk-child-width-auto " uk-grid>
                                                      <div class="uk-overflow-container">
																			<table class="uk-table uk-table-hover">
																				 <thead>
																					  <tr>
																							<th>Empcode</th>
																							<th>Employee Name</th>                                                            
																							<th>Action</th>
																					  </tr>
																				 </thead>
																				 <tbody id="showemp">
																					  <?php if( count($employee_detail) > 0){ foreach ($employee_detail as $key => $value) { ?>
																					  <tr>
																							<td><?php  echo $value['company_employee_id'] ?></td>
																							<td><?php  echo $value['emp_fname']." ".$value['emp_lname']; ?></td>
																							<td>
																								<a href="javascript:void(0)" class="edit_pg_emplogee" data-id="<?php echo $value['emp_id']; ?>"><i class="md-icon material-icons">&#xE254;</i></a>
																								<input  class="uk-checkbox" value="<?php echo $value['emp_id']; ?>" name="addpgemployee[]" type="checkbox" <?php  if($value['emp_checked']==true){ echo 'checked="checked"';}?> >
																							</td>
																					  </tr>   
																					  <?php    } } ?>
																				 </tbody>
																			</table>                                                               
																		</div>
                                                </div>
                                             </div>
														<button type="submit" class="add_emp_save md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" style="width:100px;">Save PG</button>
														<a href="<?php echo base_url()."pg_admin/MyPG/details" ?>" class="add_emp_save md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
												</form>                                             
										 </div>
										 </div>
									</div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
            
    </div>
<!-- model-->
<div id="modal-container" class="uk-modal-container uk-modal" >
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close uk-close" type="button" ></button>
        <h2 class="uk-modal-title">Add Guest-House</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
</div>
            <!-- model/-->
            <!-- location model -->
   <div id="locationadder" class="uk-modal-container uk-modal">
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default uk-close uk-modal-close" type="button" ></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Add PG Pointer</h2>
        </div>
        <div class="uk-modal-body">
             <div class="uk-form-row">
                <div class="uk-grid">
                    
                        <div class="uk-overflow-container uk-width-medium-1-1">
                        <!--  map -->
                            <div id="floating-panel">
      <input id="address" type="textbox" value="india">
      <input id="submit" type="button" value="Search Around" class="uk-button uk-button-primary">
    </div>
    <div id="map"></div>
                        <!--  map/ -->
                    </div>
                     <i>To Location Click on PG icon </i>
                </div>
             </div>            
        </div>
<!--        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="button">Conform Location</button>
        </div>-->
    </div>
</div>
            <!-- location model /-->
            <!-- employee adder model -->
            <div id="employeeadder" class="uk-modal-container uk-modal">
                <form id="addemployeedetails"> 
             <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close add_emp_close"></a>
            <h2 style="border-bottom: 1px solid #ccc; padding: 5px;">Fill Employee details</h2>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>First Name <span class="req">*</span></label><input name="emp_fname" id="emp_fname" value="" type="text" class="md-input emp_fname" /><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Last Name</label><input type="text" name="emp_lname" id="emp_lname" value=""  class="md-input emp_lname" required/><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Mobile Number <span class="req">*</span></label><input type="text" name="emp_mobile" id="emp_mobile" class="md-input emp_mobile" ondrop="return false;" onpaste="return false;"  required/><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Email Id <span class="req">*</span></label><input type="email" name="emp_email" id="emp_email" class="md-input emp_email" readonly="readonly"/><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Permanent Address<span class="req">*</span></label><textarea type="text" name="emp_permanent_add" id="emp_permanent_add" class="md-input emp_permanent_add"></textarea><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Present Address <span class="req">*</span></label><textarea type="text" name="emp_present_add" id="emp_present_add" class="md-input emp_present_add"></textarea><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Emergency Contact Number<span class="req">*</span></label><input type="text" name="emp_emg_no" id="emp_emg_no" class="md-input emp_emg_no" ondrop="return false;" onpaste="return false;" required/><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Aadhar Number<span class="req">*</span></label><input type="text" name="emp_aadhar_number" id="emp_aadhar_number" class="md-input emp_aadhar_number" required/><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            
            <?php echo '<input  type="hidden" value="'.$company_id.'" name="company_id" />'; ?>
            
            <div style="width:100%; text-align:center;    margin-top: 15px;">
                <button type="submit" class="add_emp_save md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" style="width:100px;">Save</button>
            </div>
             </div>
				 <input type="hidden" name="emp_id" id="emp_id" value="">
				</form>           
                
</div>
            <!-- employee adder model /-->
            
  <?php $this->load->view('pg_admin/footerjs'); ?>

            <!-- map scripts -->
            <script>     
      function initMap(location,map) {		 
	  if(location == null){		 
		location = new google.maps.LatLng(20.5937,78.9629);			  
		  }
		   var myLatlng = location;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: myLatlng
        });
	var iconBase = 'https://maps.google.com/mapfiles/kml/pal3/';	  
marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: location,
            icon: iconBase + 'icon48.png'
        });
                google.maps.event.addListener(marker, "dragend", function(event) { 
                localStorage.setItem("lat",event.latLng.lat());
                localStorage.setItem("lng",event.latLng.lng());
                var latLng = event.latLng;	
			  
        }); 
        marker.addListener('click', toggleBounce);

function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
          // add location
          $('#locationaddress').text($('#address').val());
          var lat = localStorage.getItem("lat");
          var lng = localStorage.getItem("lng");
          $('#latitude').val(lat);
          $('#longitude').val(lng);
        }
      }
		  
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);          
        });
      }

	function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            myLatlng = results[0].geometry.location;
            resultsMap.setCenter(results[0].geometry.location);
            localStorage.setItem("lat",myLatlng.lat());
            localStorage.setItem("lng",myLatlng.lng());           
            initMap(results[0].geometry.location,resultsMap);           
          } else {
           // alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKJcDNduxmyXPS8pW-RJu8K7xJs6wbGMA&callback=initMap">
    </script>
            <!-- map scripts/ -->
            
            <script>  
                // Bind Data in  Edit PG Employee popup
					 $(".edit_pg_emplogee").click(function(){
						
					    var emp_id = $(this).attr('data-id');
						 jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'pg_admin/MyPG/editemployeedetail' ?>",    
                        data: {'id':emp_id},
                        success: function(data) {
									 var data = JSON.parse(data);
									if(data.status == "success"){
										var emp_details = data.data;
										$("#emp_id").val(emp_details[0].emp_id);
										$("#emp_fname").val(emp_details[0].emp_fname);
										$("#emp_lname").val(emp_details[0].emp_lname);
										$("#emp_mobile").val(emp_details[0].emp_mobile);
										$("#emp_email").val(emp_details[0].emp_email);
										$("#emp_permanent_add").val(emp_details[0].emp_permanent_add);
										$("#emp_present_add").val(emp_details[0].emp_present_add);
										$("#emp_emg_no").val(emp_details[0].emp_emg_no);
										$("#emp_aadhar_number").val(emp_details[0].emp_aadhar_number)
										var modal = UIkit.modal("#employeeadder");
										modal.show();
									}
                         }
                        });
						
					 });
                
                $("#addemployeedetails").submit(function(e) {
                    e.preventDefault();
                    UIkit.modal('#employeeadder').show();
                        jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'pg_admin/MyPG/updateemployeedetail' ?>",    
                        data: $(this).serialize(),
                        success: function(data) {
                            var data = JSON.parse(data);
                            alert(data.status);                            
                            location.reload();
                         }
                        });
                      });
                      
                      // add New PG
					 $("#pgupdate").validate({
						 errorElement: 'div',
						 errorClass: 'parsley-errors-list filled',
						 highlight: function(element) {
							$(element).addClass('md-input-danger');
							$(element).parent('div').addClass('md-input-wrapper-danger');
						},
						unhighlight: function(element) {
							$(element).removeClass('md-input-danger');
							$(element).parent('div').removeClass('md-input-wrapper-danger');
						},
						rules: {
							pg_name: "required",	
							total_bed:{
								required:true,
								number:true
							},
							pg_address_line_1:"required",
							pg_address_city:"required",
							pg_country:"required",
							pg_address_state:"required",
							pg_address_pincode:{
								required:true,
								number:true,
								zipcode:true
							},
							
						},
						messages: {							
							pg_name: "Please provide your PG name",	
							total_bed:{
								required:"Please provide your total bed",
								number:"You must enter a numeric value for total bed"},	
							pg_address_line_1: "Please provide your PG adddress",	
							pg_address_city: "Please provide your city",	
							pg_country: "Please provide your country",	
							pg_address_state: "Please provide your state",	
							pg_address_pincode: {
								required:"Please provide your PIN code",
								number:"Please enter valid PIN code",
								zipcode:"Please enter valid PIN code"
							},	
						},
						errorElement: "div",
						errorPlacement: function(error, element) {
							element.parent('div').after(error);
						},
						submitHandler: function(form) {
							jQuery.ajax({
							type: "POST",
							url: "<?php echo base_url().'pg_admin/MyPG/UpdateMyPg'; ?>",    
							data: $("#pgupdate").serialize(),
							success: function(data) {
								var data = JSON.parse(data);
								if(data.status == "fail")
								{
									$('.errors').html('<div class="alert alert-danger" role="alert">'+data.msg+'</div>');
								} else
								{
									UIkit.modal.alert(data.msg);
									
								}
							}
							});	
						}

					});
		
                      /*$("#pgadd").submit(function(e) {
                        e.preventDefault();
                        
                });*/
            </script>
</body>
</html>
<script>
    $('#listmypg').addClass('current_section'); 
</script>