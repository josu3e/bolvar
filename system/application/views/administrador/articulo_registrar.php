
<?php
$orden = array('name' => 'orden', 'id' => 'orden', 'size' => '5', 'value' => set_value('orden', 0));
$codigo = array('name' => 'codigo', 'id' => 'codigo', 'size' => '20', 'value' => set_value('codigo'));
$imagen = array('name' => 'imagen', 'id' => 'imagen');
$negativo = array('name' => 'negativo', 'id' => 'negativo', 'value' => 1, 'checked' => FALSE);
?>
<div id="menu" class="">
    <?php echo $this->load->view('administrador/menu_admin') ?>
    <h2></h2>
    <ul id="controller_menu">
        <li id="accounts_link" class="tab active"><?php echo anchor('administrador/categorias/listar', 'Detalle de Articulos') ?></li>
    </ul>
</div>
<div id="content_menu">
    <ul class="menu">
        <li class="active"><?php echo anchor('administrador/articulo/registrar', 'Registrar Articulo') ?></li>
        <li><?php echo anchor('administrador/articulo', 'Listar Articulos') ?></li>
    </ul>
    <p class="information">La pesta&ntilde;a de "Articulos" te permite crear, editar o elimnar los articulos.</p>
</div>
<div class="content">
    <h1>Registro de Articulos</h1>
    <div class="listing">
        <?php echo form_open_multipart(current_url()) ?>
        <table class="tbl_lista" cellspacing="0" summary="Lista de categorias" width="98%">
            <tbody>
                <tr><td>
                        <div><?php echo form_label('# de orden:', $orden['id']) . form_input($orden) . form_error($orden['name']) ?></div>
                    </td></tr>
                <tr><td>
                        <div><?php echo form_label('Tipo articulo:', 'tipo') . form_dropdown('tipo', $tipo, set_value('tipo', 'all'), 'id="tipo"') . form_error('tipo'); ?></div>
                    </td></tr>
                <tr><td>
                        <div><?php echo form_label('Categoría:', 'categoria') . form_dropdown('categoria', $categoria, set_value('categoria', 'all'), 'id="categoria"') . form_error('categoria'); ?></div>
                        <div id="colores"><?php echo form_label('Color:', 'color') . form_dropdown('color', $color, set_value('color', 'all'), 'id="color"') ?>
                            <p><b>Nota: </b>Solo ser&aacute; valido para los <b>"Lapiceros"</b></p></div>
                    </td></tr>
                <tr><td>
                        <div><?php echo form_label('Codigo:', $codigo['id']) . form_input($codigo) . form_error($codigo['name']) ?></div>
                    </td></tr>
                <tr><td>
                        <div><?php echo form_label('Imagen:', $imagen['id']) . form_upload($imagen) . form_error($imagen['name']); ?>
                            <p><b>Lapiceros: </b>Considerar Tama&ntilde;o fijo (613x149 pixeles)</p>
                            <p><b>Gimmix y Pharma: </b>Tama&ntilde;o m&aacute;ximo (268x195 pixeles)</p></div>
                    </td></tr>
                <tr><td>
                        <div><?php echo form_label('Negativo:', $negativo['id']) . form_checkbox($negativo) . form_error($negativo['name']) ?>
                            <label for="negativo" style="float: none;">Seleccionar si desea que lleve un logo negativo</label></div>
                    </td></tr>
            </tbody>
            <tfoot>
                <tr class="btns"><td>
                        <div><?php echo form_submit('guardar', 'Guardar') . anchor('administrador/articulo/listar', 'cancelar'); ?></div>
                    </td></tr>
            </tfoot>
        </table>
        <?php echo form_close(); ?>
    </div>
</div>

