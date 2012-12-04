<script>

var Locations = {};

Locations.documentReady = function() {
	Locations.filter();
}

Nodes.filter = function() {
	
	$('.nodes div.actions a.filter').click(function() {
		$('.nodes div.filter').slideToggle();
		return false;
	});
	
	$('#FilterAddForm div.submit input').click(function() {
		$('#FilterAddForm').submit();
		return false;
	});

	$('#FilterAdminIndexForm').submit(function() {
		var filter = '';
		var q='';
	
		// type
		if ($('#FilterType').val() != '') {
			filter += 'type:' + $('#FilterType').val() + ';';
		}
	
		// status
		if ($('#FilterStatus').val() != '') {
			filter += 'status:' + $('#FilterStatus').val() + ';';
		}
	
		// promoted
		if ($('#FilterPromote').val() != '') {
			filter += 'promote:' + $('#FilterPromote').val() + ';';
		}
	
		//query string
		if($('#FilterQ').val() != '') {
			q=$('#FilterQ').val();
		}
		var loadUrl = Croogo.basePath + 'admin/nodes/index/';
		if (filter != '') {
			loadUrl += 'filter:' + filter;
		}
		if (q != '') {
			if (filter == '') {
				loadUrl +='q:'+q;
			} else {
				loadUrl +='/q:'+q;
				}
			}
	
			window.location = loadUrl;
			return false;
	});
}
	
</script>

<?php
	if (isset($this->params['named']['filter'])) {
		$this->Html->scriptBlock('var filter = 1;', array('inline' => false));
	}
?>
<div class="filter">
<?php
	echo $this->Form->create('Filter');
	$filterType = '';
	if (isset($filters['type'])) {
		$filterType = $filters['type'];
	}
	
	$filterStatus = '';
	if (isset($filters['status'])) {
		$filterStatus = $filters['status'];
	}
	echo $this->Form->input('Filter.status', array(
		'options' => array(
			'1' => __('Published'),
			'0' => __('Unpublished'),
		),
		'empty' => true,
		'value' => $filterStatus,
	));
	$filterPromote = '';
	if (isset($filters['promote'])) {
		$filterPromote = $filters['promote'];
	}
	echo $this->Form->input('Filter.promote', array(
		'label' => __('Promoted'),
		'options' => array(
			'1' => __('Yes'),
			'0' => __('No'),
		),
		'empty' => true,
		'value' => $filterPromote,
	));

	$filterSearch = '';
	if (isset($this->params['named']['q'])) {
		$filterSearch = $this->params['named']['q'];
	}
	echo $this->Form->input('Filter.q', array(
		'label' => __('Search'),
		'value' => $filterSearch,
	));
	echo $this->Form->end(__('Filter'));
?>
	<div class="clear">&nbsp;</div>
</div>