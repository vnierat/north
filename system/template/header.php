<?php

##################################
############ NorthCryo ###########
##################################


	$sqlpage =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_pages WHERE id = '".$active_link."'"));

	if($active_link == 14){
		$title = $head_titre_page;
		$meta_desc = $description_page;
	} else {
		$title = stripslashes($sqlpage['titre_page']);
		$meta_desc = stripslashes($sqlpage['desc_page']);
	}

?>
<!doctype html>
<html class="no-js" lang="fr" itemscope itemtype="http://schema.org/WebPage">
<head>
	<meta charset="UTF-8">
	<title><?php if($erreur != 0){ echo 'Erreur 404'; } else { echo $title; }?> | <?php echo  $config_nomsite; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo $config_urlsite; ?>/theme/css/knacss.css" media="all">
	<link rel="stylesheet" href="<?php echo $config_urlsite; ?>/theme/css/styles.css" media="all">
	<!-- Style default VN -->
	<!--<link rel="stylesheet" href="<?php echo $config_urlsite; ?>/theme/css/style.sea.css" media="all">-->
	<link rel="stylesheet" href="<?php echo $config_urlsite; ?>/theme/css/responsive.css" media="screen">
	<link rel="stylesheet" href="<?php echo $config_urlsite; ?>/theme/css/font-awesome.css" media="all">
	<link rel="stylesheet" href="<?php echo $config_urlsite; ?>/theme/css/slick.css" media="all">
	<link rel="stylesheet" href="<?php echo $config_urlsite; ?>/theme/css/aos.css" media="all">
	<!-- Bootstrap -->
	<!--<link rel="stylesheet" href="<?php echo $config_urlsite; ?>/theme/css/bootstrap.min.css" media="all">
	<!-- Bootstrap Select -->
	<!--<link rel="stylesheet" href="<?php echo $config_urlsite; ?>/theme/css/bootstrap-select.min.css" media="all">-->


	<?php
	if($active_link == 3 or $active_link == 4){
	?>

	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $config_urlsite; ?>/theme/js/lightbox/themes/carbono/jquery.lightbox.css"/>
	<?php
	}
	?>

	<link rel="icon" type="image/png" href="<?php echo $config_urlsite; ?>/theme/img/favicon.png" />
	<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="<?php echo $config_urlsite; ?>/theme/img/favicon.ico" /><![endif]-->

	<?php

    if($erreur == 0){ include ('system/fonction/seo.php'); }

    ?>
</head>
<body>

<div class="header" id="<?php echo $css; ?>" style="background-image:url(<?php echo $config_urlsite . '/upload/' . $config_bg; ?>);">
		<div class="overlay-header">
			<div class="content">
				<div class="top">
					<a href="<?php echo $config_urlsite; ?>" class="logo">
						<img src="<?php echo $config_urlsite; ?>/theme/img/logo.png" alt="Logo <?php echo  $config_nomsite; ?>" border="0">
						North<span>Cryo</span>
					</a>

					<ul class="nav">
						<li <?php if($active_link == 1){ echo ' class="on"'; }?>>
							<a href="<?php echo $config_urlsite; ?>" title="Page d'accueil de NorthCryo">
								Accueil
							</a>
						</li>
						<li <?php  if($active_link == 2){ echo ' class="on"'; }?>>
							<a href="<?php echo $config_urlsite; ?>/a-propos" title="Présentation de la société NorthCryo">
								À propos
							</a>
						</li>
						<li <?php if($active_link == 3){ echo ' class="on"'; }?>>
							<a href="<?php echo $config_urlsite; ?>/nos-cabines" title="Catalogue de nos cabines">
								Nos cabines
							</a>
						</li>
						<li <?php if($active_link == 4){ echo ' class="on"'; }?>>
							<a href="<?php echo $config_urlsite; ?>/cryolipolyse" title="cryolipolyse">
								Cryolipolyse
							</a>
						</li> 
						<li <?php if($active_link == 5){ echo ' class="on"'; }?>>
							<a href="<?php echo $config_urlsite; ?>/contact" title="Formulaire et coordonnées de contact">
								Contact
							</a>
						</li>

					</ul>
				</div>


<?php

if($active_link == 1){

	echo '<div class="home-slider">';

$sqlcat =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_slider ORDER by id");
while($sql_slider = mysqli_fetch_array($sqlcat)) {

?>
<div>
	<div class="txt">
		<h1><?php echo stripslashes($sql_slider['txt']); ?></h1>
		<a href="<?php echo stripslashes($sql_slider['link']); ?>" title="Appareil de Cryotherapie, cryoness Blue" class="cta-slider">
			Découvrir <i class="fa fa-angle-right"></i>
		</a>
	</div>
	<div class="cabines">
		<img src="<?php echo $config_urlsite . '/upload/' . $sql_slider['img']; ?>" alt="Cryosauna Cryoness Blue">
	</div>
</div>

<?php

}

echo '</div>

<span class="prev-slider-btn"><i class="fa fa-angle-left"></i></span>
<span class="next-slider-btn"><i class="fa fa-angle-right"></i></span>';

} else {

 if($active_link != 14 && $error404 != 1){

	$head_titre_page = stripslashes($sqlpage['titre']);
	$head_intro_page = stripslashes($sqlpage['intro']);

}
?>
				<div class="titre-page">
					<h1 class="t2"><?php echo $head_titre_page; ?></h1>
					<p class="intro-page"><?php echo $head_intro_page; ?></p>
				</div>
<?php

}

?>
			</div>

   			<button class="toggle-nav c-hamburger c-hamburger--htx">
			  	<span>toggle menu</span>
			</button>

		</div>
	</div>

	<div class="corps <?php echo $css; ?>">
		<div class="content">
