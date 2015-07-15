

<?php
$attributes = array('id' => 'form_articulo',
'name' => 'form_articulo'
);

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

		<div class="boton">
		<?php if($ta == 1 || $ta == 2)
{
echo '<a href="'.base_url().'index.php/usuario/cotizacion/load_cotizacion"><span>boton_cotizacion</span></a>';
}
?>
    
        </div>
				
			<div class="bienvenido">
		    <h1>Bienvenido: <span><?php echo $this->session->userdata('usu_id');?></span></h1><br/>
					<?php if($ta == 1 || $ta == 2)
								{	
									echo '<img id="personaliza" src="'.base_url().'img/titu_personaliza.jpg" width="212" height="31">';
									}
									?>
		
			
			</div>
            <div class="menu">
            	<a href="<?php echo base_url();?>" style="margin-left:16px;"><span>lapiceros</span></a>
                 <a href="<?php echo base_url()?>index.php/usuario/articulo/load_gimmix" style="margin-left:124px;"><span>gimmix</span></a>
              <div class="otro_menu"><a href="<?php echo base_url()?>index.php/usuario/nosotros"><span>nosotros</span></a>
              <a href="<?php echo base_url()?>index.php/usuario/contacto" style="margin-left:113px;"><span>contáctenos</span></a></div>
            </div>
            
      </div>
<div id="left">


<?php if($ta == 1 || $ta == 2)
{
echo '<div class="cuadros"><h1 class="fondo01"><span>&iquest;Categor&iacute;a?</span></h1><ul>';
?>
<?php echo (isset($category))?$category:''; ?>        	
<?php 
echo '</ul></div>';
}
?>            	
              
<?php 
if($ta == 1)
{
echo '<div id="cuadro_color"><div class="cuadros"><h1 class="fondo02"><span>&iquest;Color?</span></h1><ul>';?>		
<?php echo (isset($colores))?$colores:'';?>				
<?php 
echo '<div id="colorcontent"></div></ul></div></div>';
}
?>


<?php
if($ta == 1)
{
echo '<div id="cuadro_logo"><div class="cuadros"><h1 class="fondo03"><span>&iquest;Logotipo?</span></h1>';
?>
<?php echo (isset($logosbyusu))?$logosbyusu:'';?>          
<?php //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/usuario/logo/unset_logo">Quitar Logo</a>
echo '</div></div>';

}
?>
            	
      </div>
			
<div id="index-maquetar-06">
								<?php if($ta == 1 || $ta == 2)
								{	
								echo '<div class="agregar_gimmix"><img src="'.base_url().'img/titu_agregar_b.gif"/></div>';
								}
								if($ta == 4)
								{
								echo '
	<h1><span>Sobre Nosotros</span></h1>
    <div class="imagen_texto"><img src="'.base_url().'img/img_nosotros.gif" width="305" height="304"></div>
	<p>Somos una Empresa especializada en Lapiceros Publicitarios.</p>
    <p>Contamos con una gran variedad de modelos, estilos y colores de lapiceros pl&aacute;sticos, met&aacute;licos y estuches. Nuestros productos pueden ser estampados o grabados.</p>
    <p>Nuestra meta es poder satisfacer las necesidades de todos nuestros clientes nacionales y extranjeros  mediante un excelente producto.  Somos importadores directos, por lo tanto estamos en la capacidad de brindar el mejor precio y calidad adem&aacute;s de la  puntualidad que nos caracteriza. </p>
    <p>As&iacute; mismo, brindamos servicios de exportaci&oacute;n de dicho art&iacute;culo a empresas Transnacionales en el Per&uacute; hacia sus respectivas sucursales en  provincias y/u otros pa&iacute;ses cuando lo requieran, manteniendo siempre nuestros est&aacute;ndares de calidad y precio.</p>
    <p>Esperando prontamente poder atenderlos, estamos a su entera disposici&oacute;n, agradeci&eacute;ndole de antemano por la atenci&oacute;n prestada.<br>
    </p>';
								}
								if($ta == 5)
								{
								echo '<h1><span>Cont&aacute;ctenos</span></h1>
    <div class="imagen_texto"><img src="'.base_url().'img/img_contactenos.gif" width="304" height="304"></div>
<table>
<tr>
    
    	<td><div class="etiqueta">Nombre:</div>
      	<input type="text" name="nombre" id="nombre"><td>
  
</tr>
<tr>		
    <td>
    	<div class="etiqueta">Empresa:</div>
      	<input type="text" name="empresa" id="empresa">
    </td>
</tr>
<tr>		
    <td>
    	<div class="etiqueta">Tel&eacute;fono:</div>
      	<input type="text" name="fono" id="fono">
    </td>
</tr>
<tr>		
    <td>
    	<div class="etiqueta">E-mail:</div>
      	<input type="text" name="email" id="email">
    </td>
</tr>
<tr>		
     <td>
    	<div class="etiqueta">Comentario:</div>
      	<input name="comentario" type="text" class="comentario" id="comentario">
    </td>
</tr> 
<tr>
      	<td>
      	<input type="submit" name="enviar" id="enviar" value="Enviar" class="boton">
      	</td>
</tr>
<tr>
      	<td>
      	<p>'.((isset($resemail))?$resemail:'').'</p>
      	</td>
</tr>   
	</table>';
								}
								
								?>
<?php echo (isset($articulos))?$articulos:''; ?>
</div>

<div id="bottom">
            <img src="<?php echo base_url();?>img/bottom.jpg" width="1028" height="61" alt=""/>	</div>
</div>
<!-- </div>   -->
<div class="bot_cerrar"><a href="<?php echo base_url().'index.php/autenticacion/logout'?>">cerrar sesi&oacute;n</a><img src="<?php echo base_url();?>img/x.gif"></div>
</div>

<?php echo form_close();?>