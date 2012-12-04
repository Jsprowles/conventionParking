<?php $this->Html->css('/qparc/css/qparc-core.css', null, array('inline'=>false)); ?>
<div class="index">
	<div class="tabs">
		
		<ul>
			<li><a href="#locations">Locations</a></li>
			<li><a href="#settings">Global Settings</a></li>
		</ul>
		
		<fieldset>
			<div id="locations">
				<legend>Manage Locations<?=$this->element('actions_locations');?></legend>
				<?php echo $this->element('admin_locations'); ?>
			</div>
			
			<div id="settings">
				<?php echo $this->element('admin_global_settings'); ?>
			</div>
		</fieldset>
		
	</div>
</div>