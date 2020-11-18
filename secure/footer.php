<?php

##################################
############ NorthCryo ###########
##################################


?>


<script src="<?php echo $config_urladmin; ?>/theme/js/jquery.min.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/jquery.ui.custom.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/bootstrap.min.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/jquery.uniform.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/select2.min.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/matrix.js"></script> 

<?php
if(isset($_GET['page']) && $_GET['page'] == 'commandes' or isset($_GET['page']) && $_GET['page'] == 'categories'  or isset($_GET['page']) && $_GET['page'] == 'job' or isset($_GET['page']) && $_GET['page'] == 'textes' ){
?>
<script src="<?php echo $config_urladmin; ?>/theme/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/matrix.tables.js"></script>
<script src="<?php echo $config_urladmin; ?>/theme/js/bootstrap-colorpicker.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/bootstrap-datepicker.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/wysihtml5-0.3.0.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/jquery.peity.min.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/bootstrap-wysihtml5.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/matrix.form_common.js"></script> 
<script>
    $('.textarea_editor').wysihtml5();
</script>
<?php }

if(isset($_GET['page']) && $_GET['page'] == 'cabine'){
    ?>
<script src="<?php echo $config_urladmin; ?>/theme/js/wysihtml5-0.3.0.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/bootstrap-wysihtml5.js"></script> 
<script>
    $('.textarea_editor').wysihtml5();
</script>
<?php


}

if(isset($_GET['page']) && $_GET['page'] == 'ajout-produit' ){
?>
<script src="<?php echo $config_urladmin; ?>/theme/js/jquery.wizard.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/matrix.wizard.js"></script> 
<script src="<?php echo $config_urladmin; ?>/theme/js/matrix.form_common.js"></script>
<?php }

if(isset($_GET['page']) && $_GET['page'] == 'stats' ){
?>
<script src="<?php echo $config_urladmin; ?>/theme/js/highcharts.js"></script> 

   <script>
	     $(function () {
    $('#staty').highcharts({
        chart: {
	        backgroundColor: null,
            type: 'area'
        },
		credits: {
            enabled: false
        },
        title: {
            text: ' '
        },
        subtitle: {
            text: ' '
        },

        xAxis: {
		categories: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],

		},
		yAxis: {
            title: {
                text: ' '
            }
        },
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -50,
            y: 25,
            floating: true,
            borderWidth: 1,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        series: [
        {
            name: 'Visites',
           <?php
		echo 'data: [';
		for ($i = 1; $i <= 12; $i++) {

		if($i<10) {$i2 = "0".$i;}else { $i2 = $i;}


		$month_1 = mktime(0, 0, 0, $i2, 01, date('Y'));

	    $nbrj = intval(date("t",$month_1)); 

		$month_2 = mktime(0, 0, 0, $i2, $nbrj, date('Y'));


		$sql_commande_charts =   mysqli_num_rows(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats WHERE param1 = 1  AND param2 >= ".$month_1." AND param2 <= ".$month_2."")); 

		 echo $sql_commande_charts;
		 if($i == 12 ) { echo ']';} else { echo ', ';}
		} 
		?>
        }]
    });
});

        </script>
<?php }


if(!isset($_GET['page'])){
?>
<script src="<?php echo $config_urladmin; ?>/theme/js/highcharts.js"></script> 

<?php

    $mois = mktime( 0, 0, 0, date('m'), 1, date('Y') ); 
    $nombreDeJours = intval(date("t",$mois)); 

?>

<script>
$(function () { 
    $('#container').highcharts({
        chart: {
	        backgroundColor: null,
	        type: 'area'
		},
		title: {
		    text: '',
		    x:0,
		    y:0
		},
		credits: {
            enabled: false
        },
        xAxis: {
		<?php
		echo 'categories: [';
		for ($i = 1; $i <= $nombreDeJours; $i++) {
		 echo $i;
		 if($i == $nombreDeJours ) { echo ']';} else { echo ', ';}
		} 
		?>

		},
		yAxis: {
            title: {
                text: ''
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -50,
            y: 25,
            floating: true,
            borderWidth: 1,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        series: [{
        	color: '#07c1e9',
            name: 'Visites',
		<?php
		echo 'data: [';
		for ($i = 1; $i <= $nombreDeJours; $i++) {

		if($i<10) {$i2 = "0".$i;}else { $i2 = $i;}

		$date1 = mktime(0, 0, 0,date('m'),$i2, date('Y'));

		$sql_commande_charts =   mysqli_num_rows(mysqli_query($link, "SELECT * FROM " . $prefix_sql . "_stats WHERE param1 = 1 AND param2 = ".$date1."")); 

		 echo $sql_commande_charts;
		 if($i == $nombreDeJours ) { echo ']';} else { echo ', ';}
		} 
		?>

        }]
	});
});
</script>

<?php
}
?>



</body>
</html>