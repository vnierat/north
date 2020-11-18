<?php

##################################
############ NorthCryo ###########
##################################


// Login
session_start();

function removeCookie($name) {
    unset($_COOKIE[$name]);
    setcookie($name, "null");
}



		$login_post =  mysqli_real_escape_string($link, $_POST['login']);
		$pwd =  mysqli_real_escape_string($link, $_POST['pwd']);

		$sql_admin = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_admin WHERE login = '" . $login_post. "' "));
		if(isset($sql_admin['id']) && md5($pwd) == $sql_admin['password']){

		$_SESSION["CryoAdminCookie"] = $sql_admin['keyuser'];

		$number_of_days = 7 ;
		$date_of_expiry = time() + 60 * 60 * 24 * $number_of_days;
		setcookie( "CryoAdminCookie", $sql_admin['keyuser'], $date_of_expiry );

		} else { 

			echo '<script>alert("Mots de passe ou identifiant incorrect");</script>'; 
		}	



if(isset($_GET['logout'])){

	removeCookie('CryoAdminCookie');
	session_destroy();
	header('Location: '.$config_urladmin);

}


$login = 1;

if(!array_key_exists('CryoAdminCookie',$_SESSION) && empty($_SESSION['CryoAdminCookie'])) {

$login = 0;

if(isset($_COOKIE['CryoAdminCookie'])) 
{ 

    $sql_cookie = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_admin WHERE keyuser = '" . mysqli_real_escape_string($link, $_COOKIE['CryoAdminCookie']) . "' "));

    if(!empty($sql_cookie['id'])){

    	$_SESSION["CryoAdminCookie"] = $sql_cookie['keyuser'];
		$login = 1;

    }

} 

}



if(isset($_POST['emaillogin'])):

    $sql_emailogin = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_admin 
    	WHERE email = '" . mysqli_real_escape_string($link, $_POST['emaillogin']) . "' "));

	if(!empty($sql_emailogin['id'])){

		$newmdp = random2(6);


		 // Mise a jour de la sql
		mysqli_query($link, "UPDATE " . $prefix_sql . "_admin SET password = '".md5($newmdp)."' WHERE id = ".$sql_emailogin['id']." ");

	$destinataire = $sql_emailogin['email'];
    $expediteur = "noreply@NorthCryo.com";
            
    $contenu = '<html><head><title></title></head><body>
    <p>Vous avez fait une demande de réinitialisation pour le mots de passe de votre compte sur le backoffice du site NorthCryo.com</p>
    <p>Vous trouverez ci-dessous votre nouveau mots de passe. Nous vous conseillons de le changer et de supprimer cette e-mail.</p>
    <p> Identifiant : ' .  $sql_emailogin['login'] . ' <br/> Mots de passe : '.$newmdp.'</p></body></html>';
            
    $objet = "[NorthCryo.com] Demande de réinitialisation de votre mots de passe";
    $entetes ='From: '.$expediteur."\n";
    $entetes .='Bcc: '.$destinataire."\n";
    $entetes .='Content-Type: text/html; charset="utf-8"'."\n";
    $entetes .='Content-Transfer-Encoding: 8bit';
              
    mail($destinataire, $objet, $contenu, $entetes);

	echo '<script>alert("Consultez votre boite email.");</script>'; 


	}

endif;

?>