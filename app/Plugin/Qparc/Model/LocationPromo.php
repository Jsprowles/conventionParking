<?php

class LocationPromo extends QparcAppModel {

	public $name = 'LocationPromo';
	
	public $belongsTo = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id'
		)
	);

}
