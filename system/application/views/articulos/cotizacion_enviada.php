
      <div id="left">
      </div>
      
      <div id="index-maquetar-06">
        <div class="menu">
          <?php echo anchor(current_url(), '<span>Cotización</span>', 'style="margin-left:115px;" class="menu_activado"')."\n";?>
          <div id="bot_return"><?php echo anchor(base_url(), ' ', 'class="bot_return"')?></div>
        </div>
        <div >
          <p>Estimado Sr(a). <?php echo $this->session->userdata('DX_name')?> <?php echo (isset($msj))?$msj:'';?></p>
        </div>
      </div>
