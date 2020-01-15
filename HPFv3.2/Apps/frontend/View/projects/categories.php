<?php
switch(url::get(2)){
	case "":
	?>
	<div class="card card-primary">
		<div class="card-header">
			<span class="fa fa-list"></span> All Projects
			
			<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
				<span class="fa fa-plus"></span> Add new Project Category
			</a>
		</div>
		
		<div class="card-body">
			<table class="table table-hover table-fluid dataTable">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Title</th>
						<th>Description</th>
						<th class="text-right">:::</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
					$no = 1;
					foreach(project_categories::list() as $p){
				?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $p->c_name ?></td>
						<td><?= $p->c_description ?></td>
						<td class="text-right">
							<a title="Edit Info" href="<?= F::URLParams() ?>/edit/<?= $p->c_id ?>" class="btn btn-sm btn-warning">
								<span class="icon-edit"></span>
							</a>
							
							<a title="Delete Info" href="<?= F::URLParams() ?>/delete/<?= $p->c_id ?>" class="btn btn-sm btn-danger">
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
			<span class="icon-plus"></span> Add new Project Category
			
			<a href="<?= PORTAL ?>projects/categories" class="btn btn-sm btn-primary">
				Back
			</a>
		</div>
		
		<div class="card-body">
			<form action="" method="POST">
				<div class="row">
					<div class="col-md-6">
						Name:
						<input type="text" class="form-control" placeholder="Category Name" name="name" /><br />
						
						Description:
						<textarea class="form-control" placeholder="Description" name="description"></textarea><br />
					</div>
					
					<div class="col-md-6"></div>
					
					<div class="col-md-6 text-center">
						<?= Controller::form("projects/categories", ["action" => "add"]) ?>
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
		
		$c = project_categories::getBy(["c_id" => $id]);
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-edit"></span> Edit Project Category
			
			<a href="<?= PORTAL ?>projects/categories" class="btn btn-sm btn-primary">
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
						<input type="text" class="form-control" placeholder="Category Name" value="<?= $c->c_name ?>" name="name" /><br />
						
						Description:
						<textarea class="form-control" placeholder="Description" name="description"><?= $c->c_description ?></textarea><br />
					</div>
					
					<div class="col-md-6"></div>
					
					<div class="col-md-6 text-center">
						<?= Controller::form("projects/categories", ["action" => "edit"]) ?>
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
		
		$c = project_categories::getBy(["c_id" => $id]);
	?>
	<div class="card">
		<div class="card-header">
			<span class="icon-trash"></span> Delete Project Category
			
			<a href="<?= PORTAL ?>projects/categories" class="btn btn-sm btn-primary">
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
						
						<p>By clicking below button will remove selected category "<?= $c->c_name ?>" permanently.</p>
					</div>
					
					<div class="col-md-6"></div>
					
					<div class="col-md-6 text-center">
						<?= Controller::form("projects/categories", ["action" => "delete"]) ?>
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