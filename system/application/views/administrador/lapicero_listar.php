
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador/articulo/listar_articulos', 'Detalle de Articulos')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li><?php echo anchor('administrador/articulo/load_registrar', 'Registrar Articulo')?></li>
        <li class="active"><?php echo anchor('administrador/articulo/listar_articulos', 'Listar Articulos')?></li>
      </ul>
      <p class="information">La pestaña de "nuestros archivos" te permite crear, editar o elimnar las fotos de los archivos.</p>
    </div>
    <div class="content">
      <h1>Listado de Articulos</h1>
      <?php echo (isset($msje))?'<h3 class="mensaje">'.$msje.'</h3>':'';?>
      <div class="listing">
        <table class="tbl_lista" cellspacing="0" summary="Lista de archivos" width="98%">
          <thead>
            <tr><?php $order = ($this->uri->segment(5) == 'desc')?'asc':'desc';?>
						<th scope="col"><?php echo anchor('administrador/archivos/listar/id/'.$order, 'Tipo Articulo', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
             
            </tr>
          </thead>
          <tbody>
            <?php echo (isset($lapiceros))?$lapiceros:'';?>
						
          </tbody>
        </table>

        <?php echo (isset($paginacion))?$paginacion:'';?>
      </div>
    </div>
