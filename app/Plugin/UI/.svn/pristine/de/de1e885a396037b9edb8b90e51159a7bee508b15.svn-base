	<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, desde {:start}, hasta {:end}')
		));
		?>
	</p>

	<div class="paging">
		<?php		
			echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
			?><div class="pages"><? echo $this->Paginator->numbers(array('separator' => '')); ?></div><?
			echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>