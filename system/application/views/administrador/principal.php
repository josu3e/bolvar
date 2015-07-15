

    <div id="menu" class="">
      <?php echo $this->load->view('administrador/menu_admin')?>
      <h2></h2>
      <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
          <?php echo anchor('administrador', 'Inicio')?>
        </li>
      </ul>
    </div>
    <div id="content_menu">
      <ul class="menu">
     
        <li class="active"><?php echo anchor('administrador', 'Inicio')?></li>
      </ul>
      <p class="information">Bienvenido al sistema de administracion.</p>
    </div>
    <div class="content">
      <h1>Bienvenido al Panel de Administracion</h1>
      <?php echo (isset($msje))?'<h3 class="mensaje">'.$msje.'</h3>':'';?>
      <div class="listing">

      </div>
    </div>
