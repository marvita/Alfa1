<?
App::uses('JsHelper', 'View/Helper');

class UIJsHelper extends JsHelper {
	public $helpers = array('Html' => array("className" => "UI.UIHtml"), 'Form' => array("className" => "UI.UIForm"), 'UserMgmt.UserAuth','UI.Menu');
	
	public function __construct(View $View, $settings = array()) {
		if ( is_array($settings) && !isset($settings[0]) )
			$settings[0] = 'UI.JqueryUI';
		
		parent::__construct($View, $settings);
		
		$this->Html->script('UI.Utils/utilities', array("block" => "blockscripts"));
	}
	
	public function currentContext() {
		$context = $this->_View->getVar("context");
				
		//pr($this->_View->getVars());
		if ($context) {
			return substr($context, strrpos($context, ";")+1);
		} else {
			return Configure::read("UI.rootContext") ? Configure::read("UI.rootContext") : "#content";
		}
	}
	
	public function parentContext() {
		$context = $this->_View->getVar("context");
				
		//pr($this->_View->getVars());
		if ($context) {
			$context = substr($context, 0, strrpos($context, ";"));
			return substr($context, strrpos($context, ";")+1);
		} else {
			return Configure::read("UI.rootContext") ? Configure::read("UI.rootContext") : "#content";
		}
	}
	
	public function rootContext() {
		return Configure::read("UI.rootContext") ? Configure::read("UI.rootContext") : "#content";
	}
	
	public function popup($title, $url = null, $options = array()) {
		$contextId = "context-id-".rand(100000000,999999999);
		$context = $this->_View->getVar("context").";.$contextId";
		if (is_string($url)) {
			if (strpos($url, "/") === false) {
				$url = array("action" => $url);
			} else {
				$url = Router::parse($url);
			}
		}
		$url["context"] = $context;
		
		//$options["update"] = ".popup.$contextId";
		if (!isset($options["before"])) $options["before"] = "";
		$options["before"] .= "if(\$('.popup').length == 0) { $('.ajaxloading').dialog({modal: true}); }  $('.ajaxloading').after('<div class=\\'popup $contextId\\'></div>');";
		
		// ok option allows to disable or change the text of the popup ok button
		if (isset($options["ok"]) && $options["ok"] ) {
			$okText = __("Aceptar");
			if (is_string($options["ok"])) {
				$okText = $options["ok"];
			}
			// TODO(3): escape the oktext for javascript inclusion
			$buttons = "buttons:[{text: '$okText',click: function(){\$(this).dialog('close');}}],";
		} else {
			$buttons = "";
		}
		
		// width and height options allows to change the default width of the popup dialog
		$openText = "";
		$widthText = "";
		$heightText = "";
		if (isset($options["width"]) && is_numeric( $options["width"] )) {
			$width = intval($options["width"]);
			$widthText = "width: $width,";
		} elseif (isset($options["width"]) && substr(trim($options["width"]), -1) == "%") {
			// proportional width, we have to add some events that set the popup width and height
			$widthValue = substr(trim($options["width"]), 0, -1);
			$openText .= "$('.$contextId').dialog('option', { width: $(document).width() * $widthValue / 100 });";
		}
		
		if (isset($options["height"]) && is_numeric( $options["height"] )) {
			$height = intval($options["height"]);
			$heightText = "height: $height,";
		} elseif (isset($options["height"]) && substr(trim($options["height"]), -1) == "%") {
			// proportional height, we have to add some events that set the popup width and height
			$heightValue = substr(trim($options["height"]), 0, -1);
			$openText .= "$('.$contextId').dialog('option', { height: $(window).height() * $heightValue / 100, position: [ false, 10] });";
		}
		if ($openText != "") {
			$openText = "open: function(event, ui) { $openText";
			$openText .= "$('.$contextId').dialog('option', { position: ['center', 'center'] }); },";
		}
		
		unset($options["width"]);
		unset($options["height"]);
		
		/*$classTextPre = "$('.popup.$contextId').addClass('{$options["dialogclass"]}');";
		$classTextPost = "$('.popup.$contextId').removeClass('{$options["dialogclass"]}');";*/
			
		// jquery ui dialog options
		// string options
		$dialogOptions = "";
		foreach (array("dialogClass") as $opt) {
			if (isset($options[$opt])) {
				$dialogOptions .= "$opt: '{$options[$opt]}', ";
				
				unset($options[$opt]);
			}
		}
		
		// true false options
		foreach (array("draggable", "resizable") as $opt) {
			if (isset($options[$opt])) {
				$val = $options[$opt] ? "true" : "false";
				$dialogOptions .= "$opt: {$val}, ";
				
				unset($options[$opt]);
			}
		}
		
		
		//$options["complete"] = "$classTextPre \$('.popup.$contextId').dialog({{$buttons} {$widthText} {$openText} {$dialogClass} focus: function(event, ui) { \$('.popup').parent().removeClass('ui-focus'); \$(this).parent().addClass('ui-focus'); },close: function() { $classTextPost \$('.popup.$contextId').remove(); if($('.popup').length == 0) { \$('.ajaxloading').dialog('close'); } }}); return false;"; 
		$options["complete"] = "\$('.popup.$contextId').dialog({{$buttons} {$widthText} {$openText} {$dialogOptions} focus: function(event, ui) { \$('.popup').parent().removeClass('ui-focus'); \$(this).parent().addClass('ui-focus'); },close: function() { \$('.popup.$contextId').remove(); if($('.popup').length == 0) { \$('.ajaxloading').dialog('close'); } }}); return false;"; 
		return $this->link($title, $url , $options );
	}
	
	public function link($title, $url = null, $options = array()) {
		if (!$this->Menu->hasAccess($url)) return "";
		if (is_array($url) && !isset($url["context"])) {
			$url["context"] = $this->_View->getVar("context");
		}
		
		if (!isset($options["update"])) {
			$options["update"] = substr($url["context"], strrpos($url["context"], ";")+1);
		} elseif ($options["update"] === false) {
			unset($options["update"]);
		}
		
		if (!isset($options["before"])) {
			$options["before"] = "";
		}
		$options["before"] .= "; if(\$('.popup').length == 0) { $('.ajaxloading').dialog({modal: true}); } ";
		
		if (!isset($options["complete"])) {
			$options["complete"] = "";
		}
		$options["complete"] .= "; if(\$('.popup').length == 0) { \$('.ajaxloading').dialog('close'); } ";
		
		if (isset($options["return"])) {
			if ($options["return"]) {
				$options["complete"] .= "return true;";
			} else {
				$options["complete"] .= "return false";
			}
		}
		
		if (is_array($url) && isset($url["?"])) {
			$url["?"] = str_replace("&amp;", "&", http_build_query($url["?"]));
		}
		
		return parent::link($title, $url , $options );
		
	}
	
	public function submit($title, $options = array()) {
		// TODO: successContext and errorContext are properly set after a redirect() (defined in UIAppController)
		// that is dangerous, we need to set the context when delivering the response and then propagate the resulting
		// context when calling redirect...
		if (!isset($options["update"])) {
			// context is taken from 'context' view var, that is set in UIAppController's beforeFilter from the named parameter
			$context = $this->_View->getVar("context");
			
			//pr($this->_View->getVars());
			if ($context) {
				$curcontext = substr($context, strrpos($context, ";")+1);
				
				// ajax submits should update parent of current context in case of success, and current context in case of error
				$previouscontext = substr($context, 0, strrpos($context, ";"));
				$parentcontext = substr($previouscontext, strrpos($previouscontext, ";") + 1);
				
				if ($parentcontext != "") {
					$update = $curcontext;
					$options["url"]["submitSuccessContext"] = $previouscontext;
					$options["url"]["submitErrorContext"] = $context;
				} else {
					$options["url"]["submitErrorContext"] = $options["url"]["submitSuccessContext"] = $update = ( Configure::read("UI.rootContext") ? Configure::read("UI.rootContext") : "#content" );
				}
				
				$options["update"] = $update;
			}
		} else {
			// if update option is set, perform the usual update (developer knows why he wants it...)
			$context = $this->_View->getVar("context");
			
			$options["url"]["context"] = $context;
			//pr($this->_View->getVars());
			if ($context) {
				$curcontext = substr($context, strrpos($context, ";")+1);
			}
		}
		
		// add entity form wrapping data to url
		if (isset($this->request->params["named"]["basePath"])) {
			$options["url"]["basePath"] = $this->request->params["named"]["basePath"];
			
			// change the copy function, append the contents to the correct place based on the path
			$selector = Entity::currentPathSelector();
			
			// get append function from object config
			$config = Entity::entityConfig(Entity::parentPathName(), "Associations", Entity::currentPathName());
			$addfunc = $config["addOrder"];
			$successCopyFunction = "\$('.popup$curcontext > *').each(function() { \$('$selector').$addfunc(unwrapForm($(this))); }); incIdx('$selector'); ";
			//$successCopyFunction = "";
		} else {
			$successCopyFunction = "\$('$parentcontext > *').remove(); \$('.popup$curcontext > *').appendTo('$parentcontext'); ";
		}
		if (isset($this->request->params["named"]["modelScope"])) $options["url"]["modelScope"] = $this->request->params["named"]["modelScope"];
		
		if (!isset($options["before"])) {
			$options["before"] = "";
		}
		$options["before"] .= "; if(\$('.popup').length == 0) { \$('.ajaxloading').dialog({modal: true}); } ";
		
		if (!isset($options["complete"])) {
			$options["complete"] = "";
		}
		
		// $update is set only if there's no 'update' option, and that means that the standard error and success contexts are used for
		// content update destination for each situation (it's a tricky condition, may need cleaner code...)
		if (!isset($update)) {
			if ($options["update"] != $this->currentContext() && ( !isset($options["keepPopup"]) || !$options["keepPopup"]) ) {
				$options["complete"] .= "; \$('.popup$curcontext').remove(); if ( \$('.popup').length == 0) { \$('.ajaxloading').dialog('close'); }";
			} else {
				$options["complete"] .= ";";
			}
			
		} else {
			// implement updating parent or same in case of error copying html data
			$options["complete"] .= "; if (!validationError) { $successCopyFunction \$('.popup$curcontext').remove(); if ( \$('.popup').length == 0) { \$('.ajaxloading').dialog('close'); } }";
		}
		
		
		//$options["success"] = "alert('success ' + validationError); if (validationError) { $('$curcontext').html(data); } else { $('$update').html(data); }; return;";
		return parent::submit($title, $options );
	}
	
	public function contextElement($element, $values = array(), $options = array()) {
		$contextId = "context-id-".rand(100000000,999999999);
		$context = $this->_View->getVar("context");
		$this->_View->set("context", $context.";.$contextId");
		
		$options = array_merge(array("tag" => "div", "class" => "context", "id" => ""), $options);
		
		foreach (array("tag", 'class', 'id') as $key) {
			$$key = $options[$key];
			unset ($options[$key]);
		}
		
		$element = "<$tag id='$id' class='$class $contextId'>" . 
			$this->_View->element($element, $values, $options) .
			"</$tag>";
		
		$this->_View->set("context", $context);
			
		return $element;
	}
	
	public function beforeRender($viewFile) {
		parent::beforeRender($viewFile);
		
		$this->Html->script("UI.JQuery/clearme-1.0.1.min", array("block" => "blockscripts"));
		$this->Html->script("UI.Utils/utilities", array("block" => "blockscripts"));
	}
}