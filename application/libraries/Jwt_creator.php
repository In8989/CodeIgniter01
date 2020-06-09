<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;

class Jwt_creator
{
	/*************This function generate token private key**************/
	PRIVATE $key = "1234567890qwertyuiopmnbvcxzasdfghjkl";
	public function GenerateToken($data)
	{
		$jwt = JWT::encode($data, $this->key);
		return $jwt;
	}

	/*************This function DecodeToken token **************/
	public function DecodeToken($token)
	{
		$decoded = JWT::decode($token, $this->key, array('HS256'));
		$decodedData = (array) $decoded;
		return $decodedData;
	}
}
