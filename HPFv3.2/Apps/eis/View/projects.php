<?php
new Controller();
?>
<div class="card">
	<div class="card-header">
		Project Statistic 
	</div>
	
	<div class="card-body">
		<div class="row">
			<div class="col-md-3">
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
						Status
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
						<?= Controller::form("projects") ?>
						<button class="btn btn-success btn-block">
							Filter
						</button>
					</div>
					<br />
				</form>
			</div>
			<div class="col-md-9">
				<div class="col-md-12">
				<?php
					$sql = "SELECT * FROM projects ORDER BY p_status ASC";
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
					
					//echo $sql;
					$q = DB::conn()->query($sql)->results();
				?>
					<table class="table table-responsive table-hover table-fluid">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Title</th>
								<th class="text-center">Category</th>
								<th class="text-center">Cost (RM)</th>
								<th class="text-center">Start</th>
								<th class="text-center">End</th>
								<th class="text-center">Status</th>
								<th class="text-center">%</th>
								<th class="text-center">:::</th>
							</tr>
						</thead>
						
						<tbody>
						<?php
							$no = 1;
							foreach($q as $p){
								$tg = task_group::getBy(["tg_project" => $p->p_id], ["order" => "tg_id DESC", "limit" => 1]);
								$percent = 0;
								if(count($tg)){
									$tg = $tg[0];
									
									$t = tasks::getBy(["t_group" => $tg->tg_id]);
									
									if(count($t)){
										$done = DB::conn()->query("SELECT SUM(t_percent) as percent FROM tasks WHERE t_group = " . $tg->tg_id)->results();
										
										if(count($done)){
											$per = $done[0]->percent;
											
											if(!empty($per)){
												$percent = ($per / (count($t) * 100)) * 100;
											}
										}
									}
								}
							?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $p->p_name ?></td>
								<td>
									<?php
										$pc = project_categories::getBy(["c_id" =>$p->p_category]);
										if(count($pc) > 0){
											echo $pc[0]->c_name;
										} 
									?>
								</td>
								<td><?= number_format($p->p_cost, 2) ?></td>
								<td class="text-center"><?= date("d-M-Y", $p->p_time) ?></td>
								<td class="text-center"><?= date("d-M-Y", $p->p_end) ?></td>
								<td width="15%">
									<?php
										$sta = settings::getBy(["s_key" => "project_status", "s_value" => $p->p_status]);
										
										if(count($sta) > 0){
											$status = $sta[0]->s_name;
											echo "<b>" . $status."</b><br />";
										} 
										$p_dep = project_department::getBy(["pd_project" => $p->p_id]);
										if(count($p_dep)>0){
											foreach ($p_dep as $pdep) {
												//echo $pdep->pd_department;
												$dpartment = departments::getBy(["d_id" => $pdep->pd_department]);
												if(count($dpartment) > 0){
													$dpt = $dpartment[0]->d_name;
													echo "- " . $dpt."<br />";
												}
												
											}
										}else{
											echo "No department Found";
										}
									?>
								</td>
								<td class="text-center">
								<?php
									echo $percent;
								?> %
								</td>
								<td class="text-center">
									<a href="<?= PORTAL_FRONTEND ?>projects/all/view/<?= $p->p_id ?>" target="_blank" class="btn btn-sm btn-danger">
										View Full Analysis
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
</div>
<?php
?>