<?php

use chriskacerguis\RestServer\RestController;
require APPPATH.'libraries/Jwt_creator.php';
require APPPATH.'libraries/Auth_creator.php';

class Board extends RestController
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
		$this->load->library('form_validation');

//		$this->output->enable_profiler(true);
	}

	public function index_get($type)
	{
		if($type == 'list') {
			$this->load->library('pagination');

			$config['base_url'] = '/api/ci_board/page';
			$config['total_rows'] = '/api/ci_board/page';
			$config['per_page'] = '/api/ci_board/page';
			$config['uri_segment'] = 5;

			$this->pagination->initialize($config);

			$this->db->order_by('board_id','desc');
			$get_board = $this->db->get('ci_board');
			$get_board->num_rows();
			$result = $get_board->result_array();

			if ($result) {
				$this->response($result, 200);
			} else {
				$this->response('No record found', 404);
			}
		}

	}

	public function index_post($type)
	{
		if($type == 'write') {
			$table = 'ci_board';
			$user_id = $this->post('user_id');
			$user_name = $this->post('user_name');
			$subject = $this->post('subject');
			$contents = $this->post('contents');

			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
			$data['subject'] = $subject;
			$data['contents'] = $contents;

			$insert_board = $this->db->insert($table, $data);
			if ($insert_board) {
				$this->response('게시글작성완료', 200);
			} else {
				$this->response('작성실패', 404);
			}
		}

	}

	public function index_put()
	{

	}

	public function index_delete()
	{

	}

}
