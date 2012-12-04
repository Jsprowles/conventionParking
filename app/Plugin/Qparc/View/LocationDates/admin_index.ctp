<h2>Manage Promotions</h2>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link('Back to Locations',array('plugin'=>'qparc','controller'=>'qparc','action'=>'admin_index')); ?></li>
		<li><?php echo $this->Html->link('New Blackout Date',array('plugin'=>'qparc','controller'=>'location_promos','action'=>'admin_add'),array('class'=>'thickbox')); ?></li>
	</ul>
</div>
<?php echo $this->element('admin_dates'); ?>