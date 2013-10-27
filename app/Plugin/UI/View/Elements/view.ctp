<?
$this->extend("/form-wrapper");

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
		$title = sprintf(__("Ver %s"), $modelName);
	}
}

foreach (array("belongsTo", "hasMany", "hasAndBelongsToMany", "hasOne") as $assoc) {
	?>
	<div class="<?= Inflector::underscore($assoc)?>">
		<?
		foreach ($entity->$assoc as $key => $values) {
			if (!isset($config[$key]['hide']) || (is_array($config[$key]['hide']) && !in_array('form', $config[$key]['hide'])) && ($config[$key]['hide'] != 'form')) {
				if ($assoc != "hasOne") {
					print $this->Entity->$assoc($key, "", array_merge($options, array("model" => $model)));
				} else {
					$assocMode = isset($config[$key]["mode"]) ? $config[$key]["mode"] : "default";
					print $this->Entity->form($key, "has_many", $mode, $options);
				}
			}
				
		}
		?>
	</div>
	<?
}

$this->assign("title", $title);
$this->assign("mode", $mode);

if (isset($form_open)) $this->assign("form_open", $form_open);
if (isset($form_submit)) $this->assign("form_submit", $form_submit);

?>
<? 
$this->assign('fields', '');
$this->start("fields"); ?>
	<?
	foreach ($fields as $key => $type) {

    /* Marta: evita mostrar el key en el view. Buscar otra manera */
    if ($key=='id') {
    }else{
    		if ( !$this->Entity->hiddenField($key, $type, "form", $fieldConfig, $id) ) {
    			if (isset($options))  {
    				print $this->Entity->field($key, $mode, $options);
    			} else {
    				print $this->Entity->field($key, $mode);
    			}
    		}
    }  
      
	}
	//print $this->Form->input("Contact.Task.0.Note.0.Content");
	?>
<? $this->end(); ?>
<? $this->assign('contextLinks', '');
$this->assign('editLinks', ''); ?>

<?php // print ' - Testing '. $modelName . ' Ver - ';?>