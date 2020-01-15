<form action="" method="POST">
	<strong>Project: <span id="p_name"></span></strong><br />
	<strong>Job: <span id="j_title"></span></strong><br /> 
	<span id="j_description"></span>
	
	Status:
	<select class="form-control" name="jstatus"></select><br />
	
	Tags:
	<select class="form-control" name="jtag[]" id="jtag" multiple></select><br /><br />
	
	<?php
		Controller::form("dashboard/job",[
			"action"	=> "edit",
			"jid"		=> ""
		]);
	?>
	
	<button class="btn btn-success btn-sm">
		<span class="icon-save"></span> Save Job
	</button>
</form>