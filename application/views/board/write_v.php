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
					<input type="text" id="input01" name="subject" required>
				</div>
				<label for="input02">내용</label>
				<div style="padding-bottom: 30px">
					<textarea id="input02" name="contents" rows="5" required></textarea>
				</div>
				<br>
				<div>
					<button type="submit" id="write_btn">작성</button>
					<button onclick="document.location.reload()">취소</button>
				</div>
			</div>
		</fieldset>
	</form>
</article>
