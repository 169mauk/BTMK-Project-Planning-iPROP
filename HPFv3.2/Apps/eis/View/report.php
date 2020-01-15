<?php
new Controller();
?>
<div class="card">
	<div class="card-header">
		Report 
		
		<button onclick="printElem('data')" class="btn btn-warning btn-sm">
			Print
		</button>
	</div>
	
	<div class="card-body">
		<form action="" method="POST">
			<div class="row">
				<div class="col-md-4">
					Kod Objek:
					<select class="form-control selectpicker" name="objek[]" multiple>
					<?php
						$obj = explode(",", url::Get(1));
						foreach(settings::getBy(["s_key" => "kod_objek"]) as $x){
						?>
						<option value="<?= $x->s_value ?>" <?= in_array($x->s_value, $obj) ? "selected" : "" ?>><?= $x->s_name ?></option>
						<?php
						}
						
						$os = "";
						
						if(is_array($obj)){
							foreach($obj as $o){
								if(($os) != ""){
									$os .= ",";
								}
								
								$os .= "'" . $o ."'";
							}
						}
					?>
					</select><br /><br />
				</div>
				
				<div class="col-md-4">
					Kod Lanjut:
					<select class="form-control selectpicker" name="lanjut[]" multiple>
					<?php
						$lanjut = explode(",", url::Get(2));
						foreach(settings::getBy(["s_key" => "kod_lanjut"]) as $x){
						?>
						<option value="<?= $x->s_value ?>" <?= in_array($x->s_value, $lanjut) ? "selected" : "" ?>><?= $x->s_name ?></option>
						<?php
						}
						
						$ls = "";
						
						if(is_array($lanjut)){
							foreach($lanjut as $l){
								if(($ls) != ""){
									$ls .= ",";
								}
								
								$ls .= "'" . $l ."'";
							}
						}
					?>
					</select><br /><br />
				</div>
				
				<div class="col-md-12">
				<?php
					Controller::form("generate_report");
				?>
					<button class="btn btn-sm btn-success">
						Show Result
					</button><br /><br />
				</div>
			</div>
		</form>
		
		<div class="table-responsive" id="data">
			<table class="table-hover table table-fluid table-bordered">
				<thead>
					<tr>
						<th>No Rujukan</th>
						<th>Tarikh Surat</th>
						<th>Tarikh Terima Waran</th>
						<th>No Waran</th>
						<th>Projek</th>
						<th>Peruntukan Diluluskan (RM)</th>
						<th>Perbelanjaan (RM)</th>
						<th>Inden</th>
						<th>Tarikh Inden</th>
						<th>Baucar Bayaran</th>
						<th>Catatan</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
					$x = project_application::list(["where" => "pa_objectCode IN (". $os .") AND pa_lanjutCode IN(". $ls .")"]);
					
					foreach($x as $a){
						$p = projects::GetBy(["p_id" => $a->pa_project]);
						
						if(count($p)){
							$p = $p[0];
					?>
						<tr>
							<td><?= $p->p_ref ?></td>
							<td><?= $p->p_letterDate ?></td>
							<td><?= $p->p_warrantAcceptanceDate ?></td>
							<td><?= $p->p_warrantNo ?></td>
							<td><?= $p->p_name ?></td>
							<td class="text-right"><?= number_format($p->p_cost, 2) ?></td>
							<td class="text-right"><?= number_format(0, 2) ?></td>
							<td><?= $p->p_indentNo ?></td>
							<td><?= $p->p_indentDate ?></td>
							<td>
							<?php
								foreach(reports::getBy(["r_project" => $p->p_id, "r_status" => 1]) as $r){
								?>
								<?= $r->r_voucherDate ?> (<?= $r->r_voucherNo ?>)
								<?php
								}
							?>
							</td>
							<td>
							<?php
								$pf = project_finishing::getBy(["pf_project" => $p->p_id]);
								
								if(count($pf)){
									$pf = $pf[0];
									echo $pf->pf_notes;
								}else{
									echo "Not marked as fnish";
								}
							?>
							</td>
						</tr>
					<?php
						}
					}
				?>
				</tbody>
			</table>
			
			<div class="row" style="margin-bottom: 100px;">
				<div class="col-md-4">
					Oleh:<br />
				</div>
				
				<div class="col-md-4">
					Disemak Oleh:<br />
				</div>
				
				<div class="col-md-4">
					Disahkan Oleh:<br />
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function printElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
</script>