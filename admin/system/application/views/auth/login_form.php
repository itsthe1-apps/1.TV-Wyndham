<?
$username = array('name' => 'username','id' => 'username','size' => 30,'value' => set_value('username'));
$password = array('name' => 'password','id'	=> 'password','size' => 30,'value' => set_value('password'));
?>

<?php
$page_name = basename(__FILE__, '.php');
if ($page_name == 'login_form') {
    echo '<style type="text/css">';
    echo 'body{background:url("'.base_url().'icons/BGS/background.jpg");}';
    echo '</style>';
}
?>
<? $attributes = array('autocomplete'=>'off');?>
<?php echo form_open($this->uri->uri_string(),$attributes)?>
<div class="row container login-form">
    <div id="login-title" class="row container">
        <img src="<?= base_url() ?>images/ITSthe1.png" border="0"/>
    </div>
    <h1 class="text-center">1.TV Admin Portal</h1>
    <div class="container-fluid">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <?php echo form_input(['name' => 'username', 'id' => 'username', 'class' => 'form-control', 'value' => set_value('username'), 'placeholder' => 'Username']); ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <?php echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'value' => set_value('password'), 'placeholder' => 'Password']); ?>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <div class="row login-footer"> 
        <div class="copy-right"><p><strong>&COPY; 2016 ITSthe1 Solutions LLC <br/><a href="http://www.itsthe1.tv">www.itsthe1.tv</a></strong><br/>
        <span id="error"><?=form_error($username['name'])?></span>
        <span id="error"><?php echo $this->dx_auth->get_auth_error(); ?> </span>
        </p></div>
    </div>
    <? print form_close();?>
</div>