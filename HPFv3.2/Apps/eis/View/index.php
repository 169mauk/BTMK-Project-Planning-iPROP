<?php
$portal = PORTAL;
Page::bodyAppend(<<<SCRIPT
<script src="$portal/assets/vendor/morris/raphael-min.js"></script>
<script src="$portal/assets/vendor/morris/morris.min.js"></script>
<script src="$portal/assets/vendor/flot/jquery.flot.min.js"></script>
<script src="$portal/assets/vendor/flot/jquery.flot.time.min.js"></script>
<script src="$portal/assets/vendor/flot/jquery.flot.pie.min.js"></script>
<script src="$portal/assets/vendor/flot/jquery.flot.stack.min.js"></script>
<script src="$portal/assets/vendor/flot/jquery.flot.tooltip.min.js"></script>
<script src="$portal/assets/vendor/flot/jquery.flot.resize.min.js"></script>

SCRIPT
);
?>
<div class="col-md-12 text-right">
	<a class="btn btn-warning text-right" onclick="printDiv('printableArea')"><span class="icon-print"></span> Print</a><br /><br />
</div>

<div id="printableArea">

	<div class="row gutters">
		<div class="col-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="simple-widget">
				<h3><?= $total = count(projects::list(["where" => "p_year = " . date("Y")])) ?></h3>
				<p>Project Of <?= date("Y") ?></p>
				<div class="progress sm">
					<div class="progress-bar" role="progressbar" style="width: 37%;" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
		<div class="col-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="simple-widget">
				<h3>
				<?= $complete =  count(projects::list(["where" => "p_year = " . date("Y") . " AND p_status = " . settings::getBy(["s_key" => "project_status", "s_name" => "Complete"])[0]->s_value])) ?>
				</h3>
				<p>Completed Project</p>
				<div class="progress sm">
					<div class="progress-bar" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
		<div class="col-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="simple-widget">
				<h3>
				<?= $pending = count(projects::list(["where" => "p_year = " . date("Y") . " AND p_status = " . settings::getBy(["s_key" => "project_status", "s_name" => "Pending"])[0]->s_value])) ?>
				</h3>
				<p>Pending Project</p>
				<div class="progress sm">
					<div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
		<div class="col-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="simple-widget secondary">
				<h3>
				<?= $cancel = count(projects::list(["where" => "p_year = " . date("Y") . " AND p_status = " . settings::getBy(["s_key" => "project_status", "s_name" => "Cancelled"])[0]->s_value])) ?>
				</h3>
				<p>Cancelled Project</p>
				<div class="progress sm">
					<div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Row end -->
	
	
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
			<div class="card">
				<div class="card-header">Source of Budget Summary</div>
				<div class="card-body">
					<div class="col-12 col-md-12 col-sm-12">
						<div id="sob" class="chart-height"></div>
					</div>
					<div class="col-12 col-md-12 col-sm-12 col-xs-12">
						<table class="table table-responsive table-bordered text-center">
							<thead style="background-color: silver">
								<tr>
									<th>
										Name
									</th>
									<th>
										Amount
									</th>
									<th>
										Projects
									</th>
									<th>
										Paid
									</th>
									<th>
										Balance
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach(sob::list() as $s){
										$sid = $s->s_id;
										$total_cost = DB::conn()->q("SELECT SUM(p_cost) as cost_tot FROM projects WHERE p_sob = $sid")->results();
										if(count($total_cost) > 0){
											$total_cost = $total_cost[0];
											$cost = $total_cost->cost_tot;
										}
										?>
										<tr>
											<td><?= $s->s_name ?></td>
											<td><?= number_format($s->s_amount, 2) ?></td>
											<td>
											<?php
												$project= projects::getBy(["p_sob" => $s->s_id]);
												echo count($project);
											?>
											 </td>
											<td><?= number_format($cost, 2) ?></td>
											<td>
												<?php
													$bal = $s->s_amount - $cost;
													echo number_format($bal, 2);
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
$data = [];
$ss = [];
foreach(settings::getBy(["s_key" => "report_status"]) as $s){
	$ss[] = $s->s_name;
}

$ss = json_encode($ss);

foreach(sob::list() as $s){
	$datax = [
		"x"	=> $s->s_name
	];
	
	foreach(settings::getBy(["s_key" => "report_status"]) as $st){
		$report = DB::conn()->q("SELECT SUM(r_claim) as amount FROM reports WHERE r_status = $st->s_value AND r_project IN (SELECT p_id FROM projects WHERE p_sob = $s->s_id)")->results();
		
		if(count($report)){
			$report = $report[0]->amount;
		}else{
			$report = 0;
		}
		$datax[$st->s_name] = $report;
	}
	
	$data[] = $datax;
}

$data = json_encode($data);

Page::bodyAppend(<<<SCRIPT
<script>
Morris.Bar({
	element: 'sob',
	data: $data,
	xkey: 'x',
	ykeys: $ss,
	labels: $ss,
	stacked: true,
	hideHover: "auto",
	resize: true,
	gridLineColor: "#e4e6f2",
	barColors:['#0063bf', '#e5e8f2', '#ff5661', '#0063bf', '#0088fb', '#1594ff', '#2fa0ff', '#e5e8f2', '#ff5661'],
});
</script>
SCRIPT
);
?>
				</div>
			</div>
		</div> 
		
		<div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
			<div class="card">
				<div class="card-header">Project Summarize By Status</div>
				<div class="card-body">
					<div class="col-12 col-md-12 col-sm-12">
						<div id="donutFormatter" class="chart-height"></div>
					</div>
					<div class="col-12 col-md-12 col-sm-12">
						<table class="table table-bordered text-center">
							<thead style="background-color: silver">
								<tr>
									<th>
										Status
									</th>
									<th>
										Total
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$tp = count(projects::list());
									foreach(settings::getBy(["s_key" => "project_status"]) as $status_pro){
										?>
										<tr>
											<td><?= $status_pro->s_name ?></td>
											<td><?= ((count(projects::list(["where" => "p_status = $status_pro->s_value"])) / $tp) * 100)  . "%" ?></td>
										</tr>
										<?php
									}
								?>
								
							</tbody>
						</table>
					</div>
<?php
$data = [];
$tp = count(projects::list());

foreach(settings::getBy(["s_key" => "project_status"]) as $s){
	$data[] = [
		"label"			=> $s->s_name,
		"value"			=> count(projects::list(["where" => "p_status = $s->s_value"])),
		"formatted"		=> ((count(projects::list(["where" => "p_status = $s->s_value"])) / $tp) * 100)  . "%"
	];
}

$data = json_encode($data);

Page::bodyAppend(<<<SCRIPT
<script>
Morris.Donut({
	element: 'donutFormatter',
	data: $data,
	resize: true,
	hideHover: "auto",
	formatter: function (x, data) { return data.formatted; },
	colors:['#0063bf', '#e5e8f2', '#ff5661']
});
</script>
SCRIPT
);
?>
				</div>
			</div>
		</div>
	<?php
	//
	/*
		foreach(departments::list() as $d){
		?>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card">
				<div class="card-header"><?= $d->d_name ?></div>
				<div class="card-body">
					<div id="donut-chart-<?= $d->d_id ?>" class="chart-height"></div>
<?php

$data = [];
foreach(settings::getBy(["s_key" => "project_status"]) as $s){
	$count = projects::list(["where" => "p_status = $s->s_value AND p_id IN (SELECT pd_project FROM project_department WHERE pd_department = $d->d_id)"]);
	
	$data[] = [
		"label"	=> $s->s_name,
		"data"	=> count($count)
	];
}

$data = json_encode($data);

Page::bodyAppend(<<<SCRIPT
<script>
$(function () {

	var data, chartOptions;
	
	data = $data;
	// data = [
		// { label: "Apples", data: Math.floor (Math.random() * 100 + 150) }, 
		// { label: "Oranges", data: Math.floor (Math.random() * 100 + 390) }, 
		// { label: "Pinaples", data: Math.floor (Math.random() * 100 + 530) }, 
		// { label: "Grapes", data: Math.floor (Math.random() * 100 + 90) },
		// { label: "Bananas", data: Math.floor (Math.random() * 100 + 320) }
	// ];

	chartOptions = {        
		series: {
			pie: {
				show: true,  
				innerRadius: .5, 
				stroke: {
					width: 0,
				}
			}
		},
		shadowSize: 0,
		legend: {
			position: 'sw'
		},
		
		tooltip: true,

		tooltipOpts: {
			content: '%s: %y'
		},
		
		grid:{
			hoverable: true,
			clickable: false,
			borderWidth: 1,
			tickColor: '#f5f6fa',
			borderColor: '#f5f6fa',
		},
		shadowSize: 0,
		colors: ['#0063bf', '#0088fb', '#1594ff', '#2fa0ff', '#e5e8f2', '#ff5661'],
	};

	var holder = $('#donut-chart-$d->d_id');

	if (holder.length) {
		$.plot(holder, data, chartOptions );
	}		
		
});
</script>
SCRIPT
);
?>
				</div>
			</div>
		</div>
		<?php
		}
	/*
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
		<div class="card">
			<div class="card-header">Project Financing (Budget vs Actual)</div>
			<div class="toggle-switch tr">
				<input type="checkbox" class="check" />
				<b class="b switch"></b>
				<b class="b track"></b>
			</div>
			<div class="card-body">
				<div id="areaChart" class="chart-height-lg"></div>
				<div class="spacer20"></div>
				<div class="row gutters">
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
						<div class="info-stats">
							<span class="info-label"></span>
							<p class="info-title">Budget This Year</p>
							<h4 class="info-total">12,800</h4>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
						<div class="info-stats">
							<span class="info-label red"></span>
							<p class="info-title">Actual Paid This Year</p>
							<h4 class="info-total">7,985</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-xl-12 col-lg-6 col-md-6 col-sm-6">
		<div class="card">
			<div class="card-header">Stacked Horizontal Chart</div>
			<div class="card-body">
				<div id="stacked-horizontal-chart" class="chart-height"></div>
			</div>
		</div>
	</div>
	*/
	?>
	
		<div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">Project Summary by Departments</div>
				<div class="card-body">
					<div id="stackedBarChart" class="chart-height"></div>
				</div>
			</div>
<?php
$data = [];
$ss = [];
foreach(settings::getBy(["s_key" => "project_status"]) as $s){
	$ss[] = $s->s_name;
}

$ss = json_encode($ss);

foreach(departments::list() as $d){
	$datax = [
		"x"	=> $d->d_name
	];
	
	foreach(settings::getBy(["s_key" => "project_status"]) as $s){
		$datax[$s->s_name] = count(projects::list(["where" => "p_status = $s->s_value AND p_id IN (SELECT pd_project FROM project_department WHERE pd_department = $d->d_id)"]));
	}
	
	$data[] = $datax;
}

$data = json_encode($data);

Page::bodyAppend(<<<SCRIPT
<script>
Morris.Bar({
	element: 'stackedBarChart',
	data: $data,
	xkey: 'x',
	ykeys: $ss,
	labels: $ss,
	stacked: true,
	hideHover: "auto",
	resize: true,
	gridLineColor: "#e4e6f2",
	barColors:['#0063bf', '#e5e8f2', '#ff5661', '#0063bf', '#0088fb', '#1594ff', '#2fa0ff', '#e5e8f2', '#ff5661'],
});
</script>
SCRIPT
);
?>
		</div>
	</div>
	
	<div class="row gutters">
		<div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
			<div class="card">
				<div class="card-header">Recent Discussed Issues</div>
				<div class="customScroll">
					<div class="card-body">
						<ul class="product-status">
						<?php
							foreach(discussions::list(["where" => "d_main = 0"]) as $d){
						?>
							<li class="clearfix">
								<div class="customer">
									<!-- <img src="img/avatar1.svg" alt="Bluemoon Admin">-->
								</div>
								<div class="product-details">
									<span class="badge badge-primary">
									<?php
										$u = users::getBy(["user_id" => $d->d_user]);
										if(count($u)){
											echo $u[0]->user_name;
										}else{
											echo "Unknow User";
										}
									?>
									</span>
									<h6 class="text-primary"><?= $d->d_title ?></h6>
									<p><?= $d->d_content ?></p>
								</div>
							</li>
						<?php
							}
						?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
			<div class="card">
				<div class="card-header">Recent Activity</div>
				<div class="customScroll">
					<div class="card-body">
						<ul class="project-activity">
						<?php
							foreach(activities::list(["order" => "a_id DESC", "limit" => 30]) as $a){
						?>
							<li class="activity-list">
								<div class="detail-info">
									<span class="lbl"></span>
									<p class="desc-info">
										<span>
										<?php
											$u = users::getBy(["user_id" => $a->a_user]);
											if(count($u)){
												echo $u[0]->user_name;
											}else{
												echo "Unknow User";
											}
										?>
										</span> 
										<?= $a->a_description ?>
									</p>
									<i class="icon-done_all"></i><?= $a->a_date . " " . date("H:i:s\ ", $a->a_time) ?>
								</div>
							</li>
						<?php
							}
						?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function printDiv(divName) {
	     var printContents = document.getElementById(divName).innerHTML;
	     var originalContents = document.body.innerHTML;
	
	     document.body.innerHTML = printContents;
	
	     window.print();
	
	     document.body.innerHTML = originalContents;
	}
</script>












