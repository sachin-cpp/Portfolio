<?php
try{

	//require_once('db_config.php');
 //$ip=$_GET['ip'];
 $statusCode='';
 $ipAddress='';
 $countryCode='';
 $countryName='';
 $regionName='';
 $zipCode='';
 $latitude='';
 $longitude='';
 $timeZone='';
 $time='';
 //$apikey='UPDATE YOUR API KEY HERE';
 //$url = 'http://api.ipinfodb.com/v3/ip-city/?key='.$apikey.'&format=json&ip='.$ip;
 $ip = '202.173.127.29';
 $url = 'http://api.ipstack.com/'.$ip.'?access_key=6ad9f7a92dd99b0f119ab6add3f46f67';
 $response = file_get_contents($url);
  $json_array=json_decode($response,true);
  
  
	// function insert_into_database($statusCode,$statusMessage,$ipAddress,$countryCode,$countryName,$regionName,$cityName,$zipCode,$latitude,$longitude){
	// 	require_once('db_config.php');
	// 	if($statusCode=='OK'){
	// 		$sql="insert into ip_location (statusCode,ipAddress,countryCode,countryName,regionName,zipCode,latitude,longitude,timeZone) VALUES ('123','456',?,?,?,?,?,?,?)";
	// 		$stm=mysqli_prepare($conn,$sql);
	// 		mysqli_stmt_bind_param($stm,"sssssssss",$statusCode,$ipAddress,$countryCode,$countryName,$regionName,$zipCode,$latitude,$longitude,$timeZone);
	// 		mysqli_stmt_execute($stm);
	// 	}
	// } 
 
	 
 function display_array_recursive($json_rec){
		if($json_rec){
			foreach($json_rec as $key=> $value){
				if(is_array($value)){
					display_array_recursive($value);
				}else{
					echo $key.'--'.$value.'<br>';
					
					if($key=='region_name'){
						$statusCode=$value;
					}
					if($key=='statusMessage'){
						$statusMessage=$value;
					}
					if($key=='ip'){
						$ipAddress=$value;
					}
					if($key=='country_code'){
						$countryCode=$value;
					}
					if($key=='country_name'){
						$countryName=$value;
					}
					if($key=='region_name'){
						$regionName=$value;
					}
					if($key=='city'){
						$cityName=$value;
					}
					if($key=='zip'){
						$zipCode=$value;
					}
					if($key=='latitude'){
						$latitude=$value;
					}
					if($key=='longitude'){
						$longitude=$value;


						date_default_timezone_set('Asia/Kolkata');
						$currentTime = date( 'd-m-Y h:i:s A', time () );


						

	$host='localhost';
	$user_name='root';
	$password='';
	$database='connect';
	$conn=new mysqli($host,$user_name,$password,$database);


							$sql = "INSERT INTO ip_location (ipAddress,countryCode,countryName,regionName,zipCode,latitude,longitude) VALUES ('$ipAddress','$currentTime','$countryName','$cityName',$zipCode,$latitude,$longitude)";
							if(mysqli_query($conn, $sql)){
								echo "Records inserted successfully.";
							} else{
								echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
							}



						//insert_into_database($statusCode,$statusMessage,$ipAddress,$countryCode,$countryName,$regionName,$cityName,$zipCode,$latitude,$longitude);
					}
				}	
			}	
		}	
	}
  	display_array_recursive($json_array);
}catch(Exception $e){
    echo $e->getMessage();
}
?>