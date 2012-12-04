<?php
class Location extends QparcAppModel{
	
	public $name = 'Location';
	
	public $actAs = array('Geocoding');
	
	public $hasMany = array(
		'LocationReservation' => array(
			'className' => 'LocationReservation',
			'foreignKey' => 'location_id'	
		),
		'LocationPromo' => array(
			'className' => 'LocationPromo',
			'foreignKey' => 'location_id'	
		),
		'LocationReservationOption' => array(
			'className' => 'LocationReservationOption',
			'foreignKey' => 'location_id'	
		),
		'LocationDate' => array(
			'className' => 'LocationDate',
			'foreignKey' => 'location_id'	
		)
	);
	
	public $validate = array(
		'name' => array(
			'rule' => array('minLength', 1),
			'message' => 'Name cannot be empty.',
		),
		'address' => array(
			'rule' => array('minLength', 1),
			'message' => 'Address cannot be empty.',
		)
	);
	
}
?>
