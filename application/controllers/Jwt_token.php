<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/Jwt_creator.php';

class Jwt_token extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->objOfJwt = new Jwt_creator();
		header('Content-Type: application/json');
	}

	public function index()
	{
		$this->LoginToken();
	}

	/*************Ganerate token this function use**************/

	public function LoginToken()
	{
		$tokenData['uniqueId'] = '11';
		$tokenData['role'] = 'alamgir';
		$tokenData['timeStamp'] = Date('Y-m-d h:i:s');
		$jwtToken = $this->objOfJwt->GenerateToken($tokenData);
		echo json_encode(array('Token'=>$jwtToken));
	}

	/*************Use for token then fetch the data**************/

	public function GetTokenData()
	{
		$received_Token = $this->input->request_headers('Authorization');
		try
		{
			$jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
			echo json_encode($jwtData);
		}
		catch (Exception $e)
		{
			http_response_code('401');
			echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
		}
	}
}
