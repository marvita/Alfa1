<?= $this->Js->link(
	$this->Html->image("UI.action-add.png"),
	array(
		"controller" => $controller,
		"modelScope" => $this->Entity->getModelScope(),
		"basePath" => $associatedBasePath, 
		"action" => "form", 
		"template" => "belongs_to",
		"mode" => $mode,
		"plugin" => ($plugin ? $plugin : false), 
		isset($id) ? $id : null),
	array(
		"before" => "options['url'] = options['url'].replace(/\\/basePath:([a-zA-Z0-9\.]+)\\//g, '/basePath:$1.'+$('$context').find('.belongs_to .entity').first().data('listindex')+'/'); ",
		"success" => "$('$context').find('.belongs_to .entity').first().$addOrder(unwrapForm(data));",
		"update" => false,
		"width" => "90%",
		"callBack" => "fillView",
		"callBackTargetPath" => ".belongsto .entity",
		'escape' => false
	)
) ?>