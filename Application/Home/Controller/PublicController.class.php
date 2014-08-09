<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function login(){

	   $this->display();

    }

    public function register(){

    	$this->display();
    }
    
    public function option(){

        $this->display();
    }
}