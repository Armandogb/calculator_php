$(document).ready(function(){

	var numbs = [];

	function changeText(){
		$(".digits").val(numbs.toString().replace(/,/g, ''));
	};

	$(".click").on("click",function(){
		var digit = $(this).attr('href');
		numbs.push(digit);
		changeText();
	});

	$(".submit").on("click",function(){
		$(".the_calc").submit();
	});

	$(".clear").on("click",function(){
		$(".digits").val('');
		numbs = [];
	});

	$(".delete").on("click",function(){
		numbs.splice(-1,1);
		changeText();
	});

});