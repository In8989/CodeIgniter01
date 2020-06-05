<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class board_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_list($table = '', $type = '', $offset = '', $limit = '', $search_word = '')
	{
		$sword = '';

		if ($search_word != '') {
			// 검색어 있을 경우
			$sword = ' WHERE subject like "%' . $search_word . '%" or contents like "%' . $search_word . '%" ';
		}

		$limit_query = '';

		if ($limit != '' OR $offset != '') {
			// 페이징이 있을 경우 처리
			$limit_query = ' LIMIT ' . $offset . ', ' . $limit;
		}

		$sql = "SELECT * FROM ci_board ". $sword . " ORDER BY board_id DESC " . $limit_query;
		$query = $this -> db -> query($sql);

		if ($type == 'count') {
			$result = $query->num_rows();
		} else {
			$result = $query->result();
		}

		return $result;
	}

	/*** 게시물 상세보기 가져오기 ***/
	function get_view($table, $id)
	{
		// 조횟수 증가
		$sql0 = "UPDATE ci_board SET hits = hits + 1 WHERE board_id='" . $id . "'";
		$this -> db->query($sql0);

		$sql = "SELECT * FROM ci_board WHERE board_id = '" . $id . "'";
		$query = $this->db->query($sql);

		// 게시물 내용 반환
		$result = $query->row();

		return $result;
	}

	/*** 게시물 입력 ***/
	function insert_board($arrays)
	{
		$insert_array = array(
			'board_pid' => 0,
			'user_id' => $arrays['user_id'],
			'user_name' => $arrays['user_name'],
			'subject' => $arrays['subject'], 
			'contents' => $arrays['contents']
		);

		$result = $this->db->insert($arrays['table'], $insert_array);

		return $result;
	}

	/*** 게시물 수정 ***/
	function modify_board($arrays)
	{
		$modify_array = array(
			'subject' => $arrays['subject'],
			'contents' => $arrays['contents']
		);

		$where = array(
			'board_id' => $arrays['board_id']
		);

		$result = $this->db->update($arrays['table'], $modify_array, $where);

		return $result;
	}

	/*** 게시물 삭제 ***/
	function delete_content($table, $no)
	{
		$delete_array = array(
			'board_id' => $no
		);

		$result = $this->db->delete($table, $delete_array);

		return $result;
	}

}
