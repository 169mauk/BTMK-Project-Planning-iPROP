<form action="" method="POST">
	<div class="row">

		<div class="col-md-12">
			Task:
			<input type="text" class="form-control" name="title" placeholder="Task title" /><br />
			
			Content:
			<textarea class="form-control" placeholder="Task description" name="content"></textarea><br />
		</div>
		
		<div class="col-md-6">
			Planning Start:
			<input type="date" class="form-control" name="planStart" /><br />
		</div>
		
		<div class="col-md-6">
			Planning End:
			<input type="date" class="form-control" name="planEnd" /><br />
		</div>
		
		<div class="col-md-6">
			Task Start:
			<input type="date" class="form-control" name="start" /><br />
		</div>
		
		<div class="col-md-6">
			Task End:
			<input type="date" class="form-control" value="1" min="0" name="end" /><br />
		</div>
	
		
		<div class="col-md-12">
			Task Dependent:
			<select class="form-control selectpicker" data-live-search="true" name="main">
				<option value="0">None</option>
			<?php
				foreach(tasks::getBy(["t_group" => url::Get(6)]) as $xrt){
				?>
				<option value="<?= $xrt->t_id ?>"><?= $xrt->t_title ?></option>
				<?php
				}
			?>
			</select><br /><br />
		</div>
		
		<div class="col-md-12">
			Sub of (if any):
			<select class="form-control selectpicker" data-live-search="true" name="subOf">
				<option value="0">None</option>
			<?php
				foreach(tasks::getBy(["t_group" => url::Get(6), "t_subOf" => 0]) as $xrt){
				?>
				<option value="<?= $xrt->t_id ?>"><?= $xrt->t_title ?></option>
				<?php
				}
			?>
			</select><br /><br />
		</div>
		
		<div class="col-md-6">
			Clients:
			<select class="form-control selectpicker" data-live-search="true" name="clients[]" multiple>
			<?php
				foreach(project_company::getBy(["c_project" => url::get(3)]) as $pc){
					$c = companies::getBy(["c_id" => $pc->c_company]);
					
					if(count($c) > 0){
						$c = $c[0];
					?>
					<option value="<?= $c->c_id ?>"><?= $c->c_name ?></option>
					<?php			
					}
				}
			?>
			</select><br /><br />
		</div>
		
		<div class="col-md-6">
			Users:
			<select class="form-control selectpicker" data-live-search="true" name="users[]" multiple>
			<?php
				foreach(users::list() as $u){
					$d = departments::getBy(["d_id" => $u->user_department]);
			?>
				<option value="<?= $u->user_id ?>"><?= $u->user_name ?> [<?= count($d) ? $d[0]->d_name : "NIL"?>]</option>
				<?php
				}
			?>
			</select><br /><br />
		</div>
		
		<div class="col-md-6">
			Bar Color:
			<select class="form-control selectpicker" data-live-search="true" name="color">
				<option value="gtaskblue">gtaskblue</option>
				<option value="gtaskred">gtaskred</option>
				<option value="gtaskgreen">gtaskgreen</option>
				<option value="gtaskyellow">gtaskyellow</option>
				<option value="gtaskpurple">gtaskpurple</option>
				<option value="gtaskpink">gtaskpink</option>
			</select><br /><br />
		</div>
		
		<div class="col-md-6">
			Bar Note:
			<input type="text" class="form-control" placeholder="Bar Note" name="note" /><br />
		</div>
	
		<?php 
			Controller::form("projects/tasks", 
				["action" => "add"]
			); 
		?>

		<div class="col-md-12 text-center">
			<button class="btn btn-sm btn-success">
				<span class="icon-save"></span> Save Information
			</button>
		</div>
	</div>	
</form>