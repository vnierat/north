<?php

##################################
############ NorthCryo ###########
##################################

$msg = '';


if(isset($_GET['supprimer']) && is_numeric($_GET['supprimer'])){
 
mysqli_query($link, 'DELETE FROM ' . $prefix_sql . '_autres WHERE id = "' . $_GET['supprimer'] . '" ');

$msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
         La cabine a bien été supprimer.</div>";
}

if(isset($_POST['nom']) && isset($_POST['edit'])){


  $nom = addslashes($_POST['nom']);
  $baseline = addslashes($_POST['baseline']);
  $reference = addslashes($_POST['reference']);
  $note = addslashes($_POST['note']);
  $description = addslashes($_POST['description']);
  $texte = addslashes($_POST['texte']);
  $carac1 = addslashes($_POST['carac1']);
  $carac2 = addslashes($_POST['carac2']);
  $carac3 = addslashes($_POST['carac3']);
  $carac4 = addslashes($_POST['carac4']);
  $carac5 = addslashes($_POST['carac5']);
  $carac6 = addslashes($_POST['carac6']);

  $pdf = '0';
  $photo = '0';



$countx2 =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_autres WHERE id = ".$_POST['edit']." ")); 

if($_FILES['pdf']['name']){
$extension_upload = substr(strrchr($_FILES['pdf']['name'], '.')  ,1);
$nom_file = random(5).'-documentation-'.url_rewriting($_POST['nom']).'.'.$extension_upload;
upload_file($_FILES['pdf'], $nom_file);
$pdf = $nom_file;
} else {
	$pdf = $countx2['doc_pdf'];
}

if($_FILES['photo']['name']){
$extension_upload = substr(strrchr($_FILES['photo']['name'], '.')  ,1);
$nom_file = random(5).'-'.url_rewriting($_POST['nom']).'.'.$extension_upload;
upload_file($_FILES['photo'], $nom_file);
$photo = $nom_file;
} else {
	$photo = $countx2['image'];
}



 // Mise a jour de la sql
mysqli_query($link, "UPDATE " . $prefix_sql . "_autres SET

	nom = '" . $nom . "', 
	baseline = '" . $baseline . "', 
	image = '" . $photo . "',
	reference = '" . $reference . "', 
	note = '" . $note . "',
	description = '" . $description . "',
	texte = '" . $texte . "',
	doc_pdf = '" . $pdf . "',
	carac1 = '" . $carac1 . "',
	carac2 = '" . $carac2 . "',
	carac3 = '" . $carac3 . "',
	carac4 = '" . $carac4 . "',
	carac5 = '" . $carac5 . "',
	carac6 = '" . $carac6 . "'

	WHERE id = ".$_POST['edit']." ");



  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          La cabine a bien été modifié.</div>";

}

if(isset($_POST['nom']) && !isset($_POST['edit'])){


  $nom = addslashes($_POST['nom']);
  $baseline = addslashes($_POST['baseline']);
  $reference = addslashes($_POST['reference']);
  $note = addslashes($_POST['note']);
  $description = addslashes($_POST['description']);
  $texte = addslashes($_POST['texte']);
  $carac1 = addslashes($_POST['carac1']);
  $carac2 = addslashes($_POST['carac2']);
  $carac3 = addslashes($_POST['carac3']);
  $carac4 = addslashes($_POST['carac4']);
  $carac5 = addslashes($_POST['carac5']);
  $carac6 = addslashes($_POST['carac6']);

  $pdf = '0';
  $photo = '0';




if($_FILES['pdf']['name']){
$extension_upload = substr(strrchr($_FILES['pdf']['name'], '.')  ,1);
$nom_file = random(5).'-documentation-'.url_rewriting($_POST['nom']).'.'.$extension_upload;
upload_file($_FILES['pdf'], $nom_file);
$pdf = $nom_file;
} 

if($_FILES['photo']['name']){
$extension_upload = substr(strrchr($_FILES['photo']['name'], '.')  ,1);
$nom_file = random(5).'-'.url_rewriting($_POST['nom']).'.'.$extension_upload;
upload_file($_FILES['photo'], $nom_file);
$photo = $nom_file;
}




    mysqli_query($link, "INSERT INTO " . $prefix_sql . "_autres VALUES('', 

    	'".$nom."', 
    	'".$baseline."', 
    	'".$photo."', 
    	'".$reference."', 
    	'".$note."',
    	'".$description."',
    	'".$texte."',
    	'".$pdf."',
    	'".$carac1."',
    	'".$carac2."',
    	'".$carac3."',
    	'".$carac4."',
    	'".$carac5."',
    	'".$carac6."')");


  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          La cabine a bien été ajouté.</div>";

}
?>

<div id="content">
  	<div id="content-header">
    	<div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a class="current">Les cabines</a> </div>
    	<h1>Gestion des autres équipements</h1>
  	</div>
  	<div class="container-fluid">
	    <hr>

<?php
if(isset($_GET['ajout'])) {

?>
		<div class="row-fluid">
		    <div class="span12">
<form action="<?php echo $config_urladmin; ?>/index.php?page=autres" method="post" class="form-horizontal" enctype="multipart/form-data">
         <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Ajouter une cabine</h5>
            </div>
            <div class="widget-content nopadding">

	            <div class="control-group">
	              <label class="control-label">Nom :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="nom">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Référence :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="reference">
	              </div>
	            </div>


		   		<div class="control-group">
				 	<label class="control-label">Photo :</label>
					 	<div class="controls">
					    	<input type="file" name="photo" />		
					    </div>
				</div>

	            <div class="control-group">
	              <label class="control-label">Courte description :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="baseline">
	              </div>
	            </div>

        <div class="control-group">
                <label class="control-label">Description complète :</label>
                <div class="controls">
<textarea class=" span11" name="description" style="height:200px;"></textarea>
                
              </div>
            </div>


 				<div class="control-group">
	              <label class="control-label">Informations supplémentaires :</label>
	              <div class="controls">
<textarea class="textarea_editor span11" name="texte" style="height:350px;"></textarea>
	              
	            </div>
		        </div>


	            <div class="control-group">
	              <label class="control-label">Note :</label>
	              <div class="controls" >
	          
	                <label style="display:inline-table; margin-right: 10px;">
                  <input type="radio" name="note" value="1"/>
                  1/5</label>
                <label style="display:inline-table; margin-right: 10px;">
                  <input type="radio" name="note" value="2" />
                  2/5</label>
                <label style="display:inline-table; margin-right: 10px;">
                  <input type="radio" name="note" value="3" />
                  3/5</label>
                   <label style="display:inline-table; margin-right: 10px;">
                  <input type="radio" name="note" value="4" />
                  4/5</label>
                   <label style="display:inline-table; margin-right: 10px;">
                  <input type="radio" name="note" value="5" />
                  5/5</label>
              </div>
	              </div>
	   		<div class="control-group">
			 	<label class="control-label">Documentation PDF :</label>
				 	<div class="controls">
				    	<input type="file" name="pdf" />		
				    </div>
			</div>



	            <div class="control-group">
	              <label class="control-label">Consommation d'azote par traitement :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac1">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Volume du bruit :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac2">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Poids hors bonbonne d'azote :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac3">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Consommation maximale :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac4">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Température cabine :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac5">
	              </div>
	            </div>



	            <div class="control-group">
	              <label class="control-label">Durée de traitement :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac6" >
	              </div>
	            </div>


                <div class="form-actions">
                  <button type="submit" name="submit" value="1" class="btn btn-danger">Ajouter</button>
                </div>
        </div>
  </form>
</div>
</form>
<?php

} else if(isset($_GET['edit'])){

            $sql_url = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_autres WHERE id = '" . $_GET['edit'] . "' "))
?>

		<div class="row-fluid">
		    <div class="span12">
<form action="<?php echo $config_urladmin; ?>/index.php?page=autres" method="post" class="form-horizontal" enctype="multipart/form-data">
         <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Modifier la cabine : 
              </h5>
              </div>
            <div class="widget-content nopadding">

	            <div class="control-group">
	              <label class="control-label">Nom :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="nom" value="<?php echo stripslashes($sql_url['nom']); ?>">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Référence :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="reference" value="<?php echo stripslashes($sql_url['reference']); ?>">
	              </div>
	            </div>


		   		<div class="control-group">
				 	<label class="control-label">Photo :</label>
					 	<div class="controls">
					    	<input type="file" name="photo" />		
					    	<span class="help-block">
				        	Photo actuelle :
					        <a href="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_url['image']); ?>" target="_blank">
					        	 <?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_url['image']); ?>
					        </a>
				        </span>			
					    </div>
				</div>

	            <div class="control-group">
	              <label class="control-label">Courte description :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="baseline" value="<?php echo stripslashes($sql_url['baseline']); ?>">
	              </div>
	            </div>

        <div class="control-group">
                <label class="control-label">Description complète :</label>
                <div class="controls">
<textarea class=" span11" name="description" style="height:200px;"><?php echo stripslashes($sql_url['description']); ?></textarea>
                
              </div>
            </div>


 				<div class="control-group">
	              <label class="control-label">Informations supplémentaires :</label>
	              <div class="controls">
<textarea class="textarea_editor span11" name="texte" style="height:350px;"> <?php echo stripslashes($sql_url['texte']); ?></textarea>
	              
	            </div>
		        </div>


	            <div class="control-group">
	              <label class="control-label">Note :</label>
	              <div class="controls" >
	               
                  <input type="radio" name="note" value="1" <?php if($sql_url['note'] == 1) { echo 'checked'; }?> />
                  1/5</label>
                <label style="display:inline-table; margin-right: 10px;">
                  <input type="radio" name="note" value="2" <?php if($sql_url['note'] == 2) { echo 'checked'; } ?> />
                  2/5</label>
                <label style="display:inline-table; margin-right: 10px;">
                  <input type="radio" name="note" value="3" <?php if($sql_url['note'] == 3) { echo 'checked';} ?> />
                  3/5</label>
                   <label style="display:inline-table; margin-right: 10px;">
                  <input type="radio" name="note" value="4" <?php if($sql_url['note'] == 4) { echo 'checked'; }?> />
                  4/5</label>
                   <label style="display:inline-table; margin-right: 10px;">
                  <input type="radio" name="note" value="5" <?php if($sql_url['note'] == 5) { echo 'checked'; }?> />
                  5/5</label>
              </div>
	              </div>
	   		<div class="control-group">
			 	<label class="control-label">Documentation PDF :</label>
				 	<div class="controls">
				    	<input type="file" name="pdf" />		
				    	<span class="help-block">
				        	Fichier actuel :
					        <a href="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_url['doc_pdf']); ?>" target="_blank">
					        	 <?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_url['doc_pdf']); ?>
					        </a>
				        </span>			
				    </div>
			</div>



	            <div class="control-group">
	              <label class="control-label">Consommation d'azote par traitement :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac1"  value="<?php echo stripslashes($sql_url['carac1']); ?>">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Volume du bruit :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac2" value="<?php echo stripslashes($sql_url['carac2']); ?>">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Poids hors bonbonne d'azote :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac3" value="<?php echo stripslashes($sql_url['carac3']); ?>">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Consommation maximale :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac4" value="<?php echo stripslashes($sql_url['carac4']); ?>">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Température cabine :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac5" value="<?php echo stripslashes($sql_url['carac5']); ?>">
	              </div>
	            </div>


	            <div class="control-group">
	              <label class="control-label">Durée de traitement  :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="carac6" value="<?php echo stripslashes($sql_url['carac6']); ?>">
	              </div>
	            </div>



                <div class="form-actions">
                  <button type="submit" name="edit" value="<?php echo $_GET['edit']; ?>" class="btn btn-danger">Modifier</button>
                </div>
        </div>
  </form>
</div>
</form>

<?php

} else {

?>


      <?php echo $msg; ?>
		<div class="row-fluid">
		    <div class="span12">


   <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Les autres équipements</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Photo</th>
                  <th>Nom</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
<?php
$sqlitem =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_autres ORDER by id DESC"); 
while($sql_user = mysqli_fetch_array($sqlitem)) {


?>
                <tr>                                                     
                  <td><center><img  width="100" src="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_user['image']); ?>"></center></td>
                  <td><center><?php echo stripslashes($sql_user['nom']); ?></center></td>
               

                  <td class="center"><center>
                  	<a  href="<?php echo $config_urladmin; ?>/index.php?page=autres&edit=<?php echo $sql_user['id']; ?>" class="btn btn-primary btn-mini"><span class=" icon-edit"></span></a>
                  	<a onclick="return confirm('Voulez vous vraiment supprimer cette cabine : <?php echo stripslashes($sql_user['nom']); ?>')" href="<?php echo $config_urladmin; ?>/index.php?page=autres&supprimer=<?php echo $sql_user['id']; ?>" class="btn btn-danger btn-mini"><span class=" icon-remove"></span></a></center>
                  </td>
                </tr>
<?php 
}
?>
              </tbody>
            </table>
          </div>
        </div>


		    </div>
		    </div>

<?php
}

?>
</div>
</div>