this.cambiarImagen = function(){
	$(".ico_poner").click(function(){
	
		var var_name = this.id;
		
		var url = location.href;
		var baseURL = url.substring(0, url.indexOf('/', 14));
		
		$(this).attr("src", baseURL+'/img/ico_quitar.gif');
		// $(this).attr("src", baseURL+'/bolivar/img/ico_quitar.gif');
    $.ajax({
      type: "GET",
      contentType: "html",
			 url: "/index.php/usuario/cotizacion/add_item/"+var_name,
			 // url: "/bolivar/index.php/usuario/cotizacion/add_item/"+var_name,
      success: function(data){

      }
    });
		
		
  });

};

	
