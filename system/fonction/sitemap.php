<?php

###########################
############ CK ###########
###########################

// System
require ("smarty/Smarty.class.php"); 
require ("fonctions.php"); 
require ("../config.php"); 

header('Content-type: application/xml');
// Encodage UTF-8 du sitemap
echo "<?xml version='1.0' encoding='UTF-8' ?>";
?>

<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url> 
    <loc><?php echo $config_urlsite; ?></loc> 
    <priority>1</priority>
</url>

<?php
$sqlitem =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_cabine "); 
while($sql_item = mysqli_fetch_array($sqlitem)) {
?>
<url> 
    <loc><?php echo $config_urlsite; ?>/cabine/<?php echo stripslashes($sql_item['id']); ?>/<?php echo url_rewriting(stripslashes($sql_item['nom'])); ?></loc> 
    <priority>0.9</priority>
</url>
<?php } ?>

<url> 
    <loc><?php echo $config_urlsite; ?>/a-propos</loc> 
    <priority>0.8</priority>
</url>

<url> 
    <loc><?php echo $config_urlsite; ?>/nos-cabines</loc> 
    <priority>0.8</priority>
</url>

<url> 
    <loc><?php echo $config_urlsite; ?>/contact</loc> 
    <priority>0.7</priority>
</url>

<url> 
    <loc><?php echo $config_urlsite; ?>/job</loc> 
    <priority>0.6</priority>
</url>
</urlset> 