<?php
$did = url::get(2);

if(empty($did)){
	$d = departments::list();	
}else{
	$d = departments::getBy(["d_id" => $did]);
}

if(count($d)){
		$d = $d[0];
}else{
	new Alert("error", "Sorry, no Department has been registered.");
	die();
}
?>
<div class="row gutters">
	<div class="col-12">
		<div class="card">
			<div class="card-header">Departments</div>
			<div class="card-body">
				<select class="form-control selectpicker pick-sob">
				<?php
					foreach(departments::list() as $dep){
					?>
					<option value="<?= $dep->d_id ?>" <?= $dep->d_id == $d->d_id ? "selected" : "" ?>><?= $dep->d_name ?></option>
					<?php
					}
				?>
				</select><br /><br />
				
				<div id="donutFormatter" class="chart-height"></div>
				<?php
				$data = [];
				$tp = count(projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department = " . $d->d_id .")"]));

				foreach(settings::getBy(["s_key" => "project_status"]) as $sa){
					$data[] = [
						"label"			=> $sa->s_name,
						"value"			=> count(projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department = ". $d->d_id .") AND p_status = " . $sa->s_value])),
						"formatted"		=> empty($p) ?  "0%": ((count(projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department = ". $d->d_id .") AND p_status = " . $sa->s_value])) / $tp) * 100)  . "%"
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
					<u>Project under <?= $d->d_name ?></u>
				</strong><br /><br />
				<table class="table table-fluid table-hover">
					<tbody>
					<?php
						foreach(projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department = ". $d->d_id .")"]) as $p){
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
												<strong>Start</strong><br />
												<?= date("d-M-Y", $p->p_time) ?>
											</td>
											<td class="text-center">
												<strong>Exp. End</strong><br />
												<?= date("d-M-Y", strtotime($p->p_estimateStart)) ?>
											</td>
										</tr>
										<tr>
											<td class="text-center">
												<strong>Progress</strong><br />
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
											</td>
											<td class="text-center">
												<strong>EOT</strong><br />
												<?php
													$ed = eot::getBy(["e_project" => $p->p_id], ["order" => "e_id DESC", "limit" => 1]);
													
													if(count($ed)){
														$ed = $ed[0];
														echo date("d-M-Y", strtotime($ed->e_end));
													}else{
														echo "NONE";
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
		url: PORTAL + "department.html/" + sob
	}).done(function (res) {
		$("#content").html(res);
	}).fail(function () {
		$("#content").html("Fail loading file from server.");
	});
});
</script>