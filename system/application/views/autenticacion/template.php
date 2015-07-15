<?php echo doctype('xhtml1-strict')."\n"?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Administrador de contenidos</title>
  <?php
  echo link_tag('css/reset_grid.css')."\n";
  echo link_tag('css/css_account.css')."\n";
  ?>
</head>
<body>
  <div id="container">
    <div id="header">
      <div id="site_name"><img src="<?php echo base_url();?>img/proveedoresperu.png" border="" alt="" width="233" height="50"/></div>
      <div id="user_menu">
        <?php echo anchor('autenticacion/login', 'Acceder')?>
      </div>
    </div>
    <div id="content">
      <?php echo (isset($contenido))?$contenido:'';?>
    </div>
  </div>
  <div id="footer"></div>
</body>
