<?php echo doctype('xhtml1-trans')."\n";?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo (isset($title))?$title:'';?></title>
<?php
echo meta('Content-type', 'text/html; charset=iso-8859-1', 'equiv')."\n";
echo link_tag('css/_cotizar.css')."\n";
echo link_tag('css/_comun.css')."\n";
?>
  <script type="text/javascript" src="<?php echo base_url();?>js/AC_RunActiveContent.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/height_page.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/loadImage2.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.sexyalertbox.mini.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.7.2.custom.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/updateDetalle.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.center.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.blockUI2-29.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.lightbox-0.5.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/cambiarImagen.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".tbl_lista tbody tr").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});
      $(".tbl_lista tbody tr:even").addClass("alt");
      $(".menu li").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});

      $(".confirm").click(function(e){
        href = $(this).attr("href");
        Sexy.confirm("<h1>"+$(this).attr("title")+"</h1>", {
        onComplete:
          function(returnvalue){
            if (returnvalue){
              /*Sexy.alert(href);*/
              window.location.href = href;
            }
          }
        });
        return false;
      });

      size_page();
      update();
      cambiarImagen();
      $(".imagen a").lightBox();
      $("#form_articulo").validate({
        rules: {
          empresa: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          comentario: {
            required: true
          }
        },
        messages: {
          empresa: {
            required: "Ingrese Empresa"
          },
          comentario: {
            required: "Ingresa Comentario"
          },
          email: "Ingrese correo valido"
        }
      });
	  });
  </script>
</head>

<body>
<div id="enganche">
    <div id="Tabla_01">
<div id="top">
      		<img src="<?php echo base_url()?>img/bar_top.jpg" alt=""/>
			<div class="logo">
              <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','313','height','131','src','flash/logotipo','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/logotipo' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="313" height="131">
                <param name="movie" value="flash/logotipo.swf">
                <param name="quality" value="high">
                <param name="wmode" value="transparent">
                <embed src="flash/logotipo.swf" width="313" height="131" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
              </object>
			</noscript>
<?php echo (isset($cat_art))?$cat_art:'';?>
</body>
</html>