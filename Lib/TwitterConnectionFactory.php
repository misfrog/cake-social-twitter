<?php
App::uses('ConnectionFactory', 'Social.Lib');

/**
 * Twitter Connection Factory
 */
class TwitterConnectionFactory implements ConnectionFactory {
	
	public function createConnection($data) {
		$connection = array(
			'access_token' => $data['auth']['credentials']['token'],
			'display_name' => $data['auth']['info']['nickname'],
			'expire_time' => 'expire_time',	// TODO
			'image_url' => $data['auth']['info']['image'],
			'provider_id' => $data['auth']['provider'],
			//'provider_user_id' => $data['auth']['raw']['id_str'],
			'provider_user_id' => $data['auth']['uid'],
			'rank' => 'rank',			// TODO
			'refresh_token' => 'refresh_token',	// TODO
			'secret' => $data['auth']['credentials']['secret'],
			'user_id' => ''
		);
		
		return $connection;
	}
}