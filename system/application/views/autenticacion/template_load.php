<?php echo doctype('xhtml1-trans')."\n";?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php echo meta('Content-type', 'text/html; charset=iso-8859-1', 'equiv')."\n";?>
  <title>Bolivar International</title>
  <?php
  echo link_tag('css/estilos_home.css')."\n";
  ?>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.flash.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#animacion').flash({
        src: '<?php echo base_url();?>flash/flash_local.swf',
        width: '100%',
        height: '100%',
        quality: 'high',
        pluginspage: 'http://www.macromedia.com/go/getflashplayer',
        align: 'top',
        play: 'true',
        loop: 'true',
        wmode: 'window',
        scale: 'noborder',
        devicefont: 'false',
        bgcolor: '#ffffff',
        menu: 'true',
        allowFullScreen: 'false',
        allowScriptAccess: 'sameDomain',
        salign: ''
      },
      { version: 9});
    });
    
    $("#animacion").flash({  
      // swf: "flash/flash_main.swf",  
      width: "100%",  
      height: "100%",  
      params: {  
        wmode: "opaque"  
      }  
    });  
  </script>
</head>
<body>
  <div id="animacion" class="animacion">&nbsp;</div>
</body>
</html>