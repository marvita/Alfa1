<!-- <div class="field view">
	<div class="label"><? echo $label ?></div>
	<div class="value"><span id="<?= $this->Entity->fieldID($field) ?>"><? echo $value ?></span></div>
</div> -->
<div class="field view">
  <b><? echo $label ?>:</b>
  <span id="<?= $this->Entity->fieldID($field) ?>"><? echo $value ?></span>
</div>  