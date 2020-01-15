<?php
$id = url::get(3);
$p = projects::getBy(["p_id" => $id]);

if(count($p) > 0){
	$p = $p[0];
?>	
	<div class="card-body" style="height: 400px; overflow-y: scroll;">
		<a href="#add_task" data-toggle="modal" class="btn btn-sm btn-primary">
			<span class="icon-plus"></span> New Task
		</a><br /><br />
		<table class="table table-fluid table-hover">
			<thead>
				<tr>
					<th class="text-center">No</th>
					<th>Task</th>
					<th class="text-right">:::</th>
				</tr>
			</thead>
			
			<tbody>
			<?php
				$no = 1;
				foreach(tasks::getBy(["t_project" => $p->p_id]) as $t){
				?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $t->t_title ?></td>
						<td class="text-right">
							<a href="#show_task" data-toggle="modal" class="btn btn-sm btn-warning task-click" data-id="<?= $t->t_id ?>">
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
		"id" 		=> "add_task",
		"title"		=> '<span class="icon-plus"></span> Add Task'
	], "widgets/modals/projects/add_task", "lg");
	
	Render::Modal([
		"id"		=> "show_task",
		"title"		=> '<span class="icon-eye"></span> Task Viewer'
	], "widgets/modals/projects/view_task", "md");
	
	Page::bodyAppend(<<<S
				<script>
					$(".task-click").on("click", function(){
						$.ajax({
							url: PORTAL + "webservice/tasks/getBy/",
							method: "POST",
							data: {
								t_id: $(this).attr("data-id")
							},
							dataType: "json"
						}).done(function(res){
							if(res.status == "success"){
								$("#task_viewer").html(`
									<strong>`+ res.data[0].t_title +`</strong><br />
									<small>`+ res.data[0].t_date +`</small>
									<p>
										`+ res.data[0].t_content +`
									</p>
								`);
							}else{
								$("#task_viewer").html(res.message);
							}
						}).fail(function(){
							$("#task_viewer").html("Oops! Error getting data from server.");
						});
					});
				</script>
S
);
}
?>