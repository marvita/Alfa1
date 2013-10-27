<?php
$enumopts = $this->Entity->enumOpts($field);

$func = "{$field}TypesArray";
$opts = Assets::$func();
if (empty($opts)) $opts = array_combine($enumopts, $enumopts);
if (!isset($options["empty"])) {
	$empty = __("Seleccione")."...";
} else {
	$empty = $options["empty"];
}

// adapt the field name on the entity path setting
$path = $this->Entity->currentPathField();

$field = $path . ($path ? "." : "") . $field;

$options = array_merge($options, array("options" => $opts, "empty" => $empty ));
print $this->Form->input($field, $options);
?>