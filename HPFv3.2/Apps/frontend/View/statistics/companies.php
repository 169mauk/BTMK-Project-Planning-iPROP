<div class="card">
	<div class="card-header">
		<span class="icon-list"></span> Company Statistics
	</div>
	
	<div class="card-body" style="overflow-y: scroll;">
		<table class="table table-bordered table-hover" style="width: auto !important;">
			<thead>
				<tr>
					<th class="text-center">No</th>
					<th>Company</th>
					<th class="text-center">&Sigma; Project</th>
					<th class="text-center">Start</th>
					<th class="text-center">End</th>
					<th>Project</th>
					<th class="text-center">Progress (%)</th>
					<th class="text-right">Cost (RM)</th>
					<th class="text-right">Paid (RM)</th>
					<th class="text-right">Balance (RM)</th>
					<th class="text-center">SOB</th>
					<th class="text-center">Departments</th>
				</tr>
			</thead>
			
			<tbody>
			<?php
				$no = 1;
				foreach(companies::list() as $c){
					$ps = DB::conn()->query("SELECT * FROM projects WHERE p_id IN (SELECT c_project FROM project_company WHERE c_company = ? AND c_status = 1)", ["c_company" => $c->c_id])->results();
					
					if(count($ps)){
					//$ps = projects::getBy(["p_company" => $c->c_id]);
				?>
					<tr>
						<td class="text-center" rowspan="<?= count($ps) + 1 ?>"><?= $no++ ?></td>
						<td rowspan="<?= count($ps) + 1 ?>"><?= $c->c_name ?></td>
						<td rowspan="<?= count($ps) + 1 ?>" class="text-center"><?= count($ps) ?></td>
						
					</tr>
					<?php
						foreach($ps as $p){
							$paid = DB::conn()->query("SELECT SUM(r_claim)as paid FROM reports WHERE r_status = 1 AND r_project = ?", ["r_project" => $p->p_id])->results();
							
							if(count($paid)){
								$paid = $paid[0];
							}else{
								$paid->paid = 0;
							}
							
							$balance = $p->p_cost - $paid->paid;
						?>
						<tr>
							<td class="text-center"><?= $p->p_date ?></td>
							<td class="text-center"><?= date("d-M-Y", $p->p_end) ?></td>
							<td><?= $p->p_name ?></td>
							<td class="text-center">
							<?php
								$t = count(tasks::getBy(["t_project" => $p->p_id]));
								$done = count(tasks::getBy(["t_project" => $p->p_id, "t_status" => 1]));
								
								if($t){
									$pe = ($done / $t) * 100;
									
									echo $pe . "%";
								}else{
									echo "0%";
								}
							?>
							</td>
							<td class="text-right"><?= number_format($p->p_cost, 2) ?></td>
							<td class="text-right"><?= number_format($paid->paid, 2) ?></td>
							<td class="text-right"><?= number_format($balance, 2) ?></td>
							<td class="text-center">
							<?php
								$sob = sob::getBy(["s_id" => $p->p_sob]);
								
								if(count($sob)){
									echo $sob[0]->s_name;
								}else{
									echo "NIL";
								}
							?>
							</td>
							<td class="text-center">
							<?php
								$dep = departments::getBy(["d_id" => $p->p_department]);
								
								if(count($dep)){
									echo $dep[0]->d_name;
								}else{
									echo "NIL";
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