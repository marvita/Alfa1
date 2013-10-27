<?= $this->Js->popup(
	$this->Html->image("UI.action-add.png"),
	array(
		"controller" => $controller,
		"modelScope" => $this->Entity->getModelScope(),
		"basePath" => $associatedBasePath, 
		"action" => "form", 
		/*"template" => "belongs_to",*/
		/*"mode" => $mode,*/
		"plugin" => ($plugin ? $plugin : false), 
		isset($id) ? $id : null),
	array(
		"before" => "options['url'] = options['url'].replace(/\\/basePath:([a-zA-Z0-9\.]+)\\//g, '/basePath:$1/'); ",
		"success" => "$('$context').find('.belongs_to .entity').first().html(''); ",
		"width" => "90%",
		"callBack" => "fillView",
		"callBackTargetPath" => ".belongsto .entity",
		"onclose" => "console.log('onclose');",
		'escape' => false
	)
) ?>