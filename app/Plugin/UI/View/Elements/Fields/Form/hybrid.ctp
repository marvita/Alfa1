<div class="field-mode-hybrid">
	<? if (@$options["displayType"] == 'view' || @$options["displayType"] == "dual") { ?>
		
	<div class="element-view">
		<?
			if ($field != "id" ) print $this->Entity->viewField($field);
		?>
	</div>
	
	<? } ?>
	
	<? if (@$options["displayType"] == 'hidden' || @$options["displayType"] == "dual") { ?>
	<div class="element-edit">
		<?
			// adapt the field name on the entity path setting
			$path = $this->Entity->currentPathField();
			
			$field = $path . ($path ? "." : "") . $field;
			
			print $this->Form->input($field, $options);
		?>
	</div>
	<? } ?>
</div>
