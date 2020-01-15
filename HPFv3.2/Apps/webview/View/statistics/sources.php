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
						Source Listing
					</div>

					<div class="card-body">
					<table class="table table-hover table-fluid table-bordered">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="10%" class="text-center">Source</th>
								<th class="text-center">Allocated (RM)</th>
								<th class="10% text-center">Projects </th>
								<th class="10% text-center">Paid (RM)</th>
								<th class="10% text-center">Balance (RM)</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							$r_sob = sob::list();
							
							foreach ($r_sob as $sob) {
								$sid = $sob->s_id;
								$total_cost = DB::conn()->q("SELECT SUM(p_cost) as cost_tot FROM projects WHERE p_sob = $sid")->results();
								if(count($total_cost) > 0){
									$total_cost = $total_cost[0];
									$cost = $total_cost->cost_tot;
								}
								?>
								<tr>
									<td class="5% text-center"><?= $no++ ?></td>
									<td class="10% text-center">
										<?= $sob->s_name ?>
									</td>
									<td class="text-center">
										<?= number_format($sob->s_amount, 2) ?>
									</td>
									<td class="10% text-center">
										<?php
											$project = projects::getBy(["p_sob" => $sid]);
											echo count($project);
										?>
									</td>
									<td class="10% text-center">
										<?= number_format($cost, 2) ?>
									</td>
									<td class="10% text-center">
										<?php
											$bal = $sob->s_amount - $cost;
											echo number_format($bal, 2);
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

	default;
	break;
}