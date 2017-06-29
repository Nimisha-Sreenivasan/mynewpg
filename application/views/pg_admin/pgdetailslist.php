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
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#"  data-flag="1" id="mypglist">My PG List</a></li>
                                <li><a href="#"  data-flag="2" id="addnewpg">Add New PG</a></li>
<!--                                <a class="md-fab md-fab-small md-fab-accent uk-toggle" href="#addmypg"  style="float:right;margin-top:-12px;" uk-toggle>
                                    <i class="material-icons">+</i>
                                </a>-->
                                <a href="#" id="add_new_pg" data-uk-switcher="{connect:'user_profile_tabs_content'}" style="float:right;margin-top:-12px;" class="md-fab md-fab-small md-fab-accent" data-flag="2" ><i class="material-icons">+</i></a>
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                    <div class="1md-card uk-margin-medium-bottom">
                                        <div class="md-card-content">
                                            <div class="uk-overflow-container">
											<div id="success_msg"></div>
											 <table class="uk-table uk-table-nowrap table_check">
												<thead>
												<tr>
													<th class="uk-width-1-10 uk-text-center small_col">#</th>
													<th class="uk-width-1-10 uk-text-center">Name</th>
													<th class="uk-width-2-10">Address</th>
													<th class="uk-width-2-10 uk-text-center">Location</th>
													<th class="uk-width-1-10 uk-text-center">Created On</th>
													<th class="uk-width-2-10 uk-text-center">Actions</th>
												</tr>
												</thead>
												<tbody id="tmypglist">
												 <?php if(isset($my_pg_dtl) && count($my_pg_dtl) > 0 && $my_pg_dtl != FALSE) {
													foreach ($my_pg_dtl as $key => $value) { ?>
													<tr>
														<td class="uk-text-center uk-table-middle small_col"><?php echo ++$key; ?></td>
														<td class="uk-text-center"><?php echo $value['pg_name']; ?></td>
														<td class="uk-text-center"><?php echo $value['pg_address_line_1']."<br/>".$value['pg_address_line_2']."<br/>".$value['pg_address_city']; ?></td>                                                            
														<td class="uk-text-center"><?php
														 $latlong = $value['latitude'].",".$value['longitude'];
														 echo (!empty($value['latitude'])) ? '<img width="135" height="160" src="http://maps.googleapis.com/maps/api/staticmap?center='.$latlong.'&markers=color:red%7Clabel:C%7C'.$latlong.'&zoom=12&size=160x135"/>' : ''; ?></td>
														<td class="uk-text-center"><?php echo date('d-m-Y ',strtotime( $value['createon'])); ?></td>
														<td class="uk-text-center">
															<a href="<?php echo base_url()."pg_admin/MyPG/editpg/" ?><?php echo $value["mypg_id"]; ?>"><i class="md-icon material-icons">&#xE254;</i></a>
															<a href="javascript:void();" rel="<?php echo site_url('pg_admin/MyPG/deletePG/') ?><?php echo $value["mypg_id"]; ?>" class="deleteDdata"><i class="md-icon material-icons">&#xE88F;</i></a>							
														</td>
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
                                <li>
                                    <div class="1md-card uk-margin-medium-bottom">
                                        <div class="md-card-content">
                                            <div class="uk-overflow-container">
                                             <!-- add new PG --> 
                                             <?php if($company_dtl['status']=="success"){ ?>
                                             <form id="pgadd">
                                               <h3 class="pg_profile_heading_bar">PG Profile</h3>  
                                            <div class="uk-form-row">
                                           <div class="uk-grid">
										   <div class="errors uk-width-medium-1-1"></div>
                                               <div class="uk-width-medium-1-3">
                                                   <div style="padding:15px;">
                                                       <div class="uk-form-row">
                                                           <label for="pg_name">PG Name<span class="req">*</span></label>
                                                           <input class="md-input" type="text" id="pg_name" name="pg_name" />
                                                       </div>
                                                       <div class="uk-form-row md-input-filled">
                                                           <label for="pg_address_line_1">Address Line-1<span class="req">*</span></label>
                                                           <input class="md-input" type="text" id="pg_address_line_1" name="pg_address_line_1" />
                                                       </div>
                                                       <div class="uk-form-row">
                                                           <label for="pg_address_city">City<span class="req">*</span></label>
                                                           <input class="md-input" type="text" id="pg_address_city" name="pg_address_city" />
                                                       </div>
                                                       <div class="uk-form-row">
                                                           <label for="pg_country">Country<span class="req">*</span></label>
                                                           <input class="md-input" type="text" id="pg_country" name="pg_country" value="India" />
                                                       </div>
																		 <div class="uk-form-row">                                                                                                                    
																			   <select id="select_demo_5" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Bill Cycle Day" name="pg_bill_cycle_date">
																				<option value="">Select...</option>
																				<?php for($i=1; $i<=31;$i++):
																					echo '<option value="'.$i.'">'.$i.'</option>';
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
                                                           <input class="md-input"  type="number" id="total_bed" name="total_bed" min="1" max="1000" maxlength="4" />
                                                       </div>
                                                       <div class="uk-form-row">
                                                           <label for="pg_address_line_2">Address Line-2</label>
                                                           <input class="md-input" type="text" id="pg_address_line_2" name="pg_address_line_2" />
                                                       </div>
                                                       <div class="uk-form-row">
                                                           <label for="pg_address_state">State<span class="req">*</span></label>
                                                           <input class="md-input" type="text" id="pg_address_state" name="pg_address_state" />
                                                       </div>
                                                       <div class="uk-form-row">
                                                           <label for="pg_address_pincode">PIN Code<span class="req">*</span></label>
                                                           <input class="md-input" type="text" id="pg_address_pincode" name="pg_address_pincode" maxlength="6" />
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="uk-width-medium-1-3">
                                                   
                                                   <a  class="md-fab md-fab-small md-fab-accent uk-toggle" onclick="resize()"  data-uk-modal="{target:'#locationadder'}" ><i class="material-icons">location_on</i></a>
                                                   
                                                   <textarea class="md-input" id="locationaddress" readonly="">We detect your address</textarea>
                                                   <input type="hidden" name="latitude" id="latitude" />
                                                   <input type="hidden" name="longitude" id="longitude" />
                                                   <?php if($company_dtl['status']=="success"){ echo '<input  type="hidden" value="'.$company_dtl['company_id'].'" name="company_id" />'; } ?>
                                               </div>
                                           </div>
                                       </div>
                                               <h3 class="pg_profile_heading_bar">Contact Details </h3> 
                                               <i>Name of employee ie manager, contact person</i> 
                                               <div class="uk-form-row">
                                                   <a   style="float:right;margin-top:-12px;" class="md-fab md-fab-small md-fab-accent uk-toggle"  data-uk-modal="{target:'#employeeadder'}" ><i class="material-icons">contacts</i></a>
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
                                                            <td><input class="uk-checkbox" value="<?php echo $value['emp_id']; ?>" name="addpgemployee[]" type="checkbox" ></td>
                                                        </tr>   
                                                        <?php    } } ?>
                                                    </tbody>
                                                </table>
                                                               
                                            </div>
                                                </div>
                                               </div>
																<button type="submit" class="add_emp_save md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" style="width:100px;">Save PG</button>
                                             </form>
                                             <!-- add new PG /-->  
                                             <?php } else { echo "<i>Please add your company first</i>";
                                                 
                                             }  ?>
                                        </div>
                                        </div></div>
                                </li>

                            </ul>
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
            <form id="addemployeedetails" name="addemployeedetails"> 
            <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close add_emp_close"></a>
            <h2 style="border-bottom: 1px solid #ccc; padding: 5px;">Fill Employee details</h2>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>First Name <span class="req">*</span></label><input name="emp_fname" type="text" class="md-input emp_fname" /><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Last Name</label><input type="text" name="emp_lname" class="md-input emp_lname" required/><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Mobile Number <span class="req">*</span></label><input type="text" name="emp_mobile" class="md-input emp_mobile" ondrop="return false;" onpaste="return false;"  /><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Email Id <span class="req">*</span></label><input type="email" name="emp_email" class="md-input emp_email" /><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Permanent Address<span class="req">*</span></label><textarea type="text" name="emp_permanent_add" class="md-input emp_permanent_add"></textarea><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Present Address <span class="req">*</span></label><textarea type="text" name="emp_present_add" class="md-input emp_present_add"></textarea><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Emergency Contact Number<span class="req">*</span></label><input type="text" name="emp_emg_no" class="md-input emp_emg_no" ondrop="return false;" onpaste="return false;" /><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Aadhar Number<span class="req">*</span></label><input type="text" name="emp_aadhar_number" class="md-input emp_aadhar_number" /><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1">
                        <label>Employee Role                             
                            <label><input class="uk-radio" type="radio" name="role" value="3" checked> Manager</label>
                            <label><input class="uk-radio" type="radio" name="role" value="4" > Caretaker</label>
                        </label>                            
                    </div>
                    
                </div>
            </div>
            <?php if($company_dtl['status']=="success"){ echo '<input  type="hidden" value="'.$company_dtl['company_id'].'" name="company_id" />'; } ?>
            
            <div style="width:100%; text-align:center;    margin-top: 15px;">
                <button type="submit" class="add_emp_save md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" style="width:100px;">Save</button>
            </div>
             </div>
				</form>           
                
</div>
            <!-- employee adder model /-->
            
  <?php $this->load->view('pg_admin/footerjs'); ?>
  


            <!-- map scripts -->
<script>
	var map;
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
		
		function resize(){
			$('#submit').trigger('click');
           
		}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKJcDNduxmyXPS8pW-RJu8K7xJs6wbGMA&callback=initMap">
    </script>
            <!-- map scripts/ -->
            
            <script>                  
                // Add new employee Details 
                $("#addemployeedetails").validate({
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
							emp_fname: "required",								
							emp_mobile:{
                                required: true,
                                specialChars: true,
                                number: true,
                                minlength: 10,	
                                maxlength: 10,			
            
                                },
							emp_email:{
                                    required: true,
                                    email: true,
                                    validemail:true
                                },	
							emp_permanent_add:"required",
							emp_present_add:"required",
							emp_emg_no:{
								required:true,
								
							},
                     emp_aadhar_number:"required",
							
						},
						messages: {							
							emp_fname: "Please provide first name",	
							company_contact_no: {
								required: "Please provide your mobile number",
								specialChars:"please use only alphanumeric or alphabetic characters",
								number: "Please enter a valid mobile number.",			
								minlength: "Mobile number should be 10 digits",
								maxlength: "Mobile number should be 10 digits",	
							},
							emp_email: {
								required: "Please provide your email address",
								email:"Please provide a valid email address",
								validemail:"Please provide a valid email address",
							},	
							emp_permanent_add: "Please provide permanent address",
							emp_present_add:"Please provide present address",
							emp_emg_no: "Please provide emergency contact number",	
							emp_aadhar_number: "Please provide aadhar number",	
							
						},
						errorElement: "div",
						errorPlacement: function(error, element) {
							element.parent('div').after(error);
						},
						submitHandler: function(form) {							 
                    UIkit.modal('#employeeadder').show();
                        jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'pg_admin/MyPG/addemployeedetail' ?>",    
                        data: $("#addemployeedetails").serialize(),
                        success: function(data) {
                            var data = JSON.parse(data);
                            //alert(data.status);
                            
                            if(data.status == "success")
                            {
										 UIkit.modal.alert(data.msg);
                              $('.alert_msg').html(data.msg);
                              UIkit.modal('#employeeadder').hide();
                              var html ="";
                              for (var i = 0; i < data.emp_data.length; i++) {                                    
                                    html +='<tr><td>'+data.emp_data[i].company_employee_id+'</td>';
                                    html +='<td><label>'+data.emp_data[i].emp_fname+' '+data.emp_data[i].emp_lname+'</label></td>';
                                    html +='<td><input class="uk-checkbox" value="'+data.emp_data[i].emp_id+'" name="addpgemployee[]" type="checkbox" ></td></tr>';
                                }
                              $('#showemp').html(html);
                            } else if(data.status == "confuse")
                            {
                                UIkit.modal.alert(data.msg);
                            }
                         }
                        });
						}

					});
                      
                      // add New PG
					 $("#pgadd").validate({
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
							url: "<?php echo base_url().'pg_admin/MyPG/saveMyPg'; ?>",    
							data: $("#pgadd").serialize(),
							success: function(data) {
								var data = JSON.parse(data);
								if(data.status == "fail")
								{
									$('.errors').html('<div class="alert alert-danger" role="alert">'+data.msg+'</div>');
								} else
								{
									$("#pgadd")[0].reset();
									$('#mypglist').trigger('click');
									UIkit.modal.alert(data.msg);
									location.reload();
									//$('#success_msg').html('<div class="alert alert-danger" role="alert">'+data.msg+'</div>');
									/*setTimeout(function(){ $("#success_msg").empty(); }, 3000);
									
									var obj = data.data[0];
									console.log(obj); 
									console.log(obj.company_employee_id);
									
											//alert('key: ' + key + '\n' + 'value: ' + obj[key]);
											
									var row='';
									row +='<tr>';
                                        row +=  '<td>4</td>';
                                        row +=  '<td>'+obj.pg_name+'</td>';
                                        row +=  '<td>Adddress 12<br>address @!<br>City !</td>';
                                        row +=  '<td></td>';
                                        row +=  '<td>29-03-2017 </td>';
                                        row +=  '<td>';
										row +=  	'<a href="javascript:void();" rel="http://124.153.104.69:8051/pg_admin/MyPG/deletePG/18" class="abutton deleteDdata"><i class="material-icons md-color-gg">?</i></a>';
										row +=  	'<a href="http://124.153.104.69:8051/pg_admin/MyPG/editpg/18" class="abutton"><i class="uk-icon-edit md-color-gg"></i></a>';
										row +=	'</td>';
                                    row +='</tr>';   
									
									$("#tmypglist").append(row);
									*/
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
	$("#add_new_pg").click(function(){
		$('#addnewpg').trigger('click');
	});
	
	
</script>