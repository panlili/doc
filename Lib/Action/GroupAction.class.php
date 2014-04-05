<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupAction
 *
 * @author Administrator
 */
class GroupAction extends BaseAction {

    //put your code here
    public function index() {
        $Group = D('Group');
        import('ORG.Util.Page'); // 导入分页类
        //$userlist = $User->order("id desc")->select();
        $count = $Group->count();   // 查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count, 20); // 实例化分页类 传入总记录数
        $show = $Page->show(); // 分页显示输出
        // 进行分页数据查询
        $grouplist = $Group->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign("grouplist", $grouplist);
        ; // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出     
        $this->assign("true_name", session("truname"));


        $this->display();
    }

    public function newgroup() {
        $User = D("User");
        $user_list = $User->select();
        $this->assign("user_list", $user_list);
        $this->display();
    }

    public function add() {
        //$members=$_POST["members"];
        $g_name = $this->_param("g_name");
        $fail_date = $this->_param("fail_date");
        $g_content = $this->_param("g_content");
        $members = $this->_param("members"); //获取组中用户，存在数组中
        //dump($members);
        $Group = D("Group");
        $data["g_name"] = $g_name;
        $data["content"] = $g_content;
        $data["fail_date"] = $fail_date;
        $g_id = $Group->add($data);

        //将组与用户的对应添加到对应表
        $G_u = M("G_u");
        foreach ($members as $value) {
            $data1["g_id"] = $g_id;
            $data1["u_id"] = $value;
            $G_u->add($data1);
        }
        $this->redirect("group/index");
    }

    public function edit() {
        $Group = D("Group");
        $id = $this->_param(2);
        $g_item = $Group->where("id=" . $id)->find();
        //dump($g_item);
        $this->assign("g_name", $g_item["g_name"]);
        //$this->assign("g_name",5);
        $this->assign("content", $g_item["content"]);
        $this->assign("fail_date", $g_item["fail_date"]);
        $this->assign("g_id", $id);
        //填充用户组
        $User = D("User");
        $user_list = $User->select();

        $G_u = D("G_u");
        $g_u_list = $G_u->where("g_id=" . $id)->getField("u_id", true);
        //dump($g_u_list);
        foreach ($user_list as $key => $value) {
            if (in_array($value["id"], $g_u_list)) {
                $user_list[$key]["checked"] = "1";
            } else {
                // $user_list[$key]["checked"]="";
            }
        }
        //dump($user_list);

        $this->assign("user_list", $user_list);
        $this->display();
    }

    public function update() {
        //
        $id = $this->_param("g_id");
        $members = $this->_param("members");
        //dump($members);
        //dump($id);
        $Group = D("Group");
        //$Group->create();
        $data["g_name"] = $this->_param("g_name");
        $data["content"] = $this->_param("g_content");
        $data["fail_date"] = $this->_param("fail_date");
        //dump($Group);
        $Group->where("id=" . $id)->save($data);

        //更新对照表
        $G_u = M("G_u");
        $G_u->where("g_id=" . $id)->delete();
        foreach ($members as $value) {
            $data1["g_id"] = $id;
            $data1["u_id"] = $value;
            $G_u->add($data1);
        }
        $this->redirect("group/index");
    }

    public function delete() {
        $id = $this->_param("id");
        //dump($id);
        //$id=3;
        $Group = D("Group");
        $G_u = D("G_u");
        if (!isset($id)) {
            //如果不是通过点击连接，而是url传递，则$id为null
            $this->redirect("group/index");
        } else {
            $condition["id"] = $id;
            //$condition["right"] = array("neq", 9);
            if ($Group->where($condition)->delete()) {
                $condition1["g_id"] = $id;
                if ($G_u->where($condition1)->delete()) {
                    $this->ajaxReturn($id, "deleted!", 1);
                } else {
                    $this->ajaxReturn(0, "something wrong!", 0);
                }
            } else {
                $this->ajaxReturn(0, "something wrong!", 0);
            }
        }
    }

}

?>
