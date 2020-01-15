<?php
// new Controller($_POST);
switch(url::get(2)){
	case "":
	?>
	<div class="card card-primary">
		<div class="card-header">
			<span class="fa fa-list"></span> All Projects Application
			
			<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
				<span class="fa fa-plus"></span> Apply Project
			</a>
		</div>
		
		<div class="card-body">
			<table class="table table-hover table-fluid dataTable">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Title</th>
						<th class="text-center">Requested By</th>
						<th class="text-center">Manager</th>
						<th class="text-center">Estimation</th>
						<th class="text-center">Status</th>
						<th class="text-right">:::</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
					$no = 1;
					if($_SESSION["admin"]){
						$ps = project_application::list();
					}else{
						$ps = project_application::getBy(["pa_department" => $_SESSION["department"]]);
					}
					
					foreach($ps as $p){
				?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $p->pa_title ?></td>
						<td><?= count(users::getBy(["user_id" => $p->pa_user])) ? users::getBy(["user_id" => $p->pa_user])[0]->user_name : "UNKNOWN" ?></td>
						<td><?= count(users::getBy(["user_id" => $p->pa_manager])) ? users::getBy(["user_id" => $p->pa_manager])[0]->user_name : "UNKNOWN" ?></td>
						<td class="text-center"><?= $p->pa_estimateStart ?> <br /> to <?= $p->pa_estimateEnd ?></td>
						<td class="text-center">
							<?= count(settings::getBy(["s_key" => "project_application_status", "s_value" => $p->pa_status])) ? settings::getBy(["s_key" => "project_application_status", "s_value" => $p->pa_status])[0]->s_name : "NO STATE"  ?><br />
						</td>
						<td class="text-right">
							
						<?php
							if($_SESSION["role"]){
							?>
							<a title="Create Project" href="<?= F::URLParams() ?>/create/<?= $p->pa_id ?>" class="btn btn-success btn-sm">
								Create Project
							</a>
							<br style="margin-bottom: 10px;" />
							<a title="Delete Info" href="<?= F::URLParams() ?>/delete/<?= $p->pa_id ?>" class="btn btn-sm btn-danger">
								<span class="icon-trash"></span>
							</a>
							<?php
							}
						?>
							<a title="Edit Info" href="<?= F::URLParams() ?>/edit/<?= $p->pa_id ?>" class="btn btn-sm btn-warning">
								<span class="icon-edit"></span>
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
	<?php
	break;
	
	case "create":
		$id = url::get(3);
	?>
		<div class="card">
			<div class="card-header">
				<span class="icon-plus2"></span> Create Project
				<a href="<?= PORTAL ?>projects/application" class="btn btn-sm btn-primary">
					Back
				</a>
			</div>
			
			<div class="card-body">
			<?php
				if(!$_SESSION["role"]){
					$pa = project_application::getBy(["pa_id" => $id, "pa_department" => $_SESSION["department"]]);
				}else{
					$pa = project_application::getBy(["pa_id" => $id]);
				}
				
				
				if(count($pa) > 0){
					$pa = $pa[0];
					
					if($pa->pa_project){
						new Alert("info", "Project for this application has been created. Please <a href='". PORTAL ."projects/all/edit/". $pa->pa_project ."'><u>click here</u></a> to view project detail.");
					}
				?>
					<h3>
						Creating Project Confirmation
					</h3>
					<p>
						Please ensure below project profile are correct before proceed to creating project.
					</p>
					<hr /><br /><br />
					<div class="project-profile">
						<h4 class="text-center"><?= $pa->pa_title ?></h4>
						<div class="text-center">
							<strong><u>Project Application Confirmation</u></strong>
						</div>
						
						<div class="text-right">
							<strong>Date: </strong> <?= $pa->pa_date ?><br />
						</div><br /><br />
						
						<br /><br />
						<div class="row">
							<div class="col-md-4 col-xs-4 col-4">
								<strong><u>Profile</u></strong><br /><br />
								<table class="table-fluid table-hover table">
									<tbody>
										<tr>
											<th>Manager<th>
											<td>
											<?php
												$u = users::getBy(["user_id" => $pa->pa_manager]);
												
												echo (count($u) ? $u[0]->user_name : "Unknown User")
											?>
											</td>
										</tr>
										
										<tr>
											<th>Director<th>
											<td>
											<?php
												$u = users::getBy(["user_id" => $pa->pa_director]);
												
												echo (count($u) ? $u[0]->user_name : "Unknown USer")
											?>
											</td>
										</tr>
										
										<tr>
											<th>Department<th>
											<td>
											<?php
												$u = departments::getBy(["d_id" => $pa->pa_department]);
												
												echo (count($u) ? $u[0]->d_name : "Unknown Department")
											?>
											</td>
										</tr>
										
										<tr>
											<th>Sector<th>
											<td>
											<?php
												$u = sectors::getBy(["s_id" => $pa->pa_sector]);
												
												echo (count($u) ? $u[0]->s_name : "Unknown Sector")
											?>
											</td>
										</tr>
										
										<tr>
											<th>Category<th>
											<td>
											<?php
												$u = project_categories::getBy(["c_id" => $pa->pa_category]);
												
												echo (count($u) ? $u[0]->c_name : "Unknown Sector")
											?>
											</td>
										</tr>
										
										<tr>
											<th><i>Kod Maksud</i><th>
											<td>
											<?php
												$u = settings::getBy(["s_key" => "kod_maksud", "s_value" => $pa->pa_maksudCode]);
												
												echo (count($u) ? $u[0]->s_name : "Unknown Value")
											?>
											</td>
										</tr>
										
										<tr>
											<th><i>Kod Lanjut</i><th>
											<td>
											<?php
												$u = settings::getBy(["s_key" => "kod_lanjut", "s_value" => $pa->pa_lanjutCode]);
												
												echo (count($u) ? $u[0]->s_name : "Unknown Value")
											?>
											</td>
										</tr>
										
										<tr>
											<th><i>Kod Objek</i><th>
											<td>
											<?php
												$u = settings::getBy(["s_key" => "kod_lanjut", "s_value" => $pa->pa_objectCode]);
												
												echo (count($u) ? $u[0]->s_name : "Unknown Value")
											?>
											</td>
										</tr>
									</tbody>
								</table>								
							</div>
							
							<div class="col-md-4 col-xs-4 col-4">
								<strong><u>Finanancial</u></strong><br /><br />
								<table class="table-fluid table-hover table">
									<tbody>
										<tr>
											<th>Procurement Number<th>
											<td>
												<?= $pa->pa_procumentNo ?>
											</td>
										</tr>
										<tr>
											<th>Procurement Date<th>
											<td>
												<?= $pa->pa_procumentDate ?>
											</td>
										</tr>
										<tr>
											<th>Audget Application Date<th>
											<td>
												<?= $pa->pa_applicationBudgetDate ?>
											</td>
										</tr>
										<tr>
											<th>Budget Approval Date<th>
											<td>
												<?= $pa->pa_approvalBudgetDate ?>
											</td>
										</tr>
										
										<tr>
											<th>Cost (RM)<th>
											<td>
												<?= number_format($pa->pa_cost, 2) ?>
											</td>
										</tr>
									</tbody>
								</table>								
							</div>
							
							<div class="col-md-4 col-xs-4 col-4">
								<strong><u>Technical</u></strong><br /><br />
								<table class="table-fluid table-hover table">
									<tbody>
										<tr>
											<th>Kick Off Date<th>
											<td>
												<?= $pa->pa_kickOffDate ?>
											</td>
										</tr>
										<tr>
											<th>Guided Date<th>
											<td>
												<?= $pa->pa_guideDate ?>
											</td>
										</tr>
										<tr>
											<th>Technical Date<th>
											<td>
												<?= $pa->pa_technicalDate ?>
											</td>
										</tr>
										<tr>
											<th>Project Type<th>
											<td>
											<?php
												$s = settings::getBy(["s_key" => "project_type", "s_value" => $pa->pa_type]);
												
												echo (count($s) ? $s[0]->s_name : "UNKNOWN");
											?>
											</td>
										</tr>
										<tr>
											<th>Client (Contractor)<th>
											<td>
											<?php
												$c = companies::getBy(["c_id" => $pa->pa_client]);
												
												echo (count($c) ? $c[0]->c_name : "NIL");
											?>
											</td>
										</tr>
									</tbody>
								</table>								
							</div>
							
							<div class="col-md-12 text-center">
								<form action="" method="POST">
								<br /><br />
								<?php
									Controller::form("projects/application", [
										"action"	=> "create"
									]);
								?>
								
									<button class="btn btn-success btn-sm">
										Create Project
									</button>
								</form>
							</div>
						</div>
					</div>	
					
				<?php
				}else{
					new Alert("error", "Project application information not found.");
				}
			?>
			</div>
		</div>
	<?php
	break;
	
	case "add":	
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-plus2"></span> New Project Application Form 
			<a href="<?= PORTAL ?>projects/application" class="btn btn-sm btn-primary">
				Back
			</a>
		</div>
		
		<div class="card-body">
			<form action="" method="POST">
				<div class="row">
					<div class="col-md-12">
						Title:
						<input type="text" class="form-control" placeholder="Project Title" name="title" /><br />
					</div>
					
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<i>Kod Maksud:</i>
								<select class="form-control selectpicker" data-live-search="true" name="maksudCode">
								<?php
									foreach(settings::getBy(["s_key" => "kod_maksud"]) as $km){
									?>
									<option value="<?= $km->s_value ?>"><?= $km->s_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
							</div>
							
							<div class="col-md-6">
								<i>Kod Objek:</i>
								<select class="form-control selectpicker" data-live-search="true" name="objectCode">
								<?php
									foreach(settings::getBy(["s_key" => "kod_objek"]) as $km){
									?>
									<option value="<?= $km->s_value ?>"><?= $km->s_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
							</div>
							
							<div class="col-md-6">
								<i>Kod Lanjut:</i>
								<select class="form-control selectpicker" data-live-search="true" name="lanjutCode">
								<?php
									foreach(settings::getBy(["s_key" => "kod_lanjut"]) as $km){
									?>
									<option value="<?= $km->s_value ?>"><?= $km->s_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
							</div>
							
							<div class="col-md-6">
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
							</div>
							
							<div class="col-md-6">
								Source of Budget:
								<select class="form-control selectpicker" data-live-search="true" name="sob">
									<option value=""></option>
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
								Cost (RM):
								<input type="text" class="form-control" placeholder="0.00" name="cost" /><br />
							</div>
							
							<div class="col-md-6">
								Department: <?= $_SESSION["department"] ?>
								<select class="form-control selectpicker" data-live-search="true" name="department">
									<option value=""></option>
								<?php
									foreach(departments::list() as $dep){
										if($dep->d_id == $_SESSION["department"]){
											$active = "selected";
										}else{
											$active = "";
										}
									?>
										<option value="<?= $dep->d_id ?>" <?= $active ?>><?= $dep->d_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
							</div>
							
							<div class="col-md-6">
								Outsource Project?:
								<select class="form-control selectpicker" name="type">
								<?php
									foreach(settings::getBy(["s_key" => "project_type"]) as $t){
									?>
									<option value="<?= $t->s_value ?>"><?= $t->s_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
							</div>
							
							<div class="col-md-6">
								Status:
								<select class="form-control selectpicker" name="status">
								<?php
									foreach(settings::getBy(["s_key" => "project_application_status"]) as $st){
									?>
									<option value="<?= $st->s_value ?>"><?= $st->s_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
							</div>
							
							<div class="col-md-6">
								Estimation Days taken:
								<input type="number" class="form-control" placeholder="1" name="period" value="" /><br />
							</div>
							
							<div class="col-md-12">
								Contractors / Clients:
								<select class="form-control selectpicker" data-live-search="true" name="clients">
									<option value=""></option>
								<?php
									foreach(companies::list() as $c){
									?>
									<option value="<?= $c->c_id ?>"><?= $c->c_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								Estimation Start:
								<input type="date" class="form-control" name="estimateStart" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Estimate End:
								<input type="date" class="form-control" name="estimateEnd" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Approval Date:
								<input type="date" class="form-control" name="approvalDate" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Technical Date:
								<input type="date" class="form-control" name="technicalDate" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Guide Date:
								<input type="date" class="form-control" name="guideDate" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Kick Off Date:
								<input type="date" class="form-control" name="kickOffDate" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Budget Application Date:
								<input type="date" class="form-control" name="applicationBudgetDate" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Budget Approval Date:
								<input type="date" class="form-control" name="approvalBudgetDate" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Procurement Date:
								<input type="date" class="form-control" name="procumentDate" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Procurement Number:
								<input type="text" class="form-control" name="procumentNo" placeholder="Procurement Number" value="" /><br />
							</div>
							
							<div class="col-md-6">
								Project Manager:
								<select class="form-control selectpicker" data-live-search="true" name="manager">
								<?php
									foreach(users::list() as $c){
									?>
									<option value="<?= $c->user_id ?>"><?= $c->user_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
							</div>
							
							<div class="col-md-6">
								Project Director:
								<select class="form-control selectpicker" data-live-search="true" name="director">
								<?php
									foreach(users::list() as $c){
									?>
									<option value="<?= $c->user_id ?>"><?= $c->user_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
							</div>
						</div>
					</div>
					
					<div class="col-md-12">
						About Project:
						<textarea class="summernote form-control" name="content"></textarea><br />
					</div>
					
					<div class="col-md-12 text-center">
						<?= Controller::form("projects/application", ["action" => "add"]) ?>
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
		?>
		<div class="card">
			<div class="card-header">
				<span class="icon-plus2"></span> Edit Project Application Form 
				<a href="<?= PORTAL ?>projects/application" class="btn btn-sm btn-primary">
					Back
				</a>
			</div>
			
			<div class="card-body">
			<?php
				$pa = project_application::getBy(["pa_id" => $id]);
				
				if(count($pa) > 0){
					$pa = $pa[0];
					?>
						<form action="" method="POST">
							<div class="row">
								<div class="col-md-12">
									Title:
									<input type="text" class="form-control" placeholder="Project Title" name="title"  value="<?= $pa->pa_title ?>"/><br />
								</div>
								
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-6">
											<i>Kod Maksud:</i>
											<select class="form-control selectpicker" data-live-search="true" name="maksudCode" >
											<?php
												foreach(settings::getBy(["s_key" => "kod_maksud"]) as $km){
												?>
												<option value="<?= $km->s_value ?>" <?= $pa->pa_maksudCode ==  $km->s_value ? "selected" : "" ?>><?= $km->s_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
										
										<div class="col-md-6">
											<i>Kod Objek:</i>
											<select class="form-control selectpicker" data-live-search="true" name="objectCode">
											<?php
												foreach(settings::getBy(["s_key" => "kod_objek"]) as $km){
												?>
												<option value="<?= $km->s_value ?>" <?= $pa->pa_objectCode == $km->s_value ? "selected" : "" ?>><?= $km->s_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
										
										<div class="col-md-6">
											<i>Kod Lanjut:</i>
											<select class="form-control selectpicker" data-live-search="true" name="lanjutCode">
											<?php
												foreach(settings::getBy(["s_key" => "kod_lanjut"]) as $km){
												?>
												<option value="<?= $km->s_value ?>" <?= $pa->pa_lanjutCode == $km->s_value ? "selected" : "" ?>><?= $km->s_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
										
										<div class="col-md-6">
											Category:
											<select class="form-control selectpicker" data-live-search="true" name="category">
											<?php
												foreach(project_categories::list() as $pc){
												?>
												<option value="<?= $pc->c_id ?>" <?= $pa->pa_category == $pc->c_id? "selected" : "" ?>><?= $pc->c_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
										
										<div class="col-md-6">
											Source of Budget:
											<select class="form-control selectpicker" data-live-search="true" name="sob">
											<?php
												foreach(sob::list() as $s){
												?>
												<option value="<?= $s->s_id ?>" <?= $pa->pa_sob == $s->s_id ? "selected" : "" ?>><?= $s->s_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
										
										<div class="col-md-6">
											Cost (RM):
											<input type="text" class="form-control" placeholder="0.00" name="cost" value="<?= $pa->pa_cost ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Department:
											<select class="form-control selectpicker" data-live-search="true" name="department">
											<?php
												foreach(departments::list() as $dep){
												?>
													<option value="<?= $dep->d_id ?>" <?= $pa->pa_department == $dep->d_id ? "selected" : "" ?>><?= $dep->d_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
										
										<div class="col-md-6">
											Project Type:
											<select class="form-control selectpicker" name="type">
											<?php
												foreach(settings::getBy(["s_key" => "project_type"]) as $t){
												?>
												<option value="<?= $t->s_value ?>" <?= $t->s_value == $pa->pa_type ? "selected" : "" ?>><?= $t->s_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
										
										<div class="col-md-6">
											Status:
											<select class="form-control selectpicker" name="status">
											<?php
												foreach(settings::getBy(["s_key" => "project_application_status"]) as $st){
												?>
												<option value="<?= $st->s_value ?>" <?= $pa->pa_status == $st->s_value ? "selected" : "" ?>><?= $st->s_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
										
										<div class="col-md-6">
											Estimation Days taken:
											<input type="number" class="form-control" placeholder="1" name="period" value="<?= $pa->pa_period ?>" /><br />
										</div>
										
										<div class="col-md-12">
											Contractors / Clients:
											<select class="form-control selectpicker" data-live-search="true" name="clients">
											<?php
												foreach(companies::list() as $c){
												?>
												<option value="<?= $c->c_id ?>" <?= $pa->pa_client == $c->c_id ? "selected" : "" ?>><?= $c->c_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-6">
											Estimation Start:
											<input type="date" class="form-control" name="estimateStart" value="<?= date("Y-m-d", empty($pa->pa_estimateStart) ? time() : strtotime($pa->pa_estimateStart)) ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Estimate End:
											<input type="date" class="form-control" name="estimateEnd" value="<?= date("Y-m-d", empty($pa->pa_estimateEnd) ? time() : strtotime($pa->pa_estimateEnd)) ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Approval Date:
											<input type="date" class="form-control" name="approvalDate" value="<?= date("Y-m-d", empty($pa->pa_approvalDate) ? time() : strtotime($pa->pa_approvalDate)) ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Technical Date:
											<input type="date" class="form-control" name="technicalDate" value="<?= date("Y-m-d", empty($pa->pa_technicalDate) ? time() : strtotime($pa->pa_technicalDate)) ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Guide Date:
											<input type="date" class="form-control" name="guideDate" value="<?= date("Y-m-d", empty($pa->pa_guideDate) ? time() : strtotime($pa->pa_guideDate)) ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Kick Off Date:
											<input type="date" class="form-control" name="kickOffDate" value="<?= date("Y-m-d", empty($pa->pa_kickOffDate) ? time() : strtotime($pa->pa_kickOffDate)) ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Budget Application Date:
											<input type="date" class="form-control" name="applicationBudgetDate" value="<?= date("Y-m-d", empty($pa->pa_applicationBudgetDate) ? time() : strtotime($pa->pa_applicationBudgetDate)) ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Budget Approval Date:
											<input type="date" class="form-control" name="approvalBudgetDate" value="<?= date("Y-m-d", empty($pa->pa_approvalBudgetDate) ? time() : strtotime($pa->pa_approvalBudgetDate)) ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Procurement Date:
											<input type="date" class="form-control" name="procumentDate" value="<?= date("Y-m-d", empty($pa->pa_procumentDate) ? time() : strtotime($pa->pa_procumentDate)) ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Procurement Number:
											<input type="text" class="form-control" name="procumentNo" placeholder="Procurement No" value="<?= $pa->pa_procumentNo ?>" /><br />
										</div>
										
										<div class="col-md-6">
											Project Manager:
											<select class="form-control selectpicker" data-live-search="true" name="manager">
											<?php
												foreach(users::list() as $c){
												?>
												<option value="<?= $c->user_id ?>" <?= $pa->pa_manager == $c->user_id ? "selected" : "" ?>><?= $c->user_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
										
										<div class="col-md-6">
											Project Director:
											<select class="form-control selectpicker" data-live-search="true" name="director">
											<?php
												foreach(users::list() as $c){
												?>
												<option value="<?= $c->user_id ?>" <?= $pa->pa_director == $c->user_id ? "selected" : "" ?>><?= $c->user_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									About Project:
									<textarea class="summernote form-control" name="content"> <?=  $pa->pa_notes ?></textarea><br />
								</div>
								
								<div class="col-md-12 text-center">
									<?= Controller::form("projects/application", ["action" => "edit"]) ?>
									<button class="btn btn-sm btn-success">
										<span class="icon-save"></span> Save Information
									</button>
								</div>
							</div>
						</form>
					<?php
				}else{
					new Alert("error", "The project application is not exists.");
				}
			?>
			</div>
		</div>
		<?php
	break;
	
	case "delete":
		$id = url::get(3);
		?>
		<div class="card">
			<div class="card-header">
				<span class="icon-plus2"></span> Edit Project Application Form 
				<a href="<?= PORTAL ?>projects/application" class="btn btn-sm btn-primary">
					Back
				</a>
			</div>
			
			<div class="card-body">
			<?php
				$pa = project_application::getBy(["pa_id" => $id]);
				
				if(count($pa) > 0){
					$pa = $pa[0];
					?>
						<form action="" method="POST">
							<div class="row">
								<div class="col-md-12">
									Are you sure to remove <b><?= $pa->pa_title ?></b> project application?
								</div>
								<div class="col-md-12">
									<?= Controller::form("projects/application", ["action" => "delete"]) ?>
									<button class="btn btn-sm btn-danger">
										<span class="icon-trash"></span> Confirm
									</button>
								</div>
							</div>
						</form>
					<?php
				}else{
					new Alert("error", "The project application has been removed.Either the project application is not exists.");
				}
			?>
			</div>
		</div>
		<?php
	break;
}