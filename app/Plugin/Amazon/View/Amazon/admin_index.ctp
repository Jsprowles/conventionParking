<?php
$yes_no = array(1=>'Yes', 0=>'No');
echo $this->Form->create('Settings', array('url' => array('plugin' => 'amazon', 'controller' => 'amazon', 'action' => 'index', 'admin' => true)));
?>
<h2><?=$title_for_layout?></h2>
<div class="index">
	<div id="accordion">
		<h3><a href="#">API Credentials</a></h3>
		<div>
			<fieldset>
			<?php
			echo $this->Form->input('Amazon.key.id', array('type' => 'hidden', 'default' => $inputs['key']['id'] ));
			echo $this->Form->input('Amazon.secret.id', array('type' => 'hidden', 'default' => $inputs['secret']['id'] ));
			echo $this->Form->inputs(
					array(
						'legend'=>'',
						'Amazon.key.value'=>array('default' => $inputs['key']['value'], 'label' => 'API Key'),
						'Amazon.secret.value'=>array('default' => $inputs['secret']['value'], 'label' => 'Secret Key'),
					)
				);
			?>
			</fieldset>
		</div>
		<h3><a href="#">SNS</a></h3>
		<div>
			<?php
			echo $this->Form->input('Amazon.sns_port.id', array('type' => 'hidden', 'default' => $inputs['sns_port']['id'] ));
			echo $this->Form->input('Amazon.sns_host.id', array('type' => 'hidden', 'default' => $inputs['sns_host']['id'] ));
			echo $this->Form->input('Amazon.sns_username.id', array('type' => 'hidden', 'default' => $inputs['sns_username']['id'] ));
			echo $this->Form->input('Amazon.sns_password.id', array('type' => 'hidden', 'default' => $inputs['sns_password']['id'] ));
			
			echo $this->Form->inputs(
					array(
						'legend'=>'',
						'Amazon.sns_port.value'=>array('default' => $inputs['sns_port']['value'], 'label' => 'SNS Port'),
						'Amazon.sns_host.value'=>array('default' => $inputs['sns_host']['value'], 'label' => 'SNS Host Name'),
						'Amazon.sns_username.value'=>array('default' => $inputs['sns_username']['value'], 'label' => 'SNS Username'),
						'Amazon.sns_password.value'=>array('default' => $inputs['sns_password']['value'], 'label' => 'SNS Password'),
					)
				);
			?>
		</div>
	</div>
	<br/>
	<?php echo $this->Form->end(__('Save Settings',true)); ?>
</div>