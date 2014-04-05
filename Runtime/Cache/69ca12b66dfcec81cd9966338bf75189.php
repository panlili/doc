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
                            <li class="active"><strong>用户组列表</strong></li>
                            <li><a href="__URL__/newgroup">添加用户组</a></li>
                        </ul>
                    </div>
                </div>
                <div id="teaser">
                </div>
                <div id="main">
                    <table class="common_table" align="center" ><thead><th>序号</th><th>用户组</th><th>备注</th><th>组失效时间</th><th>修改</th>
                            <th>删除</th></thead>
                        <?php if(is_array($grouplist)): $i = 0; $__LIST__ = $grouplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$each): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($each["id"]); ?>">
                                <td><?php echo ($each["id"]); ?></td>
                                <td><?php echo ($each["g_name"]); ?></td>
                                <td>
                                    <?php echo ($each["content"]); ?>
                                </td>
                                <td><?php echo ($each["fail_date"]); ?></td>                                
                                <td><?php if(($each["id"]) == "1"): else: ?><a href="__URL__/edit/<?php echo ($each["id"]); ?>">修改</a><?php endif; ?></td>
                                <td><?php if(($each["id"]) == "1"): else: ?><a href="javascript:delete_user(<?php echo ($each["id"]); ?>)"><img src="__PUBLIC__/images/delete.png" /></a><?php endif; ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>                         
                    </table>  
                    <div style="width:100%; text-align:center;"><?php echo ($page); ?></div>                   
                      
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