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
						Payment Listing
					</div>

					<div class="card-body">
					<table class="table table-hover table-fluid table-bordered">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="10%" class="text-center">Date</th>
								<th class="text-center">Project</th>
								<th class="10% text-center">Company name</th>
								<th class="10% text-center">Claim Amount</th>
								<th class="10% text-center">Submitted by</th>
								<th class="10% text-center">Approved by</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							
								foreach(reports::list(["where" => "r_status = 1"]) as $r){
								?>
								<tr>
									<td class="5% text-center"><?= $no++ ?></td>
									<td class="10% text-center"><?= $r->r_date ?></td>
									<td class="text-center">
										<?php
											$project = projects::getBy(["p_id" => $r->r_project ]);
											
											if(count($project) > 0){
												$project=$project[0];
												echo $project->p_name;
												
											}else{
												echo "No project found";
											}
										?>
									</td>
									<td class="10% text-center">
										<?php
											$pc = project_company::getBy(["c_project" => $r->r_project]);
											
											if(count($pc) > 0){
												$pc = $pc[0];
												$comp = companies::getBy(["c_id" =>$pc->c_company]);
												if(count($comp) > 0){
													$comp = $comp[0];
													echo $comp->c_name;
												}else{
													echo "No Company found";
												}
												
											}else{
												echo "No project found";
											}
										?>
									</td>
									<td class="10% text-center"><?= number_format($r->r_claim, 2) ?></td>
									<td class="10% text-center">
										<?php
											$user = users::getBy(["user_id" => $r->r_user]);
										  	if(count($user) > 0){
										  		$user = $user[0];
												echo $user->user_name;
										  	}
										 ?>
									</td>
								<td class="10% text-center">
									<?php
										$user = users::getBy(["user_id" => $r->r_verify]);
									  	if(count($user) > 0){
									  		$user = $user[0];
											echo $user->user_name;
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

	case "report_summary":
		?>
			<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
				<div class="card lena-card no-border">
					<div class="card-header">
						Report Summary
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

								<?php
							}else{
								new Alert("error", "No data found");
							}
						?>
					</div>
				</div>
			</div>
		<?php
	break;

	default;
	break;
}