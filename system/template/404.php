<?php

###########################
############ CK ###########
###########################

if(isset($_GET['type']) && $_GET['type'] == 1){

	include('../config.php');
	include('../fonction/fonctions.php');

	$erreur = 1;
	include('../template/header.php');

}

$url_requet = mysqli_real_escape_string($link, $_SERVER['REQUEST_URI']);

// INFO
$Url = strtolower(dirname($_SERVER['SERVER_PROTOCOL'])) . "://" . $_SERVER['HTTP_HOST'] . $url_requet;
$ip = $_SERVER["REMOTE_ADDR"];

if(!empty($_SESSION['login'][0])){ $id_session = $_SESSION['login'][0];} else { $id_session = "0";}

// Insertion dans la base de donné
mysqli_query($link, "INSERT INTO " . $prefix_sql . "_stats VALUES('', '3', '".time()."', '".$Url."', '".$ip."', '".$id_session."', '', '', '')");

?>
<div id="corps" class="error404">
	<div id="content">
		<p class="error404"><b>Oups !</b> La page que vous recherchez n’existe pas.</p>
		<a href="<?php echo $config_urlsite; ?>" title="Retour à la page d'accueil" class="error404">Retour à l'accueil</a>
	</div>
</div>

<?php 

if(isset($_GET['type']) && $_GET['type'] == 1){

include ('footer.php');

} ?>