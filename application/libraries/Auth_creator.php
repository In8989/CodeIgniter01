<?php

require_once APPPATH.'libraries/Jwt_creator.php';
class Auth_creator
{

	private $objOfJwt;

	public function __construct()
	{

		$this->objOfJwt = new Jwt_creator();
	}

	public function auth_get()
	{
		//CI 불러오기
		$CI =& get_instance();

		$received_Token = $CI->input->get_request_header('Token');
		try
		{
			$jwtData = $this->objOfJwt->DecodeToken($received_Token);
			return json_encode($jwtData);
		}
		catch (Exception $e)
		{
//			http_response_code('401');
			return false;
		}
	}

}
