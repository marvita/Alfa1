<div class="<?= $this->request->controller ?> index">
	<? if ( (!$this->request->requested || !$this->request->bare) ) { ?>
		<div style="float: left; margin-right: 20px;"><h2><? echo $this->fetch("title") ?></h2></div>
		<div style="float: left;"><? echo $this->fetch("actions") ?></div>
		<div class="clearfix"></div>
		
	<? } ?>
	
	<div>
		<table class="<?= $this->fetch('classes') ?>">
			<? echo $this->fetch('content'); ?>
		</table>
		<?= $this->fetch("paginator") ?>
	</div>
</div>

