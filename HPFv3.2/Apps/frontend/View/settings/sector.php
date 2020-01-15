<?php
new Controller ($_POST);

switch(url::get(2)){
	case "":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					All Sectors
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Sectors
					</a>
				</div>
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="" class="text-center">Name</th>
								<th width="15%" class="text-center">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(sectors::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->s_name ?></td>
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
					Add Sector
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								Name:
								<input type="text" class="form-control" placeholder="Sector Name" name="name" required/>
							</div>
						</div><br />
						<div class="row">
							<div class="col-md-6">
								<?php 
									Controller::Form(
					                    "settings/sectors", 
					                    [
					                        "action"  => "add"  
					                    ]
					                ); 
				                ?>
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
	break;
	
	case "edit":
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
				<div class="card lena-card no-border">
					<div class="card-header">
						<span class="icon-edit"></span> 
						Edit Sector
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
						<?php
							$cat = sectors::getBy(["s_id" => url::get(3)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												Name:
												<input type="text" class="form-control" placeholder="Sector Name" value="<?= $cat->s_name ?>" name="name" required/>
											</div>
										</div><br />
										
										<div class="row">
											<div class="col-md-6">
												<?php 
													Controller::Form(
									                    "settings/sectors", 
									                    [
									                        "action"  => "edit"  
									                    ]
									                ); 
								                ?>
												<button class="btn btn-success btn-sm">
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
						<span class="icon-trash"></span> 
						Delete Sector
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
						<?php
							$cat = sectors::getBy(["s_id" => url::get(3)]);
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
									                    "settings/sectors", 
									                    [
									                        "action"  => "delete"  
									                    ]
									                ); 
								                ?>
												<button class="btn btn-danger btn-sm">
													<span class="icon-trash"></span> Remove Permanently
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
