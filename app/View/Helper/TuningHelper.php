<?
App::uses('AppHelper', 'View/Helper');

class TuningHelper extends AppHelper {
	public $helpers = array("Html");
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		
		$this->Html->css('alfa1argentina', array("block" => "blockcss"));
	}
}
