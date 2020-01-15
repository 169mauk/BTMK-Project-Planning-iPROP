<form action="" method="POST">
	<div class="row">

		<div class="col-md-12">
			Task:
			<input type="text" class="form-control" name="title" placeholder="Task title" /><br />
		</div>

		<div class="col-md-6">
			Task Weightage (%):
			<input type="number" class="form-control" placeholder="Task Weightage (%)" value="1" min="1" max="100" name="weight" /><br />
		</div>
		
		<div class="col-md-6">
			Days to Complete:
			<input type="number" class="form-control" placeholder="No of Days" value="1" min="0" name="day" /><br />
		</div>
	
		<div class="col-md-12">
			Start After:
			<select class="form-control selectpicker" data-live-search="true" name="task">
				<option value="0">None</option>
			<?php
				foreach(tasks::getBy(["t_project" => url::Get(3)]) as $xrt){
				?>
				<option value="<?= $xrt->t_id ?>"><?= $xrt->t_title ?></option>
				<?php
				}
			?>
			</select><br /><br />
		</div>

		<div class="col-md-12">
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
	
		<div class="col-md-12">
			Content:
			<textarea class="form-control" placeholder="Task description" name="content"></textarea><br />
		</div>
	
		<?php 
			Controller::form("projects/tasks", 
				["action" => "add"]
			); 
		?>

		<div class="col-md-12">
			<button class="btn btn-lg btn-block btn-success">
				<span class="icon-save"></span> Save Information
			</button>
		</div>
	
	
	</div>

	
</form>