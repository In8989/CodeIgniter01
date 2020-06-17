<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	public function korean_alpha_dash($str)
	{
		return (bool) preg_match('/^[a-zA-Z가-힣]+$/i', $str);
	}

}

