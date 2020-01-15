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
					
					<a href="<?= F::URLParams() ?>/submit_report" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Submit a report
					</a>
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="10%" class="text-center">Date</th>
								<th class="text-center">Title</th>
								<th class="text-center">Project</th>
								<th class="10% text-center">Claim Amount</th>
								<th class="10% text-center">Status</th>
								<th width="10%" class="text-center">Setting</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(reports::list() as $r){
								if(isset($r)){
									?>

									<tr>
								<td class="5% text-center"><?= $no++ ?></td>
								<td class="10% text-center"><?= isset($r->r_date) ? $r->r_date : "n/a" ?></td>
								<td class="text-center"><?= isset($r->r_title) ? $r->r_title : "n/a" ?></td>
								<td class="text-center">
									<?php
										if(isset($r->r_project)){
											$p = projects::getBy(["p_id" => $r->r_project]);

											if(count($p) > 0){
												echo $p[0]->p_name;
											}else{
												echo "n/a";
											}

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
									$status = "n/a";
								}
									
								?>

								<td class="10% text-center"><?= $status ?></td>
								<td class="10% setting text-center">

									<?php 
										if($r->r_user == $_SESSION["user_id"]){
											?>

											<a href="<?= F::URLParams() ?>/edit_report/<?= $r->r_id?>" class="btn btn-sm btn-warning" style="width: 50px" >
												<i class="icon-edit"></i>
											</a>
									
											<a href="<?= F::URLParams() ?>/delete_report/<?= $r->r_id ?>" class="btn btn-sm btn-danger" style="width: 50px;">
												<i class="icon-trash"></i>
											</a>
											<br/><br/>
											
										
											<?php
										}

										$ui = users::getBy(["user_id" => $_SESSION["user_id"]]);
										if(count($ui) > 0){
											// we will define webm/admin as user role 1 & 2 respectively
											if(strstr($ui[0]->user_role, "1") || strstr($ui[0]->user_role, "2")){
												?>

												<a href="<?= F::URLParams() ?>/approve_report/<?= $r->r_id ?>" class="btn btn-sm btn-success" style="width: 50px;">
													<i class="icon-check"></i>
												</a>
												


												
													<a href="<?= F::URLParams() ?>/reject_report/<?= $r->r_id ?>" class="btn btn-lg btn-danger" style="width: 50px;">
													<i class="fas fa-times"></i>
												</a>
												<?php
											}
										}
									
									?>
								</td>
							</tr>
							<?php
								}else{
									continue;
								}
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
								<input type="text" class="form-control form-control-lg" placeholder="Title" name="report_title" /><br />
								<?php
								/*
								Category:
								<select class="form-control form-control-lg selectpicker" data-live-search="true" name="report_category">
								<?php
									foreach(reports_category::list() as $rc){
									?>
									<option value="<?= $rc->rc_id ?>"><?= $rc->rc_title ?></option>
									<?php
									}
								?>
								</select><br /><br />
								*/
								?>
								Project:
								<select class="form-control form-control-lg selectpicker" data-live-search="true" name="report_project">
								<?php
									foreach(reports_category::list() as $rc){
										$project = projects::getBy(["p_id"=>$rc->rc_projects]);
										if(count($project) > 0){
											$project = $project[0];
										}
									?>
									<option value="<?= $project->p_id ?>"><?= $project->p_name ?></option>

									<?php
									}
								?>
								</select>
								<br/><br/>
								
								Description:
								<input type="text" class="form-control form-control-lg" placeholder="Write a short description" name="report_description"/><br />

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
								<input type="text" class="form-control form-control-lg" placeholder="Amount (MYR)" name="report_claim"/><br />

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
								
								<input type="hidden" class=" location" id="us3-lon" name="report_location" value="3.139003,101.68685499999992" />
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

				            <div class="col-md-3">
							</div>

							<div class="col-md-6">
								<button class="btn btn-success btn-block btn-lg">
									<span class="icon-save"></span> Submit
								</button>
							</div>

							<div class="col-md-3">
							</div>
											
								
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
											<input type="text" class="form-control form-control-lg" placeholder="Company Name" name="r_title_edit" value="<?= $report->r_title ?>" required/><br /><br />
											
											<?php
											/*
											Report Category:
											<select class="form-control selectpicker form-control-lg" data-live-search="true" name="r_category_edit" required>
											<?php
												foreach(reports_category::list() as $rc){
												?>
												<option value="<?= $rc->rc_id ?>" <?= $rc->rc_id==$report->r_category? "selected" : "" ?> ><?= $rc->rc_title ?></option>
												<?php
												}
											?>
											</select><br /><br />
											*/
											?>
											
											Report Project:
											<select class="form-control selectpicker form-control-lg" data-live-search="true" name="r_project_edit" required>
											<?php
												foreach(projects::list() as $rc){
												?>
												<option value="<?= $rc->rc_id ?>" <?= $rc->p_id == $report->r_project ? "selected" : "" ?> ><?= $rc->p_name ?></option>
												<?php
												}
											?>
											</select><br /><br />

											Report Description:
											<input type="text" class="form-control" placeholder="Report Description" name="r_description_edit" value="<?= $report->r_description ?>" required/><br /><br />
											
										</div>

										

										<div class="col-md-6">
											Report Claim (RM):
											<input type="text" class="form-control form-control-lg" placeholder="Amount (RM)" name="r_claim_edit" value="<?= $report->r_claim ?>" required/><br />
											
											<br />
											
											Report Image:
										<br/>
										<div class="baguetteBoxThree gallery">
											<input type="file" accept="image/*" id = "pic" multiple name="file[]" class=""/>
										<?php
											$image = report_images::getBy(["ri_report" => url::get(3)]);
											if(!(count($image) > 0)){
											?>

												<br />No images was submitted with this report.<br/>

											<?php }else{ ?>
												
												<div class="row">
												<?php foreach($image as $row){ ?>
																
													<div class="col-lg-2 col-md-2 col-sm-2 text-center">
														<a href="<?= PORTAL ?>assets/medias/reports/<?= $row->ri_image ?>" class="effects">
															<img src="<?= PORTAL ?>assets/medias/reports/<?= $row->ri_image ?>" class="img-responsive" alt="Image is not supported by your browser.">
															<div class="overlay">
																<span class="expand icon-zoom-in2"></span>
															</div>
														</a>
													</div>
												<?php } ?>
												</div>
											<?php } ?>
											</div>	
										</div>

										<div class="col-md-12">
											<br/>
											Report Content:
											<textarea class="form-control summernote" placeholder="Content" name="r_content_edit"><?= $report->r_content ?></textarea><br />
										</div>


									<div class="col-md-12">
										<button class="btn btn-success btn-block btn-lg">
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

										<div class="row">
											<div class="col-md-6">
												<h3>Report Summary</h3>
											</div>
										</div>
										<br/>

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
										<br/>

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
											<div class="col-md-6">
												<h5>Paid Amount:<br/> RM <?= $report->r_paid ?></h5><br/>
											</div>
											<div class="col-md-6">
												<h5>Unpaid Amount:<br/> RM <?= $report->r_balance ?></h5><br/>
											</div>
										</div>


										<div class="row">
											<div class="col-md-12">
													<h5>Report Description</h5>
													<br/>
													<p><?= $report->r_description ?></p>
											</div>
										</div>
										<br/>

										<div class="row">
											<div class="col-md-12">
													<h5>Report Content</h5>
													<br/>
													<?= $report->r_content ?>
											</div>
										</div>
										<br/>

											</div>

											<div class="col-md-6">
													<h5>Location:</h5>
										
														<div id="us3" style="height: 250px;"></div>
														
														<input type="hidden" class="location" id="us3-lon" name="r_location_delete" value="<?= $report->r_location ?>" />
														<br />
														<?php
															$portal = PORTAL;
															Page::bodyAppend(<<<X
															<script src="$portal/assets/vendor/locationpicker/locationpicker.jquery.js"></script>
															<script>
																let initial_location = $('.location').val();
																let coords = initial_location.split(',');
																$('#us3').locationpicker({
																	location: {
																		latitude:  coords[0],
																		longitude: coords[1]
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
												<button class="btn btn-success btn-block btn-lg">
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

										<div class="row">
											<div class="col-md-6">
												<h3>Report Summary</h3>
											</div>
										</div>
										<br/>

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
														}
													?>

													<h5>Submitted by:<br/> <?= $user->user_name ?></h5>
												</div>

												

										</div>
										<br/>

										<div class="row">
											<div class="col-md-6">
												<?php
													$project = projects::getBy(["p_id" => $report->r_project]);
													if(count($project)>0){
														$project = $project[0];
													}
												?>

												<h5>Project Cost:<br/> RM <?= $project->p_cost ?></h5><br/>
											</div>

											<div class="col-md-6">
												<h5>Claim Amount:<br/> RM <?= $report->r_claim ?></h5><br/>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<h5>Paid Amount:<br/> RM <?= $report->r_paid ?></h5><br/>
											</div>
											<div class="col-md-6">
												<h5>Unpaid Amount:<br/> RM <?= $report->r_balance ?></h5><br/>
											</div>
										</div>


										<div class="row">
											<div class="col-md-12">
													<h5>Report Description</h5>
													<br/>
													<p><?= $report->r_description ?></p>
											</div>
										</div>
										<br/>

										<div class="row">
											<div class="col-md-12">
													<h5>Report Content</h5>
													<br/>
													<?= $report->r_content ?>
											</div>
										</div>
										<br/>

											</div>

											<div class="col-md-6">
													Location:
										
														<div id="us3" style="height: 250px;"></div>
														
														<input type="hidden" class="location" id="us3-lon" name="r_location_delete" value="<?= $report->r_location ?>" />
														<br />
														<?php
															$portal = PORTAL;
															Page::bodyAppend(<<<X
															<script src="$portal/assets/vendor/locationpicker/locationpicker.jquery.js"></script>
															<script>
																let initial_location = $('.location').val();
																let coords = initial_location.split(',');
																$('#us3').locationpicker({
																	location: {
																		latitude:  coords[0],
																		longitude: coords[1]
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
										</div>


										<div class="row">
											<div class="col-md-12 text-center">
												<h6>Are you sure to reject "<?= $report->r_title ?>" report?</h6>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<?php 
													Controller::Form(
									                    "report/report_handler", 
									                    [
									                        "action"  => "reject"  
									                    ]
									                ); 
								                ?>
												<button class="btn btn-danger btn-block btn-lg">
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
	
}
?>
