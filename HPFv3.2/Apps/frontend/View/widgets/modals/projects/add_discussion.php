<form action="" method="POST">
	Title:
	<input type="text" class="form-control" placeholder="Title" name="title" /><br />
	
	Content:
	<textarea class="form-control" placeholder="content" name="content"></textarea><br />
	
	Category:
	<select class="form-control" name="category">
	<?php
		foreach(discussion_category::list() as $cat){
		?>
		<option value="<?= $cat->dc_id ?>"><?= $cat->dc_name ?></option>
		<?php
		}
	?>
	</select><br /><br />
	
	<?php
		Controller::form("projects/discussion", [
			"action"	=> "add"
		]);
	?>
	
	<button class="btn btn-sm btn-primary">
		<span class="icon-plus2"></span> Create Discussion
	</button>
</form>