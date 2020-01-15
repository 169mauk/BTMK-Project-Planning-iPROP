<?php
$id = url::get(3);
$p = projects::getBy(["p_id" => $id]);

if(count($p) > 0){
	$p = $p[0];
?>	
<div class="card-body">
	<a href="#add_eot" data-toggle="modal" class="btn btn-sm btn-primary">
		<span class="icon-plus"></span> Add EOT
	</a><br ><br />
	<table class="table table-fluid table-hover">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">Date</th>
				<th>Project</th>
				<th class="text-right">Status</th>
				<th class="text-center">Request By</th>
				<th class="text-center">Approved By</th>
				<th class="text-center">Company</th>
				<th class="text-center">:::</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
			$no = 1;
			foreach(eot::list() as $eot){
			?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td class="text-center"><?= $eot->e_date ?></td>
				<td>
					<?php
						$project = projects::getBy(["p_id" => $eot->e_project]);
						if(count($project) > 0){
							$project = $project[0];
							echo $project->p_name;
						}
					?>
				</td>
				<td class="text-right">
					<?php
				 		if($eot->e_status == 0){
				 			echo "Pending";
				 		}elseif($eot->e_status == 1){
				 			echo "Approved";
				 		}else{
				 			echo "Decline";
				 		}
				 	?>
				 </td>
				<td class="text-center">
					<?php
						
						$user = users::getBy(["user_id" => $eot->e_user]);
						if(count($user) > 0){
							$user = $user[0];
							echo $user->user_name;
						}
					?>
				</td>
				<td class="text-center">
					<?php
						
						$user = users::getBy(["user_id" => $eot->e_approve_by]);
						if(count($user) > 0){
							$user = $user[0];
							echo $user->user_name;
						}
					?>
				</td>
				<td class="text-center">
					<?php
						$comp = companies::getBy(["c_id" => $eot->e_company]);
						if(count($comp) > 0){
							$comp = $comp[0];
							echo $comp->c_name;
						}
					?>
				</td>
				<td>
					<a href="<?= PORTAL ?>eot/edit/<?= $eot->e_id ?>" target="_blank" class="btn btn-sm btn-warning">
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
		"id"		=> "add_eot",
		"title"		=> '<span class="icon-plus"></span> EOT'
	], "widgets/modals/projects/add_eot", "md");
}
?>