<?php

use chriskacerguis\RestServer\RestController;
require APPPATH.'libraries/Jwt_creator.php';
require APPPATH.'libraries/Auth_creator.php';

class Board extends RestController
{
	private $is_auth;
	private $jwt_auth;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->jwt_auth = new Auth_creator();
		$this->load->library('form_validation');
		$received_Token = $this->input->get_request_header('Token');
		$this->is_auth = $this->jwt_auth->auth_get($received_Token);
//		print_r($this->is_auth);

//		$this->output->enable_profiler(true);
	}

	public function index_get($type)
	{
		if($type == 'list') {
			$this->load->library('pagination');

			$config['base_url'] = '/api/board/list/page';
			$config['total_rows'] = $this->db->count_all('ci_board');
			$config['per_page'] = 5;
			$config['uri_segment'] = 3;
			$limit = $config['per_page'];
			// ((uri페이지) - 1 ) * $config['per_page']
			$offset = ($this->uri->segment(4)-1)*$config['per_page'];

			$this->db->order_by('board_id','desc');
			$get_board = $this->db->get('ci_board',$limit,$offset);
			$get_board->num_rows();
			$result = $get_board->result_array();

			if ($result) {
				$this->response($result, 200);
			} else {
				$this->response(false, 404);
			}
		}else if ($type == 'view'){
			$board_id = $this->uri->segment(4);
			$this->db->where('board_id',$board_id);
			$get_view = $this->db->get('ci_board');
//			$get_view->num_rows();
			$result = $get_view->row();
			print_r($result);

		}

	}

	public function index_post($type)
	{
		if($type == 'write') {
			if(!$this->is_auth){
				$this->response(false,404);
			}else {

				$user_id = $this->post('user_id');
				$user_name = $this->post('user_name');
				$subject = $this->post('subject');
				$contents = $this->post('contents');

				$data['user_id'] = $user_id;
				$data['user_name'] = $user_name;
				$data['subject'] = $subject;
				$data['contents'] = $contents;

				$insert_board = $this->db->insert('ci_board', $data);
				if ($insert_board) {
					$this->response(true, 200);
				} else {
					$this->response(false, 404);
				}
			}
		}

	}

	public function index_put()
	{
		$board_id = $this->uri->segment(3);
		$this->db->where('board_id',$board_id);
		$get_view = $this->db->get('ci_board');
		$get_view->num_rows();
		$result = $get_view->row();
		// 게시글 id 찾기
//		print_r($result->user_id);

		// 로그인 한 id 찾기
		$login_token = json_decode($this->is_auth);
//		print_r($login_token->id);

		if(!$login_token->id == $result->user_id){
			echo '아이디가 다르다';
			$this->response(false,404);
		}else{
			$data['board_id'] = $this->uri->segment(3);
			$data['subject'] = $this->put('subject');
			$data['contents'] = $this->put('contents');

			if($data) {
				$this->db->where('board_id', $data['board_id']);
				$this->db->update('ci_board', $data);
				$this->response($data,200);
			}else{
				$this->response(false,404);
			}
		}
	}

	public function index_delete()
	{
		if(!$this->is_auth) {
			echo '로그인해요';
		}else{
			$data['board_id'] = $this->uri->segment(3);
			$this->db->where('board_id', $data['board_id']);
			$this->db->delete('ci_board', $data);

			echo $data['board_id'].'글이 삭제되었습니다.';
		}
	}

}
