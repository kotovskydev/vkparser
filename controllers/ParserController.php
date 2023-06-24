<?php

include_once ROOT.'/models/parser.php';


class ParserController
{
    public function actionTest(){

        $html = [];
        $html = Parser::Test();
        var_dump($html);
        return true;
    }
	public function actionIndex() {
        $html = [];
        $html = Parser::addImg('https://vk.com/midjourney_ai');

		return true;
	}
}