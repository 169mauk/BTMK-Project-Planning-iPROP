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
					All Users 
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add User
					</a>
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="15%" class="text-center">Name</th>
								<th>Department</th>
								<th>Username</th>
								<th width="10%" class="text-center">Email</th>
								<th width="10%" class="text-right">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							if($_SESSION["admin"]){
								$u = users::list();
							}else{
								$u = users::getBy(["user_department" => $_SESSION["department"]]);
							}
							
							foreach($u as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->user_name ?></td>
								<td>
								<?php  
									$d = departments::getBy(["d_id" => $c->user_department]);
									if(count($d)){
										echo $d[0]->d_name . ", ";
									}else{
										echo "UNKNOWN";
									}
								?>
								</td>
								<td><?= $c->user_login ?></td>
								<td class="text-center"><?= $c->user_email ?></td>
								<td class="text-right">
									<a class="btn btn-sm btn-primary" href="<?= F::URLParams() ?>/edit/<?= $c->user_id ?>"><span class="icon-edit"></span></a>
									<a class="btn btn-sm btn-danger" href="<?= F::URLParams() ?>/delete/<?= $c->user_id ?>"><span class="icon-trash"></span></a>
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
					Add User
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								Name:
								<input type="text" class="form-control" placeholder="Name" name="name"/><br />
								
								Username:
								<input type="text" class="form-control" placeholder="Username" name="username"/><br />
								
								Password:
								<input type="password" class="form-control" placeholder="Password" name="password"/><br />
							</div>
							
							<div class="col-md-6">
								Email:
								<input type="text" class="form-control" placeholder="Email" name="email" /><br />
								
								Phone No:
								<input type="text" class="form-control" placeholder="Phone No" name="phone" /><br />
							</div>
							
							<div class="col-md-12">
								Department:
								<select class="form-control selectpicker" data-live-search="true" name="department" >
								<?php
									$d = $_SESSION["admin"] ? departments::list() : departments::getBy(["d_id" => $_SESSION["department"]]);
									
									foreach($d as $dp){
									?>
										<option value="<?= $dp->d_id ?>">
											<?= $dp->d_name ?>
										</option>
									<?php
									}
								?>
								</select><br /><br />
								
								Role:
								<select class="form-control selectpicker" data-live-search="true" name="role" >
								<?php
									foreach(roles::list() as $role){
									?>
										<option value="<?= $role->r_code ?>">
											<?= $role->r_role ?>
										</option>
									<?php
										}
								?>
								</select><br /><br />
								
								
					
								<?= Controller::form(
									"users/all_user",
									[
										"action" => "add"
									]
								) ?>
								
								<button class="btn btn-success btn-block btn-sm">
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
		$t = users::getBy(["user_id" => url::get(3)]);
			if(count($t) > 0){
				$t = $t[0];
			
			?>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
						<div class="card lena-card no-border">
							<div class="card-header">
								<span class="icon-plus2"></span> 
								Edit User
								
								<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
									Back
								</a>
							</div>
							
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-6">
											Name:
											<input type="text" class="form-control" placeholder="Name" name="name" value="<?= $t->user_name ?>" /><br />
											
											Username:
											<input type="text" class="form-control" placeholder="Username" name="username" value="<?= $t->user_login ?>"/><br />
											
											Password:
											<input type="password" class="form-control" placeholder="Password" name="password" value="" /><br />
										</div>
										
										<div class="col-md-6">
											Email:
											<input type="text" class="form-control" placeholder="Email" name="email" value="<?= $t->user_email ?>" /><br />
											
											Phone No:
											<input type="text" class="form-control" placeholder="Phone No" name="phone" value="<?= $t->user_phone ?>" /><br />
										</div>
										
										<div class="col-md-12">
											Department:
											<select class="form-control selectpicker" data-live-search="true" name="department" >
											<?php
												$d = $_SESSION["admin"] ? departments::list() : departments::getBy(["d_id" => $_SESSION["department"]]);
												
												foreach($d as $dp){
												?>
													<option value="<?= $dp->d_id ?>" <?= $_SESSION["department"] == $dp->d_id ? "selected" : "" ?>>
														<?= $dp->d_name ?>
													</option>
												<?php
												}
											?>
											</select><br /><br />
											
											Role:
											<select class="form-control selectpicker" data-live-search="true" name="role" >
											<?php
												foreach(roles::list() as $role){
												?>
													<option value="<?= $role->r_code ?>" <?= $_SESSION["role"] == $role->r_id ? "selected" : "" ?>>
														<?= $role->r_role ?>
													</option>
												<?php
													}
											?>
											</select><br /><br />
											
											<?= Controller::form(
												"users/all_user",
												[
													"action" => "edit"
												]
											) ?>
											
											<button class="btn btn-success btn-sm">
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
		$t = users::getBy(["user_id" => url::get(3)]);
		if(count($t) > 0){
			$t = $t[0];
		?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
					<div class="card lena-card no-border">
						<div class="card-header">
							<span class="icon-plus2"></span> 
							Delete User
							
							<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
								Back
							</a>
						</div>
						
						<div class="card-body">
							<form action="" method="POST">
								<div class="row">
									<div class="col-md-4">
										
										Are you sure to delete this <?= $t->user_name ?> data? <br /><br />
										
										<?= Controller::form(
											"users/all_user",
											[
												"action" => "delete"
											]
										) ?>
										
										<div class="row">
											<div class="col-md-12">
												<button class="btn btn-success btn-sm">
													Confirm	
												</button>
												<a class="btn btn-sm btn-danger" href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>">No</a>
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
