
<p>
	Please select companies you want to add to this project.
</p>

<form action="" method="POST">
	<select class="form-control selectpicker" data-live-search="true" name="company[]" multiple>
	<?php
		foreach(companies::list() as $co){
			if(count(project_company::getBy(["c_company" => $co->c_id, "c_project" => url::get(3)])) < 1){
		?>
			<option value="<?= $co->c_id ?>"><?= $co->c_name ?></option>
		<?php
			}
		}
	?>
	</select><br /><br />
	
	<?= Controller::form("projects/companies", ["action" => "add"]) ?>
	
	<button class="btn btn-sm btn-success">
		<span class="icon-save"></span> Save Information
	</button>
</form>