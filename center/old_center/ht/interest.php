<?php
require_once ("inc.php");
isLogin();

$db = new mysql();
$_SESSION['menu'] = "interest";
$db->query("select * from interest order by id desc ");
$rows = $db->db_num_rows();
$_page = new Page($rows,20);
$user=$db->query("select inte.id as ids,inte.add_time as time2,car.*,inte.* from interest as inte left join car_data as car on inte.car_id = car.id order by car.id desc ".$_page->limit);
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
                    <h2>喜好资料</h2>
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
                        <!--<a href="product_add.php" class="btn btn-primary">新增</a>-->
                    </div>

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
           
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>喜好资料</h5>
								<!--<h5>&nbsp;&nbsp;&nbsp;&nbsp;<a href="act.php?down=downd"/>导出Excel</a></h5>-->
                            </div>
                            <div class="ibox-content">

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>产品型号</th>
                                            <th>产品名</th>
											<th>产品类型</th>
                                            <th>产品图片</th>
                                            <th>联系方式</th>
											<th>提交时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									 <?php
										while($row =  $db->fetch_assoc($user)){
                                            ?>
                                        <tr>
                                            <td><?php echo $row['ids']; ?><input type="hidden" value="<?php echo $row['ids'];?>"/></td>
                                            <th><?php echo $row['model']; ?></th>
                                            <th><?php echo $row['car_name']; ?></th>
											<th><?php   if($row['car_type']==1){echo "小型挖掘机";}else{echo "大型挖掘机";}  ?></th>
                                            <td><a href="<?php echo "../upload/".$row['car_img']; ?>" target="_blank"><img src="<?php echo "../upload/".$row['car_img']; ?>" width="50" height="50"></a></td>
											<td><?php echo $row['tel']; ?> </td>
                                            <td><?php echo date("Y-m-d H:i",$row['time2']); ?></td>
                                            <td><a href="javascript:;interest_del('<?php echo $row['ids'];?>')">删除</a></td>
                                        </tr>
									<?php  }?>
                                    </tbody>
                                </table>
                        		<?php 
                        			echo $_page->showpage();
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
		function interest_del(id){
			$.layer({
				shade: [0],
				area: ['auto','auto'],
				dialog: {
					msg: '删除之后无法恢复,您确认要删除吗？',
					btns: 2,                    
					type: 4,
					btn: ['是','否'],
					yes: function(){
					   location.href="./act.php?interest_del="+id;
					   
					}, no: function(){
					   
					}
				}
				
			});
		}
    </script>
</body>

</html>
