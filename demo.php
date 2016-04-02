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

error_reporting(E_ALL);
require('hashnest.php');

// please fill up these configurations to test your api access
$username = 'Username';
$api_key = 'api-key';
$api_secret = 'api-secret';

$hashnest = new hashnest($username, $api_key, $api_secret);

$account = $hashnest->account();
echo '<h1>$hashnest->account();</h1>';
echo '<pre>'.print_r($account, true).'</pre>';

echo '<hr>';

$currency_accounts = $hashnest->currency_accounts();
echo '<h1>$hashnest->currency_accounts();</h1>';
echo '<pre>'.print_r($currency_accounts, true).'</pre>';

echo '<hr>';

$hash_accounts = $hashnest->hash_accounts();
echo '<h1>$hashnest->hash_accounts();</h1>';
echo '<pre>'.print_r($hash_accounts, true).'</pre>';
