new Chartist.Pie('.donut-chart3', {
  series: [159, 476, 339]
}, {
	donut: true,
	donutWidth: 5,
	donutSolid: true,
	startAngle: 270,
	showLabel: false,
	height: "150px",
	plugins: [
		Chartist.plugins.tooltip()
	],
	low: 0
});