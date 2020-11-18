<?php

##################################
############ NorthCryo ###########
##################################
?>

	<meta name="keywords" content="Cellulite, Cryo, Froid, Cryotherapy Machine, Cardiaque, Air Liquide, Cryogenic, Cryosauna, Cryo Chamber, Azote, Azote Liquide, Cryogenic Therapy, Sauna, Pour Verrue, Cabine, Santé Bien, Sport, Douleur Corps, Douleur, Remise En Forme" />
	<meta name="description" content="<?php echo $meta_desc; ?>" />
	<meta name="author" content="WebKreativ" />

	<meta name="google-site-verification" content="fLOVkzZJsjVPahxtBTYNU70k83YxyjGsfgHvwn8on40" />
	<meta name="msvalidate.01" content="B49C25251272E018A688026194BFAA7D" />
	<meta name='yandex-verification' content='46ebc71dda0e85dd' />

	<link rel="canonical" href="<?php echo $config_urlsite; ?>/<?php echo $seo_url; ?>" />
	<?php if(!empty($config_google)) { ?>
	<link rel="publisher" href="<?php echo $config_google; ?>" />
	<?php }?>

	<script type="application/ld+json">
	{
	  "@context" : "http://schema.org",
	  "@type" : "Organization",
	  "name" : "<?php echo $config_nomsite; ?>",
	  "url" : "<?php echo $config_urlsite; ?>",
	  "sameAs" : [
<?php 
	  if(!empty($config_facebook)) { 		echo '"' .  $config_facebook . '", ', PHP_EOL;   } 
	  if(!empty($config_twitter)) { 	echo '"' .  $config_twitter . '",', PHP_EOL;   } 
	  if(!empty($config_google)) { 	echo '"' .  $config_google . '",', PHP_EOL;   } 
	  if(!empty($config_youtube)) { 	echo '"' .  $config_youtube . '",', PHP_EOL;   } 
	  if(!empty($config_instagram)) { echo '"' .  $config_instagram . '",', PHP_EOL;   } 
?>

	  ]
	}
	</script>

	<meta itemprop="name" content="<?php echo $title; ?> / <?php echo $config_nomsite; ?>">
	<meta itemprop="description" content="<?php echo $meta_desc; ?>">

	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@publisher_handle">
	<meta name="twitter:title" content="<?php echo $title; ?> / <?php echo $config_nomsite; ?>">
	<meta name="twitter:description" content="<?php echo $meta_desc; ?>">
	<meta name="twitter:image" content="<?php echo $config_urlsite; ?>/upload/northcryo-com.jpg" />

	<meta property="og:title" content="<?php echo $title; ?> / <?php echo $config_nomsite; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php echo $config_urlsite; ?>/<?php echo $seo_url; ?>" />
	<meta property="og:description" content="<?php echo $meta_desc; ?>" /> 
	<meta property="og:site_name" content="<?php echo $config_nomsite; ?>" />
	<meta property="og:image" content="<?php echo $config_urlsite; ?>/upload/northcryo-com.jpg" />