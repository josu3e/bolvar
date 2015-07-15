
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2> </h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador/categorias/listar', 'Opciones de mi Web')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li class="active"><?php echo anchor('administrador/sitio', 'Información de la web')?></li>
       
      </ul>
      <p class="information">La pestaña de "Opciones de mi Web" te permite editar tu web</p>
    </div>
    <div class="content">
      <h1>Opciones de mi Web</h1>
      <div class="listing">
      
			<?php
      $titulo = array('name'      => 'titulo',
                      'value'     => set_value('titulo', (isset($opc->opc_titulo))?$opc->opc_titulo:''),
                      'maxlength' => '200',
                      'size'      => '100',
                      'style'     => 'width:600px;'
                      );
      $descripcion = array('name' => 'descripcion',
                      'value'     => set_value('descripcion', (isset($opc->opc_descripcion))?$opc->opc_descripcion:''),
                      'rows'      => '5',
                      'cols'      => '80',
                      'style'     => 'width:600px;'
                      );
      $palabras_claves = array('name' => 'palabras_claves',
                      'value'     => set_value('palabras_claves', (isset($opc->opc_palabras_claves))?$opc->opc_palabras_claves:''),
                      'rows'      => '5',
                      'cols'      => '80',
                      'style'     => 'width:600px;'
                      );
                      
			echo form_open_multipart('administrador/sitio/update_sitio');
			?>
      <table class="tbl_lista" cellspacing="0" summary="Lista de archivos" width="98%">
        <tbody>
          <tr><td><label for="titulo">Título Web:</label>
            <?php echo form_input($titulo)?>
            <?php echo form_error($titulo['name'])?>
          </td></tr>
          <tr><td><label for="descripcion">Descripción:</label>
            <?php echo form_textarea($descripcion)?>
            <?php echo form_error($descripcion['name'])?>
          </td></tr>
          <tr><td><label for="palabras_claves">Palabras Claves:</label>
            <?php echo form_textarea($palabras_claves)?>
            <?php echo form_error($palabras_claves['name'])?>
          </td></tr>
        </tbody>
        <tfoot>
          <tr class="btns"><td>
            <input type="submit" value="Guardar"/> o 
            <?php echo anchor('administrador/sitio', 'Cancelar')?>
          </td></tr>
        </tfoot>
      </table>
      <?php echo form_close();?>
      </div>
    </div>
