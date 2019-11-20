<?php
require_once("dbconn.php");
session_start();

if(!isset($_SESSION['user_id']))
{
	header("location:login.html");
}


header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("config_paytm.php");
require_once("encdec_paytm.php");
$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
echo$_POST["CHECKSUMHASH"];
//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.



if($isValidChecksum == "TRUE") {
	//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		
		
		echo "<b>Transaction success</b>" . "<br/>";
			if(isset($_POST['ORDERID']))		
			{
				print_r($_POST);
					$ORDERID=$_POST['ORDERID'];
					$TXNID=$_POST['TXNID'];
					
					$TXNAMOUNT=$_POST['TXNAMOUNT'];
					$PAYMENTMODE =$_POST['PAYMENTMODE'];
					$TXNDATE =$_POST['TXNDATE'];
					$STATUS =$_POST['STATUS'];
					$RESPCODE =$_POST['RESPCODE'];
					$RESPMSG =$_POST['RESPMSG'];
					$CHECKSUMHASH =$_POST['CHECKSUMHASH'];
					$txn_query;
					if(isset($_SESSION['user_id']))
					{
						$ac_id=$_SESSION['user_id'];
						//echo "<br>Session".$ac_id;
						$txn_query="INSERT INTO `transaction`(`orderid`, `orderamount`, `referenceid`, `txstatus`, `paymentmode`, `txmsg`, `txtime`, `signature`,respcode,`ac_id`) VALUES 
															('$ORDERID',$TXNAMOUNT,'$TXNID','$STATUS','$PAYMENTMODE','$RESPMSG','$TXNDATE','$CHECKSUMHASH','$RESPCODE',$ac_id)";
					}
					$conn=make_connection();
					$result=mysqli_query($conn,$txn_query);
					if($result)
					{
						switch($RESPCODE)
						{
							case 1 :echo'<script>alert("Transaction Success ");</script>';
									if($TXNAMOUNT==350)
									{
										if(isset($_SESSION['user_id']))
										{
											$ac_id=$_SESSION['user_id'];
											$limit_query="UPDATE `account` SET `link_limit`=`link_limit`+400 WHERE id=$ac_id";
											$result=mysqli_query($conn,$limit_query);
										}
									}elseif($TXNAMOUNT==700)
									{
										if(isset($_SESSION['user_id']))
										{
											$ac_id=$_SESSION['user_id'];
											$limit_query="UPDATE `account` SET `link_limit`=`link_limit`+850 WHERE id=$ac_id";
											$result=mysqli_query($conn,$limit_query);
										}
									}elseif($TXNAMOUNT==1400)
									{
										if(isset($_SESSION['user_id']))
										{
											$ac_id=$_SESSION['user_id'];
											$limit_query="UPDATE `account` SET `link_limit`=`link_limit`+1800 WHERE id=$ac_id";
											$result=mysqli_query($conn,$limit_query);
										}
									}elseif($TXNAMOUNT==2800)
									{
										if(isset($_SESSION['user_id']))
										{
											$ac_id=$_SESSION['user_id'];
											$limit_query="UPDATE `account` SET `link_limit`=`link_limit`+4000 WHERE id=$ac_id";
											$result=mysqli_query($conn,$limit_query);
										}
									}
									header("location:profile.php");
									break;
							case 401 :echo'<script>alert("Transaction Failed : Your payment has been declined by your bank. Please contact your bank for any queries. If money has been deducted from your account, your bank will inform us within 48 hrs and we will refund the same");</script>';
									header("location:profile.php");
									break;
							case 402 :echo'<script>alert("Transaction Pending : PENDING	Looks like the payment is not complete. Please wait while we confirm the status with your bank");</script>';
									header("location:profile.php");
									break;
							case 810 :echo'<script>alert("Transaction Failed");</script>';
									header("location:profile.php");
									break;
							case 400 :echo'<script>alert("Transaction PENDING. Transaction status not confirmed yet");</script>';
									header("location:profile.php");
									break;
							case 334 :echo'<script>alert("Transaction Failed due to the server problem .Please Try Again");</script>';
									header("location:profile.php");
									break;
							case 295:echo'<script>alert("Transaction Failed. Your payment failed as the UPI ID entered is incorrect. Please try again by entering a valid VPA or use a different method to complete the payment.");</script>';
									header("location:profile.php");
									break;
							case 235:echo'<script>alert("Transaction Failed. Wallet balance Insufficient");</script>';
									header("location:profile.php");
									break;
							case 227:echo'<script>alert("Transaction Failed. Your payment has been declined by your bank. Please contact your bank for any queries. If money has been deducted from your account, your bank will inform us within 48 hrs and we will refund the same");</script>';
									header("location:profile.php");
									break;
							
						}
						close_connection();
					}
					else{
						echo'<script>alert("Transaction Failed");</script>';
						
					}
					echo"Please Take Screenshort Of the Following details<br>";
					echo "OrderId   :".$ORDERID."<br>";
					echo "TXNAMOUNT   :".$TXNAMOUNT."<br>";
					echo "TXNDATE  :".$TXNDATE."<br>";
					echo "TXNID  :".$TXNID."<br>";
					
			}
			//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<script>alert('Transaction Failed'); </script>" . "<br/>";
		echo "<b>Transaction Failed </b><br>";
		header("location:profile.php");
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
else {
	//echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
	
}

?>
<html>
<head>
</head>
<body>

</body>
</html>