<?php echo doctype('xhtml1-trans') . "\n"; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo meta('Content-type', 'text/html; charset=iso-8859-1', 'equiv') . "\n"; ?>
        <title>Bolivar International</title>
        <?php
        echo link_tag('css/estilos_home.css') . "\n";
        ?>
    </head>
    <body>
        <!--        <div id="content">-->
        <div id="content_mobile">
            <div id="form_mobile">
                <?php
                echo form_open($base_url);
                ?>
                <div class="form_left">
                    <img src="<?php echo base_url(); ?>img/logo.png"/>
                </div>
                <div class="form_right">
                    <label for="username">Ingresa tu email:</label>
                    <input type="text" id="username" name="username" value="<?php echo set_value('username', ''); ?>"/>
                    <?php
                    if (!empty($msje)) {
                        echo '<span class=error>' . $msje . '</span>';
                    }
                    ?>

                    <input type="submit" name="Enviar" value="Enviar"/>
                </div>
                <div style="clear:both;"></div>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
        <!--        </div>-->
    </body>
</html>