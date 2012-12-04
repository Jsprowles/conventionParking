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

<h2>My Reservations</h2>
<?php if(count($locations) > 0): ?>
<span style='font-size:13px;float:right;margin-right:20px;'>
	<?php
		echo $this->Form->create('LocationReservation',array('plugin'=>'qparc','controller'=>'location_reservations','index'));
		$options = array();
		foreach ($locations as $location) {
			$options[$location['Location']['id']] = $location['Location']['name'];
		}

		echo $this->Form->input('LocationReservation.location_id',array("options"=>$options,'label' => false));
		echo $this->Form->end();
	?>
</span>
<?php endif; ?>
<div><strong><?=$this->Html->link(__('Reserve Now'), "/reserve/" . $current_location,array('style'=>'text-decoration:underline;'));?></strong></div>
<div class="clear"></div>

<div id="ridesWrapper">
<?php echo $this->Form->create('LocationReservation', array('url' => array('plugin'=>'qparc', 'controller' => 'location_reservations', 'action' => 'process'))); ?>
<table cellpadding="0" cellspacing="0" style="margin-top:15px;" id="ridesContent" width="650px;">
<?php
	$tableHeaders =  $this->Html->tableHeaders(array(
		'',
		'',
		$this->Paginator->sort('location_reservation_option_id','Option'),
		$this->Paginator->sort('entrance'),
		//$this->Paginator->sort('exit'),
		
		'',
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
		foreach ($location_options AS $option)
		{
			if ($node['LocationReservation']['location_reservation_option_id'] == $option['LocationReservationOption']['id'])
			{
				$selectedOption = $option['LocationReservationOption'];
				break;
			}
		}
		$actions = $this->Html->link('Confirmation', '/reservation/confirmation/' . $node['LocationReservation']['id'] . "?height=550",array('escape'=>false,'class'=>'thickbox'));
		$actions .= ' • ' . $this->Html->link('Edit', '/qparc/locations/edit_reservation/' . $node['LocationReservation']['id']);
		/*$actions .= ' • ' . $this->Layout->adminRowActions($node['LocationReservation']['id']);
		$actions .= ' ' . 	$this->Layout->processLink("Delete",
			'#LocationReservation' . $node['LocationReservation']['id'] . 'Id',
			null, __('Are you sure?'));
		*/
		$actions .= ' • ' . $this->Html->link("Delete",array('plugin'=>'qparc','controller'=>'locations','action'=>'delete_reservation',$node['LocationReservation']['id']));
		$rows[] = array(
			$this->Html->link($this->Html->image('icons/pdf.gif',array('width'=>20)), '/reservation/confirmation/' . $node['LocationReservation']['id'] . ".pdf",array('escape'=>false,'target'=>'_blank','title'=>'Print PDF Confirmation')),
			$node['LocationReservation']['id'],
			$this->Html->link($selectedOption['name'],'#',array('title'=>"<strong>$" . $selectedOption['cost'] . "</strong><br/>" . $selectedOption['description'])),
			date("l m/d/Y", strtotime($node['LocationReservation']['entrance'])),
			//"<span style='color:#888;'>" . date("l m/d/Y", strtotime($node['LocationReservation']['exit'])) . "</span>",
			//$this->Layout->status($node['LocationReservation']['status']),
			$actions,
		);
	}

	echo $this->Html->tableCells($rows);
	echo $tableHeaders;
?>
</table>

<div class="clear"></div>
<?php if ($pagingBlock = $this->fetch('paging')): ?>
	<?php echo $pagingBlock; ?>
<?php else: ?>
	<?php if (isset($this->Paginator)): ?>
		<div class="paging"><?php echo $this->Paginator->numbers(); ?></div>
		<div class="counter" style="font-size:12px;"><?php echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'))); ?></div>
	<?php endif; ?>
<?php endif; ?>

</div>

<!--
<div class="bulk-actions">
<?php
	echo $this->Form->input('LocationReservation.method',array('type'=>'hidden','value'=>'action'));
	echo $this->Form->input('LocationReservation.action', array(
		'label' => false,
		'options' => array(
			'delete' => __('Delete'),
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
-->

