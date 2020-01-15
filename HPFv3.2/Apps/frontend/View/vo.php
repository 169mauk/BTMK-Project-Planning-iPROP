<?php
new Controller ($_POST);
switch(url::get(1)){
	case "":
	case "all":
	case "list":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					All Variation Order(VO)
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Variation Order
					</a>
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="" class="text-center">No</th>
								<th width="" class="text-center">Project</th>
								<th class="text-center">Status</th>
								<th width="30%" class="text-center">Value (RM)</th>
								<th width="" class="text-center">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(vo::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center">
									<?php
										foreach (projects::list() as $proj) {
											if($proj->p_id == $c->v_project){
												echo $proj->p_name;
											}
										}
									?>
								</td>
								<td class="text-center">
									<?php
										if($c->v_status  == 0){
											echo "Pending";
										}elseif($c->v_status == 1){
											echo "Approved";
										}else{
											echo "Decline";
										}
									?>
								</td>
								<td class="text-center"><?= $c->v_value ?></td>
								<td class="text-center">
									<a href="<?= F::URLParams() ?>/edit/<?= $c->v_id?>" class="btn btn-sm btn-warning">
										<span class="icon-edit"></span>
									</a>
									<a href="<?= F::URLParams() ?>/delete/<?= $c->v_id ?>" class="btn btn-sm btn-danger">
										<span class="icon-trash"></span>
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
	<?php
	break;
	
	case "add":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					<span class="icon-plus2"></span> 
					Add Variation Order
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				<div class="card-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-4">
								Project:
								<select class="form-control selectpicker" name="v_project">
								<?php
									foreach (projects::list() as $pro) {
										?>
										<option value="<?= $pro->p_id ?>"><?= $pro->p_name ?></option>
										<?php
									}
								?>
								</select><br /><br />
							</div>
						</div>
					<?php
						/*
						<div class="row">
							<div class="col-md-4">
								Company:
								<select class="form-control selectpicker" name="v_company">
								<?php
									foreach (companies::list() as $com) {
										?>
										<option value="<?= $com->c_id ?>"><?= $com->c_name ?></option>
										<?php
									}
								?>
								</select><br /><br />
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								Task:
								<select class="form-control selectpicker" name="v_task">
								<?php
									foreach (tasks::list() as $t) {
										?>
										<option value="<?= $t->t_id ?>"><?= $t->t_title ?></option>
										<?php
									}
								?>
								</select><br /><br />
							</div>
						</div>
						*/
					?>
						<?php
							if($_SESSION["role"] > 0){
						?>
						<div class="row">
							<div class="col-md-4">
								Status:
								<select class="form-control selectpicker" name="v_status">
									<option value="0" >Pending</option>
									<option value="1" >Approved</option>
									<option value="2" >Decline</option>
								</select><br /><br />
							</div>
						</div>
						<?php
							}
						?>
						<div class="row">
							<div class="col-md-4">
								Value(RM):
								<input type="text" class="form-control" placeholder="Value" name="v_value" required/>
							</div>
						</div><br /><br />
						<div class="row">
							<div class="col-md-4">
								<?php 
									Controller::Form(
					                    "vo/vo", 
					                    [
					                        "action"  => "add"  
					                    ]
					                ); 
				                ?>
								<button class="btn btn-success btn-block btn-sm">
									<span class="icon-save"></span> Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
	break;
	
	case "edit":
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
				<div class="card lena-card no-border">
					<div class="card-header">
						<span class="icon-plus2"></span> 
						Edit Variation Order
						
						<a href="<?= PORTAL ?><?= url::get(0) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					
					<div class="card-body">
						<?php
							$comp = vo::getBy(["v_id" => url::get(2)]);
							if(count($comp) > 0){
								$comp = $comp[0];
								?>
								<form action="" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-4">
											Project:
											<select class="form-control selectpicker" name="v_project">
											<?php
												foreach (projects::list() as $pro) {
													?>
													<option value="<?= $pro->p_id ?>" <?= $pro->p_id == $comp->v_project? "selected" : "" ?> ><?= $pro->p_name ?></option>
													<?php
												}
											?>
											</select><br /><br />
										</div>
									</div>
								<?php
								/*
									<div class="row">
										<div class="col-md-4">
											Company:
											<select class="form-control selectpicker" name="v_company">
											<?php
												foreach (companies::list() as $com) {
													?>
													<option value="<?= $com->c_id ?>" <?= $com->c_id == $comp->v_company? "selected" : "" ?> ><?= $com->c_name ?></option>
													<?php
												}
											?>
											</select><br /><br />
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Task:
											<select class="form-control selectpicker" name="v_task">
											<?php
												foreach (tasks::list() as $t) {
													?>
													<option value="<?= $t->t_id ?>" <?= $t->t_id == $comp->v_task? "selected" : "" ?>><?= $t->t_title ?></option>
													<?php
												}
											?>
											</select><br /><br />
										</div>
									</div>
								*/
								?>
									<div class="row">
										<div class="col-md-4">
											Status:
											<?php												
												if($_SESSION["role"] > 0){
													?>
													<select class="form-control selectpicker" name="v_status">
														<option value="0" <?= 0 == $comp->v_status? "selected" : "" ?> >Pending</option>
														<option value="1" <?= 1 == $comp->v_status? "selected" : "" ?> >Approved</option>
														<option value="2" <?= 2 == $comp->v_status? "selected" : "" ?> >Decline</option>
													</select>
													<?php
												}else{
													if($comp->v_status == 0){
														echo "<b>Pending</b>";
													}elseif($comp->v_status == 1){
														echo "<b>Approved</b>";
													}else{
														echo "<b>Declined</b>";
													}
												}
											?><br /><br />
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Request By:
											<?php
						
												$user = users::getBy(["user_id" => $comp->v_user]);
												if(count($user) > 0){
													$user = $user[0];
													echo $user->user_name;
												}
											?>
										</div>
									</div><br />
									<div class="row">
										<div class="col-md-4">
											Value (RM):
											<input type="text" class="form-control" placeholder="Value" name="v_value" value="<?= ($comp->v_value) ?>" required/>
										</div>
									</div><br /><br />
									<div class="row">
										<div class="col-md-4">
											<?php 
												Controller::Form(
								                    "vo/vo", 
								                    [
								                        "action"  => "edit"  
								                    ]
								                ); 
							                ?>
											<button class="btn btn-success btn-block btn-sm">
												<span class="icon-save"></span> Save
											</button>
										</div>
									</div>
								</form>
								<?php
							}else{
								new Alert("error", "Data Not Found");
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	break;
	
	case "delete":
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
				<div class="card lena-card no-border">
					<div class="card-header">
						<span class="icon-plus2"></span> 
						Remove Variation Order
						
						<a href="<?= PORTAL ?><?= url::get(0) ?>" class="btn btn-primary btn-sm">
							Back
						</a>
					</div>
					<div class="card-body">
						<?php
							$cat = vo::getBy(["v_id" => url::get(2)]);
							if(count($cat) > 0){
								$cat = $cat[0];
								$project = projects::getBy(["p_id" => $cat->v_project]);
								if(count($project) > 0){
									$project = $project[0];
									$pro = $project->p_name;
								}else{
									echo "No project";
								}
								
								?>
									<form action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												<h6>Are you sure to removed "<?= $pro ?>" EOT?</h6>
											</div>
										</div><br /><br />
										<div class="row">
											<div class="col-md-6">
												<?php 
													Controller::Form(
									                    "vo/vo", 
									                    [
									                        "action"  => "delete"  
									                    ]
									                ); 
								                ?>
												<button class="btn btn-danger btn-block btn-sm">
													<span class="icon-save"></span> Yes
												</button>
											</div>
										</div>
									</form>
								<?php
							}else{
								new Alert("error", "No data found");
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	break;
}
?>
