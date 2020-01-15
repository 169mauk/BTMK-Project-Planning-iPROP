<style>
.task-board {
    background: #2c7cbc;
    display: inline-block;
    padding: 12px;
    border-radius: 3px;
    width: 100%;
    white-space: nowrap;
    overflow-x: scroll;
    min-height: 450px;
}

.status-card {
    width: 250px;
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
<?php
foreach(settings::getBy(["s_key" => "project_status"]) as $statusRow){
	
?>
	<div class="status-card">
		<div class="card-header">
			<span class="card-header-text"><?= $statusRow->s_name ?></span>
		</div>
		
		<ul 
			class="sortable ui-sortable" 
			id="sort<?= $statusRow->s_value ?>" 
			data-status-id="<?= $statusRow->s_value; ?>"
		>
		<?php
			if($_SESSION["admin"]){
				$ps = projects::list(["where" => "p_status = " . $statusRow->s_value]);
			}else{
				$ps = projects::list(["where" => "p_id  IN (SELECT pd_project FROM project_department WHERE pd_department = ". $_SESSION["department"] .") AND p_status = " . $statusRow->s_value]);
			}
			
			foreach ($ps as $p) {
				$tg = task_group::getBy(["tg_project" => $p->p_id], ["order" => "tg_id DESC", "limit" => 1]);
				$percent = 0;
				if(count($tg)){
					$tg = $tg[0];
					
					$t = tasks::getBy(["t_group" => $tg->tg_id]);
					
					if(count($t)){
						$done = DB::conn()->query("SELECT SUM(t_percent) as percent FROM tasks WHERE t_group = " . $tg->tg_id)->results();
						
						if(count($done)){
							$per = $done[0]->percent;
							
							if(!empty($per)){
								$percent = ($per / (count($t) * 100)) * 100;
							}
						}
					}
				}
		?>
		<li 
			class="text-row ui-sortable-handle"
			data-task-id="<?php echo $p->p_id; ?>"
		>
			<?php echo $p->p_name; ?><br />
			<small><?= number_format($percent) ?>% completed</small>
		</li>
		<?php
			}
		?>
		</ul>
	</div>
<?php
}
?>
</div>
<?php
Page::bodyAppend(<<<SCRIPT
<script>
$( function() {
	$('ul[id^="sort"]').sortable({
		connectWith: ".sortable",
		receive: function (e, ui) {
			var status_id = $(ui.item).parent(".sortable").data("status-id");
			var task_id = $(ui.item).data("task-id");
			$.ajax({
				method: "POST",
				url: PORTAL + "webservice/projects/updateBy/p_id=" + task_id,
				data:{
					p_status: status_id
				},
				success: function(response){}
			});
		}
	}).disableSelection();
});
</script>
SCRIPT
);


?>