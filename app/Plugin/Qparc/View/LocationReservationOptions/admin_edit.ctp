<div class="index" style="padding-top:20px;">
		<h3><?php echo $title_for_layout; ?></h3>
		<?php 
			$options = array('1'=>'Daily','30'=>'Monthly');
			echo $this->Form->create('LocationReservationOption');
			echo $this->Form->input('id',array('type'=>'hidden'));
			echo $this->Form->input('location_id',array('type'=>'hidden'));
			echo $this->Form->input('name');
			echo $this->Form->input('description');
			echo $this->Form->input('cost',array('div'=>false));
			echo $this->Form->input('terms',array('options'=>$options,'label'=>false,'div'=>false));
			echo $this->Form->input('status',array('label'=>'Enabled'));
			echo "<br/>";
			echo $this->Form->end('save'); 
		?>
</div>