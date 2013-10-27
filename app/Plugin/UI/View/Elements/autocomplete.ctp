<?php
$context = substr($this->Js->currentContext(), 1);

$basePath = $this->Entity->currentPathField();
if ($basePath != "") $basePath .= ".";
$basePath .= $alias;

$url = Router::url(array('controller' => $controller, 'action' => 'autocomplete', 'type' => 'json', 'plugin' => $plugin ? $plugin : false));
$viewAction = Router::url(array('controller' => $controller, 'action' => 'form', 'mode' => $mode, 'basePath' => $basePath, 'template' => $template, 'modelScope' => Entity::getModelScope(), 'plugin' => $plugin ? $plugin : false));

$entitySelector = $this->Js->currentContext() . " > .$template > .entity";
?>
<input type="text" id="autocomplete-<?= $context ?>" name="autocomplete-<?= $context ?>">

<script type="text/javascript">
$(document).ready(function() {
	$('#autocomplete-<?= $context ?>').autocomplete({
		delay: 800,
		minLength: 3,
		source: '<?= $url ?>',
		select: function(event, ui) {
			//console.log($(this).val());
			url = '<?= $viewAction ?>';
			//console.log($('<?= $entitySelector ?>').first().data('listindex'));
			if (typeof $('<?= $entitySelector ?>').attr('data-listindex') !== "undefined") {
				url = url.replace(/\/basePath:([a-zA-Z0-9\.]+)\//g, '/basePath:$1.'+$('<?= $entitySelector ?>').first().data('listindex')+'/');
			}
			
			$('#<?= $valueFieldID ?>').val(ui.item.value);
			
			$(this).val(ui.item.label);
			fillEntityFromID(url + '/' + ui.item.value, '<?= $entitySelector ?>', '<?= $addOrder ?>');
			<? if (isset($callback)) {
				print $callback;
			} ?>
			return false;
		}
	});
	$( '#autocomplete-<?= $context ?>' ).autocomplete( "widget" ).appendTo('body');
});
</script>