<?php

App::uses('Component', 'Controller');
App::uses('Entity', "UI.Lib");

class EntityComponent extends Component {
	public function initialize($controller) {
		parent::initialize($controller);
		
		$this->controller = $controller;
		$this->request = $this->controller->request;
		
		Entity::setRequest($this->request);
		
		if (isset($this->request->params['named']['modelScope'])) {
			//pr("seteando modelscope");
			Entity::setModelScope($this->request->params['named']['modelScope'], true);
		}
		
		if (!empty($this->request->params['named']['basePath']) ) {
			//pr("seteando entitypath");
			Entity::_setEntityPath($this->request->params['named']['basePath']);
		}
	}
	
	public function __call($name, $arguments) {
		return call_user_func_array(array("Entity", $name), $arguments);
	}
}

?>