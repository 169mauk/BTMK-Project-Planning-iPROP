<div class="row gutters">
	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
		<div class="card">
			<div class="card-header">Source of Budget</div>
			<div class="card-body">
				<div id="sob_donut_chart" class="chart-height"></div>
			</div>
			<?php
				$sob = json_encode(sob::list());
			?>
			<script type="text/javascript">

					let sob = <?php echo $sob ?>;
					let budget = [];
					for(let index = 0; index < sob.length; index++){
						budget[index] = [sob[index].s_name, sob[index].s_amount];
					}
			</script>
		</div>
	</div>
	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
		<div class="card">
			<div class="card-header">Task Category</div>
			<div class="card-body">
				<div id="task_pi_chart" class="chart-height"></div>
			</div>
		</div>

		<?php
			$task_category = json_encode(task_category::list());
			$tasks = json_encode(tasks::list());
		?>

		<script type="text/javascript">

			let task_category = <?php echo $task_category ?>;
			let tasks = <?php echo $tasks ?>;
			let category = [];

			for(let index = 0; index < task_category.length; index++){
				category[index] = [task_category[index].t_title, 0];
			}

			for(let index = 0; index < tasks.length; index++){
				for(let category_index = 0; category_index < task_category.length; category_index++){
					if(category_index == tasks[index].t_category){
						category[category_index][1]++;
					}
				}
			}

			console.log(category);
		</script>

		<script type="text/javascript">
			window.onload = function(){
				var chart10 = c3.generate({
					bindto: '#sob_donut_chart',
					data: {
						columns: budget,
						type : 'donut',
						onclick: function (d, i) { console.log("onclick", d, i); },
						onmouseover: function (d, i) { console.log("onmouseover", d, i); },
						onmouseout: function (d, i) { console.log("onmouseout", d, i); }
					},
					donut: {
						title: "SOB"
					},
				});

				var chart12 = c3.generate({
					bindto: '#task_pi_chart',
					data: {
						// iris data from R
						columns: category,
						type : 'pie',
						onclick: function (d, i) { console.log("onclick", d, i); },
						onmouseover: function (d, i) { console.log("onmouseover", d, i); },
						onmouseout: function (d, i) { console.log("onmouseout", d, i); }
					},
				});

				var chart7 = c3.generate({
					bindto: '#bar_paid_unpaid',
					padding: {
						top: 0,
						left: 30,
					},		
					data: {
						columns: [
							['data1', 30, 90, 200, 400, 590, 250, 330, 120],
							['data2', 130, 100, 200, 200, 450, 150, 190, 220],
							// ['data3', 230, 200, 200, 300, 250, 250, 320, 180, 410, 270, 180, 210, 270, 420, 330, 180, 410, 270, 180, 110]
						],
						type: 'bar',
						names: {
							data1: 'Amount Paid',
							data2: 'Amount Unpaid',
							// data3: 'Facebook',
						},
						groups: [
							['data1', 'data2']
						]
					},
					grid: {
						x: {
							show: true,
						},
						y: {
							show: true
						}
					}
				});

				var chart6 = c3.generate({
					bindto: '#bar_cost_claim',
					padding: {
						top: 0,
						left: 30,
						right: 20,
					},		
					data: {
						columns: [
							['data1', 15, 58, 62, 87, 32, 58, 55, 21, 20, 30, 98, 10, 22, 98, 99, 105, 82, 57, 121, 78],
							['data2', 21, 26, 30, 38, 11, 24, 36, 53, 58, 62, 65, 61, 64, 32, 45, 71, 38, 23, 65, 11],
						],
						type: 'bar',
						names: {
							data1: 'Project Cost',
							data2: 'Amount Claimed'
						},
					},
					grid: {
						x: {
							show: true,
						},
						y: {
							show: true
						}
					}
				});
			}	
		</script>
	</div>
</div>

<!-- Row start -->
<div class="row gutters">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
		<div class="card">
			<div class="card-header">Financial Allocation</div>
			<div class="card-body">
				<div class="row">
					<div id="bar_cost_claim" class="chart-height"></div>
				</div>

				<div class="row">
					<div id="bar_paid_unpaid" class="chart-height"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Row end -->
<!-- Row start -->
<div class="row gutters">
	<div class="col-lg-6 col-md-6 col-sm-12">
		<div class="card">
			<div class="card-header">Sources</div>
			<div class="card-body">
				<div id="splineGraph" class="chart-height"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12">
		<div class="card">
			<div class="card-header">Financial</div>
			<div class="card-body">
				<div id="barAreaGraph" class="chart-height"></div>
			</div>
		</div>
	</div>
</div>
<!-- Row end -->