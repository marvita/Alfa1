<?php
/**
 * Fields are: label, shortlabel to be used in index listings, printFunc, fillFunc and saveFunc, oprions for selectable options in case of enums,
 * "search"", "add", "update" and "index" to define places where it should not appear (i.e. set "index" to false to hide field in index listings)
 */
$config = array(
	/* this setting defines specific values aside from default ones for certain fiels of the entity */
	/* possible keys: label, shortLabel, fillFunc, printFunc, saveFunc, type, options */
	"Patient.Name" => "Paciente",
	"Patient.Index" => array(
		"Title" => "Pacientes"
	),
	"Patient.Fields" => array(
		"Iniciales" => array("label" => __("Iniciales (3)"), "shortLabel" => __("Iniciales"), "wrapperClass" => "inline_block small"),
		"DNI" => array("label" => __("Últimos 3 dígitos del DNI"), "shortLabel" => __("DNI"), "wrapperClass" => "inline_block small"),
		"FechaNacimiento" => array(
			"shortLabel" => __("Fecha nac."), 
			"label" => __("Fecha de Nacimiento"), 
			"printFunc" => "sqldate2date", 
			"wrapperClass" => "inline_block small",
		    "options" => array("endDate" => date("Y-m-d H:i"))),
		'Genero' => array("label" => __("Género"), "wrapperClass" => "inline_block small"),
		'Altura' => array("label" => __("Altura"), "wrapperClass" => "inline_block small"),
		'UnidadAltura' => array("label" => __("Unidad de altura"), "wrapperClass" => "inline_block small"),
		'Peso' => array("label" => __("Peso"), "wrapperClass" => "inline_block small"),
		'ConsentimientoFirmado' => array("label" => __("Consentimiento firmado"), "wrapperClass" => "inline_block small", "printFunc" => "YesNo"),
		/*"Nacimiento" => array("label" => __("Fecha de nacimiento"), "printFunc" => "sqldate2date", "break" => true),
		"Trabajos" => array("label" => __("Trabajos anteriores"), "search" => false),
		"Puesto" => array("label" => __("Puesto solicitado"), "printFunc" => "printPosition", "options" => array("" => __("Cualquiera")) + Assets::PositionsArray() ),
		"Sucursal" => __("Sucursal"),
		"Matricula" => array("label" => __("Matrícula"), "search" => false),
		"Egresado" => array("label" => __("Fecha de egresado"), "search" => false),
		"Seguro" => array("label" => __("Seguro de mala praxis"), "search" => false),
		"Vencimiento" => array("label" => __("Vencimiento Cert. SSS"), "search" => false, "printFunc" => "sqldate2date")*/
	),
	/* this settings define how associations are displayed in default form and view templates */
	"Patient.Associations" => array(
		"PatientFile" => array('label' => 'Fichas', 'shortLabel' => 'Fichas', 'mode' => 'hybrid', "hide" => "form"),
		"User" => array(
			'hide' => array('form'),
			'label' => 'Long label', 'shortLabel' => 'Short label', 'mode' => 'hybrid')
	)
);
