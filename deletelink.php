<?php
require("dbconn.php");
$conn=make_connection();

if(isset($_GET['shortlink'])&& isset($_GET['ac_id']))
{
	$shortArr=explode("/",$_GET['shortlink']);//in the form of => http://domain_name/short_url_id
	$size=sizeof($shortArr);
	if($size >=2)
	{		
		$size=$size-1;
		$short_url=$shortArr[$size];
		$ac_id=$_GET['ac_id'];
		$query="DELETE FROM `short_url` WHERE short_url='$short_url' and ac_id=$ac_id";
		$result=mysqli_query($conn,$query);
		if($result)
		{
			$query="UPDATE `account` SET `no_of_url`=`no_of_url`-1 WHERE id=$ac_id";
			$result=mysqli_query($conn,$query);
			if($result)
				echo "<script>alert('link deleted');</script>";
		}else{
			echo "<script>alert('link Not deleted');</script>";
		}
	}
}
close_connection();
?>