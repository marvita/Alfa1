<?
$this->extend("/form-wrapper");

$fields = $this->Entity->entityFields($model);
$entity = $this->Entity->getModel($model);
$config = $this->Entity->entityConfig($model, 'Associations');
$fieldConfig = $this->Entity->entityConfig($model, 'Fields');

$parentModel = Entity::parentPathClass();
$currentAlias = Entity::currentPathName();
$parentEntity = $this->Entity->getModel($parentModel);


//Entity::_revertEntityPath();


$id = $this->Entity->fieldValue("id");

foreach (array("belongsTo", "hasMany", "hasAndBelongsToMany", "hasOne") as $assoc) {
	?>
	<div class="<?= Inflector::underscore($assoc)?>">
		<?
		foreach ($entity->$assoc as $key => $values) {
			if ( isset($config[$key]['show']) && (( is_array($config[$key]['show']) && in_array('form-belongs_to', $config[$key]['show'])) || ($config[$key]['show'] == 'form-belongs_to') ) ) {
				if ($assoc != "hasOne") {
					print $this->Entity->$assoc($key, "", array_merge($options, array("model" => $model)));
				} else {
					$assocMode = isset($config[$key]["mode"]) ? $config[$key]["mode"] : "default";
					print $this->Entity->form($key, "has_many", $assocMode, $options);
				}
			}
		}
		?>
	</div>
	<?
}

$this->assign("mode", $mode);

if (isset($form_open)) $this->assign("form_open", $form_open);
if (isset($form_submit)) $this->assign("form_submit", $form_submit);

$formClass = "belongs_to " . ( $id ? "id-$id" : "" ) . " contextLinksInside";
$this->assign("containerClass", $formClass);

$this->assign('fields', '');
$this->start('fields');
	foreach ($fields as $key => $type) {
		$showInputs = false;
		if ($mode == "hybrid") {
			// we check first if there is an array of data for this object... if there is not, we should only display
			if ( ($this->request->is('post') || $this->request->is('put')) && Entity::getDataValue($this->request->data) ) {
				$showInputs = true;
			}
		}
		if (!$this->Entity->hiddenField($key, $type, "form-belongs_to", $fieldConfig, $id)) {
			print $this->Entity->field($key, $mode, array("displayType" => $showInputs ? "dual" : "view"));
		} else {
			if ($showInputs) {
				print $this->Entity->field($key, $mode, array("displayType" => "hidden"));
			}
		}
	}
$this->end();
?>
