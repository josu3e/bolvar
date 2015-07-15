
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador/color', 'Detalle de Colores')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li><?php echo anchor('administrador/color/registrar', 'Registrar Color')?></li>
        <li class="active"><?php echo anchor('administrador/color', 'Listar Colores')?></li>
      </ul>
      <p class="information">La pesta&ntilde;a de "Colores" te permite crear, editar o elimnar las fotos de los colores.</p>
    </div>
    <div class="content">
      <h1>Listado de Colores</h1>
      <?php echo $this->session->flashdata('msje');?>
      <div class="listing">
        <table class="tbl_lista" cellspacing="0" summary="Lista de archivos" width="98%">
          <thead>
            <tr><?php $order = ($this->uri->segment(5) == 'desc')?'asc':'desc';?>
						<th scope="col"><?php echo anchor('administrador/archivos/listar/id/'.$order, 'Id', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
              <th scope="col"><?php echo anchor('administrador/archivos/listar/categoria/'.$order, 'Nombre', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
							<th scope="col">Imagen</th>
              <th scope="col" colspan="3">Total archivos: <?php echo (isset($total))?$total:'';?></th>
            </tr>
          </thead>
          <tbody>
            <?php echo (isset($colores))?$colores:'';?>
          </tbody>
        </table>
        <?php echo (isset($paginacion))?$paginacion:'';?>
      </div>
    </div>
