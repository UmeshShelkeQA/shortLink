<?php
require "library.php";

session_start();
	
if(isset($_POST['signin']))
{

	$id;
	$email;
	$password;
	
	if(isset($_POST['email']) && isset($_POST['password']))
	{
		$email=$_POST['email'];
		$password=$_POST['password'];
		if(check_login($email,$password))
		{
			$id=check_login($email,$password);
			
			$_SESSION['user_id']=$id;
			
			if(isset($_SESSION['user_id']))
			{
				if(isset($_POST['remember-me']))
				{
					setCookie("user_id",$_SESSION['user_id']);
					setCookie("email","$email",(time()+60*60*24*30),"/");
					setCookie("password","$password",(time()+60*60*24*30),"/");
				}
				header("Location:dashboard.php");
			}else{
				echo"<script>alert('Please allow us to Store Cookie for the login you');
								window.location='login.html';				
					</script>";
			}
		}else{
			echo"<script>alert('Incorrect Combination of Email and Password.Please Try Again');
						window.location='login.html';
				</script>";
		}
		
	}
	
}
else{
	header("location:login.html");
}
?>