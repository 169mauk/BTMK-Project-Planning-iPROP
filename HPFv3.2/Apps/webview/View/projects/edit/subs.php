<div class="card-body" style="height: 400px; overflow-y: scroll;">
	<a href="#add_project" data-toggle="modal" class="btn btn-sm btn-primary">
		<span class="icon-plus"></span> New Project
	</a><br /><br />
	<table class="table table-hover table-fluid dataTable">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th>Title</th>
				<th class="text-center">Start</th>
				<th class="text-center">End</th>
				<th class="text-center">Status</th>
				<th class="text-right">:::</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
			$no = 1;
			if($_SESSION["admin"]){
				$ps = projects::getBy(["p_main" => url::get(3)]);
			}else{
				$ps = projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department = ". $_SESSION["department"] .") AND p_main = ". url::get(3)]);
			}
			
			foreach($ps as $p){
		?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td><?= $p->p_main ? "[SUB]" : "" ?> <?= $p->p_name ?></td>
				<td class="text-center"><?= date("d-M-Y", $p->p_time) ?></td>
				<td class="text-center"><?= date("d-M-Y", $p->p_end) ?></td>
				<td class="text-center">
					<?= $p->p_status ?><br />
					<small>by <?= $p->p_user ?></small>
				</td>
				<td class="text-right">
					<a href="<?= PORTAL ?>projects/all/edit/<?= $p->p_id ?>" class="btn btn-sm btn-warning">
						<span class="icon-edit"></span>
					</a>
				<?php
					if($_SESSION["role"]){
					?>
					<a href="<?= PORTAL ?>projects/all/delete/<?= $p->p_id ?>" class="btn btn-sm btn-danger">
						<span class="icon-trash"></span>
					</a>
					<?php
					}
				?>
				</td>
			</tr>
			<?php
			}
		?>
		</tbody>
	</table>
</div>
<?php
Render::Modal([
	"id" 		=> "add_project",
	"title"		=> '<span class="icon-plus"></span> Add Project'
], "widgets/modals/projects/add_project", "lg");
?>