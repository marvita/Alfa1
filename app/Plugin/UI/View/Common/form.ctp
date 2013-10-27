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
if (!isset($action)) {
	$action = array("action" => "form");
} else $action = array("action" => $action);
?>
<?
// if there's no model scope, and there is a request parameter, set it here
$form_open = isset($this->request->named["modelScope"]) ? $this->Form->create($this->request->named["modelScope"], $action) : $this->Form->create($model, $action);
$form_submit = $this->Js->submit(__("Enviar"));

$setPath = false;
$options = array("action" => "form");
?>

<? print $this->Entity->form($model, $template, $mode, compact("options", "form_open", "form_submit"), compact("setPath")); ?>
