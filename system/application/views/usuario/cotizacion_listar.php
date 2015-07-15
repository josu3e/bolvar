


    <div class="xcontent">

      <?php echo (isset($msje))?'<h3 class="mensaje">'.$msje.'</h3>':'';?>
      <div class="listing">
			<?php echo form_open_multipart('usuario/cotizacion/update_det_cot/6') ?>
        <table class="tbl_lista" cellspacing="0" summary="Lista de archivos">
          <thead>
            <tr><?php $order = ($this->uri->segment(5) == 'desc')?'asc':'desc';?>
						<th scope="col"><?php echo anchor('administrador/archivos/listar/id/'.$order, 'Id', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
              <th scope="col"><?php echo anchor('administrador/archivos/listar/categoria/'.$order, 'Articulo', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
							<th scope="col"><?php echo anchor('administrador/archivos/listar/categoria/'.$order, 'Cantidad', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
							<th scope="col"><?php echo anchor('administrador/archivos/listar/categoria/'.$order, 'Accion', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
             
            </tr>
          </thead>
          <tbody>
            <?php echo (isset($cotizacon))?$cotizacon:'';?>
          </tbody>
					       <tfoot>
          <tr class="btns"><td>
            <input type="submit" value="Guardar"/> o 
            <?php 
						echo anchor('usuario/cotizacion/update_det_cot/6', 'Cancelar');
						?>
          </td></tr>
        </tfoot>
        </table>
				<?php echo form_close();?>
      </div>
    </div>
