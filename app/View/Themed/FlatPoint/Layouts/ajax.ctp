<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *	
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<script type="text/javascript">
<? if (CakeSession::read("validationError")) {
		?>var validationError = true;<?
	} else {
		?>var validationError = false;<?
	}
	CakeSession::delete("validationError");
	?>
</script>
<?php echo $this->fetch('content'); ?>
<? if (CakeSession::read("validationError")) {
	$model = Entity::getModel(Inflector::singularize(Inflector::Camelize($this->request->controller)));
	//pr($model->validationErrors);
}?>
<? if ( $this->Js->currentContext() == $this->Js->rootContext() ) { ?>
<span class="ajax-breadcrumb">
	<ul class="breadcrumb">
		<li><?= $this->Js->link("<i class='icon-home'></i>", "/dashboard", array("escape" => false)) ?> <span class="divider">/</span></li>
		<?
			if ($this->request->controller != "pages") {
				// add controller as breadcrumb
				// get the index title if there is one
				$model = Inflector::singularize(Inflector::Camelize($this->request->controller));
				$config = Entity::entityConfig($model, "Index");
				$indexTitle = isset($config["Title"]) ? $config["Title"] : Inflector::humanize($this->request->controller);
				?>
					<li><?= $this->Js->link($indexTitle, array("controller" => $this->request->controller)) ?>
						<? if ($this->request->action != "index") { ?><span class="divider">/</span><? } ?>
					</li>
				<?
				
				if ($this->request->action != "index") {
					if (!isset($title)) {
						$action = $this->request->action;
          
						if ($action == "form") {
							if ( !isset($this->request->data[$model]["id"]) && !isset($id)) {
								$title = sprintf(__("Agregar %s"), Inflector::humanize(Inflector::underscore($model)));
							} else {
								$title = sprintf(__("Editar %s"), Inflector::humanize(Inflector::underscore($model)));
							}
						} else {
							$title = Inflector::humanize($this->request->action);
						}
					}
					?><li class="active"><?= $this->Html->link($title, "#") ?></li><?
				}
			} else {
				if (isset($this->request->params[0])) {
					$title = Inflector::humanize($this->request->params[0]);
					?><li class="active"><?= $this->Html->link($title, "#") ?></li><?
				} elseif (isset($this->request->params["pass"][0])) {
					$title = Inflector::humanize($this->request->params["pass"][0]);
					?><li class="active"><?= $this->Html->link($title, "#") ?></li><?
				}
			}
			
		?>
	</ul>
</span>
<? } ?>

<?php
	echo $this->Js->writeBuffer();
?><?php echo $this->Session->flash('flash', array('element' => 'UI.popup')); ?><script type="text/javascript">
	$(document).ready(function() {
		<? if ( $this->Js->currentContext() == $this->Js->rootContext() ) { ?>
			$('.top_bar .breadcrumb').replaceWith($('.ajax-breadcrumb ul'));
		<? } ?>
	});
</script>
<?php //echo $this->element('sql_dump'); ?>
