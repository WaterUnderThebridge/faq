<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/15 0015
 * Time: 12:34
 */
function msg($title){
    echo "<script>alert('$title');history.back();</script>";
}

function isLogin(){
	if(empty($_SESSION['usr']) && empty($_SESSION['id'])){
		header('location:login.html');
		exit();
	}
}

foreach ($_GET as $get_key=>$get_var)
{
	if (is_numeric($get_var)) {
		$get[($get_key)] = get_int($get_var);
	} else {
		$get[($get_key)] = get_str($get_var);
	}
}
/* 过滤所有POST过来的变量 */
foreach ($_POST as $post_key=>$post_var)
{
	if (is_numeric($post_var)) {
		$post[($post_key)] = get_int($post_var);
	} else {
		$post[($post_key)] = get_str($post_var);
	}
}
/* 过滤函数 */
//整型过滤函数
function get_int($number)
{
	return intval($number);
}
//字符串型过滤函数
function get_str($string)
{
	if (!get_magic_quotes_gpc()) {
		return addslashes($string);
	}
	return $string;
}

/**
 * @desc 提交信息
 */
function down()
{
		isLogin();
		
		$db = new mysql();
		$db->query("select * from app_wxuser2 where img != '' order by tick desc");
		

		$i = 0;
		while($row =  $db->fetch_assoc()){ 
			$i++;
			$rs[$i]['id'] = $row['id'];
			$rs[$i]['ip'] = $row['ip'];
			$rs[$i]['nickname'] = $row['nickname'];
			$rs[$i]['city'] = $row['city'];


			$rs[$i]['sex'] = $row['sex'];

			$rs[$i]['birth'] = $row['birth'];
			$rs[$i]['tel'] = $row['tel'];
			$rs[$i]['tick'] = $row['tick'];
			$rs[$i]['say'] = $row['say'];
			$rs[$i]['up_time'] = $row['up_time'];
			
		}

		$kn = array(
			'id' => 'ID',
			'ip' => '客户端IP地址',
			'nickname' => '昵称',
			'city' => '城市',
			'sex'=>'性别',
			'birth' => '出生月日',
			'tel' => '联系方式',
			'tick' => '票数',
			'say' => '宣言',
			'up_time' => '提交时间'
		);
		_down_xls($rs, $kn);
}

function _down_xls($data, $keynames, $name='dataxls') {
	$xls = array();
	$xls[] = "<html><meta http-equiv=content-type content=\"text/html; charset=UTF-8\"><body><table width='100%'  border='1'>";
	$xls[] = "<tr style='text-align:center;'><td >" . implode("</td><td >", array_values($keynames)) . '</td></tr>';
	foreach($data As $o) {
		$line = array();

		foreach($keynames AS $k=>$v) {

			$line[] = $o[$k];
		}
		$xls[] = "<tr style='text-align:center;'> <td>". implode("</td><td>", $line) . '</td></tr>';
	}
	$xls[] = '</table></body></html>';
	$xls = join("\r\n", $xls);
	header('Content-Disposition: attachment; filename="'.$name.'.xls"');
	die(mb_convert_encoding($xls,'UTF-8','UTF-8'));
}