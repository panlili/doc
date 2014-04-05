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
        <script type="text/javascript" src="__PUBLIC__/js/ztree/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/ztree/jquery.ztree.core-3.5.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
        <!--  <script type="text/javascript" src="../../../js/jquery.ztree.excheck-3.5.js"></script>
          <script type="text/javascript" src="../../../js/jquery.ztree.exedit-3.5.js"></script>-->
        <SCRIPT type="text/javascript">
            <!--
            //鼠标单击树节点时把加载文件列表
            function zTreeOnClick(event, treeId, treeNode) {
                //alert(treeNode.tId + ", " + treeNode.name);
                $.get("__APP__/docfile/filelist", {cata_id: treeNode.id},
                function(json) {
                    //alert("Data Loaded: " +json.data);
                    $("#col3_content").empty();
                    $("#col3_content").append("<b>" + json.data + "</b>");
                });
            }
            var setting = {
                callback: {
                    onClick: zTreeOnClick
                }
            };





            var zNodes = <?php echo ($catadata); ?>;

            $(document).ready(function() {
                $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            });
            //-->
        </SCRIPT>
    </head>
    <body>
        <div class="page_margins">
            <!-- start: skip link navigation -->
            <!-- end: skip link navigation -->
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
                            <li class="active"><strong>文档管理</strong></li>
                            <li><a href="__APP__/docfile/adddoc">添加文档</a></li>

                        </ul>
                    </div>
                </div>
                <div id="teaser">
                </div>
                <div id="main">
                    <div id="col1">
                        <div id="col1_content" class="clearfix">
                            <!-- add your content here -->

                            <ul id="treeDemo" class="ztree"></ul>

                        </div>
                    </div>
                    <div id="col3">
                        <div id="col3_content" class="clearfix">
                            <!-- add your content here -->
                            <table class="common_table">
                                <thead><th>序号</th><th>文件名</th><th>上传人</th><th>上传时间</th><th>编辑</th><th>删除</th></thead>
                                <?php if(is_array($filelist)): $i = 0; $__LIST__ = $filelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vo["id"]); ?>"><td><?php echo ($vo["id"]); ?></td><td><?php echo ($vo["name"]); ?></td><td><?php echo ($vo["up_user"]); ?></td><td><?php echo ($vo["up_date"]); ?></td>
                                        <td><a href="__URL__/edit/<?php echo ($vo["id"]); ?>">编辑</a></td>
                                        <td><a href="javascript:delete_docfile(<?php echo ($vo["id"]); ?>)"><img src="__PUBLIC__/images/delete.png" /></a></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                            </table>
                        </div>
                        <!-- IE Column Clearing -->
                        <div id="ie_clearing"> &#160; </div>
                    </div>
                </div>
                <!-- begin: #footer -->
                <div id="footer">电子工程学院版权所有</a>
                </div>
            </div>
            <div id="border-bottom">
                <div id="edge-bl"></div>
                <div id="edge-br"></div>
            </div>
        </div><embed></embed>

    </body>
</html>