<?php

##################################
############ NorthCryo ###########
##################################

$msg = '';

if(isset($_GET['supprimer']) && is_numeric($_GET['supprimer'])){
 
mysqli_query($link, 'DELETE FROM ' . $prefix_sql . '_clients WHERE id = "' . $_GET['supprimer'] . '" ');

$msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          Le client a bien été supprimer.</div>";
}


if(isset($_GET['supprimerimg']) && is_numeric($_GET['supprimerimg'])){
 
 // Mise a jour de la sql
mysqli_query($link, "UPDATE " . $prefix_sql . "_clients SET photo_client = '' WHERE id = ".$_GET['supprimerimg']." ");





$msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          La photo du client a bien été supprimer.</div>";



}


if(isset($_POST['texte']) && isset($_POST['auteur']) && isset($_POST['edit'])){


  $texte = addslashes($_POST['texte']);
  $auteur = addslashes($_POST['auteur']);
  $poste = addslashes($_POST['poste']);

  $logo = '0';
$photo = '0';



$countx2 =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_clients WHERE id = ".$_POST['edit']." ")); 

if($_FILES['logo']['name']){
$extension_upload = substr(strrchr($_FILES['logo']['name'], '.')  ,1);
$nom_file = random(5).'-'.url_rewriting($_FILES['logo']['name']).'.'.$extension_upload;
upload_file($_FILES['logo'], $nom_file);
$logo = $nom_file;
} else {
	$logo = $countx2['logo'];
}

if($_FILES['photo']['name']){
$extension_upload = substr(strrchr($_FILES['photo']['name'], '.')  ,1);
$nom_file = random(5).'-'.url_rewriting($poste).'.'.$extension_upload;
upload_file($_FILES['photo'], $nom_file);
$photo = $nom_file;
} else {
	$photo = $countx2['photo_client'];
}


 // Mise a jour de la sql
mysqli_query($link, "UPDATE " . $prefix_sql . "_clients SET

	logo = '" . $logo . "', 
	texte = '" . $texte . "', 
	auteur = '" . $auteur . "',
	poste = '" . $poste . "', 
	photo_client = '" . $photo . "'

	WHERE id = ".$_POST['edit']." ");



  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          Le client a bien été modifié.</div>";
}


if(isset($_POST['texte']) && isset($_POST['auteur']) && !isset($_POST['edit'])){

  $texte = addslashes($_POST['texte']);
  $auteur = addslashes($_POST['auteur']);
  $poste = addslashes($_POST['poste']);

$logo = '0';
$photo = '0';


if($_FILES['logo'] > 0){
$extension_upload = substr(strrchr($_FILES['logo']['name'], '.')  ,1);
$nom_file = random(5).'-'.url_rewriting($_FILES['logo']['name']).'.'.$extension_upload;
upload_file($_FILES['logo'], $nom_file);
$logo = $nom_file;
}

if($_FILES['photo'] > 0){
$extension_upload = substr(strrchr($_FILES['photo']['name'], '.')  ,1);
$nom_file = random(5).'-'.url_rewriting($poste).'.'.$extension_upload;
upload_file($_FILES['photo'], $nom_file);
$photo = $nom_file;
}

    mysqli_query($link, "INSERT INTO " . $prefix_sql . "_clients VALUES('', '".$logo."', '".$texte."', '".$auteur."', '".$poste."', '".$photo."')");

  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          Le client a bien été ajouté.</div>";

}

?>
<div id="content">
  	<div id="content-header">
    	<div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a class="current">Nos clients</a> </div>
    	<h1>Gestion des clients</h1>
  	</div>
  	<div class="container-fluid">
	    <hr>

      <?php echo $msg; ?>
		<div class="row-fluid">
		    <div class="span3">


   <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Les clients :</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Société</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
<?php
$sqlitem =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_clients ORDER by id DESC"); 
while($sql_user = mysqli_fetch_array($sqlitem)) {


?>
                <tr>                                                     
                  <td align="center">
                  <center><img src="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_user['logo']); ?>" width="70"></center></td>
  
               

                  <td class="center">
                  	<center>
                  	<a  href="<?php echo $config_urladmin; ?>/index.php?page=client&edit=<?php echo $sql_user['id']; ?>" class="btn btn-primary btn-mini"><span class=" icon-edit"></span></a>
                  	<a onclick="return confirm('Voulez vous vraiment supprimer ce client ?')" href="<?php echo $config_urladmin; ?>/index.php?page=client&supprimer=<?php echo $sql_user['id']; ?>" class="btn btn-danger btn-mini"><span class=" icon-remove"></span></a>
                  	</center>
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
		    <div class="span9">

        <?php if(isset($_GET['edit'])) {

            $sql_url = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_clients WHERE id = '" . $_GET['edit'] . "' "))

          ?>

 <form action="<?php echo $config_urladmin; ?>/index.php?page=client" method="post" class="form-horizontal" enctype="multipart/form-data">
         <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Modifier un client</h5>
            </div>
            <div class="widget-content nopadding">


	   		<div class="control-group">
			 	<label class="control-label">Logo :</label>
				 	<div class="controls">
				    	<input type="file" name="logo" />	
				    	<span class="help-block">
				        	Logo actuel :
					        <a href="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_url['logo']); ?>" target="_blank">
					        	 <?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_url['logo']); ?>
					        </a>
				        </span>			
				    </div>
			</div>

        <div class="control-group">
                <label class="control-label">Témoignage :</label>
                <div class="controls">
<textarea class=" span11" name="texte" style="height:150px;"><?php echo stripslashes($sql_url['texte']); ?></textarea>
                
              </div>
            </div>

	            <div class="control-group">
	              <label class="control-label">Auteur :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="auteur" value="<?php echo stripslashes($sql_url['auteur']); ?>">
	              </div>
	            </div>

	            <div class="control-group">
	              <label class="control-label">Poste de l'auteur :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="poste" value="<?php echo stripslashes($sql_url['poste']); ?>">
	              </div>
	            </div>
	   		<div class="control-group">
			 	<label class="control-label">Photo de l'auteur :</label>
				 	<div class="controls">
				    	<input type="file" name="photo" />	
              <?php if(!empty($sql_url['photo_client'])){ ?>
				    	<span class="help-block" id="photoauteur">
				        	Photo actuelle : 
					        <a href="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_url['photo_client']); ?>" target="_blank">
					        	 <?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_url['photo_client']); ?>
					        </a><br/>
                  <a href="#" onclick="submitMe();" style="text-decoration: underline;">Supprimer cette photo</a>
				        </span>		
                <?php } ?>	
				    </div>
			</div>


                <div class="form-actions">
                  <button type="submit" name="edit" value="<?php echo stripslashes($sql_url['id']); ?>" class="btn btn-danger">Modifier</button>
                </div>
        </div>
  </form>

          <script>

        function submitMe() {
    jQuery(function($) {    
        $.ajax( {           
            url : "<?php echo $config_urladmin; ?>/index.php?page=client&supprimerimg=<?php echo stripslashes($sql_url['id']); ?>",
            type : "GET",
            success : function(data) {
                alert ("La photo a bien été supprimé"); 
                }
            });

        $( "#photoauteur" ).hide();
        });
    }
</script>


          <?php

          	} else {

          ?>
 <form action="<?php echo $config_urladmin; ?>/index.php?page=client" method="post" class="form-horizontal" enctype="multipart/form-data">
         <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Ajouter un client</h5>
            </div>
            <div class="widget-content nopadding">


	   		<div class="control-group">
			 	<label class="control-label">Logo :</label>
				 	<div class="controls">
				    	<input type="file" name="logo" />		
				    </div>
			</div>

        <div class="control-group">
                <label class="control-label">Témoignage :</label>
                <div class="controls">
<textarea class=" span11" name="texte" style="height:150px;"></textarea>
                
              </div>
            </div>

	            <div class="control-group">
	              <label class="control-label">Auteur :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="auteur">
	              </div>
	            </div>

	            <div class="control-group">
	              <label class="control-label">Poste de l'auteur :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="poste">
	              </div>
	            </div>
	   		<div class="control-group">
			 	<label class="control-label">Photo de l'auteur :</label>
				 	<div class="controls">
				    	<input type="file" name="photo" />		
				    </div>
			</div>


                <div class="form-actions">
                  <button type="submit" name="submit" value="1" class="btn btn-danger">Ajouter</button>
                </div>
        </div>
  </form>

  <?php }?>
		    </div>
		    </div>
