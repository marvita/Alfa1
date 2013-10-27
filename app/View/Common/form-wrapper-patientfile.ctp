<? if (!isset($mode)) $mode = "default"; ?>
<? if ($this->fetch("title")) { ?>
<div class="widgets_area">
    <div class="row-fluid">
        <div class="span6">
<? } ?>
            <div class="well light_blue">
                <? if ($this->fetch("title")) { ?>
                <div class="well-header">
                    <h5><? echo $this->fetch("title") ?></h5>
                </div>
                <? } ?>

                <div class="well-content no-search no_padding">

                	<? if ($this->fetch("form_open")) {
                        echo $this->fetch("form_open");
                        $formopen = true;
                    } ?>
                    
                    <div class="navbar-inner">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#ficha" data-toggle="tab">Ficha</a></li>
                            <?= $this->fetch("tabs") ?>
                            
                        </ul>
                    </div>

                    <div class="tab-content">

                	   <div class="tab-pane active" id="ficha">
						<?= $this->fetch("fields") ?>
                        <?= $this->fetch("content") ?>
                    
					   </div>

					   <?= $this->fetch('tabcontents') ?>
                    </div>
                    
                    <? if ($this->fetch('editLinks')) { ?>
                        <div class="editLinks">
                            <?= $this->fetch('editLinks') ?>
                        </div>
                    <? } ?>
                    
					<? if (isset($formopen) && $formopen) {
                        echo $this->fetch("form_submit");
                        echo $this->Form->end();
                    } ?>
                </div>
            </div>
<? if ($this->fetch("title")) { ?>
		</div>
	</div>
</div>
<? } ?>