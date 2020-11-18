<?php

###########################
############ CK ###########
###########################

$msg = '';

if(isset($_GET['clear'])){

mysqli_query($link, 'TRUNCATE TABLE ' . $prefix_sql . '_newsletter');

$msg = "<div class=\"alert alert-success alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a>
            <h4 class=\"alert-heading\">CHECK !</h4>
        	La base de donnée des email à bien été vidé.</div>";
} 
?>
<div id="content">
  	<div id="content-header">
    	<div id="breadcrumb"> <a href="<?php echo $config_urladmin; ?>" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a class="current">Newsletter</a> </div>
    	<h1>Inscription à la newsletter</h1>
  	</div>
  	<div class="container-fluid">
	    <hr>
		 <div class="row-fluid">
		    <div class="span12">

		    <?php echo $msg; ?>
				<div class="control-group">
				    <div class="controls">
				    <textarea class="span12" name="description" style="height:350px;">
<?php $sqlitem =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_newsletter ORDER by id DESC"); 
while($sql_item = mysqli_fetch_array($sqlitem)) { echo stripslashes($sql_item['email']) . ', '; }?></textarea>
				     </div>
				</div>

				<div class="control-group">
				    <div class="controls">
						<a onclick="return confirm('Voulez-vous vraiment supprimer tous les emails de la base de donnée ?')" href="<?php echo $config_urladmin; ?>/index.php?page=newsletter&clear=1" class="btn btn-danger btn">Vider la base de donnée</a>
				     </div>
				</div>


		    </div>
		</div>
	</div>
</div>
