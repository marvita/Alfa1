<?
App::uses('AppHelper', 'View/Helper');

class EntityHelper extends AppHelper {
	public $helpers = array('Notifier', 'Session', 'Html' => array('className' => 'UI.UIHtml'), 'Form' => array('className' => 'UI.UIForm'), 'Js' => array('className' => 'UI.UIJs'), 'Usermgmt.UserAuth');
	
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		
	}
	
	public function __call($name, $arguments) {
		return call_user_func_array(array("Entity", $name), $arguments);
	}
	
	public function view($alias, $template = "", $mode = "", $data = array(), $options = array()) {
		return $this->_element($alias, "view", $template, $mode, $data, $options);
	}
	
	public function form($alias, $template = "", $mode = "", $data = array(), $options = array()) {
		return $this->_element($alias, "form", $template, $mode, $data, $options);
	}
	
	public function index($alias, $template = "", $mode = "", $data = array(), $options = array()) {
		return $this->_element($alias, "index", $template, $mode, $data, $options);
	}
	
	protected function _element($alias, $action, $template = "", $mode = "", $data = array(), $options = array()) {
		if (!isset($options["setPath"]) || $options["setPath"]) {
			$this->_setEntityPath($alias);
			$model = $this->currentPathClass();
		} else {
			$model = $alias;
		}
		
		if ($template) $template = "-$template";
		$dashmode = $mode ? "-$mode" : $mode;
		
		$name = false;
		if ($mode) $name = $this->_getElementPath("", "$action$template$dashmode", Inflector::pluralize($model), "", $plugin, true);
		if (!$name && $template) $name = $this->_getElementPath("", "$action$template", Inflector::pluralize($model), "", $plugin, true);
		if (!$name) $name = $this->_getElementPath("", $action, Inflector::pluralize($model), "", $plugin, true);
		
		if (!$name) {
			trigger_error(__d('cake_dev', 'Element Not Found: %s', "$action ->" . ($template ? " $template -> " : "") . ( $mode ? " $dashmode -> " : "" ) . Inflector::pluralize($model) ), E_USER_NOTICE);
			return "";
		}

		// TODO: why is this hardcoded?
		if ($plugin) {
			$name = "UI." . $name;
		}
		
		$data["model"] = $model;
		$data["mode"] = $mode;
		$data["options"] = $options;

		$element = $this->_View->element($name, $data);
		
		if (!isset($options["setPath"]) || $options["setPath"])
			$this->_revertEntityPath();
		
		return $element;
	}
	
	
	public function field($field, $mode = null, $options = array()) {
		/* get action from request if there is no option that override it*/
		if (isset($options['action'])) {
			$action = $options['action'];
			unset($options['action']);
		} else {
			$action = $this->request->action;
		}
		
		switch ($action) {
			case "form":
				return $this->formField($field, $mode, $options);
			break;
			
			case "view":
			default:
				return $this->viewField($field, $mode, $options);
			break;
		}
	}
	
	
	public function formField($field, $mode = "", $options) {
		if (strstr($field, ".")) {
			list ($model, $key) = explode(".", $field);
		} else {
			$model = Inflector::camelize(Inflector::singularize($this->request->params["controller"]));
			$key = $field;
		}
		
		// use a field template element
		$options["label"] = $this->fieldLabel($field);

		$action = "form";
		
		if ($mode) {
			$dashmode = "-$mode";
		} else {
			$dashmode = "";
		}
		
		if (!isset($options["type"])) {
			$type = $this->fieldType($field);
		}

		extract($options);
		
		$fieldHierarchy = array($key . $dashmode, $type . $dashmode);
		$elementPath = $this->_getElementPath('Fields', $fieldHierarchy, "form", $this->currentPathClass(), $plugin);
		if (!$elementPath) {
			$fieldHierarchy = array($mode ? $mode : "default");
			$elementPath = $this->_getElementPath('Fields', $fieldHierarchy, "form", $this->currentPathClass(), $plugin);
		}
		
		if ($elementPath === false) {
			trigger_error(__d('cake_dev', 'Element Not Found: %s', "Fields -> ($key$dashmode, $type$dashmode, ".($mode ? $mode : "default")." ->" .  $this->currentPathClass() ), E_USER_NOTICE);
			return "";
		}
		
		return $this->_View->element($elementPath, compact("field", "action", "options", "mode", "type"), array("plugin" => $plugin ? "UI" : false));
	}
	
	public function viewField($field, $mode = "") {
		// use a field template element
		$value = $this->fieldValue($field);
		$label = $this->fieldLabel($field);
		
		if (strstr($field, ".")) {
			list ($model, $key) = explode(".", $field);
		} else {
			$model = Inflector::camelize(Inflector::singularize($this->request->params["controller"]));
			$key = $field;
		}
		
		$action = "view";
		
		if ($mode) {
			$dashmode = "-$mode";
		} else {
			$dashmode = "";
		}
		
		$fieldHierarchy = array($key . $dashmode, $this->fieldType($field) . $dashmode, $mode ? $mode : "default");
		$elementPath = $this->_getElementPath('Fields', $fieldHierarchy, "view", $this->currentPathClass(), $plugin);
		
		if ($elementPath === false) {
			trigger_error(__d('cake_dev', 'Element Not Found: %s', "Fields -> ($key$dashmode, $type$dashmode, ".($mode ? $mode : "default")." ->" .  $this->currentPathClass() ), E_USER_NOTICE);
			return "";
		}
		
		return $this->_View->element($elementPath, compact("field", "action", "label", 'value'), array("plugin" => $plugin ? "UI" : false));
	}
	

	/**
* Displays a belongs to field in a form, using one of the hierarchical elements
* @param string $field the parent model field pointer on the current model
* @param array $options the options for the field
* 				model: what model to use
* 				alias: what alias this model is called in the association
* 				mode: the file name to use (i.e.: default for default.ctp, multikey for multikey.ctp, etc.)
* 
*/
	public function belongsTo($association, $mode = "", $options = null) {
		/* get action from request if there is no option that override it*/
		if (isset($options['action'])) {
			$action = $options['action'];
			unset($options['action']);
		} else {
			$action = $this->request->action;
		}
		
		//pr($this->request);
		if (is_array($options)) {
			foreach ($options as $key => $value) {
				if (!in_array($key, array("model", "action", "callback"))) {
					unset($options[$key]);
				}
			}
			
			extract($options);
		}
		
		$plugin = false;
		
		if (!isset($model)) {
			$model = Inflector::camelize(Inflector::singularize($this->request->params["controller"]));
		}
		
		App::uses($model, "Model");
			
		$obj = new $model;
		
		//$bt = $obj->getAssociated('belongsTo');
		
		// TODO: manage if association classname is in plugin.class form 
		if ( @ $obj->belongsTo[$association]['className'] && $obj->belongsTo[$association]['className'] != $association ) {
			$alias = $association;
			$association = $obj->belongsTo[$association]['className'];
		}
		
		$config = $this->entityConfig($model, "Associations", $association);
		
		if (is_array($config)) {
			// override config mode with explicit mode
			if ($mode) $config["mode"] = $mode;
			
			// get properties from array
			extract($config);
		}
		
		if (!isset($alias))
			$alias = $association;
		
		$dashmode = $mode ? "-" . $mode : $mode;
		
		// choose the element to use, according to hierarchy
		$path = $this->_getElementPath("Fields", "belongs_to" . $dashmode, $action, $association, $plugin, true);
		
		if ($path === false) $path = $this->_getElementPath("Fields", "belongs_to", $action, $association, $plugin, true);
		
		if ($path === false) {
			trigger_error(__d('cake_dev', 'Element Not Found: %s', "Fields -> $association -> " . Inflector::camelize($action) . " -> belongs_to[$dashmode]"), E_USER_NOTICE);
			return "";
		}
		
		$opts = array();
		if ($plugin) {
			$opts = array("plugin" => $plugin ? "UI" : false);
		}
		
		return $this->Js->contextElement($path, compact("controller", "association", "alias", "mode", "model", "label", "callback"), $opts);
	}
	
	public function hasMany($association, $mode = "", $options = null) {
		/* get action from request if there is no option that override it*/
		if (isset($options['action'])) {
			$action = $options['action'];
			unset($options['action']);
		} else {
			$action = $this->request->action;
		}
		
		//pr($this->request);
		if (is_array($options)) {
			foreach ($options as $key => $value) {
				if (!in_array($key, array("model"))) {
					unset($options[$key]);
				}
			}
			
			extract($options);
		}
		
		$plugin = false;
		
		if (!isset($model)) {
			$model = Inflector::camelize(Inflector::singularize($this->request->params["controller"]));
		}
		
		App::uses($model, "Model");
			
		$obj = new $model;
		
		//$bt = $obj->getAssociated('hasMany');
		
		// TODO: manage if association classname is in plugin.class form 
		$alias = $association;
		if ( @ $obj->hasMany[$association]['className'] && $obj->hasMany[$association]['className'] != $association ) {
			$association = $obj->hasMany[$association]['className'];
		}
		
		$config = $this->entityConfig($model, "Associations", $alias);
		
		if (is_array($config)) {
			// override config mode with explicit mode
			if ($mode) $config["mode"] = $mode;
			
			// get properties from array
			extract($config);
		}
		
		$dashmode = $mode ? "-" . $mode : $mode;
		
		// choose the element to use, according to hierarchy
		$path = $this->_getElementPath("Fields", "has_many$dashmode", $action, $association, $plugin, true);
		
		if ($path == "") $path = $this->_getElementPath("Fields", "has_many", $action, $association, $plugin, true);
		
		if ($path === false) {
			trigger_error(__d('cake_dev', 'Element Not Found: %s', "Fields -> $association -> " . Inflector::camelize($action) . " -> has_many[$dashmode]"), E_USER_NOTICE);
			return "";
		}

		$opts = array();
		if ($plugin) {
			$opts = array("plugin" => $plugin ? "UI" : false);
		}

		return $this->Js->contextElement($path, compact("controller", "association", "alias", "mode", "model", "label", "config"), $opts);
	}
	
	public function hasAndBelongsToMany($association, $mode = "form", $options = null) {
		/* get action from request if there is no option that override it*/
		if (isset($options['action'])) {
			$action = $options['action'];
			unset($options['action']);
		} else {
			$action = $this->request->action;
		}
		
		//pr($this->request);
		if (is_array($options)) {
			foreach ($options as $key => $value) {
				if (!in_array($key, array("model"))) {
					unset($options[$key]);
				}
			}
			
			extract($options);
		}
		
		$plugin = false;
		
		if (!isset($model)) {
			$model = Inflector::camelize(Inflector::singularize($this->request->params["controller"]));
		}
		
		App::uses($model, "Model");
			
		$obj = new $model;
		
		//$bt = $obj->getAssociated('hasMany');
		
		// TODO: manage if association classname is in plugin.class form 
		$alias = $association;
		if ( @ $obj->hasAndBelongsToMany[$association]['className'] && $obj->hasAndBelongsToMany[$association]['className'] != $association ) {
			$association = $obj->hasAndBelongsToMany[$association]['className'];
		}
		
		$config = $this->entityConfig($model, "Associations", $alias);
		
		if (is_array($config)) {
			// override config mode with explicit mode
			if ($mode) $config["mode"] = $mode;
			
			// get properties from array
			extract($config);
		}
		
		$dashmode = $mode ? "-" . $mode : $mode;
		
		// choose the element to use, according to hierarchy
		$path = $this->_getElementPath("Fields", "has_and_belongs_to_many$dashmode", $action, $association, $plugin, true);
		
		if ($path == "") $path = $this->_getElementPath("Fields", "has_and_belongs_to_many", $action, $association, $plugin, true);
		
		if ($path === false) {
			trigger_error(__d('cake_dev', 'Element Not Found: %s', "Fields -> $association -> " . Inflector::camelize($action) . " -> has_and_belongs_to_many[$dashmode]"), E_USER_NOTICE);
			return "";
		}

		$opts = array();
		if ($plugin) {
			$opts = array("plugin" => $plugin ? "UI" : false);
		}

		return $this->Js->contextElement($path, compact("controller", "association", "alias", "mode", "model", "label", "config"), $opts);
	}

	public function hiddenField($key, $type, $section, $fieldConfig, $id = null) {
		$configHidden = isset($fieldConfig[$key]["hide"]) && (
				(is_array($fieldConfig[$key]["hide"]) && in_array($section, $fieldConfig[$key]["hide"]) ) || 
				(is_string($fieldConfig[$key]["hide"]) && ( $fieldConfig[$key]["hide"] == $section ) )
			);
		$hidden = ($type == "virtual") || 
			(substr($key, -3) == "_id") || 
			($key == "id" && !$id) || 
			in_array($key, array('created', 'modified', 'Active', 'active', 'Class', '__ajax_deleted'));
		$shown = isset($fieldConfig[$key]["show"]) && (
				(is_array($fieldConfig[$key]["show"]) && in_array($section, $fieldConfig[$key]["show"]) ) ||
				(is_string($fieldConfig[$key]["show"]) && ( $fieldConfig[$key]["show"] == $section ) )
			);

		return $configHidden || ($hidden && !$shown);
	}
	
	public function traducir($tabla){
    $tr = '';
    
    switch ($tabla){
      case 'SmokingHistory':
        $tr = 'Tabaquismo';
        break;
      case 'AatDetermination':
        $tr = 'Motivo de la determinación de AAT';
        break;       
      case 'ClinicalHistory':
        $tr = 'Historia clínica';
        break;  
      case 'OtherDiagnostic':
        $tr = 'Otros diagnósticos';
        break;    
      case 'ChestTac':
        $tr = 'Datos TC';
        break; 
      case 'CurrentTreatment':
        $tr = 'Tratamiento actual';
        break;  
      case 'SustitutiveTreatment':
        $tr = 'Tratamiento sustitutivo';
        break;   
      case 'PulmonaryStudy':
        $tr = 'Funcionalismo pulmonar';
        break; 
      case 'HepaticEnzyme':
        $tr = 'Enzimas hepáticas';
        break; 
      case 'StGeorgeCuestionnaire':
        $tr = 'Datos cuestionario St. George';
        break;
      case 'WorkingHistory':
        $tr = 'Historia laboral';
        break;  
      case 'BloodSample':
        $tr = 'Muestras sanguíneas';
        break;     
      case 'FinalDate':
        $tr = 'Fecha final';
        break;                                                                                          
    }
    

    
    return $tr;
  }
  
}
