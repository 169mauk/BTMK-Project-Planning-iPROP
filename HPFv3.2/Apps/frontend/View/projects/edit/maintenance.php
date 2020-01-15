<?php

switch(url::get(5)){
	case "":
	?>
	<a href="<?= F::URLParams() ?>/add" class="btn btn-primary btn-sm">
		<span class="icon-plus2"></span> Add Log
	</a><br /><br />
	<table class="table table-hover table-fluid">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th>Title</th>
				<th>Description</th>
				<th class="text-center">User</th>
				<th class="text-center">Complainant</th>
				<th class="text-center">Status</th>
				<th class="text-center">Compeleted</th>
				<th class="text-right">:::</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
			$no = 1;
			foreach(project_maintenance::getBy(["pm_project" => url::get(3)]) as $pm){
			?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td><?= $pm->pm_title ?></td>
				<td><?= $pm->pm_description ?></td>
				<td class="text-center">
				<?php
					$u = users::getBy(["user_id" => $pm->pm_user]);
					
					if(count($u)){
						$u = $u[0];
						
						echo $u->user_name;
					}else{
						echo "Unknown User";
					}
				?>
				</td>
				<td class="text-center">
				<?php
					$u = users::getBy(["user_id" => $pm->pm_complain]);
					
					if(count($u)){
						$u = $u[0];
						
						echo $u->user_name;
					}else{
						echo "Unknown User";
					}
				?><br />
					<?= $pm->pm_date ?> <?= date("H:i:s\ ", $pm->pm_time) ?>
				</td>
				<td class="text-center">
				<?php
					echo (settings::getBy(["s_key" => "maintenance_status", "s_value" => $pm->pm_status]) ? settings::getBy(["s_key" => "maintenance_status", "s_value" => $pm->pm_status])[0]->s_name : "NO STATUS");
				?>
				</td>
				<td class="text-center">
				<?php
					echo (settings::getBy(["s_key" => "maintenance_status", "s_value" => $pm->pm_status]) ? settings::getBy(["s_key" => "maintenance_status", "s_value" => $pm->pm_status])[0]->s_name : "NO STATUS");
				?>
				</td>
				<td class="text-center">
				<?php
					echo $pm->pm_completeDate;
				?>
				</td>
				<td class="text-right">
					<a title="Edit Info" href="<?= F::URLParams() ?>/edit/<?= $pm->pm_id ?>" class="btn btn-sm btn-primary">
						<span class="icon-edit"></span>
					</a>
					
					<a title="Delete Info" href="<?= F::URLParams() ?>/delete/<?= $pm->pm_id ?>" class="btn btn-danger btn-sm">
						<span class="icon-trash"></span>
					</a>
				</td>
			</tr>
			<?php
			}
		?>
		</tbody>
	</table>
	<?php
	break;
	
	case "add":
	?>
	<a href="<?= PORTAL ?><?= url::get(0) . "/" . url::get(1) . "/" . url::get(2) . "/" . url::get(3) . "/" . url::get(4) ?>" class="btn btn-primary btn-sm">
		Back
	</a><br /><br />
	
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-6">
				Title:
				<input type="text" class="form-control" placeholder="Title" name="title" /><br />
				
				Description:
				<textarea class="form-control" placeholder="Description" name="description"></textarea><br />
				
				Client:
				<select class="form-control selectpicker" data-live-search="true" name="client">
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
				
				Status:
				<select class="form-control selectpicker" name="status">
				<?php
					foreach(settings::getBy(["s_key" => "maintenance_status"]) as $st){
					?>
					<option value="<?= $st->s_value ?>"><?= $st->s_name ?></option>
					<?php
					}
				?>
				</select><br /><br />
				
				Complainant:
				<select class="form-control selectpicker" name="complain">
				<?php
					foreach(users::list() as $u){
					?>
					<option value="<?= $u->user_id ?>"><?= $u->user_name ?></option>
					<?php
					}
				?>
				</select><br /><br />
				
				Completion Date:
				<input type="date" class="form-control" value="<?=  date("Y-m-d") ?>" name="completeDate" /><br />
			</div>
			
			<div class="col-md-6">
				Content:
				<textarea class="summernote" name="content"></textarea><br />
			</div>
			
			<div class="col-md-12 text-center">
			<?php
				Controller::form("projects/maintenance",[
					"action"	=> "add"
				]);
			?>
				<button class="btn btn-sm btn-success">
					<span class="icon-save"></span> Save Information
				</button>
			</div>
		</div>
	</form>
	<?php
	break;
	
	case "edit":
	?>
	<a href="<?= PORTAL ?><?= url::get(0) . "/" . url::get(1) . "/" . url::get(2) . "/" . url::get(3) . "/" . url::get(4) ?>" class="btn btn-primary btn-sm">
		Back
	</a><br /><br />
	<?php
		$pm = project_maintenance::getBy(["pm_id" => url::get(6), "pm_project" => url::get(3)]);
		
		if(count($pm)){
			$pm = $pm[0];
	?>
		<form action="" method="POST">
			<div class="row">
				<div class="col-md-6">
					Title:
					<input type="text" class="form-control" placeholder="Title" name="title" value="<?= $pm->pm_title ?>" /><br />
					
					Description:
					<textarea class="form-control" placeholder="Description" name="description"><?= $pm->pm_description ?></textarea><br />
					
					Client:
					<select class="form-control selectpicker" data-live-search="true" name="client">
					<?php
						foreach(project_company::getBy(["c_project" => url::get(3)]) as $pc){
							$c = companies::getBy(["c_id" => $pc->c_company]);
							
							if(count($c) > 0){
								$c = $c[0];
							?>
							<option value="<?= $c->c_id ?>" <?= $pm->pm_client == $c->c_id ? "selected" : "" ?>><?= $c->c_name ?></option>
							<?php			
							}
						}
					?>
					</select><br /><br />
				
					Status:
					<select class="form-control selectpicker" name="status">
					<?php
						foreach(settings::getBy(["s_key" => "maintenance_status"]) as $st){
						?>
						<option value="<?= $st->s_value ?>" <?= $st->s_value == $pm->pm_status ? "selected" : "" ?>><?= $st->s_name ?></option>
						<?php
						}
					?>
					</select><br /><br />
					
					Complainant:
					<select class="form-control selectpicker" name="complain">
					<?php
						foreach(users::list() as $u){
						?>
						<option value="<?= $u->user_id ?>" <?= $u->user_id == $pm->pm_complain ? "selected" : "" ?>><?= $u->user_name ?></option>
						<?php
						}
					?>
					</select><br /><br />
					
					Completion Date:
					<input type="date" class="form-control" value="<?=  $pm->pm_completeDate ?>" name="completeDate" /><br />
				</div>
				
				<div class="col-md-6">
					Content:
					<textarea class="summernote" name="content"><?= $pm->pm_content ?></textarea><br />
				</div>
				
				<div class="col-md-12 text-center">
				<?php
					Controller::form("projects/maintenance",[
						"action"	=> "edit"
					]);
				?>
					<button class="btn btn-sm btn-success">
						<span class="icon-save"></span> Save Information
					</button>
				</div>
			</div>
		</form>
	<?php
		}else{
			new Alert("error", "Maintenance log not found.");
		}
	break;
	
	case "delete":
	?>
	<a href="<?= PORTAL ?><?= url::get(0) . "/" . url::get(1) . "/" . url::get(2) . "/" . url::get(3) . "/" . url::get(4) ?>" class="btn btn-primary btn-sm">
		Back
	</a><br /><br />
	<?php
		$pm = project_maintenance::getBy(["pm_id" => url::get(6), "pm_project" => url::get(3)]);
		
		if(count($pm)){
			$pm = $pm[0];
	?>
		<form action="" method="POST">
			<h3>
				Are you sure?
			</h3>
			
			<p>
				By clicking below button will remove maintenance log "<strong><?= $pm->pm_title ?></strong>" permanently.
			</p>
			
		<?php
			Controller::form("projects/maintenance",[
				"action"	=> "delete"
			]);
		?>
		
			<button class="btn btn-sm btn-danger">
				<span class="icon-trash"></span> Delete Permanently
			</button>
		</form>
	<?php
		}else{
			new Alert("error", "Maintenance log not found.");
		}
	break;
}
























