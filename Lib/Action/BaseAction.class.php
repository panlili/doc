<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseAction
 *
 * @author Administrator
 */
class BaseAction extends Action{
    //put your code here
    public function _initialize() {
        if (session("right")>1 || is_null(session("right")) )
            $this->redirect("index/index");
        
    }
}

?>
