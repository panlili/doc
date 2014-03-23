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
class CataAction extends Action{
    //put your code here
     public function index() {
        $User = D('User');
        $userlist = $User->order("id desc")->select();
        $this->assign("userlist", $userlist);
        $this->display();
    }

    public function add() {
        $User = D("User");
        if ($User->create()) {
            $data = $User->add();
            if (false !== $data) {
                session("action_message", "添加用户成功！");
                $this->redirect("User/index");
            } else {
                session("action_message", "数据保存到数据库错误！");
                $this->redirect("User/index");
            }
        } else {
            session("action_message", $User->getError());
            $this->redirect("User/index");
        }
    }

    public function delete() {
        $id = $this->_post("id");
        $User = D("User");
        if (!isset($id)) {
            //如果不是通过点击连接，而是url传递，则$id为null
            $this->redirect("User/index");
        } else {
            $condition["id"] = $id;
            $condition["right"] = array("neq", 9);
            if ($User->where($condition)->delete()) {
                $this->ajaxReturn($id, "deleted!", 1);
            } else {
                $this->ajaxReturn(0, "something wrong!", 0);
            }
        }
    }

    public function edit() {
        $User = D("User");
        $truename = $this->_session("truename");
        $community = $this->_session("community");
        $current = $User->where(array("truename" => $truename, "community" => $community))->find();
        $this->assign("user", $current);
        $this->display();
    }

    public function update() {
        $id = $this->_post("id");
        $User = D("User");
        if ($newdata = $User->create()) {
            $newdata["password"] = md5($this->_post("password"));
            $data = $User->save($newdata);
            if (false !== $data) {
                $this->redirect('Login/logout');
            } else {
                session("action_message", "更新数据时保存失败！");
                $this->redirect("Map/index");
            }
        } else {
            session("action_message", $User->getError());
            $this->redirect("Map/index");
        }
    }
}

?>
