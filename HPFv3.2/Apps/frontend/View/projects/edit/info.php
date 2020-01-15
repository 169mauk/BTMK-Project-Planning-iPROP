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
				
				<div class="row">
					<div class="col-md-6">
						Start:
						<input type="date" class="form-control" name="start" value="<?= date("Y-m-d", $p->p_time) ?>" /><br />
					</div>
					
					<div class="col-md-6">
						End:
						<input type="date" class="form-control" name="end" value="<?= date("Y-m-d", $p->p_end) ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Estimate Start:
						<input type="date" class="form-control" name="estimateStart" value="<?= date("Y-m-d", empty($p->p_estimateStart) ? time() : strtotime($p->p_estimateStart)) ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Estimate End:
						<input type="date" class="form-control" name="estimateEnd" value="<?= date("Y-m-d", empty($p->p_estimateEnd) ? time() : strtotime($p->p_estimateEnd)) ?>" /><br />
					</div>
					
					<div class="col-md-6">
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
					</div>
					
					<div class="col-md-6">
						Status:
						<select class="form-control selectpicker" name="status">
						<?php
							foreach(status::list() as $st){
							?>
							<option value="<?= $st->s_id ?>" <?= $p->p_status == $st->s_id ? "selected" : "" ?>><?= $st->s_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
					</div>
					
					<div class="col-md-12">
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
					</div>
					
					<div class="col-md-6">
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
					</div>
					
					<div class="col-md-6">
						Sector:
						<select class="form-control selectpicker" data-live-search="true" name="sector">
						<?php
							foreach(sectors::list() as $dep){
							?>
								<option value="<?= $dep->s_id ?>" <?= $p->p_sector == $dep->s_id ? "selected" : "" ?>><?= $dep->s_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
					</div>	
					
					<div class="col-md-12">
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
						Agreed Cost (RM):
						<input type="text" class="form-control" placeholder="0.00" name="cost" value="<?= $p->p_cost ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Offered Cost (RM):
						<input type="text" class="form-control" placeholder="0.00" name="offeredCost" value="<?= $p->p_offeredCost ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Estimate Value (RM):
						<input type="text" class="form-control" placeholder="0.00" name="bid" value="<?= $p->p_bid  ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Budget Cost (RM):
						<input type="text" class="form-control" placeholder="0.00" name="departmentBudget" value="<?= $p->p_departmentBudget  ?>" /><br />
					</div>
										
					<div class="col-md-6">
						Letter Date:
						<input type="date" class="form-control" placeholder="Letter Date" name="letterDate" value="<?= $p->p_letterDate ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Year of Project:
						<input type="text" class="form-control" name="year" value="<?= $p->p_year ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Warrant Number:
						<input type="text" class="form-control" placeholder="Warrant Number" name="warrantNo" value="<?= $p->p_warrantNo  ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Warrant Date:
						<input type="date" class="form-control" name="warrantAcceptanceDate" value="<?= $p->p_warrantAcceptanceDate ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Indent Number:
						<input type="text" class="form-control" placeholder="Indent Number" name="indentNo" value="<?= $p->p_indentNo  ?>" /><br />
					</div>
					
					<div class="col-md-6">
						Indent Date:
						<input type="date" class="form-control" name="indentDate" value="<?= empty($p->p_indentDate) ?>" /><br />
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				Short name:
				<input type="text" class="form-control" placeholder="Project Title" value="<?= $p->p_short ?>" name="short" /><br />
				
				<div class="row">
					<div class="col-md-6">
						Outsource Project?:
						<select class="form-control selectpicker" name="outsource">
							<option value="0" <?= !$p->p_outsource ? "selected" : "" ?>>No</option>
							<option value="1" <?= $p->p_outsource ? "selected" : "" ?>>Yes</option>
						</select><br /><br />
					</div>
					
					<div class="col-md-6">
						Estimation Days taken:
						<input type="number" class="form-control" placeholder="1" name="period" value="<?= $p->p_period ?>" /><br />
					</div>
					
					<div class="col-md-12">
						Maintenance
					</div>
					
					<div class="col-md-6">
						Start:
						<input type="date" class="form-control" name="maintenanceStart" value="<?= date("Y-m-d", empty($p->p_maintenanceStart) ? time() : strtotime($p->p_maintenanceStart)) ?>" /><br />
					</div>
					
					<div class="col-md-6">
						End:
						<input type="date" class="form-control" name="maintenanceEnd" value="<?= date("Y-m-d", empty($p->p_maintenanceEnd) ? time() : strtotime($p->p_maintenanceEnd)) ?>" /><br />
					</div>
				</div>
				
				Location:
				<div id="us3" style="height: 350px;"></div>
				
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
									onchanged: function (currentLocation, radius, isMarkerDropped){
										$(".location").val(currentLocation.latitude + "," + currentLocation.longitude)
									}
								});
							</script> 
X
);
			?>
			
				Ref No.:
				<input type="text" class="form-control" placeholder="Additional refeerence number" name="ref" value="<?= $p->p_ref ?>" /><br />
				
				<div class="row">
					<div class="col-md-6">
						<i>Kod Objek:</i>
						<select class="form-control selectpicker" data-live-search="true" name="kodObjek">
							<option value="">None</option>
						<?php
							foreach(settings::getBy(["s_key" => "kod_objek"]) as $km){
							?>
							<option value="<?= $km->s_value ?>" <?= $p->p_kodObjek == $km->s_value ? "selected" : "" ?>><?= $km->s_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
					</div>
					
					<div class="col-md-6">
						<i>Kod Lanjut:</i>
						<select class="form-control selectpicker" data-live-search="true" name="kodLanjut">
							<option value="">None</option>
						<?php
							foreach(settings::getBy(["s_key" => "kod_lanjut"]) as $km){
							?>
							<option value="<?= $km->s_value ?>" <?= $p->p_kodLanjut == $km->s_value ? "selected" : "" ?>><?= $km->s_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
					</div>
					
					<div class="col-md-6">
						<i>Kod Maksud:</i>
						<select class="form-control selectpicker" data-live-search="true" name="kodMaksud">
							<option value="">None</option>
						<?php
							foreach(settings::getBy(["s_key" => "kod_maksud"]) as $km){
							?>
							<option value="<?= $km->s_value ?>" <?= $p->p_kodMaksud == $km->s_value ? "selected" : "" ?>><?= $km->s_name ?></option>
							<?php
							}
						?>
						</select><br /><br />
					</div>
				</div>
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