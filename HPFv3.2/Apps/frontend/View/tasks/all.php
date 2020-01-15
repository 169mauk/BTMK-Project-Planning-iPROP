<?php
new Controller($_POST);

switch(url::get(2)){
	case "":
	case "all":
	case "list":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					All Tasks
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Task
					</a>
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="15%" class="text-center">Date</th>
								<th>Title</th>
								<th>Content</th>
								<th width="10%" class="text-center">Status</th>
								<th width="10%" class="text-right">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(tasks::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->t_date ?></td>
								<td><?= $c->t_title ?></td>
								<td><?= $c->t_content ?></td>
								<td class="text-center">
								<?php  

									 $b = $c->t_status;

									

									if($b == 0){

										echo "In Progress";

									}elseif($b == 1){

										echo "Done";

									}elseif($b == 2){

										echo "Cancelled";

									}else{

										echo "None";

									}

								?>
								</td>
								<td class="text-right">
									<a title="Edit Info" class="btn btn-sm btn-primary" href="<?= F::URLParams() ?>/edit/<?= $c->t_id ?>"><span class="icon-edit"></span></a>
									<a title="Delete Info" class="btn btn-sm btn-danger" href="<?= F::URLParams() ?>/delete/<?= $c->t_id ?>"><span class="icon-trash"></span></a>
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
					Add Task
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-8">
								Title:
								<input type="text" class="form-control" placeholder="Title" name="title"/><br />
								
								Project:
								
								<select class="form-control selectpicker" data-live-search="true" name="project" >
								<?php
									foreach(projects::list() as $cat){
									?>
									<option value="<?= $cat->p_id ?>"><?= $cat->p_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
								
								Category:
								<select class="form-control selectpicker" data-live-search="true" name="category" >
								<?php
									foreach(task_category::list() as $c){
									?>
									<option value="<?= $c->t_id ?>"><?= $c->t_title ?></option>
									<?php
									}
								?>
								</select><br /><br />
								
								Tags:
								<select class="form-control selectpicker" data-live-search="true" multiple name="tags[]">
								<?php
									foreach(task_tags::list() as $pt){
									?>
									<option value="<?= $pt->t_id ?>" style="color: <?= $pt->t_color ?>;">
										<?= $pt->t_title ?>
									</option>
									<?php
									}
								?>
								</select><br /><br />
								
								Content: 
								<textarea class="form-control summernote" placeholder="Content" name="content"></textarea><br />
								
								<?= Controller::form(
									"Task/task",
									[
										"action" => "add"
									]
								) ?>
								
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
		$t = tasks::getBy(["t_id" => url::get(3)]);
			if(count($t) > 0){
				$t = $t[0];
			
			?>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
						<div class="card lena-card no-border">
							<div class="card-header">
								<span class="icon-plus2"></span> 
								Edit Task
								
								<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
									Back
								</a>
							</div>
							
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-8">
											Title:
											<input type="text" class="form-control" placeholder="Title" name="title" value="<?= $t->t_title ?>" /><br />
											
											Project:
											
											<select class="form-control selectpicker" data-live-search="true" name="project" >
											<?php
												foreach(projects::list() as $cat){
												?>
												<option value="<?= $cat->p_id ?>"><?= $cat->p_name ?></option>
												<?php
												}
											?>
											</select><br /><br />
											
											Tags:
											<select class="form-control selectpicker" data-live-search="true" multiple name="tags[]">
											<?php
												foreach(task_tags::list() as $pt){
												?>
												<option value="<?= $pt->t_id ?>" <?= in_array($pt->t_id, explode(",", $t->t_tags)) ? "selected": "" ?> style="color: <?= $pt->t_color ?>;">
													<?= $pt->t_title ?>
												</option>
												<?php
												}
											?>
											</select><br /><br />
											
											Category:
											<select class="form-control selectpicker" data-live-search="true" multiple name="category">
											<?php
												foreach(task_category::list() as $pt){
												?>
												<option value="<?= $pt->t_id ?>" <?= $pt->t_id == $t->t_category ? "selected" : "" ?>><?= $pt->t_title ?></option>
												<?php
												}
											?>
											</select><br /><br />
											
											Status:
											<select class="form-control selectpicker" data-live-search="true" name="status">
												<option value="0" <?= $t->t_status == 0 ? "selected" : "" ?>>Pending</option>
												<option value="1" <?= $t->t_status == 1 ? "selected" : "" ?>>Done</option>
												<option value="2" <?= $t->t_status == 2 ? "selected" : "" ?>>Cancelled</option>
												
											</select><br /><br />
											
											Content: 
											<textarea class="form-control summernote" placeholder="Content" name="content"><?= $t->t_content ?></textarea><br />
											
											<?= Controller::form(
												"Task/task",
												[
													"action" => "edit"
												]
											) ?>
											
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
			}
	?>	
		
	
	<?php
	break;
	
	case "delete":
		$t = tasks::getBy(["t_id" => url::get(3)]);
		if(count($t) > 0){
			$t = $t[0];
		?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
					<div class="card lena-card no-border">
						<div class="card-header">
							<span class="icon-plus2"></span> 
							Delete Task
							
							<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
								Back
							</a>
						</div>
						
						<div class="card-body">
							<form action="" method="POST">
								<div class="row">
									<div class="col-md-4">
										
										Are you sure to delete this <?= $t->t_title ?> data? <br /><br />
										
										<?= Controller::form(
											"Task/task",
											[
												"action" => "delete"
											]
										) ?>
										
										<div class="row">
											<div class="col-md-12">
												<button class="btn btn-success btn-sm">
													Confirm	
												</button>
												<a class="btn btn-sm btn-danger" href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>">No</a>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php		
		
		}
		
	break;
	
}
?>
