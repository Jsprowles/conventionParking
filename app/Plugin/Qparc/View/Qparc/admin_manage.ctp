<script type="text/javascript">
	
$(document).ready(function() {

$("#QparcLocationId").change(function(){
	$("#QparcAdminManageForm").submit();
});
	
});
	
</script>
<?php $this->Html->css('/qparc/css/qparc-core.css', null, array('inline'=>false)); ?>
<?php if(count($all_locations) > 0): ?>
<?php
echo $this->Form->create('Qparc',array('plugin'=>'qparc','controller'=>'qparc','admin_manage'));
$location_options = array();
foreach ($all_locations as $select_location) {
	$location_options[$select_location['Location']['id']] = $select_location['Location']['name'];
}

?>
<div style="float:right;margin-right:53px;">
	<?php 
	echo "<span style='color:#777;font-variant:small-caps;'>change location:</span><br/>";
	echo $this->Form->input('Qparc.location_id',array("options"=>$location_options,'label' => false,'div'=>false));
	echo "&nbsp; • &nbsp;";
	echo $this->Html->link('Back to Locations',array("plugin"=>'qparc',"controller"=>'qparc','action'=>'admin_index')); 
	?>
</div>

<?php echo $this->Form->end(); ?>

<?php endif; ?>

<h2 style="color:#777777;font-size:250%;"><?=$title_for_layout?></h2>

<div class="index">
	<div class="tabs">
		<ul>
			<li><a href="#options">Parking Options</a></li>
			<li><a href="#promos">Promotions</a></li>
			<li><a href="#reservations">Reservations</a></li>
			<li><a href="#dates">Blackout Dates</a></li>
			<li style="float:right;margin-right:50px;"><a href="#settings">Location Settings</a></li>
		</ul>
		
		<fieldset>
			<div id="options">
				<legend>Parking Options<?=$this->element('actions_options');?></legend>
				<?php echo $this->element('admin_reservation_options',array('nodes'=>$options,'location_options'=>$location_options)); ?>
			</div>
			<div id="promos">
				<legend>Manage Promotions<?=$this->element('actions_promos');?></legend>
				<?php echo $this->element('admin_promos',array('nodes'=>$promos,'location_options'=>$location_options)); ?>
			</div>
			<div id="reservations">
				<legend>Manage Reservations<?=$this->element('actions_reservations');?></legend>
				<?php echo $this->element('admin_reservations',array('nodes'=>$reservations)); ?>
			</div>
			<div id="dates">
				<legend>Manage Blackout Dates<?=$this->element('actions_dates');?></legend>
				<?php echo $this->element('admin_dates',array('dates'=>$dates,'location_options'=>$location_options)); ?>
			</div>
			<div id="settings">
				<?php echo $this->element('admin_settings'); ?>
			</div>
		</fieldset>
		
	</div>
	
</div>