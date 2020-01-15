<?php
new Controller();
?>
<div class="card">
	<div class="card-header">
		Financial Statistic 
	</div>
	
	<div class="card-body">
		<div class="row">
			<div class="col-md-3">
				<div class="col-md-12">
					<form method="POST" action="">
						<div class="row">
							<div class="col-md-8">
								<input type="text" name="search" class="form-control" placeholder="Search Projects"/><br/><br/>
							</div>
							<div class="col-md-4">
								<?= Controller::form("financials") ?>
								<input type="hidden" name="type" value="f_search">
								<button class="btn btn-primary btn-block">
									Search
								</button><br /><br />
							</div>
						</div>
					</form>
					<hr />
				</div>
				
				<form method="POST" action="">
					<div class="col-md-12">
						<?php
							if(!empty(Input::get("department"))){
								$dept = explode(",", Input::get("department"));
							}else{
								$dept = [];
							}
						?>
						Department
						<select name="department[]" class="form-control selectpicker" multiple data-live-search="true">
							<option value="all" <?= in_array("all", $dept) ? "selected" : "" ?>>All</option>
						<?php
							$dep = departments::list();
							foreach ($dep as $d) {
							?>
								<option value="<?= $d->d_id ?>" <?= in_array($d->d_id, $dept) ? "selected" : "" ?>> <?= $d->d_name ?></option>	
							<?php
							}
						?>
						</select><br /><br />
					</div>
					<div class="col-md-12">
						<?php
							if(!empty(Input::get("sector"))){
								$sec = explode(",", Input::get("sector"));
							}else{
								$sec = [];
							}
						?>
						Sector
						<select name="sector[]" class="form-control selectpicker" multiple data-live-search="true">
							<option value="all" <?= in_array("all", $sec) ? "selected" : "" ?>>All</option>
						<?php
							$dep = sectors::list();
							foreach ($dep as $d) {
							?>
								<option value="<?= $d->s_id ?>" <?= in_array($d->s_id, $sec) ? "selected" : "" ?>> <?= $d->s_name ?></option>	
							<?php
							}
						?>
						</select><br /><br />
					</div>
					<div class="col-md-12">
						<?php
							if(!empty(Input::get("status"))){
								$s = explode(",", Input::get("status"));
							}else{
								$s = [];
							}
						?>
						Status (Project)
						<select name="status[]" class="form-control selectpicker" multiple data-live-search="true">
							<option value="all" <?= in_array("all", $s) ? "selected" : "" ?>>All</option>
						<?php
							$dep = settings::getBy(["s_key" => "project_status"]);
							foreach ($dep as $d) {
							?>
								<option value="<?= $d->s_value ?>" <?= in_array($d->s_value, $s) ? "selected" : "" ?>> <?= $d->s_name ?></option>	
							<?php
							}
						?>
						</select><br /><br />
					</div>
					
					<div class="col-md-12">
						<?php
							if(!empty(Input::get("client"))){
								$c = explode(",", Input::get("client"));
							}else{
								$c = [];
							}
						?>
						Clients
						<select name="client[]" class="form-control selectpicker" multiple data-live-search="true">
							<option value="all" <?= in_array("all", $c) ? "selected" : "" ?>>All</option>
						<?php
							foreach (companies::list() as $d) {
							?>
								<option value="<?= $d->c_id ?>" <?= in_array($d->c_id, $c) ? "selected" : "" ?>> <?= $d->c_name ?></option>	
							<?php
							}
						?>
						</select><br /><br />
					</div>
					
					<div class="col-md-12">
						<?= Controller::form("financials") ?>
						<input type="hidden" name="type" value="filter">
						<button class="btn btn-success btn-block">
							Filter
						</button><br /><br />
					</div>
					
					<!-- <div class="col-md-12">
						<table class="table table-hover table-fluid table-bordered table-responsive">
							<thead style="background-color: silver">
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Name</th>
									<th class="text-center">Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$nox = 1;
									foreach(sob::list() as $sob){
										?>
										<tr>
											<td class="text-center"><?= $nox ?></td>
											<td class="text-center"><?= $sob->s_name ?></td>
											<td class="text-center"><?= number_format($sob->s_amount, 2) ?></td>
										</tr>
										<?php
									}
								?>
								
							</tbody>
						</table>
					</div> -->
					<br />
				</form>
			</div>
			<?php
				switch (url::get(1)) {
					case 'search':
						?>
						<div class="col-md-9 text-center">
							<div class="col-md-12 text-right">
								<a class="btn btn-warning text-right" onclick="printDiv('printableArea')"><span class="icon-print"></span> Print</a><br /><br />
							</div>
							
							<div id="printableArea">
								<div class="col-12 col-sm-12 col-xs-12 col-md-12">
									<div class="table-responsive">
										<table class="table table-responsive table-hover table-fluid">
											<thead style="background-color: silver">
												<tr>
													<th class="text-center">Project</th>
													<th class="text-center">Cost (RM)</th>
													<th class="text-center">SOB</th>
													<th class="text-center">Claim (RM)</th>
													<th class="text-center">LO No</th>
												</tr>
											</thead>
											
											<tbody>
												<?php
													$data = F::URLSlugDecode(url::get(2));
													
													$project = DB::conn()->q("SELECT * FROM projects WHERE p_name LIKE  '%$data%'")->results();
													if(count($project) > 0){
														foreach ($project as $pro_exist) {
															$report = reports::getBy(["r_project" => $pro_exist->p_id]);
															if(count($report) > 0){
																$report = $report[0];
																$r_lo = $report->r_loNo;
																$r_claim = $report->r_claim;
															}
															
															?>
															<tr>
																<td>
																	<?= $pro_exist->p_name ?>
																</td>
																<td>
																	<?= number_format($pro_exist->p_cost, 2); ?>
																</td>
																<td>
																	<?php
																		$sob = sob::getBy(["s_id" => $pro_exist->p_sob]);
																		if(count($sob) > 0){
																			$sob = $sob[0];
																			echo $sob->s_name;
																		}
																	?>
																</td>
																<td>
																	<?= number_format($r_claim , 2)?>
																</td>
																<td class="text-center">
																	<?php
																		$r_lo;
																	?>
																</td>
															</tr>
															<?php
														}
													}else{
														?>
														<tr>
															<td class="text-center" colspan="6">
																No project name found
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
					
					default:
						?>
						<div class="col-md-9">
							<div class="col-md-12 text-right">
								<a class="btn btn-warning text-right" onclick="printDiv('printableArea')"><span class="icon-print"></span> Print</a><br /><br />
							</div>
							
							<div id="printableArea">
								<div class="col-12 col-sm-12 col-xs-12 col-md-12">
									<div class="table-responsive">
									<?php
										$sql = "SELECT * FROM reports WHERE r_project IN (SELECT p_id FROM projects ";
										$where = false;
										$department = "";
										$sector = "";
										$client = "";
										$status = "";
										
										if(count($dept)){
											if(!in_array("all", $dept)){
												$where = true;
												
												foreach($dept as $dep){
													if(!empty($dep)){
														if(!empty($department)){
															$department .= ",";
														}
														
														$department .= "'". $dep ."'";
													}
												}
											}
										}
										
										if(count($sec)){
											if(!in_array("all", $sec)){
												$where = true;
												
												foreach($sec as $sx){
													if(!empty($sx)){
														if(!empty($sector)){
															$sector .= ",";
														}
														
														$sector .= "'". $sx ."'";
													}
												}
											}
										}
										
										if(count($s)){
											if(!in_array("all", $s)){
												$where = true;
												
												foreach($s as $st){
													if(!empty($st)){
														if(!empty($status)){
															$status .= ",";
														}
														
														$status .= "'". $st ."'";
													}
												}
											}
										}
										
										if(count($c)){
											if(!in_array("all", $c)){
												$where = true;
												
												foreach($c as $cl){
													if(!empty($cl)){
														if(!empty($client)){
															$client .= ",";
														}
														
														$client .= "'". $cl ."'";
													}
												}
											}
										}
										
										if($where){
											$sql .= " WHERE p_id > 0 ";
										}
										
										if(!empty($department)){
											$sql .= " AND p_id IN (SELECT pd_project FROM project_department WHERE pd_department IN (" . $department . "))";
										}
										
										if(!empty($sector)){
											$sql .= " AND p_sector IN (". $sector .")";
										}
										
										if(!empty($status)){
											$sql .= " AND p_status IN (". $status .")";
										}
										
										if(!empty($client)){
											$sql .= " AND p_id IN (SELECT c_project FROM project_company WHERE c_company IN (". $client ."))";
										}
										$sql .= ")";
										//echo $sql;
										$q = DB::conn()->query($sql)->results();
									?>
										<table class="table table-responsive table-hover table-fluid">
											<thead style="background-color: silver">
												<tr>
													<th class="text-center">No</th>
													<th class="text-center">Project</th>
													<th class="text-center">Cost (RM)</th>
													<th class="text-center">SOB</th>
													<th class="text-center">Claim (RM)</th>
													<th class="text-center">LO No</th>
												</tr>
											</thead>
											
											<tbody>
											<?php
												$no = 1;
												foreach($q as $p){
												?>
												<tr>
													<td class="text-center"><?= $no++ ?></td>
													<td>
														<?php
															$pc = projects::getBy(["p_id" =>$p->r_project]);
															if(count($pc) > 0){
																echo $pc[0]->p_name;
															} 
														?>
													</td>
													<td>
														<?php
															$pc = projects::getBy(["p_id" =>$p->r_project]);
															if(count($pc) > 0){
																echo number_format($pc[0]->p_cost, 2);
															} 
														?>
													</td>
													<td>
														<?php
															$pc = projects::getBy(["p_id" =>$p->r_project]);
															if(count($pc) > 0){
																$sob = sob::getBy(["s_id" => $pc[0]->p_sob]);
																if(count($sob) > 0){
																	$sob = $sob[0];
																	echo $sob->s_name;
																}
															}  
														?>
													</td>
													<td>
														<?= number_format($p->r_claim, 2) ?>
													</td>
													<td class="text-center"><?= $p->r_loNo ?></td>
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
				}
			?>
		</div>
	</div>
</div>
<script>
	function printDiv(divName) {
	     var printContents = document.getElementById(divName).innerHTML;
	     var originalContents = document.body.innerHTML;
	
	     document.body.innerHTML = printContents;
	
	     window.print();
	
	     document.body.innerHTML = originalContents;
	}
</script>
<?php
?>