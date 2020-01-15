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
					Categories
					
					<a href="<?= F::URLParams() ?>/add_categories" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Category
					</a>
				</div>
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="40%" class="text-center">Category</th>
								<th width="40%" class="text-center">Project</th>
								<th width="15%" class="text-center">Setting</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(reports_category::list() as $rc){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $rc->rc_title ?></td>
								<td class="text-center"><?= $rc->rc_projects ?></td>
								<td class="text-center">
									<a title="Edit Info" href="<?= F::URLParams() ?>/edit_categories/<?= $rc->rc_id?>" class="btn btn-sm btn-warning">
										</span> Edit
									</a>
									<a title="Delete Info" href="<?= F::URLParams() ?>/delete_categories/<?= $rc->rc_id ?>" class="btn btn-sm btn-danger">
										</span> Delete
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
	
	case "add_categories":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">
							<span class="icon-plus2"></span> 
							New Report Category Submission
							
							<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
								Back
							</a>
						</div>
					</div>
					
				</div>
				<div class="card-body">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-4">
								Category:
								<input type="text" class="form-control form-control-lg" name="category_title" placeholder="Title" /><br />

								Project:
								<select class="form-control selectpicker form-control-lg" data-live-search="true" name="category_project">
								<?php
									foreach(projects::list() as $p){
									?>
									<option value="<?= $p->p_id ?>"><?= $p->p_name ?></option>
									<?php
									}
								?>
								</select><br /><br />

								<?php 
									Controller::Form(
					                    "report/category_handler", 
					                    [
					                        "action"  => "new_category"  
					                    ]
					                ); 
				                ?>
								
								<button class="btn btn-success btn-block btn-lg">
									<span class="icon-save"></span> Submit
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
	
	case "edit_categories":
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
							$rc_edit = reports_category::getBy(["rc_id" => url::get(3)]);
							if(count($rc_edit) > 0){
								$rc_edit = $rc_edit[0];
								?>
								<form action="" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-4">
											Category:
											<input type="text" class="form-control form-control-lg" placeholder="Client Name" name="edit_rc_title" value="<?= $rc_edit->rc_title ?>"/>

											Project:
											<select class="form-control selectpicker form-control-lg" data-live-search="true" name="edit_rc_project">
											<?php
												foreach(projects::list() as $p){
												?>
												<option value="<?= $p->p_id ?>"><?= $p->p_name ?></option>
												<?php
												}
											?>
											</select><br /><br />

											<?php 
												Controller::Form(
								                    "report/category_handler", 
								                    [
								                        "action"  => "edit"  
								                    ]
								                ); 
							                ?>

											<button class="btn btn-success btn-block btn-lg">
												<span class="icon-save"></span> Save
											</button>
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
	
	case "delete_categories":
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
							$cat = reports_category::getBy(["rc_id" => url::get(3)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-4">
												<h6>Are you sure to remove "<?= $cat->rc_title ?>" category?</h6>
											</div>
										</div><br /><br />
										<div class="row">
											<div class="col-md-4">
												<?php 
													Controller::Form(
									                    "report/category_handler", 
									                    [
									                        "action"  => "delete"  
									                    ]
									                ); 
								                ?>
												<button class="btn btn-danger btn-block btn-lg">
													</span> Yes
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
