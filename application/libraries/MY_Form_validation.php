<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
// 한글 영어 숫자만 가능
	public function korean_alpha_dash($str)
	{
		return (bool) preg_match('/^[ㄱ-ㅎ|가-힣|a-z|A-Z|0-9|\*]+$/i', $str);
	}
}

