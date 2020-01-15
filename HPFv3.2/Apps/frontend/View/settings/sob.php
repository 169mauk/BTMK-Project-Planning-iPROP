<?php
new Controller ($_POST);

switch(url::get(2)){
	case "":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					All Sort Of Budget
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Sort Of Budget
					</a>
				</div>
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="" class="text-center">No</th>
								<th width="" class="text-center">Name</th>
								<th width="" class="text-center">Amount</th>
								<th width="" class="text-center">Description</th>
								<th width="" class="text-center">User</th>
								<th width="" class="text-center">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(sob::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->s_name ?></td>
								<td class="text-center"><?= number_format($c->s_amount, 2) ?></td>
								<td class="text-center"><?= $c->s_description ?></td>
								<td class="text-center"><?= $c->s_user ?></td>
								<td class="text-center">
									<a title="Edit Info" href="<?= F::URLParams() ?>/edit/<?= $c->s_id?>" class="btn btn-sm btn-warning">
										<span class="icon-edit"></span>
									</a>
									<a title="Delete Info" href="<?= F::URLParams() ?>/delete/<?= $c->s_id ?>" class="btn btn-sm btn-danger">
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
					Add Sort Of Budget
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								Name:
								<input type="text" class="form-control" placeholder="Name" name="s_name" required/>
							</div>
						</div><br />
						<div class="row">
							<div class="col-md-6">
								Amount (RM):
								<input type="text" class="form-control" placeholder="Amount" name="s_amount" required/>
							</div>
						</div><br />
						<div class="row">
							<div class="col-md-6">
								Description:
								<textarea class="form-control" placeholder="Description" name="s_description"></textarea><br />
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?php 
									Controller::Form(
					                    "settings/sob", 
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
						Edit Sort Of Budget
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
						<?php
							$cat = sob::getBy(["s_id" => url::get(3)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												Name:
												<input type="text" class="form-control" placeholder="Name" value="<?= $cat->s_name ?>" name="s_name" required/>
											</div>
										</div><br />
										
										<div class="row">
											<div class="col-md-6">
												Amount (RM):
												<input type="text" class="form-control" placeholder="Amount" value="<?= $cat->s_amount ?>" name="s_amount" required/>
											</div><br />
										</div>
										<div class="row">
											<div class="col-md-6">
												Description:
												<textarea class="form-control" placeholder="Address" name="s_description"><?= $cat->s_description ?></textarea><br />
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<?php 
													Controller::Form(
									                    "settings/sob", 
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
						Remove Sort Of Budget
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
						<?php
							$cat = sob::getBy(["s_id" => url::get(3)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												<h6>Are you sure to removed "<?= $cat->s_name ?>" category?</h6>
											</div>
										</div><br /><br />
										<div class="row">
											<div class="col-md-6">
												<?php 
													Controller::Form(
									                    "settings/sob", 
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
