<?php
namespace Home\Controller;
use Think\Controller;
class NavController extends BaseController {
    public function _initialize() {
        parent::_initialize();
    }
    public function getNav() {
        $json = array (
            'status' => 1,
            'data' => D('ArticleCategory')->nav(),
            'msg' => ''
        );
        $this->ajaxReturn($json);
    }
}



