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
					All Tag
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Tag
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
								<th width="10%" class="text-right">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(task_tags::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->t_date ?></td>
								<td><?= $c->t_title ?></td>
								<td><?= $c->t_content ?></td>
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
					Add Tag
					
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
								
								Content: 
								<textarea class="form-control summernote" placeholder="Content" name="content"></textarea><br />
								
								<?= Controller::form(
									"Task/tags",
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
		$t = task_tags::getBy(["t_id" => url::get(3)]);
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
											
											Content: 
											<textarea class="form-control summernote" placeholder="Content" name="content"><?= $t->t_content ?></textarea><br />
											
											
											<?= Controller::form(
												"Task/tags",
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
		$t = task_tags::getBy(["t_id" => url::get(3)]);
		if(count($t) > 0){
			$t = $t[0];
		?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
					<div class="card lena-card no-border">
						<div class="card-header">
							<span class="icon-plus2"></span> 
							Delete Tag
							
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
											"Task/tags",
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
