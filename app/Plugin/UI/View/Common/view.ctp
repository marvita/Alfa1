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
    $action = array("action" => "view");
} else $action = array("action" => $action);
?>
<?
// if there's no model scope, and there is a request parameter, set it here
$form_open = isset($this->request->named["modelScope"]) ? $this->Form->view($this->request->named["modelScope"], $action) : $this->Form->view($model, $action);
$form_submit = $this->Js->submit(__("Enviar"));

$setPath = false;
$options = array("action" => "view");
?>

<? print $this->Entity->view($model, $template, $mode, compact("options"), compact("setPath")); ?>