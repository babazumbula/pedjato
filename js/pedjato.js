$(function() {
    
	
	$( "#wrapper button" ).on("click", zipatoRest);
	
	function zipatoRest(){
		
		$.ajax({
		 type: 'POST',		  
		 url:"http://localhost/pedjato/php/webservicezipato.php",			
		 dataType: 'json',
		 data:{'action':$( this ).text()},
		 success:function(json){/*
			 $.each( json.query, function( key, val ) {
				console.log(key + ":" + val);
			});*/
			 console.log(json);
		 },
		 error:function(xhr, status){
			 console.log("error");
			 console.log(xhr);
			 console.log(status);
		 }   
		});
		
	}
	
});