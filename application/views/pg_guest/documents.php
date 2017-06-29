<?php $this->load->view('pg_guest/header'); ?>
<!-- dropify -->
    <link rel="stylesheet" href="<?php echo asset_url('pg_admin/assets/skins/dropify/css/dropify.css'); ?>">
<body class=" sidebar_main_open sidebar_main_swipe">
   <?php $this->load->view('pg_guest/menues'); ?>
    <div id="page_content">
        <div id="page_content_inner">
            <!-- statistics (small charts) -->
				<span style="color:red;"><?php echo $error;?></span> <!-- Error Message will show up here -->
							<?php echo form_open_multipart('pg_guest/Dashboard/do_upload');?>
           <!-- <form name="alluploads" id="alluploads" enctype="multipart/form-data" action="do_upload">-->
            <h2><span class="alert_msg" style="float:right; font-size:14px; color:red;"></span></h2>
			<span style="color:red;">* All uploads are mandatory</span><br/>
			<b> Note:</b><span style="color:red;"> Allowed extentions are .jpg, .png and .jpeg</span><br/><br/>
            <div class="md-card uk-grid">
			 <div class="uk-width-1-4">
                    <div class="md-card">
					<?php
						$AAadhar_frontdisplay = base_url($AAadhar_front);//Aadhar
						$AAadhar_backdisplay = base_url($AAadhar_back);
						
						$DL_Frontdisplay = base_url($DL_Front);//DL
						$DL_Backdisplay = base_url($DL_Back);
						
						$LA_Frontdisplay = base_url($LA_Front);//LA
						$PAN_Frontdisplay = base_url($PAN_Front);//PAN
						$passport_size_photodisplay = base_url($passport_size_photo);//PSP
						
						
					?>
                        <div class="md-card-content" id="adharfile" >
                            <h3 class="heading_a uk-margin-small-bottom">
                                AAadhar Card
                                <a href="#" onclick="addadhar();" ><i class="material-icons md-24">&#xE146;</i></a>
                            </h3>
						<?php 
							if(file_exists($AAadhar_front))
						{
						 	$ext1 = strtolower((pathinfo($AAadhar_frontdisplay, PATHINFO_EXTENSION)));
							if ($ext1 == "png" || $ext1 == "jpg" || $ext1 == "jpeg"){
						 // echo "<img src='$AAadhar_frontdisplay' alt='' width='100%'  height='100px' style='vertical-align: super;height:100px'/>";
							
                           echo "<input type='file' name='adhaarcard1' class='dropify' data-default-file='$AAadhar_frontdisplay' width='100%'  height='100px'/>";

							}
							/*else{
							//echo "<embed src='$AAadhar_frontdisplay' width='100%' height='100%' type='application/pdf'/>";
							//echo '<img width="82%"  height="100px" style="vertical-align: super;height:100px;padding: 0px 7px 3px 43px;" src="'. base_url(''). $pdfImage .'">';
								$pdfImage = base_url()."application/icon_images/pdf1.png";
								echo "<input type='file' name='adhaarcard1' class='dropify' data-default-file='$pdfImage' width='100%'  height='100px'/>";
							}*/
						}
						else
						{?>
							<input name="adhaarcard1" id="file-0" type="file" multiple="true" class="dropify" accept="application/pdf,image/jpeg,image/png,image/jpg" required="true" />
						<?php } 
						?>	
						<?php if(file_exists($AAadhar_back))
						{
							$ext2 = strtolower((pathinfo($AAadhar_backdisplay, PATHINFO_EXTENSION)));
							if ($ext2 == "png" || $ext2 == "jpg" || $ext2 == "jpeg"){
							//echo "<img src='$AAadhar_backdisplay' alt='' width='100%' style='vertical-align: super;height:100px'/>";
						echo "<input type='file' name='adhaarcard2' class='dropify' data-default-file='$AAadhar_backdisplay' width='100%'  height='100px'/>";


						}
							/*else{
							//	$pdfImage = "application/icon_images/pdf1.png";
							//echo "<embed src='$AAadhar_frontdisplay' width='100%' height='100%' type='application/pdf'/>";
							//echo '<img width="82%"  height="100px" style="vertical-align: super;height:100px;padding: 0px 7px 3px 43px;" src="'. base_url(''). $pdfImage .'">';
								$pdfImage = base_url()."application/icon_images/pdf1.png";
								echo "<input type='file' name='adhaarcard2' class='dropify' data-default-file='$pdfImage' width='100%'  height='100px'/>";
						}*/
						}
						else
						{?>
						<input name="adhaarcard2" id="file-0" type="file" multiple="true" class="dropify"  accept="application/pdf,image/jpeg,image/png,image/jpg" required="true" />
						<?php }?>
                   </div>
                    </div>
                </div>           
				 <div class="uk-width-1-4">
                    <div class="md-card">
                        <div class="md-card-content" id="DLfile" >
                            <h3 class="heading_a uk-margin-small-bottom">
                               Driving Licence
                                <a href="#" onclick="addDL();" ><i class="material-icons md-24">&#xE146;</i></a>
                            </h3>
							<?php 
							if(file_exists($DL_Front))
						{
							$ext3 = strtolower((pathinfo($DL_Frontdisplay, PATHINFO_EXTENSION)));
							if ($ext3 == "png" || $ext3 == "jpg" || $ext3 == "jpeg"){
								echo "<input type='file' name='drivinglicense1' class='dropify' data-default-file='$DL_Frontdisplay' width='100%'  height='100px'/>";
						
								}
							/*else{
								//$pdfImage = "application/icon_images/pdf1.png";
							//echo "<embed src='$AAadhar_frontdisplay' width='100%' height='100%' type='application/pdf'/>";
							//echo '<img width="82%"  height="100px" style="vertical-align: super;height:100px;padding: 0px 7px 3px 43px;" src="'. base_url(''). $pdfImage .'">';$pdfImage = base_url()."application/icon_images/pdf1.png";
								$pdfImage = base_url()."application/icon_images/pdf1.png";
								echo "<input type='file' name='drivinglicense1' class='dropify' data-default-file='$pdfImage' width='100%'  height='100px'/>";
						}*/
						}
						else
						{?>
							   <input name="drivinglicense1" id="file-1" type="file" multiple="" class="dropify" accept="application/pdf,image/jpeg,image/png,image/jpg" required="true" />
						<?php } 
						?>	
						<?php if(file_exists($DL_Back))
						{
							$ext4 = strtolower((pathinfo($DL_Backdisplay, PATHINFO_EXTENSION)));
							if ($ext4 == "png" || $ext4 == "jpg" || $ext4 == "jpeg"){
							echo "<input type='file' name='drivinglicense2' class='dropify' data-default-file='$DL_Backdisplay' width='100%'  height='100px'/>";
							
						}
							/*else{
								//$pdfImage = "application/icon_images/pdf1.png";
							//echo "<embed src='$AAadhar_frontdisplay' width='100%' height='100%' type='application/pdf'/>";
							//echo '<img width="82%"  height="100px" style="vertical-align: super;height:100px;padding: 0px 7px 3px 43px;" src="'. base_url(''). $pdfImage .'">';
								$pdfImage = base_url()."application/icon_images/pdf1.png";
								echo "<input type='file' name='drivinglicense2' class='dropify' data-default-file='$pdfImage' width='100%'  height='100px'/>";
						}*/
						}
						else
						{?>
					<input name="drivinglicense2" id="file-1" type="file" multiple="" class="dropify" accept="application/pdf,image/jpeg,image/png,image/jpg"  required="true"/>
						<?php }?>
                        </div>
                    </div>
                </div>     
				 <div class="uk-width-1-4">
                    <div class="md-card">
                        <div class="md-card-content" id="LAfile" >
                            <h3 class="heading_a uk-margin-small-bottom">
                                Local Address
                                <a href="#" onclick="addLA();" ><i class="material-icons md-24">&#xE146;</i></a>
                            </h3>
<!--                            <input type="file" id="input-file-b" class="dropify" data-default-file="assets/img/gallery/Image08.jpg"/>-->
							
						<?php if(file_exists($LA_Front))
						{
							$ext5 = strtolower((pathinfo($LA_Frontdisplay, PATHINFO_EXTENSION)));
							if ($ext5 == "png" || $ext5 == "jpg" || $ext5 == "jpeg"){
									echo "<input type='file' name='localaddress' class='dropify' data-default-file='$LA_Frontdisplay' width='100%'  height='100px'/>";
							
								}
							/*else{
								//$pdfImage = "application/icon_images/pdf1.png";
							//echo "<embed src='$AAadhar_frontdisplay' width='100%' height='100%' type='application/pdf'/>";
							//echo '<img width="82%"  height="100px" style="vertical-align: super;height:100px;padding: 0px 7px 3px 43px;" src="'. base_url(''). $pdfImage .'">';
								$pdfImage = base_url()."application/icon_images/pdf1.png";
								echo "<input type='file' name='localaddress' class='dropify' data-default-file='$pdfImage' width='100%'  height='100px'/>";
						}*/
						}
						else
						{?>
					    <input name="localaddress" id="file-2" type="file" multiple="" class="dropify" accept="application/pdf,image/jpeg,image/png,image/jpg" required="true" />
						<?php }?>
							
                        
							<h3 class="heading_a uk-margin-small-bottom">
                                PAN Card
                                <a href="#" onclick="addPAN();" ><i class="material-icons md-24">&#xE146;</i></a>
                            </h3>
							<?php if(file_exists($PAN_Front))
						{
							$ext6 = strtolower((pathinfo($PAN_Frontdisplay, PATHINFO_EXTENSION)));
							if ($ext6 == "png" || $ext6 == "jpg" || $ext6 == "jpeg"){
								echo "<input type='file' name='pancard' class='dropify' data-default-file='$PAN_Frontdisplay' width='100%'  height='100px'/>";
							
						}
							/*else{
								//$pdfImage = "application/icon_images/pdf1.png";
							//echo "<embed src='$AAadhar_frontdisplay' width='100%' height='100%' type='application/pdf'/>";
							//echo '<img width="82%"  height="100px" style="vertical-align: super;height:100px;padding: 0px 7px 3px 43px;" src="'. base_url(''). $pdfImage .'">';
								$pdfImage = base_url()."application/icon_images/pdf1.png";
								echo "<input type='file' name='pancard' class='dropify' data-default-file='$pdfImage' width='100%'  height='100px'/>";
						}*/
						}
						else
						{?>
					     <input name="pancard" id="file-3" type="file" multiple="" class="dropify" accept="application/pdf,image/jpeg,image/png,image/jpg"  required="true"/>   
						<?php }?>
							<!-- <input type="file" id="input-file-b" class="dropify" data-default-file="assets/img/gallery/Image08.jpg"/>-->
                        
                          <!--  <input type="file" name="LA[]" id="input-file-d" class="dropify"/>
                            <input type="file" name="LA[]" id="input-file-d" class="dropify"/>-->
                        </div>
                    </div>
                </div>        
				 <div class="uk-width-1-4">
                    <div class="md-card">
                        <div class="md-card-content" id="PSPfile" >
                            <h3 class="heading_a uk-margin-small-bottom">
                                Passport Size Photo
                                <a href="#" onclick="addPSP();" ><i class="material-icons md-24">&#xE146;</i></a>
                            </h3>
							<?php if(file_exists($passport_size_photo))
						{
							$ext7 = strtolower((pathinfo($passport_size_photodisplay, PATHINFO_EXTENSION)));
							if ($ext7 == "png" || $ext7 == "jpg" || $ext7 == "jpeg"){
							echo "<input type='file' name='passportphoto' class='dropify' data-default-file='$passport_size_photodisplay' width='100%'  height='100px'/>";
							
								}
							/*else{
								//$pdfImage = "application/icon_images/pdf1.png";
							//echo "<embed src='$AAadhar_frontdisplay' width='100%' height='100%' type='application/pdf'/>";
							//echo '<img width="82%"  height="100px" style="vertical-align: super;height:100px;padding: 0px 7px 3px 43px;" src="'. base_url(''). $pdfImage .'">';
								$pdfImage = base_url()."application/icon_images/pdf1.png";
								echo "<input type='file' name='passportphoto' class='dropify' data-default-file='$pdfImage' width='100%'  height='100px'/>";
						}*/
						}
						else
						{?>
					     <input name="passportphoto" id="file-5" type="file" multiple="" class="dropify" accept="application/pdf,image/jpeg,image/png,image/jpg"  required="true"/>   
						<?php }?>
							<!-- <input type="file" id="input-file-b" class="dropify" data-default-file="assets/img/gallery/Image08.jpg"/>-->
                          
                          <!--  <input type="file" name="PSP[]" id="input-file-e" class="dropify"/>-->
                        </div>
                    </div>							
                </div>       
            </div>   
			   <br/>
			<input type="submit" name="fileSubmit"  id="fileSubmit" value="UPLOAD" style="font-weight: 900;font-size: 19px;" class="uk-width-1-1 uk-button uk-button-primary"/>
			<?php echo form_close(); ?>	
			
       <!-- </form>-->
        </div>
    </div>


  <?php $this->load->view('pg_guest/footerjs'); ?>
 <!-- page specific plugins -->
    <!--  dropify -->
    <script src="<?php echo asset_url('pg_admin/assets/js/custom/dropify/dist/js/dropify.min.js'); ?>"></script>

    <!--  form file input functions -->
    <script src="<?php echo asset_url('pg_admin/assets/js/pages/forms_file_input.min.js'); ?>"></script>

    <script >

		$(document).ready(function(e){
		/* Handle any form's submit event. */
  // $("#fileSubmit").on("click", function(e){
$('#fileSubmit').submit(function() {
         e.stopPropagation(); /* Stop the form from submitting immediately. */
        var continueInvoke = true;          /* Variable used to avoid $(this) scope confusion with .each() function. */

        /* Loop through each form element that has the required="" attribute. */
        $("form input[required]").each(function(){

            /* If the element has no value. */
            if($(this).val() == ""){
                continueInvoke = false;     /* Set the variable to false, to indicate that the form should not be submited. */
            }

        });

        /* Read the variable. Detect any items with no value. */
        if(continueInvoke == true){
            $('#fileSubmit').trigger('submit');      /* Submit the form. */
        }

    });
    });	
    </script>

</body>
</html>
<script>
    $('#docs').addClass('current_section'); 
</script>