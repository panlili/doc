<?php

// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {

    /**
     * 生成树数组
     * @param  $data 从数据库出来select出来的数数组
     * @return  [{"id":1,"name":"Folder1", "children":[{"id":1,"name":"File1"}] }]
     * */
    public function treeArray($data, $p_id) {

        $tree = array();
        foreach ($data as $row) {
            if ($row['parents'] == $p_id) {
                $tmp = $this->treeArray($data, $row['id']);
                if ($tmp) {
                    $row['children'] = $tmp;
                } else {
                    $row['leaf'] = true;
                }
                $tree[] = $row;
            }
        }
        Return $tree;
//        return $result;
    }

    public function index() {
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $Cata = D('Cata');
        $catadata = $Cata->order("id desc")->select();
        $Docfile = D("Docfile");
        $filelist = $Docfile->order("up_date")->select();
        //dump($catadata);
        $tmp = new IndexAction();
        $catatmp = $tmp->treeArray($catadata, 0);
        $catatmp = json_encode($catatmp);
        //dump($catatmp);
        $this->assign("filelist", $filelist);
        $this->assign("catadata", $catatmp);
        $this->display();
    }

//接受首页用ajax方法传过来的目录id，根据目录id选择文件，然后列表返回给客户端
    public function filelist() {
        $Docfile = D("Docfile");
        // $cata_id=$_GET["cata_id"];
        $cata_id = $this->_param("cata_id");
        //return $cata_id;
        $filelist = $Docfile->where("cata_id=" . $cata_id)->select();
        if (is_null($filelist)) {
            $this->ajaxReturn("你所选择的目录下面没有文件", "调用不成功", 0);
        } else {

            $this->assign("filelist", $filelist);
            $result = $this->fetch("_filelist");
            $this->ajaxReturn($result, "调用成功！", 1);
        }
    }

}