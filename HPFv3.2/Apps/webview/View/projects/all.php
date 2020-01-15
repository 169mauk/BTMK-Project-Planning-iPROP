<?php
switch(url::get(2)){
	case "":
	?>
	<div class="card card-primary">
		<div class="card-header">
			<span class="fa fa-list"></span> All Projects
			
			<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
				<span class="fa fa-plus"></span> Add new Project
			</a>
		</div>
		
		<div class="card-body">
			<table class="table table-hover table-fluid dataTable">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Title</th>
						<th class="text-center">Start</th>
						<th class="text-center">End</th>
						<th class="text-center">Status</th>
						<th class="text-right">:::</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
					$no = 1;
					if($_SESSION["admin"]){
						$ps = projects::list();
					}else{
						$ps = projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department = ". $_SESSION["department"] .")"]);
					}
					
					foreach($ps as $p){
				?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $p->p_main ? "[SUB]" : "" ?> <?= $p->p_name ?></td>
						<td class="text-center"><?= date("d-M-Y", $p->p_time) ?></td>
						<td class="text-center"><?= date("d-M-Y", $p->p_end) ?></td>
						<td class="text-center">
							<?= $p->p_status ?><br />
							<small>by <?= count(users::getBy(["user_id" => $p->p_user])) ? users::getBy(["user_id" => $p->p_user])[0]->user_name : "UNKNOWN" ?></small>
						</td>
						<td class="text-right">
							<a href="<?= F::URLParams() ?>/edit/<?= $p->p_id ?>" class="btn btn-sm btn-warning">
								<span class="icon-edit"></span>
							</a>
						<?php
							if($_SESSION["role"]){
							?>
							<a href="<?= F::URLParams() ?>/delete/<?= $p->p_id ?>" class="btn btn-sm btn-danger">
								<span class="icon-trash"></span>
							</a>
							<?php
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
	<?php
	break;
	
	case "add":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-plus"></span> Add new Project
			
			<a href="<?= PORTAL ?>projects/all" class="btn btn-sm btn-primary">
				Back
			</a>
		</div>
		
		<div class="card-body">
			<form action="" method="POST">
				<div class="row">
					<div class="col-md-6">
						Title:
						<input type="text" class="form-control" placeholder="Project Title" name="name" /><br />
						
						Category:
						<select class="form-control selectpicker" data-live-search="true" name="category">
						<?php
							foreach(project_categories::list() as $pc){
							?>
							<option value="<?= $pc->c_id ?>"><?= $pc->c_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
						
						Start:
						<input type="date" class="form-control" name="start" /><br />
						
						End:
						<input type="date" class="form-control" name="end" /><br />
						
						Tags:
						<select class="form-control selectpicker" data-live-search="true" multiple name="tags[]">
						<?php
							foreach(project_tags::list() as $pt){
							?>
							<option value="<?= $pt->t_id ?>" style="color: <?= $pt->t_color ?>;">
								<?= $pt->t_name ?>
							</option>
							<?php
							}
						?>
						</select><br /><br />
						
						Clients:
						<select class="form-control selectpicker" multiple data-live-search="true" name="clients[]">
						<?php
							foreach(companies::list() as $c){
							?>
							<option value="<?= $c->c_id ?>"><?= $c->c_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
						
						Status:
						<select class="form-control selectpicker" name="status">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select><br /><br />

						Department:
						<select class="form-control selectpicker" multiple data-live-search="true" name="department[]">
						<?php
							foreach(departments::list() as $d){
							?>
							<option value="<?= $d->d_id ?>"><?= $d->d_name ?></option>
							<?php
							}
						?>
						</select><br /><br />

						Source of Budget:
						<select class="form-control selectpicker form-control-lg" data-live-search="true" name="sob">
						<?php
							foreach(sob::list() as $s){
							?>
							<option value="<?= $s->s_id ?>"><?= $s->s_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
						
						
						
					</div>
					
					<div class="col-md-6">
						Location:
						
						<div id="us3" style="height: 500px;"></div>
						
						<input type="hidden" class=" location" id="us3-lon" name="location" value="3.139003,101.68685499999992" />
						<br />
						<?php
							$portal = PORTAL;
							Page::bodyAppend(<<<X
							<script src="$portal/assets/vendor/locationpicker/locationpicker.jquery.js"></script>
							<script>
								$('#us3').locationpicker({
									location: {
										latitude:  '3.139003',
										longitude: '101.68685499999992'
									},
									radius: 50,
									inputBinding: {
									},
									enableAutocomplete: true,
									onchanged: function (currentLocation, radius, isMarkerDropped) {
										console.log(currentLocation);
										$(".location").val(currentLocation.latitude + "," + currentLocation.longitude)
									}
								});
							</script> 
X
);
						?>

						Cost (RM):
						<input type="text" class="form-control" placeholder="0.00" name="cost" /><br />
						
						Ref No.:
						<input type="text" class="form-control" placeholder="Additional Reference Number" name="ref" /><br />
					</div>
					
					<div class="col-md-12">
						About Project:
						<textarea class="summernote form-control" name="content"></textarea><br />
					</div>
					
					<div class="col-md-12 text-center">
						<?= Controller::form("projects/projects", ["action" => "add"]) ?>
						<button class="btn btn-sm btn-success">
							<span class="icon-save"></span> Save Information
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	break;
	
	case "edit":
		$id = url::get(3);
		
		if($_SESSION["admin"]){
			$p = projects::getBy(["p_id" => $id]);
		}else{
			$p = projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department = ". $_SESSION["department"] ." AND pd_project = ". $id .")"]);
		}
		
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-plus"></span> Edit Project
			<a href="<?= PORTAL ?>projects/all" class="btn btn-sm btn-primary">
				Back
			</a>
			<?php
			if(count($p) > 0){
			?>
				<a href="<?= PORTAL ?>projects/all/view/<?= $p[0]->p_id ?>" target="_blank" class="btn btn-sm btn-danger">
					View Full Analysis
				</a>
			<?php
				}
			?>
		</div>
		<div class="card-body">
			<div class="row gutters">
				<?php
	        		$id = url::get(3);
					$project = projects::getBy(["p_id" => $id]);
					if(count($project) > 0){
						$project = $project[0];
					
						$menus = ["Info", "Clients", "Subs", "Tasks", "Reports", "EOT", "VO", "Users", "Board", "Issues", "Files", "Complains", "Finish"];
						
						if($_SESSION["role"] > 0){
							$menus[] = "Notes";
						}
						
						$view = F::URLSlugDecode(url::get(4));
						if(empty($view)){
							$view = $menus[0];
						}
						
						?>
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
								<?php
									foreach($menus as $menu){
										if($menu == $view){
											$active = "active";
										}else{
											$active = "";
										}
									?>
									<li class="nav-item">
							   			<a class="nav-link <?= $active ?>" href="<?= PORTAL ?>projects/all/edit/<?= url::Get(3) ?>/<?= F::URLSlugEncode($menu) ?>" role="tab" aria-controls="home1" aria-selected="true"><?= $menu ?></a>
							  		</li>
									<?php
									}
								?>
							</ul>
							
							<div class="tab-content" id="">
								<?php
								switch($view){
									default:
									case "Info":
										Page::Load("projects/edit/info");
									break;
									
									case "Clients":
										Page::Load("projects/edit/client");
									break;
									
									case "Subs":
										Page::Load("projects/edit/subs");
									break;
									
									case "Tasks":
										Page::Load("projects/edit/task");
									break;
									
									case "Reports":
										Page::Load("projects/edit/report");
									break;
									
									case "EOT":
										Page::Load("projects/edit/eot");
									break;
									
									case "VO":
										Page::Load("projects/edit/vo");
									break;
									
									case "Users":
										Page::Load("projects/edit/users");
									break;
									
									case "Board":
										Page::Load("projects/edit/board");
									break;
									
									case "Issues":
										Page::Load("projects/edit/discussion");
									break;
									
									case "Files":
										Page::Load("projects/edit/files");
									break;
									
									case "Complains":
										Page::Load("projects/edit/complains");
									break;
									
									case "Notes":
										Page::Load("projects/edit/notes");
									break;
									
									case "Finish":
										Page::Load("projects/edit/Finish");
									break;
								}
								?>
							</div>
						</div>
						<?php
					}
				?>
			</div>
		</div>
	</div>
	<?php
	break;
	
	case "delete":
		$id = url::get(3);
		
		if($_SESSION["admin"]){
			$p = projects::getBy(["p_id" => $id]);
		}else{
			$p = projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department = ". $_SESSION["department"] ." AND pd_project = ". $id .")"]);
		}
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-plus"></span> Add new Project
			
			<a href="<?= PORTAL ?>projects/all" class="btn btn-sm btn-primary">
				Back
			</a>
		</div>
		
		<div class="card-body">
		<?php
			if(count($p) > 0 && $_SESSION["role"]){
				$p = $p[0];
		?>
			<form action="" method="POST">
				<div class="row">
					<div class="col-md-6">
						<h3>Are you sure?</h3>
						
						<p>
							By clicking below button will remove project "<?= $p->p_name ?>" permanently.
						</p>
					</div>
					
					<div class="col-md-12">
						<?= Controller::form("projects/projects", ["action" => "delete"]) ?>
						<button class="btn btn-sm btn-danger">
							<span class="icon-trash"></span> Delete Information
						</button>
					</div>
				</div>
			</form>
		<?php
			}else{
				new Alert("error", "Selected project cannot be deleted. Either you are not allowed to delete or the project is not exists.");
			}
		?>
		</div>
	</div>
	<?php
	break;
	
	case "view":
		Page::Load("projects/view");
	break;
}