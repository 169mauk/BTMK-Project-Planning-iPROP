<?php
new Controller();
?>
<div class="card">
	<div class="card-header">
		EOT Statistic 
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
								<?= Controller::form("eot") ?>
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
							if(!empty(Input::get("status_eot"))){
								$se = explode(",", Input::get("status_eot"));
							}else{
								$se = [];
							}
						?>
						Status (EOT)
						<select name="status_eot[]" class="form-control selectpicker" multiple data-live-search="true">
							<option value="all" <?= in_array("all", $se) ? "selected" : "" ?>>All</option>
						<?php
							$eot_sta = settings::getBy(["s_key" => "eot_status"]);
							foreach ($eot_sta as $sta_eot) {
							?>
								<option value="<?= $sta_eot->s_value ?>" <?= in_array($sta_eot->s_value, $se) ? "selected" : "" ?>> <?= $sta_eot->s_name ?></option>	
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
						<?= Controller::form("eot") ?>
						<input type="hidden" name="type" value="filter">
						<button class="btn btn-success btn-block">
							Filter
						</button>
					</div>
					<br />
				</form>
			</div>
			<?php
				switch (url::get(1)) {
					case 'search':
						?>
						<div class="col-md-9">
							<div class="col-md-12 text-right">
								<a class="btn btn-warning text-right" onclick="printDiv('printableArea')"><span class="icon-print"></span> Print</a><br /><br />
							</div>
							
							<div id="printableArea">
							
								<div class="col-md-12">
									<table class="table table-hover table-responsive table-fluid">
										<thead style="background-color: silver">
											<tr>
												<th class="text-center">Project</th>
												<th class="text-center">Status</th>
												<th class="text-center">End Date</th>
												<th class="text-center">Company</th>
												<th class="text-center">Task</th>
												<th class="text-center">Approved by</th>
											</tr>
										</thead>
										
										<tbody>
										<?php
											$data = F::URLSlugDecode(url::get(2));
											
											$q = DB::conn()->q("SELECT * FROM projects WHERE p_name LIKE  '%$data%'")->results();
											foreach($q as $p){
												$eot = eot::getBy(["e_project" => $p->p_id]);
												if(count($eot) > 0){
													foreach ($eot as $eot_ex) {
														?>
														<tr>
															<td>
																<?php
																	echo $p->p_name;
																?>
															</td>
															<td class="text-center">
																<?php
																	$estatus = settings::getBy(["s_key" => "eot_status", "s_value" => $eot_ex->e_status]);
																	if(count($estatus) > 0){
																		echo $estatus[0]->s_name;
																	}
																?>
															</td>
															<td class="text-center"><?= $eot_ex->e_end ?></td>
															<td class="text-center">
																<?php
																	$com = companies::getBy(["c_id" => $eot_ex->e_company]);
																	if(count($com) > 0){
																		echo $com[0]->c_name;
																	} 
																?>
															</td>
															<td class="text-center">
																<?php
																	$task = tasks::getBy(["t_id" => $eot_ex->e_task]);
																	if(count($task) > 0){
																		echo $task[0]->t_title;
																	} 
																?>
															</td>
															<td class="text-center">
																<?php
																	$user = users::getBy(["user_id" => $eot_ex->e_approve_by]);
																	if(count($user) > 0){
																		echo $user[0]->user_name;
																	} 
																?>
															</td>
														</tr>
														<?php
													}
												}
											}
										?>
										</tbody>
									</table>
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
							
								<div class="col-md-12">
								<?php
									$sql = "SELECT * FROM eot WHERE e_project IN (SELECT p_id FROM projects";
									$where = false;
									$department = "";
									$sector = "";
									$client = "";
									$status = "";
									$status_eot = "";
									
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
									
									if(count($se)){
										if(!in_array("all", $se)){
											$where = true;
											
											foreach($se as $seo){
												if(!empty($seo)){
													if(!empty($status_eot)){
														$status_eot .= ",";
													}
													
													$status_eot .= "'". $seo ."'";
												}
											}
										}
									}
									
									if($where){
										$sql .= " WHERE p_id > 0";
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
									
									if(!empty($status_eot)){
										$sql .= " AND e_status IN(". $status_eot. "))";
									}else{
										$sql .= ")";
									}
									
									
									//echo $sql;
									$q = DB::conn()->query($sql)->results();
								?>
									<table class="table table-hover table-responsive table-fluid">
										<thead style="background-color: silver">
											<tr>
												<th class="text-center">No</th>
												<th class="text-center">Project</th>
												<th class="text-center">Status</th>
												<th class="text-center">End Date</th>
												<th class="text-center">Company</th>
												<th class="text-center">Task</th>
												<th class="text-center">Approved by</th>
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
														$pro = projects::getBy(["p_id" =>$p->e_project ]);
														if(count($pro) > 0){
															echo $pro[0]->p_name;
														} 
													?>
												</td>
												<td class="text-center">
													<?php
														$estatus = settings::getBy(["s_key" => "eot_status", "s_value" => $p->e_status]);
														if(count($estatus) > 0){
															echo $estatus[0]->s_name;
														}
													?>
												</td>
												<td class="text-center"><?= $p->e_end ?></td>
												<td class="text-center">
													<?php
														$com = companies::getBy(["c_id" => $p->e_company]);
														if(count($com) > 0){
															echo $com[0]->c_name;
														} 
													?>
												</td>
												<td class="text-center">
													<?php
														$task = tasks::getBy(["t_id" => $p->e_task]);
														if(count($task) > 0){
															echo $task[0]->t_title;
														} 
													?>
												</td>
												<td class="text-center">
													<?php
														$user = users::getBy(["user_id" => $p->e_approve_by]);
														if(count($user) > 0){
															echo $user[0]->user_name;
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