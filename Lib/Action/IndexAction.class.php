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
        if (session("loginOk") == 0 || is_null(session("loginOk"))) {
            //表示登录不成功
            $this->assign("loginOk", 0);
        } else {
            //登录成功
            $this->assign("loginOk", 1);
            $this->assign("true_name", session("truename"));
            $this->assign("user_right", session("right"));
        }
        $Cata = D('Cata');
        $catadata = $Cata->order("id desc")->select();
        $Docfile = D("Docfile");
        $filelist = $Docfile->order("id desc")->select();
        //dump($catadata);
        $tmp = new IndexAction();
        $catatmp = $tmp->treeArray($catadata, 0);
        $catatmp = json_encode($catatmp);
        //dump(session("u_group"));
        //获取当前登录用户所在的组
        $G_u = D("G_u");
        $g_list = $G_u->where("u_id=" . session("user_id"))->getField("g_id", true);
        $Group = D("Group");
        //dump($g_list);
        foreach ($filelist as $key => $value) {
            if (in_array($value["g_id"], $g_list)) {
                $data = $Group->where("id=" . $value["g_id"])->find();
                if ($data["fail_date"] >= date('Y-m-d')) {
                    $filelist[$key]["rightok"] = "1";
                } else {
                    $filelist[$key]["rightok"] = "2";
                }
            } else {
                // $user_list[$key]["checked"]="";
            }
        }
        //dump($filelist);

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
            //获取当前登录用户所在的组
            $G_u = D("G_u");
            $g_list = $G_u->where("u_id=" . session("user_id"))->getField("g_id", true);
            $Group = D("Group");
            //dump($g_list);
            foreach ($filelist as $key => $value) {
                if (in_array($value["g_id"], $g_list)) {
                    $data = $Group->where("id=" . $value["g_id"])->find();
                    if ($data["fail_date"] >= date('Y-m-d')) {
                        $filelist[$key]["rightok"] = "1";
                    } else {
                        $filelist[$key]["rightok"] = "2";
                    }
                } else {
                    // $user_list[$key]["checked"]="";
                }
            }
            $this->assign("loginOk", session("loginOk"));

            $this->assign("filelist", $filelist);
            $result = $this->fetch("_filelist");
            $this->ajaxReturn($result, "调用成功！", 1);
        }
    }

    public function checkUser() {

        //对用户验证
        $User = D('User');
        $username = $this->_post("username");
        $password = $this->_post("password");
        //use array for where will be more safe
        $condition["username"] = $username;
        $condition["password"] = $password;
        $condition["_logic"] = "AND";
        $result = $User->where($condition)->find();
        if ($result) {
            //if($result[""])
            $G_u = D("G_u");
            $U_group = $G_u->where("u_id=" . $result["id"])->getField("g_id", true);
            session("u_group", $U_group);
            session("username", $result["username"]);
            session("truename", $result["truename"]);
            session("right", $result["right"]);
            session("user_id", $result["id"]);
            session("loginOk", 1);
            //TODO: modify the first page to be enter
            $this->redirect("index/index");
        } else {
            session("loginOk", 0);
            $this->redirect("index/index");
        }
    }

    public function item() {
        if (is_null(session("right"))) {
            $this->redirect("index/index");
        } else {
            //获取当前登录用户所在的组
            $G_u = D("G_u");
            $g_list = $G_u->where("u_id=" . session("user_id"))->getField("g_id", true);
            $id = $this->_param(2);

            $Docfile = D("Docfile");
            $data = $Docfile->where("id=" . $id)->select();
            //dump($data);
            if (in_array($data[0]["g_id"], $g_list)) {
                $this->assign("docfile", $data);
                $this->assign("true_name", session("truename"));
                $this->assign("user_right", session("right"));
                $this->display();
            } else {
                // $user_list[$key]["checked"]="";
                $this->redirect("index/index");
            }
        }
    }

    public function logout() {
        //清除用户信息缓存

        session(null);
        session_destroy();
        $this->redirect("index/index");
    }

    public function search() {
        $search_key = $this->_post("search_key");
        if (session("loginOk") == 0 || is_null(session("loginOk"))) {
            //表示登录不成功
            $this->assign("loginOk", 0);
        } else {
            //登录成功
            $this->assign("loginOk", 1);
            $this->assign("true_name", session("truename"));
            $this->assign("user_right", session("right"));
        }
        $Docfile = D("Docfile");

        $condition["name"] = array("like", "%" . $search_key . "%");
        $condition["content"] = array("like", "%" . $search_key . "%");
        $condition['_logic'] = 'OR';

        $doc_list = $Docfile->where($condition)->select();
        //获取当前登录用户所在的组
        $G_u = D("G_u");
        $g_list = $G_u->where("u_id=" . session("user_id"))->getField("g_id", true);
        $Group = D("Group");
        //dump($g_list);
        foreach ($doc_list as $key => $value) {
            if (in_array($value["g_id"], $g_list)) {
                $data = $Group->where("id=" . $value["g_id"])->find();
                if ($data["fail_date"] >= date('Y-m-d')) {
                    $doc_list[$key]["rightok"] = "1";
                } else {
                    $doc_list[$key]["rightok"] = "2";
                }
            } else {
                // $user_list[$key]["checked"]="";
            }
        }
        $this->assign("doc_list", $doc_list);


//        import('ORG.Util.Page'); // 导入分页类
//        //$count = $Docfile->count();
//        $mapcount = $Docfile->where($condition)->count(); // 查询满足要求的总记录数
//        $Page = new Page($mapcount, 2); // 实例化分页类 传入总记录数和每页显示的记录数
////分页跳转的时候保证查询条件
//        foreach ($condition as $key => $val) {
//            $Page->parameter .= "$key=" . urlencode($val) . '&';
//        }
//        $show = $Page->show(); // 分页显示输出
//        $this->assign('page', $show);
        $this->display();
    }

    public function changepwd() {
        $this->assign("true_name", session("truename"));
        $this->assign("user_right", session("right"));
        $this->assign("user_id", session("user_id"));
        $this->display();
    }

    public function pwd() {
        $User = D("User");
        $id=  $this->_post("id");
        $pwd1 = $this->_post("password1");
        $pwd2 = $this->_post("password2");
        if ($pwd1 == $pwd2) {
            $data['password'] =$pwd1;
            $User->where("id=".$id)->save($data);
            $this->logout();
        } else {
            $this->assign("true_name", session("truename"));
            $this->assign("user_right", session("right"));
            $this->assign("user_id", session("user_id"));
            $this->assign("msg", "两次输入的密码不一致，请重新输入");
            $this->display("changepwd");
        }
    }

}