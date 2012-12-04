<h2><?=$title_for_layout?><span style="font-size:14px;float:right;">&nbsp;<?=$location['Location']['name'];?>&nbsp;•&nbsp; <?=$this->Html->link('Back to Locations','/admin/qparc');?></span></h2>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link('New Promotion','/admin/qparc/location_promos/add/' . $location['Location']['id'],array('class'=>'thickbox')); ?></li>
	</ul>
</div>
<?php echo $this->element('admin_promos'); ?>