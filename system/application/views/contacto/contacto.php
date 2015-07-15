
<?php
$nom = array('name'=>'nom', 'id'=>'nom', 'class'=>'celda01', 'value'=>set_value('nom'));
$empresa = array('name'=>'empresa',  'id'=>'empresa', 'class'=>'celda01', 'value'=>set_value('empresa'));
$tel = array('name'=>'tel',  'id'=>'tel', 'class'=>'celda01', 'value'=>set_value('tel'));
$email = array('name'=>'email',  'id'=>'email', 'class'=>'celda01', 'value'=>set_value('email'));
$coment = array('name'=>'coment', 'id'=>'coment', 'class'=>'celda02', 'value'=>set_value('coment'));
?>
<div class="imagen_info">
  <div id="info_contact">
  Av. Manuel Olgu&iacute;n 533 Ofic. 303 Surco, Lima-Per&uacute;<br/>
  Oficina: <strong>798-01.60</strong><br/> 
  Tel/fax:<strong> 436-80.29</strong><br/> 
  E-mail:<strong>ventas@bolivarinternational.com </strong>
  </div>
  <img src="<?php echo base_url()?>img/img_contactenos.jpg" width="316" height="319" alt=""/>
  <div id="cotizar"><?php echo anchor('articulos/cotizacion', ' ', 'style="margin:500px 0 0 -50px;"')?></div>
</div>
<?php echo anchor(base_url(), ' ', 'class="bot_return"')?>
<div id="contenido_info" ><div class="flotar_izquierda"><img src="<?php echo base_url()?>img/img_titu_info.gif" width="16" height="42"></div>
  <h1>Cont&aacute;ctenos</h1>
  <?php echo  form_open(current_url())?>
  <div class="etiqueta"><?php echo form_label('Nombre: ', $nom['id']).form_input($nom).form_error($nom['id'])?></div>
  
  <div class="etiqueta"><?php echo form_label('Empresa: ', $empresa['id']).form_input($empresa).form_error($empresa['id'])?></div>
  
  <div class="etiqueta"><?php echo form_label('Teléfono: ', $tel['id']).form_input($tel).form_error($tel['id'])?></div>
  
  <div class="etiqueta"><?php echo form_label('E-mail: ', $email['id']).form_input($email).form_error($email['id'])?></div>
  
  <div class="etiqueta"><?php echo form_label('Comentarios: ', $coment['id']).form_textarea($coment).form_error($coment['id'])?></div>
  
  <div class="etiqueta"><?php echo form_submit('enviar', ' ', 'class="boton"')?></div>
  
  <?php echo form_close(), ''?>

</div>