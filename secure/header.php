<?php

##################################
############ NorthCryo ###########
##################################

?>
<!DOCTYPE html>
<html lang="en">
<head>

<title><?php echo $titre_page; ?> - Panneau d'administration</title>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/matrix-media.css" />
<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/bootstrap-wysihtml5.css" />


<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,800" />

<?php
if(isset($_GET['page']) && $_GET['page'] == 'commandes' or isset($_GET['page']) && $_GET['page'] == 'erreur' or isset($_GET['page']) && $_GET['page'] == 'categories'  or isset($_GET['page']) && $_GET['page'] == 'utilisateurs'  or isset($_GET['page']) && $_GET['page'] == 'produits' ){
?>
<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/uniform.css" />
<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/select2.css" />
<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/datepicker.css" />
<?php }
if(isset($_GET['page']) && $_GET['page'] == 'ajout-produit' ){
?>
<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/uniform.css" />
<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/select2.css" />
<?php } ?>


</head>
<body>

<div id="header">
  <h1><a href="<?php echo $config_urladmin; ?>">Matrix Admin</a></h1>
</div>
<div id="sidebar"><a href="<?php echo $config_urladmin; ?>" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if(!isset($_GET['page'])){echo'class="active"';} ?>><a href="<?php echo $config_urladmin; ?>"><i class="icon icon-home"></i> <span>Accueil</span></a> </li>
    <li <?php if(isset($_GET['page']) && $_GET['page'] == 'stats'){echo'class="active"';} ?>><a href="<?php echo $config_urladmin; ?>/index.php?page=stats"><i class="icon icon-signal"></i> <span>Statistiques</span></a> </li>

    <li <?php if(isset($_GET['page']) && $_GET['page'] == 'slider'){echo'class="active"';} ?>><a href="<?php echo $config_urladmin; ?>/index.php?page=slider"><i class="icon icon-picture"></i> <span>Slider</span></a> </li>
    <li  <?php if(isset($_GET['page']) && $_GET['page'] == 'cabine' or isset($_GET['page']) && $_GET['page'] == 'gallerie'){echo'class="submenu active"';} else {echo'class="submenu"';} ?>> <a href="#"><i class="icon  icon-shopping-cart"></i> <span>Cabines</span> <span class="label">3</span></a>
      <ul>
        <li><a href="<?php echo $config_urladmin; ?>/index.php?page=cabine">Les cabines</a></li>
        <li><a href="<?php echo $config_urladmin; ?>/index.php?page=cabine&ajout=1">Ajouter une cabine</a></li>
        <li><a href="<?php echo $config_urladmin; ?>/index.php?page=gallerie">Gallerie photo</a></li>
      </ul>
    </li>

    <!--  autres equipements -->

    <li  <?php if(isset($_GET['page']) && $_GET['page'] == 'autres' or isset($_GET['page']) && $_GET['page'] == 'gallerie'){echo'class="submenu active"';} else {echo'class="submenu"';} ?>> <a href="#"><i class="icon  icon-shopping-cart"></i> <span>Autres equipements</span> <span class="label">3</span></a>
      <ul>
        <li><a href="<?php echo $config_urladmin; ?>/index.php?page=autres">Les autres équipements</a></li>
        <li><a href="<?php echo $config_urladmin; ?>/index.php?page=autres&ajout=2">Ajouter un équipement</a></li>
        <li><a href="<?php echo $config_urladmin; ?>/index.php?page=gallerie">Gallerie photo</a></li>
      </ul>
    </li>


    <li <?php if(isset($_GET['page']) && $_GET['page'] == 'client'){echo'class="active"';} ?>><a href="<?php echo $config_urladmin; ?>/index.php?page=client"><i class="icon icon-user"></i> <span>Clients</span></a> </li>
  
    <li  <?php if(isset($_GET['page']) && $_GET['page'] == 'tpl' or isset($_GET['page']) && $_GET['page'] == 'pages'){echo'class="submenu active"';} else {echo'class="submenu"';} ?>> <a href="#"><i class="icon  icon-file"></i> <span>Pages</span> <span class="label">4</span></a>
      <ul>
        <li><a href="<?php echo $config_urladmin; ?>/index.php?page=tpl&id=1">Accueil</a></li>
        <li><a href="<?php echo $config_urladmin; ?>/index.php?page=tpl&id=2">A Propos</a></li>
        <li><a href="<?php echo $config_urladmin; ?>/index.php?page=tpl&id=3">Mentions légales</a></li>
        <li><a href="<?php echo $config_urladmin; ?>/index.php?page=pages">Gestion des pages</a></li>
      </ul>
    </li>
    <li <?php if(isset($_GET['page']) && $_GET['page'] == 'textes'){echo'class="active"';} ?>><a href="<?php echo $config_urladmin; ?>/index.php?page=textes"><i class="icon icon-align-center"></i> <span>Textes</span></a> </li>
    <li <?php if(isset($_GET['page']) && $_GET['page'] == 'job'){echo'class="active"';} ?>><a href="<?php echo $config_urladmin; ?>/index.php?page=job"><i class="icon icon-inbox"></i> <span>Offre d'emploi</span></a> </li>
   	<li <?php if(isset($_GET['page']) && $_GET['page'] == 'parametres'){echo'class="active"';} ?>><a href="<?php echo $config_urladmin; ?>/index.php?page=parametres"><i class="icon icon-cogs"></i> <span>Paramètres</span></a> </li>
    <li <?php if(isset($_GET['page']) && $_GET['page'] == 'user'){echo'class="active"';} ?>><a href="<?php echo $config_urladmin; ?>/index.php?page=user"><i class="icon icon-user"></i> <span>Utilisateur</span></a> </li>
    <li <?php if(isset($_GET['page']) && $_GET['page'] == 'newsletter'){echo'class="active"';} ?>><a href="<?php echo $config_urladmin; ?>/index.php?page=newsletter"><i class="icon icon-envelope-alt"></i> <span>Newsletter</span></a> </li>
    <li ><a href="<?php echo $config_urladmin; ?>/?logout"><i class="icon icon-signout"></i> <span>Déconnexion</span></a> </li>
   
   </ul> 
</div>