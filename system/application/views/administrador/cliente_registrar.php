
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador/categorias/listar', 'Detalle de Clientes')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li><?php echo anchor('administrador/cliente', 'Listar Clientes')?></li>
				<li <?php echo (isset($cat))?'':'class="active"'?>><?php echo anchor('administrador/cliente/load_registrar', 'Registrar Cliente')?></li>
        <?php //echo (isset($cat))?$opciones:''?>
      </ul>
      <p class="information">La pestaña de "Clientes" te permite crear, editar o elimnar clientes.</p>
    </div>
    <div class="content">
      <h1>Registro de Clientes</h1>
      <div class="listing">
      
			<?php
			
      $cli_email = array('name'      => 'cli_email',
                      'value'     => set_value('cli_email', (isset($cliente[0]->usu_email))?$cliente[0]->usu_email:''),
                      'maxlength' => '100',
                      'size'      => '30'
                      );
			$cli_nombre = array('name'      => 'cli_nombre',
                      'value'     => set_value('cli_nombre', (isset($cliente[0]->usu_nombre))?$cliente[0]->usu_nombre:''),
                      'maxlength' => '100',
                      'size'      => '30'
                      );
      $cli_fono = array('name'      => 'cli_fono',
                      'value'     => set_value('cli_fono', (isset($cliente[0]->usu_fono))?$cliente[0]->usu_fono:''),
                      'maxlength' => '100',
                      'size'      => '30'
                      );
											
			$cli_empresa = array('name'      => 'cli_empresa',
                      'value'     => set_value('cli_empresa', (isset($cliente[0]->usu_empresa))?$cliente[0]->usu_empresa:''),
                      'maxlength' => '100',
                      'size'      => '30'
                      );
											
			$fecnac = array(
	'name'	=> 'fec_nac',
	'id'	=> 'fec_nac',
	'ReadOnly' => 'true',
	'value'     => set_value('fec_nac', (isset($cliente[0]->usu_fec_nac))?'hello':'dsfsdfdfs'),
	'type' => 'text'

);

			$fec_naci = array(
	'name'	=> 'fec_naci',
	'id'	=> 'fec_naci',
	'value'     => set_value('fec_naci', (isset($cliente[0]->usu_fec_nac))?$cliente[0]->usu_fec_nac:''),
	'type' => 'hidden'
);									

			$attributes = array('id' => 'form_cliente','name' => 'form_cliente');
			
			if(!isset($cliente))
			{
			echo form_open_multipart('administrador/cliente/register',$attributes);
			}
			else
			{
			echo form_open_multipart('administrador/cliente/do_update/'.$cliente[0]->usu_id,$attributes);
			}
			
			?>
<?php //print_r($cliente);?>
      <table class="tbl_lista" cellspacing="0" summary="Lista de categorias" width="98%">
        <tbody>

				   <tr><td><label for="titulo">Email:</label>
            <?php echo form_input($cli_email)?>
            <?php echo form_error($cli_email['name'])?>
          </td></tr>
					         <tr><td><label for="titulo">Nombre:</label>
            <?php echo form_input($cli_nombre)?>
            <?php echo form_error($cli_nombre['name'])?>
          </td></tr>
					
          <tr><td><label for="titulo">Telefono:</label>
            <?php echo form_input($cli_fono)?>
            <?php echo form_error($cli_fono['name'])?>
          </td></tr>
					
					 <tr><td><label for="titulo">Empresa:</label>
            <?php echo form_input($cli_empresa)?>
            <?php echo form_error($cli_empresa['name'])?>
          </td></tr>
					
					<tr><td><?php echo form_label('Fecha de Nacimiento', $fecnac['id']);?>
								<?php echo form_input($fecnac);?>
								<?php echo form_error($fecnac['name']); ?>
          </td></tr>
					
					<tr><td>
								<?php echo form_input($fec_naci);?>
          </td></tr>
					
        </tbody>
        <tfoot>
          <tr class="btns"><td>
            <input type="submit" value="Guardar"/> o 
            <?php 
						echo anchor('administrador/cliente', 'Cancelar');
						?>
          </td></tr>
        </tfoot>
      </table>
      <?php echo form_close();?>
      </div>
    </div>

		