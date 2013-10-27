<?

$this->extend("/form-wrapper");

$fields = $this->Entity->entityFields($model);
$entity = $this->Entity->getModel($model);
$config = $this->Entity->entityConfig($model, 'Associations');
$fieldConfig = $this->Entity->entityConfig($model, 'Fields');

$id = $this->Entity->fieldValue("id");

$url = array(
	"controller" => Inflector::underscore(Inflector::pluralize($model)),
	"action" => "form",
	"mode" => $mode,
	"template" => "has_many",
	"modelScope" => $this->Entity->getModelScope(),
	"basePath" => $this->Entity->currentPathField()
);
if ($id) $url[] = $id;

?>

<?
foreach (array("belongsTo", "hasMany", "hasAndBelongsToMany", "hasOne") as $assoc) {
	?>
	<div class="<?= Inflector::underscore($assoc)?>">
		<?
		foreach ($entity->$assoc as $key => $values) {
			if ( isset($config[$key]['show']) && (( is_array($config[$key]['show']) && in_array('form-has_many', $config[$key]['show'])) || ($config[$key]['show'] == 'form-has_many') ) )
				if ($assoc != "hasOne") {
					print $this->Entity->$assoc($key, "", array_merge($options, array("model" => $model)));
				} else {
					$assocMode = isset($config[$key]["mode"]) ? $config[$key]["mode"] : "default";
					print $this->Entity->form($key, "has_many", $assocMode, $options);
				}
		}
		?>
	</div>
	<?
}

$this->assign("mode", $mode);

if (isset($form_open)) $this->assign("form_open", $form_open);
if (isset($form_submit)) $this->assign("form_submit", $form_submit);

$formClass = "has_many " . ( $id ? "id-$id" : "" ) . " contextLinksInside";
$this->assign("containerClass", $formClass);

$this->assign('contextLinks', $this->element("Links/contextlinks"));
	
$this->assign('fields', '');
$this->start('fields');
	foreach ($fields as $key => $type) {  
	  if($key=='id'){
	  }else{
  		if (!$this->Entity->hiddenField($key, $type, "form-has_many", $fieldConfig, $id)) {
  			print $this->Entity->field($key, $mode);
  		}
    }  
	}

	if (array_key_exists("Class", $fields)) {
		// get the parent associated class based on parentPathClass
		$parentClass = $this->Entity->parentPathClass();
		
		print $this->Entity->field("Class", 'default', array("value" => $parentClass, "type" => "hidden"));
		
		if ($this->Entity->fieldValue("object_id")) {
			print $this->Entity->field("object_id", "default", array("type" => "hidden"));
		}
	}

	print $this->Form->input(Entity::currentPathField() . ".__ajax_deleted", array("type" => "hidden", "class" => "ajaxDelete"));
$this->end();

$this->assign('editLinks', $this->element("Links/editlinks"));

