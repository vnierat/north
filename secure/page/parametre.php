<?php

###########################
############ CK ###########
###########################

$msg = '';

if(isset($_POST['edit'])){


$countx =  mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(id) AS nbr FROM " . $prefix_sql . "_configuration")); 

for($i = 1; $i <= $countx['nbr']; $i++){

if(isset($_POST['hidden'.$i.''])){

$fichier = '0';

if($_FILES['config'.$i.'']['size'] > 0){
$extension_upload = substr(strrchr($_FILES['config'.$i.'']['name'], '.')  ,1);
$nom_file = random(5).'-'.url_rewriting($_FILES['config'.$i.'']['name']).'.'.$extension_upload;
upload_file($_FILES['config'.$i.''], $nom_file);
$visuel = $nom_file;

$value = $nom_file;
} else {

$countx2 =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_configuration WHERE id = ".$i." ")); 


$value = addslashes($countx2['valeur']);

}


} else {

$value = addslashes($_POST['config'.$i.'']);

}

 // Mise a jour de la sql
mysqli_query($link, "UPDATE " . $prefix_sql . "_configuration SET valeur = '" . $value . "' WHERE id = ".$i." ");


}

$msg = " <div class=\"row-fluid\"><div class=\"span12\"><div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
        	Les paramètres ont bien été modifié.</div></div></div>";

}

?>
<div id="content">
  	<div id="content-header">
    	<div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a class="current">Paramètres</a> </div>
    	<h1>Paramètres du site</h1>
  	</div>
  	<div class="container-fluid">
	    <hr>
		 <div class="row-fluid">
		    <div class="span12">

		    <?php echo $msg; ?>

		     <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		     <div class="widget-box">
		        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
		          <h5>Paramètres</h5>
		        </div>
		        <div class="widget-content nopadding">

<?php 
	$i = 1;
	$formsql =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_configuration ORDER by id"); 
	while($sql_form = mysqli_fetch_array($formsql)) {


	if($sql_form['type'] == 1) {

?>
	            <div class="control-group">
	              <label class="control-label"><?php echo stripslashes($sql_form['nom']); ?> :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="config<?php echo stripslashes($sql_form['id']); ?>" value="<?php echo stripslashes($sql_form['valeur']); ?>">
	              </div>
	            </div>
<?php 
		} else if($sql_form['type'] == 3) {
?>

	   		<div class="control-group">
			 	<label class="control-label"><?php echo stripslashes($sql_form['nom']); ?> :</label>
				 	<div class="controls">
				    	<input type="file" name="config<?php echo stripslashes($sql_form['id']); ?>" />
				    	<input type="hidden" name="hidden<?php echo stripslashes($sql_form['id']); ?>" value="1">
				        <span class="help-block">
				        	<?php echo stripslashes($sql_form['nom']); ?> :
					        <a href="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_form['valeur']); ?>" target="_blank">
					        	 <?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_form['valeur']); ?>
					        </a>
				        </span>				
				    </div>
			</div>




<?php

		} 
	}



?>
		            <div class="form-actions">
		              <button type="submit" name="edit" value="1" class="btn btn-danger">Modifier</button>
		            </div>
		        </div>
		     </div>
		     </form>
		</div>
	</div>
</div>