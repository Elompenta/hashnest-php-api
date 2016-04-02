<?php
/*!
 * @author		Sebastian Lutz
 * @copyright 	Baebeca Solutions - Lutz
 * @email		lutz@baebeca.de
 * @pgp			0x5AD0240C
 * @link		https://www.baebeca.de
 * @link-github	https://github.com/Elompenta/hashnest-php-api
 * @customer 	-
 * @project		hashnest-php-api
 * @license		GNU GENERAL PUBLIC LICENSE Version 2
 **/

class hashnest {

	private
		$username,
		$api_key,
		$api_secret;

	// private methods
	function __construct($username, $api_key, $api_secret) {
		$this->username = $username;
		$this->api_key = $api_key;
		$this->api_secret = $api_secret;

		// todo: check if given data is correct

		if (!function_exists('curl_exec')) {
			exit("Error: Please install PHP curl extension to use this Software.\r\n $ apt-get install php5-curl\r\n");
		}
	}

	function __destruct() {
		unset($this->username, $this->api_key, $this->api_secret);
	}

	private function nonce() {
		return round(microtime(true) * 1000);
	}

	private function hmac($nonce) {
		$hmac_data = $nonce.$this->username.$this->api_key;
		$hmac = hash_hmac('sha256', $hmac_data, $this->api_secret);
		return $hmac;
	}

	private function curl($url) {
		// generate api parameters
		$nonce = $this->nonce();
		$signature = $this->hmac($nonce);

		// create curl request
		$post_fields = array(
			'access_key' => $this->api_key,
			'nonce' => $nonce,
			'signature' => $signature
		);

		$post_data = '';
		foreach($post_fields as $key => $value) {
			$post_data.= $key.'='.$value.'&';
		}
		rtrim($post_data, '&');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.hashnest.com/api/v1/'.$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_POST, count($post_fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		#curl_setopt($ch, CURLOPT_HEADER, true);
		// set large timeout because API lak sometimes
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$result = curl_exec($ch);
		curl_close($ch);

		// check if curl was timed out
		if ($result === false) {
			exit('Error: No API connect');
		}


		// validate JSON
		$result_json = json_decode($result);
		if (json_last_error() != JSON_ERROR_NONE) exit('Error: read broken JSON from API - JSON Error: '.json_last_error().' ('.$result.')');

		if (isset($result_json->error)) {
			exit('Error: '.print_r($result_json, true));
		} else {
			return $result_json;
		}

	}

	public function account() {
		return $this->curl('account');
	}

	public function currency_accounts() {
		return $this->curl('currency_accounts');
	}

	public function hash_accounts() {
		return $this->curl('hash_accounts');
	}

}