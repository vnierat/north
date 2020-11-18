<?php

##################################
############ NorthCryo ###########
##################################

// TPL
$oSmarty->display('system/tpl/accueil.tpl');


// Newsletter
if(!empty($_POST['email_newsletter'])){

$email_newsletter =  mysqli_real_escape_string($link, $_POST['email_newsletter']);

// Vérification de l'email
if (filter_var($email_newsletter, FILTER_VALIDATE_EMAIL)) {

mysqli_query($link, "INSERT INTO " . $prefix_sql . "_newsletter VALUES ('', '".$email_newsletter."', ". time() . ")");

$popup = popup('check', 'Bravo !', 'Votre inscription a bien été prise en compte.');

} else { $popup = popup('exclamation-circle', 'Email incorrect', 'Merci de renseigner une adresse mail valide.'); }
}

?>





			<div class="newsletter">
				<h1 class="t1"><?php echo stripslashes($rows[1]['valeur']); ?></h1>
				<p><?php echo stripslashes($rows[2]['valeur']); ?></p>

				<form action="<?php echo $config_urlsite; ?>" method="POST">
					<input type="text" name="email_newsletter" placeholder="Votre courriel">
					<button type="submit"><i class="fa fa-paper-plane"></i></button>
				</form>
			</div>
