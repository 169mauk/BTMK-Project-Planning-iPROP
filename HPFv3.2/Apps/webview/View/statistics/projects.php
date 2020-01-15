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
						Project Listing
					</div>

					<div class="card-body">
					<table class="table table-hover table-fluid table-bordered">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="10%" class="text-center">Projects</th>
								<th class="text-center">Cost (RM)</th>
								<th width="10%" class="text-center">Sourc of Budget</th>
								<th class="10% text-center">Claim (RM)</th>
								<th class="10% text-center">Paid (RM)</th>
								<th class="10% text-center">Balance (RM)</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							$pro = projects::list();
							foreach ($pro as $ject) {
								
								?>
								<tr>
									<td class="5% text-center"><?= $no++ ?></td>
									<td class="10% text-center">
										<?= $ject->p_name ?>
									</td>
									<td class="text-center">
										<?= number_format($ject->p_cost, 2) ?>
									</td>
									<td class="10% text-center">
										<?php
											$sob = sob::getBy(["s_id" => $ject->p_sob]);
											if(count($sob) > 0){
												$sob = $sob[0];
												echo $sob->s_name;
											}
										?>
									</td>
									<td class="10% text-center">
										<?php
											$rep = reports::getBy(["r_project" => $ject->p_id]);
											if(count($rep) > 0){
												$rep = $rep[0];
												echo number_format($rep->r_claim);
												
											}else{
												echo "No Claim";
											}
										?>
									</td>
									<td class="10% text-center">
										<?php
											$rep = reports::getBy(["r_project" => $ject->p_id]);
											if(count($rep) > 0){
												$rep = $rep[0];
												$bal = $rep->r_paid;
												echo number_format($bal);
											}else{
												echo "No Claim";
											}
										?>
									</td>

									<td class="10% text-center">
										<?php
											$rep = reports::getBy(["r_project" => $ject->p_id]);
											if(count($rep) > 0){
												$rep = $rep[0];
												$bal = $rep->r_claim - $rep->r_balance;
												echo number_format($bal);
											}else{
												echo "No Claim";
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

	default;
	break;
}