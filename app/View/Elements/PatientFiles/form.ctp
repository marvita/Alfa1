<?
$this->extend("/form-wrapper-patientfile");

if (empty($mode)) $mode = "default";

$fields = $this->Entity->entityFields($model);
$entity = $this->Entity->getModel($model);
$config = $this->Entity->entityConfig($model, 'Associations');
$fieldConfig = $this->Entity->entityConfig($model, 'Fields');

$modelName = $this->Entity->entityConfig($model, "Name");
if (empty($modelName)) $modelName = Inflector::humanize(Inflector::underscore($model));

$id = $this->Entity->fieldValue("id");

if (!isset($title)) {
	if ( !isset($this->request->data[$model]["id"]) && !isset($id)) {
		$title = sprintf(__("Agregar %s"), $modelName);
	} else {
		$title = sprintf(__("Editar %s"), $modelName);
	}
}


foreach (array("belongsTo", "hasMany", "hasAndBelongsToMany", "hasOne") as $assoc) {
	?>
	<div class="<?= Inflector::underscore($assoc)?>">
		<?
		foreach ($entity->$assoc as $key => $values) {
			if ( (!isset($config[$key]['hide']) || (is_array($config[$key]['hide']) && !in_array('form', $config[$key]['hide'])) || (is_string($config[$key]['hide']) && ($config[$key]['hide'] != 'form')) ) && ($key != "Patient") ) {
				if ($assoc != "hasOne") {
					print $this->Entity->$assoc($key, "", array("model" => $model));
				} else {
					$tabLabel = $this->Entity->entityConfig($values["className"], "ShortName");
					if (empty($tabLabel)) $tabLabel = $this->Entity->entityConfig($values["className"], "Name");
					if (empty($tabLabel)) $tabLabel = $key;

					$this->start("tabs");
					?><li class="<?= $key ?>"><a href="#<?= Inflector::underscore($key) ?>" data-toggle="tab"><?= $tabLabel ?></a></li><?
					$this->end("tabs");
					
					$this->start('tabcontents');
					?><div class="tab-pane" id="<?= Inflector::underscore($key) ?>"><?
					print $this->Entity->form($key, "has_many", $mode);
					?></div><?
					$this->end('tabcontents');

				}
			}
				
		}
		?>
	</div>
	<?
}

$this->assign('fields', $this->Entity->belongsTo("Patient", "", array("model" => $model)));

$this->assign("title", $title);
$this->assign("mode", $mode);

if (isset($form_open)) $this->assign("form_open", $form_open);
if (isset($form_submit)) $this->assign("form_submit", $form_submit);

?>
<? 

$this->start("fields"); ?>
	<?
	foreach ($fields as $key => $type) {
		if ( !$this->Entity->hiddenField($key, $type, "form", $fieldConfig, $id) ) {
			if (isset($options))  {
				print $this->Entity->field($key, $mode, $options);
			} else {
				print $this->Entity->field($key, $mode);
			}
		}
	}
	//print $this->Form->input("Contact.Task.0.Note.0.Content");
	?>
<? $this->end(); ?>
<? $this->assign('contextLinks', '');
$this->assign('editLinks', ''); ?>