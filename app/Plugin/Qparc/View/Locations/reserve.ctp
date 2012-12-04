
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
	var name = $("#label"+id).html();
	var cost = $("#cost"+id).html();
	
	$("#selected_parking_option").html(name + ", " + cost);
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
	echo $this->Form->create('LocationReservation',array('plugin' => 'qparc', 'controller' => 'location_reservations', 'action' => 'add')); 
	echo $this->Form->input('LocationReservation.location_id',array('type'=>'hidden','value'=>$location['Location']['id']));
	echo $this->Form->input('LocationReservation.user_id',array('type'=>'hidden','value'=>$this->Session->read('Auth.User.id')));
?>

<div id="reserve">
	<table style="float:right;margin-top:15px;">
		<tr><td style="text-align:right;"><?php echo $this->Form->submit('Reserve Now',array('id'=>'btnReserveNow','div'=>false)); ?></td></tr>
		<tr><td><div  style="text-align:right;margin-top:10px;opacity:0.8;"></div></td></tr>
	</table>
	
	
	
	<h2><?=$location['Location']['name'];?></h2>
	<span id="selected_parking_option" style='font-size:13px;float:left;'>Reserve Parking</span>
	<br/><br/>
	
	<div id="accordion" style="margin-top:25px;">
		<?php if(count($location['LocationReservationOption']) > 0): ?>
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
						echo "<input onclick='setOption(".$option['id'].")' type='radio' id='" . $option['id'] . "' name='data[LocationReservation][location_reservation_option_id]' value='" . $option['id'] . "' /><label id='label" . $option['id'] . "' for='option" . $option['id'] . "'>&nbsp;&nbsp;<strong>" . $option['name'] ."</strong></label>"; 
						echo "</td></tr>";
						
						echo "<tr><td>";
						echo "<span id='desc" . $option['id'] . "' style='font-size:12px;'>" . $option['description'] . "</span>";
						echo "</td></tr>";
						
						echo "<tr><td><span id='cost" . $option['id'] . "'>$" . $option['cost'] . "</span></td></tr>";
						echo "<tr><td><br/><hr/></td></tr>";
					}
					
				?>
				</table>
			</fieldset>
		</div>
		<?php endif; ?>
		<h3><a href="#">Dates & Instructions</a></h3>
		<div>
			<strong>
				Entrance/Exit Dates
			</strong><br/><br/>
			<fieldset>
				<?php
					echo $this->Form->input('entrance',array('type'=>'text','value'=>'Entrance Date','label'=>false,'style'=>'width:55%;'));
					echo $this->Form->input('exit',array('type'=>'text','value'=>'Exit Date','label'=>false,'style'=>'width:55%;'));
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
		
		<?php
			$name = "Qparc" . $location['Location']['id'];
			$res_promo_config = 0;
			if (Configure::read($name . ".reservations_use_global") == 0) {
				$res_promo_config = Configure::read($name . ".reservations_show_promos");
			} else {
				$res_promo_config = Configure::read('Qparc.reservations_show_promos');
			}
		?>
		
		<?php if ($res_promo_config && count($location['LocationPromo']) > 0): ?>
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
					
					echo "<tr><td>";
					echo "<input type='radio' id='0' name='data[LocationReservation][location_promo_id]' value='0' style='display:none;' checked='checked' />";
					echo "<br/><input type='button' onclick='clearPromos()' value='Clear Selected Promotions' />"; 
					echo "</td></tr>";
				?>
				</table>
			</fieldset>
		</div>
		<?php endif; ?>
		
		<?php
			$name = "Qparc" . $location['Location']['id'];
			$res_payment_config = 0;
			if (Configure::read($name . ".reservations_use_global") == 0) {
				$res_payment_config = Configure::read($name . ".reservations_show_payment");
			} else {
				$res_payment_config = Configure::read('Qparc.reservations_show_payment');
			}
		?>
		
		<?php if ($res_payment_config): ?>
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
						echo $this->Form->input('cc_name',array('label'=>false,'title'=>'Name on Credit Card','value'=>$this->Session->read('Auth.User.name')));
						echo $this->Form->input('cc_num',array('label'=>false,'title'=>'Credit Card Number','value'=>'XXXX-XXXX-XXXX-XXXX'));
						echo $this->Form->input('cc_date',array('label'=>false,'title'=>'Expiration Date','value'=>'01/14'));
						echo $this->Form->input('cc_address',array('label'=>false,'value'=>'Billing Address','type'=>'textarea'));
					?>
				</fieldset>
			</div>
		<?php endif; ?>
	</div>
	<br/><br/>
	<?php 
		
		//echo $this->Form->submit('Reserve Now',array('id'=>'btnReserveNow'));
		echo $this->Form->end(); 
		
	?>
</div>

