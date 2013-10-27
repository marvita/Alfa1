<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 * @property User $User
 * @property Category $Category
 */
class BloodSample extends AppModel {
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'PatientFile' => array(
			'className' => 'PatientFile',
			'foreignKey' => 'patient_file_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
