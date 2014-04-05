<?php if (!defined('THINK_PATH')) exit();?><table class="common_table">
    <thead><th>序号</th><th>文件名</th><th>上传人</th><th>上传时间</th><th>详细信息</th></thead>
<?php if(is_array($filelist)): $i = 0; $__LIST__ = $filelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($vo["id"]); ?></td><td><?php echo ($vo["name"]); ?></td><td><?php echo ($vo["up_user"]); ?></td><td><?php echo ($vo["up_date"]); ?></td>
    <?php switch($loginOk): case "1": ?><td><?php if(isset($vo["rightok"])): ?><a href="__URL__/item/<?php echo ($vo["id"]); ?>" target="_blank" style="color: red;" title="你可以查看该文件详情">详细信息</a><?php else: ?><a title="你不能查看该组别的文件详情">详细信息</a><?php endif; ?></td><?php break;?>
    <?php case "0": ?><td><a title="你没有足够权限查看详情，请登录">详细信息</a></td><?php break;?>
    <?php default: ?><td><a title="你没有足够权限查看详情，请登录">详细信息</a></td><?php endswitch;?>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

</table>