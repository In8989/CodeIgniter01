<?php

require_once APPPATH.'libraries/Jwt_creator.php';
class Auth_creator
{

	private $Jwt_create;

	public function __construct()
	{

		$this->Jwt_create = new Jwt_creator();
	}

	public function auth_get($received_Token)
	{
		//CI 불러오기
		$CI =& get_instance();

		//$received_Token = $CI->input->get_request_header('Token');
		try
		{
			$jwtData = $this->Jwt_create->DecodeToken($received_Token);
			return json_encode($jwtData);
		}
		catch (Exception $e)
		{
//			http_response_code('401');
			return false;
		}
	}

}
