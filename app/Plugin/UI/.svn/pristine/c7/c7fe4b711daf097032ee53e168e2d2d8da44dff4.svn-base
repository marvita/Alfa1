<?
$c = strtolower($controller);
$l = strtolower($label);
?>
<script type="text/javascript">
	$(document).ready( function() {
		$('.<?= $c ?>.<?= $l ?>').everyTime(60000, '<?= $c."-".$l ?>', function (element, c) {
			<?= $this->Js->request(
				array('controller' => $controller, 'action' => 'notifier', $label),
				array('update' => ".notifier.$c.$l"),
				false
			) ?>
		}, 0);
	});
</script>