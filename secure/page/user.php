<?php

##################################
############ NorthCryo ###########
##################################

$msg = '';

if(isset($_GET['supprimer']) && is_numeric($_GET['supprimer'])){
 
mysqli_query($link, 'DELETE FROM ' . $prefix_sql . '_admin WHERE id = "' . $_GET['supprimer'] . '" ');

$msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          L'utilisateur a bien été supprimer.</div>";
}
if(isset($_POST['edit'])){


	if(isset($_POST['pwd']) && isset($_POST['pwd2']) && !empty($_POST['pwd']) && !empty($_POST['pwd2'])  && $_POST['pwd'] == $_POST['pwd2']){

  mysqli_query($link, "UPDATE " . $prefix_sql . "_admin SET 
   password = '".md5($_POST['pwd'])."'
   WHERE id = ".$_GET['edit'] ." ");

	}

  $nom = addslashes($_POST['nom']);
  $login = addslashes($_POST['login']);
  $email = addslashes($_POST['email']);


  mysqli_query($link, "UPDATE " . $prefix_sql . "_admin SET 
   login = '".$login."',
   nom = '".$nom."',
   email = '".$email."'

   WHERE id = ".$_GET['edit'] ." ");


  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          L'utilisateur a bien été modifié.</div>";
}

if(isset($_POST['nom']) && isset($_POST['email'])  && !isset($_POST['edit'])){



    $sql_login1 = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_admin WHERE login = '" . $_POST['login'] . "' "));
    $sql_login2 = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_admin WHERE email = '" . $_POST['email'] . "' "));

    if(empty($sql_login1['id']) && empty($sql_login2['id'])){

    	if($_POST['pwd'] == $_POST['pwd2']){


  $nom = addslashes($_POST['nom']);
  $login = addslashes($_POST['login']);
  $email = addslashes($_POST['email']);



    mysqli_query($link, "INSERT INTO " . $prefix_sql . "_admin VALUES(
    	'', 
    	'".$login."', 
    	'".md5($_POST['pwd'])."', 
    	' ', 
    	'".$nom."', 
    	'".random2(16)."', 
    	'". $email."')");

  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          L'utilisateur a bien été ajouté.</div>";
} else {

	  $msg = "<div class=\"alert alert-error alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          Vos mots de passe sont différents.</div>";
}
} else {

	  $msg = "<div class=\"alert alert-error alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          Un utilisateur avec cette identifiant ou cette e-mail existe déjà.</div>";
}
}

?>
<div id="content">
  	<div id="content-header">
    	<div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a class="current">Utilisateur</a> </div>
    	<h1>Gestion des utilisateurs</h1>
  	</div>
  	<div class="container-fluid">
	    <hr>

      <?php echo $msg; ?>
		<div class="row-fluid">
		    <div class="span12">


   <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Les utilisateurs</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>E-mail</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
<?php
$sqlitem =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_admin ORDER by id DESC"); 
while($sql_user = mysqli_fetch_array($sqlitem)) {


?>
                <tr>                                                     
                  <td><?php echo stripslashes($sql_user['nom']); ?></td>
                  <td><?php echo stripslashes($sql_user['email']); ?></td>
               

                  <td class="center">
                  	<a  href="<?php echo $config_urladmin; ?>/index.php?page=user&edit=<?php echo $sql_user['id']; ?>" class="btn btn-primary btn-mini"><span class=" icon-edit"></span></a>
                  	<a onclick="return confirm('Voulez vous vraiment supprimer cette utilisateur : <?php echo stripslashes($sql_user['nom']); ?>')" href="<?php echo $config_urladmin; ?>/index.php?page=user&supprimer=<?php echo $sql_user['id']; ?>" class="btn btn-danger btn-mini"><span class=" icon-remove"></span></a>
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

            $sql_url = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_admin WHERE id = '" . $_GET['edit'] . "' "))

          ?>

     <form action="" method="post" class="form-horizontal">
		     <div class="widget-box">
		        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
		          <h5>Modifier l'utilisateur :</h5>
		        </div>
		        <div class="widget-content nopadding">

              <div class="control-group">
                <label class="control-label">Identifiant :</label>
                <div class="controls">
                  <input type="text" class="span11" name="login"value="<?php echo stripslashes( $sql_url['login']); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nouveau mots de passe :</label>
                <div class="controls">
                  <input type="password" class="span11" name="pwd" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Confirmation du nouveau mots de passe :</label>
                <div class="controls">
                  <input type="password" class="span11" name="pwd2" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nom :</label>
                <div class="controls">
                  <input type="text" class="span11" name="nom" value="<?php echo stripslashes( $sql_url['nom']); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">E-mail :</label>
                <div class="controls">
                  <input type="text" class="span11" name="email" value="<?php echo stripslashes( $sql_url['email']); ?>">
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
              <h5>Ajouter un utilisateur</h5>
            </div>
            <div class="widget-content nopadding">

              <div class="control-group">
                <label class="control-label">Identifiant :</label>
                <div class="controls">
                  <input type="text" class="span11" name="login" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mots de passe :</label>
                <div class="controls">
                  <input type="password" class="span11" name="pwd" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Confirmation du mots de passe :</label>
                <div class="controls">
                  <input type="password" class="span11" name="pwd2" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nom :</label>
                <div class="controls">
                  <input type="text" class="span11" name="nom" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">E-mail :</label>
                <div class="controls">
                  <input type="text" class="span11" name="email" >
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