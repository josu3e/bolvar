
$(function(){
      $("#form_perfil").validate({
						rules: {
            usu_email: {
              required: true,
							email: true
						}
          },
          messages: {
            usu_email: "Ingrese correo valido"
          }
        });

});