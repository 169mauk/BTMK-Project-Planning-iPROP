<?php
new Controller();

switch(url::get(2)){
	case "":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-list"></span> All Menus
			
			<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
				<span class="icon-plus2"></span> Add Menu
			</a>
		</div>
		
		<div class="card-body">
			<table class="table table-hover table-fluid dataTable">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Name</th>
						<th class="text-center">Status</th>
						<th>URL</th>
						<th class="text-center">Sub Of</th>
						<th class="text-center">Position</th>
						<th class="text-right">:::</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
					$no = 1;
					foreach(menus::list() as $m){
					?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td>
							<span class="<?= $m->m_icon ?>"></span>
							<?= $m->m_name ?><br />
							<small><?= $m->m_description ?></small>
						</td>
						<td class="text-center">
							<?= $m->m_disabled ? "Disabled" : "Enabled" ?>
						</td>
						<td><?= $m->m_url ?></td>
						<td class="text-center"><?= menus::getBy(["m_id" => $m->m_main]) ? menus::getBy(["m_id" => $m->m_main])[0]->m_name : "NIL" ?></td>
						<td class="text-center">
						<?php
							$role = $m->m_role ? explode(",", $m->m_role) : [];
							
							foreach($role as $r){
								echo (count(positions::getBy(["p_id" => $r])) ? positions::getBy(["p_id" => $r])[0]->p_name : "") . ", ";
							}
						?>
						</td>
						<td class="text-right">
							<a title="Edit Info" href="<?= F::URLParams() ?>/edit/<?= $m->m_id ?>" class="btn btn-sm btn-warning">
								<span class="icon-edit"></span>
							</a>
							
							<a title="Delete Info" href="<?= F::URLParams() ?>/delete/<?= $m->m_id ?>" class="btn btn-sm btn-danger">
								<span class="icon-trash"></span>
							</a>
						</td>
					</tr>
					<?php
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
	break;
	
	case "add":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-edit"></span> Edit Menu
			
			<a href="<?= PORTAL ?>settings/menus" class="btn btn-sm btn-primary">
				Back
			</a>
		</div>
		
		<div class="card-body">
			<form action="" method="POST">
				<div class="row">
					<div class="col-md-6">
						Name:
						<input type="text" class="form-control" placeholder="Name" name="name" /><br />
						
						Url:
						<input type="text" class="form-control" placeholder="Url" name="url" /><br />
						
						Order:
						<input type="number" class="form-control" placeholder="Order" name="order" /><br />
						
						Icon:
						<input type="text" class="form-control" placeholder="Icon" name="icon" /><br />
						
						Description:
						<textarea class="form-control" placeholder="Description" name="description"></textarea><br />
						
						Sub Of:
						<select name="main" class="form-control selectpicker" data-live-search="true">
							<option value="">None</option>
						<?php
							foreach(menus::list() as $me){
							?>
							<option value="<?= $me->m_id ?>"><?= $me->m_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
						
						Eligible in Position:
						<select class="form-control selectpicker" name="role[]" data-live-search="true" multiple>
						<?php
							foreach(positions::list() as $r){
							?>
							<option value="<?= $r->p_id ?>"><?= $r->p_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
						
						Disabled?
						<select class="form-control selectpicker" name="disabled">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select><br /><br />
						
						<?php
							Controller::form("settings/menus", [
								"action"	=> "add"
							]);
						?>
						<button class="btn btn-success btn-sm">
							<span class="icon-save"></span> Save Information
						</button> 
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	break;
	
	case "edit":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-edit"></span> Edit Menu
			
			<a href="<?= PORTAL ?>settings/menus" class="btn btn-sm btn-primary">
				Back
			</a>
		</div>
		
		<div class="card-body">
		<?php
			$m = menus::GetBy(["m_id" => url::get(3)]);
			
			if(count($m)){ 
				$m = $m[0];
		?>
			<form action="" method="POST">
				<div class="row">
					<div class="col-md-6">
						Name:
						<input type="text" class="form-control" placeholder="Name" name="name" value="<?= $m->m_name ?>" /><br />
						
						Url:
						<input type="text" class="form-control" placeholder="Url" name="url" value="<?= $m->m_url ?>" /><br />
						
						Order:
						<input type="number" class="form-control" placeholder="Order" name="order"  value="<?= $m->m_order?>" /><br />
						
						Icon:
						<input type="text" class="form-control" placeholder="Icon" name="icon" value="<?= $m->m_icon ?>" /><br />
						
						Description:
						<textarea class="form-control" placeholder="Description" name="description"><?= $m->m_description ?></textarea><br />
						
						Sub Of:
						<select name="main" class="form-control selectpicker" data-live-search="true">
							<option value="">None</option>
						<?php
							foreach(menus::list() as $me){
							?>
							<option value="<?= $me->m_id ?>" <?= $m->m_main == $me->m_id ? "selected" : "" ?>><?= $me->m_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
						
						Eligible in Position:
						<select class="form-control selectpicker" data-live-search="true" name="role[]" multiple>
						<?php
							$role = (!empty($m->m_role) ? explode(",", $m->m_role) : []);
							foreach(positions::list() as $r){
							?>
							<option value="<?= $r->p_id ?>" <?= in_array($r->p_id, $role) ? "selected" : "" ?>><?= $r->p_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
						
						Disabled?
						<select class="form-control selectpicker" name="disabled">
							<option value="0" <?= $m->m_disabled == 0 ? "selected" : "" ?>>No</option>
							<option value="1" <?= $m->m_disabled == 1 ? "selected" : "" ?>>Yes</option>
						</select><br /><br />
						
						<?php
							Controller::form("settings/menus", [
								"action"	=> "edit"
							]);
						?>
						
						<button class="btn btn-success btn-sm">
							<span class="icon-save"></span> Save Information
						</button> 
					</div>
				</div>
			</form>
		<?php
			}else{
				new Alert("error", "No menu information werer found.");
			}
		?>
		</div>
	</div>
	<?php
	break;
	
	case "delete":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-edit"></span> Edit Menu
			
			<a href="<?= PORTAL ?>settings/menus" class="btn btn-sm btn-primary">
				Back
			</a>
		</div>
		
		<div class="card-body">
		<?php
			$m = menus::GetBy(["m_id" => url::get(3)]);
			
			if(count($m)){ 
				$m = $m[0];
		?>
			<form action="" method="POST">
				<h3>
					Are you sure?
				</h3>
				
				<p>
					By clicking below button will remove menu "<strong><?= $m->m_name ?></strong>" permanently.
				</p>
				
				<?php
					Controller::form("settings/menus", [
						"action"	=> "delete"
					]);
				?>
				
				<button class="btn btn-danger btn-sm">
					<span class="icon-trash"></span> Delete Information
				</button> 
			</form>
		<?php
			}else{
				new Alert("error", "No menu information werer found.");
			}
		?>
		</div>
	</div>
	<?php
	break;
}





























