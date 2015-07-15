<?php
$attributes = array('id' => 'form_articulo');
echo form_open_multipart('usuario/color/color_by_categoria',$attributes);
?>
<?php echo (isset($colors))?$colors:''; ?>

<?php echo form_close();?>