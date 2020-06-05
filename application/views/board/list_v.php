<script>	// 검색 스크립트
	$(document).ready(function() {
		$("#search_btn").click(function() {
			if ($("#q").val() == '') {
				alert("검색어를 입력하세요!");
				return false;
			} else {
				var act = "/board/lists/ci_board/q/" + $("#q").val() + "/page/1";
				$("#bd_search").attr('action', act).submit();
			}
		});
	});
</script>

<article style="padding-top: 30px;">
	<button><a href="/board/write/<?php echo $this -> uri -> segment(3); ?>/page/<?php echo $this -> uri -> segment(7); ?>" style="text-decoration: none;"> 글쓰기</a></button>
	<br><br>
	<table cellpadding="10" cellspacing="2" align="center" width="100%" border="1">
		<thead>
		<tr>
			<th scope="col">번호</th>
			<th scope="col">제목</th>
			<th scope="col">작성자</th>
			<th scope="col">조회수</th>
			<th scope="col">작성일</th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach($list as $lt)
		{
			?>
			<tr align="center">
				<th scope="row"><?php echo $lt -> board_id;?></th>
				<td><a rel="external" href="/<?php echo $this -> uri -> segment(1); ?>/view/<?php echo $this -> uri -> segment(3); ?>/<?php echo $lt -> board_id; ?>/<?php echo $this -> uri -> segment(5); ?>"> <?php echo $lt -> subject;?></a></td>
				<td><?php echo $lt -> user_name;?></td>
				<td><?php echo $lt -> hits;?></td>
				<td>
					<time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> reg_date)); ?>">
						<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> reg_date));?>
					</time></td>
			</tr>
			<?php
		}
		?>
		</tbody>
		<tfoot>
		<tr>
			<th colspan="5"><?php echo $pagination;?></th>
		</tr>
		</tfoot>
	</table>
	<div>
		<form id="bd_search" method="post">
			<input type="text" name="search_word" id="q" />
			<input type="button" value="검색" id="search_btn" />
		</form>
	</div>
</article>
