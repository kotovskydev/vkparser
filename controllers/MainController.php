<?php

include_once ROOT.'/models/main.php';


class MainController
{

	public function actionIndex() {

        $images = [];
        $images = Main::getAllImages();
        require_once(ROOT.'/views/index/index.php');
		return true;
	}

    public function actionPromt($url){

        $images = [];
        $images = Main::getAllImages();
        $img = [];
        $img = Main::getPromt($url);
        preg_match_all('|—(.+?)$|', $img['promt'], $matches);
        if (isset($matches[0][0])){
            $keywords = trim(str_replace($matches[0][0], '', str_replace("'", "", $img['promt'])));
        }else{
            $keywords = str_replace("'", "", $img['promt']);
        }
        $similar = [];
        $similar = Main::getSimilar($keywords);
        $title = ucfirst(trim(mb_strimwidth($keywords, 0, 50)).'...');
        require_once(ROOT.'/views/image/index.php');
        return true;
    }
//	public function actionCreate(){
//
//		$createItem = array();
//		$createItem = Admin::createItem($_POST);
//		print_r($createItem);
//
//		return true;
//	}
}