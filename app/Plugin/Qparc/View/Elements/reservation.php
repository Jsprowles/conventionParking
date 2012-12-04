<script>
$(document).ready(function() {

 	$( "#LocationReservationEntrance" ).datepicker();
 	$( "#LocationReservationExit" ).datepicker();
 	
});

function setOption(id)
{
	$( "#accordion" ).accordion( "option", "active", 1 );
}

function setPromo(id)
{
	$( "#accordion" ).accordion( "option", "active", 3 );
}
</script>

<div id="reserve">
	<h2>Reserve Parking</h2>
	<span style='font-size:13px;float:left;'><?=$location['Location']['name'];?></span>
	<br/><br/>
	<?php echo $this->Form->create('LocationReservation',array('plugin' => 'qparc', 'controller' => 'location_reservation', 'action' => 'add')); ?>
	
	<div id="accordion">
		<h3><a href="#" id="optionHeader">Parking Option</a></h3>
		<div>
			<fieldset>
				<table cellspacing="10" cellpadding="10" width="100%">
				<?php
					$options = $location['LocationReservationOption'];
					foreach ($options as $option)
					{
						echo "<tr><td>";
						echo "<br/>";
						echo "<input onclick='setOption(".$option['id'].")' type='radio' id='" . $option['id'] . "' name='data[LocationReservation][location_reservation_option_id]' value='" . $option['id'] . "' /><label for='option" . $option['id'] . "'>&nbsp;&nbsp;<strong>" . $option['name'] ."</strong></label>"; 
						echo "</td></tr>";
						
						echo "<tr><td>";
						echo "<span style='font-size:12px;'>" . $option['description'] . "</span>";
						echo "</td></tr>";
						
						echo "<tr><td>$" . $option['cost'] . "</td></tr>";
						echo "<tr><td><br/><hr/></td></tr>";
					}
					
				?>
				</table>
			</fieldset>
		</div>
		
		<h3><a href="#">Dates & Instructions</a></h3>
		<div>
			<strong>
				Entrance/Exit Dates
			</strong><br/><br/>
			<fieldset>
				<?php
				
					echo $this->Form->input('entrance',array('type'=>'text','label'=>false,'title'=>'Entrance Date'));
					echo $this->Form->input('exit',array('type'=>'text','label'=>false,'title'=>'Exit Date'));
				
				?>
			</fieldset>
			<br/>
			<strong>
				Special Instructions
			</strong><br/><br/>
			<fieldset>
				<?php echo $this->Form->input('instructions',array('label'=>false)); ?>
			</fieldset>
		</div>
		
		<?php if (Configure::read('Qparc.reservations_show_promos')): ?>
		<h3><a href="#">Promotions (<?=count($location['LocationPromo'])?> available)</a></h3>
		<div>
			<strong>
				Available for this Location
			</strong><br/>
			<fieldset>
				<table cellspacing="10" cellpadding="10" width="100%">
				<?php
					$promos = $location['LocationPromo'];
					foreach ($promos as $promo)
					{
						echo "<tr><td>";
						echo "<br/>";
						echo "<input onclick='setPromo(".$promo['id'].")' type='radio' id='" . $promo['id'] . "' name='data[LocationReservation][location_promo_id]' value='" . $promo['id'] . "' /><label for='option" . $promo['id'] . "'>&nbsp;&nbsp;<strong>" . $this->Html->link($promo['name'],array('plugin' => 'qparc', 'controller' => 'location_promos', 'action' => 'view', $promo['id']),array('class' => 'thickbox')) ."</strong></label>"; 
						
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
		<?php endif; ?>
		
		<?php if (Configure::read('Qparc.reservations_show_payment')): ?>
			<h3><a href="#">Payment</a></h3>
			<div>
				<fieldset>
					<?php
						$options = array(
							"visa" => 'Visa',
							"Mastercard" => 'Master Card',
							"amex" => 'AMEX'
						);
						
						echo $this->Form->input('cc_type',array('label'=>false,'options'=>$options));
						echo "<br/>";
						echo $this->Form->input('cc_name',array('label'=>false,'title'=>'Name on Credit Card'));
						echo $this->Form->input('cc_num',array('label'=>false,'title'=>'Credit Card Number'));
						echo $this->Form->input('cc_date',array('label'=>false,'title'=>'Expiration Date'));
						echo $this->Form->input('cc_address',array('label'=>false,'value'=>'Billing Address','type'=>'textarea'));
					?>
				</fieldset>
			</div>
		<?php endif; ?>
	</div>
	<br/><br/>
	<?php echo $this->Form->end('Reserve Now'); ?>
</div>
<!--
<?php echo debug($location); ?>
-->