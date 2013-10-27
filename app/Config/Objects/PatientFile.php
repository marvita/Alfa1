<?php
/**
 * Fields are: label, shortlabel to be used in index listings, printFunc, fillFunc and saveFunc, oprions for selectable options in case of enums,
 * "search"", "add", "update" and "index" to define places where it should not appear (i.e. set "index" to false to hide field in index listings)
 */
$config = array(
	/* this setting defines specific values aside from default ones for certain fiels of the entity */
	/* possible keys: label, shortLabel, fillFunc, printFunc, saveFunc, type, options */
	"PatientFile.Name" => "Ficha de seguimiento",
	"PatientFile.Index" => array(
		"Title" => __("Fichas"),
		"ExtraFields" => array(
			"Patient.NameDNI" => array("label" => __("Paciente"), "priority" => -1)
		)
	),
	"PatientFile.Fields" => array(
		"Complete" => array("label" => __("Completa"), "wrapperClass" => "inline_block small", "printFunc" => "YesNo"),
		"Closed" => array("label" => __("Cerrada"), "wrapperClass" => "inline_block small", "printFunc" => "YesNo"),
		"Stage" => array("label" => __("Etapa"), "wrapperClass" => "inline_block small"),
		"Estado" => array("label" => __("Estado"), "wrapperClass" => "inline_block small"),
		"created" => array("label" => __("Creada el"), "show" => array('index'), "printFunc" => "sqldate2datetime"),
		"modified" => array("label" => __("Última modificación"), "show" => array('index'), "printFunc" => "sqldate2datetime"),
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
	/* this settings define how associations are displayed in default form and view templates */
	"PatientFile.Associations" => array(
		"Patient" => array(
			'label' => __('Paciente'), 'mode' => 'hybrid', 'addOrder' => 'append', 'addMode' => 'popup'
		),
		"SmokingHistory" => array(
			'label' => __('Tabaquismo'), 'shortLabel' => __('Tabaquismo'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"AatDetermination" => array(
			'label' => __('Motivo de la determinación de AAT'), 'shortLabel' => __('Motivo Determ. AAT'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"ClinicalHistory" => array(
			'label' => __('Historia clínica'), 'shortLabel' => __('Historia clínica'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"OtherDiagnostic" => array(
			'label' => __('Otros diagnósticos'), 'shortLabel' => __('Otros diag.'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"ChestTac" => array(
			'label' => __('Datos TC'), 'shortLabel' => __('Datos TC'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"CurrentTreatment" => array(
			'label' => __('Tratamiento actual'), 'shortLabel' => __('Trat. actual'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"SustitutiveTreatment" => array(
			'label' => __('Tratamiento sustitutivo'), 'shortLabel' => __('Trat. sustitutivo'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"PulmonaryStudy" => array(
			'label' => __('Funcionalismo pulmonar'), 'shortLabel' => __('Func. pulmonar'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"HepaticEnzyme" => array(
			'label' => __('Enzimas hepáticas'), 'shortLabel' => __('Enz. hepáticas'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"StGeorgeCuestionnaire" => array(
			'label' => __('Datos cuestionario St. George'), 'shortLabel' => __('Cuest. St. George'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"WorkingHistory" => array(
			'label' => __('Historia laboral'), 'shortLabel' => __('Hist. Laboral'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"BloodSample" => array(
			'label' => __('Muestras sanguíneas'), 'shortLabel' => __('Muestras Sang.'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
		"FinalDate" => array(
			'label' => __('Fecha final'), 'shortLabel' => __('Fecha final'),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		),
	)
);
