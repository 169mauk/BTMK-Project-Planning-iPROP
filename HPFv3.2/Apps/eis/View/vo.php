<?php
new Controller();
?>
<div class="card">
	<div class="card-header">
		VO Statistic 
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
							if(!empty(Input::get("status_vo"))){
								$so = explode(",", Input::get("status_vo"));
							}else{
								$so = [];
							}
						?>
						Status (VO)
						<select name="status_vo[]" class="form-control selectpicker" multiple data-live-search="true">
							<option value="all" <?= in_array("all", $so) ? "selected" : "" ?>>All</option>
						<?php
							$vo_sta = settings::getBy(["s_key" => "vo_status"]);
							foreach ($vo_sta as $sta_vo) {
							?>
								<option value="<?= $sta_vo->s_value ?>" <?= in_array($sta_vo->s_value, $so) ? "selected" : "" ?>> <?= $sta_vo->s_name ?></option>	
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
						<?= Controller::form("vo") ?>
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
					$sql = "SELECT * FROM vo WHERE v_project IN (SELECT p_id FROM projects ";
					$where = false;
					$department = "";
					$sector = "";
					$client = "";
					$status = "";
					$status_vo = "";
					
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
					
					if(count($so)){
						if(!in_array("all", $so)){
							$where = true;
							
							foreach($so as $svo){
								if(!empty($svo)){
									if(!empty($status_vo)){
										$status_vo .= ",";
									}
									
									$status_vo .= "'". $svo ."'";
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
					
					if(!empty($status_vo)){
						$sql .= " AND v_status IN(". $status_vo. ")";
					}else{
						$sql .= ")";
					}
					
					//echo $sql;
					$q = DB::conn()->query($sql)->results();
				?>
					<table class="table table-hover table-responsive table-fluid">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Project</th>
								<th class="text-center">Status</th>
								<th class="text-center">Value (RM)</th>
								<th class="text-center">Company</th>
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
										$pro = projects::getBy(["p_id" =>$p->v_project ]);
										if(count($pro) > 0){
											echo $pro[0]->p_name;
										} 
									?>
								</td>
								<td>
									<?php
										$estatus = settings::getBy(["s_key" => "vo_status", "s_value" => $p->v_status]);
										if(count($estatus) > 0){
											echo $estatus[0]->s_name;
										}
									?>
								</td>
								<td class="text-center"><?= number_format($p->v_value, 0) ?></td>
								<td>
									<?php
										$com = companies::getBy(["c_id" => $p->v_company]);
										if(count($com) > 0){
											echo $com[0]->c_name;
										} 
									?>
								</td>
								<td class="text-center">
									<?php
										$user = users::getBy(["user_id" => $p->v_approve_by]);
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
	</div>
</div>
<?php
?>