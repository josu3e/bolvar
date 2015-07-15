
<div id="left">
    <div class="cuadros">
        <div class="footer">
            <h1 class="fondo01"><span>&nbsp;</span></h1>
            <ul><?php echo (isset($categorias)) ? $categorias : ''; ?></ul>
        </div>
    </div>

    <?php
    $cat = $this->uri->segment(3);
    if ($cat != 'metalicos'):
        ?>
        <div class="cuadros">
            <div class="footer">
                <h1 class="fondo02"><span>&nbsp;</span></h1>
                <ul>
                    <li>
                        <?php echo (isset($colores)) ? $colores : ''; ?>
                    </li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    <div class="cuadros">
        <div class="footer">
            <h1 class="fondo03"><span>&nbsp;</span></h1>
            <?php echo (isset($logos)) ? $logos : ''; ?>
        </div>
    </div>
</div>

<div id="index-maquetar-06">
    <div class="menu">
        <?php
        echo anchor('articulos/lapiceros', '<span>Lapiceros</span>', 'style="margin-left:115px;" class="menu_activado"') . "\n";
        echo anchor('articulos/gimmix', '<span>Gimmix</span>', 'style="margin-left:245px;"') . "\n";
        echo anchor('articulos/pharmax', '<span>Pharmax</span>', 'style="margin-left:378px;"') . "\n";
        ?><div id="cotizar"><?php echo anchor('articulos/cotizacion', ' ') ?></div>
    </div>
    <?php
    echo (isset($articulos)) ? $articulos : '';
    echo (isset($paginacion)) ? $paginacion : '';
    ?>
</div>
