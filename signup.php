<?php
require("library.php");
session_start();
if(isset($_POST['signup']))
{
	$name;$email;$password;
	//checking input is set or not
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) )
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		
		//checking Account is Exist or Not if Not Then Creating it
		
		if(create_account($name,$email,$password))
		{
			echo"<script>alert('Account created Successsfully.You can Sign-In Now');
						window.location='login.html';
				</script>";
		}else if(create_account($name,$email,$password)===false)//IF some reason Account Is Not Created Then  
		{
			echo"<script>alert('Something Went Wrong.Account Is Not Created.Try Again Later');
						window.location='login.html';
				</script>";
		}
		//IF Account Is Already Exist then
		else if(create_account($name,$email,$password)==0){		 
			echo"<script>alert('Account Already Exist.You can Sign-In');
						window.location='login.html';
				</script>";
		}
	}else{
		echo"<script>alert('Something Went Wrong');
						window.location='login.html';
				</script>";

	}
}else{
	header("location:login.html");
}
?>