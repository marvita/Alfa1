<?
App::uses('Helper', 'View');
App::uses("Entity", 'UI.Lib');
App::uses("Assets", 'UI.Lib');

class UIAppHelper extends Helper {
	protected $_elementPaths = array();
	protected $_imagePaths = array();
	protected $_types = array();
	protected $_enumopts = array();
	
	public function setEntity($entity, $setScope = false) {
		parent::setEntity($entity, $setScope);
		
		if ($setScope)
			Entity::setModelScope($entity);
	}
	
	protected function _imagePathExists($base,$notifierImageUrl) {
		if (DS === '\\') {
			$notifierImageUrl = str_replace('/', '\\', $notifierImageUrl);
		}
		
		if ( file_exists($base . $notifierImageUrl) ) {
			 return true;
		}
		
		return false;
	}
	
	protected function _getImagePath($file, $label, $controller, &$options) {
		$notifierPaths = array(
			Inflector::camelize($controller) . "/" . Inflector::camelize($label) . "/",
			Inflector::camelize($controller) . "/",
			Inflector::camelize($label) . "/");
		
		$paths = array();
		
		if (!isset($this->_imagePaths[$controller][$label])) {
			if (!empty($this->theme)) {
				$theme = $this->theme;
				
				foreach ($notifierPaths as $path) {
					$notifierImageUrl = "Notifier/$path" . trim($file, '/');
					
					if (Configure::read('App.www_root')) {
						$paths[] = array(Configure::read('App.www_root') . 'theme' . DS . $this->theme . DS . "img" . DS, $notifierImageUrl);
					}
					
					$paths[] = array(App::themePath($this->theme) . 'webroot' . DS . "img" . DS, $notifierImageUrl);
				}
			}
			
			foreach (array(IMAGES, App::pluginPath("UI") . "webroot" . DS . "img" . DS) as $root) {
				foreach ($notifierPaths as $path) {
					$notifierImageUrl = "Notifier/$path" . trim($file, '/');
					$paths[] = array($root, $notifierImageUrl);
				}
			}
			
			$this->_imagePaths[$controller][$label] = $paths;
		}
		
		foreach($this->_imagePaths[$controller][$label] as $path) {
			if ($this->_imagePathExists($path[0], $path[1])) {
				if ($path[0] == App::pluginPath('UI') . "webroot" . DS . "img" . DS ) $path[1] = "UI.".$path[1];
				
				return $path[1];
			}
		}
		
		return "img/Notifier/icon.png";
	}
	
	protected function _getElementPath($base, $label, $action, $controller, &$plugin, $returnPath = false) {
		if ($base != "") {
			$base = rtrim($base, DS) . DS;
		}
		
		$notifierPaths = array();
		
		if ($controller && $action) $notifierPaths[] = $base . Inflector::camelize($controller) . DS . Inflector::camelize($action) . DS;
		if ($controller) $notifierPaths[] = $base . Inflector::camelize($controller) . DS;
		if ($action) $notifierPaths[] = $base . Inflector::camelize($action) . DS;
		$notifierPaths[] = $base ;
		
		if ( !isset($this->_elementPaths[$base.$controller][$action]) ) {
			$paths = array_merge(App::path('View'), App::path('View', 'UI'));
			
			if (!empty($this->theme)) {
				$themePaths = array();
				foreach ($paths as $path) {
					if (strpos($path, DS . 'Plugin' . DS) === false) {
						$themePaths[] = $path . 'Themed' . DS . $this->theme . DS;
					}
				}
				$paths = array_merge($themePaths, $paths);
			}
			
			$this->_elementPaths[$base.$controller][$action] = $paths;
		}
		
		if (is_array($label)) {
			$returnPath = true;
		} else {
			$label = array($label);
		}
		$search = "";
		/*pr ($this->_elementPaths[$base.$controller][$action] );
		pr($notifierPaths);
		pr($label);*/
		$search = array();
		foreach($this->_elementPaths[$base.$controller][$action] as $path) {
			foreach ($notifierPaths as $spath) {
				foreach ($label as $l) {
					$search[] = $path .  'Elements' . DS . $spath . $l . ".ctp";
					//pr($path .  'Elements' . DS . $spath . $l . ".ctp");
					if (file_exists($path .  'Elements' . DS . $spath . $l . ".ctp")) {
						if (strpos($path, DS . 'Plugin' . DS) !== false) {
							$plugin = true;
						}
						
						if ($returnPath)
							return $spath . $l;
						return $spath;
					}
				}
			}
		}
		
		return false;
	}
	
	public function entityFields($model) {
		if (!isset($this->_types[$model])) {
			$obj = Entity::getModel($model);
			$this->_types[$model] = $obj->getColumnTypes();
			
			foreach ($obj->virtualFields as $key => $field) {
				$this->_types[$model][$key] = "virtual";
			}
		}
		
		return $this->_types[$model];
	}
	
	public function fieldExists($field) {
		// TODO: Generalize this scope obtention method to support depth
		if (strstr($field, ".")) {
			// use the path to get to the data poing
			$fieldParts = explode(".", $field);
			$key = array_pop($fieldParts);
			
			// add the field parts to the entityPath to get the correct model
			Entity::_setEntityPath($fieldParts);
		} else {
			$key = $field;
			$fieldParts = array();
		}
		
		$model = Entity::currentPathClass();
		
		Entity::_revertEntityPath(count($fieldParts));
		
		App::uses($model, "Model");

		// if field is not defined in db, and it's not a defined html helper func, then just print whatever it is
		$types = $this->entityFields($model);
		
		if (@$types[$key] == "virtual") {
			return true;
		} else {
			if (isset($types[$key]))
				return true;
			else
				return false;
		}
	}

	public function fieldLabel($field, $short = false) {
		// TODO: Generalize this scope obtention method to support depth
		if (strstr($field, ".")) {
			// use the path to get to the data poing
			$fieldParts = explode(".", $field);
			$key = array_pop($fieldParts);
			
			// add the field parts to the entityPath to get the correct model
			Entity::_setEntityPath($fieldParts);
		} else {
			$key = $field;
			$fieldParts = array();
		}
		
		$model = Entity::currentPathClass();
		
		Entity::_revertEntityPath(count($fieldParts));
		
		// TODO: Generalize this so to get the model if it's already loaded by previous calls
		App::uses($model, "Model");
		
		if (class_exists($model)) {
			$types = $this->entityFields($model);
		} else {
			return $key;
		}
		
		// if field is not defined in db, and it's not a defined html helper func, then just print whatever it is the key
		if (!isset($types[$key]) ) {
			return $key;
		}
		
		// TODO: load configs using uiapphelper's load model config method
		if (!isset($configs[$model])) {
			try {
				Configure::load($model, "objects");
				$configs[$model] = Configure::read("$model.Fields");
			} catch (Exception $e) {
				$configs[$model] = array();
			}
		}
		
		if (@is_string($configs[$model][$key])) {
			return $configs[$model][$key];
		} elseif (@is_array($configs[$model][$key]) && isset($configs[$model][$key]['label'])) {
			if ($short && isset($configs[$model][$key]['shortLabel']))
				return $configs[$model][$key]['shortLabel'];
			else
				return $configs[$model][$key]['label'];
		} else {
			return Inflector::humanize(Inflector::underscore($key));
		}
	}
	
	public function fieldType($field) {
		// TODO: Generalize this scope obtention method to support depth
		if (strstr($field, ".")) {
			// use the path to get to the data poing
			$fieldParts = explode(".", $field);
			$key = array_pop($fieldParts);
			
			// add the field parts to the entityPath to get the correct model
			Entity::_setEntityPath($fieldParts);
		} else {
			$key = $field;
			$fieldParts = array();
		}
		
		$model = Entity::currentPathClass();
		
		Entity::_revertEntityPath(count($fieldParts));
		
		App::uses($model, "Model");
		
		$modelConf = $this->entityConfig($model, "Fields", $key);
			
		if (is_array($modelConf) && isset($modelConf['type'])) {
			return $modelConf['type'];
		}
		
		if ($key == $this->primaryKey($model)) {
			return "primary";
		}

		// if field is not defined in db, and it's not a defined html helper func, then just print whatever it is
		$types = $this->entityFields($model);
		
		if (@$types[$key] == "virtual") {
			$type = "text";
		} else {
			if (isset($types[$key]))
				$type = $types[$key];
			else
				$type = "text";
		}
		
		if (substr($type, 0, 5) == "enum(") {
			$this->_enumopts[$key] = explode("','", substr($type, 6, -2));
			$type = "enum";
		}
		
		return $type;
	}
	
	public function enumOpts($field) {
		if (isset($this->_enumopts[$field])) {
			return $this->_enumopts[$field];
		}
	}

	// returns the parameter's model primary key
	public function primaryKey($class = null) {
		if (!$class) {
			$class = $this->currentPathClass();
		}
		
		$model = ClassRegistry::init($class);
		if ($model) {
			return $model->primaryKey;
		}

		return $this->Form->primaryKey();
	}

	public function fieldValue($field, $data = false, $setPath = true, $view = false) {
		// TODO: Generalize this scope obtention method to support depth
		if (strstr($field, ".") ) {
			// use the path to get to the data poing
			$fieldParts = explode(".", $field);
			$key = array_pop($fieldParts);
			
			// add the field parts to the entityPath to get the correct model
			Entity::_setEntityPath($fieldParts);
		} else {
			$key = $field;
			$fieldParts = array();
		}

		list($plugin, $model) = pluginSplit(Entity::currentPathClass());
		
		// TODO: Generalize this so to get the model if it's already loaded by previous calls
		if ($plugin) {
			App::uses($model, $plugin . ".Model");
		} else {
			App::uses($model, "Model");
		}
		
		if (class_exists($model)) {
			$types = $this->entityFields($model);
		} else {
			Entity::_revertEntityPath(count($fieldParts));
			return $key;
		}
		
		// if field is not defined in db, and it's not a defined html helper func, then just print whatever it is the key
		if (!isset($types[$key]) ) {
			Entity::_revertEntityPath(count($fieldParts));
			return $key;
		}
		
		// TODO: load configs using uiapphelper's load model config method
		if (!isset($configs[$model])) {
			try {
				Configure::load($model, "objects");
				$configs[$model] = Configure::read("$model.Fields");
			} catch (Exception $e) {
				$configs[$model] = array();
			}
			
		}
		
		if (!isset($configs[$model][$key])) {
			$conf = $key;
		} else {
			$conf = $configs[$model][$key];
		}
		
		$value = null;
		
		if (empty($data))
			$data = $this->request->data;
		
		if (($result = Entity::getDataValue($data)) == false) {
			if (!empty($this->request->data))
				$result = &$this->request->data[$model];
			elseif (!empty($data[$model])) {
				$result = $data[$model];
			} else {
				$result = array();
			}
		}
		
		if (isset($result[$key])) {
			$value = $result[$key];

			if (is_array($conf) && isset($conf["printFunc"]) && $view) {
				$value = call_user_func("Assets::".$conf["printFunc"], $value);
			}
                        
		}
		
		if (is_array($conf)) {
			// get properties from array
			extract($conf);
		}
		
		Entity::_revertEntityPath(count($fieldParts));
		
		return $value;
	}

	public function associationValue($association) {
		// TODO: Generalize this scope obtention method to support depth
		if (strstr($association, ".")) {
			// use the path to get to the data poing
			$fieldParts = explode(".", $association);
			$key = array_pop($fieldParts);
			
			// add the field parts to the entityPath to get the correct model
			$this->_setEntityPath($fieldParts);
		} else {
			$key = $association;
			$fieldParts = array();
		}
		
		list($plugin, $model) = pluginSplit($this->currentPathClass());
		
		// TODO: Generalize this so to get the model if it's already loaded by previous calls
		if ($plugin) {
			App::uses($model, $plugin . ".Model");
		} else {
			App::uses($model, "Model");
		}
		
		if (class_exists($model)) {
			$obj = Entity::getModel($model);
			$associations = $obj->getAssociated();
		} else {
			$this->_revertEntityPath(count($fieldParts));
			return array();
		}
		
		// if association is not defined in db, then just print whatever it is the key
		if (!isset($associations[$key]) ) {
			$this->_revertEntityPath(count($fieldParts));
			return array();
		}
		
		$value = null;
		
		$data = &$this->request->data;

		if (($result = Entity::getDataValue($data)) == false) {
			$result = &$this->request->data;
		}
		//pr($data);
		$this->_revertEntityPath(count($fieldParts));
		
		if (isset($result[$key]))
			return $result[$key];
		else
			return array();
	}
	
	public function fieldID($field) {
		// TODO: Generalize this scope obtention method to support depth
		if (strstr($field, ".")) {
			// use the path to get to the data poing
			$fieldParts = explode(".", $field);
			$key = array_pop($fieldParts);
			
			// add the field parts to the entityPath to get the correct model
			$this->_setEntityPath($fieldParts);
		} else {
			$key = $field;
			$fieldParts = array();
		}
		
		$fieldId = $this->currentPathID().Inflector::camelize($field);
		
		$this->_revertEntityPath(count($fieldParts));
		
		return $fieldId;
	}
	
	
}

