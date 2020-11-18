<?php

###########################
############ CK ###########
###########################

// Adresse IP
$ip = $_SERVER["REMOTE_ADDR"];
if($ip == "::1"){ $ip = "127.0.0.1";}

if( filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ){

$_u4 = current( unpack( "A4", inet_pton( $ip ) ) );
$ip = inet_ntop( pack( "A4", $_u4 ) ); 

} else {


$_u6 = current( unpack( "A16", inet_pton( $ip ) ) );
$ip = inet_ntop( pack( "A16", $_u6 ) ); 
}

$datetoday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

// 1 Adresse IP par jour
$sql_ip =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats 
WHERE param1 = 1 AND param2 = '".$datetoday."' AND param3 =  '".$ip."' "));


// Première visite aujourd'hui
if(empty($sql_ip['id'])){

// Insertion du visiteur dans la SQL
mysqli_query($link, "INSERT INTO " . $prefix_sql . "_stats VALUES('', '1', '".$datetoday."', '".$ip."', '', '', '', '', '')");

}


?>