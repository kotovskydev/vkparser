<?php

ini_set('error_reporting', E_WARNING);
/**
 * 
 */
class main
{git
    public static function getSimilar($promt){
        $data = explode(',', $promt);
        $db = Db::Connection();
        $trimData = [];
        for ($i=0;$i < count($data); $i++){
            $strData = explode(' ', $data[$i]);
            for ($s=0;$s < count($strData); $s++){
                $trimData[] = trim($strData[$s]);
            }
        }
        $keywords_str = implode("%' OR promt LIKE '%", $trimData);
        $sql = "SELECT * FROM images WHERE images.promt LIKE '%".$keywords_str."%' ORDER BY rand()";

        $getSimilar = $db->prepare($sql);
        $getSimilar->execute();
        $images = $getSimilar->fetchAll(PDO::FETCH_BOTH);

        return $images;
    }
    public static function getPromt($url){
        $db = Db::Connection();

        $getPromt = $db->prepare("SELECT * FROM images WHERE url = :url");
        $getPromt->bindParam(':url',$url);
        $getPromt->execute();
        $promt = $getPromt->fetch(PDO::FETCH_BOTH);

        return $promt;
    }
	public static function getAllImages(){

        $db = Db::Connection();

        $getAllImages = $db->prepare("SELECT * FROM images ORDER BY id DESC");
        $getAllImages->execute();
        $images = $getAllImages->fetchAll(PDO::FETCH_BOTH);

        return $images;
	}

	public static function Logout(){

		
		session_destroy();

		header('Location: /');
		exit;
	}

}