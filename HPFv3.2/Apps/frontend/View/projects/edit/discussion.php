
<a href="#add_discussion" data-toggle="modal" class="btn btn-primary btn-sm">
	<span class="icon-plus2"></span> Add Issue
</a>
<br /><br />


<div class="row">
	<div class="col-md-4">
		<div class="list-group">
		<?php
			foreach(discussions::getBy(["d_project" => url::get(3), "d_main" => 0], ["order" => "d_status ASC"]) as $d){
		?>
			<a class="list-group-item <?= $d->d_status ? "bg-dark text-white" : "" ?>" href="<?= PORTAL ?>projects/all/edit/<?= url::get(3) ?>/Issues/<?= $d->d_id ?>">
				<?= $d->d_title ?><br />
				<strong><?= (discussion_category::getBy(["dc_id" => $d->d_category]) ? discussion_category::getBy(["dc_id" => $d->d_category])[0]->dc_name : "No Category") ?></strong><br />
				
				<small>
					<?= date("d-m-Y H:i:s\ ", $d->d_time) ?> by 
					<?= count(users::getBy(["user_id" => $d->d_user])) ? users::getBy(["user_id" => $d->d_user])[0]->user_name : "NONE" ?>
					<?= $d->d_status ? "[CLOSED]" : "" ?>
				</small>
			</a>
		<?php
			}
		?>
		</div>
	</div>
	
	<div class="col-md-8">
	<?php
		if(!empty(url::get(5))){
			$d = discussions::getBy(["d_id" => url::get(5)]);
			
			if(count($d)){
				$d = $d[0];
			?>
			<div class="card">
				<div class="card-header">
					<span class="icon-message-typing"></span> <?= $d->d_title ?>
				</div>
				
				<div class="card-body" style="height: 350px; overflow-y: scroll; background-color: #fafafa">
					<?= $d->d_content ?><br />
					<small>
						<?= date("d-M-Y H:i:s\ ", $d->d_time) ?> by 
						<?= count(users::getBy(["user_id" => $d->d_user])) ? users::getBy(["user_id" => $d->d_user])[0]->user_name : "NONE" ?>
					</small>
					<hr />
					<div id="chat_list">
					<?php
						foreach(discussions::getBy(["d_main" => $d->d_id]) as $rd){
							if($rd->d_user == $_SESSION["user_id"]){
							?>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-9" style="margin-bottom: 20px; background-color: #bdeaff; padding: 10px;">
									<?= $rd->d_content ?><br />
									<small>
										<?= date("d-M-Y H:i:s\ ", $rd->d_time) ?> by 
						<?= count(users::getBy(["user_id" => $rd->d_user])) ? users::getBy(["user_id" => $rd->d_user])[0]->user_name : "NONE" ?>
									</small>
								</div>
							</div>
							<?php
							}else{
							?>
							<div class="row">
								<div class="col-md-9" class="col-md-9" style="margin-bottom: 20px; background-color: #bdffc9; padding: 10px;">
									<?= $rd->d_content ?><br />
									<small>
										<?= date("d-M-Y H:i:s\ ", $rd->d_time) ?> by 
						<?= count(users::getBy(["user_id" => $rd->d_user])) ? users::getBy(["user_id" => $rd->d_user])[0]->user_name : "NONE" ?>
									</small>
								</div>
								
								<div class="col-md-3"></div>
							</div>
							<?php
							}
						}
					?>
					</div>
				</div>
				
				<div class="card-footer">
					<div class="row">
						<div class="col-md-6">
						<?php
							if(!$d->d_status) {
						?>
							<form action="" method="POST">								
								<?php
									Controller::form("projects/discussion", [
										"action"	=> "closing"
									]);
								?>
								
								<button class="btn btn-danger btn-sm" id="send-message">
									<span class="icon-times"></span> Close Issue
								</button>
							</form>
						<?php
							}else{
						?>
							<form action="" method="POST">								
								<?php
									Controller::form("projects/discussion", [
										"action"	=> "opening"
									]);
								?>
								
								<button class="btn btn-success btn-sm" id="send-message">
									<span class="icon-times"></span> Reopen Issue
								</button>
							</form>
						<?php
							}
						?>
						</div>
						
						<div class="col-md-6 text-right">
							<form action="" method="POST">
								<textarea class="form-control" placeholder="Message" id="messages" name="content"></textarea><br />
								
								<?php
									Controller::form("projects/discussion", [
										"action"	=> "add_reply"
									]);
								?>
								
								<button class="btn btn-primary btn-sm float-right" id="send-message">
									<span class="icon-location-arrow"></span> Send
								</button>
							</form>
						</div>
					</div>
					
				</div>
			</div>
			<?php
			}else{
				new Alert("error", "No topic found in current selected discussion.");
			}
		}
	?>
	</div>
</div>
<?php
Render::Modal([
	"id"		=> "add_discussion",
	"title"		=> '<span class="icon-plus"></span> Discussion'
], "widgets/modals/projects/add_discussion", "md");
?>