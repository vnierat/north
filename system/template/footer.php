<?php

##################################
############ NorthCryo ###########
##################################

?>

        </div>
    </div>
    <div class="footer">
        <div class="copyright">
            <a href="<?php echo $config_urlsite; ?>" title="<?php echo $config_nomsite; ?>" class="logo">
                <img src="<?php echo $config_urlsite; ?>/theme/img/logo-footer.png" alt="Logo NorthCryo" border="0">
                North<span>Cryo</span>
            </a>
            <p class="legal">
                Copyright <?php echo date('Y'); ?> NorthCryo.com  <a href="<?php echo $config_urlsite; ?>/legal" title="Mentions légales">Mentions légales</a> - <a href="<?php echo $config_urlsite; ?>/job" title="NorthCryo recrute">Job</a>
            </p>
            <p class="baseline">
               <?php echo stripslashes($rows[0]['valeur']); ?>
            </p>
        </div>
        <div class="bottom-footer">
                <div class="overlay">
                    <div class="content">
                        <p class="webkreativ">
                        Conception Web par<br/>
                            <a href="http://www.florianmarette.com" title="Réalisation par Flo Designr" target="_blank">
                                <img src="<?php echo $config_urlsite; ?>/theme/img/flo.png" alt="Logo Flo" border="0" class="logofooter">
                            </a>
                        </p>
                        <p class="social-link">
                            <?php if(!empty($config_facebook)){?>
                            <a href="<?php echo $config_facebook; ?>" title="Page Facebook" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <?php } if(!empty($config_twitter)){?>
                            <a href="<?php echo $config_twitter; ?>" title="Compte Twitter" target="_blank">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <?php } if(!empty($config_instagram)){?>
                            <a href="<?php echo $config_instagram; ?>" title="Compte Instagram" target="_blank">
                                <i class="fa fa-instagram"></i>
                            </a>
                            <?php } if(!empty($config_google)){?>
                            <a href="<?php echo $config_google; ?>" title="Page Google+" target="_blank">
                                <i class="fa fa-google-plus"></i>
                            </a>
                            <?php } if(!empty($config_youtube)){?>
                            <a href="<?php echo $config_youtube; ?>" title="Chaine Youtube" target="_blank">
                                <i class="fa fa-youtube-play"></i>
                            </a>
                            <?php }?>
                        </p>
                    </div>
                </div>
            <div id="background"></div>
        </div>
    </div>

    <script src="<?php echo $config_urlsite; ?>/theme/js/jquery-1.12.1.min.js?001"></script>
    <script src="<?php echo $config_urlsite; ?>/theme/js/jquery-ui.min.js?001"></script>
    <script src="<?php echo $config_urlsite; ?>/theme/js/script.min.js?001"></script>
    <script src="<?php echo $config_urlsite; ?>/theme/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $config_urlsite; ?>/theme/js/bootstrap-select.min.js"></script>

    <?php echo $popup; ?>

    <?php if($active_link == 1){  ?>

      <!-- Animate on Scroll -->
      <script src="<?php echo $config_urlsite; ?>/theme/js/aos.js"></script>

      <script>
    AOS.init();
      </script>
      
    <!-- Home JS -->
    <script src="<?php echo $config_urlsite; ?>/theme/js/slick.min.js?001"></script>

    <script>
        $('.home-slider').slick({
          dots: true,
          infinite: true,
          speed: 500,
          fade: true,
          cssEase: 'linear',
          nextArrow: '.next-slider-btn',
          prevArrow: '.prev-slider-btn'
        });
    </script>
    <?php } else if($active_link == 2){?>

     <!-- A Propos JS -->
    <script>
        $(function() {
            $( ".accordion-apropos" ).accordion();
        });
        $(function() {
            $( ".tabs" ).tabs();
        });

    </script>

    <?php } else if($active_link == 3 or $active_link == 4){?>

     <!-- Gallerie JS -->
    <script src="<?php echo $config_urlsite; ?>/theme/js/lightbox/jquery.lightbox.min.js?001"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.lightbox').lightbox();
        });
    </script>

    <?php

    } else if($active_link == 7){

    ?>



    <!-- A Propos JS -->
    <script>
        $(function() {
            $( ".accordion-job" ).accordion();
        });
    </script>


    <?php

}
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-19395031-11', 'auto');
  ga('send', 'pageview');

</script>



</body>
</html>
