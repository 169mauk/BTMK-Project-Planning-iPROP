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

<?php

foreach(departments::list(["where" => "d_id = " . $_SESSION["department"]]) as $d){
?>
<h2><?= $d->d_name ?></h2>
<hr />
<div class="task-board">
<?php
	foreach(user_department::getBy(["ud_department" => $d->d_id]) as $pu) {
		$user = users::getBy(["user_id" => $pu->ud_user]);
		
		if(count($user)){
			$user = $user[0];
			
?>
	<div class="status-card">
		<div class="card-header clearfix">
			<?= $user->user_name ?>
			
		</div>
		
		<ul 
			class="sortable ui-sortable" 
			id="sort<?= $user->user_id ?>" 
			data-status-id="<?= $user->user_id; ?>"
		>
		<?php
			if(count(jobs::list(["where" => "j_user = $user->user_id AND j_project IN (SELECT pd_project FROM project_department WHERE pd_department = $d->d_id)"])) < 1){
			?>
			<li class="text-row">
				No Job Listing
			</li>
			<?php			
			}
			
			foreach(jobs::list(["where" => "j_user = $user->user_id AND j_project IN (SELECT pd_project FROM project_department WHERE pd_department = $d->d_id)"]) as $job) {
		?>
			<li 
				class="text-row ui-sortable-handle job"
				data-task-id="<?= $job->j_id; ?>"
				data-status="<?= $job->j_status ?>"
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
}