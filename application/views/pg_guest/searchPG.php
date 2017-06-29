<?php $this->load->view('pg_guest/header'); ?>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<body class=" sidebar_main_open sidebar_main_swipe">
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="top: 144px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Search PG</h4>
        </div>
		       <form id="searchpgform" method="post" action="<?php echo base_url();?>controller/save">
        <div class="modal-body">
    		City: <select name="city" id="city">
			  <option>Select</option>
			  <option>Bangalore</option>
			  <option>Kerala</option>
			  <option>Chennai</option>
			</select><br><br>
  			Area: <input type="text" name="area" id="area"><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="btnOK">OK</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
	</form>
      </div>
      
    </div>
  </div>
    <?php $this->load->view('pg_guest/menues'); ?>
 
    <div id="page_content">
        <div id="page_content_inner">
  <?php if (is_array($my_pg_dtl) || is_object($my_pg_dtl))
{?>
    <table>
	<tr style="color:#337ab7;">
    <th>PG NAME</th>
    <th>STATE</th>
	<th>ADDRESS</th>
    <th>COUNTRY</th>
  </tr>

<tbody>
<?php 
	foreach ($my_pg_dtl as $rows) {?>
    <tr>
            <td> <?php echo $rows['pg_name']; ?></td>
            <td> <?php echo $rows['pg_address_state']; ?></td>
		 	<td> <?php echo $rows['pg_address_line_1']."\n".$rows['pg_address_pincode'];  ?></td>
            <td> <?php echo $rows['pg_country'];  ?></td>
    </tr>
<?php } }else{ ?>
	<table width="100%">
         <tr>
           <td class="" style="height: 40px; text-align: center">There are no records available.</td>
		</tr>
    </table>                                           
<?php }
	?>
</tbody>
</table>
  </div>
    </div>
  <?php $this->load->view('pg_guest/footerjs'); ?>
</body>
</html>
<script>
    $('#dashboard_menu').addClass('current_section'); 
</script>
