<script>
var Locations = {};

Locations.confirmProcess = function(confirmMessage) {
	var action = $('#LocationAction :selected');
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

</script>

<?php echo $this->Form->create('Location', array('url' => array('plugin'=>'qparc', 'controller' => 'locations', 'action' => 'process'))); ?>
<table cellpadding="0" cellspacing="0" style="margin-top:15px;">
<?php
	$tableHeaders =  $this->Html->tableHeaders(array(
		'',
		$this->Paginator->sort('id'),
		$this->Paginator->sort('name'),
		$this->Paginator->sort('address'),
		$this->Paginator->sort('promote'),
		$this->Paginator->sort('status'),
		__('Actions'),
	));
	echo 
	$tableHeaders;

	$rows = array();
	foreach ($nodes AS $node) {
		//$actions  = $this->Html->link(__('Manage'), array('controller'=>'qparc','action' => 'admin_manage', $node['Location']['id']),array('style'=>'color:#C00;'));
		$actions = $this->Html->link('Details', '/admin/qparc/locations/view/' . $node['Location']['id']);
		$actions .= '• ' . $this->Html->link('Edit', '/admin/qparc/locations/edit/' . $node['Location']['id'] . '/?height=525',array('class'=>'thickbox','escape'=>false));
		$actions .= '• ' . $this->Layout->adminRowActions($node['Location']['id']);
		$actions .= ' ' . $this->Layout->processLink("Delete",
			'#Location' . $node['Location']['id'] . 'Id',
			null, __('Are you sure?'));
		
		$rows[] = array(
			$this->Form->checkbox('Location.'.$node['Location']['id'].'.id'),
			$node['Location']['id'] ,
			$this->Html->link($node['Location']['name'],array('controller'=>'qparc','action' => 'admin_manage', $node['Location']['id']),array('style'=>'font-weight:bold;')),
			$node['Location']['address'],
			$this->Layout->promote($node['Location']['promote']),
			$this->Layout->status($node['Location']['status']),
			$actions,
		);
	}

	echo $this->Html->tableCells($rows);
	echo $tableHeaders;
?>
</table>

<div class="bulk-actions">
<?php
	echo $this->Form->input('Location.action', array(
		'label' => false,
		'options' => array(
			'publish' => __('Online'),
			'unpublish' => __('Offline'),
			'promote' => __('Promote'),
			'unpromote' => __('Unpromote'),
			'delete' => __('Delete'),
		),
		'empty' => false,
	));
	$jsVarName = uniqid('confirmMessage_');
	echo $this->Form->button(__('Submit'), array(
		'type' => 'button',
		'onclick' => sprintf('return Locations.confirmProcess(app.%s)', $jsVarName),
		));
	$this->Js->set($jsVarName, __('%s selected items?'));

	echo $this->Form->end();
?>
</div>

<br/>
<?php if ($pagingBlock = $this->fetch('paging')): ?>
	<?php echo $pagingBlock; ?>
<?php else: ?>
	<?php if (isset($this->Paginator)): ?>
		<div class="paging"><?php echo $this->Paginator->numbers(); ?></div>
		<div class="counter"><?php echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'))); ?></div>
	<?php endif; ?>
<?php endif; ?>
