<?
$this->extend("/index-wrapper");

$entity = $this->Entity->getModel($model);
$fields = $this->Entity->entityFields($model);
$config = $this->Entity->entityConfig($model, 'Associations');
$fieldConfig = $this->Entity->entityConfig($model, 'Fields');
$indexConfig = $this->Entity->entityConfig($model, 'Index');
// Assign title
if (!isset($title)) {
	if (isset($indexConfig["Title"])) {
		$title = $indexConfig["Title"];
	} else {
		$title = Inflector::camelize($this->request->controller);
		$model = Inflector::singularize($title);
		$title = Inflector::humanize($title);
	}
} else {
	$model = Inflector::singularize(Inflector::camelize($this->request->controller));
}
$this->assign("title", $title);

//Assign table classes
if (!isset($tableClasses)) $tableClasses = "";
$this->assign("tableClasses", $tableClasses);

// Assign actions and set paginator options
if ( (!$this->request->requested || !$this->request->bare) ) {
		
	$this->start("actions");
	echo $this->Js->popup(__("Agregar"), array("controller" => $controller, "action" => "form"), array("width" => "900" ));
	$this->end();
	
	$action = substr($this->request->params["action"], 6);
	if (!isset($searchFields) || !is_array($searchFields)) $searchFields = array();
	$this->Paginator->options(array("model" => $model, "url" => array("controller" => $controller, "action" => $action) + ( isset($context) ? array("context" => $context) : array() ), "update" => isset($context) ? substr($context, strrpos($context, ";")+1) : "#content" , "evalScripts" => true));

		
} ?>

<?
	if (!isset($columns)) {
		$columns = array();
		$ordered = array();
		$added = array();
		
		// get the fields with their priority
		// first we get the configured fields. Explicit takes priority 0 by default
		if (is_array($fieldConfig)) {
			foreach ($fieldConfig as $key => $options) {
				$type = $this->Entity->fieldType($key);
				if (!$this->Entity->hiddenField($key, $type, "index", $fieldConfig) ) {
					$priority = isset($options["priority"]) ? $options["priority"] : 0;
					$ordered[$priority][] = $key;
					$added[] = $key;
				}
			}
		}
		
		// extra defined fields for index listings, they should be listed after the rest (usually association fields)
		if (isset($indexConfig["ExtraFields"]) && is_array($indexConfig["ExtraFields"])) {
			foreach ($indexConfig["ExtraFields"] as $key => $options) {
				$priority = 2;
				
				$class = $id = $label = null;
				if (is_array($options)) {
					$priority = isset($options["priority"]) ? $options["priority"] : 2;
					if (isset($options["label"])) $label = $options["label"];
					if (isset($options["class"])) $class = $options["class"];
					if (isset($options["id"])) $id = $options["id"];
				} else {
					$label = $options;
				}
				
				$ordered[$priority][] = array($key, $class, $id, $label);
				$added[] = $key;
			}
		}

		// the rest of the fields defined in the database, not hidden, and not already explicity listed go between by default
		foreach($fields as $key => $type) {
			if ( !$this->Entity->hiddenField($key, $type, "index", $fieldConfig) ) {
				if (!in_array($key, $added)) {
					$ordered[1][] = $key;
				}
			}
		}

		ksort($ordered);
		
		foreach ($ordered as $priority => $list) {
			foreach($list as $key) {
				$columns[] = $key;
			}
		}
		
	}
	
	$columns[] = array(__("Acciones"), "actions");

	print $this->Html->objectTableHeaders($columns);

	$i = 0;
	$table = array();
	foreach ($items as $item): 
		$viewLink = $editLink = $deleteLink = "";
		if (!isset($indexConfig["Actions"]) || (is_array($indexConfig["Actions"]) && (in_array("view", $indexConfig["Actions"]))) )
			$viewLink = $this->Js->popup(__('Ver'), array('action' => 'view', $item[$model]["id"]), array("width" => "970"));
		if (!isset($indexConfig["Actions"]) || (is_array($indexConfig["Actions"]) && (in_array("form", $indexConfig["Actions"]))) )
			$editLink = $this->Js->popup(__('Editar'), array('action' => 'form', $item[$model]["id"]), array("width" => "970"));
		if (!isset($indexConfig["Actions"]) || (is_array($indexConfig["Actions"]) && (in_array("delete", $indexConfig["Actions"]))) )
			$deleteLink = $this->Js->link(__('Eliminar'), array('action' => 'delete', $item[$model]["id"]), array("confirm" => __('Esta información se elminará, ¿Está seguro?'), "method" => "post") );

		array_pop($columns);

		$columns[] = $viewLink . " " . $editLink . " " . $deleteLink;
		$table[] = $this->Html->objectTableRow($columns, $item);
	endforeach;

	print $this->Html->tableCells($table, array("class" => "odd"), array("class" => "even"), true);

?>


<? $this->start("paginator"); ?>
<? if (!$this->request->requested || !$this->request->bare) {
	echo $this->element("Common/paginator");
} ?>
<? $this->end(); ?>