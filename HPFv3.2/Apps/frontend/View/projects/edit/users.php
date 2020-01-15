<style>
.task-board {
    background: #2cbc79;
    display: inline-block;
    padding: 12px;
    border-radius: 3px;
    width: 100%;
    white-space: nowrap;
    overflow-x: scroll;
    min-height: 600px;
}

.status-card {
    width: 400px;
    margin-right: 8px;
    background: #e2e4e6;
    border-radius: 3px;
    display: inline-block;
    vertical-align: top;
    font-size: 0.9em;
}

.status-card:last-child {
    margin-right: 0px;
}

.card-header {
    width: 100%;
    padding: 10px 10px 0px 10px;
    box-sizing: border-box;
    border-radius: 3px;
    display: block;
    font-weight: bold;
}

.card-header-text {
    display: block;
}

ul.sortable {
    padding-bottom: 10px;
}

ul.sortable li:last-child {
    margin-bottom: 0px;
}

ul {
    list-style: none;
    margin: 0;
    padding: 0px;
}

.text-row {
    padding: 15px 10px;
    margin: 10px;
    background: #fff;
    box-sizing: border-box;
    border-radius: 3px;
    border-bottom: 1px solid #ccc;
    cursor: pointer;
    white-space: normal;
    line-height: 20px;
}

.ui-sortable-placeholder {
    visibility: inherit !important;
    background: transparent;
    border: #666 2px dashed;
}
</style>

<div class="task-board">
	<a href="#add_user" data-toggle="modal" class="btn btn-primary btn-sm">
		<span class="icon-plus2"></span> Add User
	</a><br /><br />
<?php
	foreach(project_user::getBy(["pu_project" => url::get(3)]) as $pu) {
		$user = users::getBy(["user_id" => $pu->pu_user]);
		
		if(count($user)){
			$user = $user[0];
			
?>
	<div class="status-card">
		<div class="card-header clearfix">
			<?= $user->user_name ?>
			<button class="btn btn-secondary btn-sm float-right add_job_button" data-user="<?= $user->user_id ?>">
				<span class="icon-plus2"></span> Job
			</button>
		<?php
			if($_SESSION["role"]){
		?>
			<button class="btn btn-<?= $pu->pu_role ? "dark" : "warning" ?> btn-sm float-right user_role" data-role="<?= $pu->pu_role ?>" data-user="<?= $user->user_id ?>" style="margin-right: 10px;">
				<span class="icon-user-tie"></span> <?= $pu->pu_role ? "Leader" : "User" ?>
			</button>
		<?php
			}
		?>
			
			<button class="btn btn-danger btn-sm delete_user" data-user="<?= $user->user_id ?>">
				<span class="icon-trash"></span>
			</button>
		</div>
		
		<ul 
			class="sortable ui-sortable" 
			id="sort<?= $user->user_id ?>" 
			data-status-id="<?= $user->user_id; ?>"
		>
		<?php
			if(count(jobs::getBy(["j_user" => $user->user_id, "j_project" => url::get(3)])) < 1){
			?>
			<li class="text-row">
				No Job Listing
			</li>
			<?php			
			}
			
			foreach(jobs::getBy(["j_user" => $user->user_id, "j_project" => url::get(3)]) as $job) {
		?>
			<li 
				class="text-row ui-sortable-handle job"
				data-task-id="<?= $job->j_id; ?>"
				data-status="<?= $job->j_status ?>"
				data-user="<?= $job->j_user ?>"
			>
				<strong><?= $job->j_title ?></strong><br />
				<?= $job->j_description ?><br />
				<small>
					<?= $job->j_date ?> <?= date("H:i:s\ ", $job->j_time) ?>
					<?php
						if(!empty($job->j_by)){
							$u = users::getBy(["user_id" => $job->j_by]);
							
							if(count($u)){
								echo " by " . $u[0]->user_name;
							}
						}
					?>
				</small>
				<br />
				<span class="badge badge-pill badge-<?= $job->j_status ? "success" : "warning" ?>">
					<?= $job->j_status ? "Completed" : "Pending" ?>
				</span>
				<?php
					if(!empty($job->j_tags)){
						$tags = explode(",", $job->j_tags);
						
						foreach($tags as $tag){
							$ts = tags::getBy(["t_id" => $tag]);
							
							if(count($ts)){
								$ts = $ts[0];
							?>
								<span class="badge bandge-sm badge-<?= $ts->t_color ?>"><?= $ts->t_name ?></span>
							<?php
							}
						}
					}
				?>
				<hr />
				<a data-toggle="modal" data-task-id="<?= $job->j_id; ?>" data-user="<?= $job->j_user ?>" class="text-danger delete-job" style="margin-top: 50px;">
					<span class="icon-trash"></span> Delete
				</a>
			</li>
		<?php
			}
		?>
		</ul>
	</div>
<?php
		}
	}
?>
</div>
<?php
$p_id = url::get(3);
Render::Modal([
	"id"		=> "add_user",
	"title"		=> '<span class="icon-plus"></span> User'
], "widgets/modals/projects/add_user", "md");

Render::Modal([
	"id"		=> "delete_user",
	"title"		=> '<span class="icon-trash"></span> User'
], "widgets/modals/projects/delete_user", "md");

Render::Modal([
	"id"		=> "add_job",
	"title"		=> '<span class="icon-plus"></span> Job'
], "widgets/modals/projects/add_job", "md");

Render::Modal([
	"id"		=> "view_job",
	"title"		=> '<span class="icon-plus"></span> Job'
], "widgets/modals/projects/view_job", "md");

Render::Modal([
	"id"		=> "delete_job",
	"title"		=> '<span class="icon-trash"></span> Delete Job'
], "widgets/modals/projects/delete_job", "md");

Page::bodyAppend(<<<SCRIPT
<script>
tags = [];
$.ajax({
	method: "POST",
	url: PORTAL + "webservice/tags/list",
	data: {
		where: "t_id > 0"
	},
	dataType: "json"
}).done(function(res){
	tags = res.data;
});

$(".user_role").on("click", function(){
	role = "";
	if($(this).attr("data-role") == "0"){
		$(this).removeClass("btn-warning");
		$(this).addClass("btn-dark");
		$(this).attr("data-role", "1");
		$(this).html(`<span class="icon-user-tie"></span> Leader`);
		role = "1";
	}else{
		$(this).removeClass("btn-dark");
		$(this).addClass("btn-warning");
		$(this).attr("data-role", "0");
		$(this).html(`<span class="icon-user-tie"></span> User`);
		role = "0";
	}
	
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/project_user/updateBy/pu_user=" + $(this).attr("data-user") + ",pu_project=$p_id",
		data:{
			pu_role: role
		}
	});
});

$(function() {
	$('ul[id^="sort"]').sortable({
		connectWith: ".sortable",
		receive: function (e, ui) {
			var status_id = $(ui.item).parent(".sortable").data("status-id");
			var task_id = $(ui.item).data("task-id");
			$.ajax({
				method: "POST",
				url: PORTAL + "webservice/jobs/updateBy/j_id=" + task_id,
				data:{
					j_user: status_id
				},
				success: function(response){}
			});
		}
	}).disableSelection();
});

$(".add_job_button").on("click", function(){
	$("[name=userjob]").val($(this).attr("data-user"));
	
	$("#add_job").modal("toggle");
});

$(".job").on("dblclick", function(){
	job_id = $(this).attr("data-task-id");
	userid = $(this).attr("data-user");
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/jobs/getBy",
		data: {
			j_id: job_id
		},
		dataType: "json"
	}).done(function(res){
		data = res.data[0];
		
		$("[name=jtitle]").val(data.j_title);
		$("[name=jid]").val(data.j_id);
		$("[name=jdescription]").val(data.j_description);
		$("[name=juser]").val(userid);
		
		$("[name=jstatus]").html("");
		[{i:0,name:"Pending"}, {i:1,name:"Completed"}].forEach(function(x){
			if(x.i == data.j_status){
				selected = "selected";
			}else{
				selected = "";
			}
			
			$("[name=jstatus]").append(`
				<option value="`+ x.i +`" `+ selected +`>`+ x.name +`</option>
			`);
		});
		jtag = data.j_tags.split(",");
		
		$("#jtag").html("");
		tags.forEach(function(tag){
			if(jtag.indexOf(tag.t_id) < 0){
				selected = "";
			}else{
				selected = "selected";
			}
			
			$("#jtag").append(`
				<option 
					value="`+ tag.t_id +`" 
					`+ selected +`
					class="text-`+ tag.t_color +`"
				>
				`+ tag.t_name +`
				</option>
			`);
		});
		
		$("#view_job").modal("toggle");
	});
});

$(".delete-job").on("click", function(){
	job_id = $(this).attr("data-task-id");
	userid = $(this).attr("data-user");
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/jobs/getBy",
		data: {
			j_id: job_id
		},
		dataType: "json"
	}).done(function(res){
		data = res.data[0];
		
		$("#djob_title").html(data.j_title);
		$("[name=job_id]").val(data.j_id);
		$("[name=job_user]").val(userid);
		
		$("#delete_job").modal("toggle");
	});
});

$(".delete_user").on("click", function(){
	user_id = $(this).attr("data-user");
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/users/getBy",
		data: {
			user_id: user_id
		},
		dataType: "json"
	}).done(function(res){
		data = res.data[0];
		
		$("#delete_user_name").html(data.user_name);
		$("[name=duser_id]").val(data.user_id);
		
		$("#delete_user").modal("toggle");
	});
});
</script>
SCRIPT
);


?>


