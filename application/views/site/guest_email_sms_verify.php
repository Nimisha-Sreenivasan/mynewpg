<?php $this->load->view('pg_admin/header'); ?>
<body class="top_menu">
    <!-- main header -->
   <?php $this->load->view('site/menues'); ?>


<div id="page_content">
    <div id="page_content_inner">

       <h3 class="heading_b uk-margin-bottom">Email / SMS verification</h3>
        <div class="md-card">
            <div class="md-card-content">             
              <div><?php echo (isset($data['msg'])) ? $data['msg'] : ''; ?></div>
               <div id="errormsg"></div>
               <form name="emailverification" action="<?php echo base_url().'/Guestregister/continue_guestresgister' ?>" method="post" id="emailverification">
                 <div class="uk-grid" data-uk-grid-margin>                   
                        <div class="uk-width-medium-1-2">                           
                            <div class="uk-form-row">
                                <label>Email Address</label>
                                <input type="text" class="md-input" name="guest_email" value="<?php echo (isset($data['email'])) ? $data['email'] : ''; ?>"  />
                            </div>                            
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Verification Code</label>
                                <input type="text" class="md-input" name="entrycode" value="<?php echo (isset($data['entrycode'])) ? $data['entrycode'] : ''; ?>" />
                                <input type="hidden" class="md-input" name="pg_id" value="<?php echo (isset($data['pg_id'])) ? $data['pg_id'] : ''; ?>"  />
                            </div>                            
                        </div>                                        
                     <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <button type="submit" class="md-btn md-btn-primary">Continue</button>
                        </div>
                    </div>
                </div>
                
                 </form>
                 
            </div>
        </div>
    </div>
</div>
 <?php $this->load->view('pg_admin/footerjs'); ?>
  <script>                  
   
   $("#emailverification").validate({
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
         guest_email:{
            required: true,
            email: true,
            validemail:true
         },
         entrycode:"required"
           
      },
      errorElement: "div",
      errorPlacement: function(error, element) {
         element.parent('div').after(error);
      },
      submitHandler: function(form) {
         jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url().'Guestregister/continue_guestresgister' ?>",    
            data: $("#emailverification").serialize(),
            success: function(response) {
                var response = JSON.parse(response);              
                
                if(response.status == "success")
                {                                   
                   window.location.href = "<?php echo base_url().'Guestregister?rand='; ?>"+response.data;
                } else
                {
                   $("#errormsg").html(response.data);
                }
             }
            });
      }
      
   });
  </script>
</body>
</html>