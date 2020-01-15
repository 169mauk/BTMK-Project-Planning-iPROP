<script src="https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBehjO1GuDz--gzxCCBePfqBhpV82kfLPA"></script>
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
			<?= Controller::form("projects/projects", ["action" => "add_sub"]) ?>
			<button class="btn btn-sm btn-success">
				<span class="icon-save"></span> Save Information
			</button>
		</div>
	</div>
</form>