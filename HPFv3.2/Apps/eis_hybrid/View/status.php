<?php
$sid = url::get(2);

if(empty($sid)){
	$s = settings::getBy(["s_key" => "project_status"]);	
}else{
	$s = settings::getBy(["s_key" => "project_status", "s_value" => $sid]);
}

if(count($s)){
		$s = $s[0];
}else{
	new Alert("error", "Sorry, no Department has been registered.");
	die();
}
?>
<div class="row gutters">
	<div class="col-12">
		<div class="card">
			<div class="card-header">Project Status</div>
			<div class="card-body">
				<select class="form-control selectpicker pick-sob">
				<?php
					foreach(settings::getBy(["s_key" => "project_status"]) as $st){
					?>
					<option value="<?= $st->s_value ?>" <?= $st->s_value == $s->s_value ? "selected" : "" ?>><?= $st->s_name ?></option>
					<?php
					}
				?>
				</select><br /><br />
								
				<strong>
					<u>Project under <?= $s->s_name ?></u>
				</strong><br /><br />
				<table class="table table-fluid table-hover">
					<tbody>
					<?php
						foreach(projects::list(["where" => "p_status = ". $s->s_value]) as $p){
						?>
						<tr>
							<td>
								<?= $p->p_name ?><br />
								<strong>
									Department(s):
								</strong> <br />
								<?php
									foreach(project_department::getBy(["pd_project" => $p->p_id]) as $pd){
										$d = departments::getby(["d_id" => $pd->pd_department]);
										
										if(count($d)){
											$d = $d[0];
											
											echo "-" .$d->d_name;
										}else{
											echo "- Unknown Department";
										}
										echo "<br />";
									}
								?>
								<br />
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
		url: PORTAL + "status.html/" + sob
	}).done(function (res) {
		$("#content").html(res);
	}).fail(function () {
		$("#content").html("Fail loading file from server.");
	});
});
</script>