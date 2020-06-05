<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/*** 회원가입 ***/
	function member_join($array)
	{
		$join_array=array(
			'id'=>$array['id'],
			'password'=>$array['password'],
			'name'=>$array['name'],
			'email'=>$array['email'],
		);
		$resutl=$this->db->insert($array['table'],$join_array);

		return $resutl;
	}

	/***  로그인 세션 ***/
	function member_login($login)
	{
		$sql = "SELECT * FROM users WHERE id='".$login['id']."' AND password='".$login['password']."'";

		$query=$this->db->query($sql);

		if($query->num_rows() > 0){
			return $query->row();
		} else{
			return FALSE;
		}
	}
}
