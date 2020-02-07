<?php
include 'WechatJssdk.class.php';

$appid = 'wxc82d50af409223ad';
$secret = '022cfa916850fd2739e1854bbcac2436';



$url = isset($_POST['url']) ? $_POST['url'] : '';

$jssdk = new WechatJssdk($appid,$secret,$url);
$sign = $jssdk->GetSignPackage();

$data['appid'] = $sign['appId'];
$data['noncestr'] = $sign['nonceStr'];
$data['signature'] = $sign['signature'];
$data['timestamp'] = $sign['timestamp'];
$data['url'] = $sign['url'];

echo json_encode($data);