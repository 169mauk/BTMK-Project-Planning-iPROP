<form action="" method="POST">
	Title:
	<input type="text" class="form-control" placeholder="Job Title" name="jtitle" /><br />
	
	Description:
	<textarea class="form-control" placeholder="Description" name="jdescription"></textarea><br />
	
	Status:
	<select class="form-control" name="jstatus"></select><br />
	
	Tags:
	<select class="form-control" name="jtag[]" id="jtag" multiple></select><br /><br />
	
	<?php
		Controller::form("projects/job",[
			"action"	=> "edit",
			"jid"		=> ""
		]);
	?>
	
	<button class="btn btn-success btn-sm">
		<span class="icon-save"></span> Save Job
	</button>
</form>