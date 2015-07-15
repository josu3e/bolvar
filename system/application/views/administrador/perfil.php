
<div id="menu" class="">
    <?php echo $this->load->view('administrador/menu_admin') ?>
    <h2></h2>
    <ul id="controller_menu">
        <li id="accounts_link" class="tab active">
            <?php echo anchor('administrador/categorias/listar', 'Opciones de mi perfil') ?>
        </li>
    </ul>
</div>
<div id="content_menu">
    <ul class="menu">
        <li class="active"><?php echo anchor('administrador/perfil', 'Informaci&oacute;n de mi perfil') ?></li>
        <li><?php echo anchor('administrador/perfil/load_change_pass', 'Cambiar Password') ?></li>
    </ul>
    <p class="information">La pesta&ntilde;a de "Opciones de mi perfil" te permite editar tu perfil y cambiar tu password</p>
</div>
<div class="content">
    <h1>Mi perfil</h1>
    <div class="listing">

        <?php
        $email = array('name' => 'usu_email',
            'id' => 'usu_email',
            'value' => set_value('usu_email', (isset($perfil[0]->usu_email)) ? $perfil[0]->usu_email : ''),
            'maxlength' => '200',
            'size' => '50'
        );


        $attributes = array('id' => 'form_perfil', 'name' => 'form_perfil');
        if ($perfil) {
            echo form_open_multipart('administrador/perfil/do_update', $attributes);
        } else {
            echo form_open_multipart('administrador/perfil', $attributes);
        }
        ?>
        <table class="tbl_lista" cellspacing="0" summary="Lista de archivos" width="98%">
            <tbody>

                <tr><td>
<?php echo (isset($mensaje)) ? $mensaje : ''; ?>
                    </td></tr>

                <tr><td><label for="titulo">Mi Correo:</label>
                        <?php echo form_input($email) ?>
<?php echo form_error($email['name']) ?>
                    </td></tr>

            </tbody>
            <tfoot>
                <tr class="btns"><td>
                        <input type="submit" value="Guardar"/>
                    </td></tr>
            </tfoot>
        </table>
<?php echo form_close(); ?>
    </div>
</div>
