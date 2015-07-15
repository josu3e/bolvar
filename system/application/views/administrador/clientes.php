

    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador/articulo/listar_articulos', 'Detalle de Clientes')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li class="active"><?php echo anchor('administrador/cliente', 'Listar Clientes')?></li>
				<li><?php echo anchor('administrador/cliente/load_registrar', 'Registrar Clientes')?></li>
      </ul>
      <p class="information">La pesta&ntilde;a de "Detalle de Clientes" te permite eliminar o editar un cliente.</p>
    </div>
    <div class="content">
      <h1>Listado de Clientes</h1>
      <?php echo (isset($msje))?'<h3 class="mensaje">'.$msje.'</h3>':'';?>
      <div class="listing">
        <table class="tbl_lista" cellspacing="0" summary="Lista de archivos" width="98%">
          <thead>
            <tr><?php $order = ($this->uri->segment(5) == 'desc')?'asc':'desc';?>
						  <th scope="col"><?php echo anchor('administrador/archivos/listar/categoria/'.$order, 'Cumpleaños', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
              <th scope="col"><?php echo anchor('administrador/archivos/listar/categoria/'.$order, 'Email', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
              <th scope="col"><?php echo anchor('administrador/archivos/listar/titulo/'.$order, 'Empresa', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
							<th scope="col"><?php echo anchor('administrador/archivos/listar/categoria/'.$order, 'Telefono', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
              <th scope="col" colspan="3">Total archivos: <?php echo (isset($total))?$total:'';?></th>
            </tr>
          </thead>
          <tbody>
            <?php echo (isset($clientes))?$clientes:'';?>
          </tbody>
        </table>
        <?php echo (isset($paginacion))?$paginacion:'';?>
      </div>
    </div>
