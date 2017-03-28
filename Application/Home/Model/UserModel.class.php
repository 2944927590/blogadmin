<?php 
namespace Home\Model;

class UserModel extends BaseModel {

    public function getUser() {
        return $this -> where(array(
            'status' => array('eq', 1)
        ))
        ->field('name, sex, user_no, hometown, email, github')
        -> find();
    }

}
