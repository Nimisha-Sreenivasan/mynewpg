$.validator.addMethod("pan", function(value, element)
    {
        return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
    }, "Invalid Pan Number");
	
	$.validator.addMethod("validemail", function(value, element)
    {
        return this.optional(element) || /^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/.test(value);
    }, "Invalid Email Address");
	$.validator.addMethod("ifsccode", function(value, element)
    {
        return this.optional(element) || /^[A-Za-z]{4}\d{7}$/.test(value);
    }, "Invalid IFSC Code");   
	
	$.validator.addMethod("specialChars", function( value, element ) {
        var regex = new RegExp("^[a-zA-Z0-9 ]+$");
        var key = value;
        if (!regex.test(key)) {
           return false;
        }
        return true;

    }, "please use only alphanumeric or alphabetic characters");
	
	$.validator.addMethod("zipcode", function(value, element)
    {
        return this.optional(element) || /^(\d{6}-\d{4}|\d{6})$/.test(value);
    }, "Invalid Zipcode");
	
	// Delete data js 
	$(document).ready(function(){
        $(".deleteDdata").click(function(e){  
		$this  = $(this);   
		var url = $(this).attr("rel"); 			
		UIkit.modal.confirm('Are you sure you want to delete this record?', function(){
            $.get(url, function(r){ 				
				var r = JSON.parse(r);
                if(r.success){ 				
                    $this.closest("tr").remove();
                }
            })
		});
           
        });
    });