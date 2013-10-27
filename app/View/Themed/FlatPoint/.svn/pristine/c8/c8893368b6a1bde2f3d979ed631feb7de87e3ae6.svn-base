
<? $displayType = $this->fetch("displayType"); ?>
<div class="form_row field-mode-hybrid <?= $this->fetch("class") ? $this->fetch("class") : "" ?>">
	<? if ( ($displayType == 'view' || $displayType == "dual") && ($this->fetch('fieldType') != "primary") ) { ?>
		<span class="element-view">
			<? if ($this->fetch("fieldLabel")) { ?><label class="field_name"><strong><?= $this->fetch("fieldLabel") ?></strong></label><? } ?>
			<div class="field view">
				<span class="field_value">
					<?= $this->fetch("fieldValue") ?>
				</span>
			</div>
		</span>
	<? } ?>

	<? if ($displayType == 'hidden' || $displayType == "dual") { ?>
		<span class="element-edit">
			<? if ($this->fetch("fieldLabel")) { ?><label class="field_name"><?= $this->fetch("fieldLabel") ?></label><? } ?>
			<div class="field">
				<?= $this->fetch("content") ?>
			</div>
		</span>
	<? } ?>
</div>
