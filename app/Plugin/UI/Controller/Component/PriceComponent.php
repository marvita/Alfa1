<?php

App::uses('Component', 'Controller');

/**
 * Price Component.
 *
 * Wrapper for the price library functions
 *
 * @package       Cake.Controller.Component
 * @link http://book.cakephp.org/2.0/en/core-libraries/components/cookie.html
 *
 */
class PriceComponent extends Component {
	public function AlterValue($value, $scope, $userid, $order, $paymentid, $action) {
		return Price::AlterValue($this, $value, $scope, $userid, $order, $paymentid, $action);
	}
}
