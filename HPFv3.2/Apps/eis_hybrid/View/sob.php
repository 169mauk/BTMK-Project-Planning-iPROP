<?php
$sid = url::get(2);

if(empty($sid)){
	$s = sob::list();
	
	
}else{
	$s = sob::getBy(["s_id" => $sid]);
}

if(count($s)){
		$s = $s[0];
}else{
	new Alert("error", "Sorry, no SOB has been registered.");
	die();
}
?>
<div class="row gutters">
	<div class="col-12">
		<div class="card">
			<div class="card-header">Source of Budget Summary</div>
			<div class="card-body">
				<select class="form-control selectpicker pick-sob">
				<?php
					foreach(sob::list() as $sob){
					?>
					<option value="<?= $sob->s_id ?>" <?= $sob->s_id == $s->s_id ? "selected" : "" ?>><?= $sob->s_name ?></option>
					<?php
					}
				?>
				</select><br /><br />
				
				<div id="donutFormatter" class="chart-height"></div>
				<?php
				$data = [];
				$tp = count(projects::list(["where" => "p_sob = " . $s->s_id]));

				foreach(settings::getBy(["s_key" => "project_status"]) as $sa){
					$data[] = [
						"label"			=> $sa->s_name,
						"value"			=> count(projects::list(["where" => "p_status = $sa->s_value AND p_sob = " . $s->s_id])),
						"formatted"		=> ((count(projects::list(["where" => "p_status = $sa->s_value AND p_sob = " . $s->s_id])) / $tp) * 100)  . "%"
					];
				}

				$data = json_encode($data);
				?>
				<script>
				Morris.Donut({
					element: 'donutFormatter',
					data: <?= $data ?>,
					resize: true,
					hideHover: "auto",
					formatter: function (x, data) { return data.formatted; },
					colors:['#0063bf', '#e5e8f2', '#ff5661']
				});
				</script>
				
				<strong>
					<u>Project under <?= $s->s_name ?></u>
				</strong><br /><br />
				<table class="table table-fluid table-hover">
					<tbody>
					<?php
						foreach(projects::list(["where" => "p_sob = " . $s->s_id]) as $p){
						?>
						<tr>
							<td>
								<?= $p->p_name ?><br />
								<strong>Status:</strong> <?= count(settings::getBy(["s_key" => "project_status", "s_value" => $p->p_status])) ? settings::getBy(["s_key" => "project_status", "s_value" => $p->p_status])[0]->s_name : "UNKNOWN" ?>
								<br /><br />
								
								
								<table class="table table-fluid table-hover table-bordered">
									<tbody>
										<tr>
											<td class="text-center" width="50%">
												<strong>Value</strong><br />
												<?= number_format($p->p_cost, 2) ?>
											</td>
											<td class="text-center">
												<strong>Paid</strong><br />
												<?php
													$pd = DB::conn()->query("SELECT SUM(r_claim) as amount FROM reports WHERE r_project = ? AND r_status = 1", [$p->p_id])->results();
													
													if(count($pd)){
														$paid = $pd[0]->amount;
														echo number_format($paid, 2);
													}else{
														$paid = 0;
														echo number_format(0, 2);
													}
												?>
											</td>
										</tr>
										<tr>
											<td class="text-center">
												<strong>Balance</strong><br />
												<?= number_format($p->p_cost - $paid, 2) ?>
											</td>
											<td class="text-center">
												<strong>VO</strong><br />
												<?php
													$vd = DB::conn()->query("SELECT SUM(v_value) as amount FROM vo WHERE v_project = ? AND v_status = 1", [$p->p_id])->results();
													
													if(count($vd)){
														$vpd = $vd[0]->amount;
														echo number_format($vpd, 2);
													}else{
														echo number_format(0, 2);
													}
												?>
											</td>
										</tr>
									</tbody>
								</table>
								</div>
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

<script>
$(document).on("change", ".pick-sob", () => {
	sob = $(".pick-sob").val();
		
	$.ajax({
		method: "GET",
		url: PORTAL + "sob.html/" + sob
	}).done(function (res) {
		$("#content").html(res);
	}).fail(function () {
		$("#content").html("Fail loading file from server.");
	});
});
</script>