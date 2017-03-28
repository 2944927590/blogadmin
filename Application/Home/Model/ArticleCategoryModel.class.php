<?php 
namespace Home\Model;
use Think\Model;
use Home\Model\BaseModel;
class ArticleCategoryModel extends BaseModel {
	
	public function _initialize(){
		parent::_initialize();
	}
	public function nav(){
		$navs = $this->where(array(
            'status' => array('lt', 9),
            'index_show' => array('eq', 1),
        )) -> field('id, pid, name') ->order('rank desc') -> select();
		$arr = array();
		foreach ($navs as $v) {
			if(!$v['pid']) {
				$children = array();
				foreach ($navs as $n) {
					if($v['id'] == $n['pid']){
						$children[] = $n;
					}
				}
				$v['children'] = $children;
				$arr[] = $v;
			}
		}
		return $arr;
	} 
}
