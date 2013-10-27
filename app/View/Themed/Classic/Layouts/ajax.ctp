<script type="text/javascript">
<? if (CakeSession::read("validationError")) {
		?>var validationError = true;<?
	} else {
		?>var validationError = false;<?
	}
	CakeSession::delete("validationError");
	?>
</script>
<?php
echo $content_for_layout;
echo $this->Js->writeBuffer();
?><?php echo $this->Session->flash('flash', array('element' => 'popup')); ?><script type="text/javascript">
	
</script>
<?php //echo $this->element('sql_dump'); ?>