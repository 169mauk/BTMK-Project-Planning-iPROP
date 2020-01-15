<?php
new Controller($_POST);

switch(url::get(2)){
	case "":
	case "all":
	case "list":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					All Roles
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Role
					</a>
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="15%" class="text-center">Role</th>
								<th width="10%" class="text-right">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(roles::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->r_role ?></td>
								<td class="text-right">
									<a title="Edit Info" class="btn btn-sm btn-warning" href="<?= F::URLParams() ?>/edit/<?= $c->r_id ?>"><span class="icon-edit"></span></a>
									<a title="Delete Info" class="btn btn-sm btn-danger" href="<?= F::URLParams() ?>/delete/<?= $c->r_id ?>"><span class="icon-trash"></span></a>
								</td>
							</tr>
						<?php
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
	break;
	
	case "add":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					<span class="icon-plus2"></span> 
					Add Role
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-4">
								Role:
								<input type="text" class="form-control" placeholder="Role" name="role"/><br />
								
								<?= Controller::form(
									"users/roles",
									[
										"action" => "add"
									]
								) ?>
								
								<button class="btn btn-success  btn-sm">
									<span class="icon-save"></span> Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
	break;
	
	case "edit":
		$t = roles::getBy(["r_id" => url::get(3)]);
			if(count($t) > 0){
				$t = $t[0];
			
			?>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
						<div class="card lena-card no-border">
							<div class="card-header">
								<span class="icon-plus2"></span> 
								Edit Role
								
								<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
									Back
								</a>
							</div>
							
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-4">
											Role:
											<input type="text" class="form-control" placeholder="Role" name="role" value="<?= $t->r_role ?>" /><br />
											
											
											<?= Controller::form(
												"users/roles",
												[
													"action" => "edit"
												]
											) ?>
											
											<button class="btn btn-success  btn-sm">
												<span class="icon-save"></span> Save
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
	?>	
		
	
	<?php
	break;
	
	case "delete":
		$t = roles::getBy(["r_id" => url::get(3)]);
		if(count($t) > 0){
			$t = $t[0];
		?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
					<div class="card lena-card no-border">
						<div class="card-header">
							<span class="icon-plus2"></span> 
							Delete Role
							
							<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
								Back
							</a>
						</div>
						
						<div class="card-body">
							<form action="" method="POST">
								<div class="row">
									<div class="col-md-4">
										<h3>Are you sure?</h3>
										
										Are you sure to delete this <strong><?= $t->r_role ?></strong> data? <br /><br />
										
										<?= Controller::form(
											"users/roles",
											[
												"action" => "delete"
											]
										) ?>
										
										<div class="row">
											<div class="col-md-12">
												<button class="btn btn-danger btn-sm">
													<span class="icon-trash"></span> Confirm	
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php		
		
		}
		
	break;
	
}
?>
