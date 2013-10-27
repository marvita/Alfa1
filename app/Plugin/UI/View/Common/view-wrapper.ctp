<? if (!isset($mode)) $mode = "view"; ?>

<? if ($this->fetch('form_open')) { $closeForm = true; echo $this->fetch("form_open"); } ?>

<? if ($this->fetch('title')) { ?><div style=""><h3><? echo $this->fetch("title") ?></h3></div><? } ?>

<? $containerClass = $this->fetch('containerClass'); ?>

<?php print $this->request->controller;?>

<div class="form <?= $containerClass ?> <?= Inflector::underscore($this->request->controller) ?> <?= Inflector::underscore($this->request->action) ?> mode-<?= $mode ?>">
	<? if ($this->fetch('contextLinks')) { ?>
		<div class="contextLinks">
			<?= $this->fetch('contextLinks') ?>
		</div>
	<? } ?>
	
	<div class="fields">
		<?= $this->fetch("fields") ?>
	</div>

	<div class="associations">
		<?= $this->fetch("content") ?>
	</div>

	<? if ($this->fetch('editLinks')) { ?>
		<div class="editLinks">
			<?= $this->fetch('editLinks') ?>
		</div>
	<? } ?>
</div>

<? if (isset($closeForm) && $closeForm) {
	//echo $this->fetch("form_submit");
	echo $this->Form->end();
} 

?>