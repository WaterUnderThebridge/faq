/**
 * Created by mac on 16/3/1.
 */
var openid=$.cookie('openid');
var names =$.cookie('nickname');
var mySwiper=new Swiper('.swiper-container', {
    paginationClickable: true,
	noSwiping : true,
    direction: 'vertical',
    onSlideChangeEnd:function (swiper){
        console.log(swiper.activeIndex);
        switch(swiper.activeIndex){
            case 0:


                break;
            case 1:
				mySwiper.lockSwipeToPrev();
				mySwiper.lockSwipeToNext();
                break;
            case 2:
				mySwiper.lockSwipeToPrev();
				mySwiper.lockSwipeToNext();
                break;
            case 3:
				mySwiper.lockSwipeToPrev();
				mySwiper.lockSwipeToNext();
                break;
            case 4:
				mySwiper.lockSwipeToPrev();
				mySwiper.lockSwipeToNext();
                break;
			case 5:
				mySwiper.lockSwipeToPrev();
				mySwiper.lockSwipeToNext();
				$(".p6-t").addClass('f4');
				$(".p6-t2").addClass('f5');
				$("#page-from-6box").show();
				$(".p5-animate1").animate({opacity:1},1000,function (){
					$(".p5-animate2").animate({opacity:1},600,function (){
						$(".p5-animate3").animate({opacity:1},600,function (){
							$(".p5-animate4").animate({opacity:1},600,function (){
								$(".p5-animate5").animate({opacity:1},600,function (){
									$(".p5-animate6").animate({opacity:1},600,function (){
										$(".p5-animate7").animate({opacity:1},600,function (){
											setTimeout(function(){
												slideTo();
											},600)
										});
									});
								});
							});
						});
					});
				});

				var a1=$("input[name='radio1']:checked").val();
				if(!a1)a1=$("input[name='radio1']").val();

				var a2=$("input[name='radio2']:checked").val();
				if(!a2)a2=$("input[name='radio2']").val();

				var a3=$("input[name='radio3']:checked").val();
				if(!a3)a3=$("input[name='radio3']").val();

				var a4=$("input[name='radio4']:checked").val();
				if(!a4)a4=$("input[name='radio4']").val();

				console.log(a1+"-"+a2+"-"+a3+"-"+a4);
				$.ajax({
					type: "post",
					url: "do.php?do=ok",
					dataType: 'json',
					data: {
						openid: openid,
						names:names,
						a1:a1,
						a2:a2,
						a3:a3,
						a4:a4
					},
					success: function (data) {
						console.log(data);
						//alert(data.code);
					},
					error: function (xhr, ajaxOptions, thrownError) {
						alert("错误");
						console.log("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:" + thrownError + "\n" + xhr.responseText);
					}
				});

                break;
			case 6:
				mySwiper.lockSwipeToPrev();
				$(".answer-3-img-3").addClass("an3");
				$(".an3").one('webkitAnimationEnd', function () {
					$(".answer-3-img-3").removeClass("an3").hide().addClass("an3").show();
				});
				$(".answer-t1").addClass("scale1");

				break;
			case 7:
				mySwiper.unlockSwipeToPrev();
				$(".answer-t2").addClass("scale1");
				break;
			case 8:
				$(".answer-t3").addClass("scale1");
				$(".share-box").hide();
				break;
			case 9:
				$(".answer-t4").addClass("scale1");
				setTimeout(function(){
					$(".share-box").fadeIn();
				},5000);
				break;
        }
    }
});
function slideTo(){
	//mySwiper.unlockSwipeToNext();
	mySwiper.slideTo(6, 500, true);
	$(".answer-t1").addClass("scale1");
}
$(".share-box").click(function(){
	$(this).fadeOut();
});
$(".problem-box label").click(function(){
	$(this).addClass("active").siblings("").removeClass("active");
});
function GetRandomNum(Min,Max)
{
	var Range = Max - Min;
	var Rand = Math.random();
	return(Min + Math.round(Rand * Range));
}
/*var num=GetRandomNum(1,100);
if(num<40){
	$(".answer4").show();
}else if(num<65){
	$(".answer1").show();
}else if(num<90){
	$(".answer2").show();
}else{
	$(".answer3").show();
}*/


$("input[name='radio1'] ,input[name='radio2'],input[name='radio3'],input[name='radio4']").click(function(){
	mySwiper.unlockSwipeToNext();
	var num=$(this).parent().parent().data("num");
	$(".circular"+num).fadeIn();
});

var musicpay = true;
$(".open").click(function (){
	if(musicpay){
		instance.stop();
		musicpay = false;
		$(this).removeClass("music-move");
		$(this).attr({src:'./images/close.png'});
	}else {
		instance.play();
		musicpay = true;
		$(this).addClass("music-move");
		$(this).attr({src:'./images/open.png'});
	}
	//var music = document.getElementById("music_bg");
	//if (music.paused) {
	//    music.play();
	//   // $('.music').addClass("music-move");
	//    $('.music').attr({'src':"./images/music_on.png"});
	//} else {
	//    music.pause();
	//   // $('.music').removeClass("music-move");
	//    $('.music').attr({'src':"./images/music_off.png"});
	//}
});

