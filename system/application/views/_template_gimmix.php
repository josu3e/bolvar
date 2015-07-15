<?php echo doctype('xhtml1-trans')."\n";?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo meta('Content-type', 'text/html; charset=iso-8859-1', 'equiv')."\n";?>


<title>Bolivar International</title>
<?php
echo link_tag('css/estilos_home.css')."\n";
echo link_tag('css/sexyalertbox.css')."\n";
echo link_tag('css/jquery.lightbox-0.5.css')."\n";
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
<?php //echo 'ta-> '.$this->session->userdata('ta_id');?>
<?php //echo 'co-> '.$this->session->userdata('co_id');?>
<?php //echo 'cat-> '.$this->session->userdata('cat_id');?>

<div id="enganche">
    <div id="Tabla_01">
<div id="top">
      		<img src="<?php echo base_url();?>img/bar_top.jpg"/>
			<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','287','height','105','class','logo','src','<?php echo base_url();?>flash/logotipo','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','<?php echo base_url();?>flash/logotipo' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="287" height="105" class="logo">
      <param name="movie" value="flash/logotipo.swf">
              <param name="quality" value="high">
              <embed src="<?php echo base_url();?>flash/logotipo.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="287" height="105"></embed>
	    </object>
</noscript>

<?php echo (isset($cat_art))?$cat_art:'';?>

<input type="hidden" id="SessionValue" value="<?php echo $this->session->userdata('size_page');?>">
</body>
</html>