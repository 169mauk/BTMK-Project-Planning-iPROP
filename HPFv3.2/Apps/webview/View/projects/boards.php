<style>
.task-board {
    background: #2c7cbc;
    display: inline-block;
    padding: 12px;
    border-radius: 3px;
    width: 100%;
    white-space: nowrap;
    overflow-x: scroll;
    min-height: 600px;
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
<?php
if($_SESSION["admin"]){
	$ps = projects::list();
}else{
	$ps = projects::list(["where" => "p_id  IN (SELECT pd_project FROM project_department WHERE pd_department = ". $_SESSION["department"] .")"]);
}

foreach($ps as $p){
?>
<h2><?= $p->p_name ?> <small>- <?= $p->p_ref ?></small></h2><hr />

<div class="task-board">
<?php
	foreach (status::list() as $statusRow) {
		$taskResult = tasks::getBy(["t_project" => $p->p_id, "t_kstatus" => $statusRow->s_id]);
?>
	<div class="status-card">
		<div class="card-header">
			<span class="card-header-text"><?= $statusRow->s_name ?></span>
		</div>
		
		<ul 
			class="sortable ui-sortable" 
			id="sort<?= $statusRow->s_id ?>" 
			data-status-id="<?= $statusRow->s_id; ?>"
		>
		<?php
			foreach ($taskResult as $taskRow) {
		?>
		<li 
			class="text-row ui-sortable-handle"
			data-task-id="<?php echo $taskRow->t_id; ?>"
		>
			<?php echo $taskRow->t_title; ?>
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
				url: PORTAL + "webservice/tasks/updateBy/t_id=" + task_id,
				data:{
					t_kstatus: status_id
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



<?php
}