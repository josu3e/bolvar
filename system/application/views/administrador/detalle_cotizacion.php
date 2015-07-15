

    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador/cotizacion', 'Listar Cotizaciones')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
     
        <li class="active"><?php echo anchor('administrador/cotizacion', 'Listar Cotizaciones')?></li>
      </ul>
      <p class="information">La pestaña de "Detalle Cotizaciones" te permite revisar las cotizaciones.</p>
    </div>
    <div class="content">
      <h1>Bienvenido al Panel de Administracion</h1>
      <?php echo (isset($msje))?'<h3 class="mensaje">'.$msje.'</h3>':'';?>
      <div class="listing">
        <table class="tbl_lista" cellspacing="0" summary="Lista de archivos" width="98%">
          <thead>
            <tr><?php $order = ($this->uri->segment(5) == 'desc')?'asc':'desc';?>
              <th scope="col"><?php echo anchor('administrador/archivos/listar/categoria/'.$order, 'Nro. Cotizacion', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
              <th scope="col"><?php echo anchor('administrador/archivos/listar/titulo/'.$order, 'Articulo', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
							 <th scope="col"><?php echo anchor('administrador/archivos/listar/titulo/'.$order, 'Cantidad', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
              
            </tr>
          </thead>
          <tbody>
            <?php echo (isset($detalle))?$detalle:'';?>
          </tbody>
        </table>
        <?php echo (isset($paginacion))?$paginacion:'';?>
      </div>
    </div>
