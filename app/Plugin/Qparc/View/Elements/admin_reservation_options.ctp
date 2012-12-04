<?php if (count($nodes) > 0): ?>

<script>
var LocationReservationOptions = {};

LocationReservationOptions.confirmProcess = function(confirmMessage,method) {
	var action = $('#LocationReservationOptionAction :selected');
	if (confirmMessage == undefined) {
		confirmMessage = 'Are you sure?';
	} else {
		$("#LocationReservationOptionMethod").val(method);
		confirmMessage = confirmMessage.replace(/\%s/, action.text());
		
	}
	if (confirm(confirmMessage)) {
		action.get(0).form.submit();
	}
	return false;
}

$(document).ready(function() {
	
	// Match all link elements with href attributes within the content div
   $('#optionsContent a[href][title]').qtip(
   {
     content: {
         text: false // Use each elements title attribute
      },
      style: {
	      border: {
	         width: 5,
	         radius: 10
	      },
	      padding: 10, 
          textAlign: 'left',
          tip: true, // Give it a speech bubble tip with automatic corner detection
          name: 'cream' // Style it according to the preset 'cream' style
       }
   });
	
});

</script>

<?php echo $this->Form->create('LocationReservationOption', array('url' => array('plugin'=>'qparc', 'controller' => 'location_reservation_options', 'action' => 'process'))); ?>

<table cellpadding="0" cellspacing="0" style="margin-top:15px;" id="optionsContent">
<?php
	$tableHeaders =  $this->Html->tableHeaders(array(
		'',
		$this->Paginator->sort('id'),
		$this->Paginator->sort('name'),
		$this->Paginator->sort('cost'),
		$this->Paginator->sort('status'),
		__('Actions'),
		''
	));
	echo 
	$tableHeaders;

	$rows = array();
	foreach ($nodes AS $node) {
		$actions = $this->Html->link('Edit', '/admin/qparc/location_reservation_options/edit/' . $node['LocationReservationOption']['id'] . '/',array('class'=>'thickbox','escape'=>false));
		$actions .= '• ' . $this->Layout->adminRowActions($node['LocationReservationOption']['id']);
		$actions .= ' ' . $this->Layout->processLink(__('Delete'),
			'#LocationReservationOption' . $node['LocationReservationOption']['id'] . 'Id',
			null, __('Are you sure?'));

		$rows[] = array(
			$this->Form->checkbox('LocationReservationOption.'.$node['LocationReservationOption']['id'].'.id'),
			$node['LocationReservationOption']['id'],
			$this->Html->link($node['LocationReservationOption']['name'], "/reserve/" . $node['LocationReservationOption']['location_id'],
			array(
				'title' => $node['LocationReservationOption']['description'] . "<br/><strong>Click to Reserve</strong>"
				)
			),
			"$" . $node['LocationReservationOption']['cost'],
			$this->Layout->status($node['LocationReservationOption']['status']),
			$actions,
			$this->Form->input('LocationReservationOption.location_id',array('type'=>'hidden','value'=>$node['LocationReservationOption']['location_id']))
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
	echo $this->Form->input('LocationReservationOption.method',array('type'=>'hidden','value'=>'action'));

	echo $this->Form->input('LocationReservationOption.action', array(
		'label' => 'Actions',
		'div'=>true,
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
		'onclick' => sprintf("return LocationReservationOptions.confirmProcess(app.%s,'action')", $jsVarName),
		));
	$this->Js->set($jsVarName, __('%s selected items?'));

	//echo $this->Form->end();
?>
</div>

<div style="float:left;padding-left:15px;">
<?php
	// unset THIS location from the options
	unset($location_options[$location['Location']['id']]);
	echo $this->Form->input('LocationReservationOption.copy', array(
		'label' => 'Copy Selections To',
		'div'=>true,
		'options' =>$location_options,
		'empty' => true,
	));
	echo $this->Form->button(__('Submit'), array(
		'type' => 'button',
		'onclick' => "return LocationReservationOptions.confirmProcess('Copy selected items to this location?','copy')",
		));
	
	echo $this->Form->end();
?>
</div>

</div>
<div class="clear"></div>


<?php else: ?>
	<p>No Parking Options have been created for this location.</p>
<?php endif; ?>
