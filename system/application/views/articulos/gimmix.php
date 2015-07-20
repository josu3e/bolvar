
<div id="left">
    <div class="cuadros">
        <div class="footer">
            <h1 class="fondo01"><span>&nbsp;</span></h1>
            <ul><?php echo (isset($categorias)) ? $categorias : ''; ?></ul>
        </div>
    </div>
</div>

<div id="index-maquetar-06">
    <div class="menu">
        <?php
        echo anchor('articulos/lapiceros', '<span>Lapiceros</span>', 'style="margin-left:115px;"') . "\n";
        echo anchor('articulos/gimmix', '<span>Gimmix</span>', 'style="margin-left:245px;" class="menu_activado"') . "\n";
        echo anchor('articulos/pharma', '<span>Pharma</span>', 'style="margin-left:378px;"') . "\n";
        ?><div id="cotizar"><?php echo anchor('articulos/cotizacion', ' ') ?></div>
    </div>
    <?php
    // echo '-------->'.$articulos;
    echo (isset($articulos)) ? $articulos : '';
    echo (isset($paginacion)) ? $paginacion : '';
    ?>
</div>
