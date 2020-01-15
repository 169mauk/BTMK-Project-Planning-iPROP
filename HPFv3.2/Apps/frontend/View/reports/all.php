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
					Reports Listing
					
					<!--
					<a href="<?= F::URLParams() ?>/submit_report" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Submit a report
					</a>
					-->
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="10%" class="text-center">Date</th>
								<th class="text-center">Title</th>
								<th class="text-center">Project</th>
								<th class="text-center">Claim Amount</th>
								<th class="text-center">Status</th>
								<th width="10%" class="text-center">Setting</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(reports::list() as $r){
						?>
							<tr>
								<td class="5% text-center"><?= $no++ ?></td>
								<td class="10% text-center"><?= isset($r->r_date) ? $r->r_date : "n/a" ?></td>
								<td class="text-center"><?= isset($r->r_title) ? $r->r_title : "n/a" ?></td>
								<td class="text-center">
									<?php
										$p = projects::getBy(["p_id" => $r->r_project]);

										if(count($p) > 0){
											echo $p[0]->p_name;
										}else{
											echo "n/a";
										}
									?>
										
								</td>
								<td class="10% text-center"><?= isset($r->r_claim) ? $r->r_claim : "0" ?></td>

								<?php
								if(isset($r->r_status)){
									switch ($r->r_status){
										case 0:
											$status = "Pending";
										break;
										
										case 1:
											$status = "Approved";
										break;

										case 2:
											$status = "Rejected";
										break;
									}	
								}else{
									$status = "NIL";
								}
									
								?>

								<td class="text-center"><?= $status ?></td>
								<td class="text-center">
									<a title="Edit Info" href="<?= F::URLParams() ?>/edit_report/<?= $r->r_id?>" class="btn btn-sm btn-warning btn-block">
										<i class="icon-edit"></i> Edit
									</a>
								<?php
									if($r->r_user == $_SESSION["user_id"]){
								?>
									<a title="Delete Info" href="<?= F::URLParams() ?>/delete_report/<?= $r->r_id ?>" class="btn btn-sm btn-danger btn-block">
										<i class="icon-trash"></i> Delete
									</a>
								<?php
									}
									
									if($_SESSION["role"] > 0 && $r->r_status == 0){
								?>
									<a title="Approve Info" href="<?= F::URLParams() ?>/approve_report/<?= $r->r_id ?>" class="btn btn-sm btn-success btn-block">
										<i class="icon-check"></i> Approve
									</a>
									
									<a title="Reject Info" href="<?= F::URLParams() ?>/reject_report/<?= $r->r_id ?>" class="btn btn-sm btn-danger btn-block">
										<i class="icon-times"></i> Reject
									</a>
								<?php
									}
								?>
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
	
	case "submit_report":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					<span class="icon-plus2"></span> 
					Report Submission
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								Title:
								<input type="text" class="form-control" placeholder="Title" name="report_title" /><br />
								
								Project:
								<select class="form-control selectpicker" data-live-search="true" name="report_project">
								<?php
									foreach(projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department IN (". $_SESSION["department"] ."))"]) as $project){
								?>
									<option value="<?= $project->p_id ?>"><?= $project->p_main ? "[SUB] " : "" ?><?= $project->p_name ?></option>
								<?php
									}
								?>
								</select>
								<br/><br/>
								
								Description:
								<input type="text" class="form-control" placeholder="Write a short description" name="report_description"/><br />

								Report Image:<br/>
								<div class="input-group">
								  	<div class="input-group-prepend">
								    	<span class="input-group-text">Upload Image</span>
								  	</div>
									
								  	<div class="custom-file">
								    	<input type="file" accept="image/*" id = "pic" multiple name="file[]" class="custom-file-input"/>
								    	<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
								  	</div>
								</div>
							</div>

			                <div class="col-md-6">
								Report Claim:
								<input type="text" class="form-control" placeholder="Amount (MYR)" name="report_claim"/><br />
								
							<?php 
								Controller::Form(
				                    "report/report_handler", 
				                    [
				                        "action"  => "new_report"  
				                    ]
				                ); 
			                ?>

								Location:
								<div id="us3" style="height: 250px;"></div>
								
								<input type="hidden" class="location" id="us3-lon" name="report_location" value="3.139003,101.68685499999992" />
								<br />

								<?php
									$portal = PORTAL;
									Page::bodyAppend(<<<X
									<script src="$portal/assets/vendor/locationpicker/locationpicker.jquery.js"></script>
									<script>
										$('#us3').locationpicker({
											location: {
												latitude:  '3.139003',
												longitude: '101.68685499999992'
											},
											radius: 50,
											inputBinding: {
											},
											enableAutocomplete: true,
											onchanged: function (currentLocation, radius, isMarkerDropped) {
												console.log(currentLocation);
												$(".location").val(currentLocation.latitude + "," + currentLocation.longitude)
											}
										});
									</script> 
X
);
								?>
							</div>

							<div class="col-md-12">
								Content:
								<textarea class="form-control summernote" placeholder="Content" name="report_content"></textarea><br />
							</div>
							
							<div class="col-md-12 text-center">
								<button class="btn btn-success btn-block btn-sm">
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
	
	case "edit_report":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					<span class="icon-plus2"></span> 
					Edit Report
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
				<?php
					$report = reports::getBy(["r_id" => url::get(3)]);
					if(count($report) > 0){
						$report = $report[0];
						?>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									Report Title:
									<input type="text" class="form-control form-control-lg" placeholder="Company Name" name="r_title_edit" value="<?= $report->r_title ?>" required/><br />
									
									Project:
									<select class="form-control selectpicker form-control-lg" data-live-search="true" name="r_project_edit" required>
									<?php
										foreach(projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department IN (". $_SESSION["department"] ."))"]) as $rc){
										?>
										<option value="<?= $rc->p_id ?>" <?= $rc->p_id == $report->r_project ? "selected" : "" ?> ><?= $rc->p_name ?></option>
										<?php
										}
									?>
									</select><br /><br />

									Report Description:
									<input type="text" class="form-control" placeholder="Report Description" name="r_description_edit" value="<?= $report->r_description ?>" required/><br />
									
									Status:
									<select class="form-control selectpicker" data-live-search="true" name="status">
										<option value="0" <?= !$report->r_status ? "selected" : "" ?>>Pending</option>
										<option value="1" <?= $report->r_status == 1 ? "selected" : "" ?>>Approved</option>
										<option value="2" <?= $report->r_status == 2 ? "selected" : "" ?>>Rejected</option>
									</select><br /><br />
								</div>
								
								<div class="col-md-6">
									Report Claim (RM):
									<input type="text" class="form-control form-control-lg" placeholder="Amount (RM)" name="r_claim_edit" value="<?= $report->r_claim ?>"  /><br />
																			
									Report Image:
									<input type="file" id = "pic" multiple name="file[]" class=""/>
									<br /><br />
									
									<?php
									$image = report_images::getBy(["ri_report" => url::get(3)]);
									if(!(count($image) > 0)){
									?>
									<br />No images was submitted with this report.<br/>
									<?php
									}else{
										foreach($image as $row){ 
									?>
										<a href="<?= PORTAL ?>assets/medias/reports/<?= $row->ri_image ?>" target="_blank">
											<u><?= $row->ri_image ?></u> 
										</a><br />
									<?php 
										}
									}
									?>
								</div>

								<div class="col-md-12">
									<br/>
									Report Content:
									<textarea class="form-control summernote" placeholder="Content" name="r_content_edit"><?= $report->r_content ?></textarea><br />
								</div>


							<div class="col-md-12">
								<button class="btn btn-success btn-block btn-sm">
									<span class="icon-save"></span> Save
								</button>

								<?php 
									Controller::Form(
										"report/report_handler", 
										[
											"action"  => "edit_report"  
										]
									); 
								?>
							</div>
							
							<div class="col-md-6" style="margin-top: 20px;">
								<div class="card ">
									<div class="card-header bg-info">
										<span class="icon-money"></span> Payment Information
									</div>
									
									<div class="card-body">
										Invoice No:
										<?= $report->r_invoiceNo ?><br /><br />
										
										Invoice Date:
										<?= $report->r_invoiceDate ?><br /><br />
										
										Invoice Acknowlegement Date:
										<?= $report->r_invoiceAcknowledgeDate ?><br /><br /> 
										
										LO No:
										<?= $report->r_loNo ?><br /><br />
										
										Voucher No:
										<?= $report->r_voucherNo ?><br /><br />
										
										Rejection Note:
										<?= $report->r_rejectNote ?>
									</div>
								</div>
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

	case "delete_report":
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
				<div class="card lena-card no-border">
					<div class="card-header">
						<span class="icon-plus2"></span> 
						Delete Report
						
						<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
					<?php
						$report = reports::getBy(["r_id" => url::get(3)]);
						if(count($report) > 0){
							$report = $report[0];
							?>
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-6">
											<h6>Are you sure to remove "<?= $report->r_title ?>" report?</h6>
										</div>
									</div><br /><br />
									<div class="row">
										<div class="col-md-6">
											<?php 
												Controller::Form(
													"report/report_handler", 
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

	case "approve_report":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					<span class="icon-plus2"></span> 
					Approve Report
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
				<?php
					$report = reports::getBy(["r_id" => url::get(3)]);
					if(count($report) > 0){
						$report = $report[0];
				?>
					<form action="" method="POST">
						<h3>Report Summary</h3>

						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">
										<h5>Title:<br/> <?= $report->r_title ?></h5>
									</div>

									<div class="col-md-6">
										<?php
											$user = users::getBy(["user_id" => $report->r_user]);
											if(count($user) > 0){
												$user = $user[0];
											}else{
												$user = null;
											}
										?>

										<h5>Submitted by:<br/> <?= !is_null($user) ? $user->user_name : "UNKNOWN" ?></h5>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<?php
											$project = projects::getBy(["p_id" => $report->r_project]);
											if(count($project)>0){
												$project = $project[0];
											}else{
												$project = null;
											}
										?>

										<h5>Project Cost:<br/> RM <?= !is_null($project) ? $project->p_cost : "0.00" ?></h5><br/>
									</div>

									<div class="col-md-6">
										<h5>Claim Amount:<br/> RM <?= $report->r_claim ?></h5><br/>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<h5>Report Description</h5>
										<br/>
										<p><?= $report->r_description ?></p>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<h5>Report Content</h5>
										<br/>
										<?= $report->r_content ?>
									</div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="card card-info">
									<div class="card-header bg-info">
										<span class="icon-money"></span> Payment Information
									</div>
									
									<div class="card-body">
										Invoice No:
										<input type="text" class="form-control" placeholder="Invoice Number" name="invoiceNo" value="<?= $report->r_invoiceNo ?>" /><br />
										
										Invoice Date:
										<input type="text" class="form-control" placeholder="Invoice Date" name="invoiceDate" value="<?= $report->r_invoiceDate ?>" /><br />
										
										Invoice Acknowlegement Date:
										<input type="text" class="form-control" placeholder="Acknowledgement Date" name="invoiceAcknowledgeDate" value="<?= $report->r_invoiceAcknowledgeDate ?>" /><br /> 
										
										LO No:
										<input type="text" class="form-control" placeholder="LO Number" name="loNo" value="<?= $report->r_loNo ?>" /><br />
										
										Voucher No:
										<input type="text" class="form-control" placeholder="Voucher Number"  name="voucherNo" value="<?= $report->r_voucherNo ?>" /><br />
										
										Voucher Date:
										<input type="date" class="form-control" placeholder="Voucher Date"  name="voucherDate" value="<?= $report->r_voucherDate ?>" /><br />
									</div>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-12 text-center">
								<h6>Are you sure to approve "<?= $report->r_title ?>" report?</h6>
								<?php 
									Controller::Form(
										"report/report_handler", 
										[
											"action"  => "approve"  
										]
									); 
								?>
								
								<button class="btn btn-success btn-sm">
									Approve
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

	case "reject_report":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					<span class="icon-plus2"></span> 
					Reject Report
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				<div class="card-body">
				<?php
					$report = reports::getBy(["r_id" => url::get(3)]);
					if(count($report) > 0){
						$report = $report[0];
					?>
					<form action="" method="POST">
						<h3>Report Summary</h3>
						
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">
										<h5>Title:<br/> <?= $report->r_title ?></h5>
									</div>

									<div class="col-md-6">
										<?php
											$user = users::getBy(["user_id" => $report->r_user]);
											if(count($user) > 0){
												$user = $user[0];
											}else{
												$user = null;
											}
										?>

										<h5>Submitted by:<br/> <?= !is_null($user) ? $user->user_name : "UNKNOWN" ?></h5>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<?php
											$project = projects::getBy(["p_id" => $report->r_project]);
											if(count($project)>0){
												$project = $project[0];
											}else{
												$project = null;
											}
										?>

										<h5>Project Cost:<br/> RM <?= !is_null($project) ? $project->p_cost : "0.00" ?></h5><br/>
									</div>

									<div class="col-md-6">
										<h5>Claim Amount:<br/> RM <?= $report->r_claim ?></h5><br/>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<h5>Report Description</h5>
										<br/>
										<p><?= $report->r_description ?></p>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<h5>Report Content</h5>
										<br/>
										<?= $report->r_content ?>
									</div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="card card-info">
									<div class="card-header bg-danger">
										Reject Note
									</div>
									
									<div class="card-body">
										<textarea class="form-control" placeholder="Reject?" name="rejectNote"><?= $report->r_rejectNote ?></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12 text-center">
								<?php 
									Controller::Form(
										"report/report_handler", 
										[
											"action"  => "reject"  
										]
									); 
								?>
								<button class="btn btn-danger btn-sm">
									Reject
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
	
	
	case "view":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					<span class="icon-plus2"></span> 
					Edit Report
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
				<?php
					$report = reports::getBy(["r_id" => url::get(3)]);
					if(count($report) > 0){
						$report = $report[0];
						?>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									Report Title:
									<input type="text" disabled class="form-control form-control-lg" placeholder="Company Name" name="r_title_edit" value="<?= $report->r_title ?>" required/><br />
									
									Project:
									<select disabled class="form-control selectpicker form-control-lg" data-live-search="true" name="r_project_edit" required>
									<?php
										foreach(projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department IN (". $_SESSION["department"] ."))"]) as $rc){
										?>
										<option value="<?= $rc->p_id ?>" <?= $rc->p_id == $report->r_project ? "selected" : "" ?> ><?= $rc->p_name ?></option>
										<?php
										}
									?>
									</select><br /><br />

									Report Description:
									<input disabled type="text" class="form-control" placeholder="Report Description" name="r_description_edit" value="<?= $report->r_description ?>" required/><br />
									
									Status:
									<select disabled class="form-control selectpicker" data-live-search="true" name="status">
										<option value="0" <?= !$report->r_status ? "selected" : "" ?>>Pending</option>
										<option value="1" <?= $report->r_status == 1 ? "selected" : "" ?>>Approved</option>
										<option value="2" <?= $report->r_status == 2 ? "selected" : "" ?>>Rejected</option>
									</select><br /><br />
								</div>
								
								<div class="col-md-6">
									Report Claim (RM):
									<input disabled type="text" class="form-control form-control-lg" placeholder="Amount (RM)" name="r_claim_edit" value="<?= $report->r_claim ?>"  /><br />
																			
									Report Image:
									<input disabled type="file" id = "pic" multiple name="file[]" class=""/>
									<br /><br />
									
									<?php
									$image = report_images::getBy(["ri_report" => url::get(3)]);
									if(!(count($image) > 0)){
									?>
									<br />No images was submitted with this report.<br/>
									<?php
									}else{
										foreach($image as $row){ 
									?>
										<a href="<?= PORTAL ?>assets/medias/reports/<?= $row->ri_image ?>" target="_blank">
											<u><?= $row->ri_image ?></u> 
										</a><br />
									<?php 
										}
									}
									?>
								</div>

								<div class="col-md-12">
									<br/>
									Report Content:
									<?= $report->r_content ?>
								</div>


							<div class="col-md-12">
							</div>
							
							<div class="col-md-6" style="margin-top: 20px;">
								<div class="card ">
									<div class="card-header bg-info">
										<span class="icon-money"></span> Payment Information
									</div>
									
									<div class="card-body">
										Invoice No:
										<?= $report->r_invoiceNo ?><br /><br />
										
										Invoice Date:
										<?= $report->r_invoiceDate ?><br /><br />
										
										Invoice Acknowlegement Date:
										<?= $report->r_invoiceAcknowledgeDate ?><br /><br /> 
										
										LO No:
										<?= $report->r_loNo ?><br /><br />
										
										Voucher No:
										<?= $report->r_voucherNo ?><br /><br />
										
										Rejection Note:
										<?= $report->r_rejectNote ?>
									</div>
								</div>
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
}
?>
