<?php
$id = url::get(3);
$p = projects::getBy(["p_id" => $id]);

if(count($p) > 0){
	$p = $p[0];
?>	
<div class="card-body" style="height: 400px; overflow-y: scroll;">
	<a href="#add_company" data-toggle="modal" class="btn btn-sm btn-primary">
		<span class="icon-plus"></span> New Client
	</a><br /><br />
	<table class="table table-fluid table-hover">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th>Company</th>
				<th class="text-right">:::</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
			$no = 1;
			foreach(project_company::getBy(["c_project" => $p->p_id]) as $pc){
				$c = companies::getBy(["c_id" => $pc->c_company]);
				
				if(count($c) > 0){
					$c = $c[0];
			?>
				<tr>
					<td class="text-center"><?= $no++ ?></td>
					<td><?= $c->c_name ?></td>
					<td class="text-right">
					<?php
						if($pc->c_status){
							$status = "success";
							$text = "Main";
						}else{
							$status = "warning";
							$text = "Sub";
						}
					?>
						<button class="btn btn-<?= $status ?> btn-sm client-status-click" data-id="<?= $c->c_id ?>">
							<?= $text ?>
						</button>
						
						<a href="" class="btn btn-danger btn-sm">
							<span class="icon-trash"></span>
						</a>
					</td>
				</tr>
			<?php
				}
			}
		?>
		</tbody>
	</table>
</div>

<?php
Render::Modal([
	"id" 		=> "add_company",
	"title"		=> '<span class="icon-plus"></span> Add Company'
], "widgets/modals/projects/add_company", "md");
$p_id = $p->p_id;
Page::bodyAppend(<<<S
				<script>
					$(".client-status-click").on("click", function(){
						if($(this).hasClass("btn-success")){
							$(this).removeClass("btn-success");
							$(this).addClass("btn-warning");
							$(this).text("Sub");
							status = 0;
						}else{
							$(this).addClass("btn-success");
							$(this).removeClass("btn-warning");
							$(this).text("Main");
							status = 1;
						}
						
						$.ajax({
							url: PORTAL + "webservice/project_company/updateBy/c_company=" + $(this).attr("data-id") + ",c_project=$p_id",
							method: "POST",
							data: {
								c_status: status
							},
							dataType: "text"
						}).done(function(res){
							console.log(res);
						});
					});
				</script>
S
);
}
?>