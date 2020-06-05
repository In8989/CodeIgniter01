<article id="board_area">
	<header>
		<h1></h1>
	</header>
	<table align="center" width="100%" border="1" class="table table-striped">
		<tbody>
		<tr>
			<th scope="col">제목: <?php echo $views -> subject;?></th>
		</tr>
		<tr>
			<th scope="col">이름: <?php echo $views -> user_name;?></th>
		</tr>
		<tr>
			<th scope="col">조회수: <?php echo $views -> hits;?></th>
		</tr>
		<tr>
			<th scope="col">등록일: <?php echo $views -> reg_date;?></th>
		</tr>
		<tr>
			<th colspan="4">내용: <?php echo $views -> contents;?></th>
		</tr>
		</tbody>
		<tfoot>
		<tr>
			<th colspan="4">
				<button><a href="/board/lists/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(5);?>" style="text-decoration: none;">목록 </a></button>
				<button><a href="/board/write/<?php echo $this -> uri -> segment(3); ?>/page/<?php echo $this -> uri -> segment(7); ?>" style="text-decoration: none;">글쓰기</a></button>
				<button><a href="/board/modify/<?php echo $this -> uri -> segment(3); ?>/board_id/<?php echo $this -> uri -> segment(4); ?>/page/<?php echo $this -> uri -> segment(7); ?>">수정</a></button>
				<button><a href="/board/delete/<?php echo $this -> uri -> segment(3); ?>/board_id/<?php echo $this -> uri -> segment(4); ?>/page/<?php echo $this -> uri -> segment(7); ?>"> 삭제 </a></button>
			</th>
		</tr>
		</tfoot>
	</table>
</article>

