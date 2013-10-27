<?= $this->Js->link(
	$this->Html->image("UI.action-add.png"),
	array(
		"controller" => $controller,
		"modelScope" => $this->Entity->getModelScope(),
		"basePath" => $associatedBasePath, 
		"action" => "form", 
		"template" => "has_and_belongs_to_many",
		"mode" => $mode,
		"plugin" => ($plugin ? $plugin : false), 
		isset($id) ? $id : null),
	array(
		"before" => "options['url'] = options['url'].replace(/\\/basePath:([a-zA-Z0-9\.]+)\\//g, '/basePath:$1.'+$('$context').find('.has_and_belongs_to_many .entity').first().data('listindex')+'/'); ",
		"success" => "$('$context').find('.has_and_belongs_to_many .entity').first().$addOrder(unwrapForm(data)); incIdx('$context', '.has_and_belongs_to_many .entity'); ",
		"update" => false,
		"width" => "90%",
		"callBack" => "fillView",
		"callBackTargetPath" => ".hadandbelongstomany .entity",
		'escape' => false
	)
) ?>