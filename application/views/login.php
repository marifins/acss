<div style="height: 300px;"></div>
<div id="login_form">
    <div>
        <br /><h2>Login</h2><br />
        <hr style="border:1px solid #f5f5f5;" />
        <br />
    </div>
    <div>
        <?php echo form_open("user/submit"); ?>

        <?php echo form_label('Username', 'username'); ?>
        <?php
        $data = array(
            'name' => 'username',
            'id' => 'register_login',
            'maxlength' => '28',
            'size' => '28',
            'class' => 'text ui-widget-content ui-corner-all',
        );
        ?>
        <?php echo form_input($data); ?>

        <?php echo form_label('Password', 'password'); ?>
        <?php
        $data = array(
            'name' => 'password',
            'id' => 'password_login',
            'maxlength' => '28',
            'size' => '28',
            'class' => 'text ui-widget-content ui-corner-all',
        );
        ?>
        <?php echo form_password($data); ?>

        <?php echo form_close(''); ?>
    </div>
</div>