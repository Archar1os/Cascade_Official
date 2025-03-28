$(document).ready(function () {
	$(".coffee-image").hover(
		function () {
			$(this).addClass("hover");
			setTimeout(function () {
				$(this).removeClass("hover").addClass("hover-coffee");
			}, 500);
		},
		function () {
			$(this).removeClass("hover-coffee").addClass("hover-bread");
			setTimeout(function () {
				$(this).removeClass("hover-bread").removeClass("hover");
			}, 500);
		}
	);
});
