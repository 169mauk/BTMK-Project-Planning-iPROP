<?php
switch(url::get(3)){
	case "":
	?>
	<h3> <span class="fa fa-list"></span> All Project Tags</h3><br />
	
	<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
		<span class="fa fa-plus"></span> Add new Project Tags
	</a>
	
	<br /><br />


	<table class="table table-hover table-fluid dataTable">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th>Title</th>
				<th>Color</th>
				<th>Description</th>
				<th class="text-right">:::</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
			$no = 1;
			foreach(project_tags::list() as $p){
		?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td><?= $p->t_name ?></td>
				<td style="background-color: <?= $p->t_color ?>" class="text-center"><?= $p->t_color ?></td>
				<td><?= $p->t_description ?></td>
				<td class="text-right">
					<a title="Edit Info" href="<?= F::URLParams() ?>/edit/<?= $p->t_id ?>" class="btn btn-sm btn-warning">
						<span class="icon-edit"></span>
					</a>
					
					<a title="Delete Info" href="<?= F::URLParams() ?>/delete/<?= $p->t_id ?>" class="btn btn-sm btn-danger">
						<span class="icon-trash"></span>
					</a>
				</td>
			</tr>
			<?php
			}
		?>
		</tbody>
	</table>
	<?php
	break;
	
	case "add":
	?>
		<h3><span class="icon-plus"></span> Add new Project Tag</h3><br />
		
		<a href="<?= PORTAL ?>settings/project-setting/Tags" class="btn btn-sm btn-primary">
			Back
		</a><br /><br />
		
		<form action="" method="POST">
			<div class="row">
				<div class="col-md-6">
					Name:
					<input type="text" class="form-control" placeholder="Tag Name" name="name" /><br />
					
					Color:
					<input type="color" class="form-control" placeholder="Tag Color" name="color" /><br />
					
					Description:
					<textarea class="form-control" placeholder="Description" name="description"></textarea><br />
				</div>
				
				<div class="col-md-6"></div>
				
				<div class="col-md-6 text-center">
					<?= Controller::form("projects/tags", ["action" => "add"]) ?>
					<button class="btn btn-sm btn-success">
						<span class="icon-save"></span> Save Information
					</button>
				</div>
			</div>
		</form>
	<?php
	break;
	
	case "edit":
		$id = url::get(4);
		
		$c = project_tags::getBy(["t_id" => $id]);
	?>
		<h3><span class="icon-edit"></span> Edit Project Category</h3><br />
		
		<a href="<?= PORTAL ?>settings/project-setting/Tags" class="btn btn-sm btn-primary">
			Back
		</a><br /><br />
	<?php
		if(count($c) > 0){
			$c = $c[0];
	?>
		<form action="" method="POST">
			<div class="row">
				<div class="col-md-6">
					Name:
					<input type="text" class="form-control" placeholder="Tag Name" value="<?= $c->t_name ?>" name="name" /><br />
					
					Color:
					<input type="color" class="form-control" placeholder="Tag Color" value="<?= $c->t_color ?>" name="color" /><br />
					
					Description:
					<textarea class="form-control" placeholder="Description" name="description"><?= $c->t_description ?></textarea><br />
				</div>
				
				<div class="col-md-6"></div>
				
				<div class="col-md-6 text-center">
					<?= Controller::form("projects/tags", ["action" => "edit"]) ?>
					<button class="btn btn-sm btn-success">
						<span class="icon-save"></span> Save Information
					</button>
				</div>
			</div>
		</form>
	<?php
		}else{
			new Alert("error", "Sorry, requested category not found in our database.");
		}
			
	break;
	
	case "delete":
		$id = url::get(4);
		
		$c = project_tags::getBy(["t_id" => $id]);
	?>
		<h3><span class="icon-trash"></span> Delete Project Tag</h3><br />
		
		<a href="<?= PORTAL ?>settings/project-setting/Tags" class="btn btn-sm btn-primary">
			Back
		</a><br /><br />
	<?php
		if(count($c) > 0){
			$c = $c[0];
	?>
		<form action="" method="POST">
			<div class="row">
				<div class="col-md-6">
					<h3>Are you sure?</h3>
					
					<p>By clicking below button will remove selected tag "<?= $c->t_name ?>" permanently.</p>
				</div>
				
				<div class="col-md-6"></div>
				
				<div class="col-md-6 text-center">
					<?= Controller::form("projects/tags", ["action" => "delete"]) ?>
					<button class="btn btn-sm btn-danger">
						<span class="icon-trash"></span> Delete Information
					</button>
				</div>
			</div>
		</form>
	<?php
		}else{
			new Alert("error", "Sorry, requested category not found in our database.");
		}
	break;
}