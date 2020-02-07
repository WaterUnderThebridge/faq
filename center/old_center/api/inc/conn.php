<?php
include "config.php";

$link=mysql_connect($mysql_ip,$mysql_user,$mysql_pass);
if(!$link)die(mysql_error());
mysql_select_db($mysql_database);
mysql_query("set names utf8");


function execute($sql,$num=0){
	$result_execute=mysql_query($sql);
	// if(mysql_errno()>0) logdebug($sql ."\r\n". mysql_error());
	$row_execute=mysql_fetch_row($result_execute);
	if(count($row_execute)>1){
		$arr_execute=array();
		for($i_execute=0;$i_execute<count($row_execute);$i_execute++){
			$arr_execute[$i_execute]=$row_execute[$i_execute];
		}
		return $arr_execute;
	}else return $row_execute[0];
}