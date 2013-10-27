<?
	echo $this->Html->link(
		$this->Html->image("UI.action-cancel.png"),
		"javascript:void(0)",
		array(
			"onclick" => "$(this).closest('.form').find('.fields > .ajaxDelete').val('1'); $(this).closest('.form').addClass('deleted');",
			"escape" => false,
			'class' => 'delete'
		)
	);
	echo $this->Html->link(
		"Objeto eliminado&nbsp;&nbsp;" . $this->Html->image("UI.action-undo.png")."Deshacer",
		"javascript:void(0)",
		array(
			/*"onclick" => "undoChanges($(this).closest('.entity'));",*/
			"onclick" => "$(this).closest('.form').find('.fields > .ajaxDelete').val('0'); $(this).closest('.form').removeClass('deleted');",
			"escape" => false,
			'class' => 'undo'
		)
	);
	echo $this->Html->link(
		$this->Html->image("UI.	action-edit.png"),
		"javascript:void(0)",
		array(
			"onclick" => "$(this).closest('.form').addClass('editing');",
			"escape" => false,
			'class' => 'edit'
		)
	);