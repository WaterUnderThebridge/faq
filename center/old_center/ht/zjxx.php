<?php
require_once ("inc.php");
isLogin();
$db = new mysql();
$db->query("select * from tickets where openid not in(select openid from winning) group by openid order by id");
$arr= array();
$i=0;

while($row =  $db->fetch_assoc()){
    $arr[$i][0]=$row["id"];
    $arr[$i][1]=$row["nickname"];
    $arr[$i][2]=$row["openid"];
    $i++;
}
$num= mt_rand(0,$i-1);
$_SESSION['menu'] = "zjxx";
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">

    <title>后台管理系统</title>

    <link href="css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css?v=4.3.0" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=2.2.0" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <?php include "public/left.php"; ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
		<div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message"><a href="zjxx.php?act=zjxx" title="返回首页"><i class="fa fa-home"></i></a>欢迎使用</span>
                        </li>
                        <li>
                            <a href="javascript:void(0);loginOut()">
                                <i class="fa fa-sign-out"></i> 退出 </a>
                        </li>
                    </ul>

                </nav>
            </div>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>随机抽奖</h2>
                    <!--<ol class="breadcrumb">
                        <li>
                            <a href="zjxx.php?act=zjxx">主页</a>
                        </li>
   
                        <li>
                            <strong>中奖设置</strong>
                        </li>
                    </ol>-->
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
 
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <!--<ul class="dropdown-menu dropdown-user">
                                        <li><a href="form_basic.html#">选项1</a>
                                        </li>
                                        <li><a href="form_basic.html#">选项2</a>
                                        </li>
                                    </ul>-->
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form method="post" class="form-horizontal" role="form" action="act.php">
									<input type="hidden" name="witch" value="winning" />
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">投票ID</label>

                                        <div class="col-sm-2">
                                            <input type="text" name="ticket_id" value="<?php echo $arr[$num][0]; ?>" class="form-control" readOnly="true" >
                                        </div>

                                        <label class="col-sm-1 control-label">openid</label>

                                        <div class="col-sm-2">
                                            <input type="text" name="openid" value="<?php echo $arr[$num][2]; ?>" class="form-control" readOnly="true" >
                                        </div>
										
										<label class="col-sm-1 control-label">昵称</label>
										<div class="col-sm-3">
                                            <input type="text" name="nickname" value="<?php echo $arr[$num][1]; ?>" class="form-control" readOnly="true" >
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                  
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary" type="submit">保存内容</button>
                                            <button class="btn btn-white" type="submit">取消</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
    

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js?v=3.4.0"></script>
    <!-- Custom and plugin javascript -->
	<script src="js/hplus.js?v=2.2.0"></script>
	<script src="js/plugins/pace/pace.min.js"></script>
	<script src="js/plugins/layer/layer.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
	<script type="text/javascript" src="My97DatePicker/WdatePicker.js"></script>

    <script>
        $("form").submit(function (){
            if($("input[name='openid']").val() == ""){
                alert("没有可抽奖用户！");
                return false;
            }
        });
    </script>
</body>

</html>
