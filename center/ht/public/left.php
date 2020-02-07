<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">

                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Beaut-zihan</strong>
                             </span>  <span class="text-muted text-xs block">超级管理员 <b class="caret"></b></span> </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a data-toggle="modal" href="#modal-form">修改密码</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0);loginOut()">安全退出</a>
                                </li>
                            </ul>
                        </div>

                    </li>                  
                    <li class="active">
                        <a href="admin.php#"><i class="fa fa-table"></i> <span class="nav-label">基本信息</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li <?php if($_SESSION['menu'] == "center"){echo 'class="active"';} ?>><a href="admin.php?act=admin">中心信息</a></li>
                            <li <?php if($_SESSION['menu'] == "tswk"){echo 'class="active"';} ?>><a href="tswk.php?act=tswk">本周之星</a></li>
                            <li <?php if($_SESSION['menu'] == "winning"){echo 'class="active"';} ?>><a href="winning.php?act=winning">中奖名单</a></li>
                            <li <?php if($_SESSION['menu'] == "zjxx"){echo 'class="active"';} ?>><a href="zjxx.php?act=zjxx">抽奖</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
		
		
<div id="modal-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 b-r">
                            <form method="post" role="form" action="act.php">
								<input type="hidden" name="witch" value="modifypwd" />
                                <div class="form-group">
                                    <label>原密码：</label>
                                    <input type="password" name="oldpwd" placeholder="请输入原密码" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>新密码：</label>
                                    <input type="password" name="newpwd" placeholder="请输入新密码" class="form-control">
                                </div>
								<div class="form-group">
                                    <label>重复新密码：</label>
                                    <input type="password" name="newpassword" placeholder="请输入新密码" class="form-control">
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-left m-t-n-xs" type="submit"><strong>确认</strong> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
<script type="text/javascript">
function loginOut(){
	$.layer({
		shade: [0],
		area: ['auto','auto'],
		dialog: {
			msg: '您确认要退出吗？',
			btns: 2,                    
			type: 4,
			btn: ['是','否'],
			yes: function(){
			   location.href="./act.php?out";
			   
			}, no: function(){
			   
			}
		}
		
	});
}
	
</script>