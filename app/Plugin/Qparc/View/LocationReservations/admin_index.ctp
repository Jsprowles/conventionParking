<div class="index">
	<h2><?=$title_for_layout?><span style="font-size:14px;float:right;">&nbsp;<?=$location['Location']['name'];?> &nbsp;•&nbsp; <?=$this->Html->link('Back to Locations','/admin/qparc');?></span></h2>
	<?php 
		echo $this->element('admin_reservations');
	?>
</div>


<?php $this->Html->css('/qparc/css/qparc-core.css', null, array('inline'=>false)); ?>

<div class="index">
	
	<div class="tabs">
		
		<ul>
			<li><a href="#reservations">Reservations</a></li>
			<li><a href="#options">Parking Options</a></li>
		</ul>
		
		<fieldset>
			
			<div id="reservations">
				<legend>Manage Reservations<span style="float:right;"><?php echo $this->Html->link('[+] New Reservation','/admin/qparc/locations/add/',array('style'=>'color:#FFF;text-decoration:none;','class'=>'thickbox'));?></span></legend>
				<?php echo $this->element('admin_reservations'); ?>
			</div>
			
			<div id="options">
				<legend>Parking Options<span style="float:right;"><?php echo $this->Html->link('[+] New Parking Option','/admin/qparc/locations/add/',array('style'=>'color:#FFF;text-decoration:none;','class'=>'thickbox'));?></span></legend>
				<?php echo $this->element('admin_reservation_options'); ?>
			</div>
		</fieldset>
		
	</div>
	
</div>