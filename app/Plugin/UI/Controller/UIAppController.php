<?php

App::uses('Controller', 'Controller');
App::uses('Assets', 'UI');

class UIAppController extends Controller {
	public $helpers = array(
		'Js' => array("className" => "UI.UIJs"),
		'Time',
		'Html' => array("className" => "UI.UIHtml"),
		'Session',
		'Form' => array("className" => "UI.UIForm"),
		'UI.Menu',
		'UI.Notifier',
		'Text',
		'UI.Entity'
	);
	public $components = array('Session', 'RequestHandler', "UI.Search", "UI.Entity");
	
	public function __construct($request = null, $response = null) {

		if (CakePlugin::loaded("DebugKit") && !in_array('DebugKit.Toolbar', $this->components) ) {
			$this->components[] = "DebugKit.Toolbar";
		}
		
		$result = parent::__construct($request, $response);
		
		return $result;
	}
	
	protected $formSuccessRedirect = true;
	protected $searchConditions = array();

	function beforeFilter() {
		$this->viewClass = "UI.UI";
		
		if (!defined("WEBROOT_DIR_THEME")) define("WEBROOT_DIR_THEME", APP."View".DS."Themed".DS.$this->theme.DS."webroot".DS);
		if (!defined("IMAGES_THEME")) define("IMAGES_THEME", APP."View".DS."Themed".DS.$this->theme.DS."webroot".DS."img".DS);
		if (!defined("CSS_THEME")) define("CSS_THEME", APP."View".DS."Themed".DS.$this->theme.DS."webroot".DS."css".DS);
		if (!defined("JS_THEME")) define("JS_THEME", APP."View".DS."Themed".DS.$this->theme.DS."webroot".DS."js".DS);
		
		if (CakePlugin::loaded("Usermgmt") && array_key_exists('Usermgmt.UserAuth', $this->components) && array_key_exists('Usermgmt.UserAuth', $this->helpers) ) {
			$this->userAuth();
		}
		
		if (isset($this->request->named["context"])) {
			$this->set("context", $this->request->named["context"]);
		} else {
			$this->set("context", ";" . ( Configure::read("UI.rootContext") ? Configure::read("UI.rootContext") : "#content" ) );
		}
		
		$this->set("controller", $this->request->controller);
		$this->set("action", $this->request->action);
		
		if ($this->request->action == "index") {
			//pr($this->request);
			CakeSession::write("lastindex", $this->request->params);
		}
		Configure::write("DinamoJsHelperLoadingPopupModal", false);
		Configure::write("DinamoJsHelperLoadingPopupHeight", 50);
		Configure::write("DinamoJsHelperLoadingPopupWidth", 50);
		
		if (isset($this->request->named["ajax"])) {
			$this->layout = "ajax";
		}

		$this->theme = 'Classic';
    }
	
	public function redirect($url, $status = null, $exit = true) {
		if (is_string($url)) {
			if (strpos($url, "/") === false) {
				$url = array("action" => $url);
			} else {
				$url = Router::parse($url);
			}
		}
		// TODO: successContext and errorContext are properly set after a redirect() (defined in UIAppController)
		// that is dangerous, we need to set the context when delivering the response and then propagate the resulting
		// context when calling redirect...
		if (CakeSession::read('validationError')) {
			if(isset($this->request->named["submitErrorContext"])) $url["context"] = $this->request->named["submitErrorContext"];
		} else {
			if(isset($this->request->named["submitSuccessContext"])) $url["context"] = $this->request->named["submitSuccessContext"];
		}
		
		if (!isset($url["context"]) && isset($this->request->named["context"])) {
			$url["context"] = $this->request->named["context"];
		}
		
		// for some reason router parse leaves in the "pass" array all the extra parameters, but if we make a redirect
		// with that array that is converted to a named parameter callse "pass"... so weird... we have to rearrange it again
		if (!empty($url["pass"])) {
			foreach ($url["pass"] as $key => $value) {
				$url[$key] = $value;
			}
			unset($url["pass"]);
		}
		
		parent::redirect($url, $status, $exit);
	}
	
	private function userAuth(){
    	$this->UserAuth->beforeFilter($this);
	}
	
	protected function addBodyClass($class) {
		if (!isset($this->bodyClasses)) $this->bodyClasses = array();
		
		$this->bodyClasses[] = $class;
	}
	
	function beforeRender() {
		if (isset($this->bodyClasses)) {
			$this->set("bodyClass", implode(" ", $this->bodyClasses));
		} else $this->set("bodyClass", "");
		
		if (CakeSession::read('validationError')) {
			if(isset($this->request->named["submitErrorContext"])) $this->set("context", $this->request->named["submitErrorContext"]);
		} else {
			if(isset($this->request->named["submitSuccessContext"])) $this->set("context", $this->request->named["submitSuccessContext"]);
		}
	}
	
	public function autocomplete() {
		$model = Inflector::singularize($this->name);
		
		$obj = ClassRegistry::init($model);
		
		if (isset($obj->autoCompleteContain)) {
			$obj->contain($obj->autoCompleteContain);
		}
		
		if (isset($obj->autoCompleteConditions)) {
			$conditions = $obj->autoCompleteConditions;
		} else {
			$conditions = array("$model.{$obj->displayField} LIKE" => "%".$this->request->query['term']."%");
		}
		
		$result = $obj->find('all', array(
			'limit' => 20, 
			'fields' => array("$model.id", "$model.{$obj->displayField}"),
			'conditions' => $conditions
		));
		
		$data = array();
		
		foreach ($result as $item) {
			$data[] = array("label" => $item[$model][$obj->displayField], "value" => $item[$model]["id"]);
		}
		
		print json_encode($data);
		$this->autoRender = false;
	}
	
	/**
	* Convenience function, to be overrided by specific controllers, but just in case (as with the usermgmt plugin)
	* @param uuid $id
	* 
	*/
	public function get($id = null) {
		$this->autoRender = false;
		
		if (!$id) {
			echo json_encode(array());
			return;
		}
		$model = Inflector::singularize($this->name);
		
		$item = $this->$model->read(null, $id);
		
		foreach ($item as $key => $value) {
			if ($key != $model) {
				$item[$model][$key] = &$item[$key];
				unset($item[$key]);
			}
		}
		
		$item = &$item[$model];
		
		echo json_encode($item);
	}
	
	/**
 * index method
 *
 * @return void
 */
	public function index() {
		// si no se indica el profile id y el usuario esta logueado usar el del usuario
		$conditions = $this->Search->getConditions();
		
		$conditions = array_merge($conditions, $this->searchConditions);

		$items = $this->paginate($conditions);
    
		$section = Inflector::humanize($this->request->controller);

		$config = $this->Entity->entityConfig(Inflector::singularize(Inflector::camelize($this->request->controller)), "Index");
		
		$title = isset($config["Title"]) ? $config["Title"] : $section;
		
		$this->set(compact("title", "items"));
	}

	/**
	* Convenience function, to be overrided by specific controllers, but just in case (as with the usermgmt plugin)
	* @param uuid $id
	* 
	*/
	public function view($id = null) {
		if (!$id) {
			$this->autoRender = false;
			return;
		}
		$model = Inflector::singularize($this->name);
		
		$item = $this->$model->read(null, $id);
		
		if ($item === false) {
			$this->autoRender = false;
			return;
		}
		
		if (isset($this->request->params['named']['mode'])) {
			$this->set("mode", $this->request->params['named']['mode']);
		}
		$this->set("item", $item);
	}
	
	public function form($id = null) {
		$model = Inflector::singularize($this->name);
		
		if ($this->request->is('post') || $this->request->is('put')) {
			// if there is no basePath variable, just redirect to the index as always
			// but if there is, and it's an ajax request, just reload the form and set the appropriate mode 
			// for the request based on the modelScope and basePath, and do not save but only validate
			if (isset($this->request->params["named"]["basePath"])) {
				// validate the data
				$result = null;
				if (!empty($this->request->params["named"]["basePath"])) {
					$parent = Entity::parentPathClass();
					$associationAlias = Entity::currentPathName();
					
					// get the config for this association
					$parentConfig = Entity::entityConfig($parent, "Associations", $associationAlias);
					
					// get the association type for the association
					$obj = Entity::getModel($parent);
					$associations = $obj->getAssociated();
				}
				
				$validate = true;
				if (isset($associations) && in_array($associations[$associationAlias], array("hasMany", "hasAndBelongsToMany"))) {
					foreach($this->request->data[$model] as $index => &$value) {
						$validate = $validate && $this->$model->saveAll($value, array('validate' => 'only', 'deep' => true));
						$validationErrors[$index] = $this->$model->validationErrors;
					}
					$this->$model->validationErrors = $validationErrors;
				} else {
					$validate = $this->$model->saveAll($this->request->data, array('validate' => 'only', 'deep' => true));
				}
				
				if ($validate) {
					// it's right, set the mode 
					// get the other end of the association
					if (isset($parentConfig)) {
						$mode = $parentConfig["mode"];
						$template = Inflector::underscore($associations[$associationAlias]);
					} else {
						$mode = "default";
						$template = $this->request->params["named"]["template"];
					}
				}
			} else {
				// process data for __ajax_deleted variables 
				Entity::deleteAjaxDeleted($this->request->data);
				
				// untranspose data so normal cake save functions work as expected
				Entity::unTransposeData($this->request->data);
				
				if ($this->$model->saveAll($this->request->data, array('deep' => true))) {
					if ($this->formSuccessRedirect) {
						$this->redirect("index");
					}
				}
				
			}
		} elseif ($id) {
			$this->request->data = Entity::transposeData($this->$model->read(null, $id));
		}
		
		if (isset($this->request->params['named']['mode'])) {
			$this->set("mode", $this->request->params['named']['mode']);
		} elseif (isset($mode)) {
			$this->set("mode", $mode);
		}
		
		if (isset($this->request->params['named']['template'])) {
			$this->set("template", $this->request->params['named']['template']);
		} elseif (isset($template)) {
			$this->set("template", $template);
		}

	}

	public function delete($id = null) {
	  
		$model = Inflector::singularize($this->name);
		$modelLowerCase = strtolower($model);
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->$model->id = $id;
		if (!$this->$model->exists()) {
			throw new NotFoundException(__("$model inválido"));
		}
		if ($this->$model->delete()) {      
			$this->Session->setFlash(__("Se eliminó el $modelLowerCase"));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__("No se pudo eliminar el $modelLowerCase"));
		$this->redirect(array('action' => 'index'));
	}

}
