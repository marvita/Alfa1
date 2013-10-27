<div class="form_row <?= $this->fetch("class") ? $this->fetch("class") : "" ?>">
	<? if ($this->fetch("fieldLabel")) { ?><label class="field_name"><?= $this->fetch("fieldLabel") ?></label><? } ?>
	<div class="field">
		<?= $this->fetch("content") ?>
	</div>
</div>