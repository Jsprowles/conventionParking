<style type="text/css">
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
		font-size:12px;
		padding-bottom:10px;
		padding-top:10px;
		border-bottom: 1px solid #CCC;
	}
</style>

<div id="confirmation">
	<br/>
	<h3>My Reservation</h3>
	<table>
		<tr>
			<td rowspan="8" style="padding-top:10px;"><div><?=$this->Qrcode->text($reservation['LocationReservation']['qrcode'],array('size'=>'130x130'))?></div></td>
		</tr>
		<tr>
			<td class="confirm_label"><span style="float:left;margin-top:15px;font-weight:bold;text-decoration:none;"><?php echo $this->Html->image('icons/pdf.gif',array('width'=>20)) . "&nbsp;" . $this->Html->link('Print PDF',"/reservation/confirmation/" . $reservation['LocationReservation']['id'] . ".pdf",array('target'=>'_blank')); ?></span></td>
			<td class="confirm_value"></td>
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
		<?php if($reservation['LocationReservation']['prepaid']): ?>
		<tr>
			<td class="confirm_label">Prepaid:</td>
			<td class="confirm_value"><?=$this->Layout->status($reservation['LocationReservation']['prepaid']);?></td>
		</tr>
		<?php endif; ?>
	</table>
	<?php if (isset($promo)): ?>
	<br/><br/><br/>
	<h3>Selected Promotion</h3>
	<br/>
	<table>
		<tr>
			<td rowspan="5"><div><?=$this->Qrcode->text($promo['LocationPromo']['code'],array('size'=>'120x120'))?></div></td>
		</tr>
		<tr>
			<td colspan="2" class="confirm_label"><strong><?=$this->Html->image('icons/pdf.gif',array('width'=>20)) . "&nbsp;" .$this->Html->link($promo['LocationPromo']['name'],array('plugin' => 'qparc', 'controller' => 'location_promos', 'action' => 'view', $promo['LocationPromo']['id'] . '.pdf'),array('target' => '_blank','style'=>'text-decoration:none;')); ?></strong></td>
			<td class="confirm_value"></td>
		</tr>
		<tr>
			<td class="confirm_label_promo">Details:</td>
			<td class="confirm_value"><?=$promo['LocationPromo']['details'];?></td>
		</tr>
		<tr>
			<td class="confirm_label_promo">Expiration:</td>
			<td class="confirm_value"><?=date("l m/d/Y, h:ia", strtotime($promo['LocationPromo']['expiration']));?></td>
		</tr>
	</table>
	<?php endif; ?>
	
	<!--
	<?php echo debug($reservation); ?>
	<?php echo debug($location); ?>
	<?php echo debug($option); ?>
	<?php echo debug($promo); ?>
	-->
</div>
