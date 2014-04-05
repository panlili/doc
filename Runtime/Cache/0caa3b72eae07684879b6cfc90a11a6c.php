<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>办公文档管理系统</title>
        <!-- add your meta tags here -->

        <link href="__PUBLIC__/css/my_layout.css" rel="stylesheet" type="text/css" />
        <!--[if lte IE 7]>
        <link href="css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
        <![endif]-->

        <link rel="stylesheet" href="__PUBLIC__/css/ztree/zTreeStyle/zTreeStyle.css" type="text/css" />
        <link href="__PUBLIC__/css/jquery.ui/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" />
        <link href="__PUBLIC__/css/jquery.ui/jquery.ui.all.css" rel="stylesheet" type="text/css" />
        <!--<script type="text/javascript" src="__PUBLIC__/js/ztree/jquery-1.4.4.min.js"></script>-->
        <script type="text/javascript" src="__PUBLIC__/js/jquery172.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/ztree/jquery.ztree.core-3.5.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/jquery.ui/jquery-ui.custom.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/jquery.ui/jquery.ui.core.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/jquery.ui/jquery.ui.datepicker-zh-CN.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/jquery.ui/jquery.ui.datepicker.min.js"></script>
        <!--  <script type="text/javascript" src="../../../js/jquery.ztree.excheck-3.5.js"></script>
          <script type="text/javascript" src="../../../js/jquery.ztree.exedit-3.5.js"></script>-->
        <script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>

    </head>
    <body>
        <div class="page_margins">
            <div id="border-top">
                <div id="edge-tl"></div>
                <div id="edge-tr"></div>
            </div>
            <div class="page">
                <div id="header">
                    <div id="topnav">
                        <!-- start: skip link navigation -->
                        <a class="skip" title="skip link" href="#navigation">Skip to the navigation</a><span class="hideme">.</span>
                        <a class="skip" title="skip link" href="#content">Skip to the content</a><span class="hideme">.</span>
                        欢迎您,管理员<?php echo ($true_name); ?>&nbsp;&nbsp;&nbsp;
                        <!-- end: skip link navigation --><a href="__APP__/user/index">用户管理</a> | <a href="__APP__/group/index">组管理</a> | <a href="__APP__/docfile/index">文件管理</a> | <a href="__APP__/cata/index">分类目录管理</a> | <a href="__APP__">系统首页</a>
                    </div>
                </div>
                <div id="nav">
                    <!-- skiplink anchor: navigation -->
                    <a id="navigation" name="navigation"></a>
                    <div class="hlist">
                        <!-- main navigation: horizontal list -->
                        <ul>
                            <li class="active"><strong>添加用户组</strong></li>
                            <li><a href="__URL__/index">用户组列表</a></li>
                        </ul>
                    </div>
                </div>
                <div id="teaser">
                </div>
                <div id="main">
                    <form action="__URL__/add" method="POST">
                        <p>用户组名：<input name="g_name" type="text" size="50"></input></p>
                        <p>失效日期：<input name="fail_date" type="text" size="50" id="datepicker"></input></p>
                        <p>组的描述：</p><textarea style="margin-left: 55px;" name="g_content"  rows="10" cols="40"></textarea>
                        <p>选择组的成员：</p>
                        <div style="border: 1px solid;padding: 15px;margin: 15px;">
                            <?php if(is_array($user_list)): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="checkbox" name="members[]" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["truename"]); ?> &nbsp;&nbsp;&nbsp;&nbsp;</input><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div> 
                        <input type="submit" value="添加"></input>
                        <input type="reset" value="重置"></input>
                    </form>  
                </div>
                <!-- begin: #footer -->
                <div id="footer">电子工程学院版权所有
                </div>

            </div>
            <div id="border-bottom">
                <div id="edge-bl"></div>
                <div id="edge-br"></div>
            </div>
        </div>

    </body>
</html>