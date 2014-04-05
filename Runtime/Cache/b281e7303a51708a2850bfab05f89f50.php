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
        <!--<script type="text/javascript" src="__PUBLIC__/js/ztree/jquery-1.4.4.min.js"></script>-->
        <script type="text/javascript" src="__PUBLIC__/js/jquery172.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/ztree/jquery.ztree.core-3.5.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
        <!--  <script type="text/javascript" src="../../../js/jquery.ztree.excheck-3.5.js"></script>
          <script type="text/javascript" src="../../../js/jquery.ztree.exedit-3.5.js"></script>-->

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
                            <li class="active"><strong>系统用户列表</strong></li>

                        </ul>
                    </div>
                </div>
                <div id="teaser">
                </div>
                <div id="main">
                    <table class="common_table" align="center" ><thead><th>序号</th><th>用户名</th><th>用户权限</th><th>姓名</th><th>邮件地址</th><th>修改</th>
                            <th>删除</th></thead>
                        <?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$each): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($each["id"]); ?>">
                                <td><?php echo ($each["id"]); ?></td>
                                <td><?php echo ($each["username"]); ?></td>
                                <td>
                                    <?php switch($each["right"]): case "0": ?>超级管理员<?php break;?>
                                        <?php case "1": ?>管理员<?php break;?>
                                        <?php case "2": ?>普通用户<?php break; endswitch;?>
                                </td>
                                <td><?php echo ($each["truename"]); ?></td>

                                <td><?php echo ($each["email"]); ?></td>
                                <td><?php if(($each["id"]) == "1"): else: ?><a href="__URL__/edit/<?php echo ($each["id"]); ?>">修改</a><?php endif; ?></td>
                                <td><?php if(($each["id"]) == "1"): else: ?><a href="javascript:delete_user(<?php echo ($each["id"]); ?>)"><img src="__PUBLIC__/images/delete.png" /></a><?php endif; ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>                         
                    </table>  
                    <div style="width:100%; text-align:center;"><?php echo ($page); ?></div>
                    <div id="nav">
                        <!-- skiplink anchor: navigation -->
                        <a id="navigation" name="navigation"></a>
                        <div class="hlist">
                            <!-- main navigation: horizontal list -->
                            <ul>
                                <li class="active"><strong>添加系统用户</strong></li>

                            </ul>
                        </div>
                    </div>
                    <form name="adduser" method="POST" action="__URL__/add">

                        <table align="center">
                            <tr><td>用户名*:</td><td><input type="text" name="username" /></td></tr>
                            <tr><td>密码*:</td><td><input type="password" name="password" /></td></tr>
                            <tr><td>用户权限:</td><td><select name="right">
                                        <option value="2">普通用户</option> <option value="1">管理员</option>
                                    </select></td></tr>
                            <tr><td>真实姓名:</td><td><input type="text" name="truename" value="" /></td></tr>

                            <tr><td>邮件地址：</td><td><input type="text" name="email"  /></td></tr>
                            <tr><td></td><td><input type="submit" value="增加用户" /></td></tr>
                        </table>

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