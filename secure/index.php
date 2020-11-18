<?php

##################################
############ NorthCryo ###########
##################################

// System
require ("../system/fonction/smarty/Smarty.class.php"); 
require ("../system/fonction/fonctions.php"); 
require ("../system/config.php"); 
require ("../system/fonction/login.php"); 



// Page
require ("link.inc.php"); 

if($login == 1){
// Template
require ("header.php"); 
include $contenu; 

require ("footer.php");
} else {
include ('page/login.php'); 
}
?>