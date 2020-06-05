<?php
$attributes = array(
	'class' => 'form-horizontal',
	'id' => 'auth_login'
);
echo form_open('/member/login', $attributes);
?>
<fieldset>
	<legend> 로그인 </legend>
	<div align="center">
		<input type="hidden" name="table" value="users">
		<label for="input01">아이디</label>
		<div>
			<input type="text" name="id" id="input01" placeholder="아이디를 입력하세요" value="<?php echo set_value('id');?>" />
		</div>
	</div>
	<div align="center">
		<label for="input02">비밀번호</label>
		<div>
			<input type="password" name="password" id="input02" placeholder="비밀번호를 입력하세요." />
		</div>
	</div>
	<div align="center">
		<button type="submit">확인</button>
		<button type="button" onclick="document.location.reload()">취소</button>
	</div>
</fieldset>


