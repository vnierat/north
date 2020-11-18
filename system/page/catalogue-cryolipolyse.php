<?php

##################################
############ NorthCryo ###########
##################################



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
			<div class="catalogue">

<?php
	$sqlcat =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_cryo ORDER by id LIMIT 0,3"); 
	while($sql_cabine = mysqli_fetch_array($sqlcat)) {
?>
				<div class="item">
					<a href="<?php echo $config_urlsite; ?>/cryolipolyse/<?php echo $sql_cabine['id'] . '/'. url_rewriting(stripslashes($sql_cabine['nom'])); ?>" title="Cabine de cryothérapie corps entier <?php echo stripslashes($sql_cabine['nom']); ?>" class="link-img">
						<img src="<?php echo $config_urlsite; ?>/upload/<?php echo $sql_cabine['image']; ?>" alt="Cabine de cryothérapie <?php echo stripslashes($sql_cabine['nom']); ?>" border="0">
					</a>
					<?php echo stripslashes($sql_cabine['nom']); ?></h2> 
					<p><?php echo cutString(stripslashes($sql_cabine['description']),0,120); ?></p>
					<a href="<?php echo $config_urlsite; ?>/cryolipolyse/<?php echo $sql_cabine['id'] . '/'. url_rewriting(stripslashes($sql_cabine['nom'])); ?>" class="btn-cabine" title="Cabine de cryothérapie corps entier <?php echo stripslashes($sql_cabine['nom']); ?>">
						En savoir plus
					</a>
				</div>
<?php
}
?>
			</div>
		</div>


		<div class="galerie-cabine">
			<div class="content">

<?php
	$sqlcat =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_gallerie ORDER by rand() LIMIT 0,3"); 
	while($sql_gallerie = mysqli_fetch_array($sqlcat)) {
?>
				<a href="<?php echo $config_urlsite; ?>/upload/<?php echo $sql_gallerie['image']; ?>" title="<?php echo $sql_gallerie['nom']; ?>" class="link-galerie lightbox" rel="group1">
					<img src="<?php echo $config_urlsite; ?>/upload/<?php echo $sql_gallerie['image']; ?>" alt="<?php echo stripslashes($sql_gallerie['nom']); ?>" border="0">
				</a>
<?php

	
	}
?>
			</div>
		</div>


		<div class="content">
			<div class="newsletter">
				<h1 class="t1"><?php echo stripslashes($rows[3]['valeur']); ?></h1>
				<p><?php echo stripslashes($rows[4]['valeur']); ?></p>

				<form action="" method="POST">
					<input type="text" name="email_newsletter" placeholder="Votre courriel">
					<button type="submit"><i class="fa fa-paper-plane"></i></button>
				</form>
			</div>
		</div>