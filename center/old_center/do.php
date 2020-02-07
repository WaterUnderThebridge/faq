<?php
header('Access-Control-Allow-Origin: *');

include('./ht/inc.php');
$db=new mysql();
$openid = $_POST['openid'];
$name   = $_POST['names'];
$a1     = $_POST['a1'];
$a2     = $_POST['a2'];
$a3     = $_POST['a3'];
$a4     = $_POST['a4'];
$t      = time();
$do     = $_GET["do"];
if($do && $openid && $name && $a1 && $a2 && $a3 && $a4){

    $row=$db->selectRows("result_data","*","openid = '$openid'");
    if($row['id']){
        $db->query("update result_data set nickname='$name',one='$a1',two='$a2',three='$a3',four='$a4',add_time='$t' where id='{$row['id']}'");
        $arr['code'] = 1;
        echo json_encode($arr);
    }else{


        $db->query("insert into result_data(openid,nickname,one,two,three,four,add_time) values('$openid','$name','$a1','$a2','$a3','$a4','$t')");
        $arr['code'] = $db->insert_id();
        echo json_encode($arr);
    }

}
$index     = $_GET["index"];
if($index==1){
    $db->query("select * from all_center where url_1 !='' order by ticket_1 desc ");
    $arr=array();
    $i=0;
    while($row =  $db->fetch_assoc()){
        $arr[$i][0]=$row["center_name"];
        $arr[$i][1]=$row["names1"];
        $arr[$i][2]=$row["head_img1"];
        $arr[$i][3]=$row["ticket_1"];
        $arr[$i][4]=$row["url_1"];
        $arr[$i][5]=$row["url_2"];
        $arr[$i][6]=$row["id"];
        $i++;
    }
    echo json_encode($arr);
}else if($index==2){
    $db->query("select * from all_center where url_2 !='' order by ticket_2 desc ");
    $arr=array();
    $i=0;
    while($row =  $db->fetch_assoc()){
        $arr[$i][0]=$row["center_name"];
        $arr[$i][1]=$row["names2"];
        $arr[$i][2]=$row["head_img2"];
        $arr[$i][3]=$row["ticket_2"];
        $arr[$i][4]=$row["url_1"];
        $arr[$i][5]=$row["url_2"];
        $arr[$i][6]=$row["id"];
        $i++;
    }
    echo json_encode($arr);
}
$tswk     = $_GET["tswk"];
if($tswk){
    $db->query("select tswk.id,all_center.id as center_id,names1,names2,center_name,head_img1,head_img2, ticket_1 ,ticket_2 ,video  from tswk,all_center where tswk.center_id=all_center.id ");
    $arr=array();
    $i=0;
    while($row =  $db->fetch_assoc()){
        $arr[$i][0]=$row["id"];
        $arr[$i][1]=$row["center_id"];
        $arr[$i][2]=$row["center_name"];
        $arr[$i][3]=$row["names1"];
        $arr[$i][4]=$row["names2"];
        $arr[$i][5]=$row["head_img1"];
        $arr[$i][6]=$row["head_img2"];
        $arr[$i][7]=$row["ticket_1"];
        $arr[$i][8]=$row["ticket_2"];
        $arr[$i][9]=$row["video"];
        $i++;
    }
    echo json_encode($arr);
}
$lists     = $_GET["lists"];
if($lists){
    $db->query("select * from all_center order by id desc ");
    $arr=array();
    $i=0;
    while($row =  $db->fetch_assoc()){
        $arr[$i][0]=$row["id"];
        $arr[$i][1]=$row["center_name"];
        $i++;
    }
    echo json_encode($arr);
}
$id     = $_GET["id"];
if($id){
    $sql="select * from all_center where id={$id}";
    $db->query($sql);
    $row =  $db->fetch_assoc();
    $arr["id"]=$row["id"];
    $arr["center_name"]=$row["center_name"];
    $arr["tutor_img1"]=$row["tutor_img1"];
    $arr["tutor_name1"]=$row["tutor_name1"];
    $arr["tutor_img2"]=$row["tutor_img2"];
    $arr["tutor_name2"]=$row["tutor_name2"];
    $arr["ticket_1"]=$row["ticket_1"];
    $arr["ticket_2"]=$row["ticket_2"];
    $arr["names1"]=$row["names1"];
    $arr["names2"]=$row["names2"];
    $arr["head_img1"]=$row["head_img1"];
    $arr["head_img2"]=$row["head_img2"];
    $arr["url_1"]=$row["url_1"];
    $arr["url_2"]=$row["url_2"];
    $arr["resume"]=$row["resume"];
    $db->query("select * from comment where center_id={$id} order by id desc limit 1");
    $row =  $db->fetch_assoc();
    $arr["content"]=$row["content"];
    echo json_encode($arr);
}
$winning     = $_GET["winning"];
if($winning){
    $db->query("select * from winning order by id desc ");
    $arr=array();
    $i=0;
    while($row =  $db->fetch_assoc()){
        $arr[$i][0]=$row["nickname"];
        $arr[$i][1]=$row["openid"];
        $i++;
    }
    echo json_encode($arr);
}

$vote     = $_GET["vote"];
if($vote){
    $id     =   $_POST["id"];
    $ticket =   $_POST["ticket"];
    $openid  =   $_POST["openid"];
    $nickname    =   $_POST["nickname"];
    $ip     =   $db->getip();
    $t      =   time();

    $db->query("select count(id)as num from tickets where openid='{$openid}'");
    $row =  $db->fetch_assoc();
    if($row["num"]<10){
        $db->query("insert into tickets (center_id,openid,nickname,ip,add_time) values ('{$id}','{$openid}','{$nickname}','{$ip}','{$t}')");
        $db->query("update all_center set ticket_{$ticket}=ticket_{$ticket}+1 where id={$id}");
        $arr["code"]=$db->db_affected_rows();
        /*setcookie('names',$names,time()+3600*24,'/');
        setcookie('tel',$tel,time()+3600*24,'/');*/
    }else{
        $arr["code"]=0;
    }
    echo json_encode($arr);
}
$comment = $_GET["comment"];
if($comment){
    $id     =   $_POST["center_id"];
    $db->query("select * from comment where center_id='{$id}' order by id desc ");
    $arr=array();
    $i=0;
    while($row =  $db->fetch_assoc()){
        $arr[$i][0]=$row["nickname"];
        $arr[$i][1]=$row["content"];
        $arr[$i][2]=$row["add_time"];
        $i++;
    }
    echo json_encode($arr);
}
$addcomment = $_GET["addcomment"];
if($addcomment){
    $id     =   $_POST["center_id"];
    $name     =   $_POST["name"];
    $comment    =   $_POST["comment"];
    $t=date("Y-m-d H:i");
    $ip=$db->getip();
    $db->query("select * from comment where center_id='{$id}' and  ip='{$ip}' and date_add(add_time,interval 5 minute) > now() order by id desc");

    if($db->db_num_rows()==0){
         $db->query("insert into comment (center_id,nickname,content,ip,add_time) values ('{$id}','{$name}','{$comment}','{$ip}','{$t}')");
        $arr["code"]=$db->db_affected_rows();
    }else{
        $arr["code"]=0;
    }
    echo json_encode($arr);
}