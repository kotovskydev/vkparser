<?php

ini_set('error_reporting', E_WARNING);
/**
 * 
 */
class Parser
{

    public static function test(){
        $html = Parser::parseHtml('https://prompthero.com');

        return $html;
    }

    /**
     * @param $url
     * @return array
     */
    public static function addImg($url){
        $db = Db::Connection();
        $data = Parser::getPosts($url);

        foreach($data as $post){
            foreach($post as $img){
                for ($i = 0; $i < count($img); $i++){
                    list($width, $height, $type, $attr) = getimagesize($img[$i]['img']);

                    $ratio = ($width / $height);
                    try{
                        $url = ('img'.rand(100000,999999));
                        $getUser = $db->prepare("INSERT INTO images (`promt`,`img`,`url`, `ratio`,`vkurl`) VALUES (:promt, :img, :url, :ratio, :vkurl)");
                        $getUser->bindParam(':promt',strip_tags(mb_substr(str_replace('Показать ещё',', ', $img[$i]["promt"]), 2)));
                        $getUser->bindParam(':img',$img[$i]['img']);
                        $getUser->bindParam(':url',$url);
                        $getUser->bindParam(':ratio',$ratio);
                        $getUser->bindParam(':vkurl',$img[$i]['vkurl']);
                        $getUser->execute();
                       
                    }catch (Exception $e){

                    }


                }
//

            }
        }

        return $data;
    }
    public static function getPosts($url){

        $html = Parser::parseHtml($url);

        $dom = new DOMDocument('4.0', 'UTF-8');
        $dom->loadHtml(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_NOERROR);
        $finder = new DOMXpath($dom);

        $postNodes = $finder->query(".//div[contains(@class, 'wall_posts own mark_top')]//div[contains(@class, '_post_content')]");
        $promts = $finder->query(".//div[contains(@class, 'wall_posts own mark_top')]//div[contains(@class, 'wall_post_text')]");
        $images = $finder->query(".//div[contains(@class, 'wall_posts own mark_top')]//div[contains(@class, 'MediaGridContainerWeb--post')]");
        $base = [];
        $i=0;
        foreach ($postNodes as $post){

            $htmlString = $dom->saveHTML($promts->item($i));
            //$data[$i]['html'] = $htmlString;
            $htmlString = str_replace('<div class="wall_post_text">','', $htmlString);
            $htmlString = str_replace('</div>','', $htmlString);
            $htmlString = explode('<br><br>', $htmlString);

            $base[$i]['promts'] = $htmlString;
            $imageHtmlString = $dom->saveHTML($images->item($i));
            $imageHtmlString = str_replace('<div class="wall_post_text">','', $imageHtmlString);
            $imageHtmlString = str_replace('</div>','', $imageHtmlString);
            $imageHtmlString = explode('<br><br>', $imageHtmlString);



            preg_match_all("|data-photo-id=\"([\s\S]+?)\"|", $imageHtmlString[0], $matchers);

            preg_match_all("|class=\"MediaGrid__imageElement\" src=\"([\s\S]+?)\"|", $imageHtmlString[0], $matches);


                for ($p=0; $p < 5; $p++){
                    $pos = strpos($base[$i]['promts'][$p], '<!DOCTYPE html>');
                    if ($pos === false){
                        if (isset($matches[1][$p])){
                            $data[$i]['post'][$p]['promt'] = $base[$i]['promts'][$p];
                            $data[$i]['post'][$p]['img'] = str_replace("&amp;","&", $matches[1][$p]);
                            $data[$i]['post'][$p]['vkurl'] = $matchers[1][$p];
                        }

                    }
                }



//            https://sun9-26.userapi.com/impg/IKh3x2s2hdZN0OTjiTrZYjcpq0OpEuhAynsz_w/4F-nC8VGnks.jpg?size=338x604&quality=95&sign=56e482929c09d2cbffb373389a1f4586&c_uniq_tag=NN-8GdKjRd0vuqk6UnErw-IYEpDdhbAWIEuYjNiIyZc&type=album
//            https://sun9-26.userapi.com/impg/IKh3x2s2hdZN0OTjiTrZYjcpq0OpEuhAynsz_w/4F-nC8VGnks.jpg?size=338x604&amp;quality=95&amp;sign=56e482929c09d2cbffb373389a1f4586&amp;c_uniq_tag=NN-8GdKjRd0vuqk6UnErw-IYEpDdhbAWIEuYjNiIyZc&amp;type=album
            $i++;
        }



        return $data;

    }
    public static function parseHtml($url){



        $curl = curl_init($url);
        $userAgent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36';
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_ENCODING ,"");

        $html = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $isWinCharset = mb_check_encoding($html, "windows-1251");
        if ($isWinCharset) {
            $postResult = iconv("windows-1251", "UTF-8", $html);
        }

        return $postResult;


    }
	public static function getUser($userid,$password){

		if (!empty($userid)) {

			$db = Db::Connection();

			$getUser = $db->prepare("SELECT * FROM users WHERE users.userid = :userid");
			$getUser->bindParam(':userid',$_POST['userid']);
			$getUser->execute();
			$user = $getUser->fetch(PDO::FETCH_BOTH);

			if (!empty($user['userid'])) {
				if ($user['password'] == $_POST['password']) {
					$_SESSION['userid'] = $_POST['userid'];
					$resp = 'Success';

				}else{
					$resp = 'Логин или пароль указанны неверно.';
				}

			}else{
				$resp = 'Данный пользователь не найден';
			}



			return $resp;
		}
	}

	public static function Auth($data){

		if (!empty($data)) {

			$db = Db::Connection();

			$getUser = $db->prepare("SELECT * FROM users WHERE users.userid = :userid");
			$getUser->bindParam(':userid',$data['userid']);
			$getUser->execute();
			$user = $getUser->fetch(PDO::FETCH_BOTH);


			if ($user['password'] == $data['password']) {
				$_SESSION['userid'] = $data['userid'];
				print_r('success');
			}else{
				print_r('Логин или пароль указанны неверно.');
			}
			return $user;
		}
	}

	public static function Logout(){


		session_destroy();

		header('Location: /');
		exit;
	}

}