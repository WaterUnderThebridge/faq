<?php
require_once ("inc.php");
isLogin();
$id = $get['id'];
$center_id = $get['center_id'];
$db=new mysql();
$db->query("select * from all_center order by id ");
$arr=array();
$i=0;
while($row =  $db->fetch_assoc()){
    $arr[$i]["id"]=$row["id"];
    $arr[$i]["center_name"]=$row["center_name"];
    $i++;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">
    <title>后台管理系统</title>
    <link href="css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css?v=4.3.0" rel="stylesheet">
	<link href="css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
	<link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/plugins/webuploader/webuploader.css">
    <link rel="stylesheet" type="text/css" href="css/demo/webuploader-demo.css">
    <link href="css/style.css?v=2.2.0" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <?php include "public/left.php"; ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>资料修改</h2>
                    <ol class="breadcrumb">
                        <!--<li>
                            <a href="product.php">主页</a>  
                        </li>
                        <li>
                           <a href="product.php"> 产品资料</a>  
                        </li>
						<li>
                            <strong>新增</strong>
                        </li>-->
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>请填写所有表单元素 <small></small></h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up">申缩</i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form method="post" class="form-horizontal" action="act.php" enctype="multipart/form-data">
                                	<input type="hidden" name="witch" value="tswkupdata" />
                                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                                	<input type="hidden" name="aHTML" value=""/>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">本周第<?php echo $id;?></label>
                                        <div class="input-group col-sm-5">
                                            <select name="center_id">
                                                <?php
                                                    foreach($arr as $k=>$val){
                                                ?>
                                                <option value ="<?php echo $val["id"];?>" <?php if( (int)$val["id"]==(int)$center_id){ echo "selected";} ?> ><?php echo $val["center_name"];?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>

                                            <select name="video">
                                                <option value="1">学前组视频</option>
                                                <option value="2">学龄组视频</option>
                                            </select>
                                        </div>
                                    </div>


   
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary" type="submit" >保存内容</button>
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
	<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	
	<!-- Custom and plugin javascript -->
	<script src="js/hplus.js?v=2.2.0"></script>
	<script src="js/plugins/pace/pace.min.js"></script>
	<script src="js/plugins/layer/layer.min.js"></script>
    
<!-- SUMMERNOTE -->
    <script src="js/plugins/summernote/summernote.min.js"></script>
    <script src="js/plugins/summernote/summernote-zh-CN.js"></script>
	

    <script src="js/plugins/webuploader/webuploader.min.js"></script>
	 <script src="js/demo/webuploader-demo.js"></script>
   <script src="js/plugins/iCheck/icheck.min.js"></script>
  
    <script>

        $("form").submit(function (){

            $("input[name='aHTML']").val($('.summernote').code());
        });
    </script>
</body>
</html>
