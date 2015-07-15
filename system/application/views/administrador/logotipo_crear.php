
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador/categorias/listar', 'Detalle de Logotipos')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <p class="information">La pesta&ntilde;a de "Logotipos" te permite crear, editar o elimnar los logotipos.</p>
    </div>
    <div class="content">
      <h1>Crear/Editar Logotipo</h1>
      <div class="listing">
      
			<?php
      $imagen = array('name'      => 'imagen',
                      'value'     => set_value('imagen', (isset($logousu[0]->lo_nombre))?$logousu[0]->lo_nombre:''),
                      'rows'      => '5',
                      'cols'      => '50'
                      );      
			$imagen2 = array('name'      => 'imagen2',
                      'value'     => set_value('imagen2', (isset($logousu[0]->lo_nombre2))?$logousu[0]->lo_nombre2:''),
                      'rows'      => '5',
                      'cols'      => '50'
                      );
       
			if(!isset($logousu))
			{
			echo form_open_multipart('administrador/logotipo/do_registrar/'.$user);
			}
			else
			{
			echo form_open_multipart('administrador/logotipo/do_update/'.$logousu[0]->lo_id);
			}
			
			?>
			<?php //echo (isset($message))?$message:''?>
			<?php //echo print_r($logousu);?>
      <table class="tbl_lista" cellspacing="0" summary="Lista de categorias" width="98%">
        <tbody>
          <tr><td>
            <div>
            <?php				
            if(isset($logousu))
            {
              $img = array('src'=>'img/logotipos/'.$logousu[0]->lo_nombre, 'width'=>'250', 'height'=>'80', 'alt'=>'');
            echo '<div class="archivo">
                    '.img($img).'
                    <p>Seleccionar otra imagen solo si deseea cambiar la imagen actual.</p>
                  </div>';
            }
            ?>
            <label for="imagen">Imagen1:</label>
            <?php echo form_upload($imagen)?>
            <?php echo form_error($imagen['name'])?>
            </div>
            <div>
              <p style="margin-left:130px;">Tama&ntilde;o m&aacute;ximo (143x52 pixeles)<br/>El logotipo debe estar en formato de imagen .PNG con transparencia</p>
            </div>
          </td></tr>          
					
					<tr><td>
            <div>
            <?php				
            if(isset($logousu))
            {
              $img = array('src'=>'img/logotipos/'.$logousu[0]->lo_nombre2, 'width'=>'250', 'height'=>'80', 'alt'=>'');
            echo '<div class="archivo">
                    '.img($img).'
                    <p>Seleccionar otra imagen solo si deseea cambiar la imagen actual.</p>
                  </div>';
            }
            ?>
            <label for="imagen">Imagen2:</label>
            <?php echo form_upload($imagen2)?>
            <?php echo form_error($imagen2['name'])?>
            </div>
            <div>
              <p style="margin-left:130px;">Tama&ntilde;o m&aacute;ximo (143x52 pixeles)<br/>El logotipo debe estar en formato de imagen .PNG con transparencia</p>
            </div>
          </td></tr>
					
        </tbody>
        <tfoot>
          <tr class="btns"><td>
            <input type="submit" value="Guardar"/> o 
            <?php 
						if(isset($logousu))
					{
					echo anchor('administrador/logotipo/listar_logotipos', 'Cancelar');
						
						}
						else
						{
						echo anchor('administrador/logotipo/load_registrar', 'Cancelar');
						}
						?>
          </td></tr>
        </tfoot>
      </table>
      <?php echo form_close();?>
      </div>
    </div>

		