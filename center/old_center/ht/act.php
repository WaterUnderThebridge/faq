<?php
require_once ("inc.php");
header("Content-type: text/html; charset=utf-8");    

$db = new mysql();

$witch = $_POST['witch'];
if(isset($_GET['out'])){
	unset($_SESSION['usr']);
	unset($_SESSION['id']);
	
	header('location:./login.html');
}
if(isset($_GET['down'])){
	isLogin();
	
	down();
}else if($_GET['del']){
	isLogin();
	$db->query("delete from all_center where id = '".$_GET['del']."'");
	header('location:./admin.php?act=admin');
}else if($_GET['del_zj']){
	isLogin();
	$db->query("delete from winning where id = '".$_GET['del_zj']."'");
	header('location:./winning.php');
}


function fileext($file)
{
	return pathinfo($file, PATHINFO_EXTENSION);
}
function img2thumb($src_img, $dst_img, $width = 300, $height = 300, $cut = 0, $proportion = 0)
{
	if(!is_file($src_img))
	{
		return false;
	}
	$ot = fileext($dst_img);
	$otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
	$srcinfo = getimagesize($src_img);
	$src_w = $srcinfo[0];
	$src_h = $srcinfo[1];
	$type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
	$createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

	$dst_h = $height;
	$dst_w = $width;
	$x = $y = 0;

	/**
	 * 缩略图不超过源图尺寸（前提是宽或高只有一个）
	 */
	if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
	{
		$proportion = 1;
	}
	if($width> $src_w)
	{
		$dst_w = $width = $src_w;
	}
	if($height> $src_h)
	{
		$dst_h = $height = $src_h;
	}

	if(!$width && !$height && !$proportion)
	{
		return false;
	}
	if(!$proportion)
	{
		if($cut == 0)
		{
			if($dst_w && $dst_h)
			{
				if($dst_w/$src_w> $dst_h/$src_h)
				{
					$dst_w = $src_w * ($dst_h / $src_h);
					$x = 0 - ($dst_w - $width) / 2;
				}
				else
				{
					$dst_h = $src_h * ($dst_w / $src_w);
					$y = 0 - ($dst_h - $height) / 2;
				}
			}
			else if($dst_w xor $dst_h)
			{
				if($dst_w && !$dst_h)  //有宽无高
				{
					$propor = $dst_w / $src_w;
					$height = $dst_h  = $src_h * $propor;
				}
				else if(!$dst_w && $dst_h)  //有高无宽
				{
					$propor = $dst_h / $src_h;
					$width  = $dst_w = $src_w * $propor;
				}
			}
		}
		else
		{
			if(!$dst_h)  //裁剪时无高
			{
				$height = $dst_h = $dst_w;
			}
			if(!$dst_w)  //裁剪时无宽
			{
				$width = $dst_w = $dst_h;
			}
			$propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
			$dst_w = (int)round($src_w * $propor);
			$dst_h = (int)round($src_h * $propor);
			$x = ($width - $dst_w) / 2;
			$y = ($height - $dst_h) / 2;
		}
	}
	else
	{
		$proportion = min($proportion, 1);
		$height = $dst_h = $src_h * $proportion;
		$width  = $dst_w = $src_w * $proportion;
	}

	$src = $createfun($src_img);
	$dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
	$white = imagecolorallocate($dst, 255, 255, 255);
	imagefill($dst, 0, 0, $white);

	if(function_exists('imagecopyresampled'))
	{
		imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	}
	else
	{
		imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	}
	$otfunc($dst, $dst_img);
	imagedestroy($dst);
	imagedestroy($src);
	return true;
}
function uploadImg($fileName){
	$src_img = $_FILES[$fileName]['tmp_name'];
	$file_name=time().mt_rand(1,1000).".jpg";
	$dst_img =  dirname(__FILE__)."/upload/".$file_name;
	img2thumb($src_img, $dst_img);
	return $file_name;
}
switch($witch){
	case "login":
		$pwd = md5($_POST['pwd']);
		$username = $_POST['usrname'];
	
		if(!empty($pwd)|| !empty($username)){
			$db->query("select * from users where user_name = '".$username."' and user_pw= '".$pwd."'");
		
			if($db->db_num_rows() > 0){
				$g = $db->fetch_assoc();

				$_SESSION['usr'] = $g['user_name'];
				$_SESSION['id'] = $g['id'];
				$_SESSION['menu'] = "center";
				
				@header('Location:./admin.php?act=admin');
				exit();
			}

		}
		msg('用户名或密码错误，请重新登陆');
	
		break;
	case "modifypwd":
		isLogin();
		
		$oldpwd = md5(trim($_POST['oldpwd']));
		$newpwd = md5(trim($_POST['newpwd']));
		$newpassword = md5(trim($_POST['newpassword']));
		
		if($newpwd != $newpassword){
			msg('两次密码不一致，请重新输入');

			exit;
		}
		
		
		$db->query("select * from users where user_name = '".$_SESSION['usr']."' and user_pw = '$oldpwd'");
		if($db->db_num_rows() > 0){
			$db->query("update users set user_pw='$newpassword' where id='".$_SESSION['id']."'");
			unset($_SESSION['usr']);
			unset($_SESSION['id']);
			msg('修改成功,请重新登陆');
			exit;
			
		}else {
			msg('密码错误，请重新输入');
			exit();
		}
		
		break;

	case "centeradd":


		$center_name = $_POST["center_name"];
		$tutor_img1=uploadImg("tutor_img1");
		$tutor_name1 = $_POST["tutor_name1"];
		$resume = $_POST["resume"];
		$names1 = $_POST["names1"];
		$head_img1=uploadImg("head_img1");
		$url1 =  $_POST["url1"];

		$tutor_img2=uploadImg("tutor_img2");
		$tutor_name2 = $_POST["tutor_name2"];
		$names2 = $_POST["names2"];
		$head_img2=uploadImg("head_img2");
		$url2 =  $_POST["url2"];
		$t=time();
		$db->query("insert into all_center (center_name,tutor_img1,tutor_name1,names1,head_img1,url_1,tutor_img2,tutor_name2,names2,head_img2,url_2,add_time)
			values ('{$center_name}','{$tutor_img1}','$tutor_name1','{$names1}','{$head_img1}','{$url1}','{$tutor_img2}','{$tutor_name2}','{$names2}','{$head_img2}','{$url2}','{$t}')");
		if($db->db_affected_rows()){
			msg('保存成功');
		}else {
			msg('更新失败');
		}
		header('location:./admin.php?act=admin');
		break;
	case "centerupdata":
		if($_FILES['tutor_img1']['name'] !=""){
			$tutor_img1=uploadImg("tutor_img1");
		}else{
			$tutor_img1= $_POST["img_name1"];
		}
		if($_FILES['head_img1']['name']!=""){
			$head_img1=uploadImg("head_img1");
		}else{
			$head_img1= $_POST["img_name2"];
		}
		if($_FILES['tutor_img2']['name']!=""){
			$tutor_img2=uploadImg("tutor_img2");
		}else{
			$tutor_img2= $_POST["img_name3"];
		}
		if($_FILES['head_img2']['name']!=""){
			$head_img2=uploadImg("head_img2");
		}else{
			$head_img2= $_POST["img_name4"];
		}
		$id = $_POST["id"];
		$center_name = $_POST["center_name"];
		$tutor_name1 = $_POST["tutor_name1"];
		$tutor_name2 = $_POST["tutor_name2"];
		$resume = $_POST["resume"];
		$names1 = $_POST["names1"];
		$url1 =  $_POST["url1"];
		$names2 = $_POST["names2"];
		$url2 =  $_POST["url2"];
		$t=time();
		//echo "update all_center set center_name='{$center_name}', tutor_name1='{$tutor_name1}', tutor_img1='{$tutor_img1}',names1='{$names1}',head_img1='{$head_img1}' , url_1='{$url1}',tutor_name2='{$tutor_name2}', tutor_img2='{$tutor_img2}',names2='{$names2}',head_img2='{$head_img2}' , url_2='{$url2}'  , add_time='{$t}' where id='{$id}'";
		//exit;

		$db->query("update all_center set center_name='{$center_name}', tutor_name1='{$tutor_name1}', tutor_img1='{$tutor_img1}',names1='{$names1}',head_img1='{$head_img1}' , url_1='{$url1}',tutor_name2='{$tutor_name2}', tutor_img2='{$tutor_img2}',names2='{$names2}',head_img2='{$head_img2}' , url_2='{$url2}'  , add_time='{$t}' where id='{$id}'");
		if($db->db_affected_rows()){
			msg('保存成功');
		}else {
			msg('更新失败');
		}
		header('location:./admin.php?act=admin');
		break;

	case "tswkupdata":
		$id=$_POST["id"];
		$center_id = $_POST["center_id"];
		$video = $_POST["video"];

		$db->query("update tswk set center_id='{$center_id}',video='{$video}' where id='{$id}'");
		if($db->db_affected_rows()){
			msg('保存成功');
		}else {
			msg('更新失败');
		}
		header('location:./tswk.php?act=admin');
		break;
	case "winning":
		$ticket_id = $_POST["ticket_id"];
		$openid = $_POST["openid"];
		$nickname = $_POST["nickname"];
		$t=time();
		$db->query("insert into winning (ticket_id,openid,nickname,add_time) values ('{$ticket_id}','{$openid}','{$nickname}','{$t}')");
		if($db->db_affected_rows()){
			msg('保存成功');
		}else {
			msg('更新失败');
		}
		header('location:./winning.php?act=admin');
		break;
}


