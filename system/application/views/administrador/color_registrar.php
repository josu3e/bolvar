
<?php
  $nombre = array('name'=>'nombre','id'=>'nombre','size'=>'20','value'=>set_value('nombre'));
  $imagen = array('name'=>'imagen','id'=>'imagen');
?>
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active"><?php echo anchor('administrador/categorias/listar', 'Detalle de Colores')?></li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li class="active"><?php echo anchor('administrador/color/registrar', 'Registrar Color')?></li>
        <li><?php echo anchor('administrador/color', 'Listar Colores')?></li>
      </ul>
      <p class="information">La pesta&ntilde;a de "colores" te permite crear, editar o elimnar los colores.</p>
    </div>
    <div class="content">
      <h1>Registro de colores</h1>
      <div class="listing">
      <?php echo form_open_multipart(current_url())?>
      <table class="tbl_lista" cellspacing="0" summary="Lista de categorias" width="98%">
        <tbody>
          <tr><td>
            <div><?php echo form_label('Nombre:', $nombre['id']).form_input($nombre).form_error($nombre['name'])?></div>
          </td></tr>
          <tr><td>
            <div><?php echo form_label('Imagen:', $imagen['id']).form_upload($imagen).form_error($imagen['name']);?>
            <p><b>Nota: </b>Considerar Tama&ntilde;o fijo (26x26 pixeles)</p>
          </td></tr>
				</tbody>
        <tfoot>
          <tr class="btns"><td>
            <div><?php echo form_submit('guardar', 'Guardar').anchor('administrador/color/listar', 'cancelar');?></div>
          </td></tr>
        </tfoot>
      </table>
      <?php echo form_close();?>
      </div>
    </div>

