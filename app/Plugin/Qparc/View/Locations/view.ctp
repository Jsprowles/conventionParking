<script>
$(document).ready(function() {
 	$( "#accordion" ).accordion({ autoHeight: false }); 
});
</script>

<style>
	
	#map
	{
		width:500px;
		height:400px;
		text-align: center;
		border:1px solid #CCC;
	}
	
</style>

<div id="location">
<br/>	
<h3><?=$title_for_layout?></h3>
<span style="font-size:11px;float:right;"><?=$location['Location']['address']?></span>
<br/>

	<div id="accordion">
		
		<h3><a href="#">Location</a></h3>
		<div>
			<fieldset>
				
				<?php
				$url = "http://maps.googleapis.com/maps/api/staticmap?center=" . $location['Location']['address'] . "&zoom=18&size=500x400&maptype=roadmap
				&markers=color:blue%7Clabel:X%7C".$location['Location']['lat'] . "," . $location['Location']['lon'] . "&sensor=false";
				?>
				
			<div id="map">
				<a href="http://maps.google.com/maps?q=<?=$location['Location']['address']?>" target="_blank">
					<img src="<?=$url?>" height="400" width="500" />
				</a>
			</div>
			</fieldset>
		</div>
		
		<h3><a href="#">Parking Options (<?=count($location['LocationReservationOption'])?>)</a></h3>
		<div>
			<fieldset>
				<table cellspacing="10" cellpadding="10" width="100%">
				<?php
					$options = $location['LocationReservationOption'];
					foreach ($options as $option)
					{
						echo "<tr><td>";
						echo "<br/>";
						echo "<strong>" . $this->Html->link( $option['name'],'/reserve/' . $option['location_id'] ) . "</strong>";
						echo "</td></tr>";
						
						echo "<tr><td>";
						echo "<span style='font-size:12px;'>" . $option['description'] . "</span>";
						echo "</td></tr>";
						
						echo "<tr><td>$" . $option['cost'] . "</td></tr>";
						echo "<tr><td><hr/></td></tr>";
					}
					
				?>
				</table>
			</fieldset>
		</div>
		
		<h3><a href="#">Promotions (<?=count($location['LocationPromo'])?>)</a></h3>
		<div style="width:500px;">
			<fieldset>
				<table cellspacing="10" cellpadding="10" width="100%">
				<?php
					$promos = $location['LocationPromo'];
					foreach ($promos as $promo)
					{
						echo "<tr><td>";
						echo "<br/>";
						echo "<strong>" . $this->Html->link($promo['name'],array('plugin' => 'qparc', 'controller' => 'location_promos', 'action' => 'view', $promo['id']),array('class' => 'thickbox')) . "</strong>";
						echo "</td></tr>";
						
						echo "<tr><td>";
						echo "<span style='font-size:12px;'>" . $promo['details'] . "</span>";
						echo "</td></tr>";
						
						echo "<tr><td>Expires: " . date("l m/d/Y", strtotime($promo['expiration'])) . "</td></tr>";
						echo "<tr><td><hr/></td></tr>";
					}
					
				?>
				</table>
			</fieldset>
		</div>
		
	</div>
	
</div>