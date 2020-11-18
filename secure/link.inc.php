<?php

##################################
############ NorthCryo ###########
##################################

// Default
$contenu = "page/accueil.php"; 
	$titre_page =  "Backoffice";
$description_page =  "## Description";

if(isset($_GET['page']))
{

$page = $_GET["page"];


switch ($page) 
{  
	case 'accueil' :  // Catégorie
	$contenu = "page/accueil.php"; 
	$titre_page =  "Backoffice";
	$description_page =  "## Description";
	break; 


	case 'parametres' :  // Paramètres
	$contenu = "page/parametre.php"; 
	$titre_page =  "Configuration du site";
	$description_page =  "## Description";
	break; 

	case 'newsletter' :  // Newsletter
	$contenu = "page/newsletter.php"; 
	$titre_page =  "Inscription à la newsletter";
	$description_page =  "## Description";
	break; 

	case 'stats' :  // Les statistiques
	$contenu = "page/stats.php"; 
	$titre_page =  "Les statistiques du site";
	$description_page =  "## Description";
	break; 

	case 'job' :  // OFfre d'emploi
	$contenu = "page/job.php"; 
	$titre_page =  "Les offres d'emplois";
	$description_page =  "## Description";
	break; 

	case 'textes' :  // Texte
	$contenu = "page/texte.php"; 
	$titre_page =  "Les textes des pages";
	$description_page =  "## Description";
	break; 

	case 'tpl' :  // Texte
	$contenu = "page/tpl.php"; 
	$titre_page =  "Gestion des pages";
	$description_page =  "## Description";
	break; 

	case 'client' :  // Client
	$contenu = "page/client.php"; 
	$titre_page =  "Les clients";
	$description_page =  "## Description";
	break; 

	case 'cabine' :  // Cabines
	$contenu = "page/cabine.php"; 
	$titre_page =  "Les cabines";
	$description_page =  "## Description";
	break;

	case 'autres' :  // autres equipements
	$contenu = "page/autres-equip.php"; 
	$titre_page =  "Les autres équipements";
	$description_page =  "## Description";
	break;

	case 'gallerie' :  // Gallerie
	$contenu = "page/gallerie.php"; 
	$titre_page =  "#Galleries photos des cabines";
	$description_page =  "## Description";
	break; 

	case 'slider' :  // Slider
	$contenu = "page/slider.php"; 
	$titre_page =  "Slider de l'accueil";
	$description_page =  "## Description";
	break; 

	case 'pages' :  // Pages
	$contenu = "page/pages.php"; 
	$titre_page =  "Titre et texte des pages";
	$description_page =  "## Gestion des pages";
	break; 

	case 'user' :  // Utilisateur
	$contenu = "page/user.php"; 
	$titre_page =  "Gestion des utilisateurs";
	$description_page =  "## Gestion des pages";
	break; 





}

} 

?>