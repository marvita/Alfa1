<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('UIAppModel', 'UI.Model');
App::uses('CakeEventListener', 'Event');
App::uses("Utils", "Lib");

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends UIAppModel implements CakeEventListener {
	public function __construct($id = false, $table = null, $ds = null) {
		$class = get_class($this);
		
		if (!isset($this->displayField)) {
			if (isset($this->virtualFields["FullName"]))
				$this->displayField = 'FullName';
			else
				$this->displayField = 'Name';
		}
		
		parent::__construct($id, $table, $ds);
		
		$alias = $this->alias;
		
		/*if ($class == "User") {
			$this->bindModel(
				array(
					'hasAndBelongsToMany' => array(
						'Contact' => array(
				            'className' => 'Contact',
							'joinTable' => 'contacts_users',
							'foreignKey' => 'user_id',
							'associationForeignKey' => 'contact_id',
							'unique' => 'keepExisting',
							'conditions' => '',
							'fields' => '',
							'order' => '',
							'limit' => '',
							'offset' => '',
							'finderQuery' => '',
							'deleteQuery' => '',
							'insertQuery' => ''
				        )
					)
				)
			);
		}*/
	}
	
	public function implementedEvents() {
		return array(
           	'Model.afterSave' => 'afterSaveEventListener'
        );
    }
	
	public function afterSaveEventListener($event) {
		$subject = $event->subject();
		
		/*if (get_class($subject) == "User") {
			$profiledata["Profile"] = $subject->data["Profile"];
			
			if (isset($profiledata["Profile"])) {
				if ($event->data[0] == 1) {
					// nuevo usuario, crear el perfil y guardarlo
					$profiledata["Profile"]["user_id"] = $subject->id;
				}
				$subject->Profile->save($profiledata);
				
				$subject->Profile->query("insert into categories_profiles set id = UUID(), profile_id = '{$subject->Profile->id}', category_id = '{$profiledata["Profile"]["Category"]}'");
				
				$profile = $subject->Profile->read(null, $subject->Profile->id);
				
				$profiledata["Profile"]["ProfileCode"] = Utils::ProfileCode($profile["Profile"]["ProfileNumber"] + 5000);
				
				$subject->Profile->save($profiledata);
			}
		}*/
	}
}
