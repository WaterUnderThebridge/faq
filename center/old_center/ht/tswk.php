<?php
require_once ("inc.php");
isLogin();

$db = new mysql();


$db->query("select tswk.id,all_center.id as center_id,center_name ,video from tswk,all_center where tswk.center_id=all_center.id");
$_SESSION['menu'] = "tswk";
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
                            <span class="m-r-sm text-muted welcome-message"><a href="admin.php" title="返回首页"><i class="fa fa-home"></i></a>欢迎使用</span>
                        </li>
                        <li>
                            <a href="javascript:void(0);loginOut()"><i class="fa fa-sign-out"></i> 退出  </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>本周之星</h2>
                    <ol class="breadcrumb">
                        <!--<li>
                            <a href="admin.php">主页</a>
                        </li>
                        <li>
                            <strong>用户资料</strong>
                        </li>-->
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">

                    </div>

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
           
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5></h5>
								<!--<h5>&nbsp;&nbsp;&nbsp;&nbsp;<a href="act.php?down=downd"/>导出Excel</a></h5>-->
                            </div>
                            <div class="ibox-content">

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>中心名称</th>
                                            <th>视频</th>
                                            <th>操作</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while($row =  $db->fetch_assoc()){ ?>
                                        <tr>
                                            <td>本周第<?php echo $row['id']; ?></td>

                                            <th><?php echo $row['center_name']; ?></th>
                                            <th><?php  if($row['video']==1){echo "学前组视频" ;}else{echo "学前龄视频";}  ?></th>
                                            <td><a href="tswk_updata.php?id=<?php echo $row['id']; ?>&center_id=<?php echo $row['center_id']; ?>">修改</a></td>
                                        </tr>
                                    <?php  }?>
                                    </tbody>
                                </table>
                        		<?php 
                        			//echo $_page->showpage();
                        			?>
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
    

    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
        });
		function changeTick(obj,id){
            var tick = $(obj).val();
            $.ajax({
                type: "post",
                url: "act.php",
                dataType: 'text',
                data: {
                    witch: "changeTick",
                    id:id,
                    tick:tick
                },
                success: function (data) {

                },
                error: function (xhr, ajaxOptions, thrownError) {  }
            });
        }
        function changeTime(obj,id){
            var time = $(obj).val();
            if(time != ""){
                $.ajax({
                    type: "post",
                    url: "act.php",
                    dataType: 'text',
                    data: {
                        witch: "changeTime",
                        id:id,
                        time:time
                    },
                    success: function (data) {

                    },
                    error: function (xhr, ajaxOptions, thrownError) {  }
                });
            }else {
                $(obj).val(time);
            }

        }
		function del(id){
			$.layer({
				shade: [0],
				area: ['auto','auto'],
				dialog: {
					msg: '删除之后无法恢复,您确认要删除吗？',
					btns: 2,                    
					type: 4,
					btn: ['是','否'],
					yes: function(){
					   location.href="./act.php?del="+id;
					   
					}, no: function(){
					   
					}
				}
				
			});
		}
    </script>
</body>

</html>
