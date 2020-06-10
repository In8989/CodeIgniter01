<?php

use chriskacerguis\RestServer\RestController;
require APPPATH.'libraries/Jwt_creator.php';
require APPPATH.'libraries/Auth_creator.php';

class Auth extends RestController
{
	private $is_auth;
	private $jwt_auth;
	private $objOfJwt;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->objOfJwt = new Jwt_creator();
		$this->jwt_auth = new Auth_creator();
	}

	// GET
	public function index_get()
	{
//		$received_Token = $this->input->request_headers('Authorization');
//		try
//		{
//			$jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
//			echo json_encode($jwtData);
//		}
//		catch (Exception $e)
//		{
//			http_response_code('401');
//			echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
//		}

		$received_Token = $this->input->get_request_header('Token');

		$this->is_auth = $this->jwt_auth->auth_get($received_Token);

		if (!$this->is_auth) {
			echo 'false';
		} else {
			echo 'ture';

		}

	}

	public function index_post($type)
	{
		if ($type  == 'signin') {
			// form 검증

			$id = $this->post('id');
			$pw = $this->post('pw');

			$this->db->where('id', $id);
			$this->db->where('password', $pw);
			$result = $this->db->get('users');
			if ($result->num_rows()) {
				$user = $result->row();

				$now=time();
				$data = [];
				$data['id'] = $user->id;
				$data['name'] = $user->name;
				$data['email'] = $user->email;
				$data['reg_date'] = $user->reg_date;
				$data['iat'] = $now;	//	현제시간
				$data['exp'] = strtotime('+1 minutes');	// 1분 뒤 만료


//				print_r($data); //배열보기

				$data = $this->objOfJwt->GenerateToken($data);
				$this->response($data, 200);
			} else {
				$this->response('false', 404);
			}

		} else if ($type == 'signup') {

			$id = $this->post('id');
			$pw = $this->post('pw');
			$name = $this->post('name');
			$email = $this->post('email');

			$data = array(
				'id' => $id,
				'password' => $pw,
				'name' => $name,
				'email' => $email
			);

			$this->db->insert('users',$data);

			$this->response('true', 200);
		} else {
			$this->response('false', 404);
		}
	}


	public function index_put()
	{
		$uid = $this->put('uid');
		$id = $this->put('id');
		$pw = $this->put('pw');
		$name = $this->put('name');
		$email = $this->put('email');

		$data=array(
			'id'=>$id,
			'password'=>$pw,
			'name'=>$name,
			'email'=>$email
		);
		if(!$data|!$uid) {
			$this->db->where('uid', $uid);
			$this->db->update('users', $data);
		}

	}

	public function index_delete()
	{
		$id=$this->delete('id');

		$this->db->where('id', $id);
		$this->db->delete('users');
	}


}
