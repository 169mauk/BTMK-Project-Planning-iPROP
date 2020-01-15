<?php
$id = url::get(3);

if(!$_SESSION["role"]){
	$pa = project_application::getBy(["pa_project" => $id, "pa_department" => $_SESSION["department"]]);
}else{
	$pa = project_application::getBy(["pa_project" => $id]);
}

if(count($pa) > 0){
	$pa = $pa[0];
	
?>	
<br /><br />
<a href="<?= PORTAL ?>projects/application/edit/<?= $pa->pa_id ?>" class="btn btn-sm btn-primary">
	<span class="icon-edit"></span> Edit
</a>
<div class="project-profile">
	<h4 class="text-center"><?= $pa->pa_title ?></h4>
	<div class="text-center">
		<strong><u>Project Application Confirmation</u></strong>
	</div>
	
	<div class="text-right">
		<strong>Date: </strong> <?= $pa->pa_date ?><br />
	</div><br /><br />
	
	<br /><br />
	<div class="row">
		<div class="col-md-4 col-xs-4 col-4">
			<strong><u>Profile</u></strong><br /><br />
			<table class="table-fluid table-hover table">
				<tbody>
					<tr>
						<th>Manager<th>
						<td>
						<?php
							$u = users::getBy(["user_id" => $pa->pa_manager]);
							
							echo (count($u) ? $u[0]->user_name : "Unknown User")
						?>
						</td>
					</tr>
					
					<tr>
						<th>Direcotr<th>
						<td>
						<?php
							$u = users::getBy(["user_id" => $pa->pa_director]);
							
							echo (count($u) ? $u[0]->user_name : "Unknown USer")
						?>
						</td>
					</tr>
					
					<tr>
						<th>Department<th>
						<td>
						<?php
							$u = departments::getBy(["d_id" => $pa->pa_department]);
							
							echo (count($u) ? $u[0]->d_name : "Unknown Department")
						?>
						</td>
					</tr>
					
					<tr>
						<th>Sector<th>
						<td>
						<?php
							$u = sectors::getBy(["s_id" => $pa->pa_sector]);
							
							echo (count($u) ? $u[0]->s_name : "Unknown Sector")
						?>
						</td>
					</tr>
					
					<tr>
						<th>Category<th>
						<td>
						<?php
							$u = project_categories::getBy(["c_id" => $pa->pa_category]);
							
							echo (count($u) ? $u[0]->c_name : "Unknown Sector")
						?>
						</td>
					</tr>
					
					<tr>
						<th><i>Kod Maksud</i><th>
						<td>
						<?php
							$u = settings::getBy(["s_key" => "kod_maksud", "s_value" => $pa->pa_maksudCode]);
							
							echo (count($u) ? $u[0]->s_name : "Unknown Value")
						?>
						</td>
					</tr>
					
					<tr>
						<th><i>Kod Lanjut</i><th>
						<td>
						<?php
							$u = settings::getBy(["s_key" => "kod_lanjut", "s_value" => $pa->pa_lanjutCode]);
							
							echo (count($u) ? $u[0]->s_name : "Unknown Value")
						?>
						</td>
					</tr>
					
					<tr>
						<th><i>Kod Objek</i><th>
						<td>
						<?php
							$u = settings::getBy(["s_key" => "kod_lanjut", "s_value" => $pa->pa_objectCode]);
							
							echo (count($u) ? $u[0]->s_name : "Unknown Value")
						?>
						</td>
					</tr>
				</tbody>
			</table>								
		</div>
		
		<div class="col-md-4 col-xs-4 col-4">
			<strong><u>Finanancial</u></strong><br /><br />
			<table class="table-fluid table-hover table">
				<tbody>
					<tr>
						<th>Procurement Number<th>
						<td>
							<?= $pa->pa_procumentNo ?>
						</td>
					</tr>
					<tr>
						<th>Procurement Date<th>
						<td>
							<?= $pa->pa_procumentDate ?>
						</td>
					</tr>
					<tr>
						<th>Audget Application Date<th>
						<td>
							<?= $pa->pa_applicationBudgetDate ?>
						</td>
					</tr>
					<tr>
						<th>Budget Approval Date<th>
						<td>
							<?= $pa->pa_approvalBudgetDate ?>
						</td>
					</tr>
					
					<tr>
						<th>Cost (RM)<th>
						<td>
							<?= number_format($pa->pa_cost, 2) ?>
						</td>
					</tr>
				</tbody>
			</table>								
		</div>
		
		<div class="col-md-4 col-xs-4 col-4">
			<strong><u>Technical</u></strong><br /><br />
			<table class="table-fluid table-hover table">
				<tbody>
					<tr>
						<th>Kick Off Date<th>
						<td>
							<?= $pa->pa_kickOffDate ?>
						</td>
					</tr>
					<tr>
						<th>Guided Date<th>
						<td>
							<?= $pa->pa_guideDate ?>
						</td>
					</tr>
					<tr>
						<th>Technical Date<th>
						<td>
							<?= $pa->pa_technicalDate ?>
						</td>
					</tr>
					<tr>
						<th>Project Type<th>
						<td>
						<?php
							$s = settings::getBy(["s_key" => "project_type", "s_value" => $pa->pa_type]);
							
							echo (count($s) ? $s[0]->s_name : "UNKNOWN");
						?>
						</td>
					</tr>
					<tr>
						<th>Client (Contractor)<th>
						<td>
						<?php
							$c = companies::getBy(["c_id" => $pa->pa_client]);
							
							echo (count($c) ? $c[0]->c_name : "NIL");
						?>
						</td>
					</tr>
				</tbody>
			</table>								
		</div>
	</div>
</div>	
<?php
}else{
	new Alert("error", "Project application information not found.");
}
