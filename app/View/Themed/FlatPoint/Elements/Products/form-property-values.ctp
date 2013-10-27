<?

$fields = $this->Entity->entityFields($model);
$entity = $this->Entity->getModel($model);
$config = $this->Entity->entityConfig($model, 'Associations');
$fieldConfigs = $this->Entity->entityConfig($model, 'HideFields');
//pr($this->request->data);
?>
<div class="form <?= Inflector::underscore($this->request->controller) ?> <?= Inflector::underscore($this->request->action) ?> mode-<?= $mode ?>">
	
	<?
	$properties = $this->Entity->associationValue("ProductType.Property");
	$current = $this->Entity->associationValue("PropertyValue");
	$values = Hash::combine($current, "{n}.property_id", "{n}.id");
	$labels = Hash::combine($properties, "{n}.id", "{n}.Name");
	
	$i = 0;
	foreach ($properties as $property) {
		//pr($property);
		$options = Hash::combine($property, "PropertyValue.{n}.id", "PropertyValue.{n}.ValueText");
		$value = @$values[$property["id"]];
		$label = $labels[$property["id"]];

		$underscored = "input field_type_select field_property_value_id";
		?>
		<div class="form_row <?= $underscored ?>">
			<label class="field_name"><?= $label ?></label>
			<div class="field">
				<? echo $this->Form->input("PropertyValue.$i.id", array("label" => false, "type" => "select", "options" => $options, "value" => $value, "div" => false)); ?>
			</div>
		</div>
		<?

		//$this->Entity->form("PropertyValue.$i", "has_and_belongs_to_many", $mode);
		$i++;
	}
	/*
	?>
	<div class="fields">
		<?
		foreach ($fields as $key => $type) {
			if ( (substr($key, -3) != "_id" && ($key != "id" || $this->request->action != "add") && (!in_array($key, $fieldConfigs)) ) ) {
				if (isset($options))  {
					print $this->Entity->field($key, null, $options);
				} else {
					print $this->Entity->field($key);
				}
			}
		}
		//print $this->Form->input("Contact.Task.0.Note.0.Content");
		?>
	</div>
	
	<div class="associations">
		<?
		foreach (array("belongsTo", "hasMany", "hasAndBelongsToMany", "hasOne") as $assoc) {
			?>
			<div class="<?= Inflector::underscore($assoc)?>">
				<?
				foreach ($entity->$assoc as $key => $values) {
					if (!isset($config[$key]['hide']) || (is_array($config[$key]['hide']) && !in_array('form', $config[$key]['hide'])) && ($config[$key]['hide'] != 'form'))
						print $this->Entity->$assoc($key, "", array("model" => $model));
				}
				?>
			</div>
			<?
		}
		?>
	</div>
	<? */ ?>
	
</div>
