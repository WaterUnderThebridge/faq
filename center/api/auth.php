<?php

include 'inc/wechatauth.php';


header("Content-type: text/html; charset=utf-8");

$appid = 'wx3c1004175bd0a49f';
$secret = '13a62f8258eace6b6291cb9de19c9126';


$redirect = isset($_GET['redirect']) ? htmlspecialchars_decode($_GET['redirect']) : '';
if(!$redirect) die('获取redirect失败');
if(strpos($redirect,'?') == 0) $redirect .= '?ok=1';

$code = isset($_GET['code']) ? $_GET['code'] : '';



if($code){
    $wechat = new WechatAuth($appid,$secret);
    $access = $wechat->getAccessToken('code',$code);  
    $result = $wechat->getUserInfo($access);



    if($result['openid']){

        setcookie('openid',$result['openid'],time()+3600*24,'/');
        setcookie('nickname',$result['nickname'],time()+3600*24,'/');
        setcookie('headimgurl',$result['headimgurl'],time()+3600*24,'/');


        header('Location: '.$redirect); exit;
    }else{
    	die('获取用户信息失败');
    }
}else{
    if(is_weixin()){
        $wechat = new WechatAuth($appid,$secret);
        $url = 'http://h5.m2015.cn/center/api/auth.php?redirect='.urlencode($redirect);
        $apiUrl = $wechat->getRequestCodeURL($url);
        header('Location: '.$apiUrl); exit;
    }else{
         die('请在微信客户端内访问');
//        setcookie('openid','nouser',time()+3600*24,'/');
//        setcookie('nickname','测试用户',time()+3600*24,'/');
//        setcookie('headimgurl','http://wx.qlogo.cn/mmopen/dibCvqHg4WnflNpEZOY5HS6n5V0Z0Upf3kc4fgvTwpDtuM7TA0MjorbQiagL1qJvgqibFltzp0OpLfds52qriaiaKfA/0',time()+3600*24,'/');
//        header('Location: '.$redirect); exit;
    }
}

function is_weixin(){
    if (strpos($_SERVER['HTTP_HOST'],'192.168') !== false) return false;
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false){
        return true;
    }   
    return false;
}