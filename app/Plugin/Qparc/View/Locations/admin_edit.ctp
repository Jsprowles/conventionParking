<div class="index" style="padding-top:20px;">
		<h3><?php echo $title_for_layout; ?></h3>
		<?php 
			echo $this->Form->create('Location');
			echo $this->Form->input('id');
			echo $this->Form->input('name');
			echo $this->Form->input('address');
			echo $this->Form->input('terms');
			if (Configure::read('Qparc.iparc_enabled')) {
				echo $this->Form->input('lot_id',array('type'=>'text',array('label'=>'Lot ID')));
				echo "* This setting is enabled as part of ". $this->Html->link('iParc integration','/admin/qparc/#settings') .".<br/>";
			}
			echo $this->Form->input('promote',array('label'=>'Featured'));
			echo $this->Form->input('status',array('label'=>'Enabled'));
			echo "<br/>";
			echo $this->Form->end('save'); 
		?>
</div>