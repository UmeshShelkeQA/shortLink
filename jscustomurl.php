<?php
require("library.php");
require("linkstat.php");
session_start();
$userArr;
if(!isset($_SESSION['user_id']))
{
	header("location:login.html");
	die;
}else{
	$obj=new LinkStat($_SESSION['user_id']);
	$userArr=$obj->ac_user_detail();
}

$short_url;
if(isset($_GET['long_url']))
{
	$url=$_GET['long_url'];
	$customurl=$_GET['custom_url'];
	
	$ssid=$_SESSION['user_id'];//user acccount id
	if(isset($_COOKIE['current_url']))
	{
		$checkurl=explode("/",$_COOKIE['current_url']);
		$size=sizeof($checkurl);
		if(preg_match("/$customurl/",$checkurl[$size-1]))
			echo "URL ALREADY CREATED";	
		else{
			$short_url=get_custom_url(domain,$url,$customurl,$ssid);
			if($short_url==null)
				echo "URL NOT AVAILABLE.TRY ANOTHER URL";
			else{
				echo $short_url;
				setCookie("current_url",$short_url);
			}
		}
	}else{
		$short_url=get_custom_url(domain,$url,$customurl,$ssid);
		if($short_url==null)
			echo "URL NOT AVAILABLE.TRY ANOTHER URL";
		else{
			echo $short_url;
			setCookie("current_url",$short_url);
		}
	}
	
}

?>