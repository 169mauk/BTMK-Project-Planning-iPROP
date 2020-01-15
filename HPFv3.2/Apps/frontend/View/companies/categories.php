<?php
new Controller ($_POST);

switch(url::get(2)){
	case "":
	case "all":
	case "list":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					All Categories
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Categories
					</a>
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="" class="text-center">No</th>
								<th width="" class="text-center">Name</th>
								<th width="" class="text-center">User</th>
								<th width="" class="text-center">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(company_category::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->cc_name ?></td>
								<td class="text-center"><?= $c->cc_user ?></td>
								<td class="text-center">
									<a title="Edit Info" href="<?= F::URLParams() ?>/edit/<?= $c->cc_id?>" class="btn btn-sm btn-warning">
										<span class="icon-plus2"></span> Edit
									</a>
									<a title="Delete Info" href="<?= F::URLParams() ?>/delete/<?= $c->cc_id ?>" class="btn btn-sm btn-danger">
										<span class="icon-plus2"></span> Delete
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
					Add Category
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								Name:
								<input type="text" class="form-control" placeholder="Company Name" name="cc_name" required/>
							</div>
						</div><br />
						<div class="row">
							<div class="col-md-6">
								Description:
								<textarea class="form-control" placeholder="Description" name="cc_description"></textarea><br />
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?php 
									Controller::Form(
					                    "companies/categories", 
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
						Edit Category
						
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
						<?php
							$cat = company_category::getBy(["cc_id" => url::get(3)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												Name:
												<input type="text" class="form-control" placeholder="Company Name" value="<?= $cat->cc_name ?>" name="cc_name" required/>
											</div>
										</div><br />
										<div class="row">
											<div class="col-md-6">
												Description:
												<textarea class="form-control" placeholder="Description" name="cc_description"><?= $cat->cc_description ?></textarea><br />
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<?php 
													Controller::Form(
									                    "companies/categories", 
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
						Remove Category
						
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
						<?php
							$cat = company_category::getBy(["cc_id" => url::get(3)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												<h6>Are you sure to removed "<?= $cat->cc_name ?>" category?</h6>
											</div>
										</div><br /><br />
										<div class="row">
											<div class="col-md-6">
												<?php 
													Controller::Form(
									                    "companies/categories", 
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
