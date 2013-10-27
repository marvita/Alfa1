<?
$this->assign("displayType", @$options["displayType"]);

switch ($type) {
	case "date":
	case "datetime":
		include "datetime-default.ctp";
		break;
	case "enum":
		include "enum-default.ctp";
		break;
	default:
		include "default.ctp";
}

$this->extend("/field-wrapper-hybrid");
