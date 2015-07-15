
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
        <li><?php echo anchor('administrador/perfil', 'Informaci&oacute;n de mi perfil') ?></li>
        <li class="active"><?php echo anchor('administrador/perfil/update_password', 'Change Password') ?></li>
    </ul>
    <p class="information">La pesta&ntilde;a de "Opciones de mi perfil" te permite editar tu perfil</p>
</div>
<div class="content">
    <h1>Cambiar password de administrador</h1>
    <div class="listing">

        <?php
        $old_password = array('name' => 'old_password',
            'maxlength' => '200',
            'size' => '50',
            'type' => 'password'
        );

        $new_password = array('name' => 'new_password',
            'maxlength' => '200',
            'size' => '50',
            'type' => 'password'
        );

        $confirm_new_password = array('name' => 'confirm_new_password',
            'maxlength' => '200',
            'size' => '50',
            'type' => 'password'
        );


        $attributes = array('id' => 'form_admin', 'name' => 'form_admin');

        echo form_open_multipart('administrador/perfil/change_password', $attributes);
        ?>
        <table class="tbl_lista" cellspacing="0" summary="Lista de archivos" width="98%">
            <tbody>

                <tr><td>
<?php echo (isset($mensaje)) ? $mensaje : ''; ?>
                    </td></tr>

                <tr><td><label for="titulo">Password Anterior:</label>
<?php echo form_input($old_password) ?>
                        <?php echo form_error($old_password['name']) ?>
                    </td></tr>

                <tr><td><label for="titulo">Password Nuevo:</label>
<?php echo form_input($new_password) ?>
                        <?php echo form_error($new_password['name']) ?>
                    </td></tr>

                <tr><td><label for="titulo">Confirme Password:</label>
<?php echo form_input($confirm_new_password) ?>
                        <?php echo form_error($confirm_new_password['name']) ?>
                    </td></tr>


            </tbody>
            <tfoot>
                <tr class="btns"><td>
                        <input type="submit" value="Guardar"/> o 
<?php echo anchor('administrador/perfil', 'Cancelar') ?>
                    </td></tr>
            </tfoot>
        </table>
<?php echo form_close(); ?>
    </div>
</div>
