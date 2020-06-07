<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('member_m');
		$this->load->helper(array('url', 'date'));
		$this->load->helper('alert');
		$this->load->helper('form');
		$this->load->library('form_validation');

//		$this->output->enable_profiler(true);
	}

	public function index()
	{
		$this->join();
	}

	public function _remap($method)
	{
		$this->load->view('header_v');
		if (method_exists($this, $method)) {
			$this->{"{$method}"}();
		}
		// 푸터 include
		$this->load->view('footer_v');
	}

	/*** 회원가입 ***/
	public function join()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id', '아이디', 'callback_id_check');
		$this->form_validation->set_rules('password', '비밀번호', 'required|matches[passconf]');
		$this->form_validation->set_rules('passconf', '비밀번호 확인', 'required');
		$this->form_validation->set_rules('name', '이름', 'required');
		$this->form_validation->set_rules('email', '이메일', 'required|valid_email');
		$this->form_validation->set_rules('gender', '라디오 버튼 값', '');

		if ($this->form_validation->run()) {
			$join_data = array(
				'id'=>$this->input->post('id',TRUE),
				'password'=>$this->input->post('password',TRUE),
				'name'=>$this->input->post('name',TRUE),
				'email'=>$this->input->post('email',TRUE),
				'table'=>$this->input->post('table',TRUE)
			);
			$result=$this->member_m->member_join($join_data);
			alert("회원가입되었습니다.",'/');
		}else {
			$this->load->view('member/join_v');
		}

	}

	// 중복검사
	public function id_check($id)
	{
		if($id){
			$result = array();
			$sql = "select * from users where id='".$id."'";
			$query=$this->db->query($sql);
			$result = $query->row();

			if($result){
				$this->form_validation->set_message('id_check', $id.'은(는) 중복된 아이디 입니다.');
				return FALSE;
			}else {
				return TRUE;
			}
		}else {
			return FALSE;
		}
	}

	/*** 로그인 ***/
	public function login()
	{
		$this->form_validation->set_rules('id','아이디','required|alpha_numeric');
		$this->form_validation->set_rules('password', '비밀번호', 'required');

		if($this->form_validation->run() == TRUE){
			$login_data=array(
				'id'=>$this->input->post('id',TRUE),
				'password'=>$this->input->post('password',TRUE)
			);
			$result=$this->member_m->member_login($login_data);

			if($result){
				$newdata=array(
					'id'=>$result->id,
					'email'=>$result->email,
					'name'=>$result->name,
					'logged_in'=>TRUE
				);
				$this->session->set_userdata($newdata);

				alert('로그인 되었습니다.','/');
				exit;
			}else {
				alert('아이디나 비밀번호를 확인해주세요.','/member/login');
				exit;
			}
		}else {
			$this->load->view('member/login_v');
		}
	}

	public function logout()
	{
		$this->load->helper('alert');
		$this->session->sess_destroy();
		alert('로그아웃 되었습니다.', '/');
		exit;
	}

}
