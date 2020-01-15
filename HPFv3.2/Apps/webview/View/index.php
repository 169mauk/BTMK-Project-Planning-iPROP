<?php
new Controller($_POST);
?>
<style>
body, .app-container, .main-content{
	background-color: #fff !important;
}
</style>
<div class="row gutters">
	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
		<div class="simple-widget">
			<h3>
			<?php
				$alltask = count(jobs::getBy(["j_user" => $_SESSION["user_id"]]));
				$donetask = count(jobs::getBy(["j_user" => $_SESSION["user_id"], "j_status" => 1]));
				
				$pending = $alltask - $donetask;
				
				echo $alltask;
				
				if($alltask){
					$percent = (ceil($pending/$alltask)) * 100;
				}else{
					$percent = 0;
				}
			?>
			</h3>
			<?php
				if($percent == 100){
				?>
				<div class="growth">Done</div>
				<?php
				}
			?>
			<p>Pending Tasks</p>
			<div class="progress sm">
				<div class="progress-bar" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
		<div class="simple-widget">
			<h3>
			<?php
				echo count(projects::list(["where" => "p_id IN (SELECT pu_project FROM project_user WHERE pu_user = ". $_SESSION["user_id"] .")"]));
			?>
			</h3>
			<p>Assigned Projects</p>
			<div class="progress sm">
				<div class="progress-bar" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
		<div class="simple-widget danger">
			<h3>
			<?php
				$alltask = count(eot::getBy(["e_user" => $_SESSION["user_id"]]));
				$donetask = count(eot::getBy(["e_user" => $_SESSION["user_id"], "e_status" => 1]));
				
				$pending = $alltask - $donetask;
				
				echo $alltask;
				
				if($alltask){
					$percent = (ceil($pending/$alltask)) * 100;
				}else{
					$percent = 0;
				}
			?>
			</h3>
			<p>Pending EOT Request</p>
			<div class="progress sm">
				<div class="progress-bar" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
		<div class="simple-widget secondary">
			<h3>
			<?php
				$alltask = count(reports::getBy(["r_user" => $_SESSION["user_id"]]));
				$donetask = count(reports::getBy(["r_user" => $_SESSION["user_id"], "r_status" => 1]));
				
				$pending = $alltask - $donetask;
				
				echo $alltask;
				
				if($alltask){
					$percent = (ceil($pending/$alltask)) * 100;
				}else{
					$percent = 0;
				}
			?>
			</h3>
			<p>Pending Report</p>
			<div class="progress sm">
				<div class="progress-bar" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				Pending Job List
			</div>
			
			<div class="card-body">
				<div class="list-group">
				<?php
					foreach(jobs::list(["where" => "j_user = ".  $_SESSION["user_id"] ." AND j_status = 0"]) as $job){
						$p = projects::getBy(["p_id" => $job->j_project]);
					?>
					<div class="list-group-item job" data-p-name="<?= $p ? $p[0]->p_name : "Unknow Project" ?>" data-id="<?= $job->j_id ?>">
						<strong>P: <?= $p ? $p[0]->p_name : "Unknow Project" ?></strong><br />
						<strong>J: <?= $job->j_title ?></strong><br />
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
						</small><br />
						
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
					</div>
					<?php
					}
				?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
Render::Modal([
	"id"		=> "view_job",
	"title"		=> '<span class="icon-edit"></span> Job'
], "widgets/modals/dashboard/view_job", "md");

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

$(".job").on("click", function(){
	job_id = $(this).attr("data-id");
	p_name = $(this).attr("data-p-name");
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/jobs/getBy",
		data: {
			j_id: job_id
		},
		dataType: "json"
	}).done(function(res){
		data = res.data[0];
		
		$("#j_title").html(data.j_title);
		$("[name=jid]").val(data.j_id);
		$("#j_description").text(data.j_description);
		$("#p_name").text(p_name);
		
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
</script>
SCRIPT
);
?>