
<?php
  $nombre = array('name'=>'nombre','id'=>'nombre','size'=>'30','value'=>set_value('nombre', $categoria['cat_nombre']));
?>
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active"><?php echo anchor('administrador/categorias/listar', 'Detalle de categorias')?></li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li class=""><?php echo anchor('administrador/categoria/registrar', 'Registrar categoria')?></li>
        <li><?php echo anchor('administrador/categoria', 'Listar categorias')?></li>
        <li class="active"><?php echo anchor('administrador/categoria/editar/'.$categoria['cat_id'], 'Editar categoria')?></li>
        <li><?php echo anchor('administrador/categoria/eliminar/'.$categoria['cat_id'], 'Eliminar categoria', 'class="confirm" title="Desea elimnar este categoria?"')?></li>
      </ul>
      <p class="information">La pesta&ntilde;a de "categorias" te permite crear, editar o elimnar los categorias.</p>
    </div>
    <div class="content">
      <h1>Registro de categorias</h1>
      <div class="listing">
      <?php echo form_open_multipart(current_url())?>
      <table class="tbl_lista" cellspacing="0" summary="Lista de categorias" width="98%">
        <tbody>
          <tr><td>
            <div><?php echo form_label('Tipo de categoria:', 'tipo').form_dropdown('tipo', $tipo, set_value('tipo', $categoria['cat_padre']), 'id="tipo"').form_error('tipo');?></div>
          </td></tr>
          <tr><td>
            <div><?php echo form_label('Nombre:', $nombre['id']).form_input($nombre).form_error($nombre['name'])?></div>
          </td></tr>
				</tbody>
        <tfoot>
          <tr class="btns"><td>
            <div><?php echo form_submit('guardar', 'Guardar').anchor('administrador/categoria/listar', 'cancelar');?></div>
          </td></tr>
        </tfoot>
      </table>
      <?php echo form_close();?>
      </div>
    </div>

