<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocfileAction
 *
 * @author Administrator
 */
class DocfileAction extends Action {

    //put your code here
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
    }

    public function index() {
        $Cata = D('Cata');
        $catadata = $Cata->order("id desc")->select();
        $Docfile = D("Docfile");
        $filelist = $Docfile->order("up_date")->select();
        //dump($catadata);
        $tmp = new IndexAction();
        $catatmp = $tmp->treeArray($catadata,0);
        $catatmp = json_encode($catatmp);
        //dump($catatmp);
        $this->assign("filelist", $filelist);
        $this->assign("catadata", $catatmp);
        $this->display();
    }

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

    public function adddoc() {
        //判断当前目录
        $currentCata = session("currentCataId");
        $msg = session("action_message");
        $Cata = D('Cata');
        if (is_null($currentCata)) {
            $this->assign("currentCata", "根目录");
        } else {
            $this->assign("currentCata", session("currentCataName") . "<button type=\"button\" onclick=\"goroot()\">回到根目录</button>");
        }

        $catadata = $Cata->order("id desc")->select();
        $Docfile = D("Docfile");
        $filelist = $Docfile->order("up_date")->select();
        //dump($catadata);
        $tmp = new IndexAction();
        $catatmp = $tmp->treeArray($catadata,0);
        $catatmp = json_encode($catatmp);
        //dump($catatmp);"
        $this->assign("msg", $msg);
        $this->assign("filelist", $filelist);
        $this->assign("catadata", $catatmp);
        $this->display();
    }

    public function SetCurrentCata() {
        $tmp = $this->_param("cata_id");
        if ($tmp == 0) {
            session("currentCataId", null);
            session("currentCataName", null);
            $this->ajaxReturn("0", "调用成功！", 1);
        } else {
            session("currentCataId", $this->_param("cata_id"));
            session("currentCataName", $this->_param("cata_name"));
            $str = session("currentCataName") . "<button type=\"button\" onclick=\"goroot()\">回到根目录</button>";
            $this->ajaxReturn($str, "调用成功！", 1);
        }
//        
//        session("currentCata", $tmp);         
//        $this->ajaxReturn(0, "调用成功！", 1);
    }

    public function add() {
        //上传文件
        import('ORG.Net.UploadFile');
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 31457280; // 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg', 'doc', 'rar', 'docx', 'ppt'); // 设置附件上传类型
        $upload->savePath = './Public/Upload/'; // 设置附件上传目录
        if (!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        } else {// 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
        }
        //dump($info);


        $Docfile = D("Docfile");
        if ($Docfile->create()) {
            $Docfile->filepath = $info[0]['savename']; // 保存上传的照片根据需要自行组装
            if (is_null(session("currentCataId"))) {
                $Docfile->cata_id = 0;
            } else {
                $Docfile->cata_id = session("currentCataId");
            }

            $data = $Docfile->add();
            if (false !== $data) {
                session("action_message", "添加文档成功！可以添加下一个文档。");
                $this->redirect("docfile/adddoc");
            } else {
                session("action_message", "数据保存到数据库错误！");
                $this->redirect("docfile/adddoc");
            }
        } else {
            session("action_message", $User->getError());
            $this->redirect("docfile/adddoc");
        }
    }

    public function delete() {
        $id = $this->_post("id");
        $Docfile = D("Docfile");
        if (!isset($id)) {
            //如果不是通过点击连接，而是url传递，则$id为null
            $this->redirect("docfile/index");
        } else {
            $condition["id"] = $id;
            //$condition["right"] = array("neq", 9);
            if ($Docfile->where($condition)->delete()) {
                $this->ajaxReturn($id, "deleted!", 1);
            } else {
                $this->ajaxReturn(0, "something wrong!", 0);
            }
        }
    }

    public function edit() {
        $id = $this->_param(2);
        $Docfile=D("Docfile");
        $data=$Docfile->where("id=".$id)->select();
        $this->assign("docfile",$data);
        $this->display();
    }

    public function update() {
        $id = $this->_post("id");
        $Docfile = D("Docfile");
        if ($newdata = $Docfile->create()) {
            
            $data = $Docfile->save($newdata);
            if (false !== $data) {
                $this->redirect('docfile/index');
            } else {
                session("action_message", "更新数据时保存失败！");
                $this->redirect("docfile/index");
            }
        } else {
            session("action_message", $User->getError());
            $this->redirect("docfile/index");
        }
    }

}

?>
