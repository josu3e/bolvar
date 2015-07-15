<?php
$attributes = array('id' => 'form_articulo');
		if(1)
		{
		echo form_open_multipart('usuario/color/color_by_categoria/',$attributes);
		}
		else
		{
		echo form_open_multipart('usuario/articulo/load_gimmix',$attributes);
		}

?>
<?php echo (isset($articulos))?$articulos:''; ?>



<?php echo form_close();?>