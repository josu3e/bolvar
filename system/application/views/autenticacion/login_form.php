<?php
$username = array(
    'name' => 'username',
    'id' => 'username',
    'size' => 30,
    'value' => set_value('username')
);

$password = array(
    'name' => 'password',
    'id' => 'password',
    'size' => 30
);

$remember = array(
    'name' => 'remember',
    'id' => 'remember',
    'value' => 1,
    'checked' => set_value('remember'),
    'style' => 'margin:0;padding:0'
);

$confirmation_code = array(
    'name' => 'captcha',
    'id' => 'captcha',
    'maxlength' => 8
);
?>
<?php echo form_open(substr($this->uri->uri_string(), 1)) ?>
<h2 class="form_header"> Porfavor inicia sesi&oacute;n </h2>
<p class="form_info"> Porfavor ingresa tu usuario y clave </p>
<?php echo $this->dx_auth->get_auth_error(); ?>
<div class="form">
    <fieldset><?php echo form_label('Username', $username['id']); ?>
        <?php echo form_input($username) ?>
        <?php echo form_error($username['name']); ?>
    </fieldset>
    <fieldset><?php echo form_label('Password', $password['id']); ?>
        <?php echo form_password($password) ?>
        <?php echo form_error($password['name']); ?>
    </fieldset>
    <?php if ($show_captcha): ?>
        <fieldset>
            <p class="mensaje">Enter the code exactly as it appears. There is no zero.</p>
            <p><?php echo form_label('C&oacute;digo'); ?>
                <?php echo $this->dx_auth->get_captcha_image(); ?></p><br/>
            <p><?php echo form_label('Ingresar', $confirmation_code['id']); ?>
                <?php echo form_input($confirmation_code); ?></p>
                <?php echo form_error($confirmation_code['name']); ?>
        </fieldset>
    <?php endif; ?>
</div>
<div id="operations">
    <p><?php echo form_checkbox($remember); ?> <?php
    echo form_label('Remember me', $remember['id']);
    echo nbs(3);
    echo anchor($this->dx_auth->forgot_password_uri, 'Forgot password');
    ?></p>
    <?php
    if ($this->dx_auth->allow_registration) {
        echo "<p>" . anchor($this->dx_auth->register_uri, 'Register') . "</p>";
    };
    ?>
    <p><?php
        echo form_submit('login', 'Acceder');
        echo nbs(3);
        echo anchor(base_url(), 'Cancelar');
        ?></p>
</div>
<?php echo form_close() ?>
