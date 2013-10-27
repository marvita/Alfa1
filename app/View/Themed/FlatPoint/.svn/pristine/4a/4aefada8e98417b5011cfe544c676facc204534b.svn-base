<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html lang="es_AR">
  <head>
    <?php echo $this->Html->charset(); ?>
    <title>
    	<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <?php
		echo $this->Html->meta('icon');

		/*if ( $_SERVER["HTTP_HOST"] == "localhost" ) {
			echo $this->Html->css("cssreset-min.css");
			echo $this->Html->css("cssreset-context-min.css");
		} else {
			echo $this->Html->css("http://yui.yahooapis.com/3.7.3/build/cssreset/cssreset-min.css");
			echo $this->Html->css("http://yui.yahooapis.com/3.7.3/build/cssreset-context/cssreset-context-min.css");
		}*/
		echo $this->Html->css('ui/themes/base/minified/jquery-ui.min');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('stylesheet');
		echo $this->Html->css('fonts/FontAwesome/font-awesome');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800');
		echo $this->Html->css('adjustments-login');
		/*echo $this->Html->css("jquery.ui.selectmenu");
		echo $this->Html->css("jquery.jscrollpane");
		echo $this->Html->css("AjaxMultiUpload.fileuploader");
		echo $this->Html->css("Ubuntu/stylesheet");
		echo $this->Html->css('urbanconnect');
		echo $this->Html->css('classic');
		*/
		/*echo $this->Html->script("jquery.boxshadow");
		echo $this->Html->script("jquery.ui.selectmenu");
		//echo $this->Html->script("jquery.nicescroll.min");
		echo $this->Html->script("jquery.mousewheel");
		echo $this->Html->script("jquery.jscrollpane.min");
		
		echo $this->Html->script("jquery.timers");
		echo $this->Html->script("AjaxMultiUpload.fileuploader");*/
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('blockcss');
		
	?>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="img/favicon.png">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      echo $this->Html->script("html5shiv");
    <![endif]-->

  </head>
  <body>
	
			<?php echo $this->fetch('content'); ?>
	
	<div class="ajaxloading">
		<div><?= __("Aguarde un momento por favor") ?></div>
		<br>
		<?= $this->Html->image("ajax-loader.gif") ?>
	</div>
	<!--<div class="cf"><?php //echo $this->element('sql_dump'); ?></div>-->
	<?
		echo $this->Html->script("jquery-1.10.2.min");
		echo $this->Html->script("ui/jquery-ui.min");
		
		echo $this->Html->script("bootstrap");

    echo $this->Html->script("library/jquery.collapsible.min");
    echo $this->Html->script("library/jquery.mCustomScrollbar.min");
    echo $this->Html->script("library/jquery.mousewheel.min");
    echo $this->Html->script("library/jquery.uniform.min");

	echo $this->Html->script("http://maps.googleapis.com/maps/api/js?key=AIzaSyCL6XtCGot7S7cfxnO6tRfeZx9kLQQRMtA&amp;sensor=false");

    echo $this->Html->script("library/jquery.sparkline.min");
    echo $this->Html->script("library/chosen.jquery.min");
    echo $this->Html->script("library/jquery.easytabs");
    echo $this->Html->script("library/flot/excanvas.min");
    echo $this->Html->script("library/flot/jquery.flot");
    echo $this->Html->script("library/flot/jquery.flot.pie");
    echo $this->Html->script("library/flot/jquery.flot.selection");
    echo $this->Html->script("library/flot/jquery.flot.resize");
    echo $this->Html->script("library/flot/jquery.flot.orderBars");
    echo $this->Html->script("library/maps/jquery.vmap");
    echo $this->Html->script("library/maps/maps/jquery.vmap.world");
    echo $this->Html->script("library/maps/data/jquery.vmap.sampledata");
    echo $this->Html->script("library/jquery.autosize-min");
    echo $this->Html->script("library/charCount");
    echo $this->Html->script("library/jquery.minicolors");
    echo $this->Html->script("library/jquery.tagsinput");
    echo $this->Html->script("library/fullcalendar.min");
    echo $this->Html->script("library/footable/footable");
    echo $this->Html->script("library/footable/data-generator");

    echo $this->Html->script("library/bootstrap-datetimepicker");
    echo $this->Html->script("library/bootstrap-timepicker");
    echo $this->Html->script("library/bootstrap-datepicker");
    echo $this->Html->script("library/bootstrap-fileupload");
    echo $this->Html->script("library/jquery.inputmask.bundle");

    echo $this->Html->script("library/jquery.backstretch.min");
    echo $this->fetch('script');
		echo $this->fetch('blockscripts');

		$base = Router::url("/");
		$imgUrl = $base . "theme/FlatPoint/img/";
	?>
	<?php echo $this->Session->flash('flash', array('element' => 'UI.popup')); ?>
    <script>
        jQuery(document).ready(function($) {
            $('.uniform').uniform();
        });

        jQuery.backstretch([
                "<?= $imgUrl ?>slide_01.jpg", 
                "<?= $imgUrl ?>slide_02.jpg", 
                "<?= $imgUrl ?>slide_03.jpg", 
                "<?= $imgUrl ?>slide_04.jpg", 
            ],{
                duration: 5000, fade: 1000
        });
    </script>
	
	<?php
	echo $this->Js->writeBuffer(); // Write cached scripts ?>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
