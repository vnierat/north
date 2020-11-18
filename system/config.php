<?php

##################################
############ NorthCryo ###########
##################################


######### Connexion MYSQL #########

// Identifiant
$host = "localhost"; 
$user = "root"; 
$pass = "root"; 
$bdd = "northcrylv2jk1s"; 

// Connexion
$link = mysqli_connect($host,$user,$pass,$bdd);


######### Configuration #########

$erreur = 0;
$popup = '';

// Préfix
$prefix_sql = 'nc';

// Tableau
$config = array();

mysqli_query($link, "SET NAMES 'utf8'");

// Création tableau
$sqlconfig =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_configuration"); 
while($sql_config = mysqli_fetch_array($sqlconfig)) { array_push($config, $sql_config[2]); }

// Paramètres
$config_nomsite = stripslashes(htmlspecialchars($config[0]));
$config_urlsite = stripslashes(htmlspecialchars($config[1]));
$config_urladmin = stripslashes(htmlspecialchars($config[2]));
$config_email = stripslashes(htmlspecialchars($config[3]));
$config_bg = stripslashes(htmlspecialchars($config[4]));
$config_facebook = stripslashes(htmlspecialchars($config[5]));
$config_twitter = stripslashes(htmlspecialchars($config[6]));
$config_instagram = stripslashes(htmlspecialchars($config[7]));
$config_google = stripslashes(htmlspecialchars($config[8]));
$config_youtube = stripslashes(htmlspecialchars($config[9]));


$config_adresse = stripslashes(htmlspecialchars($config[10]));
$config_tel = stripslashes(htmlspecialchars($config[11]));

// Template
$oSmarty = new Smarty();
$oSmarty->assign('URL_SITE', $config_urlsite);
$oSmarty->assign('BG_SITE', $config_bg);


// Texte du site
$rows = array();
$sql_txt = mysqli_query($link, 'SELECT * FROM ' . $prefix_sql . '_textes');
while($row = mysqli_fetch_assoc($sql_txt)) {  $rows[] = $row; }


?>