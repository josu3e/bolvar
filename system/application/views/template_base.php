<?php echo doctype('xhtml1-trans')."\n";?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php echo (isset($title))?$title:'';?></title>
  <?php
    echo meta('Content-type', 'text/html; charset=iso-8859-1', 'equiv')."\n";
    echo link_tag('css/reset_grid.css')."\n";
    echo link_tag('css/_comun.css')."\n";
    echo link_tag('css/sexylightbox.css')."\n";
    echo (isset($extra_css))?$extra_css:'';
  ?>
    <script type="text/javascript" language="Javascript"> 
<!-- Begin 
document.oncontextmenu = function(){return false} 
// End --> 
</script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.flash.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.numeric.pack.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.pngFix.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/sexylightbox.v2.3.jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      var bu = '<?php echo base_url();?>';
      var ind = '<?php echo index_page();?>';
      $(document).pngFix();
      SexyLightbox.initialize({color:'black', dir: bu+'img/sexyimages'});
      $('#logotipo').flash({src: bu+'flash/logotipo.swf',height: '131px',width: '100%',play: 'true',loop: 'true',wmode: 'transparent',scale: 'noscale',allowFullScreen: 'false',salign: 't',allowScriptAccess: 'sameDomain'},{ version: 9});
      $(".add_cart").toggle(function(){$.ajax({url: bu+ind+'/articulos/add_cart/'+$(this).attr('id')});$(this).removeClass('add_cart_img').addClass('del_cart_img');},function(){$.ajax({url: bu+ind+'/articulos/del_cart/'+$(this).attr('id')});$(this).removeClass('del_cart_img').addClass('add_cart_img');});
      $(".del_cart").toggle(function(){$.ajax({url: bu+ind+'/articulos/del_cart/'+$(this).attr('id')});$(this).removeClass('del_cart_img').addClass('add_cart_img');},function(){$.ajax({url: bu+ind+'/articulos/add_cart/'+$(this).attr('id')});$(this).removeClass('add_cart_img').addClass('del_cart_img');});
      
      $(".titulo_tabla tbody tr").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});
      $(".titulo_tabla tbody tr:even").addClass("alt");
      
      $('.upd_cart').numeric().keyup(function(){$.ajax({url: bu+ind+'/articulos/upd_cart/'+$(this).attr('id')+'/'+$(this).val()});});
    });
  </script>
  <?php
    echo (isset($extra_js))?$extra_js:'';
  ?>
</head>
<body>
  <div id="enganche">
    <div id="Tabla_01">
      <div id="top">
        <img src="<?php echo base_url()?>img/bar_top.jpg" alt=""/>
        <div id="logotipo" class="logo"></div>
        <ul>
          <li><?php echo anchor('contacto', ' ',  (isset($con))?'class="con_activo"':'class="con"')?></li>
          <li><?php echo anchor('nosotros', ' ',  (isset($nos))?'class="nos_activo"':'class="nos"')?></li>
        </ul>
        <div class="bienvenidos"><span class="color">Bienvenido (a):  </span><?php echo $this->session->userdata('DX_name')?></div>
        <div class="bot_cerrar"><?php echo anchor('autenticacion/logout', 'Cerrar Sesión')?></div>
        <!--<div class="cotizar"><a href="#"></a></div>-->
      </div>
      <?php echo (isset($contenido))?$contenido:'';?>
      <div id="bottom">
        <?php echo anchor('http://www.guramistudios.com', ' ', 'class="link_gurami" target="_blank"')?>
        <img src="<?php echo base_url()?>img/bottom.jpg" width="1028" height="91" alt=""/>
      </div>
    </div>
  </div>
</body>
</html>