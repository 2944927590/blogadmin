<?php 
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
	public function _initialize() {
        header('Access-Control-Allow-Origin: *');
	}

	public function _404($test){
		if($test) $this->error(404);
	}
}

?>