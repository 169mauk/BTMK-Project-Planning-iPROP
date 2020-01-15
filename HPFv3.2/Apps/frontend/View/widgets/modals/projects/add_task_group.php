<form action="" method="POST">
	<div class="row">
		<div class="col-md-12">
			Name:
			<input type="text" class="form-control" name="name" placeholder="Task title" /><br />
		</div>

		<div class="col-md-12">
			Description:
			<textarea class="form-control" name="note" placeholder="Task Group Description"></textarea><br />
		</div>
	
		<?php 
			Controller::form("projects/task_group", 
				["action" => "add"]
			); 
		?>

		<div class="col-md-12">
			<button class="btn btn-sm btn-block btn-success">
				<span class="icon-save"></span> Save Information
			</button>
		</div>
	
	
	</div>

	
</form>