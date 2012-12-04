<?php
$yes_no = array(1=>'Yes', 0=>'No');
$public_private = array(0=>'Public', 1=>'Registered');
$email_frequency = array(1=>'Daily', 2=>'Weekly',3=>'Monthly');
echo $this->Form->create('Settings', array('url' => array('plugin' => 'qparc', 'controller' => 'qparc', 'action' => 'index', 'admin' => true)));
?>
These settings may be overridden in individual location settings.
	<br/><br/>
<div id="accordion">
	
	<h3>
		<a href="#">Authorize.net</a>
	</h3>
	<div id="settings_authnet">
		<?php
		echo $this->Form->input('Qparc.authnet_test.id', array('type' => 'hidden', 'default' => $inputs['authnet_test']['id'] ));
		echo $this->Form->input('Qparc.authnet_login.id', array('type' => 'hidden', 'default' => $inputs['authnet_login']['id'] ));
		echo $this->Form->input('Qparc.authnet_transaction_key.id', array('type' => 'hidden', 'default' => $inputs['authnet_transaction_key']['id'] ));
		echo $this->Form->inputs(
				array(
					'legend'=>'Authorize.net Settings',
					'Qparc.authnet_test.value'=>array('default' => $inputs['authnet_test']['value'], 'label' => 'Authorize.net Test Environement','options'=>$yes_no),
					'Qparc.authnet_login.value'=>array('default' => $inputs['authnet_login']['value'], 'label' => 'Authorize.net Login'),
					'Qparc.authnet_transaction_key.value'=>array('default' => $inputs['authnet_transaction_key']['value'], 'label' => 'Authorize.net Transaction Key'),
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
		echo $this->Form->input('Qparc.iparc_enabled.id', array('type' => 'hidden', 'default' => $inputs['iparc_enabled']['id'] ));
		//echo $this->Form->input('Qparc.iparc_site_id.id', array('type' => 'hidden', 'default' => $inputs['iparc_site_id']['id'] ));
		//echo $this->Form->input('Qparc.iparc_identifier.id', array('type' => 'hidden', 'default' => $inputs['iparc_identifier']['id'] ));
		echo $this->Form->input('Qparc.iparc_validation.id', array('type' => 'hidden', 'default' => $inputs['iparc_validation']['id'] ));
		echo $this->Form->inputs(
				array(
					'legend'=>'Amano iParc Settings',
					'Qparc.iparc_enabled.value'=>array('default' => $inputs['iparc_enabled']['value'], 'label' => 'Enable iParc Integration <br/><span style="font-size:smaller;font-weight:normal;"> * Any promotions created with the previous setting will no longer work.</span>','options'=>$yes_no),
					//'Qparc.iparc_site_id.value'=>array('default' => $inputs['iparc_site_id']['value'], 'label' => 'Site ID'),
					//'Qparc.iparc_identifier.value'=>array('default' => $inputs['iparc_identifier']['value'], 'label' => 'Identifier'),
					'Qparc.iparc_validation.value'=>array('default' => $inputs['iparc_validation']['value'], 'label' => 'Store Validation Number'),
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
		echo $this->Form->input('Qparc.reservations_show_promos.id', array('type' => 'hidden', 'default' => $inputs['reservations_show_promos']['id'] ));
		echo $this->Form->input('Qparc.reservations_show_payment.id', array('type' => 'hidden', 'default' => $inputs['reservations_show_payment']['id'] ));
		echo $this->Form->inputs(
				array(
					'legend'=>'Reservation Settings',
					'Qparc.reservations_show_promos.value'=>array('default' => $inputs['reservations_show_promos']['value'], 'label' => 'Show Promotions','options'=>$yes_no),
					'Qparc.reservations_show_payment.value'=>array('default' => $inputs['reservations_show_payment']['value'], 'label' => 'Show Payment for Prepay','options'=>$yes_no)
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
		echo $this->Form->input('Qparc.email_enabled.id', array('type' => 'hidden', 'default' => $inputs['email_enabled']['id'] ));
		echo $this->Form->input('Qparc.email_addresses.id', array('type' => 'hidden', 'default' => $inputs['email_addresses']['id'] ));
		echo $this->Form->input('Qparc.email_frequency.id', array('type' => 'hidden', 'default' => $inputs['email_frequency']['id'] ));
		echo $this->Form->inputs(
				array(
					'legend'=>'Email Reservation Reports',
					'Qparc.email_enabled.value'=>array('default' => $inputs['email_enabled']['value'], 'label' => 'Enable Email Reporting','options'=>$yes_no),
					'Qparc.email_frequency.value'=>array('default' => $inputs['email_frequency']['value'], 'label' => 'Email Frequency','options'=>$email_frequency),
					'Qparc.email_addresses.value'=>array('default' => $inputs['email_addresses']['value'], 'label' => 'Email Addresses (Seperate Multiple Addresses with Commas)'),
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