<form action="" method="POST">
	Title:
	<input type="text" class="form-control" placeholder="Title" name="title" /><br />
	
	Content:
	<textarea class="form-control" placeholder="content" name="content"></textarea><br />
	
	<?php
		Controller::form("projects/discussion", [
			"action"	=> "add"
		]);
	?>
	
	<button class="btn btn-sm btn-primary">
		<span class="icon-plus2"></span> Create Discussion
	</button>
</form>