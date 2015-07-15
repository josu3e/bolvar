
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador/articulo', 'Detalle de Articulos')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li><?php echo anchor('administrador/articulo/registrar', 'Registrar Articulo')?></li>
        <li class="active"><?php echo anchor('administrador/articulo', 'Listar Articulos')?></li>
      </ul>
      <p class="information">La pestaña de "nuestros archivos" te permite crear, editar o elimnar las fotos de los archivos.</p>
    </div>
    <div class="content">
      <h1>Listado de Articulos</h1>
      <?php 
        $id = array('name'=>'id', 'size'=>'1', 'value'=>set_value('id', isset($filtro['id'])?$filtro['id']:''), 'class'=>'c');
        $orden = array('name'=>'orden', 'size'=>'1', 'value'=>set_value('orden', isset($filtro['orden'])?$filtro['orden']:''), 'class'=>'c');
        $codigo = array('name'=>'codigo', 'size'=>'25', 'value'=>set_value('codigo', isset($filtro['codigo'])?$filtro['codigo']:''));
       
        echo $this->session->flashdata('msje');
      ?>
      <div class="listing">
        <?php echo form_open('administrador/articulo/filtrar')?>
        <table class="tbl_lista" cellspacing="0" summary="Lista de archivos" width="98%">
          <thead>
            <tr><?php $order = ($this->uri->segment(5) == 'desc')?'asc':'desc';?>
              <th class="c">ID</th>
              <th class="c">Orden</th>
              <th>Código</th>
              <th>Tipo Articulo</th>
              <th>Categoria</th>
              <th>Color</th>
              <th>Total archivos: <?php echo (isset($total))?$total:'';?></th>
            </tr>
            <tr>
              <td class="c"><?php echo form_input($id)?></td>
              <td class="c"><?php echo form_input($orden)?></td>
              <td><?php echo form_input($codigo)?></td>
              <td><?php echo form_dropdown('tipo', $tipo, (isset($filtro['tipo']))?$filtro['tipo']:'', 'id="tipo"')?></td>
              <td><?php echo form_dropdown('categoria', $categoria, (isset($filtro['categoria']))?$filtro['categoria']:'', 'id="categoria"')?></td>
              <td><?php echo form_dropdown('color', $color, (isset($filtro['color']))?$filtro['color']:'', 'id="color"')?></td>
              <td colspan="3" width="165"><?php echo form_submit('filtrar', 'Filtrar artículos')?></td>
            </tr>
          </thead>
          <tbody>
            <?php echo (isset($articulos))?$articulos:'';?>
          </tbody>
        </table><?php
        echo form_close();
        echo (isset($paginacion))?$paginacion:'';?>
      </div>
    </div>
