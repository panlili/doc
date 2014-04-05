<?php

class UserAction extends BaseAction {

    //put your code here
//    public function index(){
//        echo 'fuck';
//        $userlist=D("User");
//        dump($userlist);
//    }
    public function index() {
        $User = D('User');
        import('ORG.Util.Page'); // 导入分页类
        //$userlist = $User->order("id desc")->select();
        $count = $User->count();   // 查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,10); // 实例化分页类 传入总记录数
        $show = $Page->show(); // 分页显示输出
        // 进行分页数据查询
        $userlist = $User->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign("userlist", $userlist);
        ; // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出
        $this->assign("true_name",session("truname"));


        $this->display();
    }

    public function add() {
        $User = D("User");
        if ($User->create()) {
            $data = $User->add();
            if (false !== $data) {
                //添加用户时候默认属于id为1的组，该组为所有用户组。
                $G_u=D("G_u");
                $data1["g_id"]=1;
                $data1["u_id"]=$data;
                $G_u->add($data1);
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
        //dump($id);
        //$id=3;
        $User = D("User");
        if (!isset($id)) {
            //如果不是通过点击连接，而是url传递，则$id为null
            $this->redirect("User/index");
        } else {
            $condition["id"] = $id;
            //$condition["right"] = array("neq", 9);
            if ($User->where($condition)->delete()) {
                $G_u=D("G_u");
                $G_u->where("u_id=".$id)->delete();//删除掉g_u表中冗余数据
                $this->ajaxReturn($id, "deleted!", 1);
            } else {
                $this->ajaxReturn(0, "something wrong!", 0);
            }
        }
    }

    public function edit() {
        $User = D("User");
        $id = $this->_param(2);
        
        $data=$User->where("id=".$id)->select();
        $this->assign("userItem",$data);
        $this->assign("true_name",session("truname"));
        $this->display();
       
    }

    public function update() {
        $id = $this->_post("id");
        $User = D("User");
        if ($newdata = $User->create()) {
            //$newdata["password"] = md5($this->_post("password"));
            $data = $User->save($newdata);
            if (false !== $data) {
                $this->redirect('User/index');
            } else {
                //session("action_message", "更新数据时保存失败！");
                $this->redirect("User/index");
            }
        } else {
            //session("action_message", $User->getError());
            $this->redirect("User/index");
        }
    }
    
  

}

?>
