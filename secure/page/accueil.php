<?php

##################################
############ NorthCryo ###########
##################################

//
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
$sql_ip2 =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats 
WHERE param1 = 5 AND param2 = '".$datetoday."' AND param3 =  '".$ip."'  AND param4 =  '".$_COOKIE['CryoAdminCookie']."' "));


// Première visite aujourd'hui
if(empty($sql_ip2['id'])){

// Insertion du visiteur dans la SQL
mysqli_query($link, "INSERT INTO " . $prefix_sql . "_stats VALUES('', '5', 
  '".$datetoday."', 
  '".$ip."', '".$_COOKIE['CryoAdminCookie']."', '', '', '', '')");

}



?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a></div>
  </div>



  <div class="container-fluid">
   <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Statistiques</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span9">
              <div class="chart"><div id="container" style="height:300px;"></div></div>
            </div>
              <div class="span3">
              <ul class="site-stats">
<?php

$year_1 = mktime(0, 0, 0,01,01, date('Y'));
$year_2 = mktime(0, 0, 0,01,01, date('Y', strtotime(' +1 year')));

$month_1 = mktime(0, 0, 0, date('m'),01, date('Y'));
$month_2 = mktime(0, 0, 0, date('m', strtotime(' +1 month')),01, date('Y'));

$sql_visite_y =   mysqli_num_rows(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats WHERE param1 = 1 AND param2 >= ".$year_1." AND param2 < ".$year_2."")); 
$sql_visite_m =   mysqli_num_rows(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats WHERE param1 = 1 AND param2 >= ".$month_1." AND param2 < ".$month_2."")); 

$sql_commande_y =   mysqli_num_rows(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats WHERE param1 = 4 AND param2 >= ".$year_1." AND param2 < ".$year_2."")); 
$sql_commande_m =   mysqli_num_rows(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats WHERE param1 = 4 AND param2 >= ".$month_1." AND param2 < ".$month_2."")); 


?>
                <li class="bg_lh"><i class="icon-user"></i> <strong><?php echo $sql_visite_m; ?></strong> <small>Visiteurs (m)</small></li>
                <li class="bg_lh"><i class="icon-user"></i> <strong><?php echo $sql_visite_y; ?> </strong> <small>Visiteurs (Y)</small></li>

                <li class="bg_lh"><i class="icon icon-envelope-alt"></i> <strong><?php echo $sql_commande_y; ?></strong> <small>Contact (m)</small></li>
                <li class="bg_lh"><i class="icon icon-envelope-alt"></i> <strong><?php echo $sql_commande_m; ?></strong> <small>Contact (Y)</small></li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
   <div class="row-fluid">


<?php

$arrayCommande = array();

$sqlitem =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_cabine ORDER by id DESC"); 
while($sql_item = mysqli_fetch_array($sqlitem)) {

$sql_nbr_commande =   mysqli_num_rows(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats 
  WHERE param1 = '2'  AND param2 >= ".$month_1." AND param2 < ".$month_2." AND param3 = ".$sql_item['id']."")); 

if($sql_nbr_commande > 0){

$arrayCommande[$sql_item['id']] = $sql_nbr_commande; 

}
}

?>

        <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-arrow-right"></i> </span>
            <h5>Les cabines les plus vues durant ce mois</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Cabine</th>
                  <th>Nbr de vues</th>
                </tr>
              </thead>
              <tbody>
<?php
arsort($arrayCommande);
foreach ($arrayCommande as $key => $val) {

$sql_nbr_item =   mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_cabine WHERE id = " . $key . "")); 
?>
                <tr>
                  <td><center><?php echo stripslashes($sql_nbr_item['nom']); ?></center></td>
                  <td><center><?php echo $val; ?></center></td>
                </tr>
<?php
}
?>
              </tbody>
            </table>
          </div>
         </div>
       </div>

    </div>

        
      </div>
    </div>

