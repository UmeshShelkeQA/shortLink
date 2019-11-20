<?php
require("library.php");
require("linkstat.php");

if(isset($_GET['long_url']))
{
	$url=$_GET['long_url'];
	//Checking user entered url is same as of previously entered url
	if(isset($_COOKIE["track"]))
	{
		if($_COOKIE['track']!=$url)
		{
			$short_url=get_short_url(domain,$url,1);
			echo $short_url;
			setCookie("track","$url");
			setCookie("shortUrl","$short_url");
		}
		else{
			if(isset($_COOKIE['shortUrl'])){
				$short_url=$_COOKIE['shortUrl'];
				echo $short_url;
			}
		}
	}else{
		$short_url=get_short_url(domain,$url,1);
		echo $short_url;
		setCookie("track","$url");
		setCookie("shortUrl","$short_url");
	}
}else
	echo"hello these error";

?>