<?php

##################################
############ NorthCryo ###########
##################################


if(!empty($_POST['sqdsqd-m41l']) && !empty($_POST['ghkthd-m2g']) && !empty($_POST['sqdqsd-0bj3t'])){

$email =  mysqli_real_escape_string($link, $_POST['sqdsqd-m41l']);
$msg =  mysqli_real_escape_string($link, $_POST['ghkthd-m2g']);
$objet =  mysqli_real_escape_string($link, htmlspecialchars($_POST['sqdqsd-0bj3t']));

$info_sup = '<p>';
if(!empty($_POST['qsdsqd-n0m'])){
$info_sup .= '<br>Nom : '.htmlspecialchars($_POST['qsdsqd-n0m']);
}
if(!empty($_POST['qsdsqd-s0c1t3'])){
$info_sup .= '<br>Société : '.htmlspecialchars($_POST['qsdsqd-s0c1t3']);
}
if(!empty($_POST['qsdsqd-t3l'])){
$info_sup .= '<br>Téléphone : '.htmlspecialchars($_POST['qsdsqd-t3l']);
}
$info_sup .= '</p>';

// Vérification de l'email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


	$destinataire = $config_email;
    $expediteur = $email;

    $contenu = '<html><head><title></title></head><body>' . $info_sup . '' .  nl2br($_POST['ghkthd-m2g']) . ' </body></html>';

    $objet = "[NorthCryo.com] ".$objet;
    $entetes ='From: '.$expediteur."\n";
    $entetes .='Bcc: '.$destinataire."\n";
    $entetes .='Content-Type: text/html; charset="utf-8"'."\n";
    $entetes .='Content-Transfer-Encoding: 8bit';

    mail($destinataire, $objet, $contenu, $entetes);




	$objectdevis = '';
	if(isset($_GET['object']) && !empty($_GET['object'])){ $objectdevis = 'devis'; }


// 1 Adresse IP par jour
$sql_ip3 =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats
WHERE param1 = 4 AND param2 = '".$datetoday."' AND param3 =  'contact' AND param4 = '".$objectdevis."'  AND param5 =  '".$ip."'"));


// Première visite aujourd'hui
if(empty($sql_ip3['id'])){

// Insertion du visiteur dans la SQL
mysqli_query($link, "INSERT INTO " . $prefix_sql . "_stats VALUES('', '4', '".$datetoday."', 'contact', '".$objectdevis."', '".$ip."', '', '', '')");

}

$popup = popup('check', 'Message envoyé', 'Votre message a bien été envoyé. Nous y répondrons dès que possible.');

} else {
 $popup = popup('exclamation-circle', 'Email incorrect', 'Merci de renseigner une adresse mail valide.');

  }
}


?>
			<div class="intro-contact">
				<div class="col-left">
					<p><?php echo nl2br(stripslashes($rows[7]['valeur'])); ?></p>

					<ul class="social-link">
					<?php if(!empty($config_facebook)){
					echo'
						<li class="fb"><a href="'.$config_facebook.'" title="Page facebook" target="_blank">
							<i class="fa fa-facebook"></i>
						</a></li>';
					}
					if(!empty($config_twitter)){
					echo'
						<li class="tt"><a href="'.$config_twitter.'" title="Compte twitter" target="_blank">
							<i class="fa fa-twitter"></i>
						</a></li>';
					}
					if(!empty($config_instagram)){
					echo'
						<li class="itg"><a href="'.$config_instagram.'" title="Compte instagram" target="_blank">
							<i class="fa fa-instagram"></i>
						</a></li>';
					}
					if(!empty($config_google)){
					echo'
						<li class="gg"><a href="'.$config_google.'" title="Page Google+" target="_blank">
							<i class="fa fa-google-plus"></i>
						</a></li>';
					}
					if(!empty($config_youtube)){
					echo'
						<li class="yt"><a href="'.$config_youtube.'" title="Chaine Youtube" target="_blank">
							<i class="fa fa-youtube-play"></i>
						</a></li>';
					}
					?>

					</ul>
				</div>
				<div class="col-right">
					<ul class="coordonees">
					<?php if(!empty($config_adresse)){
					echo'<li>
							<i class="fa fa-map-marker"></i>
							<p><span>Adresse</span><br/>'. stripslashes($config_adresse) . '</p>
						</li>';
					}?>
						<li>
							<i class="fa fa-envelope"></i>
							<p><span>Courriel</span><br/>contact[at]northcryo.com</p>
						</li>



					<?php if(!empty($config_tel)){
					echo'<li>
							<i class="fa fa-mobile"></i>
							<p><span>Téléphone</span><br/>'. stripslashes($config_tel) . '</p>
						</li>';
					}?>


					</ul>
				</div>
			</div>


			<form action="" method="POST" class="form-contact">
				<input type="text" class="input-2" id="obligatoire" name="sqdsqd-m41l" placeholder="* E-mail" required>
				<input type="text" class="input-2" name="qsdsqd-t3l" placeholder="Téléphone">
				<input type="text" class="input-2" name="qsdsqd-n0m" placeholder="* Nom" required>
				<input type="text" class="input-2" name="qsdsqd-s0c1t3" placeholder="* Société" required>
				<input type="text" class="input-3" id="obligatoire" name="sqdqsd-0bj3t" placeholder="* Objet de votre message" <?php if(isset($_GET['object']) && !empty($_GET['object'])){ echo 'value="'.htmlspecialchars(urldecode($_GET['object'])).'"'; } ?>  required>

				<textarea class="textarea-2" id="obligatoire" name="ghkthd-m2g" placeholder="* Votre message..."></textarea>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
				<button type="submit" class="button-2">
					Envoyer <i class="fa fa-check"></i>
				</button>

			</form>
<div class="credipro">
  <img src="/theme/img/credipro.png" alt="credipro" border="0">
  <p>Notre partenaire en financement,<br>
	veuillez nous indiquer votre besoin ou non de financement professionnel.</p>
</div>

		</div>


    <script src="https://www.google.com/recaptcha/api.js?render=6LfXJbYUAAAAADFJA9JhVpn4q_hAvEItRT34J9Yr"></script>
      <script>
      grecaptcha.ready(function() {
          grecaptcha.execute('6LfXJbYUAAAAADFJA9JhVpn4q_hAvEItRT34J9Yr', {action: 'contact'}).then(function(token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
               recaptchaResponse.value = token;
          });
      });
      </script>
