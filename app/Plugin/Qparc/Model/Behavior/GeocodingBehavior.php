<?php
App::uses('HttpSocket', 'Network/Http');
class GeocodingBehavior extends ModelBehavior {
    /**
     * Model-specific settings
     * @var array
     */
    public $settings = array(); 
    /**
     * Setup
     * @param  $model
     * @param  $settings
     */
    public function setup(&$Model, $settings) {
		//default settings
		if (!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = array(
				'address'=>'address',
				'lat_field'=>'lat',
				'lng_field'=>'lon',
			);
		}		
		$this->settings[$Model->alias] = array_merge(
			$this->settings[$Model->alias], (array)$settings
		);		
		//hold settings
		$this->address=$this->settings[$Model->alias]['address'];
		$this->lat=$this->settings[$Model->alias]['lat_field'];
		$this->lng=$this->settings[$Model->alias]['lng_field'];
		
		//Google API URL
		$this->google="http://maps.google.com/maps/api/geocode/json";
		$this->ending="&sensor=false";
		//http socket
		$this->connect= new HttpSocket(array('timeout' =>6000000));
		//error
		$this->error=null;
	}	
	/**
	 * call back when save
	 */
	public function beforeSave(&$Model){
		$response = $this->_lookUp($Model->data[$Model->alias][$this->address]);
		$jsonO=json_decode($response);

		//let s check the response by status code
		if($this->_isOk($jsonO->status)){
			$Model->data[$Model->alias][$this->lat]=$jsonO->results[0]->geometry->location->lat;
			$Model->data[$Model->alias][$this->lng]=$jsonO->results[0]->geometry->location->lng;
			return true;
		}else{
			$Model->data[$Model->alias]['geocoding_error']=$this->error;
			return false;
		}
	}
	private function _isOk($status){
		switch($status){
				case 'OK':
					return true;
					break;
				case 'ZERO_RESULTS':
					$this->error='non-existent address';
					return false;
					break;
				case 'OVER_QUERY_LIMIT':
					$this->error='over requests';
					return false;
					break;
				case 'REQUEST_DENIED':
					$this->error='request was denied';
					return false;
					break;
				case 'INVALID_REQUEST':
					$this->error='address was missing';
					return false;
					break;
				default:
					$this->error='unknown error';
					return false;
					break;
		}
	}
	/*
	 * api call
	 */
	private function _lookUp($address=null){
		$this->log('geocode');
		$address=$this->_format($address);
		$results = $this->connect->get($this->google, $address); 
		return $results;
	}
	/*
	 * format address
	 */
	private function _format($address){
		return "address=".str_replace(' ','+',$address).$this->ending;
	}	
}
?>