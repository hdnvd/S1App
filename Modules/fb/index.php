<?php

//In Order to update token goto:
//https://www.facebook.com/dialog/oauth?client_id=1665853310302237&redirect_uri=http://maragheh.tk/fb/token.php&state=458e212e9ee367a9da1060fabc8fe0c4&scope=publish_actions


//And then View The Access Token Here
//https://developers.facebook.com/tools/debug/accesstoken


//consumer_key:UserID
//consumer_secret:from App Page

 require_once("FacebookApi.php");
$access_token = 'CAAXrFbLOZBB0BADLQ5snW7uncggl519dUBsXfTKhQIdrLEWpkxEgSzBv1zglRK8vyPI78gyxNWhf35QEvpU35vsM8jGRg7I0UNXdnjveugpKP9WqgtjfgCuh8HCbcvbVZBLm58UErYHI6CNCSZBEFFaqZBppKSveqhha38iJNKwEls3deTDNV3eFkruFCn6FfFZC1r2zgMuNJh8kAh06d';
$facebookData = array();
$facebookData['consumer_key'] = '933712460022149';//
$facebookData['consumer_secret'] = '40beecc34f6b390ce48a4cca2fdaaef3';
 
$title = "Hi This Is My Test";
$targetUrl = "http://maragheh.tk";
$imgUrl = "";
$description = "This Is A Test:-)"; 
 $page="1602005616740984";
//$page="me";
$facebook = new FacebookApi($page,$facebookData);
$facebook->share($title, $targetUrl, $imgUrl, $description, $access_token);
echo "Posted to " . $page;
?>
