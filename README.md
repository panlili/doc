建立数据库。表cata（id，name，parents）  表doc（id，name，filepath，content，cata，up_date，up_user，stat(在用，停用)）   表user（id，username，truname，password，right，stat）  日志表log（id，op_type，op_user，op_doc，op_time）
建立thinkphp项目，并建立cata，doc，user的curd方法
系统首页用一个树来显示目录。右边是个资源列表，用表格的方式呈现。头部有一个搜索框，还有顶部logo，登录状态。
由于目录不多，可以考虑一次填充。当用户点击节点的时候，用一个变量来记载所点击接点对应的目录id，并把这个id发回，查询doc表中对应的记录，呈现出来。
点击记录表格中的记录，获取一个详细的资源页面，资源页面中提供下载链接。
用户以公共帐号登录，或者不登录，不能获取资源详细页面，没有提供下载链接。用户以给定账户登录，可以下载。
系统管理员登录，可以下载，还可以新建修改删除目录，修改文档描述信息等。
用户可以注册，注册后管理员批准。管理员可以让用户停用。