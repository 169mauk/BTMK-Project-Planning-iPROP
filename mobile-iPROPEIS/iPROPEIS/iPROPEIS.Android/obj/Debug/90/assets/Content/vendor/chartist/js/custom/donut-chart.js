new Chartist.Pie('.donut-chart', {
  series: [285, 476, 670]
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