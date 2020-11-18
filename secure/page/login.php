<?php

##################################
############ NorthCryo ###########
##################################

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>NorthCryo.com - Administration</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo $config_urladmin; ?>/theme/css/matrix-login.css" />
        <link href="<?php echo $config_urladmin; ?>/theme/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" method="post" class="form-vertical" action="">
				 <div class="control-group normal_text"> <h3><img src="<?php echo $config_urladmin; ?>/theme/img/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_db"><i class="icon-user"></i></span><input type="text" name="login" placeholder="Nom d'utilisateur" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_db"><i class="icon-lock"></i></span><input type="password" name="pwd" placeholder="Mots de passe" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                	
                	<p><center><input type="submit" value="Connexion" class="btn btn-success">
                	</center></p>
                	<p><center><a href="#" class="flip-link " id="to-recover">Mots de passe oublié ?</a></center></p>
                </div>
            </form>
            <form id="recoverform" action="" method="post" class="form-vertical">
				<p class="normal_text">Inscrivez votre e-mail dans le formulaire ci-dessous pour recevoir un nouveau mots de passe.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_db"><i class="icon-envelope"></i></span><input type="text" name="emaillogin" placeholder="E-mail" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <p><center><input type="submit" value="Envoyer" class="btn btn-success">
                	</center></p>
                	<p><center><a href="#" class="flip-link " id="to-login">Formulaire de connexion</a></center></p>
                </div>
            </form>
        </div>
        
        <script src="<?php echo $config_urladmin; ?>/theme/js/jquery.min.js"></script>  
        <script src="<?php echo $config_urladmin; ?>/theme/js/matrix.login.js"></script> 
    </body>

</html>
