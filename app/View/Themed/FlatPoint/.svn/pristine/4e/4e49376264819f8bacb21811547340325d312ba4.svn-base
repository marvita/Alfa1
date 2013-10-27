<?php
$this->extend("/field-wrapper");

$enumopts = $this->Entity->enumOpts($field);

$func = "{$field}TypesArray";
$opts = Assets::$func();
if (empty($opts)) $opts = array_combine($enumopts, $enumopts);
if (!isset($options["empty"])) {
	$empty = __("Seleccione")."...";
} else {
	$empty = $options["empty"];
}

$options = array_merge($options, array("options" => $opts, "empty" => $empty ));


// adapt the field name on the entity path setting
$path = $this->Entity->currentPathField();
$fieldLabel = $this->Entity->fieldLabel($field);
$fieldValue = $this->Entity->fieldValue($field);
$fieldType = $this->Entity->fieldType($field);
$fieldConfig = $this->Entity->entityConfig(Entity::currentPathClass(), "Fields", $field);
$field = $path . ($path ? "." : "") . $field;

$underscored = "input field_type_" . str_replace(".", "-", Inflector::underscore($fieldType)) . " field_".str_replace(".", "-", Inflector::underscore($field));

$options["div"] = false;
$options["label"] = false;
$options["class"] = "span12";
$wrapperClass = isset($fieldConfig["wrapperClass"]) ? $fieldConfig["wrapperClass"] : "";
$class = "$underscored $wrapperClass mode-$mode";
//$options["placeholder"] = $fieldValue;

$this->assign("class", $class);
$this->assign("fieldLabel", $fieldLabel);
$this->assign("fieldValue", $fieldValue ? $fieldValue : "");

echo $this->Form->input($field, $options);
