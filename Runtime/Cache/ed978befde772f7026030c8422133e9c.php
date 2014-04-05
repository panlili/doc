<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                        <!-- end: skip link navigation -->
                        <?php switch($user_right): case "0": ?>欢迎您,超级管理员&nbsp;<a href="__APP__/user/index">用户管理</a> | <a href="__APP__/group/index">组管理</a> | <a href="__APP__/docfile/index">文件管理</a> | <a href="__APP__/cata/index">分类目录管理</a><?php break;?>
                            <?php case "1": ?>欢迎您,管理员<?php echo ($true_name); ?>&nbsp;<a href="__APP__/user/index">用户管理</a> | <a href="__APP__/group/index">组管理</a> | <a href="__APP__/docfile/index">文件管理</a> | <a href="__APP__/cata/index">分类目录管理</a><?php break;?>
                            <?php case "2": ?>欢迎您,用户<?php echo ($true_name); ?>&nbsp;<?php break;?>
                            <?php default: ?><div id="denglu" style="display: block;">
                                <form name="checkin" action="__URL__/checkuser" method="POST">
                                    用户名<input type="text" name="username"></input>
                                    密码<input type="password" name="password"></input>
                                    <input type="submit" value="登录"></input>
                                </form>
                            </div><?php endswitch;?>
                        &nbsp;&nbsp; | <a href="#">使用帮助</a> | <a href="__APP__/index/index">系统首页</a>
                    </div>
                </div>
                <div id="nav">
                    <!-- skiplink anchor: navigation -->
                    <a id="navigation" name="navigation"></a>
                    <div class="hlist">
                        <!-- main navigation: horizontal list -->
                        <ul>
                            <li class="active"><strong>搜索结果列表</strong></li> 
                            <li ><a href="__APP__/index/index">返回首页</a></li>

                        </ul>
                    </div>
                </div>
                <div id="teaser">
                </div>
                <div id="main">

                    <div >

                        <div id="col3_content" class="clearfix">
                            <!-- add your content here -->
                           

                            <table align="center" class="common_table">
                                <thead><th>序号</th><th>文件名</th><th>上传人</th><th>上传时间</th><th>详细信息</th></thead>
                                <?php if(is_array($doc_list)): $i = 0; $__LIST__ = $doc_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($vo["id"]); ?></td><td><?php echo ($vo["name"]); ?></td><td><?php echo ($vo["up_user"]); ?></td><td><?php echo ($vo["up_date"]); ?></td>
                                        <?php switch($loginOk): case "1": ?><td><?php if(isset($vo["rightok"])): ?><a href="__URL__/item/<?php echo ($vo["id"]); ?>" target="_blank" style="color: red;" title="你可以查看该文件详情">详细信息</a><?php else: ?><a title="你不能查看该组别的文件详情">详细信息</a><?php endif; ?></td><?php break;?>
                                            <?php case "0": ?><td><a title="你没有足够权限查看详情，请登录">详细信息</a></td><?php break;?>
                                            <?php default: ?><td><a title="你没有足够权限查看详情，请登录">详细信息</a></td><?php endswitch;?>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                            </table>

<?php echo ($page); ?>
                        </div>
                         <div style="padding: 20px;display: block;">
                                <form name="search" action="__URL__/search" method="POST">
                                    <input type="text" name="search_key" size="30" />
                                    <input type="submit" value="检索"></input>
                                </form></div>
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