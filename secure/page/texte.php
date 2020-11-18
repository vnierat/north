<?php

##################################
############ NorthCryo ###########
##################################

$msg ='';


if(isset($_POST['edit'])){


$countx =  mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(id) AS nbr FROM " . $prefix_sql . "_textes")); 

for($i = 1; $i <= $countx['nbr']; $i++){

$value = addslashes($_POST['config'.$i.'']);

 // Mise a jour de la sql
mysqli_query($link, "UPDATE " . $prefix_sql . "_textes SET valeur = '" . $value . "' WHERE id = ".$i." ");


$msg = " <div class=\"row-fluid\"><div class=\"span12\"><div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
        	Les textes ont bien été supprimé.</div></div></div>";
}
}
?>
<div id="content">
  	<div id="content-header">
    	<div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a class="current">Textes</a> </div>
    	<h1>Gestion des textes du site</h1>
  	</div>
  	<div class="container-fluid">
	    <hr>
		 <div class="row-fluid">
		    <div class="span12">

		    <?php echo $msg; ?>

		     <form action="" method="post" class="form-horizontal">
		     <div class="widget-box">
		        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
		          <h5>Les textes :</h5>
		        </div>
		        <div class="widget-content nopadding">

<?php 
	$i = 1;
	$formsql =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_textes ORDER by id"); 
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
		} else if($sql_form['type'] == 2) {
?>

	   		<div class="control-group">
			 	<label class="control-label"><?php echo stripslashes($sql_form['nom']); ?> :</label>
				 	<div class="controls">
<textarea class="span11" name="config<?php echo stripslashes($sql_form['id']); ?>" style="height:150px;"><?php echo stripslashes( $sql_form['valeur']); ?></textarea>
	              			
				    </div>
			</div>




<?php

		} else if($sql_form['type'] == 3) {
?>

	   		<div class="control-group">
			 	<label class="control-label"><?php echo stripslashes($sql_form['nom']); ?> :</label>
				 	<div class="controls">
<textarea class="textarea_editor span11" name="config<?php echo stripslashes($sql_form['id']); ?>" style="height:250px;"><?php echo stripslashes( $sql_form['valeur']); ?></textarea>
	              			
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