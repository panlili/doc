<?php if (!defined('THINK_PATH')) exit();?><table class="common_table">
    <thead><th>序号</th><th>文件名</th><th>上传人</th><th>上传时间</th><th>详细信息</th></thead>
<?php if(is_array($filelist)): $i = 0; $__LIST__ = $filelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($vo["id"]); ?></td><td><?php echo ($vo["name"]); ?></td><td><?php echo ($vo["up_user"]); ?></td><td><?php echo ($vo["up_date"]); ?></td><td><a>详细信息</a></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>

</table>