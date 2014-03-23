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
        <!--  <script type="text/javascript" src="../../../js/jquery.ztree.excheck-3.5.js"></script>
          <script type="text/javascript" src="../../../js/jquery.ztree.exedit-3.5.js"></script>-->
        <SCRIPT type="text/javascript">
            <!--
                var setting = {};

            var zNodes = [
                {name: "父节点1 - 展开", open: true,
                    children: [
                        {name: "父节点11 - 折叠",
                            children: [
                                {name: "叶子节点111"},
                                {name: "叶子节点112"},
                                {name: "叶子节点113"},
                                {name: "叶子节点114"}
                            ]},
                        {name: "父节点12 - 折叠",
                            children: [
                                {name: "叶子节点121"},
                                {name: "叶子节点122"},
                                {name: "叶子节点123"},
                                {name: "叶子节点124"}
                            ]},
                        {name: "父节点13 - 没有子节点", isParent: true}
                    ]},
                {name: "父节点2 - 折叠",
                    children: [
                        {name: "父节点21 - 展开", open: true,
                            children: [
                                {name: "叶子节点211"},
                                {name: "叶子节点212"},
                                {name: "叶子节点213"},
                                {name: "叶子节点214"}
                            ]},
                        {name: "父节点22 - 折叠",
                            children: [
                                {name: "叶子节点221"},
                                {name: "叶子节点222"},
                                {name: "叶子节点223"},
                                {name: "叶子节点224"}
                            ]},
                        {name: "父节点23 - 折叠",
                            children: [
                                {name: "叶子节点231"},
                                {name: "叶子节点232"},
                                {name: "叶子节点233"},
                                {name: "叶子节点234"}
                            ]}
                    ]},
                {name: "父节点3 - 没有子节点", isParent: true}

            ];

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
                        <!-- end: skip link navigation --><a href="__APP__/user/index">用户登录</a> | <a href="#">使用帮助</a> | <a href="#">学院网站</a>
                    </div>
                </div>
                <div id="nav">
                    <!-- skiplink anchor: navigation -->
                    <a id="navigation" name="navigation"></a>
                    <div class="hlist">
                        <!-- main navigation: horizontal list -->
                        <ul>
                            <li class="active"><strong>Button 1</strong></li>
                            <li><a href="#">Button 2</a></li>
                            <li><a href="#">Button 3</a></li>
                            <li><a href="#">Button 4</a></li>
                            <li><a href="#">Button 5</a></li>
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
                            <table>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td></tr>
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