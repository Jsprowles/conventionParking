<?php echo $this->Html->css('/qparc/css/qparc-core.css'); ?>
<script>
$(document).ready(function() {

	// Match all link elements with href attributes within the content div
   $('#locations a[href][title]').qtip(
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

<div>
	<h2><?=$title_for_layout?></h2>
	<p>
		All available locations are listed here. Click on a location's name for more information including Reservation Options and Promotions available. Click on "Reserve Now"
		to create a new reservation for that location.
	</p>
	<table cellpadding="10" cellspacing="15" id="locations">
	<?php
		$tableHeaders =  $this->Html->tableHeaders(array(
			'', // Id
			'', // promote
			'', // name
			'', // seperator
			'' // actions
		));
		echo $tableHeaders;
		$rows = array();
		foreach ($nodes AS $node) {
			
			$actions  = $this->Html->link(__('Reserve Now'), "/reserve/" . $node['Location']['id']);
			
			$rows[] = array(
				$this->Form->input('id',array('type'=>'hidden','value'=>$node['Location']['id'])),
				$this->Layout->promote($node['Location']['promote']),
				$this->Html->link( $node['Location']['name'], '/qparc/locations/view/' . $node['Location']['id'] . "?height=670&width=600",
				array(
					'class' => 'thickbox',
					'style' => 'font-weight:bold;font-size:18px;width:100%;',
					'title' =>  $node['Location']['address']
					)
				),
				" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ",
				$actions,
			);
		}
	
		echo $this->Html->tableCells($rows);
		echo $tableHeaders;
	?>
	</table>

<?php
	echo $this->GoogleMapV3->map(array(
			'div'=>array(
				'id'=>'map', 
				'height'=>'400', 
				'width'=>'100%'
			),
			'autoCenter' => true,
			'map'=>array(
				'navigationControl' => true,
				'streetViewControl' => true
			)
		)); 
	
	foreach ($nodes AS $node) {
		$content = "<strong>" . $node['Location']['name'] . "</strong><br/><br/>" . $node['Location']['address'];
		$marker = array(
		    'lat'=>$node['Location']['lat'],
		    'lng'=>$node['Location']['lon'],
		        'title' => $node['Location']['name'],
		        'content' => $content
	    );
		//debug($marker);
		$this->GoogleMapV3->addMarker($marker);	
	}
	
?>
</div>

<?php echo $this->GoogleMapV3->script() ?>
