<?php
$yes_no = array(1=>'Yes', 0=>'No');
$public_private = array(0=>'Public', 1=>'Registered');
$email_frequency = array(1=>'Daily', 2=>'Weekly',3=>'Monthly');
?>

<script type="text/javascript">

var global_authnet = <?=$inputs['authnet_use_global']['value']?>;
var global_iparc = <?=$inputs['iparc_use_global']['value']?>;
var global_reservations = <?=$inputs['reservations_use_global']['value']?>;
var global_email = <?=$inputs['email_use_global']['value']?>;

$(document).ready(function() {
	
	$("#global_authnet").change(function() {
		
		if ($(this).attr('checked')) {
			$("#settings_authnet fieldset").css("opacity","0.3");
			$("#authnet_login").attr('disabled','disabled');
			$("#authnet_key").attr('disabled','disabled');
		} else {
			$("#settings_authnet fieldset").css("opacity","1");
			$("#authnet_login").removeProp('disabled');
			$("#authnet_key").removeProp('disabled');
		}
		
	});
	
	$("#global_iparc").change(function() {
		
		if ($(this).attr('checked')) {
			$("#settings_iparc fieldset").css("opacity","0.3");
			$("#iparc_enabled").attr('disabled','disabled');
			$("#iparc_validation").attr('disabled','disabled');
		} else {
			$("#settings_iparc fieldset").css("opacity","1");
			$("#iparc_enabled").removeProp('disabled');
			$("#iparc_validation").removeProp('disabled');
		}
		
	});
	
	$("#global_reservations").change(function() {
		
		if ($(this).attr('checked')) {
			$("#settings_reservations fieldset").css("opacity","0.3");
			$("#reservations_show_promos").attr('disabled','disabled');
			$("#reservations_show_payment").attr('disabled','disabled');
		} else {
			$("#settings_reservations fieldset").css("opacity","1");
			$("#reservations_show_promos").removeProp('disabled');
			$("#reservations_show_payment").removeProp('disabled');
		}
		
	});
	
	$("#global_email").change(function() {
		
		if ($(this).attr('checked')) {
			$("#settings_email fieldset").css("opacity","0.3");
			$("#email_enabled").attr('disabled','disabled');
			$("#email_frequency").attr('disabled','disabled');
			$("#email_addresses").attr('disabled','disabled');
		} else {
			$("#settings_email fieldset").css("opacity","1");
			$("#email_enabled").removeProp('disabled');
			$("#email_frequency").removeProp('disabled');
			$("#email_addresses").removeProp('disabled');
		}
		
	});
	
	
	// Initialize
	if (global_authnet == 1) {
		$("#global_authnet").attr('checked','checked');
		$("#settings_authnet fieldset").css("opacity","0.3");
		$("#authnet_login").attr('disabled','disabled');
		$("#authnet_key").attr('disabled','disabled');
	}
	if (global_iparc == 1) {
		$("#global_iparc").attr('checked','checked');
		$("#settings_iparc fieldset").css("opacity","0.3");
		$("#iparc_enabled").attr('disabled','disabled');
		$("#iparc_validation").attr('disabled','disabled');
	}
	if (global_reservations == 1) {
		$("#global_reservations").attr('checked','checked');
		$("#settings_reservations fieldset").css("opacity","0.3");
		$("#reservations_show_promos").attr('disabled','disabled');
		$("#reservations_show_payment").attr('disabled','disabled');
	}
	if (global_email == 1) {
		$("#global_email").attr('checked','checked');
		$("#settings_email fieldset").css("opacity","0.3");
		$("#email_enabled").attr('disabled','disabled');
		$("#email_frequency").attr('disabled','disabled');
		$("#email_addresses").attr('disabled','disabled');
	}
	
	
});
</script>
<?php 
	$location_id = $location['Location']['id']; 
	$name = 'Qparc'.$location_id;
	echo $this->Form->create('Settings', array('url' => array('plugin' => 'qparc', 'controller' => 'qparc', 'action' => 'manage', 'admin' => true)));
?>
<div id="accordion">
	<h3>
		<a href="#">Authorize.net</a>
	</h3>
	<div id="settings_authnet">
		<?php
		
		echo $this->Form->input('Settings.name',array('type'=>'hidden','value'=>$name));
		echo $this->Form->input('Settings.location_id',array('type'=>'hidden','value'=>$location_id));
		
		echo $this->Form->input($name.'.authnet_login.id', array('type' => 'hidden', 'default' => $inputs['authnet_login']['id'] ));
		echo $this->Form->input($name.'.authnet_transaction_key.id', array('type' => 'hidden', 'default' => $inputs['authnet_transaction_key']['id'] ));
		echo $this->Form->input($name.'.authnet_use_global.id', array('type' => 'hidden', 'default' => $inputs['authnet_use_global']['id'] ));
		
		echo $this->Form->input($name.'.authnet_use_global.value',array('type'=>'checkbox','label'=>'Use Global Settings','div'=>false,'style'=>'width:15px;margin-left:20px;','id'=>'global_authnet'));
		echo $this->Form->inputs(
				array(
					'legend'=>'Authorize.net Settings',
					$name . '.authnet_login.value'=>array('default' => $inputs['authnet_login']['value'], 'label' => 'Authorize.net Login','id'=>'authnet_login'),
					$name . '.authnet_transaction_key.value'=>array('default' => $inputs['authnet_transaction_key']['value'], 'label' => 'Authorize.net Transaction Key','id'=>'authnet_key'),
				)
			);
		?>
		<fieldset>
		<h3>How will Users Pay for their Reservations?</h3>
		qParc uses <a href="http://authorize.net" target="_blank">Authorize.net CIM</a> (Customer Information Manager) for managing users payment methods. This allows
		you to "avoid" PCI compliance issues with your website, as well as a great secure method for storing and managing credit card information.
		</fieldset>
		<!--
		<div>
			<?php echo $this->Html->image('authorize-net-seal.jpg'); ?>
		</div>
		-->
	</div>
	<h3><a href="#">iParc Integration</a></h3>
	<div id="settings_iparc">
		<?php
		echo $this->Form->input($name.'.iparc_enabled.id', array('type' => 'hidden', 'default' => $inputs['iparc_enabled']['id'] ));
		echo $this->Form->input($name.'.iparc_validation.id', array('type' => 'hidden', 'default' => $inputs['iparc_validation']['id']));
		echo $this->Form->input($name.'.iparc_use_global.id', array('type' => 'hidden', 'default' => $inputs['iparc_use_global']['id']));
		
		echo $this->Form->input($name.'.iparc_use_global.value',array('type'=>'checkbox','label'=>'Use Global Settings','div'=>false,'style'=>'width:15px;margin-left:20px;','id'=>'global_iparc'));
		echo $this->Form->inputs(
				array(
					'legend'=>'Amano iParc Settings',
					$name.'.iparc_enabled.value'=>array('default' => $inputs['iparc_enabled']['value'], 'label' => 'Enable iParc Integration <br/><span style="font-size:smaller;font-weight:normal;"> * Any promotions created with the previous setting will no longer work.</span>','options'=>$yes_no,'id' =>'iparc_enabled' ),
					$name.'.iparc_validation.value'=>array('default' => $inputs['iparc_validation']['value'], 'label' => 'Store Validation Number','id' =>'iparc_validation' ),
				)
			);
		?>
		<fieldset>
		<h3>Do you use iParc Professional?</h3>
		qParc integrates directly with <a href="http://www.amanomcgann.com" target="_blank">Amano McGann iParc Professional</a> software. When this option is enabled, iParc Professional
		software will be able to directly communicate with this server via sFTP.
		</fieldset>
	</div>
		
	<h3><a href="#">Reservations</a></h3>
	<div id="settings_reservations">
		<?php
		echo $this->Form->input($name.'.reservations_show_promos.id', array('type' => 'hidden', 'default' => $inputs['reservations_show_promos']['id'] ));
		echo $this->Form->input($name.'.reservations_show_payment.id', array('type' => 'hidden', 'default' => $inputs['reservations_show_payment']['id'] ));
		echo $this->Form->input($name.'.reservations_use_global.id', array('type' => 'hidden', 'default' => $inputs['reservations_use_global']['id'] ));
		
		echo $this->Form->input($name.'.reservations_use_global.value',array('type'=>'checkbox','label'=>'Use Global Settings','div'=>false,'style'=>'width:15px;margin-left:20px;','id'=>'global_reservations'));
		echo $this->Form->inputs(
				array(
					'legend'=>'Reservation Settings',
					$name.'.reservations_show_promos.value'=>array('default' => $inputs['reservations_show_promos']['value'], 'label' => 'Show Promotions','options'=>$yes_no,'id' =>'reservations_show_promos' ),
					$name.'.reservations_show_payment.value'=>array('default' => $inputs['reservations_show_payment']['value'], 'label' => 'Show Payment for Prepay','options'=>$yes_no,'id' =>'reservations_show_payment' )
				)
			);
		?>
		<fieldset>
		<h3>Which Users can Reserve a Parking Spot?</h3>
		Reservations can be "public", for non-registered users, or "registered", which will prompt the user to login or register before having the
		ability to create a reservation.
		</fieldset>
	</div>

	<h3><a href="#">Email Reporting</a></h3>
	<div id="settings_email">
		<?php
		echo $this->Form->input($name.'.email_enabled.id', array('type' => 'hidden', 'default' => $inputs['email_enabled']['id'] ));
		echo $this->Form->input($name.'.email_addresses.id', array('type' => 'hidden', 'default' => $inputs['email_addresses']['id'] ));
		echo $this->Form->input($name.'.email_frequency.id', array('type' => 'hidden', 'default' => $inputs['email_frequency']['id'] ));
		echo $this->Form->input($name.'.email_use_global.id', array('type' => 'hidden', 'default' => $inputs['email_use_global']['id'] ));
		
		echo $this->Form->input($name.'.email_use_global.value',array('type'=>'checkbox','label'=>'Use Global Settings','div'=>false,'style'=>'width:15px;margin-left:20px;','id'=>'global_email'));
		echo $this->Form->inputs(
				array(
					'legend'=>'Email Reservation Reports',
					$name.'.email_enabled.value'=>array('default' => $inputs['email_enabled']['value'], 'label' => 'Enable Email Reporting','options'=>$yes_no,'id'=>'email_enabled'),
					$name.'.email_frequency.value'=>array('default' => $inputs['email_frequency']['value'], 'label' => 'Email Frequency','options'=>$email_frequency,'id'=>'email_frequency'),
					$name.'.email_addresses.value'=>array('default' => $inputs['email_addresses']['value'], 'label' => 'Email Addresses (Seperate Multiple Addresses with Commas)','id'=>'email_addresses'),
				)
			);
		?>
		<fieldset>
		<h3>Would you like to recieve Email Reports?</h3>
		If you enable this option and provide email addresses, qParc will send out emails at the frequency you specify here, to the specified addresses.
		</fieldset>
	</div>
</div>
<br/>
<?php echo $this->Form->end(__('Save Settings',true)); ?>