
<?php
  $nombre = array('name'=>'nombre','id'=>'nombre','size'=>'30','value'=>set_value('nombre'));
?>
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active"><?php echo anchor('administrador/categorias/listar', 'Detalle de Articulos')?></li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li class="active"><?php echo anchor('administrador/articulo/registrar', 'Registrar Articulo')?></li>
        <li><?php echo anchor('administrador/articulo', 'Listar Articulos')?></li>
      </ul>
      <p class="information">La pesta&ntilde;a de "Articulos" te permite crear, editar o elimnar los articulos.</p>
    </div>
    <div class="content">
      <h1>Registro de Articulos</h1>
      <div class="listing">
      <?php echo form_open_multipart(current_url())?>
      <table class="tbl_lista" cellspacing="0" summary="Lista de categorias" width="98%">
        <tbody>
          <tr><td>
            <div><?php echo form_label('Tipo de Articulo:', 'tipo').form_dropdown('tipo', $tipo, set_value('tipo', 'all'), 'id="tipo"').form_error('tipo');?></div>
          </td></tr>
          <tr><td>
            <div><?php echo form_label('Nombre:', $nombre['id']).form_input($nombre).form_error($nombre['name'])?></div>
          </td></tr>
				</tbody>
        <tfoot>
          <tr class="btns"><td>
            <div><?php echo form_submit('guardar', 'Guardar').anchor('administrador/articulo/listar', 'cancelar');?></div>
          </td></tr>
        </tfoot>
      </table>
      <?php echo form_close();?>
      </div>
    </div>

