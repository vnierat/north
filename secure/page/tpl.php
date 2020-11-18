<?php

##################################
############ NorthCryo ###########
##################################

$msg ='';

if(isset($_GET['id'])){

if($_GET['id'] == 1){

	$nom_page = 'd\'accueil';
	$tpl = 'accueil.tpl'; 

} else if($_GET['id'] == 2){

	$nom_page = 'd\'à propos'; 
	$tpl = 'apropos.tpl'; 

} else if($_GET['id'] == 3){

	$nom_page = 'des mentions légales';
	$tpl = 'legal.tpl';  

}

if(isset($_POST['tpl'])){


$fileName = "../system/tpl/".$tpl; 
$handle = fopen($fileName, "w"); 
fwrite($handle, $_POST['tpl']);


fclose($handle);


$msg = " <div class=\"row-fluid\"><div class=\"span12\"><div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
        	La page a bien été modifié</div></div></div>";
}

?>

<div id="content">
  	<div id="content-header">
    	<div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a class="current">Offre d'emploi</a> </div>
    	<h1>Gestion de la page <?php echo $nom_page; ?></h1>
  	</div>
  	<div class="container-fluid">
	    <hr>
		<div class="row-fluid">
		    <div class="span12">
		    <?php echo $msg; ?>
     <form action="<?php echo $config_urladmin; ?>/index.php?page=tpl&id=<?php echo $_GET['id']; ?>" method="post" class="form-horizontal">

 				<div class="control-group">
<textarea class="span12" name="tpl" style="height:700px;"><?php include('../system/tpl/' . $tpl); ?></textarea>
	              
		        </div>


                <div class="form-actions">
                  <button type="submit" name="edit" value="<?php echo $_GET['id']; ?>" class="btn btn-danger">Modifier</button>
                </div>


     </form>
     </div>
    </div>

	</div>
</div>

<?php

	}

?>