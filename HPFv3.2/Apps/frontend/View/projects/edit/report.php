<?php
$id = url::get(3);
$p = projects::getBy(["p_id" => $id]);

if(count($p) > 0){
	$p = $p[0];
?>	
<div class="card-body">
	<a href="#add_report" data-toggle="modal" class="btn btn-sm btn-primary">
		<span class="icon-plus"></span> Add Report
	</a><br ><br />
	<table class="table table-fluid table-hover dataTable">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">Date</th>
				<th>Title</th>
				<th class="text-center">Status</th>
				<th class="text-right">Claim (RM)</th>
				<th class="text-center">User</th>
				<th class="text-right">:::</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
			$no = 1;
			foreach(reports::getBy(["r_project" => $p->p_id], ["order" => "r_id DESC"]) as $rp){
			?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td class="text-center"><?= $rp->r_date ?></td>
				<td><?= $rp->r_title ?></td>
				<td class="text-center">
				<?php
					$s = settings::getBy(["s_key" => "report_status", "s_value" => $rp->r_status]);
					
					if(count($s)){
						echo $s[0]->s_name;
					}else{
						echo "Unknown Status";
					}
				?>
				</td>
				<td class="text-right"><?= number_format($rp->r_claim, 2) ?></td>
				<td class="text-center"><?= users::getBy(["user_id" => $rp->r_user]) ? users::getBy(["user_id" => $rp->r_user])[0]->user_name : "Unknown User" ?></td>
				<td class="text-right">
					<a title="Edit Info" href="<?= PORTAL ?>reports/all/edit_report/<?= $rp->r_id ?>" target="_blank" class="btn btn-sm btn-primary">
						<span class="icon-eye"></span>
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
		"id"		=> "add_report",
		"title"		=> '<span class="icon-plus"></span> Report'
	], "widgets/modals/projects/add_report", "lg");
}
?>