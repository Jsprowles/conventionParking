<?php echo $this->Html->script('date.format'); ?>

<script>

var disabled_days = <?=json_encode($location['LocationDate'])?>;
var blackout_dates = <?=json_encode($blackouts);?>;
var disabledDays = [];

$(document).ready(function() {

 	//$( "#LocationReservationEntrance" ).datepicker({ minDate: 0, maxDate: "+6M +10D" });
 	//$( "#LocationReservationExit" ).datepicker({ minDate: 0, maxDate: "+6M +10D" });
	//var disabledDays = [];
	var count = 0;
	
 	$.each(blackout_dates, function(index, value) { 
	  var date = new Date(value);
	  var tomorrow = new Date(date.getTime() + (24 * 60 * 60 * 1000));
	  var d = tomorrow.format("m-dd-yyyy");
	  disabledDays[count] = d;
	  count++;
	});

	console.log(blackout_dates);
	disabledDays = blackout_dates;
 	// Hints are buggy with date picker...
 	$(".ezpz-hint").hide();
 	$( "#LocationReservationEntrance" ).show();
 	$( "#LocationReservationExit" ).show();
 	
	$( "#LocationReservationEntrance" ).datetimepicker({
		ampm: false,
		changeMonth: true,
		numberOfMonths: 2,
		minDate: 0,
		dateFormat: 'yy-mm-dd',
		constrainInput: true,
    	beforeShowDay: noWeekendsOrHolidays,
		onSelect: function( selectedDate ) {
			$(".ezpz-hint").hide();
			$( "#LocationReservationExit" ).datepicker( "option", "minDate", selectedDate );
			if (!$( "#LocationReservationExit" ).val())
				$( "#LocationReservationExit" ).val("Exit Date");
		}
	});
	$( "#LocationReservationExit" ).datetimepicker({
		ampm: false,
		changeMonth: true,
		numberOfMonths: 2,
		minDate: 0,
		dateFormat: 'yy-mm-dd',
		constrainInput: true,
    	beforeShowDay: noWeekendsOrHolidays,
		onSelect: function( selectedDate ) {
			$(".ezpz-hint").hide();
			$( "#LocationReservationExit" ).show();
		}
	});
});

/* utility functions */
function nationalDays(date) {
  var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
  console.log('Checking (raw): ' + m + '-' + d + '-' + y);
  for (i = 0; i < disabledDays.length; i++) {
    if($.inArray( (m+1) + '-' + d + '-' + y,disabledDays ) != -1 || new Date() > date) {
      console.log('bad:  ' + (m+1) + '-' + d + '-' + y + ' / ' + disabledDays[i]);
      return [false];
    }
    
  }
  //console.log('good:  ' + (m+1) + '-' + d + '-' + y);
  return [true];
}

function trimNumber(s) {
  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
  return s;
}

function noWeekendsOrHolidays(date) {
  //var noWeekend = jQuery.datepicker.noWeekends(date);
  //return noWeekend[0] ? nationalDays(date) : noWeekend;
  return nationalDays(date)
}

function setOption(id)
{
	$( "#accordion" ).accordion( "option", "active", 1 );
}

function setPromo(id)
{
	$( "#accordion" ).accordion( "option", "active", 3 );
}

function clearPromos()
{
	$("#0").prop('checked',true);
}
</script>

<?php 
	echo $this->Form->create('LocationReservation',array('plugin' => 'qparc', 'controller' => 'locations', 'action' => 'edit','admin'=>true)); 
	echo $this->Form->input('LocationReservation.location_id',array('type'=>'hidden','value'=>$location['Location']['id']));
	echo $this->Form->input('LocationReservation.user_id',array('type'=>'hidden','value'=>$reservation['LocationReservation']['user_id']));
	echo $this->Form->input('LocationReservation.id',array('type'=>'hidden'));
?>

<div id="reserve">
	<span style="float:right;">
	<?php echo $this->Html->link('Back to Reservations','/reservations'); ?>
	</span>
	<h2>Edit Reservation</h2>
	<br/>
	<div id="accordion">
		<?php if(count($location['LocationReservationOption']) > 0): ?>
		<h3><a href="#">Parking Option</a></h3>
		<div>
			<fieldset>
				<table cellspacing="10" cellpadding="10" width="100%">
				<?php
					$options = $location['LocationReservationOption'];
					$reservation_options = array();
					foreach ($options as $option)
					{
						$reservation_options[$option['id']] = $option['name'];
					}
					$attributes = array('legend'=>false,'separator'=>'<br/><br/>');
					echo "<tr><td>" . $this->Form->radio('location_reservation_option_id',$reservation_options,$attributes) . "</td></tr>";
				?>
				</table>
			</fieldset>
		</div>
		<?php endif; ?>
		<h3><a href="#">Entrance & Exit Dates</a></h3>
		<div>
			<fieldset>
				<table cellspacing="10" cellpadding="10" width="100%">
					<tr><td>
				<?php
					echo $this->Form->input('entrance',array('type'=>'text','label'=>false,'style'=>'width:55%;'));
					echo $this->Form->input('exit',array('type'=>'text','label'=>false,'style'=>'width:55%;'));
				?>
				</td>
				</tr>
				</table>
			</fieldset>
			<br/>
			<h3><a href="#">Special Instructions</a></h3>
			<fieldset>
				<table cellspacing="10" cellpadding="10" width="100%">
					<tr><td>
					<?php echo $this->Form->input('LocationReservation.instructions',array('label'=>false)); ?>
					</td></tr>
					</table>
			</fieldset>
		</div>
		
		<?php if (Configure::read('Qparc.reservations_show_promos') && count($location['LocationPromo']) > 0): ?>
		<h3><a href="#">Promotions (<?=count($location['LocationPromo'])?> available)</a></h3>
		<div>
			<fieldset>
				<table cellspacing="10" cellpadding="10" width="100%">
				<?php
					$options = $location['LocationPromo'];
					$promo_options = array();
					foreach ($options as $option)
					{
						$promo_options[$option['id']] = $option['name'];
					}
					$attributes = array('legend'=>false,'separator'=>'<br/><br/>');
					echo "<tr><td>" . $this->Form->radio('location_promo_id',$promo_options,$attributes) . "</td></tr>";
					echo "<tr><td>";
					echo "<input type='radio' id='0' name='data[LocationReservation][location_promo_id]' value='0' style='display:none;'/>";
					echo "<input type='button' onclick='clearPromos()' value='Clear Selected Promotions' />"; 
					echo "</td></tr>";
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
						
						echo $this->Form->input('prepaid',array('type'=>'hidden','value'=>1));
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
	<br/>
	<?php 
		
		echo $this->Form->submit('Save Reservation',array('style'=>'font-size:24px;font-weight:bold;width:100%;'));
		echo $this->Form->end(); 
		
	?>
</div>