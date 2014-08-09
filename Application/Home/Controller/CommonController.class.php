<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {

	public  $authId = 0;
	public function _initialize(){

/*		if(empty(session('loginId'))){

//			$this->error('请先登录');
//			$this->display('Public:login');
		}

		$this->authId = session('loginId');
	*/

	}
}