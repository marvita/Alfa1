<?php
/*
	This file is part of UserMgmt.

	Author: Chetan Varshney (http://ektasoftwares.com)

	UserMgmt is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	UserMgmt is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
	<div class="login-container opacity">
        <div class="login-header bordered">
            <h4><?= __("Ingresar") ?></h4>
        </div>
        <?php echo $this->Form->create('User', array('action' => 'login')); ?>
            <div class="login-field">
                <label for="username">Username</label>
                <?php echo $this->Form->input("email" ,array('label' => false,'div' => false,"placeholder" => _("Usuario") ))?>
                <i class="icon-user"></i>
            </div>
            <div class="login-field">
                <label for="password">Password</label>
                <?php echo $this->Form->input("password" ,array("type"=>"password",'label' => false,'div' => false,'placeholder'=> __("Contraseña") ))?>
                <i class="icon-lock"></i>
            </div>
            <div class="login-button clearfix">
                <label class="checkbox pull-left">
                	<?php   if(!isset($this->request->data['User']['remember']))
								$this->request->data['User']['remember']=true;
					?>
                    <?php echo $this->Form->input("remember" ,array("type"=>"checkbox",'label' => false, "class" => "uniform"))?><?= __("Recordarme") ?>
                </label>
                <?php echo $this->Form->button(__('Ingresar') . ' <i class="icon-arrow-right"></i>', array("type" => "submit", "class" => "pull-right btn btn-large blue", "escape" => false ));?>
            </div>
            <div class="forgot-password">
            	<?php echo $this->Js->popup(__("Olvidé mi contraseña",true),"/forgotPassword",array("htmlAttributes" => array("role" => "button", "data-toggle" => "modal"))) ?>
            </div>
        <?php echo $this->Form->end(); ?>
    </div>

<script>
document.getElementById("UserEmail").focus();
if (window.location.href != '<?= Router::url("/login", true) ?>') {
    window.location.href = '<?= Router::url("/login", true) ?>';
}

</script>