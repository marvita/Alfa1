<?
App::uses('AppHelper', 'View/Helper');

class NotifierHelper extends AppHelper {
	public $helpers = array('Notifier', 'Session', 'Html' => array('className' => 'UI.UIHtml'), 'Form' => array('className' => 'UI.UIForm'), 'Js' => array('className' => 'UI.UIJs'), 'Usermgmt.UserAuth');
	
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		
		$this->Html->css('UI.Notifier/default');
	}
	
	protected function _getNotifierPath($piece, $label, $controller, &$plugin) {
		return $this->_getElementPath("Notifier", $piece, $label, $controller, $plugin);
	}
	
	public function image($file, $label, $controller, $options = array()) {
		$path = $this->_getImagePath($file, $label, $controller, $options);
		return $this->Html->image($path, $options);
	}
	
	public function piece($piece, $label, $controller) {
		$plugin = false;
		
		$path = $this->_getNotifierPath($piece, $label, $controller, $plugin);
		
		return $this->_View->element($path . $piece, compact("controller", "label"), array("plugin" => $plugin ? "UI" : false));
	}
	
	
	
	/* displays the complete notifier widget, the icon, the bubble, and the updater js code */
	public function show($label = "default", $controller = null) {
		$controller = $controller ? $controller : $this->request->params['controller'];
		
		return $this->piece("main", $label, $controller);
	}
	
	public function icon($label = "default", $controller = null) {
		$controller = $controller ? $controller : $this->request->params['controller'];
		
		return $this->piece("icon", $label, $controller);
	}
	
	public function elements($elements = array(), $label = "default", $controller = null) {
		$controller = $controller ? $controller : $this->request->params['controller'];
		
		return $this->piece("elements", $label, $controller);
	}
	
	public function updater($label = "default", $controller = null) {
		$controller = $controller ? $controller : $this->request->params['controller'];
		
		return $this->piece("updater", $label, $controller);
	}
}