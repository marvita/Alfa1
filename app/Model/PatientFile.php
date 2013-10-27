<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 * @property User $User
 * @property Category $Category
 */
class PatientFile extends AppModel {
	public $primaryKey = "id";
	
	/*public $actsAs = array(
        'Upload.Upload' => array(
            'Logo' => array(
                'fields' => array(
                    'dir' => 'LogoDir'
                ),
				'path' => '{ROOT}webroot{DS}img{DS}{model}{DS}{field}{DS}'
			),
			'Banner'=> array(
                'fields' => array(
                    'dir' => 'BannerDir'
                ),
				'path' => '{ROOT}webroot{DS}img{DS}{model}{DS}{field}{DS}'
            )
        ),
		"Tree"
    );*/
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	public $validate = array(
        'Stage' => array(
            'lettersNumbersAndSpaces' => array(
                'rule'     => array('custom', '/[A-Za-z0-9áéíóúñÑÁÉÍÓÚüÜ ]+/'),
                'required' => true,
                'message'  => 'Por favor, seleccione una opción...',
                'last' 		=> false
            )
        ),

        'Estado' => array(
            'lettersNumbersAndSpaces' => array(
                'rule'     => array('custom', '/[A-Za-z0-9áéíóúñÑÁÉÍÓÚüÜ ]+/'),
                'required' => true,
                'message'  => 'Por favor, seleccione una opción...',
                'last' 		=> false
            )
        ),
        /*'password' => array(
            'rule'    => array('minLength', '8'),
            'message' => 'Minimum 8 characters long'
        ),*/
        /*'Email' => array(
        	'email' => array(
        		'rule'	=> 'email',
        		'required' => true,
        		'message' => 'Por favor, ingrese una dirección de email válida'
        	)
        ),*/
        
    );
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Patient' => array(
			'className' => 'Patient',
			'foreignKey' => 'patient_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasOne = array(
		'SmokingHistory' => array(
			'className' => 'SmokingHistory',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'AatDetermination' => array(
			'className' => 'AatDetermination',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'ClinicalHistory' => array(
			'className' => 'ClinicalHistory',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'OtherDiagnostic' => array(
			'className' => 'OtherDiagnostic',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'ChestTac' => array(
			'className' => 'ChestTac',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'CurrentTreatment' => array(
			'className' => 'CurrentTreatment',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'SustitutiveTreatment' => array(
			'className' => 'SustitutiveTreatment',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'PulmonaryStudy' => array(
			'className' => 'PulmonaryStudy',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'HepaticEnzyme' => array(
			'className' => 'HepaticEnzyme',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'StGeorgeCuestionnaire' => array(
			'className' => 'StGeorgeCuestionnaire',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'WorkingHistory' => array(
			'className' => 'WorkingHistory',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'BloodSample' => array(
			'className' => 'BloodSample',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
		'FinalDate' => array(
			'className' => 'FinalDate',
			'foreignKey' => 'patient_file_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => ''
		),
	);
  
  
public function getFichas($limit) {
      $fichas = array();
      $fichas = $this->find('all', array('limit' => $limit));
 
      return $fichas;
    }  
  
  
}
