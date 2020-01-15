<?php
new Alert("info", "Attention! Please be notice that these settings are used for programming purposes. Any changes in these setting might affecting system smoothness.");
new Controller();
switch(url::get(2)){
	case "":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-list"></span> Raw Options
			
			<a href="<?= F::UrlParams() ?>/add_group" class="btn btn-primary btn-sm">
				<span class="icon-plus2"></span> Add Option
			</a>
		</div>
		
		<div class="card-body">
			<table class="table table-hover table-fluid dataTable">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Name</th>
						<th>Code</th>
						<th class="text-right">:::</th>
					</tr> 
				</thead>
				
				<tbody>
				<?php
					$no = 1;
					foreach(setting_group::list() as $s){
					?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $s->sg_name ?></td>
						<td><?= $s->sg_code ?></td>
						<td class="text-right">
							<a title="Edit Info" href="<?= F::URLParams() ?>/edit_group/<?= $s->sg_code ?>" class="btn btn-warning btn-sm">
								<span class="icon-edit"></span>
							</a>
							
							<a title="Delete Info" href="<?= F::URLParams() ?>/delete_group/<?= $s->sg_code ?>" class="btn btn-danger btn-sm">
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
	
	case "add_group":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-plus"></span> Add Group Setting
			
			<a href="<?= PORTAL ?>settings/options" class="btn btn-primary btn-sm">
				Back
			</a>
		</div>
		
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								Name:
								<input type="text" class="form-control" placeholder="Group Name" name="name" value="" /><br />
								
								Code:
								<input type="text" class="form-control" placeholder="Group Code" name="code" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Description:
								<textarea class="form-control" placeholder="Description" name="description"></textarea><br />
							</div>
							
							<div class="col-md-12 text-center">
								<button class="btn btn-sm btn-success">
									<span class="icon-save"></span> Save
								</button>
								
								<?php
									Controller::form("settings/setting_group", [
										"action"	=> "add"
									]);
								?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
	break;
	
	case "add":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-plus"></span> Add Options
			
			<a href="<?= PORTAL ?>settings/options" class="btn btn-primary btn-sm">
				Back
			</a>
		</div>
		
		<div class="card-body">
			<form action="" method="POST">
				<div class="row">
					<div class="col-md-6">
						Name:
						<input type="text" class="form-control" placeholder="Name" name="name" /><br />
						
						Key:
						<input type="text" class="form-control" placeholder="Key" name="key" /><br />
					</div>
					
					<div class="col-md-6">
						Value:
						<textarea class="form-control" placeholder="Value" name="value"></textarea><br />

						Description:
						<textarea class="form-control" placeholder="Description" name="description"></textarea><br />
					</div>
					
					<div class="col-md-12 text-center">
					<?php
						Controller::form("settings/setting", [
							"action"	=> "add"
						]);
					?>
						<button class="btn btn-sm btn-success">
							<span class="icon-save"></span> Save Information
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	break;
	
	case "edit_group":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-edit"></span> Edit Option Group
			
			<a href="<?= PORTAL ?>settings/options" class="btn btn-primary btn-sm">
				Back
			</a>
		</div>
		
		<div class="card-body">
		<?php
			$r = setting_group::getBy(["sg_code" => url::get(3)]);
			
			if(count($r)){
				$r = $r[0];
			?>
			<div class="row">
				<div class="col-md-6">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								Name:
								<input type="text" class="form-control" placeholder="Group Name" name="name" value="<?= $r->sg_name ?>" /><br />
								
								Code:
								<input type="text" class="form-control" placeholder="Group Code" name="code" value="<?= $r->sg_code ?>" /><br />
							</div>
							
							<div class="col-md-6">
								Description:
								<textarea class="form-control" placeholder="Description" name="description"><?= $r->sg_description ?></textarea><br />
							</div>
							
							<div class="col-md-12 text-center">
								<button class="btn btn-sm btn-success">
									<span class="icon-save"></span> Save
								</button>
								
								<?php
									Controller::form("settings/setting_group", [
										"action"	=> "edit"
									]);
								?>
							</div>
						</div>
					</form>
				</div>
				
				<div class="col-md-6">
				<?php
					switch(url::get(4)){
						case "":
						default:
						?>
						<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary float-right">
							<span class="icon-plus2"></span> Add Setting
						</a>
						<br /><br />
						<table class="table table-fluid table-hover">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th>Name</th>
									<th class="text-center">Value</th>
									<th class="text-right">:::</th>
								</tr>
							</thead>
							
							<tbody>
							<?php
								$no = 1;
								
								foreach(settings::getBy(["s_key" => $r->sg_code]) as $s){
								?>
								<tr>
									<td class="text-center"><?= $no++ ?></td>
									<td><?= $s->s_name ?></td>
									<td class="text-center"><?= $s->s_value ?></td>
									<td class="text-right">
										<a href="<?= PORTAL ?>settings/options/edit/<?= $s->s_id ?>" class="btn btn-primary btn-sm">
											<span class="icon-edit"></span>
										</a>
										
										<a href="<?= PORTAL ?>settings/options/delete/<?= $s->s_id ?>" class="btn btn-danger btn-sm">
											<span class="icon-delete"></span>
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
						<a href="<?= PORTAL ?>settings/options/edit_group/<?= url::Get(3) ?>" class="btn btn-sm btn-primary float-right">
							Back
						</a>
						<br /><br />
						
						<form action="" method="POST">
							Name:
							<input type="text" class="form-control" placeholder="Name" name="name" /><br />
							
							Value:
							<input type="text" class="form-control" placeholder="Value" name="value" /><br />
							
							<button class="btn btn-sm btn-success">
								<span class="icon-save"></span> Save
							</button>
							
							<?php
								Controller::form("settings/setting", [
									"action"	=> "add"
								]);
							?>
						</form>
						<?php
						break;
					}
				?>
					
				</div>
			</div>
			<?php
			}else{
				new Alert("error", "Sorry, settiing group not found.");
			}
		?>
		</div>
	</div>
	<?php
	break;
	
	case "delete_group":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-trash"></span> Delete Option Group
			
			<a href="<?= PORTAL ?>settings/options" class="btn btn-primary btn-sm">
				Back
			</a>
		</div>
		
		<div class="card-body">
		<?php
			$r = setting_group::getBy(["sg_code" => url::get(3)]);
			
			if(count($r)){
				$r = $r[0];
			?>
			<div class="row">
				<div class="col-md-6">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-12 text-center">
								<h3>
									Are you sure?
								</h3>
								
								<p>
									By clickinh below button will remove Option Group permanently.
								</p>
								
								<button class="btn btn-sm btn-danger">
									<span class="icon-trash"></span> Delete
								</button>
								
								<?php
									Controller::form("settings/setting_group", [
										"action"	=> "delete"
									]);
								?>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
			}else{
				new Alert("error", "Sorry, settiing group not found.");
			}
		?>
		</div>
	</div>
	<?php
	break;
	
	case "edit":
		$s = settings::getBy(["s_id" => url::get(3)]);
			
		if(count($s)){
			$s = $s[0];
		}else{
			$s = null;
		}
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-edit"></span> Edit Options
			
			<a href="<?= PORTAL ?>settings/options/<?= !is_null($s) ? "edit_group/" . $s->s_key : "" ?>" class="btn btn-primary btn-sm">
				Back
			</a>
		</div>
		
		<div class="card-body">
		<?php
			$s = settings::getBy(["s_id" => url::get(3)]);
			
			if(count($s)){
				$s = $s[0];
		?>
			<form action="" method="POST">
				<div class="row">
					<div class="col-md-6">
						Name:
						<input type="text" class="form-control" placeholder="Name" name="name" value="<?= $s->s_name ?>" /><br />
						
						Key:
						<input type="text" class="form-control" placeholder="Key" name="key" value="<?= $s->s_key ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Value:
						<textarea class="form-control" placeholder="Value" name="value"><?= $s->s_value ?></textarea><br />

						Description:
						<textarea class="form-control" placeholder="Description" name="description"><?= $s->s_description ?></textarea><br />
					</div>
					
					<div class="col-md-12 text-center">
					<?php
						Controller::form("settings/setting", [
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
				new Alert("error", "Raw setting option not found.");
			}
		?>
		</div>
	</div>
	<?php
	break;
	
	case "delete":
		$s = settings::getBy(["s_id" => url::get(3)]);
			
		if(count($s)){
			$s = $s[0];
		}else{
			$s = null;
		}
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-delete"></span> Delete Options
			
			<a href="<?= PORTAL ?>settings/options/<?= !is_null($s) ? "edit_group/" . $s->s_key : "" ?>" class="btn btn-primary btn-sm">
				Back
			</a>
		</div>
		
		<div class="card-body">
		<?php
			$s = settings::getBy(["s_id" => url::get(3)]);
			
			if(count($s)){
				$s = $s[0];
		?>
			<form action="" method="POST">
				<h3>Are you sure?</h3>
				
				<p>
					By pressing below button will remove options etting "<strong><?= $s->s_name ?> - <?= $s->s_value ?></strong>" permanently.
				</p>
				
				<?php
					Controller::form("settings/setting", [
						"action"	=> "delete",
						"back"		=> $s->s_key
					]);
				?>
				<button class="btn btn-sm btn-danger">
					<span class="icon-trash"></span> Delete Information
				</button>
			</form>
		<?php
			}else{
				new Alert("error", "Raw setting option not found.");
			}
		?>
		</div>
	</div>
	<?php
	break;	
}



























