<?php
$host="localhost";
$username="root";
$pass="";
$db="url_shortner";
$conn;

function make_connection()
{
	$GLOBALS['conn']=mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['pass'],$GLOBALS['db']);
	if($GLOBALS['conn'])
	{
		return $GLOBALS['conn'];
	}
	else
	{
		echo mysqli_connect_error();
		die;
	}
}
function close_connection()
{
	if(!empty($GLOBALS['conn']))
	{
		mysqli_close($GLOBALS['conn']);
	}
	return;
}
?>