
$(function(){
      $("#form_admin").validate({
          rules: {
            old_password: {
              required: true
            },
            new_password: {
              required: true,
							minlength: 4,
							maxlength: 20
            },
            confirm_new_password: {
              required: true,
							minlength: 4,
							maxlength: 20,
							equalTo: "#new_password"
            }

          },
          messages: {
            old_password: {
              required: "Ingrese Password"   
            },
            new_password: {
              required: "Ingrese Nuevo Password",
							minlength:"Debe ser de almenos 4 caracteres",
							maxlength:"Debe contener 20 carateres como maximo"
            },
						 confirm_new_password: {
              required: "Confirme Password",
							equalTo: "Porfavor ingrese el mismo password de arriba",
							minlength:"Debe ser de almenos 4 caracteres",
							maxlength:"Debe contener 20 carateres como maximo"
             
            }
						
          }
        });

});