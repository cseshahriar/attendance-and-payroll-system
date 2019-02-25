<script>
$(document).ready(function() { 
	// ------------------- extjs start  --------------- 
	
	// ----------------- admin password change--------- 
	$("#password-form").on("submit", function(e) {
		e.preventDefault(); 
		var user = $(this).serialize();   

		$.ajax({
			url: "<?= ROOTURL.'/admin/cangePassword' ?>", 
			type: "POST",
			data: user, 
			dataType: 'json',
			success: function(response) {  
				if (response.errors) {
					
		            if (response.password_error) {     
		              $('.password_error').hide();  

		              $('.password_error').show();     
		              $('.password_error').html(response.password_error);  
		            }

		            if (response.conf_password_error) {     
		              $('.conf_password_error').hide();   

		              $('.conf_password_error').show();     
		              $('.conf_password_error').html(response.conf_password_error);  
		            } 

		            if (response.current_password_error) {     
		              $('.current_password_error').hide();   

		              $('.current_password_error').show();      
		              $('.current_password_error').html(response.current_password_error);  
		            }  

				} else { 
					if (response.message) {     
			              $('.alert-success ').hide();   
			              $('.alert-success ').show();       
						  $('.message').html(response.message); 
		            } 
				}

			}
		});
		
	});


	// ----------------- admin photo change -------------  
	 
	// ------------------ datatable print -------------
	$('#print').DataTable( {    
        dom: 'Bfrtip',
        buttons: [
            'print'  
        ],
    } );  

	// ---------------- chart -----------
	// Year list 
	var start = 2000;
	var end = new Date().getFullYear(); 
	var options = "";
	for(var year = start ; year <= end; year++){
	  options += "<option>"+ year +"</option>";
	}
	document.getElementById("select_year").innerHTML = options;
	
	// ----------------- user photo update  
}); 
</script>    