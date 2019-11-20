
<?php
define("domain","http://localhost/shortLink/Project/");

require"dbconn.php";

//checking account is exist or not
function check_account($email)
{
	$conn=make_connection();
	
	$query="SELECT * FROM `account` WHERE email='$email'";
	
	$result=mysqli_query($conn,$query);
	
	if($result)
	{
		if($result->num_rows==1)
		{
			mysqli_free_result($result);
			close_connection();
			return true;
		}else{
			mysqli_free_result($result);
			close_connection();
			return false;
		}
	}
	else
	{
		close_connection();
		return false;
	}
}

//creating account of user
function create_account($name,$email,$password)
{
	
	if(!check_account($email))
	{
		$conn=make_connection();
		
		$date=date("Y-m-d",time());
		
		$query="INSERT INTO `account`(`name`, `email`, `password`, `no_of_url`, `date`) 
								VALUES ('$name','$email','$password',0,'$date')";
							
		$result=mysqli_query($conn,$query);
		
		if($result)
		{
			close_connection();
			return true;
		}
		else
		{
			close_connection();
			return false;
		}
	}
	else{
		return 0;
	}
}

//inserting the long url and short url in the database
function insert_url($long_url,$short_url,$ac_id)
{
	$conn=make_connection();
	
	
	$date=date("Y-m-d",time());
	
	$query="INSERT INTO `short_url`(`long_url`, `short_url`, `no_of_click`, `date`, `ac_id`) 
						VALUES ('$long_url','$short_url',0,'$date',$ac_id)";
	
	$result=mysqli_query($conn,$query);
	
	if($result)
	{
		$updateQuery="UPDATE `account` SET `no_of_url`=`no_of_url`+1 WHERE id=$ac_id";
		$updateResult=mysqli_query($conn,$updateQuery);
		close_connection();
		return true;
	}
	else
	{
		close_connection();
		return false;
	}
}

//update the click 
function update_click($link)
{
	$conn=make_connection();
	$query="UPDATE `short_url` SET `no_of_click`=`no_of_click`+1 WHERE `short_url`='$link'";
	$result=mysqli_query($conn,$query);
	
	if($result)
	{
		close_connection();
		return true;
	}
	else
	{
		close_connection();
		return false;
	}
}

//return the array which contain long_url,short_url and no_of_click
function each_link_click($ac_id)
{
	$link_array=array();
	
	$conn=make_connection();
	
	$query="SELECT * FROM short_url WHERE ac_id=$ac_id";
	
	$result=mysqli_query($conn,$query);
	if($result)
	{
		while($row=$result->fetch_assoc())
		{
			array_push($link_array,$row);
		}
		mysqli_free_result($result);
		close_connection();
		return $link_array;
	}
	else{	
		return 0;
	}
}


//checking login details return id or false
function check_login($email,$pass)
{
	$conn=make_connection();
	
	$query="SELECT id FROM account WHERE email='$email' and password='$pass'";
	
	$result=mysqli_query($conn,$query);
	if($result)
	{
		if($result->num_rows==0)
		{
			mysqli_free_result($result);
			close_connection();
			return false;
		}
		else
		{
			$row=mysqli_fetch_assoc($result);
			mysqli_free_result($result);
			close_connection();
			return $row['id'];
		}
	}else{
		close_connection();
		return false;
	}	

}


//checking the unique url id exist or not
function check_unique_id_exist($unique_id)
{
	$conn=make_connection();
	
	$query="SELECT `shid` FROM `short_url` WHERE `short_url`='$unique_id'";
	
	$result=mysqli_query($conn,$query);
	if($result)
	{
		if($row=mysqli_fetch_assoc($result))
		{
			close_connection();
			return true;//return true
		}
		else{
			close_connection();
			return false;//return false
		}
	}
	close_connection();
	return false;
}

//generating unique code for url
function generate_unique_id($start)
{
	$string="1234567890QWERTYUIOPLKJHGFDSAZXCVBNMaqwertyuioplkjhgfdszxcvbnm";
	$unique_id=$start;
	$n=7;
	while($n)
	{
		$unique_id=$unique_id.$string[rand(0,61)];
		$n--;
	}
	return $unique_id;
}

function custom_url($custom_url)
{
		$unique_id=$custom_url;
		if(check_unique_id_exist($unique_id))
		{
			return false;
		}else{
			return true;
		}
}

//create the custom short_url
function create_custom_url($domain,$long_url,$custom_url)
{
	$short_url;
	if(custom_url($custom_url))
	{
		$short_url=$custom_url;
		return $domain.$short_url;
	}
	else
		return null;
}

//creates the short_url
function create_short_url($domain,$long_url)
{
	$unique_id;
	for($i=0;$i<10;$i++)
	{
		$unique_id=generate_unique_id($i);
		if(check_unique_id_exist($unique_id))
		{
			
		}else{
			break;
		}
			
	}
	$domain=preg_replace("/[\/]$/","",$domain);
	//$short_url=$domain."/".$unique_id;
	$short_url=$unique_id;
	
	return $short_url;
}

//gives the short_url 
function get_short_url($domain,$long_url,$ac_id)
{
	$short_url=create_short_url($domain,$long_url);

	if(insert_url($long_url,$short_url,$ac_id))
	{
		$domain=preg_replace("/[\/]$/","",$domain);
		return $domain."/".$short_url;
	}
	else{
		return null;
	}
}

//gives the custom url
function get_custom_url($domain,$long_url,$custom_url,$ac_id)
{
	$short_url=create_custom_url($domain,$long_url,$custom_url);
	if($short_url!=null)
	{
		if(insert_url($long_url,$short_url,$ac_id))
		{
			return $short_url;
		}
		else{
			return null;
		}

	}else{
		return null;
	}
}

//gives the long_url
function get_long_url($short_url)
{
	$conn=make_connection();
	$query="SELECT `long_url`FROM `short_url` WHERE `short_url`='$short_url'";
	$result=mysqli_query($conn,$query);
	if($result)
	{

		if($result->num_rows == 1)
		{
			$row=mysqli_fetch_assoc($result);
			mysqli_free_result($result);
			close_connection();
			return $row['long_url'];
		}
	}else{
		close_connection();
		return null;
	}
}

//update or track on daily,monthly or yearly click/visitors on website
function update_ymd($link)
{
	$conn=make_connection();
	$str="";
	$updateYDM=date('ymd',strtotime('now'));
	$query="SELECT ymd FROM short_url WHERE `short_url`='$link'";
	//date flag if updateDMY is found in the DMYarr then it is set to 1 otherwise it is zero
	//if flag is zero then we have to add these with 1 click in the ymd colomn => format => yymmdd-click,
	$flag=0;
	$result=mysqli_query($conn,$query);
	if($result)
	{
		$row=mysqli_fetch_assoc($result);
		if($row!=null)
		{
			/*Algorithm refer => Link statistic algo photo*/
			if(!empty($row['ymd']))
			{
				
				
				$DMYarr=explode(',',$row['ymd']);
				foreach($DMYarr as $arr)
				{
					$ymd=explode('-',$arr);
					if(!empty($ymd[0]))
					{
						if($updateYDM==$ymd[0])
						{
							$flag=1;
							$ymd[1]++;
						}
						$str=$str.implode("-",$ymd).',';
					}
				
				}
				if($flag==0)
				{
					$str=$str.$updateYDM."-1,";
				}
				$query="UPDATE `short_url` SET `ymd`='$str' WHERE short_url='$link'";
				$result=mysqli_query($conn,$query);
				if($result)
				{
					close_connection();
					return true;
				}
				else{
					close_connection();
					return false;
				}
			}
			else{
				$updateDMY=$updateYDM."-1,";
				$query="UPDATE `short_url` SET `ymd`='$updateYDM' WHERE short_url='$link'";
				$result=mysqli_query($conn,$query);
				if($result)
				{
					close_connection();
					return true;
				}
				else{
					close_connection();
					return false;
				}
			}

		}
			
	}else{
		close_connection();
		return false;
	}
	
}

//detect the user device
function get_device()
{
	$device="";
	$width;
	echo"<script>var w=screen.availWidth;</script>";
	if(!preg_match("/mozilla/i",strtolower($_SERVER['HTTP_USER_AGENT'])))
	{
		return "bots";
	}else if(preg_match("/nuhk|googlebot|yammybot|openbot|slurp|cmsnbot|ia-archiver/i",$_SERVER['HTTP_USER_AGENT']))
	{
		return $device="bots";
	}else if(($width>550 && $width <960)||preg_match("/tablet/i",strtolower($_SERVER['HTTP_USER_AGENT'])))
	{
		return $device="tablet";
	}else if(($width>350 && $width <550) ||preg_match("/mobile/i",strtolower($_SERVER['HTTP_USER_AGENT'])) )
	{
		return $device="mobile";
	}else
		return $device="pc";
	
}
//update the mptb column in the stat tablet
function update_mptb($link)
{
	$conn=make_connection();
	$device=get_device();
	$updateMPTB="";
	$query="SELECT mptb FROM short_url WHERE `short_url`='$link'";
	$result=mysqli_query($conn,$query);
	if($result)
	{
		$row=mysqli_fetch_assoc($result);
		if($row!=null)
		{
			if(!empty($row['mptb']))
			{
				$arr=explode("-",$row['mptb']);//devices => arr[0]=mobile,arr[1]=pc,arr[2]=tablet,arr[3]=bots or other
				if($device=="mobile")
				{
					$arr[0]++;
				}else if($device=="pc")
				{
					$arr[1]++;
				}else if($device=="tablet")
				{
					$arr[2]++;
				}else if($device=="bots")
				{
					$arr[3]++;
				}
				$updateMPTB=implode('-',$arr);
				
			}
			else{
				$arr=array(0,0,0,0);
				if($device=="mobile")
				{
					$arr[0]++;
				}else if($device=="pc")
				{
					$arr[1]++;
				}else if($device=="tablet")
				{
					$arr[2]++;
				}else if($device=="bots")
				{
					$arr[3]++;
				}
				$updateMPTB=implode('-',$arr);
				
			}
			
			$query="UPDATE `short_url` SET `mptb`='$updateMPTB' WHERE `short_url`='$link'";
			$result=mysqli_query($conn,$query);
			if($result)
			{
				return true;
			}
			else
			{
				return false;
			}
	
		}else{
			return false;
		}
	}
	else{
		return false;
	}
}


	
?>



