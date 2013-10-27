<?php
// adapt the field name on the entity path setting
$path = $this->Entity->currentPathField();
$fieldValue = $this->Entity->fieldValue($field);
$fieldLabel = $this->Entity->fieldLabel($field);
$fieldConfig = $this->Entity->entityConfig(Entity::currentPathClass(), "Fields", $field);
$fieldType = $this->Entity->fieldType($field);

if ($type == "hidden") {
	$this->extend("/field-wrapper-bare");
} else {
	$this->extend("/field-wrapper");
}

$underscored = "input field_type_" . str_replace(".", "-", Inflector::underscore($fieldType)) . " field_".str_replace(".", "-", Inflector::underscore($field));

$field = $path . ($path ? "." : "") . $field;

$options["div"] = false;
$options["label"] = false;
$options["class"] = "span12";
$options["placeholder"] = $fieldValue;
if ($fieldType == "password") {
	$options["type"] = "password";
}
$wrapperClass = isset($fieldConfig["wrapperClass"]) ? $fieldConfig["wrapperClass"] : "";
$class = "$underscored $wrapperClass mode-$mode";

$this->assign("class", $class);
$this->assign("fieldLabel", $fieldLabel);
$this->assign("fieldValue", "" . ($fieldValue ? $fieldValue : ""));
$this->assign("fieldType", $fieldType);

echo $this->Form->input($field, $options);
