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
        echo $this->Html->css('adjustments');
        
        /*echo $this->Html->css("jquery.ui.selectmenu");
		echo $this->Html->css("jquery.jscrollpane");
		echo $this->Html->css("AjaxMultiUpload.fileuploader");
		echo $this->Html->css("Ubuntu/stylesheet");
		echo $this->Html->css('urbanconnect');
		echo $this->Html->css('classic');
		*/
		/*echo $this->Html->script("jquery-1.10.2.min");
		echo $this->Html->script("ui/jquery-ui.min");*/
		/*echo $this->Html->script("jquery.boxshadow");
		echo $this->Html->script("jquery.ui.selectmenu");
		//echo $this->Html->script("jquery.nicescroll.min");
		echo $this->Html->script("jquery.mousewheel");
		echo $this->Html->script("jquery.jscrollpane.min");
		
		echo $this->Html->script("jquery.timers");
		echo $this->Html->script("AjaxMultiUpload.fileuploader");*/
		
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

    echo $this->Html->script("flatpoint_core");

//echo $this->Html->script("calendar");
        //echo $this->Html->script("forms");
        //echo $this->Html->script("dashboard");

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('blockcss');
		echo $this->fetch('script');
		echo $this->fetch('blockscripts');
	?>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="img/favicon.png">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

  </head>
  <body>
	<header class="dark_grey"> <!-- Header start -->
	</header>
	<div id="main_navigation" class="dark_navigation"> <!-- Main navigation start -->
        <div class="inner_navigation">
            <?= $this->Menu->admin(array("main", "sub_main")); ?>
        </div>
	</div>
	<div id="content" class="no-sidebar"> <!-- Content start -->
		<div class="top_bar">
            <ul class="breadcrumb">
              <li><a href="/alfa1/pages/home"><i class="icon-home"></i></a> <span class="divider">/</span></li>
              <li class="active"><a href="#">Dashboard</a></li>
            </ul>
        </div>
        <div class="inner_content" id="root">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<?/*
    <div id="sidebar"> <!-- Sidebar start -->
        <div class="inner_sidebar">
            <ul class="tabs clearfix">
                <li class="tab active"><a href="#first"><i class="icon-home"></i></a></li>
                <li class="tab"><a href="#second"><i class="icon-th"></i></a></li>
                <li class="tab"><a href="#third"><i class="icon-fullscreen"></i></a></li>
            </ul>
            <div class="tabs_container">
                <div class="tabs-content no_padding">
                    <div class="tab-box no_padding" id="first">
                        <div class="widget_content">
                            <h5><i class="icon-reorder"></i> Latest Notifications</h5>
                            <div class="sidebar_widget">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                    <strong>Well done!</strong><br> You successfully read this...
                                </div>
                            </div>
                        </div>
                        <div class="widget_content">
                            <h5><i class="icon-calendar"></i> Bootstrap calendar</h5>
                            <div class="sidebar_widget">
                                <div class="datepicker"></div>
                            </div>
                        </div>
                        <div class="widget_content">
                            <h5><i class="icon-reorder"></i> Latest Notifications</h5>
                            <div class="sidebar_widget">
                                <div class="alert">
                                    <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                    <strong>Warning!</strong><br> Best check yo self...
                                </div>
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                    <strong>Oh snap!</strong><br> Change a few things up...
                                </div>
                            </div>
                        </div>
                        <div class="widget_content">
                            <h5><i class="icon-reorder"></i> Sidebar Forms</h5>
                            <div class="sidebar_widget">
                                <div class="row-fluid">
                                    <div class="sidebar_field">
                                        <input type="text" class="span12" name="standard" placeholder="Standard input">
                                    </div>
                                    <div class="sidebar_field">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <input type="text" class="span12" name="standard" placeholder=".span3">
                                            </div>
                                            <div class="span4">
                                                <input type="text" class="span12" name="standard" placeholder=".span3">
                                            </div>
                                            <div class="span4">
                                                <input type="text" class="span12" name="standard" placeholder=".span3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar_field control-group warning">
                                        <input type="text" class="span12" name="standard" placeholder="Another">
                                    </div>
                                    <div class="sidebar_field control-group error">
                                        <input type="text" class="span12" name="standard" placeholder="Standard input">
                                    </div>
                                    <div class="sidebar_field control-group success">
                                        <input type="text" class="span12" name="standard" placeholder="Standard input">
                                    </div>
                                    <div class="sidebar_field">
                                        <div class="span12 no-search">
                                            <select class="chosen">
                                                <option>Show all results</option>
                                                <option>Show results</option>
                                                <option>Show another results</option>
                                                <option>Only mine</option>
                                                <option>Display none</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="sidebar_field">
                                        <div class="span12">
                                            <select class="chosen">
                                                <option>Show all results</option>
                                                <option>Show results</option>
                                                <option>Show another results</option>
                                                <option>Only mine</option>
                                                <option>Display none</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="sidebar_buttons align_right">
                                    <a href="#" class="btn blue">Save</a>
                                    <a href="#" class="btn grey">Cancel</a>
                                </div>
                            </div>
                        </div>
                        <div class="widget_content">
                            <h5><i class="icon-reorder"></i> Sidebar Statistics Earnings</h5>
                            <div class="sidebar_widget">
                                <div class="sidebar_buttons align_right">
                                    <a href="#" class="btn red">Update</a>
                                    <a href="#" class="btn blue">Settings</a>
                                </div>
                                <div class="sidebar_chart" id="sidebarchart" style="height: 120px;"></div>
                            </div>
                        </div>
                        <div class="widget_content">
                            <h5><i class="icon-reorder"></i> Tags input</h5>
                            <div class="sidebar_widget">
                                <input name="tags" id="tags" value="These,are,tags" />
                            </div>
                        </div>
                        <div class="widget_content">
                            <h5><i class="icon-reorder"></i> Sidebar Statistic Visitors</h5>
                            <div class="sidebar_widget">
                                <div class="sidebar_buttons align_right">
                                    <a href="#" class="btn grey">Update</a>
                                    <a href="#" class="btn green">Settings</a>
                                </div>
                                <div class="sidebar_chart" id="sidebarchart2" style="height: 120px;"></div>
                            </div>
                        </div>
                        <div class="widget_content">
                            <h5><i class="icon-reorder"></i> Sidebar Forms With Label</h5>
                            <div class="sidebar_widget">
                                <div class="row-fluid">
                                    <div class="form_row">
                                        <label class="field_name">Name</label>
                                        <div class="field">
                                            <input type="text" class="span12" name="standard" placeholder="Standard input">
                                        </div>
                                    </div>
                                    <div class="form_row">
                                        <label class="field_name">Grid input</label>
                                        <div class="field">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <input type="text" class="span12" name="standard" placeholder=".span3">
                                                </div>
                                                <div class="span4">
                                                    <input type="text" class="span12" name="standard" placeholder=".span3">
                                                </div>
                                                <div class="span4">
                                                    <input type="text" class="span12" name="standard" placeholder=".span3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_row">
                                        <label class="field_name">Normal label</label>
                                        <div class="field">
                                            <input type="text" class="span12" name="standard" placeholder="Standard input">
                                        </div>
                                    </div>
                                    <div class="form_row">
                                        <label class="field_name">Select</label>
                                        <div class="field">
                                            <div class="span12 no-search">
                                                <select class="chosen">
                                                    <option>Show all results</option>
                                                    <option>Show results</option>
                                                    <option>Show another results</option>
                                                    <option>Only mine</option>
                                                    <option>Display none</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form_row">
                                        <label class="field_name">Select search</label>
                                        <div class="field">
                                            <div class="span12">
                                                <select class="chosen">
                                                    <option>Show all results</option>
                                                    <option>Show results</option>
                                                    <option>Show another results</option>
                                                    <option>Only mine</option>
                                                    <option>Display none</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="sidebar_buttons align_right">
                                    <a href="#" class="btn blue">Save</a>
                                    <a href="#" class="btn grey">Cancel</a>
                                </div>
                            </div>
                        </div>
                        <div class="widget_content">
                            <h5><i class="icon-picture"></i> Latest Added Media</h5>
                            <div class="sidebar_widget">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="view">
                                            <div class="image">
                                                <img src="demo/preview_02.png" alt="">
                                                <a href="#" class="overlay"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        <div class="view">
                                            <div class="image">
                                                <img src="demo/preview_01.png" alt="">
                                                <a href="#" class="overlay"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="view">
                                            <div class="image">
                                                <img src="demo/preview_03.png" alt="">
                                                <a href="#" class="overlay"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        <div class="view">
                                            <div class="image">
                                                <img src="demo/preview_04.png" alt="">
                                                <a href="#" class="overlay"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget_content">
                            <h5>Responsive table in sidebar</h5>
                            <div class="sidebar_widget">
                                <div class="responsive_table_container">
                                    <table data-filter="#filter" class="table footable">
                                        <thead>
                                            <tr>
                                                <th data-hide="phone,tablet">#</th>
                                                <th data-class="expand" data-sort-initial="true">Name</th>
                                                <th data-hide="phone,tablet">Email</th>
                                                <th data-hide="phone,tablet">Country</th>
                                                <th data-hide="phone,tablet">Phone</th>
                                                <th>Order</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Elliott Walter</td>
                                                <td>dolor.elit.pellentesque@disparturientmontes.net</td>
                                                <td>Antigua and Barbuda</td>
                                                <td>361 9258-951</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Quinlan Owens</td>
                                                <td>fermentum.vel@nuncidenim.org</td>
                                                <td>South Georgia and The South Sandwich Islands</td>
                                                <td>931 8158-728</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Vivien Cotton</td>
                                                <td>feugiat.tellus@Sed.co.uk</td>
                                                <td>Algeria</td>
                                                <td>197 7676-514</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Erica Powell</td>
                                                <td>non@dapibusligula.co.uk</td>
                                                <td>Ireland</td>
                                                <td>393 5416-516</td>
                                                <td><span class="label label-inverse">Shipped</span></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Deanna Pope</td>
                                                <td>semper@eleifend.org</td>
                                                <td>Panama</td>
                                                <td>999 6110-505</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Emerald Harding</td>
                                                <td>dolor@nostraperinceptos.net</td>
                                                <td>Kazakhstan</td>
                                                <td>417 1363-790</td>
                                                <td><span class="label label-inverse">Shipped</span></td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Edward Brock</td>
                                                <td>velit@lobortisrisus.co.uk</td>
                                                <td>Hungary</td>
                                                <td>286 5864-139</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Mira Stevenson</td>
                                                <td>arcu@cubiliaCurae;.edu</td>
                                                <td>Dominican Republic</td>
                                                <td>215 3399-583</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Daria Leblanc</td>
                                                <td>neque.Morbi.quis@facilisisvitaeorci.ca</td>
                                                <td>Dominica</td>
                                                <td>629 4490-703</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Desirae Luna</td>
                                                <td>eleifend.nec.malesuada@mauris.ca</td>
                                                <td>Saint Lucia</td>
                                                <td>259 7274-236</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Emmanuel Bright</td>
                                                <td>risus.Morbi@faucibusidlibero.ca</td>
                                                <td>Sao Tome and Principe</td>
                                                <td>840 4224-872</td>
                                                <td><span class="label label-inverse">Shipped</span></td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Raphael Joseph</td>
                                                <td>Sed.eget.lacus@Duisacarcu.co.uk</td>
                                                <td>Nepal</td>
                                                <td>849 9028-695</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>Wendy Newman</td>
                                                <td>vestibulum.neque.sed@euenim.ca</td>
                                                <td>Malawi</td>
                                                <td>883 3850-147</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>Yoshio Webster</td>
                                                <td>mattis.Integer.eu@eutempor.org</td>
                                                <td>Cayman Islands</td>
                                                <td>301 9854-429</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>Melvin Walsh</td>
                                                <td>dolor.Nulla.semper@Sed.org</td>
                                                <td>Aruba</td>
                                                <td>210 0087-828</td>
                                                <td><span class="label label-inverse">Shipped</span></td>
                                            </tr>
                                            <tr>
                                                <td>16</td>
                                                <td>Anjolie Chan</td>
                                                <td>nec.tempus@interdumfeugiat.org</td>
                                                <td>Wallis and Futuna</td>
                                                <td>866 8448-689</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>17</td>
                                                <td>Tarik Ayala</td>
                                                <td>amet.nulla.Donec@purusaccumsaninterdum.org</td>
                                                <td>Angola</td>
                                                <td>340 4050-890</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td>Joelle Burch</td>
                                                <td>dignissim@liberoduinec.com</td>
                                                <td>Nepal</td>
                                                <td>915 0919-969</td>
                                                <td><span class="label label-inverse">Shipped</span></td>
                                            </tr>
                                            <tr>
                                                <td>19</td>
                                                <td>Mary Cantrell</td>
                                                <td>Vestibulum.ante@anteiaculisnec.net</td>
                                                <td>Netherlands</td>
                                                <td>241 3641-677</td>
                                                <td><span class="label label-inverse">Shipped</span></td>
                                            </tr>
                                            <tr>
                                                <td>20</td>
                                                <td>Madonna Stewart</td>
                                                <td>rutrum.justo@gravidamaurisut.org</td>
                                                <td>Azerbaijan</td>
                                                <td>157 2041-627</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>21</td>
                                                <td>Brenda Franks</td>
                                                <td>arcu.Vestibulum@etnetuset.co.uk</td>
                                                <td>Lithuania</td>
                                                <td>911 8566-517</td>
                                                <td><span class="label label-inverse">Shipped</span></td>
                                            </tr>
                                            <tr>
                                                <td>22</td>
                                                <td>Rhiannon Richmond</td>
                                                <td>diam.nunc.ullamcorper@loremvitae.net</td>
                                                <td>Cook Islands</td>
                                                <td>863 1950-055</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>23</td>
                                                <td>Stacey Dodson</td>
                                                <td>ipsum.cursus@egestasnuncsed.com</td>
                                                <td>Grenada</td>
                                                <td>371 9613-886</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>24</td>
                                                <td>Rogan Hobbs</td>
                                                <td>Duis.volutpat@nislelementum.org</td>
                                                <td>Kuwait</td>
                                                <td>713 9596-020</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>25</td>
                                                <td>Elmo Patel</td>
                                                <td>Nunc@mollisnec.com</td>
                                                <td>Colombia</td>
                                                <td>620 0784-739</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>26</td>
                                                <td>Galena Whitney</td>
                                                <td>risus@nunc.edu</td>
                                                <td>Georgia</td>
                                                <td>526 1536-758</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>27</td>
                                                <td>Glenna Lowe</td>
                                                <td>neque.non.quam@nisi.net</td>
                                                <td>Northern Mariana Islands</td>
                                                <td>519 5305-718</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>28</td>
                                                <td>Geoffrey Woodward</td>
                                                <td>risus.Nulla.eget@Maecenasmalesuadafringilla.co.uk</td>
                                                <td>Australia</td>
                                                <td>284 7520-606</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>29</td>
                                                <td>Ocean Justice</td>
                                                <td>id.risus.quis@elementum.edu</td>
                                                <td>Israel</td>
                                                <td>367 2389-779</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>30</td>
                                                <td>Quynn Cain</td>
                                                <td>Duis.a@acnullaIn.org</td>
                                                <td>American Samoa</td>
                                                <td>817 3896-710</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>31</td>
                                                <td>Chaney Burgess</td>
                                                <td>feugiat.metus@eratVivamusnisi.edu</td>
                                                <td>Turkmenistan</td>
                                                <td>956 0148-998</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>32</td>
                                                <td>Carol Ayers</td>
                                                <td>aliquet.odio@Utsemperpretium.net</td>
                                                <td>Pitcairn</td>
                                                <td>468 5204-613</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>33</td>
                                                <td>Lydia Simmons</td>
                                                <td>convallis.est@blanditatnisi.com</td>
                                                <td>Mali</td>
                                                <td>697 6544-221</td>
                                                <td><span class="label label-inverse">Shipped</span></td>
                                            </tr>
                                            <tr>
                                                <td>34</td>
                                                <td>Colette Dale</td>
                                                <td>orci@cursusNuncmauris.edu</td>
                                                <td>Italy</td>
                                                <td>800 6654-189</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>35</td>
                                                <td>Jolie Frazier</td>
                                                <td>Aliquam@apurus.edu</td>
                                                <td>Croatia</td>
                                                <td>404 6104-319</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>36</td>
                                                <td>Shaeleigh Stark</td>
                                                <td>arcu.Nunc@parturient.com</td>
                                                <td>Spain</td>
                                                <td>193 4129-531</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>37</td>
                                                <td>Lamar Little</td>
                                                <td>Phasellus.libero.mauris@turpisegestasAliquam.co.uk</td>
                                                <td>American Samoa</td>
                                                <td>198 9419-738</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>38</td>
                                                <td>Eleanor Hooper</td>
                                                <td>diam.luctus@nislNullaeu.org</td>
                                                <td>Uzbekistan</td>
                                                <td>105 6754-654</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>39</td>
                                                <td>Minerva Vargas</td>
                                                <td>eget.magna@euismodetcommodo.org</td>
                                                <td>Mali</td>
                                                <td>358 6906-656</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>40</td>
                                                <td>Hedda Hardy</td>
                                                <td>nibh.Phasellus.nulla@ornare.org</td>
                                                <td>Saint Helena</td>
                                                <td>774 6203-159</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>41</td>
                                                <td>Alexis Burks</td>
                                                <td>Nunc.ullamcorper.velit@Maecenasiaculisaliquet.com</td>
                                                <td>Martinique</td>
                                                <td>949 3183-421</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>42</td>
                                                <td>Ulla Charles</td>
                                                <td>egestas.Duis@quis.com</td>
                                                <td>Niger</td>
                                                <td>396 4732-167</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>43</td>
                                                <td>Iliana Greer</td>
                                                <td>Integer.eu@egestaslaciniaSed.co.uk</td>
                                                <td>Azerbaijan</td>
                                                <td>749 8021-247</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>44</td>
                                                <td>Whilemina Bryant</td>
                                                <td>turpis.vitae.purus@enim.co.uk</td>
                                                <td>Fiji</td>
                                                <td>767 0158-949</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>45</td>
                                                <td>Ivy Aguilar</td>
                                                <td>eu@tempus.org</td>
                                                <td>Seychelles</td>
                                                <td>187 1693-186</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>46</td>
                                                <td>Wang Meyers</td>
                                                <td>lorem.ut.aliquam@ametornare.net</td>
                                                <td>Bulgaria</td>
                                                <td>275 2914-552</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>47</td>
                                                <td>Melinda Benjamin</td>
                                                <td>elit.Aliquam.auctor@vitae.ca</td>
                                                <td>Burundi</td>
                                                <td>290 8893-074</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>48</td>
                                                <td>Keelie Grant</td>
                                                <td>nec@veliteusem.com</td>
                                                <td>Kiribati</td>
                                                <td>221 2115-976</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>49</td>
                                                <td>Ulysses Jensen</td>
                                                <td>vel.sapien.imperdiet@estNunc.net</td>
                                                <td>Timor-leste</td>
                                                <td>884 2141-965</td>
                                                <td><span class="label label-important">Canceled</span></td>
                                            </tr>
                                            <tr>
                                                <td>50</td>
                                                <td>Hilda Camacho</td>
                                                <td>velit.justo.nec@malesuada.ca</td>
                                                <td>Cape Verde</td>
                                                <td>330 7032-511</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-box no_padding" id="second">
                        <div class="widget_content">
                            <h5><i class="icon-picture"></i> Latest Added Media</h5>
                            <div class="sidebar_widget">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="view">
                                            <div class="image">
                                                <img src="demo/preview_02.png" alt="">
                                                <a href="#" class="overlay"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        <div class="view">
                                            <div class="image">
                                                <img src="demo/preview_01.png" alt="">
                                                <a href="#" class="overlay"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="view">
                                            <div class="image">
                                                <img src="demo/preview_03.png" alt="">
                                                <a href="#" class="overlay"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        <div class="view">
                                            <div class="image">
                                                <img src="demo/preview_04.png" alt="">
                                                <a href="#" class="overlay"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-box no_padding" id="third">
                        <div class="widget_content">
                            <h5><i class="icon-reorder"></i> Sidebar Forms</h5>
                            <div class="sidebar_widget">
                                <div class="row-fluid">
                                    <div class="sidebar_field">
                                        <input type="text" class="span12" name="standard" placeholder="Standard input">
                                    </div>
                                    <div class="sidebar_field">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <input type="text" class="span12" name="standard" placeholder=".span3">
                                            </div>
                                            <div class="span4">
                                                <input type="text" class="span12" name="standard" placeholder=".span3">
                                            </div>
                                            <div class="span4">
                                                <input type="text" class="span12" name="standard" placeholder=".span3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar_field control-group warning">
                                        <input type="text" class="span12" name="standard" placeholder="Another">
                                    </div>
                                    <div class="sidebar_field control-group error">
                                        <input type="text" class="span12" name="standard" placeholder="Standard input">
                                    </div>
                                    <div class="sidebar_field control-group success">
                                        <input type="text" class="span12" name="standard" placeholder="Standard input">
                                    </div>
                                    <div class="sidebar_field">
                                        <div class="span12 no-search">
                                            <select class="chosen">
                                                <option>Show all results</option>
                                                <option>Show results</option>
                                                <option>Show another results</option>
                                                <option>Only mine</option>
                                                <option>Display none</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="sidebar_field">
                                        <div class="span12">
                                            <select class="chosen">
                                                <option>Show all results</option>
                                                <option>Show results</option>
                                                <option>Show another results</option>
                                                <option>Only mine</option>
                                                <option>Display none</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="sidebar_buttons align_right">
                                    <a href="#" class="btn blue">Save</a>
                                    <a href="#" class="btn grey">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    */ ?>
	<div class="ajaxloading">
		<div><?= __("Aguarde un momento por favor") ?></div>
		<br>
		<?= $this->Html->image("ajax-loader.gif") ?>
	</div>
	<?php echo $this->Session->flash('flash', array('element' => 'UI.popup')); ?>
    
    <script>
        /*jQuery('#vmap').vectorMap({
            map:"world_en",
            backgroundColor:null,
            color:"#ffffff",
            hoverOpacity:.7,
            selectedColor:"#2d91ef",
            enableZoom:0,
            showTooltip:1,
            values:sample_data,
            scaleColors:["#8cc3f6","#5c86ac"],
            normalizeFunction:"polynomial",
            onRegionClick:function(){alert("This Region has "+(Math.floor(Math.random()*10)+1)+" users!"
            )}
        });*/

        jQuery(document).ready(function($) {
            $('.footable').footable();
            $('.responsive_table_container').mCustomScrollbar({
                set_height: 400,
                advanced:{
                  updateOnContentResize: true,
                  updateOnBrowserResize: true
                }
            });

            $('.responsive_table_container_2').mCustomScrollbar({
                set_height: 520,
                advanced:{
                  updateOnContentResize: true,
                  updateOnBrowserResize: true
                }
            });

            $('.inner_sidebar').easytabs({
                animationSpeed: 300,
                collapsible: false,
                updateHash: false
            });
        });
    </script>
    
	<div class="cf"><?php echo $this->element('sql_dump'); ?></div>
    
	<?php

	echo $this->Js->writeBuffer(); // Write cached scripts ?>

	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
