/**
 * Created by mac on 16/3/1.
 */

var cookieOpenid =$.cookie('openid');
var cookieNickname=$.cookie('nickname');
var voteType=false;
var shareUrl=window.shareData.link;;
var swiperV = new Swiper('.swiper-container-v', {
	paginationClickable: true,
	noSwiping : true,
	direction: 'vertical',
	onSlideChangeEnd:function (swiper){
		switch(swiper.activeIndex) {
			case 0:


				break;
			case 1:

				break;
			case 2:

				break;
			case 3:

				break;
		}
	}
});
var swiperH = new Swiper('.swiper-container-h', {
	paginationClickable: true,
	nextButton: '.swiper-button-next2',
	prevButton: '.swiper-button-prev2'
});
var swiperH2 = new Swiper('.swiper-container-h2', {
	paginationClickable: true,
	nextButton: '.swiper-button-next3',
	prevButton: '.swiper-button-prev3'
});
$(".share-box").click(function(){
	$(this).fadeOut();
});
function getUrlParam(name){
	//构造一个含有目标参数的正则表达式对象
	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
	//匹配目标参数
	var r = window.location.search.substr(1).match(reg);
	//返回参数值
	if (r!=null) return unescape(r[2]);
	return null;
}
function GetRandomNum(Min,Max)
{
	var Range = Max - Min;
	var Rand = Math.random();
	return(Min + Math.round(Rand * Range));
}
function page1(ticket,divClass ){
	var page_num=0;//轮翻页
	var page=10;
	$.ajax({
		type: "post",
		url: "do.php?index="+ticket,
		dataType: 'json',
		data: {
		},
		success: function (data) {
			console.log(data);
			for(var i=0;i<data.length;i++){
				var list;
				if(page_num==i){
					var slide=$("<div>").addClass("swiper-slide");
					switch (divClass){
						case "h":
							swiperH.appendSlide(slide);
							break;
						case  "h2":
							swiperH2.appendSlide(slide);
							break;
					}

					if(i==0){
						list=$("<ul>").addClass("line-box").appendTo(slide);
					}else{
						list=$("<ul>").addClass("line-box2").appendTo(slide);
					}
					page_num += page;
					page =12;
				}
				var lis=$("<li>").data("id",data[i][6]).data("ticket",ticket).appendTo(list);
				if(i<3){
					$("<img>").attr("src","./ht/upload/"+data[i][2]).addClass("widht92").appendTo(lis);

				}else{
					$("<img>").attr("src","./ht/upload/"+data[i][2]).addClass("widht64").appendTo(lis);

				}
				var name_box=$("<div>").addClass("name-box").appendTo(lis);
				if(i<10){
					if(i>2 && i<9){
						$("<img>").addClass("num").attr("src","images/num"+(i+1)+".png").appendTo(name_box);
					}else{
						$("<img>").addClass("num1").attr("src","images/num"+(i+1)+".png").appendTo(name_box);
					}
				}else {
					var num1=$("<div>").addClass("num1").appendTo(name_box);
					var ii=i+1;
					for(var j=1;j<=ii.toString().length;j++){
						var jj=ii.toString().substring(j-1,j);
						//console.log("images/"+jj+".png"+"////");
						$("<img>").attr("src","images/"+jj+".png").appendTo(num1);
					}
				}

				if(i==0){
					$("<img>").attr("src","images/one.png").appendTo(name_box);
				}
				if(i==1){
					$("<img>").attr("src","images/two.png").appendTo(name_box);
				}
				if(i==2){
					$("<img>").attr("src","images/three.png").appendTo(name_box);
				}
				if(i>2){
					$("<img>").attr("src","images/red.png").appendTo(name_box);
				}
				if(i<3){
					$("<p>").html(data[i][3]+" 票").addClass("big-text").appendTo(name_box);
				}else{
					$("<p>").html(data[i][3]+" 票").appendTo(name_box);
				}

				$("<h1>").html(data[i][0]).appendTo(lis);
				//$("<p>").html(data[i][3]+" 票").appendTo(lis);

			}
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert("错误");
			console.log("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:" + thrownError + "\n" + xhr.responseText);
		}
	});
}
function tswkData(){
	$.ajax({
		type: "post",
		url: "do.php?tswk=ok",
		dataType: 'json',
		data: {
		},
		success: function (data) {
			//console.log(data);
			for(var i=0;i<data.length;i++){
				var tswk=$("<div>").addClass("tswk").data("id",data[i][1]).data("ticket",data[i][9]).appendTo(".tswk-box");
				if(data[i][9]==1){
					$("<img>").attr("src","./ht/upload/"+data[i][5]).appendTo(tswk);
					$("<h1>").html(data[i][3]).appendTo(tswk);
					$("<p>").html(data[i][2]).appendTo(tswk);
					$("<span>").html(data[i][7]+" 票").appendTo(tswk);
				}else if(data[i][9]==2){
					$("<img>").attr("src","./ht/upload/"+data[i][6]).appendTo(tswk);
					$("<h1>").html(data[i][4]).appendTo(tswk);
					$("<p>").html(data[i][2]).appendTo(tswk);
					$("<span>").html(data[i][8]+" 票").appendTo(tswk);
				}

			}
			$("#PageLoading").hide();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert("错误");
			console.log("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:" + thrownError + "\n" + xhr.responseText);
		}
	});
}
if(getUrlParam("id")){
	if(getUrlParam("ticket")){
		typeData(getUrlParam("id"),getUrlParam("ticket"));
	}else{
		centerData(getUrlParam("id"));
	}
}
page1(1,"h");
page1(2,"h2");
tswkData();


$.ajax({
	type: "post",
	url: "do.php?lists=ok",
	dataType: 'json',
	data: {
	},
	success: function (data) {
		//console.log(data);
		for(var i=0;i<data.length;i++){
			$("<li>").html(data[i][1]).data("id",data[i][0]).appendTo(".btn-list");
		}
	},
	error: function (xhr, ajaxOptions, thrownError) {
		alert("错误");
		console.log("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:" + thrownError + "\n" + xhr.responseText);
	}
});
$.ajax({
	type: "post",
	url: "do.php?winning=ok",
	dataType: 'json',
	data: {
	},
	success: function (data) {
		//console.log(data);
		for(var i=0;i<data.length;i++){
			//var tel=data[i][1].substring(0,3)+"****"+data[i][1].substring(7,11);

			$("<li>").html("微信昵称： "+data[i][0]).appendTo(".win-list-box #demo1 ul");
		}

		if(data.length==0){

			$("<li>").html("暂没中奖！").appendTo(".win-list-box #demo1 ul");
		}
/*滚动

		$("#demo2").html($("#demo1").html());
		function Marquee(){
			if($("#demo1").height()-$("#demo").scrollTop()<=0){
				$("#demo").scrollTop(0);
			}
			else{
				$("#demo").scrollTop($("#demo").scrollTop()+1);
			}

		}
		var MyMar=setInterval(Marquee,50)
*/

	},
	error: function (xhr, ajaxOptions, thrownError) {
		alert("错误");
		console.log("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:" + thrownError + "\n" + xhr.responseText);
	}
});

/*var musicpay = true;
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
});*/

function typeData(id,ticket){
	$(".go-center").data("id",id);
	window.shareData.link=window.shareData.link+"?id="+id+"&ticket="+ticket;
	$.ajax({
		type: "post",
		url: "do.php?id="+id,
		dataType: 'json',
		data: {
		},
		success: function (data) {
			$(".vote-btn3").data("id",data.id).data("ticket",ticket);
			if(ticket==1){
				$(".center-title").attr("src","images/index-t.png");
				$(".text-box2 h2").html(data.center_name);
				$(".text-box2 h1").html(data.names1);
				$(".head").attr("src","./ht/upload/"+data.head_img1);
				$(".text-box2 p span").html(data.ticket_1);
				$(".video-box2").html("<iframe class='video_iframe' style='z-index:1;' src='http://v.qq.com/iframe/player.html?vid="+data.url_1+"&amp;width=512&amp;height=347&amp;auto=0' allowfullscreen='' frameborder='0' height='347' width='512'></iframe>");

				/*videojs("example_video_3").ready(function(){
					var myPlayer = this;
					myPlayer.src(data.url_1);
				});*/
			}else{
				$(".center-title").attr("src","images/p2-t.png");
				$(".text-box2 h2").html(data.center_name);
				$(".text-box2 h1").html(data.names2);
				$(".head").attr("src","./ht/upload/"+data.head_img2);
				$(".text-box2 p span").html(data.ticket_2);
				$(".video-box2").html("<iframe class='video_iframe' style='z-index:1;' src='http://v.qq.com/iframe/player.html?vid="+data.url_2+"&amp;width=512&amp;height=347&amp;auto=0' allowfullscreen='' frameborder='0' height='347' width='512'></iframe>");
				/*videojs("example_video_3").ready(function(){
					var myPlayer = this;
					myPlayer.src(data.url_2);
				});*/
			}

			$(".type-box").show();
			$("#PageLoading").hide();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert("错误");
			console.log("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:" + thrownError + "\n" + xhr.responseText);
		}
	});
}

/*两个排行事件*/
$(document).on("click",".swiper-container-h .swiper-slide li ,.swiper-container-h2 .swiper-slide li",function(){
	var id=$(this).data("id");
	var ticket=$(this).data("ticket");
	typeData(id,ticket);
});
var commentCenterId;
function centerData(id){
	$(".frame").show();
	$(".vote-box div").show();
	$(".p4-box").show();
	window.shareData.link=window.shareData.link+"?id="+id;
	$.ajax({
		type: "post",
		url: "do.php?id="+id,
		dataType: 'json',
		data: {
		},
		success: function (data) {
			console.log(data);
			//alert(data.nickname);
			$(".vote-btn1 ,.vote-btn2").data("id",data.id);
			$(".p4-box").find("p").html(data.center_name+"老师");
			$(".center-name").html(data.center_name);
			$(".p4-box").eq(0).find("h1").html(data.tutor_name1);
			$(".p4-box").eq(0).find("img").attr("src","./ht/upload/"+data.tutor_img1);

			$(".p4-box").eq(1).find("h1").html(data.tutor_name2);
			$(".p4-box").eq(1).find("img").attr("src","./ht/upload/"+data.tutor_img2);
			$(".ticket1 span").html(data.ticket_1);
			$(".ticket2 span").html(data.ticket_2);
			commentCenterId = data.id;
			$(".frame").eq(0).html("<iframe id='video_iframe2' class='video_iframe' style='z-index:1;' src='http://v.qq.com/iframe/player.html?vid="+data.url_1+"&amp;width=268&amp;height=182&amp;auto=0' allowfullscreen='' frameborder='0' height='182' width='268'></iframe>");
			$(".frame").eq(1).html("<iframe id='video_iframe3' class='video_iframe' style='z-index:1;' src='http://v.qq.com/iframe/player.html?vid="+data.url_2+"&amp;width=268&amp;height=182&amp;auto=0' allowfullscreen='' frameborder='0' height='182' width='268'></iframe>");
			/*videojs("example_video_1").ready(function(){
				var myPlayer = this;
				myPlayer.src(data.url_1);
			});
			videojs("example_video_2").ready(function(){
				var myPlayer = this;
				myPlayer.src(data.url_2);
			});*/
			if(data.url_1==""){
				$(".frame").eq(0).hide();
				$(".vote-box div").eq(0).hide();
				$(".p4-box").eq(0).hide();

			}
			if(data.url_2==""){
				$(".frame").eq(1).hide();
				$(".vote-box div").eq(1).hide();
				$(".p4-box").eq(1).hide();

			}
			$(".p4").show();
			$(".type-box").hide();
			$("#PageLoading").hide();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert("错误");
			console.log("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:" + thrownError + "\n" + xhr.responseText);
		}
	});
}
$(document).on("click",".btn-list li",function(){
	var id=$(this).data("id");
	centerData(id);
});
$(document).on("click",".tswk-box .tswk",function(){
	typeData($(this).data("id"),$(this).data("ticket"));
});
$(".return-btn").click(function(){
	$(".frame").html("");
	$(".p4").hide();
/*	videojs("example_video_1").ready(function(){
		var myPlayer = this;
		myPlayer.pause();
	});
	videojs("example_video_2").ready(function(){
		var myPlayer = this;
		myPlayer.pause();
	});*/
	if(voteType){
		swiperH.removeAllSlides();
		page1(1,"h");
		swiperH2.removeAllSlides();
		page1(2,"h2");
		$(".tswk-box .tswk").remove();
		tswkData();
	}
	voteType=false;
	window.shareData.link=shareUrl;
});
$(".tswk-btn").click(function(){
	swiperV.slideTo(1, 1000, true);
});
$(".rule-btn").click(function(){
	$(".rule-box").show();
});
$(".rule-box").click(function(){
	$(".rule-box").fadeOut();
});
$(".index-btn").click(function(){
	$(".winning-box").fadeIn();
});
$(".win-return").click(function(){
	$(".winning-box").fadeOut();
});
$(".vote-btn1").click(function(){
	votes($(this).data("id"),1);
});
$(".vote-btn2").click(function() {
	votes($(this).data("id"),2);
});
$(".vote-btn3").click(function() {
	votes($(this).data("id"),$(this).data("ticket"));
});
$(".p3-return").click(function() {
	swiperV.slideTo(1, 1000, true);
});
$(".rule-retrun").click(function() {
	$(".rule-box").hide();
});
$(".go-center").click(function() {
	window.shareData.link=shareUrl;
	var id=$(this).data("id");
	centerData(id);
	$(".video-box2").html("");
});
$(".type-return").click(function() {
	$(".video-box2").html("");
	window.shareData.link=shareUrl;
	if(voteType){
		swiperH.removeAllSlides();
		page1(1,"h");
		swiperH2.removeAllSlides();
		page1(2,"h2");
		$(".tswk-box .tswk").remove();
		tswkData();
	}
	voteType=false;

	/*videojs("example_video_3").ready(function(){
		var myPlayer = this;
		myPlayer.pause();
	});*/
	$(".type-box").fadeOut();
});
var url_1,url_2;
$(".comment-btn").click(function() {
	url_1=$(".frame").eq(0).html();
	url_2=$(".frame").eq(0).html();
	$(".frame").html("");
	$(".content-box p").remove();
	$.ajax({
		type: "post",
		url: "do.php?comment=ok",
		dataType: 'json',
		data: {
			center_id:commentCenterId
		},
		success: function (data) {
			if(data[0]){
				for(var i=0;data.length;i++){
					$("<p>").html(data[i][0]+":"+data[i][1]).appendTo(".content-box");
				}
			}else{
				$("<p>").html("还没有评论！").addClass("prompt").appendTo(".content-box");
			}

			console.log(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert("错误");
			console.log("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:" + thrownError + "\n" + xhr.responseText);
		}
	});
	$(".comment-box").fadeIn();

});
$(".comment-return").click(function() {
	$(".frame").eq(0).html(url_1);
	$(".frame").eq(1).html(url_2);
	$(".comment-box").fadeOut();
});
$(".arrow").click(function() {
	swiperV.slideNext();
});
/*评论*/
$(".comment-submit").click(function() {
	var comment=$("#comment").val();
	if(comment==""){
		alert("请输入评论内容！");
		return false;
	}
	$.ajax({
		type: "post",
		url: "do.php?addcomment=ok",
		dataType: 'json',
		data: {
			center_id:commentCenterId,
			name:cookieNickname,
			comment:comment
		},
		success: function (data) {
			if(data.code==0){
				alert("请过5分钟再评论！");
			}else{
				$("<p>").html(cookieNickname+":"+comment).prependTo(".content-box");
				$(".prompt").hide();

				$("#comment").val("");
			}

			console.log(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert("错误");
			console.log("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:" + thrownError + "\n" + xhr.responseText);
		}
	});
});
/*列表进去的投票*/
function votes(id,num){
	alert("投票结束！");
	var id=id;
/*	if(cookieNames==null){
		var name=$("#names").val();
		var tel=$("#tel").val();

	}else{
		var name=cookieNames;
		var tel=cookieTel;

	}*/
/*	if(name=="" || tel==""){
		$(".from-box").fadeIn();
	}else{*/
		/*$.ajax({
			type: "post",
			url: "do.php?vote=ok",
			dataType: 'json',
			data: {
				id:id,
				ticket:num,
				openid:cookieOpenid,
				nickname:cookieNickname
			},
			success: function (data) {

				if(parseInt(data.code)==1){
					var nums=parseInt($(".ticket"+num+" span").html());
					$(".ticket"+num+" span").html(nums+1);

					var nums1=parseInt($(".text-box2 p span").html());
					$(".text-box2 p span").html(nums1+1);

					voteType=true;
				}else{
					alert("每个人只能投10票，你已经投了10票！");
				}

				console.log(data);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert("错误");
				console.log("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:" + thrownError + "\n" + xhr.responseText);
			}
		});*/
	/*}*/
}
$(".submit-btn").click(function(){
	cookieNames=$("#names").val();
	cookieTel=$("#tel").val();
	if(cookieNames==""){
		alert("请填写姓名！");
		return false;
	}
	if(cookieTel==""){
		alert("请填写联系方式！");
		return false;
	}
	var telReg = !!cookieTel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
	if(telReg== false){
		alert("请输入正确的电话号码！");
		return false;
	}
	$(".from-box").hide();
});
$(".p4-box img").click(function(){
	$(".img-box").fadeIn();
	$(".img-box img").attr("src",$(this).attr("src"));
});
$(".img-box").click(function(){
	$(".img-box").fadeOut();
});