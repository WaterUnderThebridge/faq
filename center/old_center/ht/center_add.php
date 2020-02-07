<?php
require_once ("inc.php");
isLogin();

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
                    <h2>添加中心</h2>
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
                                	<input type="hidden" name="witch" value="centeradd" />
                                	<input type="hidden" name="aHTML" value=""/>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">中心名称</label>
                                        <div class="input-group col-sm-5">
                                            <input type="text" class="form-control" name="center_name">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">学前组导师呢称</label>
                                        <div class="input-group col-sm-5">
                                            <input type="text" class="form-control" name="tutor_name1">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">学前组导师的图片</label>

                                        <div class="input-group col-sm-10">
                                            <input type="file" name="tutor_img1" class="tutor_img1">
                                            <img class="img" style="display: none;" src="img/a1.jpg" width="150">
                                        </div>
                                    </div>


                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">学前组学员名称</label>
                                        <div class="input-group col-sm-5">
                                            <input type="text" class="form-control" name="names1">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">学前组学员的图片</label>

                                        <div class="input-group col-sm-10">
                                            <input type="file" name="head_img1" class="head_img1">
                                            <img class="img1" style="display: none;" src="img/a1.jpg" width="150">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">学前组视频地址</label>
 										<div class="input-group col-sm-5">
                                            <input type="text" class="form-control" name="url1">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <br><br><br><br><br>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">学龄组导师呢称</label>
                                        <div class="input-group col-sm-5">
                                            <input type="text" class="form-control" name="tutor_name2">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">学龄组导师图片</label>
                                        <div class="input-group col-sm-5">
                                            <input type="file" name="tutor_img2" class="tutor_img2">
                                            <img class="img3" style="display: none;" src="img/a1.jpg" width="150">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">学龄组学员名称</label>
                                        <div class="input-group col-sm-5">
                                            <input type="text" class="form-control" name="names2">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">学龄组学员的图片</label>

                                        <div class="input-group col-sm-10">
                                            <input type="file" name="head_img2" class="head_img2">
                                            <img class="img2" style="display: none;" src="img/a1.jpg" width="150">
                                        </div>
                                    </div>

									 <div class="hr-line-dashed"></div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">学龄组视频地址</label>
                                        <div class="input-group col-sm-5">
                                            <input type="text" class="form-control" name="url2">
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
        $('.tutor_img1').on('change',function(source) {
            var file = source.target.files[0];
            var URL = window.URL || window.webkitURL;
            var blob = URL.createObjectURL(file);
            var file = $(this).val();
            var FileExt=file.replace(/.+\./,"");   //正则表达式获取后缀
            if(FileExt=="jpg" || FileExt=="png" || FileExt=="JPG"){
                $(".img").attr("src",blob).show();
            }else{
                alert("请选择jpg或png格式图片！");
                $(".tutor_img1").val("");
                $(".img").css("display","none");
            }
        });
        $('.tutor_img2').on('change',function(source) {
            var file = source.target.files[0];
            var URL = window.URL || window.webkitURL;
            var blob = URL.createObjectURL(file);
            var file = $(this).val();
            var FileExt=file.replace(/.+\./,"");   //正则表达式获取后缀
            if(FileExt=="jpg" || FileExt=="png" || FileExt=="JPG" ){
                $(".img3").attr("src",blob).show();
            }else{
                alert("请选择jpg或png格式图片！");
                $(".tutor_img2").val("");
                $(".img3").css("display","none");
            }
        });
        $('.head_img1').on('change',function(source) {
            var file = source.target.files[0];
            var URL = window.URL || window.webkitURL;
            var blob = URL.createObjectURL(file);
            var file = $(this).val();
            var FileExt=file.replace(/.+\./,"");   //正则表达式获取后缀
            if(FileExt=="jpg" || FileExt=="png" || FileExt=="JPG" ){
                $(".img1").attr("src",blob).show();
            }else{
                alert("请选择jpg或png格式图片！");
                $(".head_img1").val("");
                $(".img1").css("display","none");
            }
        });
        $('.head_img2').on('change',function(source) {
            var file = source.target.files[0];
            var URL = window.URL || window.webkitURL;
            var blob = URL.createObjectURL(file);
            var file = $(this).val();
            var FileExt=file.replace(/.+\./,"");   //正则表达式获取后缀
            if(FileExt=="jpg" || FileExt=="png" || FileExt=="JPG" ){
                $(".img2").attr("src",blob).show();
            }else{
                alert("请选择jpg或png格式图片！");
                $(".head_img2").val("");
                $(".img2").css("display","none");
            }
        });
        $("form").submit(function (){
            /*if($("input[name='center_name']").val() == ""){
                $("input[name='center_name']").focus();
                alert('请输入中心名称');
                return false;
            }
            if($("input[name='center_img']").val() == ""){
                $("input[name='center_img']").focus();
                alert('请选择导师图片');
                return false;
            }
            if($("input[name='nickname']").val() == ""){
                $("input[name='nickname']").focus();
                alert('请输入导师呢称');
                return false;
            }
            if($("input[name='resume']").val() == ""){
                $("input[name='resume']").focus();
                alert('请输入导师介绍呢称');
                return false;
            }
            if($("input[name='names1']").val() == ""){
                $("input[name='names1']").focus();
                alert('请输入学前组呢称');
                return false;
            }
            if($("input[name='head_img1']").val() == ""){
                $("input[name='head_img1']").focus();
                alert('请选择学前组图片');
                return false;
            }

            if($("input[name='url1']").val() == ""){
                $("input[name='url1']").focus();
                alert('请输入视频1地址');
                return false;
            }
            if($("input[name='names2']").val() == ""){
                $("input[name='names2']").focus();
                alert('请输入学龄组呢称');
                return false;
            }
            if($("input[name='head_img2']").val() == ""){
                $("input[name='head_img2']").focus();
                alert('请选择学龄组图片');
                return false;
            }
            if($("input[name='url2']").val() == ""){
                $("input[name='url2']").focus();
                alert('请输入视频2地址');
                return false;
            }
*/



            $("input[name='aHTML']").val($('.summernote').code());
        });
    </script>
</body>
</html>
