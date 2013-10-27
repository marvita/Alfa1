<?
list($plugin, $association) = pluginSplit($association);
$plugin = Inflector::underscore($plugin);
$controller = Inflector::underscore(Inflector::pluralize($association));
$aliasClass = Inflector::underscore($alias);
$baseModelClass = Inflector::underscore($model);
$associationClass = $association != $alias ? Inflector::underscore($association) : "";
$associationConfig = $this->Entity->entityConfig($model, "Associations", $alias);

if (!isset($valueField)) {
	$valueField = Inflector::underscore(Inflector::singularize($alias))."_id";
}

$valueFieldName = $this->Entity->parentPathField();
if ($valueFieldName != "") $valueFieldName .= ".";
$valueFieldName .= $valueField;

$valueFieldID = $this->Entity->parentPathID() . Inflector::camelize($valueField);

$context = $this->Js->currentContext();

// the base path that this associated model should have when calling it as a FormAuthenticate
// (without index for multiple associations like hasmany)
$associatedBasePath = $this->Entity->currentPathField();
if ($associatedBasePath != "") $associatedBasePath .= ".";
$associatedBasePath .= $alias;

$addMode = @$config["addMode"] ? $config["addMode"] : "popup";
$mode = @$config["mode"] ? $config["mode"] : "default";
$addOrder = @$config["addOrder"] ? $config["addOrder"] : "append";
$template = "has_many";

?>
<div class="association has_many <?= $aliasClass ?> base-<?= $baseModelClass ?> <?= $associationClass ?>">
	<h3><?= isset($associationConfig["label"]) ? $associationConfig["label"] : Inflector::humanize($alias) ?>
	<div class="actions">
		<?/*<?= $this->element("UI.autocomplete", compact("controller", "plugin", 'alias', 'mode', 'association', 'valueFieldID', 'template', 'addOrder')) ?>*/ ?>
		<? /*<?= $this->Js->popup(
			$this->Html->image("UI.action-list.png"),
			array("controller" => $controller, "action" => "select", "plugin" => ($plugin ? $plugin : false), isset($id) ? $id : null),
			array("width" => "90%", "callBack" => "fillView", "callBackTargetPath" => ".belongsto .entity", 'escape' => false )
		) ?> */ ?>
		<?= $this->element("UI.Links/has_many-add-$addMode", compact("controller", "associatedBasePath", "plugin", "id", "context", "mode", "addOrder")) ?>
	</div>
	</h3>
	<?
	$value = $this->Entity->associationValue($alias);
	?>
	<div class="entity" data-listindex='<?= count($value) ?>'>
		<? foreach ($value as $key => $value) {
			print $this->Entity->form($alias.".".$key, "has_many", $mode);
		} ?>
	</div>
</div>