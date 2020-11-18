<?php

##################################
############ NorthCryo ###########
##################################

$msg = '';

if(isset($_GET['supprimer']) && is_numeric($_GET['supprimer'])){
 
mysqli_query($link, 'DELETE FROM ' . $prefix_sql . '_job WHERE id = "' . $_GET['supprimer'] . '" ');

$msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          L'offre d'emploi a bien été supprimer.</div>";
}
if(isset($_POST['edit'])){


  $nom = addslashes($_POST['nom']);
  $texte = addslashes($_POST['texte']);

  mysqli_query($link, "UPDATE " . $prefix_sql . "_job SET 
   nom = '".$nom."',
   texte = '".$texte."'

   WHERE id = ".$_GET['edit'] ." ");


  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          L'offre d'emploi a bien été modifié.</div>";
}

if(isset($_POST['nom']) && isset($_POST['texte'])  && !isset($_POST['edit'])){

  $nom = addslashes($_POST['nom']);
  $texte = addslashes($_POST['texte']);



    mysqli_query($link, "INSERT INTO " . $prefix_sql . "_job VALUES('', '".$nom."', '".$texte."', '".time()."')");

  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          L'offre d'emploi a bien été ajouté.</div>";

}

?>
<div id="content">
  	<div id="content-header">
    	<div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a class="current">Offre d'emploi</a> </div>
    	<h1>Gestion des offres d'emplois</h1>
  	</div>
  	<div class="container-fluid">
	    <hr>

      <?php echo $msg; ?>
		<div class="row-fluid">
		    <div class="span12">


   <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Les offres</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Date d'ajout</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
<?php
$sqlitem =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_job ORDER by id DESC"); 
while($sql_user = mysqli_fetch_array($sqlitem)) {


?>
                <tr>                                                     
                  <td><?php echo stripslashes($sql_user['nom']); ?></td>
                  <td><?php echo date_fr("d/m/Y", $sql_user['date']); ?></td>
               

                  <td class="center">
                  	<a  href="<?php echo $config_urladmin; ?>/index.php?page=job&edit=<?php echo $sql_user['id']; ?>" class="btn btn-primary btn-mini"><span class=" icon-edit"></span></a>
                  	<a onclick="return confirm('Voulez vous vraiment supprimer cette offre d\'emploi : <?php echo stripslashes($sql_user['nom']); ?>')" href="<?php echo $config_urladmin; ?>/index.php?page=job&supprimer=<?php echo $sql_user['id']; ?>" class="btn btn-danger btn-mini"><span class=" icon-remove"></span></a>
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
		<div class="row-fluid">
		    <div class="span12">

        <?php if(isset($_GET['edit'])) {

            $sql_url = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_job WHERE id = '" . $_GET['edit'] . "' "))

          ?>

     <form action="" method="post" class="form-horizontal">
		     <div class="widget-box">
		        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
		          <h5>Modifier l'offre d'emploi :</h5>
		        </div>
		        <div class="widget-content nopadding">

	            <div class="control-group">
	              <label class="control-label">Titre :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="nom" value="<?php echo stripslashes( $sql_url['nom']); ?>">
	              </div>
	            </div>

 				<div class="control-group">
	              <label class="control-label">Description :</label>
	              <div class="controls">
<textarea class="textarea_editor span11" name="texte" style="height:350px;"><?php echo stripslashes( $sql_url['texte']); ?></textarea>
	              
	            </div>
		        </div>


                <div class="form-actions">
                  <button type="submit" name="edit" value="<?php echo stripslashes( $sql_url['id']); ?>" class="btn btn-danger">Modifier</button>
                </div>
		    </div>
	</form>

  <?php } else {

    ?>
     <form action="" method="post" class="form-horizontal">
         <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Ajouter une offre d'emploi</h5>
            </div>
            <div class="widget-content nopadding">

              <div class="control-group">
                <label class="control-label">Titre :</label>
                <div class="controls">
                  <input type="text" class="span11" name="nom" >
                </div>
              </div>

        <div class="control-group">
                <label class="control-label">Description :</label>
                <div class="controls">
<textarea class="textarea_editor span11" name="texte" style="height:350px;"></textarea>
                
              </div>
            </div>


                <div class="form-actions">
                  <button type="submit" name="submit" value="1" class="btn btn-danger">Ajouter</button>
                </div>
        </div>
  </form>
    <?php } ?>

		    </div>
		</div>
	</div>
</div>