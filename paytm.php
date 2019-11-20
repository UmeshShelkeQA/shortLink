<?php
require "connect.php";



header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once "lib/config_paytm.php";
require_once "lib/encdec_paytm.php";

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		
		
		echo "<b>Transaction success</b>" . "<br/>";
			if(isset($_POST['ORDERID']))		
			{
					$ORDERID=$_POST['ORDERID'];
					$TXNID=$_POST['TXNID'];
					
					$TXNAMOUNT=$_POST['TXNAMOUNT'];
					$PAYMENTMODE =$_POST['PAYMENTMODE'];
					$TXNDATE =$_POST['TXNDATE'];
					$STATUS =$_POST['STATUS'];
					$RESPCODE =$_POST['RESPCODE'];
					$RESPMSG =$_POST['RESPMSG'];
					$CHECKSUMHASH =$_POST['CHECKSUMHASH'];
					$txn_query="INSERT INTO `paytm_txn`(`ORDERID`, `TXNID`, `TXNAMOUNT`, `TXNDATE`, `PAYMENTMODE`, `STATUS`, `RESPCODE`, `RESPMSG`, `CHECKSUMHASH`) VALUES ('$ORDERID','$TXNID',$TXNAMOUNT,'$TXNDATE','$PAYMENTMODE','$STATUS',$RESPCODE ,'$RESPMSG','$CHECKSUMHASH')";
					$result=mysqli_query($conn,$txn_query);
					if($result)
					{
						echo'<script>alert("Transaction Success & Transaction Stored");</script>';
					}
					else{
						echo'<script>alert("Transaction Not Stored");</script>';
					}
					echo"Please Take Screenshort Of the Following details<br>";
					echo "OrderId   :".$ORDERID."<br>";
					echo "TXNAMOUNT   :".$TXNAMOUNT."Rs<br>";
					echo "TXNDATE  :".$TXNDATE."<br>";
					echo "TXNID  :".$TXNID."<br>";
			}
			//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<script>alert('Transaction Failed'); </script>" . "<br/>";
		echo "<b>Transaction Failed </b><br>";
		
		die;
	}

/*
	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	
*/
}
else{
	//echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
    //opening orderid.txt file for inserting order id
				
	echo '<h1>Somthing went wrong......</h1>';					
    
}



?>
<html>
<head>
<style>
	/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  
}
.tabcontent {
  animation: fadeEffect 1s; /* Fading effect takes 1 second */
}

/* Go from zero to full opacity */
@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

.inp{
width: 100%;
padding: 10px;
margin-bottom: 5px;
margin-top: 3px;
border:2px solid #dc143c;
border-radius: 5px;
font-weight: bold;
border-right: 20px solid #dc143c;
border-left: 20px solid #dc143c;
color: navy;
}
.sub-btn:hover
{
background:linear-gradient(#800000,#dc133c);
}
.sub-btn
{
width: 100%;
padding: 10px;
margin-top: 5px;
border:none;
border-radius: 5px;
background:linear-gradient(#dc133c,#800000);
font-weight: bold;
font-size:100%;
color: navy;
}
</style>
</head>
<body>
<form action="register.php" method="POST">



<script>
	function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
  <center><h1>Registration Form</h1></center>
  
  <h2>PayMent Information <h4>(Choose Option To Receive Your Payment/Reward)</h4></h2>
  <!-- Tab links -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')"><h1>PayTm </h1></button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')"> <h1> Bank </h1></button>
</div>

<!-- Tab content -->
<div id="London" class="tabcontent">
  <h3>Enter PayTm Number</h3>
  <input type="phone" name="paytm" class="inp">
</div>

<div id="Tokyo" class="tabcontent">
  <h3>Enter Bank Details</h3>
  <label>Enter Account Holder Name</label><br>
  <input type="text" name="ac_name" class="inp"><br><br>
  <label>Enter Account Number</label><br>
  <input type="numeric" name="acno" class="inp"><br><br>
  <label>Enter IFSC code</label><br>
  <input type="text" name="ifsc" class="inp"><br><br>
</div>



	<h3>Enter Your Full Name</h3>
  <input type="text" name="name" class="inp" required placeholder="Enter Your Full Name"><br><br>
  
  <h3>Enter Your Email</h3>
  <input type="email" name="email" class="inp" required placeholder="Enter Your Email"><br><br>
 
  <h3>Enter Whatsapp Number</h3>
  <input type="phone" name="whatsapp_number" class="inp" required placeholder="Enter Whatsapp Number"><br><br>
  
  <h3>Enter Todays Date</h3>
  <input type="date" name="date" class="inp" required placeholder="yyyy-mm-dd"><br><br>
  
  <h2>Player Information</h2>
  <h3>Enter Your Pubg-Username</h3>
  <input type="text" name="pubg_username" class="inp" placeholder="Enter Your Pubg Username" required><br><br>

  

<div class="main">
<input type="submit" name="submit" value="REGISTER" class="sub-btn">
</div>
</form>
<?php
	if(isset($_POST['submit']))
	{
			$date=$_POST['date'];
			$name=$_POST['name'];
			$email=$_POST['email'];
			$whatsapp_number=$_POST['whatsapp_number'];
			$pubg_username=$_POST['pubg_username'];
			$paytm=$_POST['paytm'];
			$ac_name=$_POST['ac_name'];
			$acno=$_POST['acno'];
			$ifsc=$_POST['ifsc'];
		if($paytm!=0 && isset($_POST['paytm']) && isset($_POST['date']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['whatsapp_number']) && isset($_POST['pubg_username']))
		{
			//if paytm is selected as a payment option
			
			//opening orderid.txt file for inserting order id
			$file=fopen("orderid.txt",'r');
			$orderid=fread($file,filesize("orderid.txt"));
			fclose($file);
			
			
			$query="INSERT INTO `player`(`name`, `email`, `whatsapp_number`, `pubg_username`, `date`, `paytm`,orderid) VALUES ('$name','$email',$whatsapp_number,'$pubg_username','$date',$paytm,$orderid)";
			//$query="INSERT INTO `player`(`name`, `email`, `whatsapp_number`, `pubg_username`, `date`, `paytm`,`orderid`) VALUES ('$name','$email',$whatsapp_number,'$pubg_username','$date',$paytm,$orderid)";
			$result=mysqli_query($conn,$query);
			if($result)
			{
				//inserting Rocord Into Kills Table
				
				$q="INSERT INTO `kills`(`pubg_username`) VALUES ('$pubg_username')";//iserting username in kills table
				$r=mysqli_query($conn,$q);
				
				//inserting Record Into User Table
				$user="INSERT INTO `user`(`name`, `email`, `whatsapp_number`) VALUES ('$name','$email',$whatsapp_number)";
				$insert=$r=mysqli_query($conn,$user);
				
				echo'<script>alert("Registration Done Successfully.You Can Close This Window Now");self.close();</script>';
				echo'<script>window.open("http://tournamentzone.in/","_parent");</script>';
			}
			else{
				echo'<script>alert("Registration Failed .please try Again");</script>';
			}
		}
		elseif(isset($_POST['ac_name']) && isset($_POST['acno']) && isset($_POST['ifsc']) && isset($_POST['date']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['whatsapp_number']) && isset($_POST['pubg_username']) ){
		
			//if bank is selected as a payment option
			
			//opening orderid.txt file for inserting order id
			$file=fopen("orderid.txt",'r');
			$orderid=fread($file,filesize("orderid.txt"));
			fclose($file);
			
			$Q="INSERT INTO `player`(`name`, `email`, `whatsapp_number`, `pubg_username`, `date`,`ac_name`, `acno`, `ifsc`,orderid) VALUES ('$name','$email',$whatsapp_number,'$pubg_username','$date','$ac_name',$acno,'$ifsc',$orderid)";
			$R=mysqli_query($conn,$Q);
			if($R)
			{
				//inserting Rocord Into Kills Table
				
				$q="INSERT INTO `kills`(`pubg_username`) VALUES ('$pubg_username')";//iserting username in kills table
				$r=mysqli_query($conn,$q);
				
				//inserting Record Into User Table
				$user="INSERT INTO `user`(`name`, `email`, `whatsapp_number`) VALUES ('$name','$email',$whatsapp_number)";
				$insert=mysqli_query($conn,$user);
				
				echo'<script>alert("Registration Done Successfully.You Can Close This Window Now");self.close();</script>';
				echo'<script>window.open("http://tournamentzone.in/","_parent");</script>';
			
			}
			else{
				echo'<script>alert("Registration Failed.Please Try Again Later");</script>';
			}
		}
	}
?>
</body>
</html>