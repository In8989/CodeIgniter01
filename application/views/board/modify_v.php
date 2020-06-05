<script>
	$(document).ready(function() {
		$("#write_btn").click(function() {
			if ($("#input01").val() == '') {
				alert('제목을 입력해 주세요.');
				$("#input01").focus();
				return false;
			} else if ($("#input02").val() == '') {
				alert('내용을 입력해 주세요.');
				$("#input02").focus();
				return false;
			} else {
				$("#write_action").submit();
			}
		});
	});
</script>
<article id="board_area">
	<header>
		<h1></h1>
	</header>
	<form class="form-horizontal" method="post" action="" id="write_action">
		<fieldset style="width: 50%; text-align: center;">
			<legend>
				게시물 쓰기
			</legend>
			<br>
			<div>
				<label for="input01">제목</label>
				<div style="padding-bottom: 30px">
					<input type="text" id="input01" name="subject" value="<?php echo $views->subject;?>" required>
				</div>
				<label for="input02">내용</label>
				<div style="padding-bottom: 30px">
					<textarea id="input02" name="contents" rows="5" required><?php echo $views->contents?></textarea>
				</div>
				<br>
				<div>
					<button type="submit" id="write_btn">수정</button>
					<button onclick="document.location.reload()">취소</button>
				</div>
			</div>
		</fieldset>
	</form>
</article>
