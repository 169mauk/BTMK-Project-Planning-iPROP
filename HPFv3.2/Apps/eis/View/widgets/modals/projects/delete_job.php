<form action="" method="POST">
	<p>
		By clicking below button will remove job "<strong id="djob_title"></strong>" permanently.
	</p>
	
	<?php
		Controller::form("projects/job",[
			"action"	=> "delete",
			"job_id"		=> ""
		]);
	?>
	
	<button class="btn btn-danger btn-sm">
		<span class="icon-trash"></span> Delete Job
	</button>
</form>