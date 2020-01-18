new Chartist.Line('.multiline', {
  labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
  series: [
    [12, 9, 7, 8, 5],
    [2, 1, 3, 7, 3],
    [1, 3, 4, 5, 6]
  ]
}, {
	height: "150px",
  fullWidth: true,
	chartPadding: {
		right: 5,
		left: 5,
		top: 5,
		bottom: 0,
	},
	axisX: {
		offset: 0,
		showGrid: false,
		showLabel: false,
	}, 
	axisY: {
		offset: 0,
		showLabel: false,
		showGrid: false,
	},
	plugins: [
		Chartist.plugins.tooltip()
	],
});
