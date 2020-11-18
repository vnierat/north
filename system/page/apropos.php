<?php

##################################
############ NorthCryo ###########
##################################

// TPL
$oSmarty->display('system/tpl/apropos.tpl'); 


// SQL
$sqlgallerie =  mysqli_fetch_array(mysqli_query($link, "SELECT * FROM " . $prefix_sql ."_clients")); 

if(!empty($sqlgallerie['id'])){

?>

				<div class="tabs">
					<ul>

<?php 
	$i = 1;

	$sqlcat =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_clients ORDER by id DESC"); 
	while($sql_client = mysqli_fetch_array($sqlcat)) {

?>
						<li><a href="#tabs-<?php echo $i; $i++; ?>"><img src="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_client['logo']); ?>" alt="Logo client" border="0"></a></li>
<?php
}
?>
					</ul>

<?php 
	$o = 1;

	$sqlcat =  mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_clients ORDER by id DESC"); 
	while($sql_client = mysqli_fetch_array($sqlcat)) {

?>

					<div id="tabs-<?php echo $o; $o++; ?>" class="temoignage">
						<div class="txt">
							<?php echo stripslashes($sql_client['texte']); ?>
						</div>
						<div class="auteur">
						<?php if(!empty($sql_client['photo_client'])){ ?>
							<img src="<?php echo $config_urlsite; ?>/upload/<?php echo stripslashes($sql_client['photo_client']); ?>" alt="<?php echo stripslashes($sql_client['poste']); ?>">
						<?php } ?>
							<p><?php echo stripslashes($sql_client['auteur']); ?> <?php if(!empty($sql_client['poste'])){?><span>- <?php echo stripslashes($sql_client['poste']); } ?></span></p>
						</div>
					</div>
<?php

}

?>
				</div>
			</div>

			<?php

}

?>