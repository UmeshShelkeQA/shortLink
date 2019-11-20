<?php

require("library.php");
require("linkstat.php");


session_start();
$userArr=array();
$no_of_url;
if(!isset($_SESSION['user_id']))
{
	header("location:login.html");
}else{
	$obj=new LinkStat($_SESSION['user_id']);
	$userArr=$obj->ac_user_detail();
	$no_of_url=$obj->total_link();
	if(isset($_GET['long_url']))
	{
		$url=$_GET['long_url'];
		
		$ssid=$_SESSION['user_id'];
		if($no_of_url < $userArr['link_limit'])
			{
				$short_url=get_short_url(domain,$url,$ssid);
				echo $short_url;
			}else{
				echo"You Cannot Create No More SHORT URL. To Create More URL Upgrade Your Account/PACKAGE";
			}
	}

}


?>