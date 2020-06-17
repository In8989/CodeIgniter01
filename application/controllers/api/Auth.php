<?php

use chriskacerguis\RestServer\RestController;
require APPPATH.'libraries/Jwt_creator.php';
require APPPATH.'libraries/Auth_creator.php';

class Auth extends RestController
{
	private $is_auth;
	private $jwt_auth;
	private $Jwt_create;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->Jwt_create = new Jwt_creator();
		$this->jwt_auth = new Auth_creator();
//		$this->output->enable_profiler(true);
	}

	// GET
	public function index_get()
	{

		$received_Token = $this->input->get_request_header('Token');

		$this->is_auth = $this->jwt_auth->auth_get($received_Token);

		if (!$this->is_auth) {
			echo '인증실패';
		} else {
			echo '인증성공';
//			print_r($this->is_auth);	// token 내용
		}

	}

	public function index_post($type)
	{
		if ($type  == 'signin') {
			// form 검증
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id','id', 'trim|required|max_length[10]');
			$this->form_validation->set_rules('pw','pw', 'trim|required|max_length[10]');
			$this->form_validation->set_data($this->post());
			if($this->form_validation->run() === FALSE){
				$this->response("validation_false", RestController::HTTP_OK, FALSE, validation_errors(), $this->form_validation->error_array());
				return;
			}

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
				$data['exp'] = strtotime('+1 hours');	// 1시간 뒤 만료



//				print_r($data); //배열보기

				$data = $this->Jwt_create->GenerateToken($data);
				$this->response($data, 200);
			} else {
				$this->response('false', 404);
			}

		} else if ($type == 'signup') {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_id','user_id','trim|required|is_unique[users.user_id]|max_length[20]|alpha_numeric');
			$this->form_validation->set_rules('user_pw','user_pw','trim|required|min_length[4]');
			$this->form_validation->set_rules('user_name','user_name','trim|required|max_length[20]|korean_alpha_dash');
			$this->form_validation->set_rules('email','email','trim|required|valid_email');
			$this->form_validation->set_data($this->post());
			if($this->form_validation->run() === FALSE){
				$this->response($this->form_validation->error_array(), RestController::HTTP_OK, FALSE);
				return;
			}

			$user_id = $this->post('user_id');
			$user_pw = $this->post('user_pw');
			$user_name = $this->post('user_name');
			$email = $this->post('email');

			$data = array(
				'user_id' => $user_id,
				'user_pw' => $user_pw,
				'user_name' => $user_name,
				'email' => $email
			);

			$insert_id = $this->db->insert('users',$data);

			if($insert_id){
				$this->response('true', 200);
			}else{
				$this->response('false', 404);
			}
		}
	}


	public function index_put()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_pw','user_pw','trim|required|min_length[4]');
		$this->form_validation->set_rules('user_name','user_name','trim|required|max_length[20]|korean_alpha_dash');
		$this->form_validation->set_rules('email','email','trim|required|valid_email');
		$this->form_validation->set_data($this->put());

		if($this->form_validation->run() === FALSE){
			$this->response($this->form_validation->error_array(), RestController::HTTP_OK, FALSE);
			return;
		}

		$user_id = $this->post('user_id');
		$user_pw = $this->put('user_pw');
		$user_name = $this->put('user_name');
		$email = $this->put('email');

		$data = array(
			'user_pw' => $user_pw,
			'user_name' => $user_name,
			'email' => $email
		);

		if($data) {
			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data);
			$this->response('',200);
		}else{
			$this->response('',404);
		}


	}

	public function index_delete()
	{
		$id=$this->delete('id');

		$this->db->where('id', $id);
		$this->db->delete('users');
	}

}
