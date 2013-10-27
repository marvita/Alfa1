<?php
// adapt the field name on the entity path setting
$path = $this->Entity->currentPathField();

$field = $path . ($path ? "." : "") . $field;

print $this->Form->input($field, $options);
?>