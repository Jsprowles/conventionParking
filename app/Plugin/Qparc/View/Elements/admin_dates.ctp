<?php if (count($dates) > 0): ?>
<script>
var LocationDates = {};

LocationDates.confirmProcess = function(confirmMessage,method) {
	var action = $('#LocationDateAction :selected');
	if (confirmMessage == undefined) {
		confirmMessage = 'Are you sure?';
	} else {
		$("#LocationDateMethod").val(method);
		confirmMessage = confirmMessage.replace(/\%s/, action.text());
	}
	if (confirm(confirmMessage)) {
		action.get(0).form.submit();
	}
	return false;
}
</script>

<?php echo $this->Form->create('LocationDates', array('url' => array('plugin'=>'qparc', 'controller' => 'location_dates', 'action' => 'process'))); ?>

<table cellpadding="0" cellspacing="0" style="margin-top:15px;">
<?php
	$tableHeaders =  $this->Html->tableHeaders(array(
		'',
		$this->Paginator->sort('id'),
		$this->Paginator->sort('from','Date From'),
		$this->Paginator->sort('to','Date To'),
		$this->Paginator->sort('status'),
		__('Actions'),
		''
	));
	echo 
	$tableHeaders;

	$rows = array();
	foreach ($dates AS $date) {
		$actions = $this->Html->link(__('Edit'), '/admin/qparc/location_dates/edit/' . $date['LocationDate']['id'] . '/',array('class'=>'thickbox'));
		$actions .= ' ' . $this->Layout->adminRowActions($date['LocationDate']['id']);
		$actions .= '•&nbsp;' . $this->Layout->processLink(__('Delete'),
			'#LocationDate' . $date['LocationDate']['id'] . 'Id',
			null, __('Are you sure?'));

		$rows[] = array(
			$this->Form->checkbox('LocationDate.'.$date['LocationDate']['id'].'.id'),
			$date['LocationDate']['id'],
			date("l m/d/Y", strtotime($date['LocationDate']['from'])),
			date("l m/d/Y", strtotime($date['LocationDate']['to'])),
			$this->Layout->status($date['LocationDate']['status']),
			$actions,
			$this->Form->input('LocationDate.location_id',array('type'=>'hidden','value'=>$date['LocationDate']['location_id']))
		);
	}

	echo $this->Html->tableCells($rows);
	echo $tableHeaders;
?>
</table>
<?php if ($pagingBlock = $this->fetch('paging')): ?>
	<?php echo $pagingBlock; ?>
<?php else: ?>
	<?php if (isset($this->Paginator)): ?>
		<div class="paging" style="text-align:left;"><?php echo $this->Paginator->numbers(); ?></div>
		<div class="counter" style="text-align:left;"><?php echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'))); ?></div>
	<?php endif; ?>
<?php endif; ?>

<div class="clear"></div>

<div class="bulk-actions">
<div style="float:left;">
<?php
	echo $this->Form->input('LocationDate.method',array('type'=>'hidden','value'=>'action'));
	echo $this->Form->input('LocationDate.action', array(
		'label' => 'Actions',
		'options' => array(
			'publish' => __('Enable'),
			'unpublish' => __('Disable'),
			'delete' => __('Delete'),
		),
		'empty' => true,
	));
	$jsVarName = uniqid('confirmMessage_');
	echo $this->Form->button(__('Submit'), array(
		'type' => 'button',
		'onclick' => sprintf("return LocationDates.confirmProcess(app.%s,'action')", $jsVarName),
		));
	$this->Js->set($jsVarName, __('%s selected items?'));

?>
</div>
<div style="float:left;padding-left:15px;">
<?php
	// unset THIS location from the options
	unset($location_options[$location['Location']['id']]);
	echo $this->Form->input('LocationDate.copy', array(
		'label' => 'Copy Selections To',
		'div'=>true,
		'options' =>$location_options,
		'empty' => true,
	));
	echo $this->Form->button(__('Submit'), array(
		'type' => 'button',
		'onclick' => "return LocationDates.confirmProcess('Copy selected items to this location?','copy')",
		));
	
	echo $this->Form->end();
?>
</div>

</div>
<div class="clear"></div>

<?php else: ?>
	<p>No Blackout Dates have been defined for this location.</p>
<?php endif; ?>