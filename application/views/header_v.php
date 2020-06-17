<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<title>CodeIgniter</title>
</head>
<body>
<div>
	<table border="1" width="100%" height="100" align="center">
		<tr>
			<th width="20%"><a href="/">로고</a></th>
			<th width="60%"><a href="/board/lists/ci_board/page/">게시판</a></th>
			<?php if($this->session->userdata('logged_in')==TRUE){?>
				<th><?php echo $this->session->userdata('name');?>(<?php echo $this->session->userdata('id');?>) 님 환영합니다.</th>
				<th><a href="/member/logout">로그아웃</a></th>
			<?php }else {?>
				<th width="10%"><a href="/member/join">회원가입</a></th>
				<th width="10%"><a href="/member/login">로그인</a></th>
			<?php }?>
		</tr>
	</table>
