<div class="index" style="padding-top:10px;">
	<h3><?php echo $title_for_layout; ?></h3>
		<?php 
			echo $this->Form->create('LocationPromo');
			echo $this->Form->input('location_id',array('type'=>'hidden','value'=>$location_id));
			echo $this->Form->input('name');
			echo $this->Form->input('details',array('label'=>'Details'));
			if (!Configure::read('Qparc.iparc_enabled')) {
				echo $this->Form->input('code',array('label'=>'QR Code'));
				echo "* " . $this->Html->link('iParc integration','/admin/qparc/#settings') ." is <strong>not</strong> enabled, your QR Code will <strong>not</strong> generate a .csv file.<br/>";
			} else {
				echo $this->Form->input('store',array('label'=>'Store Number'));
				echo "* You have ". $this->Html->link('iParc integration','/admin/qparc/#settings') ." enabled, your QR Code will automatically be generated.<br/>";
			}
			echo "<br/><br/><label>Start Date</label><br/>";
			echo $this->Form->input('start',array('label'=>false,'div'=>false,'minYear'=>'2012','maxYear'=>'2020'));
			echo "<br/><br/><label>Expiration Date</label><br/>";
			echo $this->Form->input('expiration',array('label'=>false,'div'=>false,'minYear'=>'2012','maxYear'=>'2020'));
			//echo "<br/><br/><label>Number of Uses</label><br/>";
			//echo $this->Form->input('number_of_uses',array('label'=>false,'div'=>false));
			echo $this->Form->input('promote',array('label'=>'Featured','type'=>'checkbox'));
			echo $this->Form->input('status',array('label'=>'Enabled','type'=>'checkbox'));
			echo "<br/>";
			echo $this->Form->end('save'); 
		?>
</div>