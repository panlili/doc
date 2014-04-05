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
class GroupAction extends Action{
    //put your code here
     public function index() {
        $Group = D('Group');
        import('ORG.Util.Page'); // 导入分页类
        //$userlist = $User->order("id desc")->select();
        $count = $Group->count();   // 查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,20); // 实例化分页类 传入总记录数
        $show = $Page->show(); // 分页显示输出
        // 进行分页数据查询
        $grouplist = $Group->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign("grouplist", $grouplist);
        ; // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出     
        $this->assign("true_name",session("truname"));


        $this->display();
    }
    public function newgroup(){
        $User=D("User");
        $user_list=$User->select();
        $this->assign("user_list",$user_list);
        $this->display();
    }
    public function edit(){
        $this->display();
    
    }
}

?>
