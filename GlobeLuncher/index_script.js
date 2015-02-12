var iddiapo = 0;
var charge = 0;

$(document).ready(function(){
	$('.slider_icon').mouseenter(function(){
		$(this).children().fadeIn();
	});
	$('.slider_icon').mouseleave(function(){
		$(this).children().fadeOut();
	});

	$('#contain_picto_market').mouseenter(function(){
		$('#text_market').css('width','200');
	});
	$('#contain_picto_market').mouseleave(function(){
		$('#text_market').css('width','0');
	});
	$('#text_market').mouseenter(function(){
		$('#text_market').css('width','200');
	});
	$('#text_market').mouseleave(function(){
		$('#text_market').css('width','0');
	});

	// Diapo
	$('#slider img').css('display','none');
	$('#slider img:eq(0)').css('display','block');

	function preload(){
		for (var i = 1; i <= 7; i++) {
			var img = new Image();
			img.src = 'datas/img/slider/0'+i+'.jpg';
			img.onload = function(){
				addLoad();
			}
		}
	}

	function addLoad(){
		charge ++;
		if (charge == 7){
			changeDiap(0);
		}
	}

	preload();
});

function changeDiap(){
	$('#slider img:eq('+iddiapo+')').fadeOut(2000);
	if(iddiapo == 6){
		iddiapo = 0;
	} else {
		iddiapo ++;
	}
	$('#slider img:eq('+iddiapo+')').fadeIn(2000);
	var timeout = setTimeout('changeDiap('+iddiapo+')',4000);
}