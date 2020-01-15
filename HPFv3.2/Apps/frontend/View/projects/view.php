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
					?><br /><br />
					
					<strong>Current Completion</strong><br />
					<?php
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
						
						echo $percent . "%";
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
			<span class="icon-file"></span> Project Trailing Record
		</div>
		
		<div class="card-body" style="overflow-x: scroll;">
		<?php
			$tg = task_group::getBy(["tg_project" => $p->p_id], ["order" => "tg_id DESC"]);
			
			if(count($tg)){
				$tg = $tg[0];
			?>
				<h3><?= $tg->tg_name ?></h3>
				<p>
					<?= $tg->tg_note ?>
				</p>
				
				<table class="table table-hover table-fluid table-bordered">
					<thead>
						<tr>
							<th rowspan="2">No</th>
							<th rowspan="2">Activities</th>
							<th colspan="2" class="text-center">Planning Date</th>
							<th colspan="2" class="text-center">Actual Date</th>
							<th rowspan="2" class="text-center">Completed</th>
							<th rowspan="2" class="text-center">Status</th>
						</tr>
						
						<tr>
							<th class="text-center">Start</th>
							<th class="text-center">End</th>
							<th class="text-center">Start</th>
							<th class="text-center">End</th>
						</tr>
					</thead>
					
					<tbody>
					<?php
						$no = 1;
						foreach(tasks::getBy(["t_group" => $tg->tg_id]) as $t){
						?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?= $t->t_title ?></td>
							<td class="text-center"><?= $t->t_planStart ?></td>
							<td class="text-center"><?= $t->t_planEnd ?></td>
							<td class="text-center"><?= $t->t_start ?></td>
							<td class="text-center"><?= $t->t_end ?></td>
							<td class="text-center"><?= $t->t_percent ?>%</td>
							<td class="text-center"><?= $t->t_status ?></td>
						</tr>
						<?php
						}
					?>
					</tbody>
				</table>
				<br />
				<hr />
				<br />
				<link href="<?= PORTAL ?>assets/vendor/jsgantt/jsgantt.css" rel="stylesheet" type="text/css"/>
				<script src="<?= PORTAL ?>assets/vendor/jsgantt/jsgantt.js" type="text/javascript"></script>

				<div id="chart"></div>
			<?php
				foreach(tasks::getBy(["t_group" => $tg->tg_id]) as $t){
					$users = "";
					foreach(task_user::getBy(["tu_task" => $t->t_id]) as $tu){
						if(!empty($users)){
							$users .= "<br />";
						}
						
						if(!empty($tu->tu_user)){
							$u = users::getBy(["user_id" => $tu->tu_user]);
							
							if(count($u)){
								$users .= $u[0]->user_name;
							}
						}else{
							$c = companies::getBy(["c_id" => $tu->tu_company]);
							
							if(count($c)){
								$users .= $c[0]->c_name;
							}
						}
					}
					
					$j[] = [
						"pID"			=> $t->t_id,
						"pName"			=> $t->t_title,
						"pStart"		=> date("Y-m-d", strtotime($t->t_start)),
						"pEnd"			=> date("Y-m-d", strtotime($t->t_end)),
						"pPlanStart"	=> date("Y-m-d", strtotime($t->t_planStart)),
						"pPlanEnd"		=> date("Y-m-d", strtotime($t->t_planEnd)),
						"pClass"		=> $t->t_color,
						"pLink"			=> "",
						"pMile"			=> 0,
						"pRes"			=> $users,
						"pComp"			=> $t->t_percent,
						"pGroup"		=> (count(tasks::getBy(["t_subOf" => $t->t_id])) ? 1 : 0),
						"pParent"		=> $t->t_subOf,
						"pOpen"			=> 1,
						"pDepend"		=> (string)$t->t_after,
						"pCaption"		=> $t->t_content,
						"pCost"			=> 1000,
						"pNotes"		=> $t->t_content,
						"pBarText"		=> $t->t_notes
					];
				}
				
				$json = json_encode($j);
				
				Page::bodyAppend(<<<S
<script>
var g = new JSGantt.GanttChart(document.getElementById('chart'), 'day');

g.setOptions({
	vCaptionType: 'Complete',   
	vQuarterColWidth: 36,
	vDateTaskDisplayFormat: 'day dd month yyyy',
	vDayMajorDateDisplayFormat: 'mon yyyy - Week ww',
	vWeekMinorDateDisplayFormat: 'dd mon',
	vLang: 'en',
	vShowTaskInfoLink: 1,
	vShowEndWeekDate: 0,
	vUseSingleCell: 10000,
	vFormatArr: ['Day', 'Week', 'Month', 'Quarter']
});
data = JSON.parse('$json');
data.forEach(function(x){
	g.AddTaskItemObject(x);
});

g.Draw();
</script>
S
);
			}else{
				new Alert("info", "This project has not setting any schedule yet.");
			}
		?>
		
		
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
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
								<th class="text-right">Status</th>
								<th class="text-center">User</th>
								<th class="text-center">Company</th>
							</tr>
						</thead>
						
						<tbody>
						<?php
							$no = 1;
							foreach(eot::getBy(["e_project" => $p->p_id]) as $eot){
							?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $eot->e_date ?></td>
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
		<div class="col-md-12">
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
								<th class="text-right">Status</th>
								<th class="text-center">User</th>
								<th class="text-center">Company</th>
							</tr>
						</thead>
						
						<tbody>
						<?php
							$no = 1;
							foreach(vo::getBy(["v_project" => $p->p_id]) as $vo){
							?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $vo->v_date ?></td>
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