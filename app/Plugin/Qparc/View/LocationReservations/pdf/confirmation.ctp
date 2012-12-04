<style type="text/css">
	.confirm_label
	{
		width:200px;
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
</style>

<div id="confirmation">
	<h2>My Reservation</h2>
	<strong>Reservation Details</strong>
	<table>
		<tr>
			<td rowspan="5"><div style="border:1px solid #CCC;margin-right:15px;"><?=$this->Qrcode->text($reservation['LocationReservation']['qrcode'],array('size'=>'120x120'))?></div></td>
		</tr>
		<tr>
			<td class="confirm_label">Location:</td>
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
			<td class="confirm_label">Parking Option:</td>
			<td class="confirm_value"><?=$option['LocationReservationOption']['name'] . ", $" . $option['LocationReservationOption']['cost'];?></td>
		</tr>
		<tr>
			<td class="confirm_label">Entrance Date:</td>
			<td class="confirm_value"><?=date("l m/d/Y, h:ia", strtotime($reservation['LocationReservation']['entrance']));?></td>
		</tr>
		<tr>
			<td class="confirm_label">Exit Date:</td>
			<td class="confirm_value"><?=date("l m/d/Y, h:ia", strtotime($reservation['LocationReservation']['entrance']));?></td>
		</tr>
		
	</table>
	<?php if (isset($promo)): ?>
		<br/><br/>
	<h2>Selected Promotion</h2>
	
	<strong><?=$this->Html->link($promo['LocationPromo']['name'],array('plugin' => 'qparc', 'controller' => 'location_promos', 'action' => 'view', $promo['LocationPromo']['id']),array('class' => 'thickbox','style'=>'text-decoration:underline;')); ?></strong>
	<table>
		<tr>
			<td rowspan="5"><div style="border:1px solid #CCC;margin-right:15px;"><?=$this->Qrcode->text($promo['LocationPromo']['code'],array('size'=>'120x120'))?></div></td>
		</tr>
		<tr>
			<td class="confirm_label">Details:</td>
			<td class="confirm_value"><?=$promo['LocationPromo']['details'];?></td>
		</tr>
		<tr>
			<td class="confirm_label">Expiration:</td>
			<td class="confirm_value"><?=date("l m/d/Y, h:ia", strtotime($promo['LocationPromo']['expiration']));?></td>
		</tr>
		<tr>
			<td class="confirm_label">Exit Date:</td>
			<td class="confirm_value"><?=date("l m/d/Y, h:ia", strtotime($reservation['LocationReservation']['entrance']));?></td>
		</tr>
	</table>
	<?php endif; ?>
</div>
