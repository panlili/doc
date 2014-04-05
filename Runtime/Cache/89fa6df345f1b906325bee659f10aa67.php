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
            //鼠标单击树节点时把加载文件列表
            function zTreeOnClick(event, treeId, treeNode) {
                //alert(treeNode.tId + ", " + treeNode.name);
                $.get("__APP__/docfile/SetCurrentCata", {cata_id: treeNode.id, cata_name: treeNode.name},
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
                $.get("__APP__/docfile/SetCurrentCata", {cata_id: 0},
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
                            <li class="active"><strong>编辑文档</strong></li>
                            <li><a href="__APP__/docfile/index">文档管理</a></li>

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
                        <p id="tip_cata"><strong>当前所在目录:<strong>  <?php echo ($currentCata); ?></p>
                                    <div id="col3_content" class="clearfix">
                                        <!-- add your content here -->
                                        <form name="edituser" method="POST" action="__URL__/update">                                            
                                            <table align="center">
                                                <?php if(is_array($docfile)): $i = 0; $__LIST__ = $docfile;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td>文件名:</td><td><input type="text" name="name" size="50"  value="<?php echo ($vo["name"]); ?>"/></td></tr>
                                                    <tr><td>选择文件:</td><td><input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" /></td></tr> 
                                                    <tr><td>文件访问权限:</td>
                                                        <td><select name="g_id">                                                                
                                                                <?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$each): $mod = ($i % 2 );++$i; if(($each["id"]) == $vo["g_id"]): ?><option value="<?php echo ($each["id"]); ?>" selected="selected"><?php echo ($each["g_name"]); ?></option><?php else: ?><option value="<?php echo ($each["id"]); ?>"><?php echo ($each["g_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                                            </select></td></tr>

                                                    <tr><td>文件描述：</td><td><textarea rows="10" cols="45" name="content"><?php echo ($vo["content"]); ?></textarea></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                <tr><td></td><td><input type="submit" value="完成编辑" /></td></tr>
                                            </table>

                                        </form>   
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