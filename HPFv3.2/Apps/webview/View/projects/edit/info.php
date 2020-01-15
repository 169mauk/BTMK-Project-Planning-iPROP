<script src="https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBehjO1GuDz--gzxCCBePfqBhpV82kfLPA"></script>
<?php
	$id = url::get(3);
	
	$p = projects::getBy(["p_id" => $id]);
	if(count($p) > 0){
		$p = $p[0];
?>
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-6">
				Title:
				<input type="text" class="form-control" placeholder="Project Title" value="<?= $p->p_name ?>" name="name" /><br />
				
				Category:
				<select class="form-control selectpicker" data-live-search="true" name="category">
				<?php
					foreach(project_categories::list() as $pc){
					?>
					<option value="<?= $pc->c_id ?>" <?= $pc->c_id == $p->p_category ? "selected" : "" ?>><?= $pc->c_name ?></option>
					<?php
					}
				?>
				</select><br /><br />
				
				Start:
				<input type="date" class="form-control" name="start" value="<?= date("Y-m-d", $p->p_time) ?>" /><br />
				
				End:
				<input type="date" class="form-control" name="end" value="<?= date("Y-m-d", $p->p_end) ?>" /><br />
				
				Tags:
				<select class="form-control selectpicker" data-live-search="true" multiple name="tags[]">
				<?php
					foreach(project_tags::list() as $pt){
					?>
					<option value="<?= $pt->t_id ?>" <?= in_array($pt->t_id, explode(",", $p->p_tags)) ? "selected": "" ?> style="color: <?= $pt->t_color ?>;">
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
						if(count(project_company::getBy(["c_company" => $c->c_id, "c_project" => $p->p_id])) > 0){
							$active = "selected";
						}else{
							$active = "";
						}
					?>
					<option value="<?= $c->c_id ?>" <?= $active ?>><?= $c->c_name ?></option>
					<?php
					}
				?>
				</select><br /><br />
				
				Status:
				<select class="form-control selectpicker" name="status">
					<option value="1" <?= $p->p_status == 1 ? "selected" : "" ?>>Active</option>
					<option value="0" <?= $p->p_status == 0 ? "selected" : "" ?>>Inactive</option>
				</select><br /><br />

				Department:
				<select class="form-control selectpicker" data-live-search="true" multiple name="department[]">
				<?php
					foreach(departments::list() as $dep){
						if(count(project_department::getBy(["pd_department" => $dep->d_id, "pd_project" => $p->p_id])) > 0){
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

				Source of Budget:
				<select class="form-control selectpicker" data-live-search="true" name="sob">
				<?php
					foreach(sob::list() as $s){
					?>
					<option value="<?= $s->s_id ?>" <?= $s->s_id == $p->p_sob ? "selected" : "" ?>><?= $s->s_name ?></option>
					<?php
					}
				?>
				</select><br /><br />
			</div>
			
			<div class="col-md-6">
				Location:
				<div id="us3" style="height: 500px;"></div>
				
				<input type="hidden" class="form-control location" style="" id="us3-lon" name="location" value="<?= $p->p_location ?>">
				<br />
				<?php
					$portal = PORTAL;
					$location = explode(",", $p->p_location);
					$latitude = isset($location[0]) ? $location[0] : "3.139003";
					$longitude = isset($location[1]) ? $location[1] : "101.68685499999992";
					Page::bodyAppend(<<<X
							<script src="$portal/assets/vendor/locationpicker/locationpicker.jquery.js"></script>
							<script>
								$('#us3').locationpicker({
									location: {
										latitude:  '$latitude',
										longitude: '$longitude'
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
				<input type="text" class="form-control" placeholder="0.00" name="cost" value="<?= $p->p_cost ?>" /><br />
				
				Ref No.:
				<input type="text" class="form-control" placeholder="Additional refeerence number" name="ref" value="<?= $p->p_ref ?>" /><br />
			</div>
			
			<div class="col-md-12">
				About Project:
				<textarea class="summernote form-control" name="content"><?= $p->p_content ?></textarea><br />
			</div>
			
			<div class="col-md-12 text-center">
				<?= Controller::form("projects/projects", ["action" => "edit"]) ?>
				<button class="btn btn-sm btn-success">
					<span class="icon-save"></span> Save Information
				</button>
			</div>
		</div>
	</form>
<?php
	}else{
		new Alert("error", "Selected project not found in current request.");
	}
?>