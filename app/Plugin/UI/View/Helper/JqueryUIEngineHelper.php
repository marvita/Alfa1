<?php

App::uses('AppHelper', 'View/Helper');
App::uses('JqueryEngineHelper', 'View/Helper');

class JqueryUIEngineHelper extends JqueryEngineHelper {
	/**
 * Callback arguments lists
 *
 * @var string
 */
	protected $_callbackArguments = array(
		'slider' => array(
			'start' => 'event, ui',
			'slide' => 'event, ui',
			'change' => 'event, ui',
			'stop' => 'event, ui'
		),
		'sortable' => array(
			'start' => 'event, ui',
			'sort' => 'event, ui',
			'change' => 'event, ui',
			'beforeStop' => 'event, ui',
			'stop' => 'event, ui',
			'update' => 'event, ui',
			'receive' => 'event, ui',
			'remove' => 'event, ui',
			'over' => 'event, ui',
			'out' => 'event, ui',
			'activate' => 'event, ui',
			'deactivate' => 'event, ui'
		),
		'drag' => array(
			'start' => 'event, ui',
			'drag' => 'event, ui',
			'stop' => 'event, ui',
		),
		'drop' => array(
			'activate' => 'event, ui',
			'deactivate' => 'event, ui',
			'over' => 'event, ui',
			'out' => 'event, ui',
			'drop' => 'event, ui'
		),
		'request' => array(
			'beforeSend' => 'XMLHttpRequest, options',
			'error' => 'XMLHttpRequest, textStatus, errorThrown',
			'success' => 'data, textStatus',
			'complete' => 'XMLHttpRequest, textStatus',
			'xhr' => ''
		)
	);
}
