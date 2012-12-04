<?php if (count($nodes) > 0): ?>

<script>
var LocationPromos = {};

LocationPromos.confirmProcess = function(confirmMessage,method) {
	var action = $('#LocationPromoAction :selected');
	if (confirmMessage == undefined) {
		confirmMessage = 'Are you sure?';
	} else {
		$("#LocationPromoMethod").val(method);
		confirmMessage = confirmMessage.replace(/\%s/, action.text());
	}
	if (confirm(confirmMessage)) {
		action.get(0).form.submit();
	}
	return false;
}

$(document).ready(function() {
	
	// Match all link elements with href attributes within the content div
   $('#promosContent a[href][title]').qtip(
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

<?php echo $this->Form->create('LocationPromo', array('url' => array('plugin'=>'qparc', 'controller' => 'Location_promos', 'action' => 'process'))); ?>
<table cellpadding="0" cellspacing="0" id="promosContent">
<?php
	$tableHeaders =  $this->Html->tableHeaders(array(
		'',
		$this->Paginator->sort('id'),
		$this->Paginator->sort('name'),
		$this->Paginator->sort('created'),
		$this->Paginator->sort('promote'),
		$this->Paginator->sort('status'),
		__('Actions'),
		''
	));
	echo 
	$tableHeaders;

	$rows = array();
	foreach ($nodes AS $node) {
		//$actions  = $this->Html->link(__('View'), '/admin/qparc/location_promos/view/' . $node['LocationPromo']['id'] . "/?height=320&width=300" ,array('class'=>'thickbox'));
		$actions = $this->Html->link(__('Edit'), '/admin/qparc/location_promos/edit/' . $node['LocationPromo']['id'] . "/?height=520",array('class'=>'thickbox'));
		$actions .= ' ' . $this->Layout->adminRowActions($node['LocationPromo']['id']);
		$actions .= '• ' . $this->Layout->processLink(__('Delete'),
			'#LocationPromo' . $node['LocationPromo']['id'] . 'Id',
			null, __('Are you sure?'));

		$rows[] = array(
			$this->Form->checkbox('LocationPromo.'.$node['LocationPromo']['id'].'.id'),
			$node['LocationPromo']['id'],
			$this->Html->link($node['LocationPromo']['name'],'/admin/qparc/location_promos/view/' . $node['LocationPromo']['id'] . "/?height=400&width=300" ,
			array(
				'class'=>'thickbox',
				'title'=>$node['LocationPromo']['details']
				)
			),
			date("l m/d/Y", strtotime($node['LocationPromo']['created'])),
			$this->Layout->promote($node['LocationPromo']['promote']),
			$this->Layout->status($node['LocationPromo']['status']),
			$actions,
			$this->Form->input('LocationPromo.location_id',array('type'=>'hidden','value'=>$node['LocationPromo']['location_id']))
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
	echo $this->Form->input('LocationPromo.method',array('type'=>'hidden','value'=>'action'));
	echo $this->Form->input('LocationPromo.action', array(
		'label' => 'Actions',
		'options' => array(
			'publish' => __('Online'),
			'unpublish' => __('Offline'),
			'promote' => __('Promote'),
			'unpromote' => __('Unpromote'),
			'delete' => __('Delete'),
		),
		'empty' => true,
	));
	$jsVarName = uniqid('confirmMessage_');
	echo $this->Form->button(__('Submit'), array(
		'type' => 'button',
		'onclick' => sprintf("return LocationPromos.confirmProcess(app.%s,'copy')", $jsVarName),
		));
	$this->Js->set($jsVarName, __('%s selected items?'));
?>
</div>

<div style="float:left;padding-left:15px;">
<?php
	unset($location_options[$location['Location']['id']]);
	echo $this->Form->input('LocationPromo.copy', array(
		'label' => 'Copy Selections To',
		'div'=>true,
		'options' =>$location_options,
		'empty' => true,
	));
	echo $this->Form->button(__('Submit'), array(
		'type' => 'button',
		'onclick' => "return LocationPromos.confirmProcess('Copy selected items to this location?','copy')",
		));
	
	echo $this->Form->end();
?>
</div>

</div>
<div class="clear"></div>

<?php else: ?>
	<p>No Promotions have been created for this location.</p>
<?php endif; ?>

