<form action="" method="POST">
	Title:
	<input type="text" class="form-control" placeholder="Job Title" name="title" /><br />
	
	Description:
	<textarea class="form-control" placeholder="Description" name="description"></textarea><br />
	
	<?php
		Controller::form("projects/job",[
			"action"	=> "add",
			"userjob"		=> ""
		]);
	?>
	
	<button class="btn btn-success btn-sm">
		<span class="icon-plus2"></span> Add Job
	</button>
</form>