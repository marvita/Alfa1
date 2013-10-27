<? if (!isset($mode)) $mode = "default"; ?>
<? if ($this->fetch("title")) { ?>
<div class="widgets_area">
    <div class="row-fluid">
        <div class="span6">
<? } ?>
            <div class="well form light_blue">
                <? if ($this->fetch("title")) { ?>
                <div class="well-header">
                    <h5><? echo $this->fetch("title") ?></h5>
                </div>
                <? } ?>

                <div class="well-content no-search">

                	<? if ($this->fetch("form_open")) {
                        echo $this->fetch("form_open");
                        $formopen = true;
                    } ?>
                    
                    <? if ($this->fetch('contextLinks')) { ?>
                        <div class="contextLinks">
                            <?= $this->fetch('contextLinks') ?>
                        </div>
                    <? } ?>

                	<div class="fields">
						<?= $this->fetch("fields") ?>
					</div>

					<div class="associations">
						<?= $this->fetch("content") ?>
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