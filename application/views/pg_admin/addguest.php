<?php $this->load->view('pg_admin/header'); ?>
<style>
#web_loader{
position:absolute;
left:50%;top:34%;
display:none;
z-index: 10;
}

.overlay{width:100%;
position:absolute;
height:100%;
z-index:0;
left: 0px;
top: 0px;
background: rgba(256, 256, 256, 0.4);
display:none;}

 #modalmsgsave3{
    padding: 24px;
    width: 418px;
    height: 100px;
    position: absolute;
    left: 121px;
    top: 2px;
    z-index: 999;
    box-shadow: rgb(0, 0, 0) 6px 6px 22px;
    background: rgb(255, 255, 255);
    font-size: 14px;
    display: none;
    padding-top: 65px;
   }
	
	#modalmsgsave3_ok , #cancel{
   margin: 30px 150px;
   width: 100px;
   height: 30px;
   background-color: #5da52e;
   border: 2px solid white;
   color: #fff;
   border-radius: 7px;
   font-weight: bold;	
   }
</style>

<body class=" sidebar_main_open sidebar_main_swipe">
<div style="position: fixed; width: 100%; height: 100%; left: 0; top: 0;background-color:#fff; opacity:0.5;z-index: 999;" class="overlay"></div>
   <?php $this->load->view('pg_admin/menues'); ?>
    <div id="page_content" >
        <div id="page_content_inner">
		<span id="web_loader"><img src="<?php echo base_url('images/loader.gif');?>"/></span>

<div id="modalmsgsave3"></div>
            <!-- statistics (small charts) -->
            <h2><span class="alert_msg" style="float:right; font-size:14px; color:red;"></span></h2><br/>
            <div class="md-card ">
                
                        <div class="user_content ">
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#" class="type_expense" data-flag="1">Send Guest Invitation</a></li>
                                <li><a href="#" class="type_expense" data-flag="2">Add Guest Complete Detail</a></li>
                                <li><a href="#"  data-flag="3" id="myguestlist">My Guest List</a></li>
                                <li id="rcptli"><a href="#"  data-flag="4" id="genrecpt">Generated Receipts</a></li>                                
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                    <div class="md-card ">
                                        <div class="md-card-toolbar">
                                            <div class="md-card-toolbar-actions">
<!--                                                <a class="md-fab md-fab-small md-fab-accent save_monthly_expense" style="float:left">
                                                    <i class="material-icons md-color-white"></i>
                                                </a>-->
                                                <i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>
                                                <i class="md-icon material-icons md-card-toggle">&#xE316;</i>
                                                
                                            </div>
<!--                                            <h2 class="md-card-toolbar-heading-text">
                                                <b>Add Your Monthly Expense</b>
                                            </h2>-->
                                        </div>
                                        <div class="md-card-content">
                                            <form id="sendinvetation">
                                            <table class="table table-bordered table-hover table_monthly">
                                                <thead>
                                                    <tr>
                                                        <th width="2%"><input id="check_all" style="display:none;" class="formcontrol" type="checkbox"/></th>                                                        
                                                        <th width="20%">Name</th>
                                                        <th width="20%">Email</th>
                                                        <th width="20%">Mobile No</th>
                                                        
                                                        <th width="20%">Joining Date</th>
                                                        <th width="20%">Branch</th>
                                                    </tr>
                                                </thead>                                                
                                                <tbody class="expense_table_body expense_table_monthly">
                                                </tbody>
                                            </table>   
                                            <div class='row'>
                                                <div class='col-xs-12 col-sm-3 col-md-3 col-lg-3' style="text-align:right;margin-top: 15px;">
                                                    <button class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light delete_monthly" type="button">- Delete</button>
                                                    <button class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light addmore_monthly" type="button">+ Add</button>
                                                    <button  id="submit" disabled class="md-btn md-btn-flat-primary md-btn-wave-light waves-effect waves-button waves-light" type="submit">Send Invitation</button>
                                                </div>
                                            </div> 
                                            </form>                       
                                        </div>
                                    </div>
                                    
                                </li>
                                
                                <li>
                                    <div class="md-card">
                                        <div class="md-card-toolbar">
                                            <div class="md-card-toolbar-actions">
                                                <a class="md-fab md-fab-small md-fab-accent save_onetime_expense" style="float:left">
                                                    <i class="material-icons md-color-white"></i>
                                                </a>
                                                <i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>
                                                <i class="md-icon material-icons md-card-toggle">&#xE316;</i>
                                                
                                            </div>
                                            <h2 class="md-card-toolbar-heading-text">
                                                <b>Add guest complete details.</b>
                                            </h2>
                                        </div>
                                        <div class="md-card-content">  
                                        </div>
                                    </div>
                                </li>
                                  <li>
                                    <div class="1md-card uk-margin-medium-bottom">
                                        <div class="pgbranch uk-grid">
                                                <div class="uk-width-medium-1-6 uk-row-first">
                                                    <div class="md-input-wrapper">
                                                <label for="pglist">Select Your Branch: </label>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-3">
                                                  <div class="md-input-wrapper">
                                            <select id="yourpgbranch" name="pg_branch" class="md-input">
                                                <option value="-1">Select PG Branch</option>
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
											 <table class="uk-table  table_check">
												<thead>
												<tr>
													<th class="uk-width-1-10 uk-text-center small_col">#</th>
													<th class="uk-width-1-10 uk-text-center">Name</th>
													<th class="uk-width-2-10">Address</th>
													<th class="uk-width-2-10 uk-text-center">Email</th>
													<th class="uk-width-1-10 uk-text-center">Mobile No</th>
                                                                                                        <th class="uk-width-1-10 uk-text-center">Receipt</th>
                                                                                                        <th class="uk-width-2-10 uk-text-center">Active</th>
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
                                </li>
                                   <li>
                                        <?php if(!empty($this->session->flashdata('flsh_msg'))){ ?>
                           <div class="uk-alert uk-alert-success" data-uk-alert="">
                                <a href="" class="uk-alert-close uk-close"></a>
                                <p><?php echo $this->session->flashdata('flsh_msg'); ?> </p>
                            </div>
                            <?php  } ?>
                                    <div class="1md-card uk-margin-medium-bottom">
                                        <div class="pgbranch uk-grid">
                                                <div class="uk-width-medium-1-6 uk-row-first">
                                                    <div class="md-input-wrapper">
                                                <label for="pglist">Select Your Branch: </label>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-3">
                                                  <div class="md-input-wrapper">
                                            <select id="pgbranchrcpt" name="pg_branch" class="md-input">
                                                <option value="-1">Select PG Branch</option>
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
											 <table class="uk-table  table_check">
												<thead>
												<tr>    
													<th class="uk-width-1-10 uk-text-center small_col">Receipt No</th>
													<th class="uk-width-1-10 uk-text-center">Guest Name</th>
													<th class="uk-width-2-10">Amount</th>
													<th class="uk-width-2-10 uk-text-center">Comments</th>
													<th class="uk-width-1-10 uk-text-center">Date</th>
                                                                                                        <th class="uk-width-2-10 uk-text-center">Actions</th>
                                                                                                        
												
												</tr>
												</thead>
												<tbody id="genrecpttlist">
												
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

       <!-- location model /-->
            <!-- employee adder model -->
            <div id="updatereceipt" class="uk-modal-container uk-modal">
                <form action="<?php echo base_url().'pg_admin/MyGuest/generateInvoice' ?>" id="updatereceiptdetails" name="updatereceipt" method="post"> 
            <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close add_emp_close"></a>
            <h2 style="border-bottom: 1px solid #ccc; padding: 5px;">Update Receipt</h2>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Name <span class="req">*</span></label><input name="recpt_gname" id="recpt_gname" type="text" class="md-input recpt_gname" readonly /><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Amount <span class="req">*</span></label><input type="number"  id="recpt_gamnt" name="recpt_gamnt" class="md-input recpt_gamnt" min="1" required/><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            
             <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Month <span class="req">*</span></label>
                        <?php
                        $monthArray = range(1, 12);
                        ?>
                        <select name="recpt_month" class="md-input recpt_month" required>
                            <option value="">Select Month</option>
                        <?php
                            foreach ($monthArray as $month) {
                                // padding the month with extra zero
                                $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                                // you can use whatever year you want
                                // you can use 'M' or 'F' as per your month formatting preference
                                $fdate = date("F", strtotime("2015-$monthPadding-01"));
                                
                                echo '<option value="'.$fdate.'">'.$fdate.'</option>';
                            }
                         ?>
                        </select>
                            <span class="md-input-bar"></span>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Year <span class="req">*</span></label>
                          
                                        <?php
                            // set start and end year range
                            $lastyear = date("Y",strtotime("-1 year"));
                            $thisyear = date('Y');
                            $yearArray = range($lastyear, $thisyear);
                            ?>
                            <!-- displaying the dropdown list -->
                            <select name="recpt_year" class="md-input recpt_year" required>
                                <option value="">Select Year</option>
                                <?php
                                foreach ($yearArray as $year) {
                                    // if you want to select a particular year
                                  
                                    echo '<option  value="'.$year.'">'.$year.'</option>';
                                }
                                ?>
                            </select>  
                            <span class="md-input-bar"></span>
                        </div>
    
                    </div>
                </div>
            </div>
         
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1">
                        <div class="md-input-wrapper md-input-filled"><label>Comments</label><textarea type="text" id="recpt_cmnt" name="recpt_cmnt" class="md-input recpt_cmnt"></textarea><span class="md-input-bar"></span></div>
                    </div>
                    
                </div>
            </div>
           
            <input  type="hidden" value="" id="guser_id" name="guser_id" />
            <input  type="hidden" value="" id="company_id" name="company_id" />
            <input  type="hidden" value="" id="pg_id" name="pg_id" />
           
            <input  type="hidden" value="" id="rcpt_id" name="rcpt_id" />
            <div style="width:100%; text-align:center;    margin-top: 15px;">
                <button type="submit" class="add_emp_save md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" style="width:100px;">Update</button>
            </div>
             </div>
				</form>           
                
</div>
            <!-- employee adder model /-->
            
              <div id="generatereceipt" class="uk-modal-container uk-modal">
                <form action="<?php echo base_url().'pg_admin/MyGuest/generateInvoice' ?>" id="generatereceiptdetails" name="generatereceipt" method="post"> 
            <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close add_emp_close"></a>
            <h2 style="border-bottom: 1px solid #ccc; padding: 5px;">Generate Receipt</h2>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Name <span class="req">*</span></label><input name="recpt_gname" id="recpt_gname" type="text" class="md-input recpt_gname" readonly /><span class="md-input-bar"></span></div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper"><label>Amount <span class="req">*</span></label><input type="number" name="recpt_gamnt" class="md-input recpt_gamnt" min="1" required/><span class="md-input-bar"></span></div>
                    </div>
                </div>
            </div>
            
             <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Month <span class="req">*</span></label>
                        <?php
                        $monthArray = range(1, 12);
                        ?>
                        <select name="recpt_month" class="md-input recpt_month" required>
                            <option value="">Select Month</option>
                        <?php
                            foreach ($monthArray as $month) {
                                // padding the month with extra zero
                                $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                                // you can use whatever year you want
                                // you can use 'M' or 'F' as per your month formatting preference
                                $fdate = date("F", strtotime("2015-$monthPadding-01"));
                                 $selected = ($fdate == date('F')) ? 'selected' : '';
                                echo '<option '.$selected.' value="'.$fdate.'">'.$fdate.'</option>';
                            }
                         ?>
                        </select>
                            <span class="md-input-bar"></span>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="md-input-wrapper md-input-filled"><label>Year <span class="req">*</span></label>
                          
                                        <?php
                            // set start and end year range
                            $lastyear = date("Y",strtotime("-1 year"));
                            $thisyear = date('Y');
                            $yearArray = range($lastyear, $thisyear);
                            ?>
                            <!-- displaying the dropdown list -->
                            <select name="recpt_year" class="md-input recpt_year" required>
                                <option value="">Select Year</option>
                                <?php
                                foreach ($yearArray as $year) {
                                    // if you want to select a particular year
                                    $selected = ($year == date('Y')) ? 'selected' : '';
                                    echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                                }
                                ?>
                            </select>  
                            <span class="md-input-bar"></span>
                        </div>
    
                    </div>
                </div>
            </div>
         
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1">
                        <div class="md-input-wrapper"><label>Comments</label><textarea type="text" name="recpt_cmnt" class="md-input recpt_cmnt"></textarea><span class="md-input-bar"></span></div>
                    </div>
                    
                </div>
            </div>
           
            <input  type="hidden" value="" id="guser_id" name="guser_id" />
            <input  type="hidden" value="" id="company_id" name="company_id" />
            <input  type="hidden" value="" id="pg_id" name="pg_id" />
            
            <div style="width:100%; text-align:center;    margin-top: 15px;">
                <button type="submit" class="add_emp_save md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" style="width:100px;">Generate</button>
            </div>
             </div>
				</form>           
                
</div>

  <?php $this->load->view('pg_admin/footerjs'); ?>

</body>
</html>
<script>
    $('#addguest').addClass('current_section'); 
</script>
<script>
var i=$('.table_monthly tr').length;
$(".addmore_monthly").on('click',function(){
	document.getElementById('submit').disabled = false;
    var branch_cnt = "<?php echo $pg_cnt;?>";
      
    if(branch_cnt > 0){
       
    html = '<tr class="monthly_table">';
    html += '<input type="hidden" value="0" class="e_id"/>';
    html += '<td><input class="case" type="checkbox"/></td>';
    html += '<td><input type="text"  onKeyPress="return ValidateAlpha(event);" name="guest_name[]" id="itemNo_'+i+'" class="form-control autocomplete_txt" autocomplete="off" required=""></td>';
    html += '<td><input type="email" name="guest_email[]" id="itemName_'+i+'" class=" form-control autocomplete_txt"  autocomplete="off" required=""></td>';        
    html += '<td><input type="text"  onKeyPress="return isNumberKey(event);" minlength="10" maxlength="10" name="guest_mobile[]" id="total_'+i+'" class=" form-control totalLinePrice" autocomplete="off"  ondrop="return false;" onpaste="return false;" required=""></td>';
    html += '<td><input type="text" name="guest_doj[]" id="" data-uk-datepicker="{format:"DD-MM-YYYY"}" class=" form-control changesNo" autocomplete="off" required=""></td>';
    html += '<td><select id="yourpgbranch" name="guest_branch[]" style="height: 36px;padding:0" class="form-control md-input" required><option value="">Select PG Branch</option><?php if($my_pg_dtl>0){foreach ($my_pg_dtl as $key => $value) { ?><option value="<?php echo $value['mypg_id']; ?>"><?php echo $value['pg_name']; ?></option> <?php }}  ?></select></td>';
    html += '</tr>';
    $('.table_monthly').append(html);
    }else{
         var msg = "Please <a href='<?php echo base_url()."pg_admin/MyPG/details" ?>'>click here</a> to add PG branch";
          UIkit.modal.alert(msg);
    }
    i++;
});
	
function isNumberKey(evt){  		
				
	var charCode = (evt.which) ? evt.which : evt.keyCode		
    if (charCode != 46 && charCode > 31 		
	&& (charCode < 48 || charCode > 57))		
        return false;		
        return true;		
	}		
		   		
    function ValidateAlpha(evt)		
    {		
        var keyCode = (evt.which) ? evt.which : evt.keyCode		
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)		
        return false;		
            return true;		
    }		

$(".delete_monthly").on('click', function() {
    $('.case:checkbox:checked').parents("tr").remove();
    $('#check_all').prop("checked", false); 
    // calculateTotal();
});
//to check all checkboxes
$(document).on('change','#check_all',function(){
    $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

$('#pgbranchrcpt').change(function(){
       var pg_id = $('#pgbranchrcpt').val();
       //alert(pg_id);
      $.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'pg_admin/MyGuest/generatedRcpt' ?>",    
                        data: {
                        data: pg_id
                        },
                        dataType: 'json',
                        success: function(data) {
                            var data = jQuery.parseJSON(JSON.stringify(data));
                            console.log(data);

                            if(data.guests.length >= 1)
                            {
                              //var receiptmodal = " '#generatereceipt' ";
                              var html ="";
                              var j = 1;
                              for (var i = 0; i < data.guests.length; i++) {
                                    var comments = data.guests[i].comments;
                                   // var comments = comments.replace(/(.{80})/g, "$1<br>");
                                   // var strpcmts =  comments.replace(/<(?:.|\n)*?>/gm, '');
                                    html +='<td class="uk-text-center small_col">'+data.guests[i].rcpt_no+'</td>';
                                    html +='<td class="uk-text-center">'+data.guests[i].g_name+'</td>';
                                    html +='<td class="uk-text-center">'+data.guests[i].rent+'</td>';
                                    html +='<td class="uk-text-center" style="word-break:break-all;">'+comments+'</td>';
                                    html +='<td class="uk-text-center">'+data.guests[i].date+'</td>';
                                    html +='<td class="uk-text-center"><a href="#updatereceipt" id="uptrecptbtn" data-comments="' +comments+ '" data-rcptid="'+data.guests[i].rcpt_no+'" data-guserid='+data.guests[i].g_uid+' data-companyid="'+data.guests[i].com_id+'" data-month="'+data.guests[i].month+'" data-year="'+data.guests[i].year+'" data-name="'+data.guests[i].g_name+'" data-rent="'+data.guests[i].rent+'"  data-uk-modal><i class="md-icon material-icons" >&#xE254;</i></a></td></tr>';
                                    j++;
                               								
                                    
                               }
                              $('#genrecpttlist').html(html);
                            } else 
                            {
                                  var html ="";
                                   $('#genrecpttlist').html(html);
                            }
                         }
                        });
  
   });

$('#yourpgbranch').change(function(){
       var pg_id = $('#yourpgbranch').val();
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
                            console.log(data);
                            if(data.guests.length >= 1)
                            {
                              //var receiptmodal = " '#generatereceipt' ";
                              var html ="";
                              var j = 1;
                              for (var i = 0; i < data.guests.length; i++) {                                    
                                    html +='<tr><td class="uk-text-center uk-table-middle small_col">'+ j +'</td>';
                                    html +='<td class="uk-text-center"><label>'+data.guests[i].first_name+'</label></td>';
                                    html +='<td class="uk-text-center"><label>'+data.guests[i].address+'</label></td>';
                                    html +='<td class="uk-text-center"><label>'+data.guests[i].email_id+'</label></td>';
                                    html +='<td class="uk-text-center"><label>'+data.guests[i].mobile_no+'</label></td>';
                                    html +='<td class="uk-text-center"><label><a href="#generatereceipt" id="recptbtn" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" data-guserid="'+data.guests[i].g_uid+'" data-companyid="'+data.guests[i].pg_company_id+'"  data-pgid ="'+data.guests[i].mypg_id+'" data-name="'+data.guests[i].first_name +'" data-uk-modal id="gen_invoice'+data.guests[i].g_uid+'" >Generate</a></label></td>';   
                                    html +='<td class="uk-text-center"><label><input type="checkbox" name="gueststatus" id="gueststatus" '+(data.guests[i].guest_status == "active" ? "checked" : "" )+' onchange=changeStatus(this,"'+data.guests[i].email_id+'"); value="FALSE"></label></td>';
                                    j++;
                               }
                              $('#tmyguestlist').html(html);
                            } else 
                            {
                                var html ="";
                                $('#tmyguestlist').html(html);
                            }
                         }
                        });
  
   });
   
  /*     $('#generatereceipt').on('uk.modal.show', function (event) {
       // var atag = $(event.relatedTarget);
      alert('name');
        var name = jQuery(this).data('name');
         alert(name);
         alert('name');
        var modal = $(this);
        modal.find('.uk-modal-dialog #recpt_gname').val(name);
      
    }); */

$(document).on('click', '#recptbtn', fn_buttonmodal_habndler);

function fn_buttonmodal_habndler(e)
{
    //get id from pressed button
    var name = $(e.target).data('name');
    var guserid = $(e.target).data('guserid');
    var companyid = $(e.target).data('companyid');
    var pgid = $(e.target).data('pgid');
    //alert(name);
    $('#generatereceipt').on({
        'uk.modal.show':function(){
         var modal = $(this);
        modal.find('.uk-modal-dialog #recpt_gname').val(name);  
        modal.find('.uk-modal-dialog #guser_id').val(guserid);
        modal.find('.uk-modal-dialog #company_id').val(companyid);
        modal.find('.uk-modal-dialog #pg_id').val(pgid);
        //$('span', $(this)).html('ID from pressed button '+fn_id);
        },
        'uk.modal.hide':function(){
                    //hide modal
        }
    }).trigger('uk.modal.show');
}

$(document).on('click', '#uptrecptbtn', uptrecpt_buttonmodal_habndler);

function uptrecpt_buttonmodal_habndler(e)
{
    //get id from pressed button
    var name = $(e.target.parentNode).data('name');
    var rent = $(e.target.parentNode).data('rent');
    var comments = $(e.target.parentNode).data('comments');
    var month = $(e.target.parentNode).data('month');
    var year = $(e.target.parentNode).data('year');
    var guserid = $(e.target.parentNode).data('guserid');
    var companyid = $(e.target.parentNode).data('companyid');
    var rcpt_id = $(e.target.parentNode).data('rcptid');
   // alert(year);
    $('#updatereceipt').on({
        'uk.modal.show':function(){
         var modal = $(this);
        modal.find('.uk-modal-dialog #recpt_gname').val(name);  
        modal.find('.uk-modal-dialog #recpt_gamnt').val(rent);
        modal.find('.uk-modal-dialog #recpt_cmnt').val(comments);
        modal.find('.uk-modal-dialog .recpt_month').val(month);
        modal.find('.uk-modal-dialog .recpt_year').val(year);
        modal.find('.uk-modal-dialog #guser_id').val(guserid);
        modal.find('.uk-modal-dialog #company_id').val(companyid);
        modal.find('.uk-modal-dialog #rcpt_id').val(rcpt_id);
        //$('span', $(this)).html('ID from pressed button '+fn_id);
        },
        'uk.modal.hide':function(){
                    //hide modal
        }
    }).trigger('uk.modal.show');
}
   
   
$(document).ready(function(){
    if(window.location.hash == '#rcpt'){ 
       
      if($("#user_profile_tabs li").hasClass("uk-active")){
                 $("#user_profile_tabs li").removeClass("uk-active");
                 $("#user_profile_tabs li#rcptli").addClass("uk-active");
      }
  }
  

     
});
 
function changeStatus(ele,email){
    var email = email;
   
    if (ele.checked) {
      
        var guest_status = "active";
    }else{
        var guest_status = "inactive";
    }    
         jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'pg_admin/MyGuest/changeGuestStatus' ?>",    
                        data:{
                            'guest_status':guest_status,
                            'email': email
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            alert(data.status);
                            console.log(data.status);
							
                           // $("#sendinvetation").trigger('reset');
                         }
                        });
}
  


// send Invitation
$("#sendinvetation").submit(function(e) {
               
            e.preventDefault();
		    //$("#modalmsgsave3").css('display','block');
		    $('.overlay').css('display','block');
			$('#web_loader').css('display','block');
 			$('#web_loader').append("<h3 style=\"color:#000;text-shadow: 1px 2px 0px #ddd; margin: 1em -38px !important;\">Your request is being processed</h3>");
			
            jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'pg_admin/MyGuest/sendNotification' ?>",    
                        data: $(this).serialize(),
                        success: function(data) {
                            var data = JSON.parse(data);
                             UIkit.modal.alert(data.status);
							$("#web_loader").css('display','none');
							$('#web_loader').html("");
							$('.overlay').css('display','none');
                            $("#sendinvetation").trigger('reset');
                         }
                        });
                });
</script>