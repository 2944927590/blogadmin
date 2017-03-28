<?php 
namespace Home\Model;
use Think\Model;
class BroadcastModel extends BaseModel {

	public function getContent(){
		
		return $this -> where(array(
            'status' => 1
        )) -> field('content') -> find();
		
	}
	
}