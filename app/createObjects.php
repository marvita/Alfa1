<?php

print "hola";
$associations = "";
$origfile = file_get_contents("Config/Objects/SmokingHistory.php");
$origmodel = file_get_contents("Model/SmokingHistory.php");
foreach (array("AatDetermination", "ClinicalHistory", "OtherDiagnostic", "ChestTac", "CurrentTreatment", "SustitutiveTreatment", "PulmonaryStudy", "HepaticEnzyme", "StGeorgeCuestionnaire", "WorkingHistory", "BloodSample", "FinalDate") as $model) {
	// copiar el modelo base
	print("Creando $model\n");
	
	$file = str_replace("SmokingHistory.", "$model.", $origfile);
	file_put_contents("Config/Objects/$model.php", $file);

	$file = str_replace("SmokingHistory", "$model", $origmodel);
	file_put_contents("Model/$model.php", $file);	

	$associations .=
"		\"$model\" => array(
			'label' => __(''), 'shortLabel' => __(''),
			'mode' => 'default', 'addMode' => 'inline-form', // possible values : inline, inline-form, popup
			'addOrder' => 'html'
		)
	),
";
	$hasone .=
"		'$model' => array(
			'className' => '$model',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => 'created ASC'
		),
";
}
file_put_contents("Config/Objects/PatientFile.php", $associations, FILE_APPEND);
file_put_contents("Model/PatientFile.php", $hasone, FILE_APPEND);
?>