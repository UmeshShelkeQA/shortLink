<?php
$host="localhost";
$username="root";
$pass="";
$db="test";
$conn=mysqli_connect($host,$username,$pass,$db);
if($conn)
{
	$s1='';$s2='';$s3='';
	if(isset($_POST['name']))
		$s1=$_POST['name'];
	if(isset($_POST['email']))
		$s2=$_POST['email'];
	if(isset($_POST['addr']))
		$s3=$_POST['addr'];
	
		$query="INSERT INTO `test`(`name`, `addr`, `email`) VALUES ('$s1','$s2','$s3')";
		$result=mysqli_query($conn,$query);
		//2831
	
}
?>