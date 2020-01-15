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
				<td>
					<?= $p->p_main ? "[SUB]" : "" ?> <?= $p->p_name ?>
					<?php
						if(!empty($p->p_tags)){
							echo "<br />";
							
							$tags = explode(",", $p->p_tags);
							
							foreach($tags as $tag){
								$t = project_tags::getBy(["t_id" => $tag]);
								
								if(count($t)){
									$t = $t[0];
								?>
									<span class="badge" style="background-color: <?= $t->t_color ?>; color: white;">
										<?= $t->t_name ?>
									</span>
								<?php
								}
							}
						}
					?>
				</td>
				<td class="text-center"><?= date("d-M-Y", $p->p_time) ?></td>
				<td class="text-center"><?= date("d-M-Y", $p->p_end) ?></td>
				<td class="text-center">
					<?= count(settings::getBy(["s_key" => "project_status", "s_value" => $p->p_status])) ? settings::getBy(["s_key" => "project_status", "s_value" => $p->p_status])[0]->s_name : "NO STATE"  ?><br />
					<small>by <?= count(users::getBy(["user_id" => $p->p_user])) ? users::getBy(["user_id" => $p->p_user])[0]->user_name : "UNKNOWN" ?></small>
				</td>
				<td class="text-right">
					<a title="Edit Info" href="<?= PORTAL ?>projects/all/edit/<?= $p->p_id ?>" class="btn btn-sm btn-warning">
						<span class="icon-edit"></span>
					</a>
				<?php
					if($_SESSION["role"]){
					?>
					<a title="Delete Info" href="<?= PORTAL ?>projects/all/delete/<?= $p->p_id ?>" class="btn btn-sm btn-danger">
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