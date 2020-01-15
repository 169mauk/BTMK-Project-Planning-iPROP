<?php

$pf = project_finishing::getBy(["pf_project" => url::get(3)]);



if(count($pf)){
	$pf = $pf[0];
}else{
	$pf = null;
}

if($_SESSION["role"] < 1 ){
	if(!$pf){
		new Alert("info", "This project has not marked as finish. Only Leader & Admin can mark as finish.");
	}else{
		new Alert("info", "This project has been marked as finish.");
	}
}
?>
<div class="row">
	<div class="col-md-4">
	<?php
		if($_SESSION["role"] > 0){
	?>
		<form action="" method="POST">
			Notes:
			<textarea class="form-control" placeholder="Notes" name="note"><?= $pf ? $pf->pf_notes : "" ?></textarea><br /><br />
			
			<?php
				Controller::form("projects/finish");
			?>
			<button class="btn btn-success btn-sm">
				Mark this project as Finish
			</button>
		</form>
	<?php
		}else{
		?>
		<strong>Notes:</strong><br />
		<?= $pf ? $pf->pf_note : "NIL" ?>
		<?php
		}
	?>
		<hr />
		<strong>Uploaded Files</strong><br /><br />
		<div class="list-group">
		<?php
			foreach(files::list(["where" => "f_id IN (SELECT pf_file FROM project_file WHERE pf_project = ". url::get(3) .") AND f_type = 1"]) as $f){
			?>
			<a href="<?= PORTAL ?>download/project_file/<?= $f->f_name ?>" class="list-group-item">
				<?= $f->f_title ?>
			</a>
			<?php
			}
		?>
		</ul>
	</div>
</div>






























