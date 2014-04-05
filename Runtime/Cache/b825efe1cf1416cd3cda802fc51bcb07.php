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
             function zTreeOnClick(event, treeId, treeNode) {
                //alert(treeNode.tId + ", " + treeNode.name);
                $.get("__APP__/cata/SetCurrentCata", {cata_id: treeNode.id, cata_name: treeNode.name},
                function(json) {
                    //alert("Data Loaded: " +json.data);
                    //$("#col3_content").empty();
                    //$("#col3_content").append("<b>" + json.data + ","+treeNode.name+"</b>");
                    $("#tip_cata").empty();
                    $("#tip_cata").append("<strong>当前所在目录:<strong>" + " " + json.data);
                });
            }
            var setting = {
                callback: {
                    onClick: zTreeOnClick
                }
            };
            function goroot() {
                $.get("__APP__/cata/SetCurrentCata", {cata_id: 0},
                function(json) {
                    //alert(json.data);
                    location.reload();
                });
            }





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
                            <li class="active"><strong>分类目录管理</strong></li>            

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
                            <p id="tip_cata"><strong>当前所在目录:<strong>  <?php echo ($currentCata); ?></p>
                                        <p style="color: red"><?php echo ($msg); ?></p>
                                        <table class="common_table">
                                            <tr>
                                                <td>

                                                    <form name="addcata" method="post" action="__URL__/add">

                                                        <p>目录名 <input type="text" name="name" /></p>

                                                        <input type="submit" value="在当前目录下添加目录" />

                                                    </form>

                                                </td>
                                                <td>
                                                    
                                                    <form name="editcata" method="post" action="__URL__/edit">

                                                        <p>目录名 <input type="text" name="name" value="<?php echo ($cataName); ?>" /></p>

                                                        <input type="submit" value="编辑当前目录" />

                                                    </form>
                                                </td>
                                                <td>
                                                    <button></button>
                                                    <form name="delcata" method="post" action="__URL__/delete">                                                       

                                                        <input type="submit" value="删除当前目录" />

                                                    </form>
                                                </td>
                                            </tr>

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