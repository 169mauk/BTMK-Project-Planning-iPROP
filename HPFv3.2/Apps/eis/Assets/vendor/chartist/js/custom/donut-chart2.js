new Chartist.Pie('.donut-chart2', {
  series: [655, 120, 445]
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