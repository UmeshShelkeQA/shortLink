
 <?php
 
 require("dbconn.php");
 if(isset($_POST['submit']))
 {
		$conn=make_connection();
		$name=$_POST['name'];
		$email=$_POST['email'];
		$query="INSERT INTO `fg_password`(`name`, `email`) VALUES ('$name','$email')";
		$result=mysqli_query($conn,$query);
		if($result)
		{
			//E-MAIL SUBMITED SUCCESSFULL.WE WILL SEND NEW PASSWORD IN YOUR E-MAIL WITHING 2-3 HOURSE
			echo'<script>alert("E-MAIL SUBMITED SUCCESSFULL.WE WILL SEND NEW PASSWORD IN YOUR E-MAIL WITHIN 1-2 DAY");</script>';
		}
		else{
			echo'<script>alert("Something Went Wrong");</script>';
		}
		close_connection();
}
 
 
 ?>

<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.0, #m -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/jellyfish-122x92.jpg" type="image/x-icon">
  <meta name="Create New Link" content="Create New custom link to attract more customer/visitor to your website using our powerfull link shortner tool">
  
  <title>FORGOT PASSWORD</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/datatables/data-tables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  <style>
  .formbg{
	  background:#df4125;
  }
  		.inp{
	width: 80%;
	margin-left: 10%;
	margin-right: 10%;
	padding: 10px;
	margin-bottom: 5px;
	margin-top: 3%;
	border:2px solid #dc143c;
	border-radius: 5px;
	font-weight: bold;
	border-right: 20px solid #dc143c;
	border-left: 20px solid #dc143c;
	color: navy;
	}
		.sub-btn
	{
	width: 25%;
	padding: 10px;
	margin-top: 5px;
	margin-left:37.5%;
	margin-right:37.5%;
	border:none;
	border-radius: 5px;
	background:linear-gradient(#dc133c,#800000);
	font-weight: bold;
	font-size:100%;
	color: navy;
	
	}
	.sub-btn-copy
	{
	width: 25%;
	padding: 10px;
	margin-top: 5px;
	margin-left:37.5%;
	margin-right:37.5%;
	border:none;
	border-radius: 5px;
	background:linear-gradient(#dc133c,#800000);
	font-weight: bold;
	font-size:100%;
	color: navy;
	
	}
  </style>
  
  
</head>
<body style="background:#df4125">

  <section class="menu cid-rxDDrIeH25" once="menu" id="menu1-5">

    

    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    
                         <img src="assets/images/jellyfish-122x92.jpg" alt="Mobirise" title="" style="height: 3.8rem;">
                    
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="#">
                        URL SHORTNER</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true"><li class="nav-item"><a class="nav-link link text-white display-4" href="#">&nbsp; &nbsp; &nbsp;</a></li><li class="nav-item"><a class="nav-link link text-white display-4" href="#">About Us
                    </a></li><li class="nav-item"><a class="nav-link link text-white display-4" href="contact_us.php">Contact Us</a></li><li class="nav-item"><a class="nav-link link text-white display-4" href="login.php">Sing Up</a></li><li class="nav-item">
                    <a class="nav-link link text-white display-4" href="login.php"><span class="mbri-user mbr-iconfont mbr-iconfont-btn">Sign-In</span></a>
                </li></ul>
            
        </div>
    </nav>
</section>
<section class="engine"></section>
<section class="features4 cid-rzCjScTTpw" id="features4-k">
  
 <div >
	<center><h1 style="font-size:400%;color:white;font-style:italic">SEND MESSAGE</h1></center>
 </div>

<div class="formbg">
	<form action="" method="POST" onsubmit="return(checkField())">
	
	<input type="text" name="name" class="inp" id="name" placeholder="Enter Your Registered Name" ><br><br>
	<input type="email" name="email" class="inp" id="email" placeholder="Enter Your Registered Email-ID" ><br><br>
	<input type="submit" name="submit" value="SUBMIT DATA" onclick="checkField()"class="sub-btn">
	  
</div>
</section>

<section class="mbr-section article content10 cid-rzClX7G6DI" id="content10-m" style="background:#df4125;margin-bottom:5px;width:10%;">
    <div class="container">
		<hr class="line" style="width: 10%;">
    </div>
<script>
	function checkField(){
		var name = document.getElementById("name").value;
		var email = document.getElementById("email").value;
		
		if(name==''||email==''){
			if(name==''){
				alert("PLEASE Enter Your Register Name");
			}else{
				alert("PLEASE Enter Your Register Email-ID Address");
			}
			return false;
		}else{
			return true;
		}
		
	}
</script>

 <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/datatables/jquery.data-tables.min.js"></script>
  <script src="assets/datatables/data-tables.bootstrap4.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
</body>
</html>