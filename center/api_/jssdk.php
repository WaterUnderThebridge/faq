<?php
include 'WechatJssdk.class.php';

$appid = 'wx5730acbd9e2bc03f';
$secret = 'e035c16c07b3a05f55653bf741f96e8f';



$url = isset($_POST['url']) ? $_POST['url'] : '';

$jssdk = new WechatJssdk($appid,$secret,$url);
$sign = $jssdk->GetSignPackage();

$data['appid'] = $sign['appId'];
$data['noncestr'] = $sign['nonceStr'];
$data['signature'] = $sign['signature'];
$data['timestamp'] = $sign['timestamp'];
$data['url'] = $sign['url'];

echo json_encode($data);