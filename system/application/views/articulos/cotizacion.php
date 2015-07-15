
      <div id="left">
      </div>
      
      <div id="index-maquetar-06">
        <div class="menu">
          <?php echo anchor(current_url(), '<span>Cotización</span>', 'style="margin-left:115px;" class="menu_activado"')."\n";?>
          <div id="bot_return"><?php echo anchor(base_url(), ' ', 'class="bot_return"')?></div>
        </div>
        <table class="titulo_tabla" cellspacing="12" width="718" align="center" summary="cotizacion">
          <tr>
            <th width="100">C&oacute;digo</th>
            <th width="315">Art&iacute;culo</th>
            <th width="160">Logo</th>
            <th width="160">Cantidad</th>
            <th>Acci&oacute;n</th>
          </tr>
          <?php echo (isset($articulos))?$articulos:'';?>
        </table>
        <?php echo anchor('articulos/enviar_cotizacion', ' ', 'class="div_boton_enviar"')?>
      </div>
