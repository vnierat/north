<?php

##################################
############ NorthCryo ###########
##################################

$msg= '';

if(isset($_POST['edit'])){


  $titre = addslashes($_POST['titre']);
  $intro = addslashes($_POST['intro']);
  $titre_page = addslashes($_POST['titre_page']);
  $desc_page = addslashes($_POST['desc_page']);

  mysqli_query($link, "UPDATE " . $prefix_sql . "_pages SET 
   titre = '".$titre."',
   intro = '".$intro."',
   titre_page = '".$titre_page."',
   desc_page = '".$desc_page."'

   WHERE id = ".$_POST['edit'] ." ");


  $msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
          La page a bien été modifié.</div>";
}

?>
<div id="content">
  	<div id="content-header">
    	<div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a class="current">Les pages</a> </div>
    	<h1>Gestion des pages</h1>
  	</div>
  	<div class="container-fluid">
	    <hr>

      <?php echo $msg; ?>
		<div class="row-fluid">
		    <div class="span12">


   <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Modifier les titres des pages :</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Pages</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
<?php
$sqlitem =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_pages ORDER by id DESC"); 
while($sql_user = mysqli_fetch_array($sqlitem)) {


?>
                <tr>                                                     
                  <td align="center">
                 <?php echo stripslashes($sql_user['titre']); ?>
  
               

                  <td class="center">
                  	<center>
                  	<a  href="<?php echo $config_urladmin; ?>/index.php?page=pages&edit=<?php echo $sql_user['id']; ?>" class="btn btn-primary btn-mini"><span class=" icon-edit"></span></a>
                  	
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
		    </div>

        <?php if(isset($_GET['edit'])) {

            $sql_url = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_pages WHERE id = '" . $_GET['edit'] . "' "))

          ?>
		<div class="row-fluid">
		    <div class="span12">

     <form action="" method="post" class="form-horizontal">
		     <div class="widget-box">
		        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
		          <h5>Modifier la page  : <?php echo stripslashes($sql_url['titre']); ?></h5>
		        </div>
		        <div class="widget-content nopadding">

	            <div class="control-group">
	              <label class="control-label">Titre :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="titre" value="<?php echo stripslashes( $sql_url['titre']); ?>">
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Introduction :</label>
	              <div class="controls">
	                <input type="text" class="span11" name="intro" value="<?php echo stripslashes( $sql_url['intro']); ?>">
	              </div>
	            </div>
              <div class="control-group">
                <label class="control-label">Titre de la page (Navigateur) :</label>
                <div class="controls">
                  <input type="text" class="span11" name="titre_page" value="<?php echo stripslashes( $sql_url['titre_page']); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description de la page (Navigateur) :</label>
                <div class="controls">
                  <input type="text" class="span11" name="desc_page" value="<?php echo stripslashes( $sql_url['desc_page']); ?>">
                </div>
              </div>
                <div class="form-actions">
                  <button type="submit" name="edit" value="<?php echo stripslashes( $sql_url['id']); ?>" class="btn btn-danger">Modifier</button>
                </div>
		    </div>
	</form>
		    </div>
		</div>

  <?php } ?>

	</div>
</div>