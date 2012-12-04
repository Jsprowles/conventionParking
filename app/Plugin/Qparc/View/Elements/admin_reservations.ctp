<?php if (count($reservations) > 0): ?>

<script>

var LocationReservations = {};

LocationReservations.confirmProcess = function(confirmMessage) {
	var action = $('#LocationReservationAction :selected');
	if (confirmMessage == undefined) {
		confirmMessage = 'Are you sure?';
	} else {
		confirmMessage = confirmMessage.replace(/\%s/, action.text());
	}
	if (confirm(confirmMessage)) {
		action.get(0).form.submit();
	}
	return false;
}

$(document).ready(function() {
	
	$("#LocationReservationLocationId").change(function(){
		$("#LocationReservationIndexForm").submit();
	});
	
	// Match all link elements with href attributes within the content div
   $('#ridesContent a[href][title]').qtip(
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

<div id="ridesWrapper">
<?php echo $this->Form->create('LocationReservation', array('url' => array('plugin'=>'qparc', 'controller' => 'location_reservations', 'action' => 'process'))); ?>
<table cellpadding="0" cellspacing="0" style="margin-top:15px;" id="ridesContent" width="650px;">
<?php
	$tableHeaders =  $this->Html->tableHeaders(array(
		'',
		'',
		'',
		'',
		$this->Paginator->sort('location_reservation_option_id','Parking Option'),
		$this->Paginator->sort('entrance'),
		$this->Paginator->sort('exit'),
		$this->Paginator->sort('status'),
		__('Actions'),
		''
	));
	echo 
	$tableHeaders;
	$rows = array();
	if (count($nodes) == 0)
	{
		$rows[] = array(
		"No Reservations for this Location"
		);
	}

	foreach ($nodes AS $node) {
		
		$selectedOption = '';
		foreach ($options AS $option)
		{
			if ($node['LocationReservation']['location_reservation_option_id'] == $option['LocationReservationOption']['id'])
			{
				$selectedOption = $option['LocationReservationOption'];
				break;
			}
		}
		$actions = $this->Html->link('Details', '/reservation/confirmation/' . $node['LocationReservation']['id'] . "?height=550",array('escape'=>false,'class'=>'thickbox'));
		$actions .= ' • ' . $this->Html->link('Edit', '/admin/qparc/locations/edit_reservation/' . $node['LocationReservation']['id'],array('escape'=>false));
		$actions .= ' • ' . $this->Layout->adminRowActions($node['LocationReservation']['id']);
		$actions .= ' ' . $this->Layout->processLink("Delete",
			'#LocationReservation' . $node['LocationReservation']['id'] . 'Id',
			null, __('Are you sure?'));

		$rows[] = array(
			$this->Form->checkbox('LocationReservation.'.$node['LocationReservation']['id'].'.id'),
			$node['LocationReservation']['id'],
			$this->Html->link($this->Html->image('icons/111-user.png',array('width'=>20)), '/admin/users/edit/' . $node['LocationReservation']['user_id'] .'?height=650', array('escape'=>false, 'class'=>'thickbox','title'=>'View User '.$node['LocationReservation']['user_id'].' Details')),
			$this->Html->link($this->Html->image('icons/pdf.gif',array('width'=>20)), '/reservation/confirmation/' . $node['LocationReservation']['id'] . ".pdf",array('escape'=>false,'target'=>'_blank','title'=>'PDF Confirmation')),
			$this->Html->link($selectedOption['name'],'#',array('title'=>"<strong>$" . $selectedOption['cost'] . "</strong><br/>" . $selectedOption['description'])),
			date("l m/d/Y", strtotime($node['LocationReservation']['entrance'])),
			"<span style='color:#888;'>" . date("l m/d/Y", strtotime($node['LocationReservation']['exit'])) . "</span>",
			$this->Layout->status($node['LocationReservation']['status']),
			$actions,
			$this->Form->input('LocationReservation.location_id',array('type'=>'hidden','value'=>$node['LocationReservation']['location_id']))
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
		<div class="paging" style="text-align: left;"><?php echo $this->Paginator->numbers(); ?></div>
		<div class="counter" style="font-size:12px;text-align: left;"><?php echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'))); ?></div>
	<?php endif; ?>
<?php endif; ?>

<div class="clear"></div>

<div class="bulk-actions">
<?php
	echo $this->Form->input('LocationReservation.action', array(
		'label' => false,
		'options' => array(
			'delete' => __('Delete'),
			'publish' => __('Activate'),
			'unpublish' => __('Cancel'),
		),
		'empty' => false,
	));
	$jsVarName = uniqid('confirmMessage_');
	echo $this->Form->button(__('Submit'), array(
		'type' => 'button',
		'onclick' => sprintf('return LocationReservations.confirmProcess(app.%s)', $jsVarName),
		));
	$this->Js->set($jsVarName, __('%s selected items?'));

	echo $this->Form->end();
?>
</div>

</div>

<?php else: ?>
	<p>No Reservations have been made for this location.</p>
<?php endif; ?>
