<script>
$(document).ready(function() {

	$("#LocationId").change(function(){
		$("#LocationAdminViewForm").submit();
	});
	
});
</script>

<style>
	.confirm_label
	{
		width:200px;
		padding-bottom:10px;
		padding-top:10px;
		border-bottom: 1px solid #CCC;
	}
	.confirm_label_promo
	{
		width:150px;
		padding-bottom:10px;
		padding-top:10px;
		border-bottom: 1px solid #CCC;
	}
	.confirm_value
	{
		font-weight:bold;
		font-size:14px;
		padding-bottom:10px;
		padding-top:10px;
		border-bottom: 1px solid #CCC;
	}
	
	#map img
	{
		border:1px solid #ccc;
		-moz-box-shadow: 1px 1px 10px black;
		-webkit-box-shadow: 1px 1px 10px black;
		box-shadow: 1px 1px 10px black;
	}
</style>

<div>
<div style="float:left;">
	<?=$this->Html->image('logo.png',array('height'=>50));?>
</div>
<div style="float:right;">
	<?php 
	echo $this->Form->create('Location',array('plugin'=>'qparc','controller'=>'locations','admin_view'));
	
	$location_options = array();
	foreach ($all_locations as $select_location) {
		$location_options[$select_location['Location']['id']] = $select_location['Location']['name'];
	}
	
	echo "<span style='color:#777;font-variant:small-caps;'>change location:</span><br/>";
	echo $this->Form->input('Location.id',array("options"=>$location_options,'label' => false,'div'=>false));
	echo "&nbsp; • &nbsp;";
	echo $this->Html->link('Back to Locations',array("plugin"=>'qparc',"controller"=>'qparc','action'=>'admin_index')); 
	echo $this->Form->end();
	?>
</div>
<div class="clear"></div>
<br/>

<table>
	<!--
	<tr>
		<td class="confirm_label"><span style="float:left;margin-top:15px;font-weight:bold;text-decoration:none;"><?php echo $this->Html->image('icons/pdf.gif',array('width'=>20)) . "&nbsp;" . $this->Html->link('Print PDF',"/reservation/confirmation/" . $location['Location']['id'] . ".pdf",array('target'=>'_blank')); ?></span></td>
		<td class="confirm_value"></td>
	</tr>
	-->
	<tr>
		<td rowspan="15" style="text-align:center;">
			<?php
				$url = "http://maps.googleapis.com/maps/api/staticmap?center=" . $location['Location']['address'] . "&zoom=14&size=700x400&maptype=roadmap
				&markers=color:blue%7Clabel:X%7C".$location['Location']['lat'] . "," . $location['Location']['lon'] . "&sensor=false";
				?>
				
			<div id="map">
				<a href="http://maps.google.com/maps?q=<?=$location['Location']['address']?>" target="_blank">
					<img src="<?=$url?>" height="400" width="700" />
				</a>
			</div>
		</td>
	</tr>
	<tr>
		<td class="confirm_label">Location</td>
		<td class="confirm_value">
			<?php
			echo $this->Html->link( $location['Location']['name'], '/qparc/locations/view/' . $location['Location']['id'] . "?height=620&width=570",
			array(
				'class' => 'thickbox',
				'title' =>  $location['Location']['address']
				)
			);
			?>
		</td>
	</tr>
	<tr>
		<td class="confirm_label">Address</td>
		<td class="confirm_value">
			<?php echo $location['Location']['address']; ?>
		</td>
	</tr>
	<tr>
		<td class="confirm_label">Status</td>
		<td class="confirm_value"><?=$this->Layout->status($location['Location']['status'])?></td>
	</tr>
	<tr>
		<td class="confirm_label">Featured</td>
		<td class="confirm_value"><?=$this->Layout->promote($location['Location']['promote'])?></td>
	</tr>
	<tr>
		<td class="confirm_label">Comments</td>
		<td class="confirm_value"><?=$location['Location']['comment_count']?></td>
	</tr>
	<tr>
		<td class="confirm_label">Created</td>
		<td class="confirm_value"><?=date("l m/d/Y", strtotime($location['Location']['created']))?></td>
	</tr>
	<tr>
		<td class="confirm_label">Modified</td>
		<td class="confirm_value"><?=date("l m/d/Y", strtotime($location['Location']['modified']))?></td>
	</tr>
	<tr>
		<td><h3>Stats</h3></td>
		<td></td>
	</tr>
	<tr>
		<td class="confirm_label">Parking Options</td>
		<td class="confirm_value"><?=count($location['LocationReservationOption'])?></td>
	</tr>
	<tr>
		<td class="confirm_label">Reservations</td>
		<td class="confirm_value"><?=count($location['LocationReservation'])?></td>
	</tr>
	<tr>
		<td class="confirm_label">Promotions</td>
		<td class="confirm_value"><?=count($location['LocationPromo'])?></td>
	</tr>
	<tr>
		<td class="confirm_label">Blackout Dates</td>
		<td class="confirm_value"><?=count($location['LocationDate'])?></td>
	</tr>
</table>

</div>