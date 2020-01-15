<?php
switch(url::get(5)){
	default:
	case "":
	?>	
	<div class="card-body" style="height: 400px; overflow-y: scroll;">
		<a href="#add_task_group" data-toggle="modal" class="btn btn-sm btn-primary">
			<span class="icon-plus"></span> New Schedule
		</a><br /><br />
		<table class="table table-fluid table-hover dataTable">
			<thead>
				<tr>
					<th width="5%" class="text-center">No</th>
					<th>Name</th>
					<th class="text-center">Date</th>
					<th class="text-center">User</th>
					<th class="text-right">:::</th>
				</tr>
			</thead>
			
			<tbody>
			<?php
				$no = 1;
				foreach(task_group::getBy(["tg_project" => url::get(3)]) as $t){
				?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td>
							<?= $t->tg_name ?><br />
							<?= $t->tg_note ?>
						</td>
						<td class="text-center"><?= $t->tg_date ?></td>
						<td><?= users::getBy(["user_id" => $t->tg_user]) ? users::getBy(["user_id" => $t->tg_user])[0]->user_name : "NIL" ?></td>
						<td class="text-right">
							<a title="View Info" href="<?= F::URLParams() ?>/view/<?= $t->tg_id ?>" class="btn btn-sm btn-primary" data-id="<?= $t->tg_id ?>">
								<span class="icon-eye"></span>
							</a>
						<?php
							if($_SESSION["role"] > 0 || $_SESSION["user_id"] == $t->tg_user){
						?>							
							<a title="Delete Info" href="<?= F::URLParams() ?>/delete/<?= $t->tg_id ?>" class="btn btn-sm btn-danger">
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
			"id" 		=> "add_task_group",
			"title"		=> '<span class="icon-plus"></span> Add Task Group'
		], "widgets/modals/projects/add_task_group", "lg");
		
		
		
		Page::bodyAppend(<<<S
		<script>
			$(".task-click").on("click", function(){
				
			});
		</script>
S
);	
	break;
	
	case "view":
	?>
		<a href="<?= PORTAL ?><?= url::get(0) . "/" . url::get(1) . "/" . url::get(2) . "/" . url::get(3) . "/" . url::get(4) ?>" class="btn btn-primary btn-sm">
			Back
		</a>
	<?php
		$tg = task_group::getBy(["tg_id" => url::get(6), "tg_project" => url::get(3)]);
		
		if(count($tg)){
			$tg = $tg[0];
		?>
			<a href="#add_task" data-toggle="modal" class="btn btn-sm btn-primary">
				<span class="icon-plus"></span> Add Task
			</a><br /><br />
		
		<?php
			if($_SESSION["role"] > 0 || $_SESSION["user_id"] == $tg->tg_user){
		?>
			<h3 class="mt-2" contenteditable="true" id="title"><?= $tg->tg_name ?></h3>
			<p contenteditable="true" id="description"><?= $tg->tg_note ?></p>
		<?php		
			Page::bodyAppend(<<<SCRIPT
<script>
$("#title").on("keyup", function(){
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/task_group/updateBy/tg_id=" + $tg->tg_id,
		data:{
			tg_name: $(this).text()
		}
	});
});

$("#description").on("keyup", function(){
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/task_group/updateBy/tg_id=" + $tg->tg_id,
		data:{
			tg_note: $(this).text()
		}
	});
});
</script>			
SCRIPT
);
			}else{
		?>
			<h3 class="mt-2"><?= $tg->tg_name ?></h3>
			<p><?= $tg->tg_note ?></p>
			<?php
			}
		?>
		
		<link href="<?= PORTAL ?>assets/vendor/jsgantt/jsgantt.css" rel="stylesheet" type="text/css"/>
		<script src="<?= PORTAL ?>assets/vendor/jsgantt/jsgantt.js" type="text/javascript"></script>
		
		<div id="chart"></div>
		<?php
			Render::Modal([
				"id" 		=> "add_task",
				"title"		=> '<span class="icon-plus"></span> Add Task'
			], "widgets/modals/projects/add_task", "lg");
			
			Render::Modal([
				"id"		=> "show_task",
				"title"		=> '<span class="icon-eye"></span> Task Viewer'
			], "widgets/modals/projects/view_task", "lg");
			
			$j = [];
			
			foreach(tasks::getBy(["t_group" => $tg->tg_id]) as $t){
				
				$users = "";
				foreach(task_user::getBy(["tu_task" => $t->t_id]) as $tu){
					if(!empty($users)){
						$users .= "<br />";
					}
					
					if(!empty($tu->tu_user)){
						$u = users::getBy(["user_id" => $tu->tu_user]);
						
						if(count($u)){
							$users .= $u[0]->user_name;
						}
					}else{
						$c = companies::getBy(["c_id" => $tu->tu_company]);
						
						if(count($c)){
							$users .= $c[0]->c_name;
						}
					}
				}
				
				$j[] = [
					"pID"			=> $t->t_id,
					"pName"			=> $t->t_title,
					"pStart"		=> date("Y-m-d", strtotime($t->t_start)),
					"pEnd"			=> date("Y-m-d", strtotime($t->t_end)),
					"pPlanStart"	=> date("Y-m-d", strtotime($t->t_planStart)),
					"pPlanEnd"		=> date("Y-m-d", strtotime($t->t_planEnd)),
					"pClass"		=> $t->t_color,
					"pLink"			=> "",
					"pMile"			=> 0,
					"pRes"			=> $users,
					"pComp"			=> $t->t_percent,
					"pGroup"		=> (count(tasks::getBy(["t_subOf" => $t->t_id])) ? 1 : 0),
					"pParent"		=> $t->t_subOf,
					"pOpen"			=> 1,
					"pDepend"		=> (string)$t->t_after,
					"pCaption"		=> $t->t_content,
					"pCost"			=> 1000,
					"pNotes"		=> $t->t_content,
					"pBarText"		=> $t->t_notes
				];
			}
			
			$json = json_encode($j);
			Page::bodyAppend(<<<S
<script>
$(document).on("keyup", ".t_title", function(){
	tid = $(this).attr("data-id")
	title = $(this).text();
	
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/tasks/updateBy/t_id=" + tid,
		data:{
			t_title: title
		}
	});
});
var g = new JSGantt.GanttChart(document.getElementById('chart'), 'day');

g.setOptions({
	vCaptionType: 'Complete',   
	vQuarterColWidth: 36,
	vDateTaskDisplayFormat: 'day dd month yyyy',
	vDayMajorDateDisplayFormat: 'mon yyyy - Week ww',
	vWeekMinorDateDisplayFormat: 'dd mon',
	vLang: 'en',
	vShowTaskInfoLink: 1,
	vShowEndWeekDate: 0,
	vUseSingleCell: 10000,
	vFormatArr: ['Day', 'Week', 'Month', 'Quarter'],
	vEvents: {
		taskname: (x) => {
			$.ajax({
				url: PORTAL + "webservice/tasks/getBy/",
				method: "POST",
				data: {
					t_id: x.getOriginalID()
				},
				dataType: "json"
			}).done(function(res){
				if(res.status == "success"){
					t = res.data[0];
					clients = [];
					users = [];
					$(".edit-form").val("");
					
					$("[name=_title]").val(t.t_title);
					$("[name=_content]").val(t.t_content);
					$("[name=_planStart]").val(formatDate(t.t_planStart));
					$("[name=_planEnd]").val(formatDate(t.t_planEnd));
					$("[name=_start]").val(formatDate(t.t_start));
					$("[name=_end]").val(formatDate(t.t_end));
					$("select[name=_main] option[value="+ t.t_after +"]").prop("selected", true);
					$("select[name=_subOf] option[value="+ t.t_subOf +"]").prop("selected", true);
					$("select[name=_color] option[value="+ t.t_color +"]").prop("selected", true);
					$("[name=_note]").val(t.t_notes);
					$("[name=tid]").val(t.t_id);
					$("[name=_percent]").val(t.t_percent);
					
					$.ajax({
						method: "POST",
						url: PORTAL + "webservice/task_user/getBy/",
						data:{
							tu_task: t.t_id
						},
						dataType: "json",
						async: false
					}).done(function(res){
						if(res.status == "success"){
							res.data.forEach((client) => {
								if(client.tu_company == "0"){
									users.push(client.tu_user);
								}else{
									clients.push(client.tu_company);
								}
							});
						}
					});
					
					clients.forEach((x) => {
						$("#_clients option[value="+ x +"]").prop("selected", true);
					});
					
					users.forEach((y) => {
						console.log(y);
						$("#_users option[value="+ y +"]").attr("selected", true);
					});
					
					
					$("#task_viewer").html(`
						<strong>`+ res.data[0].t_title +`</strong><br />
						<small>`+ res.data[0].t_date +`</small>
						<p>
							`+ res.data[0].t_content +`
						</p>
					`);
					
					$("#show_task").modal("toggle");
					$(".selectpicker").selectpicker("refresh");
				}else{
					$("#task_viewer").html(res.message);
				}
			}).fail(function(){
				$("#task_viewer").html("Oops! Error getting data from server.");
			});
		}
	}
});

function formatDate(date){
	d = new Date(date);
	nd = "";
	day = d.getDate();
	year = d.getFullYear() - (d.getFullYear() * 2);
	month = d.getMonth() + 1;
	
	nd = year + "-";
	if(month < 10){
		nd += "0";
	}
	
	nd += month + "-";
	
	if(day < 10){
		nd += "0";
	}
	nd += day;
	return nd;
}
data = JSON.parse('$json');

data.forEach(function(x){
	g.AddTaskItemObject(x);
});

g.Draw();
</script>
S
);
		}else{
			new Alert("error", "Task group not found.");
		}
	break;
	
	case "delete":
	?>
	<a href="<?= PORTAL ?><?= url::get(0) . "/" . url::get(1) . "/" . url::get(2) . "/" . url::get(3) . "/" . url::get(4) ?>" class="btn btn-primary btn-sm">
		Back
	</a><br /><br />
	<?php
	$tg = task_group::getBy(["tg_id" => url::get(6), "tg_project" => url::get(3)]);
	
	if(count($tg)){
		$tg = $tg[0];
	?>
	<h3 class="mt-2">Are you sure?</h3>
	
	<p>
		By clicking below button will delete Task Group <strong><?= $tg->tg_name ?></strong> permanently including it's tasks.
	</p>	
		
	<form action="" method="POST">
	<?php
		Controller::form("projects/task_group", [
			"action"	=> "delete"
		]);
	?>
		<button class="btn btn-sm btn-danger">
			<span class="icon-trash"></span> Confrm Delete
		</button>
	</form>
	<?php
		}else{
			new Alert("error", "Task group not found.");
		}
	break;
}

?>