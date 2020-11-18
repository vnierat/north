<?php

###########################
############ CK ###########
###########################



function seotitle($id, $type) {

	$sqlpage =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_pages WHERE id = '".$id."'"));
	$string = $sqlpage[$type]; 
	
	return $string;
}



$error404 = 0;

if(empty($_GET['ref']) or !isset($_GET['ref']) or $_GET['ref'] == ''){

	$contenu = "system/page/accueil.php"; 
	$active_link = 1;
	$css = "home";
	$seo_url = '';
	
}



if(isset($_GET['ref']))
{

$page = $_GET["ref"];


switch ($page) 
{  
	case 'a-propos' :  // Catégorie
	$contenu = "system/page/apropos.php";
	$active_link = 2;
	$css = "";
	$seo_url = 'a-propos';
	break; 

	case 'nos-cabines' :  // Catalogue
	$contenu = "system/page/catalogue.php";
	$active_link = 3;
	$css = "catalogue";
	$seo_url = 'nos-cabines';
	break; 

	case 'cryolipolyse' :  // Catalogue-autres
	$contenu = "system/page/catalogue-cryolipolyse.php";
	$active_link = 4;
	$css = "catalogue";
	$seo_url = 'autres-equipements';

	break; 

	case 3 :  // Cabine
	$active_link = 3;
	$css = "";

	if(!empty($_GET['url_item']))
	{

	// Sécurisation
	$url_item = mysqli_real_escape_string($link, $_GET['url_item']);
	$id_item = mysqli_real_escape_string($link, $_GET['id_item']);

	// Récupération de la categorie
	$sql_item =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_cabine WHERE id = '" . $id_item . "' ")); 

	// Et si l'url est correct
	if(!empty($sql_item['id']) && url_rewriting($sql_item['nom']) == $url_item){

	$contenu = "system/page/cabine.php";
	$titre_page =  'Cabine de cryothérapie '.stripslashes($sql_item['nom']);
	$description_page =   stripslashes($sql_item['description']) . ' / '. stripslashes($sql_item['nom']) .' - Référence '. stripslashes($sql_item['reference']);

	$head_titre_page = 'Cabine de cryothérapie '.stripslashes($sql_item['nom']);
	$head_intro_page  = stripslashes($sql_item['baseline']);
	$seo_url = 'cabine/' . $id_item . '/' . $url_item;
	}  else { 

		$contenu = "system/template/404.php";
		$head_titre_page = 'Erreur 404';
		$head_intro_page  = 'Une erreur est survenue.';
		$titre_page =   'Erreur 404';
		$description_page =   'Erreur 404. Une erreur est survenue';
	}

	} else { 

		$contenu = "system/template/404.php";
		$head_titre_page = 'Erreur 404';
		$head_intro_page  = 'Une erreur est survenue.';
		$titre_page =   'Erreur 404';
		$description_page =   'Erreur 404. Une erreur est survenue.';
	}

	break; 

	case 4 :  // AUTRES
	$active_link = 4;
	$css = "";

	if(!empty($_GET['url_item']))
	{

	// Sécurisation
	$url_item = mysqli_real_escape_string($link, $_GET['url_item']);
	$id_item = mysqli_real_escape_string($link, $_GET['id_item']);
 
	// Récupération de la categorie
	$sql_item =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_cryo WHERE id = '" . $id_item . "' ")); 

	// Et si l'url est correct
	if(!empty($sql_item['id']) && url_rewriting($sql_item['nom']) == $url_item){

	$contenu = "system/page/cryolipolyse.php";
	$titre_page =  'Cabine de cryothérapie '.stripslashes($sql_item['nom']);
	$description_page =   stripslashes($sql_item['description']) . ' / '. stripslashes($sql_item['nom']) .' - Référence '. stripslashes($sql_item['reference']);
	
	$head_titre_page = 'Cabine de cryothérapie '.stripslashes($sql_item['nom']);
	$head_intro_page  = stripslashes($sql_item['baseline']);
	$seo_url = 'autres/' . $id_item . '/' . $url_item;
	}  else { 

		$contenu = "system/template/404.php";
		$head_titre_page = 'Erreur 404';
		$head_intro_page  = 'Une erreur est survenue.';
		$titre_page =   'Erreur 404';
		$description_page =   'Erreur 404. Une erreur est survenue';
	}

	} else { 

		$contenu = "system/template/404.php";
		$head_titre_page = 'Erreur 404';
		$head_intro_page  = 'Une erreur est survenue.';
		$titre_page =   'Erreur 404';
		$description_page =   'Erreur 404. Une erreur est survenue.';
	}


	break;
	

	case 'contact' :  // Contact
	$contenu = "system/page/contact.php";
	$active_link = 5;
	$css = "";
	$seo_url = 'contact';
	break; 

	case 'legal' :  // Mentions légal
	$contenu = "system/page/legal.php";
	$active_link = 6;
	$css = "";
	$seo_url = 'legal';
	break; 

	case 'job' :  // Jobs
	$contenu = "system/page/job.php";
	$active_link = 7;
	$css = "";
	$seo_url = 'job';
	break; 


	default :  // Jobs
	$contenu = "system/template/404.php";
	$head_titre_page = 'Erreur 404';
	$head_intro_page  = 'Une erreur est survenue.';
	$titre_page =   'Erreur 404';
	$description_page =   'Erreur 404. Une erreur est survenue.';
	$error404 = 1;
	break; 



}

} 


?>