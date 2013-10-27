<?php
/**
 * Fields are: label, shortlabel to be used in index listings, printFunc, fillFunc and saveFunc, oprions for selectable options in case of enums,
 * "search"", "add", "update" and "index" to define places where it should not appear (i.e. set "index" to false to hide field in index listings)
 */
$config = array(
	/* this setting defines specific values aside from default ones for certain fiels of the entity */
	/* possible keys: label, shortLabel, fillFunc, printFunc, saveFunc, type, options */
	"BloodSample.Name" => "Muestras Sangruíneas",
	"BloodSample.ShortName" => "Muest. Sang.",
	"BloodSample.Fields" => array(
		/*"Iniciales" => array("label" => __("Iniciales (3)"), "shortLabel" => __("Iniciales")),
		"DNI" => array("label" => __("Últimos 3 dígitos del DNI"), "shortLabel" => __("DNI")),
		"FechaNacimiento" => array("shortLabel" => __("Fecha nac."), "label" => __("Fecha de Nacimiento"), "fillFunc" => "sqldate2date", "saveFunc" => "date2sqldate"),
		"Telefono" => __("Teléfono"),
		"Direccion" => __("Dirección"),
		"Localidad" => __("Localidad"),
		"Partido" => __("Partido"),
		"ObraSocial" => __("Obra Social"),
		"Prepaga" => __("Prepaga"),
		"SinCobertura" => __("Sin Cobertura"),
		"ExposicionLaboral" => __("Exposición Laboral"),
		"AgenteExposicion" => __("Agente"),
		"Nacimiento" => array("label" => __("Fecha de nacimiento"), "printFunc" => "sqldate2date", "break" => true),
		"Trabajos" => array("label" => __("Trabajos anteriores"), "search" => false),
		"Puesto" => array("label" => __("Puesto solicitado"), "printFunc" => "printPosition", "options" => array("" => __("Cualquiera")) + Assets::PositionsArray() ),
		"Sucursal" => __("Sucursal"),
		"Matricula" => array("label" => __("Matrícula"), "search" => false),
		"Egresado" => array("label" => __("Fecha de egresado"), "search" => false),
		"Seguro" => array("label" => __("Seguro de mala praxis"), "search" => false),
		"Vencimiento" => array("label" => __("Vencimiento Cert. SSS"), "search" => false, "printFunc" => "sqldate2date")*/
	),
	/* this fields will not be displayed in default form and view templates */
	"BloodSample.HideFields" => array('created', 'modified'),
	/* this settings define how associations are displayed in default form and view templates */
	"BloodSample.Associations" => array(
		"PatientFile" => array(
			'label' => __('Ficha'), 'shortLabel' => __('Ficha'),
			'mode' => 'default', 'addMode' => 'inline', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		)
	)
);
