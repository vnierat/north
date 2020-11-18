<?php

##################################
############ NorthCryo ###########
##################################

?>
			<p class="intro-job">
				<?php echo stripslashes($rows[8]['valeur']); ?>
			</p>

			<div class="accordion-job">

<?php
	$sqlcat =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_job ORDER by id DESC"); 
	while($sql_job = mysqli_fetch_array($sqlcat)) {
?>
				<h3><?php echo stripslashes($sql_job['nom']); ?></h3>
				<div  id="print<?php echo stripslashes($sql_job['id']); ?>">
					<?php echo stripslashes($sql_job['texte']); ?>

					<div class="cta-job">
						<a href="mailto:?subject=<?php echo stripslashes($sql_job['nom']); ?>&body=<?php echo  cutString(stripslashes($sql_job['texte']), 0, 100, ''); ?>" class="cta-share">
							<i class="fa fa-envelope"></i>
						</a>
						<a href="" class="cta-print"   onClick="printdiv('print<?php echo stripslashes($sql_job['id']); ?>');">
							<i class="fa fa-print"></i>
						</a>
					</div>
				</div>


<?php
}


$sqlitem =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_job")); 
if(!isset($sqlitem['id'])){

	echo '<div style="height:300px; display:table;width:100%; text-align:center; font-size:16px; color:#07c1e9;outline:none;">Aucune offre d\'emploi</div>';
}
?>

				</div>