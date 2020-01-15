<?php
switch(url::get(2)){
	case "":
	case "all":
	case "list":
	?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
			<div class="card lena-card no-border">
				<div class="card-header">
					All Complaints
					
					<a href="<?= F::URLParams() ?>/add" class="btn btn-sm btn-primary">
						<span class="icon-plus2"></span> Add Complaint
					</a>
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-fluid table-bordered dataTable">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="15%" class="text-center">Date</th>
								<th>Title</th>
								<th width="10%" class="text-center">Status</th>
								<th width="10%" class="text-right">:::</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$no = 1;
							foreach(complaints::list() as $c){
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td class="text-center"><?= $c->c_date ?></td>
								<td><?= $c->c_title ?></td>
								<td class="text-center"><?= $c->c_status ?></td>
								<td class="text-right"></td>
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
					Add Complaint
					
					<a href="<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>" class="btn btn-primary btn-sm">
						Back
					</a>
				</div>
				
				<div class="card-body">
					<form action="" method="POST">
						<div class="row">
							<div class="col-md-4">
								Title:
								<input type="text" class="form-control" placeholder="Title" /><br />
								
								Description:
								<textarea class="form-control" placeholder="Description"></textarea><br />
								
								Category:
								<select class="form-control selectpicker" data-live-search="true">
								<?php
									foreach(categorys::list() as $cat){
									?>
									<option value="<?= $cat->c_id ?>"><?= $cat->c_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
								
								Source:
								<select class="form-control selectpicker" data-live-search="true">
								<?php
									foreach(sources::list() as $so){
									?>
									<option value="<?= $so->s_id ?>"><?= $so->s_name ?></option>
									<?php
									}
								?>
								</select><br /><br />
								
								<?= Controller::form("") ?>
								
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
		
	break;
	
	case "delete":
		
	break;
	
}
?>
