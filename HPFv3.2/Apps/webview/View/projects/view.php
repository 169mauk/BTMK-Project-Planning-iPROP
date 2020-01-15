<?php
$p = projects::getBy(["p_id" => url::get(3)]);

function countday($t, $day = 0){
	$task = tasks::getBy(["t_id" => $t]);
	
	if(count($task) > 0){
		$task = $task[0];
		
		if($task->t_after){
			return countday($task->t_after, ($day + $task->t_day));
		}else{
			return ($day + $task->t_day);
		}
	}else{
		return 0;
	}
}

if(count($p) > 0){
	$p = $p[0];
?>
<div id="print_area">
	<h2>
		Project Analysis: <?= $p->p_name ?>
	</h2>
	<br />
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					<h4>Financial Information</h4>
					
					<strong>Initial Cost:</strong><br />
					RM <?= number_format($p->p_cost, 2) ?><br /><br />
					
					<strong>Approved VO:</strong><br />
					RM 
					<?php
						$vo = DB::conn()->query("SELECT SUM(v_value) as tvo FROM vo WHERE v_project = ? AND v_status = 1", ["v_project" => $p->p_id])->results();
						
						if(count($vo)){
							echo number_format($vo[0]->tvo, 2);
							$vo = $vo[0]->tvo;
						}else{
							echo "0.00";
							$vo = 0;
						}
					?><br /><br />
					
					<strong>Total Project:</strong><br />
					RM <?= number_format($p->p_cost + $vo, 2) ?><br /><br />
					
					<strong>Source of Budget:</strong><br />
					<?= sob::getBy(["s_id" => $p->p_sob])[0]->s_name ?>
				</div>
				
				<div class="col-md-4">
					<h4>Timeline Projection</h4>
					
					<strong>Project Start:</strong><br />
					<?= date("d-M-Y", $p->p_time) ?><br /><br />
					
					<strong>Estimation Project Finishing:</strong><br />
					<?= date("d-M-Y", $p->p_end) ?><br /><br />
					
					<strong>Approved EOT</strong><br />
					<?php
						$eot = eot::list(["where" => "e_project = " . $p->p_id . " AND e_status = 1", "order" => "e_id DESC"]);
						if(count($eot)){
							$eot = $eot->e_end;
							
							echo date("d-M-Y", $eot);
						}else{
							echo "NONE";
							$eot = 0;
						}
					?>
				</div>
				
				<div class="col-md-4">
					<h4>Companies</h4>
					<table class="table table-fluid table-hover">
						<tbody>
						<?php
							$no = 1;
							foreach(project_company::getBy(["c_project" => $p->p_id]) as $pc){
								$c = companies::getBy(["c_id" => $pc->c_company]);
								
								if(count($c) > 0){
									$c = $c[0];
							?>
								<tr>
									<td><?= $c->c_name ?></td>
									<td class="text-right">
									<?php
										if($pc->c_status){
											$status = "success";
											$text = "Main";
										}else{
											$status = "warning";
											$text = "Sub";
										}
									?>
										<button class="btn btn-<?= $status ?> btn-sm client-status-click" data-id="<?= $c->c_id ?>">
											<?= $text ?>
										</button>
									</td>
								</tr>
							<?php
								}
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card">
		<div class="card-header">
			<span class="icon-file"></span> Gantt Chart
		</div>
		
		<div class="card-body" style="overflow-x: scroll;">
			<table class="table table-fluid table-hover table-bordered">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th width="40%">Task</th>
					<?php
						$ranges = new DatePeriod(
							 new DateTime(date("Y-m-d", $p->p_time)),
							 new DateInterval('P1D'),
							 new DateTime(date("Y-m-d", $p->p_end))
						);
						
						foreach($ranges as $key => $value){
						?>
							<th class="text-center"><small><?= $value->format("d\n M") ?></small></th>
						<?php
						}
					?>
					</tr>
				</thead>
				
				<tbody>
				<?php
					
					
					
					$no = 1;
					$xdata = [];
					foreach(tasks::getBy(["t_project" => $p->p_id]) as $t){
						$xdata["t_" . $t->t_id] = $t->t_day;
						$padding = countday($t->t_id) - $t->t_day;
					?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $t->t_title ?></td>
					<?php
						
						$x = 0;
						foreach($ranges as $key => $value){
							if($t->t_day == 0){
								$color = "warning";
							}else{
								if(!isset($xdata["t_" . $t->t_after])){
									if($t->t_day < $x){
										$color = "";
									}else{
										$color = "warning";
									}
								}else{
									if($x > $padding && $x <= $padding + $t->t_day){
										
										$color = "warning";
									}else{
										$color = "";
									}
								}
							}
							
							if($t->t_status == 2){
								$color = "danger";
							}elseif($t->t_status == 1){
								$color = "success";
							}else{
								$color = $color;
							}
						?>
							<td class="text-center bg-<?= $color ?>"></td>
						<?php
							$x++;
						}
					?>
					</tr>
					<?php
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<span class="icon-list"></span> Extension of Time (EOT)
				</div>
				
				<div class="card-body">
					<table class="table table-fluid table-hover">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Date</th>
								<th>Project</th>
								<th class="text-right">Status</th>
								<th class="text-center">User</th>
								<th class="text-center">Company</th>
							</tr>
						</thead>
						
						<tbody>
						<?php
							$no = 1;
							foreach(eot::list() as $eot){
							?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $eot->e_date ?></td>
								<td>
									<?php
										$project = projects::getBy(["p_id" => $eot->e_project]);
										if(count($project) > 0){
											$project = $project[0];
											echo $project->p_name;
										}
									?>
								</td>
								<td class="text-right">
									<?php
										if($eot->e_status == 0){
											echo "Pending";
										}elseif($eot->e_status == 1){
											echo "Approved";
										}else{
											echo "Decline";
										}
									?>
								 </td>
								<td class="text-center">
									<?php
										
										$user = users::getBy(["user_id" => $eot->e_user]);
										if(count($user) > 0){
											$user = $user[0];
											echo $user->user_name;
										}
									?>
								</td>
								<td class="text-center">
									<?php
										$comp = companies::getBy(["c_id" => $eot->e_company]);
										if(count($comp) > 0){
											$comp = $comp[0];
											echo $comp->c_name;
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
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<span class="icon-list"></span> Variation Order (VO)
				</div>
				
				<div class="card-body">
					<table class="table table-fluid table-hover">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Date</th>
								<th>Project</th>
								<th class="text-right">Status</th>
								<th class="text-center">User</th>
								<th class="text-center">Company</th>
							</tr>
						</thead>
						
						<tbody>
						<?php
							$no = 1;
							foreach(vo::list() as $vo){
							?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $vo->v_date ?></td>
								<td>
									<?php
										$project = projects::getBy(["p_id" => $vo->v_project]);
										if(count($project) > 0){
											$project = $project[0];
											echo $project->p_name;
										}
									?>
								</td>
								<td class="text-right">
									<?php
										if($vo->v_status == 0){
											echo "Pending";
										}elseif($vo->v_status == 1){
											echo "Approved";
										}else{
											echo "Decline";
										}
									?>
								 </td>
								<td class="text-center">
									<?php
										
										$user = users::getBy(["user_id" => $vo->v_user]);
										if(count($user) > 0){
											$user = $user[0];
											echo $user->user_name;
										}
									?>
								</td>
								<td class="text-center">
									<?php
										$comp = companies::getBy(["c_id" => $vo->v_company]);
										if(count($comp) > 0){
											$comp = $comp[0];
											echo $comp->c_name;
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
		
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<span class="icon-list"></span> Reports
				</div>
				
				<div class="card-body">
					<table class="table table-fluid table-hover dataTable">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Date</th>
								<th>Title</th>
								<th class="text-right">Claim (RM)</th>
								<th class="text-center">UStatus</th>
								<th class="text-right">:::</th>
							</tr>
						</thead>
						
						<tbody>
						<?php
							$no = 1;
							foreach(reports::getBy(["r_project" => $p->p_id]) as $rp){
							?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $rp->r_date ?></td>
								<td><?= $rp->r_title ?></td>
								<td class="text-right"><?= number_format($rp->r_claim, 2) ?></td>
								<td class="text-center"><?= $rp->r_status == 1 ? "Approved" : ($rp->r_status == 0 ? "Pending" : "Declined") ?></td>
								<td class="text-right">
									<a href="<?= PORTAL ?>reports/all/view/<?= $rp->r_id ?>" target="_blank" class="btn btn-sm btn-primary">
										<span class="icon-eye"></span>
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
}else{
	
	new Alert("error", "Sorry, no project found.");
}
?>