	<div>
		<div class="dataTables_info">
			<?php
			echo $this->Paginator->counter(array(
			'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, desde {:start}, hasta {:end}')
			));
			?>
		</div>
	</div>

	<div class="clearfix">
		<div class="dataTables_paginate pagination">
			<ul>
				<?php		
					echo $this->Paginator->prev('< ' . __('Anterior'), array('tag' => 'li'), '<a href="#">< ' . __('Anterior') . '</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
					echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a'));
					echo $this->Paginator->next(__('Siguiente') . ' >', array('tag' => 'li'), '<a href="#">' . __('Siguiente') . ' ></a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
				?>
			</ul>
		</div>
	</div>