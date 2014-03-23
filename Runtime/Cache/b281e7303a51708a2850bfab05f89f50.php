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
       
    </head>
    <body>
        <div id="content">
            <table id="common_table"><thead><th>序号</th><th>用户名</th><th>用户权限</th><th>姓名</th>
                    <th>所属单位</th><th>职务</th><th>删除用户</th></thead>
                <?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$each): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($each["id"]); ?>">
                        <td class="number"></td>
                        <td><?php echo ($each["username"]); ?></td>
                        <td><?php if($each["right"] == 1): ?>领导<?php else: ?>一般工作人员<?php endif; ?></td>
                        <td><?php echo ($each["truename"]); ?></td>
                        <td>
                            <?php switch($each["community"]): case "0": ?>街道办工作人员<?php break;?>
                                <?php case "1": ?>水井坊社区工作人员<?php break;?>
                                <?php case "2": ?>交子社区工作人员<?php break; endswitch;?>
                        </td>
                        <td><?php echo ($each["position"]); ?></td>
                        <td><a href="javascript:delete_user(<?php echo ($each["id"]); ?>)"><img src="__IMAGE__/delete.png" /></a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?> 
            </table>      
            <form name="adduser" method="POST" action="__URL__/add">
                <table id="adduser">
                    <tr><td>用户名*:</td><td><input type="text" name="username" /></td></tr>
                    <tr><td>密码*:</td><td><input type="password" name="password" /></td></tr>
                    <tr><td>用户权限:</td><td><select name="right">
                                <option value="1">领导</option><option value="0">一般工作人员</option>
                            </select></td></tr>
                    <tr><td>姓名*:</td><td><input type="text" name="truename" value="" /></td></tr>
                    <tr><td>所属单位:</td><td>
                            <select name="community">
                                <option value="0">街道办工作人员</option>
                                <option value="1">水井坊社区工作人员</option>
                                <option value="2">交子社区工作人员</option>
                            </select>
                        </td></tr>
                    <tr><td>职务：</td><td><input type="text" name="position" /></td></tr>
                    <tr><td></td><td><input type="submit" value="增加用户" /></td></tr>
                </table> 
            </form>
        </div>
    </body>
</html>