<?php

$lang['auth_login_incorrect_password'] = "Usuario o contraseña no coinciden.";
$lang['auth_login_username_not_exist'] = "Usuario o contraseña no coinciden.";

$lang['auth_username_or_email_not_exist'] = "Usuario o email no existen.";
$lang['auth_not_activated'] = "Su cuenta no ha sido activada aún. Por favor revise su email.";
$lang['auth_request_sent'] = "Su solicitud de cambio de contraseña ya ha sido enviada. Por favor revise su email.";
$lang['auth_incorrect_old_password'] = "Su contraseña anetrior es incorrecta.";
$lang['auth_incorrect_password'] = "Su contraseña es incorrecta.";

// Email subject
$lang['auth_account_subject'] = "%s detalle de cuenta";
$lang['auth_activate_subject'] = "%s activación";
$lang['auth_forgot_password_subject'] = "Solicitud de nueva contraseña";

// Email content
$lang['auth_activate_content'] = "Bienvenido a %s,
 
Para activar su cuenta, usted debe hacer el deposito correspondiente: 
 
Plan %s, %s Nuevos Soles anuales
Cuenta %s

 
Seguidamente debe ingresar su numero de operación del boucher de pago en el siguiente enlace:
%s
 
Por favor realice la activación de su cuenta en un m&aacute;ximo de %s horas, de lo contrario su
registro ser&aacute; invalido y tendrá que volver a registrarse.
 
Una ves activada su cuenta, usted puede usar su usuario o email para acceder y actualizar su anuncio las veces que sea necesario.
 
Los datos de su cuenta son los siguientes:
Usuario: %s
Email: %s
Contraseña: %s
 
Saludos,
El equipo de %s";

$lang['auth_activate_content_free'] = "Bienvenido a %s,
 
Para finalizar el registro de su Empresa confirme su dirección de correo electrónico bajo este enlace
en las siguientes %s horas, de lo contrario su registro ser&aacute; invalido y tendrá que volver a registrarse:
%s

Todos los datos suministrados por las Empresas ser&aacute;n revisados para su posterior activación.
Para cualquier consulta sobre nuestro servicio, nos puede contactar via mail a %s
 
Una ves activada su cuenta, usted puede usar su usuario o email para acceder a su panel de control y actualizar su anuncio las veces que sea necesario.
 
Los datos de su cuenta son los siguientes:
Usuario: %s
Email: %s
Contraseña: %s
 
Saludos,
El equipo de %s";

$lang['auth_forgot_password_content'] = "%s,

Usted tiene una peticion de cambio de password.
Porfavor ingrese al siguiente link, para completar el cambio.:
%s

Su Nuevo password: %s
LLave de activacion: %s

Despues de completar este proceso usted podra cambiar su password desde su panel de administracion.

Si usted tiene algun problema con su acceso porfavor contactese con nosotros %s.

Gracias,
El Equipo de %s";

/* End of file dx_auth_lang.php */
/* Location: ./application/language/english/dx_auth_lang.php */