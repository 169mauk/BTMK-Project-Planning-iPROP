$( document ).ready(function() {
	$("#likes").circliful({
		animation: 1,
		animationStep: 5,
		foregroundBorderWidth: 15,
		backgroundBorderWidth: 7,
		percent: 78,
		fontColor: '#000000',
		foregroundColor: '#0063bf',
		backgroundColor: '#f5f6fa',
		multiPercentage: 1,
		percentages: [10, 20, 30],
	});
	$("#shares").circliful({
		animation: 1,
		animationStep: 5,
		foregroundBorderWidth: 15,
		backgroundBorderWidth: 7,
		percent: 65,
		fontColor: '#000000',
		foregroundColor: '#ffc139',
		backgroundColor: '#f5f6fa',
		multiPercentage: 1,
		percentages: [10, 20, 30],
	});
	$("#comments").circliful({
		animation: 1,
		animationStep: 5,
		foregroundBorderWidth: 15,
		backgroundBorderWidth: 7,
		percent: 85,
		fontColor: '#000000',
		foregroundColor: '#ff3e61',
		backgroundColor: '#f5f6fa',
		multiPercentage: 1,
		percentages: [10, 20, 30],
	});


// With Icons
	$("#on-trials").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 35,
		fontColor: '#000000',
		foregroundColor: '#00ffff',
		backgroundColor: 'rgba(255, 255, 255, 0.05)',
		icon: '\ea48',
		iconColor: '#00ffff',
		iconPosition: 'middle',
		text: 'Trails',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});

	$("#base-plan").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 50,
		fontColor: '#000000',
		foregroundColor: '#d8ff79',
		backgroundColor: 'rgba(255, 255, 255, 0.05)',
		icon: '\e87e',
		iconColor: '#d8ff79',
		iconPosition: 'middle',
		text: 'Base',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});

	$("#premium-plan").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 65,
		fontColor: '#000000',
		foregroundColor: '#adff2f',
		backgroundColor: 'rgba(255, 255, 255, 0.05)',
		icon: '\e86b',
		iconColor: '#adff2f',
		iconPosition: 'middle',
		text: 'Premium',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});	
	
	$("#platinum-plan").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 75,
		fontColor: '#000000',
		foregroundColor: '#ffef33',
		backgroundColor: 'rgba(255, 255, 255, 0.05)',
		icon: '\e068',
		iconColor: '#ffef33',
		iconPosition: 'middle',
		text: 'Platinum',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,
	});
});

