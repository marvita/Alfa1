<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('UIAppController', 'UI.Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends UIAppController {
   
  public function __construct($request = null, $response = null) {
		if ($request) {
			$this->helpers["Menu"] = array( "className" => "Alfa1Menu" );
			$this->helpers[] = "UI.ImageCache";
			$this->helpers[] = 'Usermgmt.UserAuth';
			$this->helpers[] = 'Tuning';
			$this->components[] = 'Usermgmt.UserAuth';
			
			if ($request->params["controller"] == "users" && in_array($request->params["action"], array("addUser", "editUser", "register")) && isset($request->data["User"]["email"]) ) {
				$request->data["User"]["username"] = $request->data["User"]["email"];
			}
		}
		
		parent::__construct($request, $response);
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->theme = "FlatPoint";

		/*
		if ($this->UserAuth->isLogged()) {
			$userId = $this->UserAuth->getUserId();
			
			App::uses("Profile", "Model");
			$pm = new Profile();
			
			// set the user profile if the user is logged in
			$userProfile = $pm->find('first', array("conditions" => array("user_id" => $this->UserAuth->getUserId())));
			if (!$userProfile) {
				$userProfile = array("Profile" => array('id' => '', "Titulo" => '', 'Descripción' => '', 'Logo' => '', 'LogoDir' => '', 'Banner' => '', 'BannerDir' => ''));
			}
			$this->set("userProfile", $userProfile);
			
			App::uses("Subscription", "Model");
			$sub = new Subscription();
			$sub->contain(array("Profile"));
			$subscriptions = $sub->find("all", array("conditions" => array(
				"Subscription.user_id" => $userId,
				"Subscription.modified > DATE_SUB(NOW(), INTERVAL 1 DAY)",
				"Visto" => "0"
			)));
			
			$this->set("subscriptions", $subscriptions);
		}
		*/
		/*$isAdmin = (@$this->request->params["admin"] ||
			(
				(@$this->request->params["plugin"] == "usermgmt") &&
				(@$this->request->params["controller"] == "users") &&
				(in_array($this->request->params["action"], array(
					"addUser", "changeUserPassword", "deleteUser", "editUser", "index", "makeActiveInactive", "verifyEmail", "viewUser"
				)
			) ) )
		);
		
		if ($isAdmin) {
			$this->theme = "Admin";
		} else {
			$this->theme = "Front";
		}*/
		
		/*if ( (get_class($this) == "UsersController") && ($this->request->action == "register") ) {
			//$this->User->Profile->Category->recover();
			$categories_raw = $this->User->Profile->Category->generateTreeList(null, null, null, "_");
			
			$categories = array();
			
			$parent = null;
			foreach($categories_raw as $key => $value) {
				if (substr($value, 0, 1) == "_") {
					// it's a suboption
					$parent[$key] = substr($value, 1);
				} else {
					$categories[$value] = array();
					$parent = &$categories[$value];
				}
			}
			
			$this->set("categories", $categories );
			
			// catch when the user is trying to register twice and the email is not verified
			if (isset($this->request->data["User"]["email"])) {
				// find if there is a user with this email and not verified
				$user = $this->User->find("first", array("conditions" => array("username" => $this->request->data["User"]["email"], "email_verified" => "0")));
				
				if ($user) {
					return $this->emailVerification();
				}
			}
		}*/
		if ($this->request->controller == "users" && $this->request->params["plugin"] == "usermgmt" && 
			in_array($this->request->action, array("register", "login", "userVerification"))) {
			$this->layout = "login";
		}
	}
	
	public function beforeRender() {
		parent::beforeRender();
		
		/*if (isset($this->viewVars["profile"])) {
			$profile = $this->viewVars["profile"];
			
			if ($this->UserAuth->isLogged()) {
				$userId = $this->UserAuth->getUserId();
				
				App::uses("Profile", "Model");
				$pm = new Profile();
				
				// check for subscriptions
				$pm->Subscription->contain(array());
				$sub = $pm->Subscription->find('first', array("conditions" => array("user_id" => $userId, "profile_id" => $profile["Profile"]["id"]), "fields" => array("id") ) );
				if ($sub) {
					$this->set("subscribed", true);
					$sub["Subscription"]["Visto"] = 1;
					$this->Profile->Subscription->save($sub);
				} else {
					$this->set("subscribed", false);
				}
			} else {
				$this->set("subscribed", false);
			}
			
			$this->set("dashboard", $this->UserAuth->isLogged() && ($this->UserAuth->getUserId() == $profile["Profile"]["user_id"]) );
		}*/
	}
}