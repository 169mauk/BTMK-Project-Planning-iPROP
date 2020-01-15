
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-12">
				<h2>Project you assigned</h2>
				<hr />
			</div>
			
		<?php
			$pus = DB::conn()->query("SELECT * FROM project_user WHERE pu_user = ?", [$_SESSION["user_id"]])->results();
			
			foreach($pus as $pu){
				$p = projects::getBy(["p_id" => $pu->pu_project]);
				
				if(count($p)){
					$p = $p[0];
			?>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<?= $p->p_name ?>
						</div>
						
						<div class="card-body" style="max-height: 400px; overflow-y: scroll;">
							<ul class="list-group">
							<?php
								if(count(jobs::getBy(["j_project" => $p->p_id, "j_user" => $_SESSION["user_id"]]))){
									foreach(jobs::getBy(["j_project" => $p->p_id, "j_user" => $_SESSION["user_id"]]) as $job){
									?>
									<li class="list-group-item">
										<strong><?= $job->j_title ?></strong><br />
										<?= $job->j_description ?><br />
										<small>
											<?= $job->j_date ?> <?= date("H:i:s\ ", $job->j_time) ?>
											<?php
												if(!empty($job->j_by)){
													$u = users::getBy(["user_id" => $job->j_by]);
													
													if(count($u)){
														echo " by " . $u[0]->user_name;
													}
												}
											?>
										</small>
										<br />
										<span class="badge badge-pill badge-<?= $job->j_status ? "success" : "warning" ?>">
											<?= $job->j_status ? "Completed" : "Pending" ?>
										</span>
										
										<?php
											if(!empty($job->j_tags)){
												$tags = explode(",", $job->j_tags);
												
												foreach($tags as $tag){
													$ts = tags::getBy(["t_id" => $tag]);
													
													if(count($ts)){
														$ts = $ts[0];
													?>
														<span class="badge bandge-sm badge-<?= $ts->t_color ?>"><?= $ts->t_name ?></span>
													<?php
													}
												}
											}
										?>
									</li>
									<?php
									}
								}else{
								?>
								<li class="list-group-item">
									No Job listing here
								</li>
								<?php
								}
							?>
							</ul>
						</div>
						
						<div class="card-footer">
							<a class="btn btn-sm btn-info float-right" href="<?= PORTAL ?>projects/all/edit/<?= $p->p_id?>/Users">
								View Project
							</a>
						</div>
					</div>
				</div>
			<?php			
				}
			}
		?>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<br /><br />
				<h2>Departments</h2>
				<hr />
			</div>
			
		<?php
			if($_SESSION["admin"]){
				$pds = project_department::list(["group" => "pd_project"]);
			}else{
				$pds = project_department::getBy(["pd_department" => $_SESSION["department"]]);
			}
			
			foreach($pds as $pd){
				$p = projects::getBy(["p_id" => $pd->pd_project]);
				
				if(count($p)){
					$p = $p[0];
			?>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<?= $p->p_name ?>
						</div>
						
						<div class="card-footer">
							<a class="btn btn-sm btn-info float-right" href="<?= PORTAL ?>projects/all/edit/<?= $p->p_id?>/Users">
								View Project
							</a>
						</div>
					</div>
				</div>
			<?php			
				}
			}
		?>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				Activities Logs
			</div>
			
			<div class="card-body" style="overflow-y: scroll; max-height: 600px;">
				<div class="list-group">
				<?php
					foreach(activities::list(["where" => "a_user = " . $_SESSION["user_id"] . " OR a_to = " . $_SESSION["user_id"]]) as $a){
					?>
					<div class="list-group-item">
						<?= $a->a_date ?> <?= date("H:i:s\ ", $a->a_time) ?> - <?= $a->a_title ?> <br />
						<small><?= $a->a_description ?></small><br />
						By <?= $_SESSION["user_id"] == $a->a_user ? "You" : (count(users::getBy(["user_id" => $a->a_user])) ? users::getBy(["user_id" => $a->a_user])[0]->user_name : "Unknown") ?>
					</div>
					<?php
					}
				?>
				</div>
			</div>
		</div>
	</div>
</div>