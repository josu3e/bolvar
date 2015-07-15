
    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador/categoria', 'categoria')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
        <li><?php echo anchor('administrador/categoria/registrar', 'Registrar Categoria')?></li>
        <li class="active"><?php echo anchor('administrador/categoria/listar', 'Listar categorias')?></li>
      </ul>
      <p class="information">La pesta&ntilde;a de "nuestras categorias" te permite crear, editar o elimnar las fotos de las categoria.</p>
    </div>
    <div class="content">
      <h1>Listado de categorias</h1>
      <?php 
        $id = array('name'=>'id', 'size'=>'1', 'value'=>set_value('id', isset($filtro['id'])?$filtro['id']:''), 'class'=>'c');
        $categoria = array('name'=>'categoria', 'size'=>'25', 'value'=>set_value('categoria', isset($filtro['categoria'])?$filtro['categoria']:''));
       
        echo $this->session->flashdata('msje');
      ?>
      <div class="listing">
        <table class="tbl_lista" cellspacing="0" summary="Lista de archivos" width="98%">
          <thead>
            <tr>
              <th class="c">ID</th>
              <th>Tipo Articulo</th>
              <th>Nombre Categoria</th>
              <th colspan="3">Total archivos: <?php echo (isset($total))?$total:'';?></th>
            </tr>
          </thead>
          <tbody>
            <?php echo (isset($categorias))?$categorias:'';?>
          </tbody>
        </table><?php
        echo (isset($paginacion))?$paginacion:'';?>
      </div>
    </div>
