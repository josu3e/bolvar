this.update = function(){
	$(".javier").keyup(function(){
    $.ajax({
      type: "GET",
      contentType: "html",
			url: "/index.php/usuario/cotizacion/update_det/"+this.id+"/"+this.value,
			 // url: "/bolivar/index.php/usuario/cotizacion/update_det/"+this.id+"/"+this.value,
      success: function(data){

      }
    });
		
  });

};