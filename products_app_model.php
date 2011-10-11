<?php

class ProductsAppModel extends AppModel {

/**
 * Internal configuration for the Api
 *
 * @var array
 */
	protected $_ApiConfig = array();
	
/**
 * HttpSocket instance
 *
 * @var HttpSocket
 */
	public $Http;
	
/**
 * Errors returned during the last Paypal call. Keys are: 'code', 'shortMessage', 'longMessage'
 * @var array
 */
	public $paypalErrors = array();

/**
 * Constructor
 *  - Initialize the API configuration
 *
 * TODO Add error messages
 */
	public function __construct($id = false, $table = null, $ds = null) {
		$config = Configure::read('Paypal');
		if (empty($config) || !is_array($config)) {
			debug('ERROR !');
		} elseif (count(array_diff(array_keys($config), array('environment', 'currency', 'email', 'username', 'password', 'signature', 'PaymentsPro'))) != 0) {
			debug('ERROR 2 !');
			debug($config);
			debug(array_diff(array_keys($config), array('environment', 'currency', 'email', 'username', 'password', 'signature', 'PaymentsPro')));
		} else {
			$this->_ApiConfig = array_merge($this->_ApiConfig, $config);
			if (!class_exists('HttpSocket')) {
				App::import('Core', 'HttpSocket');
			}
			$this->Http = new HttpSocket();
			parent::__construct($id, $table, $ds);
		}
	}

/**
 * Perform an API call to Paypal
 *
 * @param string $methodName Name of the API method to call
 * @param array $args Key => Value pairs to be transmitted via the API
 * @return array Response from the server
 */
	protected function _paypalCall($methodName, $args) {
		// Build the query
		$query = array_merge($args, array(
			'METHOD' => $methodName,
			'VERSION' => '51.0',
			'USER' => $this->_ApiConfig['username'],
			'PWD' => $this->_ApiConfig['password'],
			'SIGNATURE' => $this->_ApiConfig['signature']));
		
		// Call Paypal service
		$API_Endpoint = 'https://api-3t.paypal.com/nvp';
		if ($this->_ApiConfig['environment'] == 'sandbox') {
			$API_Endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
		}
		
		$response = $this->Http->post($API_Endpoint, $query);

		// Parse the response
		$result = false;
		if (!empty($response)) {
			$tmp = explode('&', $response);
			if (!empty($tmp)) {
				$result = array();
				foreach($tmp as $value) {
					list($pairName, $pairValue) = explode('=', $value);
					$result[urldecode($pairName)] = urldecode($pairValue);
				}
			}
			unset($tmp);
		}
		return $this->__checkErrors($result);
	}
	
/**
 * Parse a Paypal response looking for errors.
 * If errors are found, the "paypalErrors" attribute is updated and false is returned. otherwise the result is returned.
 *  
 * @param array $result Paypal array formated response
 * @return mixed False if errors were found, the response otherwise
 */
	private function __checkErrors($response) {
		$result = $response;
		$this->paypalErrors = array();
		
		if (isset($response['ACK']) && strtoupper($response['ACK']) == 'FAILURE') {
			$result = false;
			$count = 0;
			while (isset($response['L_SHORTMESSAGE' . $count])) {
				$this->paypalErrors[] = array(
					'code' => $response['L_ERRORCODE' . $count],
					'shortMessage' => $response['L_SHORTMESSAGE' . $count],
					'longMessage' => $response['L_LONGMESSAGE' . $count]);
				$count++;
			}
		}
		return $result;
	}
}

?>