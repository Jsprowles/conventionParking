<?php
	echo $this->Form->input('UserProfile.id',array('type'=>'hidden'));
	echo $this->Form->input('UserProfile.phone');
	echo $this->Form->input('UserProfile.vehicle');
	echo $this->Form->input('UserProfile.plate');
	echo $this->Form->input('UserProfile.cim',array('type'=>'text','label'=>'Customer Information Manager (CIM) ID'));
	echo $this->Form->input('UserProfile.paymentProfileId',array('type'=>'text'));
?>