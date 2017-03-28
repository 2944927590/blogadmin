<?php
namespace Home\Controller;
use Think\Controller;
class BlogController extends BaseController {

	public function _initialize() {
		parent::_initialize();
	}

    public function getArticleByCategoryId() {
        $AD = D('ArticleDetail');
        $json = array(
            'status' => 1,
            'data' => array(
                'lists' => $AD -> getLists(I('categoryId'), I('pageNum'), I('pageLimit')),
                'listsCount' => $AD -> getListsCount(I('categoryId'), I('pageNum'), I('pageLimit'))
            ),
            'msg' => ''
        );
        $this->ajaxReturn($json);
    }

    public function getArticleBySearchText() {
        $AD = D('ArticleDetail');
        $json = array(
            'status' => 1,
            'data' => array(
                'lists' => $AD -> getListsBySearchText(I('searchTitle'), I('pageNum'), I('pageLimit')),
                'listsCount' => $AD -> getListsBySearchTextCount(I('searchTitle'), I('pageNum'), I('pageLimit'))
            ),
            'msg' => ''
        );
        $this->ajaxReturn($json);
    }

    public function getDetailById() {
        $AD = D('ArticleDetail');
        $json = array(
            'status' => 1,
            'data' => array(
                'lists' => $AD -> getDetailByDid(I('categoryId'), I('detailId'), false)
            ),
            'msg' => ''
        );
        $this->ajaxReturn($json);
    }

    public function getBroadcast() {
        $json = array(
            'status' => 1,
            'data' => array(
                'broadcast' => D('Broadcast') -> getContent()
            ),
            'msg' => ''
        );
        $this->ajaxReturn($json);
    }

    public function getUserInfo() {
        $json = array(
            'status' => 1,
            'data' => array(
                'userInfo' => D('User') -> getUser()
            ),
            'msg' => ''
        );
        $this->ajaxReturn($json);
    }

    public function getNewArticle() {
        $json = array(
            'status' => 1,
            'data' => array(
                'newArticle' => D('ArticleDetail') -> getNewArticle()
            ),
            'msg' => ''
        );
        $this -> ajaxReturn($json);
    }

    public function getHitsArticle() {
        $json = array(
            'status' => 1,
            'data' => array(
                'hitsArticle' => D('ArticleDetail') -> getHitsArticle()
            ),
            'msg' => ''
        );
        $this -> ajaxReturn($json);
    }

    public function getFriendLinks() {
        $json = array(
            'status' => 1,
            'data' => array(
                'friendLinks' => D('FriendLink') -> getFriendLinks()
            ),
            'msg' => ''
        );
        $this -> ajaxReturn($json);
    }
}



