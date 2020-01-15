<?php
new Controller ();

switch(url::get(2)){
	case "":
	case "all":
	case "list":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					All Companies
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Companies
					</a>
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="" class="text-center">No</th>
								<th width="" class="text-center">Name</th>
								<th>Email</th>
								<th width="30%" class="text-center">Address</th>
								<th width="" class="text-center">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(companies::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->c_name ?></td>
								<td><?= $c->c_email ?></td>
								<td class="text-center"><?= $c->c_address ?></td>
								<td class="text-center">
									<a title="Edit Info" href="<?= F::URLParams() ?>/edit/<?= $c->c_id?>" class="btn btn-sm btn-warning">
										<span class="icon-plus2"></span> Edit
									</a>
									<a title="Delete Info" href="<?= F::URLParams() ?>/delete/<?= $c->c_id ?>" class="btn btn-sm btn-danger">
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
					Add Company
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								Name:
								<input type="text" class="form-control" placeholder="Company Name" name="c_name"/>
							</div>
							<div class="col-md-6">
								Email:
								<input type="text" class="form-control" placeholder="Email" name="c_email"/><br />
							</div>
							<div class="col-md-4">
								Phone:
								<input type="text" class="form-control" placeholder="Phone" name="c_phone"/>
							</div>
							<div class="col-md-4">
								Reg No:
								<input type="text" class="form-control" placeholder="Registration No" name="c_regno"/><br />
							</div>
							<div class="col-md-4">
								Category:
								<select class="form-control selectpicker" data-live-search="true" name="c_category">
								<?php
									foreach(company_category::list() as $cc){
									?>
									<option value="<?= $cc->cc_id ?>"><?= $cc->cc_name ?></option>
									<?php
									}
								?>
								</select>
							</div>
							<div class="col-md-12">
								<input type="file" accept="image/*" multiple name="file" class="" required/>
								<br /><br />
							</div>
							<div class="col-md-12">
								Addrress:
								<textarea class="form-control" placeholder="Address" name="c_address"></textarea><br />
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php 
									Controller::Form(
					                    "companies/all", 
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
						Edit Company
						
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					
					<div class="card-body">
						<?php
							$comp = companies::getBy(["c_id" => url::get(3)]);
							if(count($comp) > 0){
								$comp = $comp[0];
								?>
								<form action="" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-6">
											Name:
											<input type="text" class="form-control" placeholder="Company Name" name="c_name" value="<?= $comp->c_name ?>" required/>
										</div>
										<div class="col-md-6">
											Email:
											<input type="text" class="form-control" placeholder="Email" name="c_email" value="<?= $comp->c_email ?>" /><br />
										</div>
										<div class="col-md-4">
											Phone:
											<input type="text" class="form-control" placeholder="Phone" name="c_phone" value="<?= $comp->c_phone ?>" />
										</div>
										<div class="col-md-4">
											Reg No:
											<input type="text" class="form-control" placeholder="Registration No" name="c_regno" value="<?= $comp->c_regno ?>"/><br />
										</div>
										<div class="col-md-4">
											Category:
											<select class="form-control selectpicker" data-live-search="true" name="c_category" required>
											<?php
												foreach(company_category::list() as $cc){
												?>
												<option value="<?= $cc->cc_id ?>" <?= $cc->cc_id==$comp->c_category? "selected" : "" ?> ><?= $cc->cc_name ?></option>
												<?php
												}
											?>
											</select>
										</div>
										<div class="col-md-4">
											<img src="<?= PORTAL ?>assets/medias/companies/<?= $comp->c_logo ?>" class="img img-responsive" width="50%" /><br />
										</div>
										<div class="col-md-12">
											<input type="file" accept="image/*" multiple name="file" class=""/>
											<br /><br />
										</div>
										<div class="col-md-12">
											Addrress:
											<textarea class="form-control" placeholder="Address" name="c_address"><?= $comp->c_address ?></textarea><br />
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<?php 
												Controller::Form(
								                    "companies/all", 
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
								new Alert("error", "Data Not Found");
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
							$cat = companies::getBy(["c_id" => url::get(3)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												<h6>Are you sure to removed "<?= $cat->c_name ?>" category?</h6>
											</div>
										</div><br /><br />
										<div class="row">
											<div class="col-md-6">
												<?php 
													Controller::Form(
									                    "companies/all", 
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
