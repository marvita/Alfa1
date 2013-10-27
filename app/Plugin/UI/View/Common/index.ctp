<?
$model = Inflector::singularize(Inflector::camelize($this->request->controller));
		
if (!isset($template)) {
	// check for modelScope and entityPath to know the default template to use based on the model config
	$template = "";
}
if (!isset($mode)) {
	// check for modelScope and entityPath to know the default mode to use based on the model config
	$mode = "";
}
?>

<? print $this->Entity->index($model, $template, $mode, array("options" => array("action" => "index")), array("setPath" => false)); ?>
