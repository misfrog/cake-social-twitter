<?php
//App::uses('tmhOAuth', 'Vendor/opauth/twitter/Vendor/tmhOAuth');
App::import('Vendor', 'tmhOAuth', array ('file' => 'opauth/twitter/Vendor/tmhOAuth/tmhOAuth.php'));

/**
 * Twitter Component
 *
 * @property Session $Session
 * @property Social.Connection $Connection
 */
class TwitterComponent extends Component {
	
	public $components = array('Session', 'Social.Connection');
	
	public function api($method, $url, $params = null) {
		$config = Configure::read('Opauth.Strategy.Twitter');
		
		$tmhOAuth = new tmhOAuth(
			array(
				'consumer_key' => $config['key'],
				'consumer_secret' => $config['secret'],
				'user_token' => $this->Session->read('Auth.Twitter.access_token'),
				'user_secret' => $this->Session->read('Auth.Twitter.secret'),
				'curl_ssl_verifypeer' => false
			)
		);
		
		$url = $tmhOAuth->url($url);
		
		$status = $tmhOAuth->request($method, $url, $params);
		
		if ($status != 200) {
			return false;
		}
		
		if (strpos($url, '.json') !== false) {
			$response = json_decode($tmhOAuth->response['response']);
		} else {
			$response = $tmhOAuth->extract_params($this->tmhOAuth->response['response']);
		}
		
		return $response;
	}
}
