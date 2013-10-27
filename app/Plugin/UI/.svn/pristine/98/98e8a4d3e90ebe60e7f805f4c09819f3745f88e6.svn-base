<?
$curcontext = substr($this->Js->currentContext(), 1);

?><div class='popup-flash popup-flash-<?= $curcontext ?>'>
	<?= $message ?>
</div>
<script type="text/javascript">
$('.popup-flash-<?= $curcontext ?>').dialog({buttons: [
    {
        text: '<?= __('Aceptar') ?>',
        click: function() { $(this).dialog('close'); }
    }], position: 'center', close: function() { $('.popup-flash-<?= $curcontext ?>').parent().remove();$('.popup-flash-<?= $curcontext ?>').remove()} });
</script>
