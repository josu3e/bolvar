<?php echo doctype('xhtml1-trans')."\n";?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo meta('Content-type', 'text/html; charset=iso-8859-1', 'equiv')."\n";?>
<title>Administrador de contenidos</title>
<?php
echo link_tag('css/reset_grid.css')."\n";
echo link_tag('css/estilos_administrador.css')."\n";
?>
</head>
<body>
  <div id="container">
    <div id="header">
      <div id="site_name"><img src="<?php echo base_url();?>img/main_logo.jpg" border="" alt="" width="233" height="50"/></div>
      <div id="user_menu">
        <p>Has iniciado sessión como <strong>administrador</strong> – <?php echo anchor('autenticacion/logout_admin', 'Cerrar Sesión')?></p>
        <p><?php echo anchor(base_url(), 'Página de incio', 'id="bu"')?></p>
      </div>
    </div>
    <?php echo (isset($contenido))?$contenido:'';?>
  </div>
  <div id="footer"></div>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.1.4.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.functions.admin.min.js"></script>
</body>
</html>