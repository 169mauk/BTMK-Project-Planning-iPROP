<?php
switch(url::get(2)){
	case "":
	?>
	<div class="card card-primary">
		<div class="card-header">
			<span class="fa fa-list"></span> All Project Tags
			
			<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
				<span class="fa fa-plus"></span> Add new Project Tags
			</a>
		</div>
		
		<div class="card-body">
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
							<a href="<?= F::URLParams() ?>/edit/<?= $p->t_id ?>" class="btn btn-sm btn-warning">
								<span class="icon-edit"></span>
							</a>
							
							<a href="<?= F::URLParams() ?>/delete/<?= $p->t_id ?>" class="btn btn-sm btn-danger">
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
	<?php
	break;
	
	case "add":
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-plus"></span> Add new Project Tag
			
			<a href="<?= PORTAL ?>projects/tags" class="btn btn-sm btn-primary">
				Back
			</a>
		</div>
		
		<div class="card-body">
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
		</div>
	</div>
	<?php
	break;
	
	case "edit":
		$id = url::get(3);
		
		$c = project_tags::getBy(["t_id" => $id]);
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-edit"></span> Edit Project Category
			
			<a href="<?= PORTAL ?>projects/tags" class="btn btn-sm btn-primary">
				Back
			</a>
		</div>
		
		<div class="card-body">
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
		?>
		</div>
	</div>
	<?php
	break;
	
	case "delete":
		$id = url::get(3);
		
		$c = project_tags::getBy(["t_id" => $id]);
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-trash"></span> Delete Project Tag
			
			<a href="<?= PORTAL ?>projects/tags" class="btn btn-sm btn-primary">
				Back
			</a>
		</div>
		
		<div class="card-body">
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
		?>
		</div>
	</div>
	<?php
	break;
}