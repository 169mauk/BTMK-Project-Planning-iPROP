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
					All Clients
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Client
					</a>
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="" class="text-center">No</th>
								<th width="" class="text-center">Name</th>
								<th>Email</th>
								<th width="30%" class="text-center">Company</th>
								<th width="" class="text-center">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(clients::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->cl_name ?></td>
								<td><?= $c->cl_email ?></td>
								<td class="text-center">
									<?php
										foreach (companies::list() as $comp){
											if($comp->c_id == $c->cl_company){
												echo $comp->c_name;
											}
										} 
									?>
								</td>
								<td class="text-center">
									<a href="<?= F::URLParams() ?>/edit/<?= $c->cl_id?>" class="btn btn-sm btn-warning">
										<span class="icon-plus2"></span> Edit
									</a>
									<a href="<?= F::URLParams() ?>/delete/<?= $c->cl_id ?>" class="btn btn-sm btn-danger">
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
					Add Client
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								Name:
								<input type="text" class="form-control" placeholder="Client Name" name="cl_name" required/>
							</div>
							<div class="col-md-6">
								Email:
								<input type="text" class="form-control" placeholder="Email" name="cl_email" required/><br />
							</div>
							<div class="col-md-4">
								Phone:
								<input type="text" class="form-control" placeholder="Phone" name="cl_phone"/>
							</div>
							<div class="col-md-4">
								Title:
								<input type="text" class="form-control" placeholder="Title" name="cl_title"/><br />
							</div>
							<div class="col-md-4">
								Password:
								<input type="password" class="form-control" placeholder="Password" name="cl_password" required/><br />
							</div>
							<div class="col-md-4">
								Company:
								<select class="form-control selectpicker" data-live-search="true" name="cl_company" required>
								<?php
									foreach(companies::list() as $cc){
									?>
									<option value="<?= $cc->c_id ?>"><?= $cc->c_name ?></option>
									<?php
									}
								?>
								</select>
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
					                    "companies/clients", 
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
						Edit Client
						
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					
					<div class="card-body">
						<?php
							$comp = clients::getBy(["cl_id" => url::get(3)]);
							if(count($comp) > 0){
								$comp = $comp[0];
								?>
								<form action="" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-6">
											Name:
											<input type="text" class="form-control" placeholder="Client Name" name="c_name" value="<?= $comp->cl_name ?>"/>
										</div>
										<div class="col-md-6">
											Email:
											<input type="text" class="form-control" placeholder="Email" name="c_email" value="<?= $comp->cl_email ?>"/><br />
										</div>
										<div class="col-md-4">
											Phone:
											<input type="text" class="form-control" placeholder="Phone" name="c_phone" value="<?= $comp->cl_phone ?>"/>
										</div>
										<div class="col-md-4">
											Title:
											<input type="text" class="form-control" placeholder="Title" name="c_regno" value="<?= $comp->cl_title ?>"/><br />
										</div>
										<div class="col-md-4">
											Password:
											<input type="text" class="form-control" placeholder="Password" name="cl_password"/><br />
										</div>
										<div class="col-md-4">
											Category:
											<select class="form-control selectpicker" data-live-search="true" name="c_category">
											<?php
												foreach(companies::list() as $cc){
												?>
												<option value="<?= $cc->c_id ?>" <?= $cc->c_id==$comp->cl_company? "selected" : "" ?> ><?= $cc->c_name ?></option>
												<?php
												}
											?>
											</select>
										</div>
										<div class="col-md-12">
											Addrress:
											<textarea class="form-control" placeholder="Address" name="c_address"><?= $comp->cl_address ?></textarea><br />
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<?php 
												Controller::Form(
								                    "companies/clients", 
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
						Remove Client
						
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
						<?php
							$cat = clients::getBy(["cl_id" => url::get(3)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												<h6>Are you sure to removed "<?= $cat->cl_name ?>" category?</h6>
											</div>
										</div><br /><br />
										<div class="row">
											<div class="col-md-6">
												<?php 
													Controller::Form(
									                    "companies/clients", 
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
