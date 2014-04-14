<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CataAction
 *
 * @author Administrator
 */
class CataAction extends BaseAction {

    //put your code here
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
        $currentCata = session("currentCataId");
        $msg = session("action_message1");
        $Cata = D('Cata');
        if (is_null($currentCata)) {
            $this->assign("currentCata", "根目录");
            $this->assign("cataName",  "根目录");
        } else {
            $this->assign("currentCata", session("currentCataName") . "<button type=\"button\" onclick=\"goroot()\">回到根目录</button>");
            $this->assign("cataName",  session("currentCataName"));
        }

        $catadata = $Cata->order("id desc")->select();
        //dump($catadata);
        $tmp = new IndexAction();
        $catatmp = $tmp->treeArray($catadata,0);
        $catatmp = json_encode($catatmp);
        //dump($catatmp);""
        
        $this->assign("msg", $msg);
        $this->assign("catadata", $catatmp);
        $this->assign("true_name",session("truename"));
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
            $str = session("currentCataName") . "<input type=\"button\" onclick=\"goroot()\" value=\"回到根目录\" />";
            $this->ajaxReturn($str, "调用成功！", 1);
        }
//        
//        session("currentCata", $tmp);         
//        $this->ajaxReturn(0, "调用成功！", 1);
    }

    public function add() {
        $Cata = D("Cata");
        if ($Cata->create()) {

            if (is_null(session("currentCataId"))) {
                $Cata->parents = 0;
            } else {
                $Cata->parents = session("currentCataId");
            }
            $data = $Cata->add();
            if (false !== $data) {
                session("action_message1", "添加目录成功！");
                $this->redirect("Cata/index");
            } else {
                session("action_message1", "数据保存到数据库错误！");
                $this->redirect("Cata/index");
            }
        } else {
            session("action_message1", $Cata->getError());
            $this->redirect("Cata/index");
        }
    }

    public function delete() {
        if (is_null(session("currentCataId"))) {
            session("action_message1", "不能删除根目录！");
            $this->redirect("Cata/index");
        } else {
            $id = session("currentCataId");
            $Cata = D("Cata");


            $condition["id"] = $id;

            if ($Cata->where($condition)->delete()) {
                session("currentCataId", null);
                session("action_message1", "目录已经删除，跳转到根目录！");
                $this->redirect("Cata/index");
            } else {
                session("action_message1", "系统错误！");
                $this->redirect("Cata/index");
            }
        }
    }

    public function edit() {
        if (is_null(session("currentCataId"))) {
            session("action_message1", "不能编辑根目录！");
            $this->redirect("Cata/index");
        } else {
            $id = session("currentCataId");
            $Cata = D("Cata");
            $Cata->where('id=' . $id)->setField('name', $_POST["name"]);
            session("action_message", "更新数据成功！");
            $this->redirect("Cata/index");

        }
    }

}

?>
