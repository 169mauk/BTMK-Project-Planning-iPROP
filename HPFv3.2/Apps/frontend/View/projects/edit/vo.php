<?php
$id = url::get(3);
$p = projects::getBy(["p_id" => $id]);

if(count($p) > 0){
	$p = $p[0];
?>	
<div class="card-body">
	<a href="#add_vo" data-toggle="modal" class="btn btn-sm btn-primary">
		<span class="icon-plus"></span> Add VO
	</a><br ><br />
	<table class="table table-fluid table-hover">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">Date</th>
				<th class="text-right">Status</th>
				<th class="text-center">Request By</th>
				<th class="text-center">Approved By</th>
				<th class="text-center">:::</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
			$no = 1;
			foreach(vo::list(["where" => "v_project = " . $p->p_id]) as $vo){
			?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td class="text-center"><?= $vo->v_date ?></td>
				<td>
					<?php
						$project = projects::getBy(["p_id" => $vo->v_project]);
						if(count($project) > 0){
							$project = $project[0];
							echo $project->p_name;
						}
					?>
				</td>
				<td class="text-center">
					<?php
						
						$user = users::getBy(["user_id" => $vo->v_user]);
						if(count($user) > 0){
							$user = $user[0];
							echo $user->user_name;
						}
					?>
				</td>
				<td class="text-center">
					<?php
						
						$user = users::getBy(["user_id" => $vo->v_approve_by]);
						if(count($user) > 0){
							$user = $user[0];
							echo $user->user_name;
						}
					?>
				</td>
				<td>
					<a title="Edit Info" href="<?= PORTAL ?>vo/edit/<?= $vo->v_id ?>" target="_blank" class="btn btn-sm btn-warning">
						<span class="icon-pencil"></span>
					</a>
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
		"id"		=> "add_vo",
		"title"		=> '<span class="icon-plus"></span> VO'
	], "widgets/modals/projects/add_vo", "md");
}
?>