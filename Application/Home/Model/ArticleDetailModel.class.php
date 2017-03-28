<?php
namespace Home\Model;
class ArticleDetailModel extends BaseModel {

	protected function _initialize() {
        $this->dbPrex = 'blog_';
		parent::_initialize();
	}

	public function getLists($categoryId, $pageNum, $pageLimit) {
		$result = $this -> alias('d')
			-> join($this->dbPrex.'article_category AS c ON d.category_id = c.id')
            -> join($this->dbPrex.'frame_file AS f ON d.file_id = f.id')
			-> where(array(
                'd.status' => array('eq', 1),
                'd.is_publish' => array('eq', 1),
                'd.category_id' => $categoryId ? $categoryId : array('gt', 0)
            )) -> page($pageNum, $pageLimit)
			-> field('d.id, d.title, d.create_time, d.hits, d.user_id, d.content, d.file_id, d.category_id, f.savepath, f.savename, c.name AS category')
			-> order('d.create_time desc')
			-> select();

		return $result;
	}

    public function getListsBySearchText($searchText, $pageNum, $pageLimit) {
        $result = $this -> alias('d')
            -> join($this->dbPrex.'article_category AS c ON d.category_id = c.id')
            -> join($this->dbPrex.'frame_file AS f ON d.file_id = f.id')
            -> where(array(
                'd.status' => array('eq', 1),
                'd.is_publish' => array('eq', 1),
                'd.title' => array('like', '%'.$searchText.'%')
            )) -> page($pageNum, $pageLimit)
            -> field('d.id, d.title, d.create_time, d.hits, d.user_id, d.content, d.file_id, d.category_id, f.savepath, f.savename, c.name AS category')
            -> order('d.create_time desc')
            -> select();

        return $result;
    }

    public function getListsBySearchTextCount($searchText, $pageNum, $pageLimit) {
        $result = $this 
            -> where(array(
                'status' => array('eq', 1),
                'is_publish' => array('eq', 1),
                'title' => array('like', '%'.$searchText.'%')
            )) -> count();
        return $result;
    }

    public function getListsCount($categoryId, $pageNum, $pageLimit) {
        $result = $this 
            -> where(array(
                'status' => array('eq', 1),
                'is_publish' => array('eq', 1),
                'category_id' => $categoryId ? $categoryId : array('gt', 0)
            )) -> count();
        return $result;
    }

    public function getDetailByDid($cId, $dId, $isEdit) {
        if ( !$isEdit ) {
            $this -> where(array(
                'id' => $dId,
                'status' => array('eq', 1),
                'is_publish' => array('eq', 1),
            )) -> setInc('hits');
        }

        $gtCount = $this -> where(array(
                'status' => array('eq', 1),
                'id' => array('gt', $dId),
                'category_id' => array('eq', $cId),
                'is_publish' => array('eq', 1),
            )) -> order('id desc') -> count();

        $record = $this -> alias('d')
            -> join($this -> dbPrex.'article_category AS c ON d.category_id = c.id')
            -> where(array(
                'd.status' => array('eq', 1),
                'd.category_id' => array('eq', $cId),
                'd.is_publish' => array('eq', 1),
            ))-> order('d.id desc')
            -> field('d.id, d.title, d.create_time, d.user_id, d.category_id, d.content, d.hits, c.name AS category')
            -> limit($gtCount ? $gtCount - 1 : $gtCount, $gtCount ? 3 : 2)
            -> select();

        $lists = array(
            'next' => $record[0],
            'current' => $record[1],
            'pre' => $record[2]
        );

        if ( !$gtCount ) {
            $lists['current'] = $record[0];
            $lists['pre'] = $record[1];
            $lists['next'] = null;
        }

        return $lists;
    }

    public function getNewArticle() {
        return $this -> where(array(
            'status' => array('eq', 1),
            'is_publish' => array('eq', 1),
        )) ->field('id, category_id, title') -> order('create_time desc') -> limit(5) -> select();
    }

    public function getHitsArticle() {
        return $this -> where(array(
            'status' => array('eq', 1),
            'is_publish' => array('eq', 1),
        )) ->field('id, category_id, title') -> order('hits desc') -> limit(5) -> select();
    }
}