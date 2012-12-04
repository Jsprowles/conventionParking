<?php

class UserProfile extends QparcAppModel
{
	public $name = "UserProfile";
	
	public $actAs = array('Qparc.PaymentProfile');
	
	public $belongsTo = "User";
}
