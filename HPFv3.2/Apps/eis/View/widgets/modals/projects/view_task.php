
<form action="" method="POST">
	<div class="row">
		<div class="col-md-12">
			Task:
			<input type="text" class="form-control edit-form" name="_title" placeholder="Task title" /><br />
			
			Content:
			<textarea class="form-control edit-form" placeholder="Task description" name="_content"></textarea><br />
		</div>
		
		<div class="col-md-6">
			Planning Start:
			<input type="date" class="form-control edit-form" name="_planStart" /><br />
		</div>
		
		<div class="col-md-6">
			Planning End:
			<input type="date" class="form-control edit-form" name="_planEnd" /><br />
		</div>
		
		<div class="col-md-6">
			Task Start:
			<input type="date" class="form-control edit-form" name="_start" /><br />
		</div>
		
		<div class="col-md-6">
			Task End:
			<input type="date" class="form-control edit-form" value="1" min="0" name="_end" /><br />
		</div>
		
		<div class="col-md-12">
			Task Dependent:
			<select class="form-control selectpicker edit-form" data-live-search="true" name="_main">
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
			<select class="form-control selectpicker edit-form" data-live-search="true" name="_subOf">
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
			<select id="_clients" class="form-control selectpicker edit-form" data-live-search="true" name="_clients[]" multiple>
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
			<select id="_users" class="form-control selectpicker edit-form" data-live-search="true" name="_users[]" multiple>
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
			<select class="form-control selectpicker edit-form" data-live-search="true" name="_color">
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
			<input type="text" class="form-control edit-form" placeholder="Bar Note" name="_note" /><br />
		</div>
		
		<div class="col-md-6">
			Percent (%) of Completion:
			<input type="number" class="form-control" placeholder="% Completion" name="_percent" />
		</div>
	
		<?php 
			Controller::form("projects/tasks", 
				["action" => "edit", "tid" => ""]
			); 
		?>

		<div class="col-md-12 text-center">
			<button class="btn btn-sm btn-success">
				<span class="icon-save"></span> Save Information
			</button>
		</div>
	</div>	
</form>