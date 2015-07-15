
      </div>
      <ul>
        <li><a href="<?php echo base_url()?>index.php/usuario/nosotros">Nosotros</a></li>
        <li><a href="<?php echo base_url()?>index.php/usuario/contacto">Contacto</a></li>
      </ul>
      <div class="bienvenidos"><span class="color">Bienvenido (a): </span>Diana Gaona</div>
      <div class="bot_cerrar"><a href="<?php echo base_url().'index.php/autenticacion/logout'?>">cerrar sesi&oacute;n</a></div>
      <div class="cotizar"><?php
      if($ta == 1 || $ta == 2)
      {
        echo '<a href="'.base_url().'index.php/usuario/cotizacion/load_cotizacion">&nbsp;</a>';
      }?></div>
    </div><?php
      $attributes = array('id' => 'form_articulo','name' => 'form_articulo');

      if($this->session->userdata('cot_id') && $ta == 3)
      {
        echo form_open_multipart('usuario/cotizacion/update_det_cot',$attributes);
      }
      elseif($ta == 5)
      {
        echo form_open_multipart('usuario/contacto/send_email',$attributes);
      }
      else
      {
        echo form_open_multipart('usuario/articulo/load_articulos/'.$ta,$attributes);
      }
    ?>
    <div id="left"><?php 
      if($ta == 1 || $ta == 2)
      {
        echo '<div class="cuadros"><h1 class="fondo01"><span>&iquest;Categor&iacute;a?</span></h1><ul>';
        echo (isset($category))?$category:'';
        echo '</ul></div>';
      }
      if($ta == 1)
      {
        echo '<div id="cuadro_color"><div class="cuadros"><h1 class="fondo02"><span>&iquest;Color?</span></h1><ul>';
        echo (isset($colores))?$colores:'';
        echo '<div id="colorcontent"></div></ul></div></div>';
      }
      if($ta == 1)
      {
        echo '<div id="cuadro_logo"><div class="cuadros"><h1 class="fondo03"><span>&iquest;Logotipo?</span></h1>';
        echo (isset($logosbyusu))?$logosbyusu:'';
        //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/usuario/logo/unset_logo">Quitar Logo</a>
        echo '</div></div>';
      }?>
    </div>
    <?php echo form_close();?>
    <div id="index-maquetar-06">
      <div class="menu">
        <a href="<?php echo base_url();?>" style="margin-left:115px;" class="menu_activado"><span>lapiceros</span></a>
        <a href="<?php echo base_url()?>index.php/usuario/articulo/load_gimmix" style="margin-left:245px;"><span>gimmix</span></a>
      </div>
      <?php echo (isset($articulos))?$articulos:''; ?>
    </div>
    <div id="bottom"><img src="<?php echo base_url()?>img/bottom.jpg" width="1028" height="61" alt=""/></div>
  </div>
</div>
<!------------------------------------------------------------------------------------------------->