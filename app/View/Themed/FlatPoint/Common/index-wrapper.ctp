<? if (!isset($icon)) $icon = "list"; ?>
<? if ( (!$this->request->requested || !$this->request->bare) ) { ?>
<div class="statistic clearfix">
    <div class="current_page float_left">
        <span><i class="icon-<?= $icon ?>"></i> <? echo $this->fetch("title") ?></span>
    </div>

    <div class="charts clearfix">
        <!-- <div class="statistic_chart pull-right"> -->
          <div class="pull-left">
        	    <div id="sparkline" class="pull-left sparkline"></div> 
	            <div class="bars_label first_label pull-left">
	                <span class="value">
	                  <? echo $this->fetch("actions") ?> 
	                </span>
	            </div>

	        
        </div>
    </div>
</div>
<? } ?>
<div class="widgets_area">
	<div class="row-fluid">
		<div class="span6">
	        <div class="well blue">
	            <div class="well-header">
	                <h5><? echo $this->fetch("title") ?></h5>
	            </div>

	            <div class="well-content no-search">
	            	<div class="dataTables_wrapper">
		            	<table class="table table-striped table-bordered table-hover datatable <?= $this->fetch("classes") ?>">
		            		<? echo $this->fetch('content'); ?>
		            	</table>
		            	<div class="tableFooter">
		            		<? echo $this->fetch('paginator'); ?>
		            	</div>
		            </div>
	            </div>
	        </div>
	  	</div>
	</div>
</div>
