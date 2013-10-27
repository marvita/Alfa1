<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 * @property User $User
 * @property Category $Category
 */
class Patient extends AppModel {
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
	
	public $virtualFields = array(
    	'NameDNI' => 'CONCAT(Patient.Iniciales, " - ", Patient.DNI)'
	);

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'NameDNI';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'Usermgmt.User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'PatientFile' => array(
			'className' => 'PatientFile',
			'foreignKey' => 'patient_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => 'created ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}