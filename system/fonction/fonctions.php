<?php

##################################
############ NorthCryo ###########
##################################
################################## URL REWRITING
function url_rewriting($texte_rewrite) {

// on declare les caracteres speciaux
$liste_caracteres_speciaux = array('É', 'é', '~', '&quot;', '#', '\'', '{', '(', '[', '-', '|', 'è', '`', '_', '\\', 'ç', '^', 'à', '@', '°', ')', ']', '+', '=', '}', '¨', '$', '£', '¤', '%', 'ù', 'µ', '*', '?', ',', '.', '/', ':', '§', '!', '€', 'ê', 'û', 'ô', 'ë', 'ï', 'î', 'ü', '&amp;', ';', '&gt;', '&lt;', ' ');
	
$remplacement_caracteres_speciaux = array('e', 'e', '-', '-', '-', '-' ,'-', '-', '-', '-' ,'-', 'e', '-', '-' ,'-', 'c', '', 'a', 'a', '-', '-', '-', '-' ,'-', '-', '-', 's', 'l', '-', '-', 'u', 'u' ,'-', '-', '-', '-', '-', '-', 's', '-', 'e' ,'e', 'u', 'o', 'e', 'i', 'i', 'u', '-', '-', '-', '-', '-', ' ');

// on rewrite
$texte_rewrite = strtolower($texte_rewrite);
$texte_rewrite = str_replace($liste_caracteres_speciaux, $remplacement_caracteres_speciaux, $texte_rewrite);
$texte_rewrite = preg_replace('#\-+#', '-', $texte_rewrite);
$longeur_texte = strlen($texte_rewrite);

	if(substr($texte_rewrite, 0, 1) == '-') {
	$texte_rewrite = substr($texte_rewrite, 1, $longeur_texte);
	}

	$longeur_texte = strlen($texte_rewrite);

	if(substr($texte_rewrite, $longeur_texte-1, $longeur_texte) == '-') {
	$texte_rewrite = substr($texte_rewrite, 0, $longeur_texte-1);
	}
        
        $texte_rewrite = preg_replace('#é#isU', 'e', $texte_rewrite);
	$texte_rewrite = preg_replace('#è#isU', 'e', $texte_rewrite);

return $texte_rewrite;

}


################################## Date en français
function date_fr($format, $timestamp=false) {
    if ( !$timestamp ) $date_en = date($format);
    else               $date_en = date($format,$timestamp);

    $texte_en = array(
        "Monday", "Tuesday", "Wednesday", "Thursday",
        "Friday", "Saturday", "Sunday", "January",
        "February", "March", "April", "May",
        "June", "July", "August", "September",
        "October", "November", "December"
    );
    $texte_fr = array(
        "Lundi", "Mardi", "Mercredi", "Jeudi",
        "Vendredi", "Samedi", "Dimanche", "Janvier",
        "F&eacute;vrier", "Mars", "Avril", "Mai",
        "Juin", "Juillet", "Ao&ucirc;t", "Septembre",
        "Octobre", "Novembre", "D&eacute;cembre"
    );
    $date_fr = str_replace($texte_en, $texte_fr, $date_en);

    $texte_en = array(
        "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun",
        "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
        "Aug", "Sep", "Oct", "Nov", "Dec"
    );
    $texte_fr = array(
        "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim",
        "Jan", "F&eacute;v", "Mar", "Avr", "Mai", "Jui",
        "Jui", "Ao&ucirc;", "Sep", "Oct", "Nov", "D&eacute;c"
    );
    $date_fr = str_replace($texte_en, $texte_fr, $date_fr);

    return $date_fr;
}


################################## Couper le texte
function cutString($string, $start, $length, $endStr = '...'){
    // si la taille de la chaine est inférieure ou égale à celle
    // attendue on la retourne telle qu'elle
    if( strlen( $string ) <= $length ) return $string;
    // autrement on continue

    // permet de couper la phrase aux caractères définis tout
    // en prenant en compte la taille de votre $endStr et en 
    // re-précisant l'encodage du contenu récupéré
    $str = mb_substr( $string, $start, $length - strlen( $endStr ) + 1, 'UTF-8');
    // retourne la chaîne coupée avant la dernière espace rencontrée
    // à laquelle s'ajoute notre $endStr
    return substr( $str, 0, strrpos( $str,' ') ).$endStr;
}


############################## TEMPLATE POPUP

function popup($icon, $titre, $msg) {
$string = "
<script>
    $(document).ready(function() {
        $('#popup_content').CreativPopup({
            autoClose: 10000,
            opacity: 0.2
        });
    });
</script>

<div id=\"popup_content\">
    <a class=\"close\"><i class=\"fa fa-times\"></i><a/>
    <div id=\"icon\"><i class=\"fa fa-".$icon."\"></i></div>
    <div id=\"titre\">".$titre."</div>
    <div id=\"text\">".$msg."</div>
</div>";

return $string;
}

############################## Générateur chaine aléatoire
function random($car) {
$string = "";
$chaine = "13456789";
srand((double)microtime()*1000000);
for($i=0; $i<$car; $i++) {
$string .= $chaine[rand()%strlen($chaine)];
}
return $string;
}

function random2($car) {
$string = "";
$chaine = "13456789abcdefghijklmnopqrstuvwxyz";
srand((double)microtime()*1000000);
for($i=0; $i<$car; $i++) {
$string .= $chaine[rand()%strlen($chaine)];
}
return $string;
}



############################## Upload de fichier
function upload_file($file, $nom) {

$extensions_autorisees = array('jpg','jpeg','JPG','JPEG','PNG','png','zip','ZIP','rar','RAR', 'pdf', 'PDF');
$extension_fichier = array('zip','ZIP','rar','RAR', 'PDF', 'pdf');
$extension_upload = substr(strrchr($file['name'], '.')  ,1);

$name_vignette = $file['name'];

if(in_array($extension_upload,$extensions_autorisees))
{
    if(in_array($extension_upload,$extension_fichier)){
    $target = ("../upload/");
    } else {
    $target = ("../upload/");
    }
    move_uploaded_file($file['tmp_name'],$target.$nom);
    $string = 'ok';
} else { $string = 'ko'; }


return $string;
}

?>