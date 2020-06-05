<article>
	<form method="post" action="" id="write_action">
		<fieldset style="width: 50%; text-align: center;">
			<legend>
				게시물 쓰기
			</legend>
			<br>
			<div>
				<label for="input03">아이디</label>
				<div style="padding-bottom: 30px">
					<input type="text" id="input03" name="user_id" value="<?php echo $this->session->userdata('id');?>" readonly>
				</div>
				<label for="input04">이름</label>
				<div style="padding-bottom: 30px">
					<input type="text" id="input04" name="user_name" value="<?php echo $this->session->userdata('name');?>">
				</div>
				<label for="input01">제목</label>
				<div style="padding-bottom: 30px">
					<input type="text" id="input01" name="subject" required>
				</div>
				<label for="input02">내용</label>
				<div style="padding-bottom: 30px">
					<textarea id="input02" name="contents" rows="5" required></textarea>
				</div>
				<br>
				<div>
					<button type="submit" id="write_btn">작성</button>
					<button type="button" onclick="location.href('/board/lists/ci_board/page')">취소</button>
				</div>
			</div>
		</fieldset>
	</form>
</article>
