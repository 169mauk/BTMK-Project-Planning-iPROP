<?php
new Controller ($_POST);

switch(url::get(2)){
	case "":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					All Departments
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Departments
					</a>
				</div>
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="" class="text-center">No</th>
								<th width="" class="text-center">Name</th>
								<th width="" class="text-center">Status</th>
								<th width="" class="text-center">User</th>
								<th width="" class="text-center">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(departments::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->d_name ?></td>
								<td class="text-center"><?= $c->d_status == 1 ? "Enable" : "Disable" ?></td>
								<td class="text-center"><?= $c->d_user ?></td>
								<td class="text-center">
									<a title="Edit Info" href="<?= F::URLParams() ?>/edit/<?= $c->d_id?>" class="btn btn-sm btn-warning">
										<span class="icon-plus2"></span>
									</a>
									<a title="Delete Info" href="<?= F::URLParams() ?>/delete/<?= $c->d_id ?>" class="btn btn-sm btn-danger">
										<span class="icon-plus2"></span>
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
					Add Departments
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								Name:
								<input type="text" class="form-control" placeholder="Department Name" name="d_name" required/>
							</div>
						</div><br />
						<div class="row">
							<div class="col-md-6">
								Status:
								<select class="form-control selectpicker" name="d_status">
									<option value="1" >Enable</option>
									<option value="0" >Disable</option>
								</select><br /><br />
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?php 
									Controller::Form(
					                    "settings/departments", 
					                    [
					                        "action"  => "add"  
					                    ]
					                ); 
				                ?>
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
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
				<div class="card lena-card no-border">
					<div class="card-header">
						<span class="icon-plus2"></span> 
						Edit Departments
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
						<?php
							$cat = departments::getBy(["d_id" => url::get(3)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												Name:
												<input type="text" class="form-control" placeholder="Company Name" value="<?= $cat->d_name ?>" name="d_name" required/>
											</div>
										</div><br />
										
										<div class="row">
											<div class="col-md-6">
												Status:
												<select class="form-control selectpicker" name="d_status">
													<option value="1" <?= $cat->d_status == 1 ? "selected":"" ?> >Enable</option>
													<option value="0" <?= $cat->d_status == 0 ? "selected":"" ?> >Disable</option>
												</select><br /><br />
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<?php 
													Controller::Form(
									                    "settings/departments", 
									                    [
									                        "action"  => "edit"  
									                    ]
									                ); 
								                ?>
												<button class="btn btn-success btn-block btn-sm">
													<span class="icon-save"></span> Save
												</button>
											</div>
										</div>
									</form>
								<?php
							}else{
								new Alert("error", "No data found");
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	break;
	
	case "delete":
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
				<div class="card lena-card no-border">
					<div class="card-header">
						<span class="icon-plus2"></span> 
						Remove Departments
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
						<?php
							$cat = departments::getBy(["d_id" => url::get(3)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												<h6>Are you sure to removed "<?= $cat->d_name ?>" category?</h6>
											</div>
										</div><br /><br />
										<div class="row">
											<div class="col-md-6">
												<?php 
													Controller::Form(
									                    "settings/departments", 
									                    [
									                        "action"  => "delete"  
									                    ]
									                ); 
								                ?>
												<button class="btn btn-danger btn-block btn-sm">
													<span class="icon-save"></span> Yes
												</button>
											</div>
										</div>
									</form>
								<?php
							}else{
								new Alert("error", "No data found");
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	break;
	
}
?>
