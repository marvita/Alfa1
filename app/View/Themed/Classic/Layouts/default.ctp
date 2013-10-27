<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		if ( $_SERVER["HTTP_HOST"] == "localhost" ) {
			echo $this->Html->css("cssreset-min.css");
			echo $this->Html->css("cssreset-context-min.css");
		} else {
			echo $this->Html->css("http://yui.yahooapis.com/3.7.3/build/cssreset/cssreset-min.css");
			echo $this->Html->css("http://yui.yahooapis.com/3.7.3/build/cssreset-context/cssreset-context-min.css");
		}
		echo $this->Html->css('ui-lightness/jquery-ui-1.9.1.custom.min');
		echo $this->Html->css("jquery.ui.selectmenu");
		echo $this->Html->css("jquery.jscrollpane");
		echo $this->Html->css("AjaxMultiUpload.fileuploader");
		echo $this->Html->css("Ubuntu/stylesheet");
		echo $this->Html->css('urbanconnect');
		echo $this->Html->css('classic');
		
		echo $this->Html->script("jquery-1.8.2.min");
		echo $this->Html->script("jquery-ui-1.9.1.custom.min");
		echo $this->Html->script("jquery.boxshadow");
		echo $this->Html->script("jquery.ui.selectmenu");
		//echo $this->Html->script("jquery.nicescroll.min");
		echo $this->Html->script("jquery.mousewheel");
		echo $this->Html->script("jquery.jscrollpane.min");
		
		echo $this->Html->script("jquery.timers");
		echo $this->Html->script("AjaxMultiUpload.fileuploader");
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('blockcss');
		echo $this->fetch('script');
		echo $this->fetch('blockscripts');
	?>
</head>
<body>
	
	<div id="container">
		<div id="toolbar" class="autohide left">
			<ul class="menu">
				<li><?= $this->Js->popup(
					$this->Html->image(__("add-deal.png")),
					array(
						"controller" => "deals",
						"action" => "form",
						"plugin" => false
					),
					array("width" => "80%", 'escape' => false )
				) ?></li>
				<li><?= $this->Js->popup(
					$this->Html->image(__("add-realestate.png")),
					array(
						"controller" => "real_estates",
						"action" => "form",
						"plugin" => false
					),
					array("width" => "80%", 'escape' => false )
				) ?></li>
				<li><?= $this->Js->popup(
					$this->Html->image(__("add-contact.png")),
					array(
						"controller" => "contacts",
						"action" => "form",
						"plugin" => false
					),
					array("width" => "80%", 'escape' => false )
				) ?></li>
				
			</ul>
		</div>
		<div id="header">
			<div id="logo">UrbanConnect</div>
			<div id="notifiers">
				<?= $this->Notifier->show("default", "tasks") ?>
				<?= $this->Notifier->show("default", "deals") ?>
				<?= $this->Notifier->show("default", "real_estates") ?>
				<?= $this->Notifier->show("default", "messages") ?>
			</div>
			<div id="search"></div>
			<div id="setup"></div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		
	</div>
	<div class="ajaxloading">
		<div><?= __("Aguarde un momento por favor") ?></div>
		<br>
		<?= $this->Html->image("ajax-loader.gif") ?>
	</div>
	<?php echo $this->Session->flash('flash', array('element' => 'popup')); ?>
	<div class="cf"><?php echo $this->element('sql_dump'); ?></div>
	<?php
	echo $this->Js->writeBuffer(); // Write cached scripts ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
