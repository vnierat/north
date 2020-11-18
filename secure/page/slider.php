<?php

##################################
############ NorthCryo ###########
##################################
$msg = '';

if(isset($_GET['supprimer']) && is_numeric($_GET['supprimer'])){
 
mysqli_query($link, 'DELETE FROM ' . $prefix_sql . '_slider WHERE id = "' . $_GET['supprimer'] . '" ');

$msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          La slide a bien été supprimer.</div>";
}

if(isset($_POST['txt']) && isset($_POST['edit'])){


  $txt = addslashes($_POST['txt']);
  $model = addslashes($_POST['model']);
  $link1 = addslashes($_POST['link1']);

$photo = '0';


$countx2 =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_slider WHERE id = '".$_POST['edit']."' ")); 

if($_FILES['photo']['name']){
$extension_upload = substr(strrchr($_FILES['photo']['name'], '.')  ,1);
$nom_file = random(5).'-'.url_rewriting(strip_tags($_POST['model'])).'.'.$extension_upload;
upload_file($_FILES['photo'], $nom_file);
$photo = $nom_file;
} else {
	$photo = $countx2['img'];
}


 // Mise a jour de la sql
mysqli_query($link, "UPDATE " . $prefix_sql . "_slider SET

	txt = '" . $txt . "', 
	link = '" . $link1 . "', 
	model = '" . $model . "',
	img = '" . $photo . "', 
	type = '1'

	WHERE id = ".$_POST['edit']." ");



  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          La slide a bien été modifié.</div>";
}

if(isset($_POST['txt']) && !isset($_POST['edit'])){


  $txt = addslashes($_POST['txt']);
  $model = addslashes($_POST['model']);
  $link1 = addslashes($_POST['link1']);

$photo = '0';


if($_FILES['photo']['name']){
$extension_upload = substr(strrchr($_FILES['photo']['name'], '.')  ,1);
$nom_file = random(5).'-'.url_rewriting(strip_tags($_POST['model'])).'.'.$extension_upload;
upload_file($_FILES['photo'], $nom_file);
$photo = $nom_file;
} 


 mysqli_query($link, "INSERT INTO " . $prefix_sql . "_slider VALUES('', '".$txt."', '".$link1."', '".$model."', '".$photo."', '1')");


  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          La slide a bien été ajouté.</div>";
}


?>

<div id="content">
  	<div id="content-header">
    	<div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a class="current">Slider d'accueil</a> </div>
    	<h1>Gestion du Slider</h1>
  	</div>
  	<div class="container-fluid">
	    <hr>

      <?php echo $msg; ?>
		<div class="row-fluid">
		    <div class="span12">


   <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Les slides</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Texte</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
<?php
$sqlitem =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_slider ORDER by id DESC"); 
while($sql_user = mysqli_fetch_array($sqlitem)) {


?>
                <tr>                                                     
                  <td><center><img src="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_user['img']); ?>" width="150"></center></td>
                  <td><?php echo strip_tags(stripslashes($sql_user['txt'])); ?></td>
               

                  <td class="center">
                  	<a  href="<?php echo $config_urladmin; ?>/index.php?page=slider&edit=<?php echo $sql_user['id']; ?>" class="btn btn-primary btn-mini"><span class=" icon-edit"></span></a>
                  	<a onclick="return confirm('Voulez vous vraiment supprimer ce slider ?')" href="<?php echo $config_urladmin; ?>/index.php?page=slider&supprimer=<?php echo $sql_user['id']; ?>" class="btn btn-danger btn-mini"><span class=" icon-remove"></span></a>
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

            $sql_url = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_slider WHERE id = '" . $_GET['edit'] . "' "))

          ?>

     <form action="<?php echo $config_urladmin; ?>/index.php?page=slider" method="post" class="form-horizontal"enctype="multipart/form-data">
		     <div class="widget-box">
		        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
		          <h5>Modifier l'offre d'emploi :</h5>
		        </div>
		        <div class="widget-content nopadding">

	        <div class="control-group">
                <label class="control-label">Texte :</label>
                <div class="controls">
                  <input type="text" class="span11" name="txt" value="<?php echo  htmlspecialchars(stripslashes($sql_url['txt'])); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Modèle :</label>
                <div class="controls">
                  <input type="text" class="span11" name="model" value="<?php echo  htmlspecialchars(stripslashes($sql_url['model'])); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Lien :</label>
                <div class="controls">
                  <input type="text" class="span11" name="link1" value="<?php echo  stripslashes($sql_url['link']); ?>">
                </div>
              </div>
	   		<div class="control-group">
			 	<label class="control-label">Photo :</label>
				 	<div class="controls">
				    	<input type="file" name="photo" />		
				    	<span class="help-block">
				        	Photo actuelle : 
					        <a href="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_url['img']); ?>" target="_blank">
					        	 <?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_url['img']); ?>
					        </a>
				        </span>			
				    </div>
			</div>


                <div class="form-actions">
                  <button type="submit" name="edit" value="<?php echo stripslashes($sql_url['id']); ?>" class="btn btn-danger">Modifier</button>
                </div>
		    </div>
	</form>

  <?php } else {

    ?>
     <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
         <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Ajouter une slide</h5>
            </div>
            <div class="widget-content nopadding">

              <div class="control-group">
                <label class="control-label">Texte :</label>
                <div class="controls">
                  <input type="text" class="span11" name="txt" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Modèle :</label>
                <div class="controls">
                  <input type="text" class="span11" name="model" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Lien :</label>
                <div class="controls">
                  <input type="text" class="span11" name="link1" >
                </div>
              </div>
	   		<div class="control-group">
			 	<label class="control-label">Photo :</label>
				 	<div class="controls">
				    	<input type="file" name="photo" />		
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