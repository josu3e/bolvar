
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador/categorias/listar', 'Detalle de Logotipos')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li class="active"><?php echo anchor('administrador/logotipo/load_registrar', 'Registrar Logotipos')?></li>
        <li><?php echo anchor('administrador/logotipo/listar_logotipos', 'Listar Logotipos')?></li>
      </ul>
      <p class="information">La pestaña de "nuestros categorias" te permite crear, editar o elimnar las fotos de los categorias.</p>
    </div>
    <div class="content">
      <h1>Listado de Usuarios</h1>
      <?php echo (isset($msje))?'<h3 class="mensaje">'.$msje.'</h3>':'';?>
      <div class="listing">
        <table class="tbl_lista" cellspacing="0" summary="Lista de categorias" width="98%">
          <thead>
            <tr><?php $order = ($this->uri->segment(5) == 'desc')?'asc':'desc';?>
              <th scope="col"><?php echo anchor('administrador/categorias/listar/id/'.$order, 'Id', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
              <th scope="col"><?php echo anchor('administrador/categorias/listar/titulo/'.$order, 'Usuario', 'class="'.$order.'" title="Ordenar de forma '.$order.'endente"')?></th>
              <th scope="col" colspan="3">Categorias registradas: <?php echo (isset($total))?$total:'';?></th>
            </tr>
          </thead>
          <tbody>
            <?php echo (isset($usuarios))?$usuarios:'';?>
          </tbody>
        </table>
        <?php echo (isset($paginacion))?$paginacion:'';?>
      </div>
    </div>
		