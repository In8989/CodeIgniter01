<?php
	if(form_error('id')){
		$error_id = form_error('id');
	}else {
		$error_id = form_error('id_check');
	}
?>
<fieldset>
	<legend> 회원가입 </legend>
	<form method="post" action="">
	<div align="center">
		<input type="hidden" name="table" value="users">
		<label for="input01">아이디</label>
		<div>
			<input type="text" name="id" id="input01" placeholder="아이디를 입력하세요" value="<?php echo set_value('id');?>" />
		</div>
		<?php /*if($error_id == FALSE){
			echo "아이디를 입력하세요.";
		}else {
			echo $error_id;
		}*/?>
	</div>
	<div align="center">
		<label for="input02">비밀번호</label>
		<div>
			<input type="password" name="password" id="input02" placeholder="비밀번호를 입력하세요." />
		</div>
	</div>
	<div align="center">
		<label for="input03">비밀번호 확인</label>
		<div>
			<input type="password" name="passconf" id="input03" placeholder="비밀번호를 입력하세요." />
		</div>
	</div>
	<div align="center">
		<label for="input04">이름</label>
		<div>
			<input type="text" name="name" id="input04" placeholder="이름을 입력하세요" value="<?php echo set_value('name');?>" />
		</div>
	</div>
	<div align="center">
		<label for="input05">이메일</label>
		<div>
			<input type="text" name="email" id="input05" placeholder="이메일을 입력하세요" value="<?php echo set_value('email');?>" />
		</div>
	</div>
	<div align="center">
		<label for="input06">성별</label>
		<div>
			남자 <input type="radio" name="sex" id="input06" value="M" <?php echo set_radio('myradio', 'M', TRUE);?> />
			여자 <input type="radio" name="sex" id="input06" value="F" <?php echo set_radio('myradio', 'F');?> />
		</div>
	</div>

</fieldset>

<div align="center"><input type="submit" value="전송" /></div>
</form>
<?php echo validation_errors();?>
