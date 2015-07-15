
      <div id="left">
        <div class="cuadros">
          <h1 class="fondo01"><span>&iquest;Categor&iacute;a?</span></h1>
          <ul>
            <li><span>&nbsp;</span><?php echo anchor('articulos/lapiceros/plasticos', 'Pl&aacute;sticos')?></li>
            <li><span>&nbsp;</span><?php echo anchor('articulos/lapiceros/metalicos', 'Met&aacute;licos')?></li>
            <!--<li><span>&nbsp;</span>Especiales</li>
            <li><span>&nbsp;</span>Estuches</li>-->
          </ul>
        </div>
            
        <div class="cuadros">
          <h1 class="fondo02"><span>&iquest;Color?</span></h1>
          <ul>
            <li>
              <?php echo (isset($colores))?$colores:'';?>
                <!--<div class="iconos"><a href="#"><img src="<?php echo base_url()?>img/ico_color_fuxia.gif" width="26" height="26" alt=""/></a></div>
                <div class="iconos"><a href="#"><img src="<?php echo base_url()?>img/ico_color_azul.gif" width="26" height="26" alt=""/></a></div>
                <div class="iconos"><a href="#"><img src="<?php echo base_url()?>img/ico_color_beige.gif" width="26" height="26" alt=""/></a></div>
                <div class="iconos"><a href="#"><img src="<?php echo base_url()?>img/ico_color_limon.gif" width="26" height="26" alt=""/></a></div>
                <div class="iconos"><a href="#"><img src="<?php echo base_url()?>img/ico_color_morado.gif" width="26" height="26" alt=""/></a></div>
                <div class="iconos"><a href="#"><img src="<?php echo base_url()?>img/ico_color_negro.gif" width="26" height="26" alt=""/></a></div>
                <div class="iconos"><a href="#"><img src="<?php echo base_url()?>img/ico_color_rojo.gif" width="26" height="26" alt=""/></a></div>
                <div class="iconos"><a href="#"><img src="<?php echo base_url()?>img/ico_color_verde.gif" width="26" height="26" alt=""/></a></div>
                <div class="iconos"><a href="#"><img src="<?php echo base_url()?>img/ico_color_turkesa.gif" width="26" height="26" alt=""/></a></div>-->
            </li>
          </ul>
        </div>
            
        <div class="cuadros">
          <h1 class="fondo03"><span>&iquest;Logotipo?</span></h1>
          <div class="logos"><img src="<?php echo base_url()?>img/muestra_logo01.jpg" width="118" height="45" alt=""/></div>
          <div class="logos"><img src="<?php echo base_url()?>img/muestra_logo02.jpg" width="118" height="52" alt=""/></div>
        </div>
      </div>
      
      <div id="index-maquetar-06">
        <div style="float:left;margin:20px 0;width:100%;">
          <?php echo (isset($parameters))?$parameters:'';?>
        </div>
        <div class="menu">
          <a href="#" style="margin-left:115px;" class="menu_activado"><span>lapiceros</span></a>
          <a href="#" style="margin-left:245px;"><span>gimmix</span></a>
        </div>
        <?php 
          echo (isset($articulos))?$articulos:'';
          echo (isset($paginacion))?$paginacion:'';
        ?>
        <!--<div class="renglon_lapcero">
          <img src="<?php echo base_url()?>img/img_lapicero.jpg" alt=""/>
          <div class="codec"><span>1234567</span></div>
          <div class="ico_poner_quitar"><a href="#3."><img src="<?php echo base_url()?>img/ico_anadir.gif" alt=""/></a></div>
        </div>-->
      </div>
