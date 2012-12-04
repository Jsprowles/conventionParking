<?php

class LocationReservation extends QparcAppModel {

	public $name = 'LocationReservation';
	
	public $belongsTo = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id'
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);
	
	public $hasOne = array(
		'LocationReservationOption' => array(
			'className' => 'LocationReservationOption',
			'foreignKey' => 'location_reservation_option_id'
		),
		'LocationPromo' => array(
			'className' => 'LocationPromo',
			'foreignKey' => 'location_promo_id'
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id'
		)
	);
		
	public $validate = array(
		'entrance' => array(
			'rule' => 'date',
			'message' => 'Enter a valid Entrance Date.',
		),
		'exit' => array(
			'rule' => 'date',
			'message' => 'Enter a valid Exit Date.',
		)
	);

}
