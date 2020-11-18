<?php

##################################
############ NorthCryo ###########
##################################

// System
require ("system/fonction/smarty/Smarty.class.php"); 
require ("system/fonction/fonctions.php"); 
require ("system/config.php"); 
require ("system/fonction/visite.php"); 

// Modules 
// require ("system/fonction/visite.php");

// Page
require ("system/link.inc.php"); 

// Template
require ("system/template/header.php"); 
include $contenu; 
require ("system/template/footer.php");

?>