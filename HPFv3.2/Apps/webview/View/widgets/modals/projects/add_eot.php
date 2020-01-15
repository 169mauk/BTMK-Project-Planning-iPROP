
<form action="" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12">
			Company:
			<select class="form-control selectpicker" name="e_company">
			<?php
				foreach (companies::list() as $com) {
					?>
					<option value="<?= $com->c_id ?>"><?= $com->c_name ?></option>
					<?php
				}
			?>
			</select><br /><br />
		</div><br /><br />
		<!-- <div class="col-md-6">
			Status:
			<select class="form-control selectpicker" name="e_status">
				<option value="0" >Pending</option>
				<option value="1" >Approved</option>
				<option value="2" >Decline</option>
			</select><br /><br />
		</div> -->
		<div class="col-md-6">
			End Date:
			<input type="date" class="form-control" placeholder="End Date" name="e_end" required/><br />
		</div>
		<div class="col-md-6">
			Ref No:
			<input type="text" class="form-control" placeholder="Ref No" name="e_ref" required/><br />
		</div><br /><br />
		<div class="col-md-12">
			Notes:
			<textarea class="form-control" name="e_note"></textarea><br />
		</div><br /><br />
		<div class="col-md-12 text-center">
			<?= Controller::form("projects/eot", ["action" => "add"]) ?>
			<button class="btn btn-sm  btn-success">
				<span class="icon-save"></span> Save
			</button>
		</div>
	</div>
</form>