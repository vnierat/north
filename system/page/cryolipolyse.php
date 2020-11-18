<?php

##################################
############ NorthCryo ###########
##################################


// 1 Adresse IP par jour
$sql_ip2 =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats
WHERE param1 = 2 AND param2 = '".$datetoday."' AND param3 =  '".intval($_GET['id_item'])."' AND param4 =  '".$ip."' "));


// Première visite aujourd'hui
if(empty($sql_ip2['id'])){

// Insertion du visiteur dans la SQL
mysqli_query($link, "INSERT INTO " . $prefix_sql . "_stats VALUES('', '2', '".$datetoday."', '".intval($_GET['id_item'])."', '".$ip."', '', '', '', '')");

}




// SQL
$sqlitem =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_cryo WHERE id = '".intval($_GET['id_item'])."'"));


if(!empty($_POST['sjid-m4il']) && !empty($_POST['fdsfs-m3ss4ge'])){

$email =  mysqli_real_escape_string($link, $_POST['sjid-m4il']);
$msg =  mysqli_real_escape_string($link, htmlspecialchars($_POST['fdsfs-m3ss4ge']));

$info_sup = '<p>';
$info_sup .= 'Cabine : '.stripslashes($sqlitem['nom']);
if(!empty($_POST['sdqkd-soci3te'])){
$info_sup .= '<br>Société : '.htmlspecialchars($_POST['sdqkd-soci3te']);
}
if(!empty($_POST['qsdkv-t3l'])){
$info_sup .= '<br>Téléphone : '.htmlspecialchars($_POST['qsdkv-t3l']);
}
$info_sup .= '</p>';

// Vérification de l'email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


	$destinataire = $config_email;
    $expediteur = $email;

    $contenu = '<html><head><title></title></head><body>' . $info_sup . '' .  nl2br($_POST['fdsfs-m3ss4ge']) . ' </body></html>';

    $objet = "[NorthCryo.com] Demande d'information à propos de la cabine " . stripslashes($sqlitem['nom']);
    $entetes ='From: '.$expediteur."\n";
    $entetes .='Bcc: '.$destinataire."\n";
    $entetes .='Content-Type: text/html; charset="utf-8"'."\n";
    $entetes .='Content-Transfer-Encoding: 8bit';

    mail($destinataire, $objet, $contenu, $entetes);





// 1 Adresse IP par jour
$sql_ip3 =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats
WHERE param1 = 4 AND param2 = '".$datetoday."' AND param3 =  'cabine' AND param4 =  '".$ip."' "));


// Première visite aujourd'hui
if(empty($sql_ip3['id'])){

// Insertion du visiteur dans la SQL
mysqli_query($link, "INSERT INTO " . $prefix_sql . "_stats VALUES('', '4', '".$datetoday."', 'cabine', '".$ip."', '', '', '', '')");

}





$popup = popup('check', 'Message envoyé', 'Votre message a bien été envoyé. Nous y répondrons dès que possible.');

} else {
 $popup = popup('exclamation-circle', 'Email incorrect', 'Merci de renseigner une adresse mail valide.');

  }
}

?>
			<div class="fiche-cabine" itemscope itemtype="http://schema.org/Product">
				<img itemprop="image" src="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sqlitem['image']); ?>" alt="Cabine de cryothérapie corps entier <?php echo stripslashes($sqlitem['nom']); ?>" class="img-cabine">
				<div class="info-cabine">
					<h2 class="t2" itemprop="name"><?php echo stripslashes($sqlitem['nom']); ?>
					<?php if(!empty($sqlitem['reference'])){ ?>
					<span>REF N°<b itemprop="mpn"><?php echo stripslashes($sqlitem['reference']); ?></b></span>
					<?php } ?>
					</h2>
					<div class="note">
					<?php

			if($sqlitem['note'] > 1){


			if($sqlitem['note'] == 2){

				echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';

			} else if($sqlitem['note'] == 3){

				echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';

			} else if($sqlitem['note'] == 4){

				echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';

			} else if($sqlitem['note'] == 5){

				echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';

			}

		}


			?>
					</div>
					<div class="clear"></div>
					<p class="txt" itemprop="description">
						<?php echo nl2br(stripslashes($sqlitem['description'])); ?>
					</p>
					<ul class="technic">
						<li><b>Consommation d'azote par traitement : </b> <?php echo stripslashes($sqlitem['carac1']); ?></li>
						<li><b>Volume du bruit : </b> <?php echo stripslashes($sqlitem['carac2']); ?></li>
						<li><b>Poids hors bonbonne d'azote : </b> <?php echo stripslashes($sqlitem['carac3']); ?></li>
						<li><b>Consommation maximale : </b> <?php echo stripslashes($sqlitem['carac4']); ?></li>
						<li><b>Température cabine   : </b> <?php echo stripslashes($sqlitem['carac5']); ?></li>
						<li><b>Durée de traitement    : </b> <?php echo stripslashes($sqlitem['carac6']); ?></li>

					</ul>

					<div class="cta-item">
						<a href="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sqlitem['doc_pdf']); ?>" title="Documentation du <?php echo stripslashes($sqlitem['nom']); ?>" target="_blank" class="down-pdf">
							<i class="fa fa-file-pdf-o"></i>
						</a>
						<a href="<?php echo $config_urlsite; ?>/contact?object=Demande+de+devis+concernant+les+cabines+Cryoness" title="Demandez votre devis, c'est gratuit !" class="devis">
							Demandez votre devis <i class="fa fa-angle-right"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="txt-cabine">
				<h3 class="t3">
					Fonctionnement de la cabine <b><?php echo stripslashes($sqlitem['nom']); ?></b>
					<span></span>
				</h3>
				<div class="txt-content">
					<?php echo stripslashes($sqlitem['texte']); ?>
				</div>
			</div>
		</div>

<?php



// SQL
$sqlgallerie =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql ."_gallerie WHERE id_cabine = '".$sqlitem['id']."'"));

if(!empty($sqlgallerie['id'])){
?>

		<div class="galerie-cabine">
			<div class="content">
<?php
	$sqlcat =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_gallerie WHERE id_cabine = '".$sqlitem['id']."' ORDER by rand() LIMIT 0,3");
	while($sql_gallerie = mysqli_fetch_array($sqlcat)) {
?>
				<a href="<?php echo $config_urlsite; ?>/upload/<?php echo $sql_gallerie['image']; ?>" title="<?php echo stripslashes($sql_gallerie['nom']); ?>" class="link-galerie lightbox" rel="group1">
					<img src="<?php echo $config_urlsite; ?>/upload/<?php echo $sql_gallerie['image']; ?>" alt="<?php echo stripslashes($sql_gallerie['nom']); ?>" border="0">
				</a>
<?php


	}
?>
			</div>
		</div>

		<?php


	}

	?>

		<div class="content">
			<div class="form-cabine">
				<h1 class="t3">
					<?php echo stripslashes($rows[5]['valeur']); ?>
					<span></span>
				</h1>

				<p class="intro"><?php echo stripslashes($rows[6]['valeur']); ?></p>

				<form action="" method="post" class="cabine">
					<div class="col-left">
						<p class="p-input-1">
							<input type="text" class="input-1" name="sjid-m4il" placeholder="* Votre email">
							<span></span>
						</p>
						<p class="p-input-1">
							<input type="text" class="input-1" name="qsdkv-t3l" placeholder="Téléphone">
							<span></span>
						</p>
						<p class="p-input-1">
							<input type="text" class="input-1" name="sdqkd-soci3te" placeholder="Société">
							<span></span>
						</p>
					</div>
					<div class="col-right">
						<textarea name="fdsfs-m3ss4ge" class="textarea-1" placeholder="Votre message..."></textarea>
						<button type="submit" class="circle-submit"><i class="fa fa-check"></i></button>
					</div>
				</form>
			</div>
