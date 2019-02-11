<script>
$(document).ready(function() { 
	// ------------------- extjs start  --------------- 
	
	// ------------------ datatable print -------------
	$('#employeeSchedule').DataTable( {   
        dom: 'Bfrtip',
        buttons: [
            'print'  
        ]
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

}); 
</script>    