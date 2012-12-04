<?php

class LocationDate extends QparcAppModel
{
	public $name = "LocationDate";
	
	public $belongsTo = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id'
		)
	);
}
