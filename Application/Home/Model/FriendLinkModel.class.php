<?php 
namespace Home\Model;
use Think\Model;
class FriendLinkModel extends BaseModel {

	public function getFriendLinks(){
		return $this -> where(array(
            'status' => 1
        )) -> field('name, url') -> order('create_time desc') -> limit(5) -> select();
	}
	
}