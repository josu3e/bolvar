
$(function(){
      $("#form_cliente").validate({
          rules: {
            cli_nombre: {
              required: true
            },
            cli_email: {
              required: true,
							email: true
            },
            cli_fono: {
              required: true
            },
						 cli_empresa: {
              required: true
            }
          },
          messages: {
            cli_nombre: {
              required: "Ingrese Nombre"   
            },
            cli_fono: {
              required: "Ingresa Fono"
             
            },
						 cli_empresa: {
              required: "Ingresa Empresa"
             
            },
            cli_email: "Ingrese correo valido"
          }
        });

});