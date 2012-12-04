<?php
/**
 * Main qParc Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Qparc
 * @version  1.0
 * @author   Michael Labieniec <contact@codecreator.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.qparc.net
 */
class QparcController extends QparcAppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Qparc';

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array(
		'Setting',
		'Location',
		'LocationPromo',
		'LocationDate',
		'LocationReservation',
		'LocationReservationOption'
	);
	
	public $components = array('RequestHandler');
	
	public $defaults = array();
	
	public $locationDefaults = array();

    public function admin_index() {
    	
        $this->set('title_for_layout', __('qParc', true));
		
        if(!empty($this->data)) {
        	
            $settings =& ClassRegistry::init('Setting');
			
            foreach ($this->data['Qparc'] as $key=>$setting) {
                $settings->id = $setting['id'];
                $settings->saveField('value',$setting['value']);
            }            
            $this->Session->setFlash(__('Qparc Settings have been saved', true));
            $this->redirect("/admin/qparc#settings");
			
        } else {
        	
        	$this->loadModel('Setting');
			$settings = $this->Setting->find('all', array('conditions'=>array('Setting.key LIKE'=>'Qparc.%')));
			foreach($settings as $setting){
				$cleaned_key = explode('.', $setting['Setting']['key']);
				$this->defaults[$cleaned_key[1]]['id'] = $setting['Setting']['id'];
				$this->defaults[$cleaned_key[1]]['value'] = $setting['Setting']['value'];
			}
			
        }
		
		
		$locations = $this->Paginate('Location');
		$this->set('nodes',$locations);
        $this->set('inputs', $this->defaults);
    }
	
	public function admin_manage($location_id=null)
	{
		$this->set('title_for_layout','Manage Location');
		
		if ($location_id || $this->request->data) 
		{
			if (isset($this->request->data['Qparc']['location_id'])) {
					
				$location_id = $this->request->data['Qparc']['location_id'];
			
			} else if(isset($this->request->data['Settings']['name'])) {
				
				$name = $this->request->data['Settings']['name'];
				$settings =& ClassRegistry::init('Setting');
	            foreach ($this->data[$name] as $key=>$setting) {
	            	if (isset($setting['value']) && isset($setting['id'])) {
	                	$settings->id = $setting['id'];
	                	$settings->saveField('value',$setting['value']);
					}
	            }      
	            $this->Session->setFlash(__('Location '. $this->request->data['Settings']['location_id'] .' Settings have been saved', true));
	            $this->redirect("/admin/qparc/qparc/manage/".$this->data['Settings']['location_id']."#settings");
					
			}
			
			$promos 		= $this->paginate('LocationPromo',array('LocationPromo.location_id' => $location_id));
			$reservations 	= $this->paginate('LocationReservation',array('LocationReservation.location_id' => $location_id));
			$options 		= $this->paginate('LocationReservationOption',array('LocationReservationOption.location_id' => $location_id));
			$dates 			= $this->paginate('LocationDate',array('LocationDate.location_id' => $location_id));
			
			$location 		= $this->Location->read(null,$location_id);
			$all_locations 	= $this->Location->find('all',array('conditions'=>array('Location.status'=>1)));
			
			//Get the settings
			$this->loadModel('Setting');
			$condition = 'Qparc' . $location['Location']['id'] . '.%';
			$settings = $this->Setting->find('all', array('conditions'=>array('Setting.key LIKE'=>$condition)));
			foreach($settings as $setting) {
				$cleaned_key = explode('.', $setting['Setting']['key']);
				$this->locationDefaults[$cleaned_key[1]]['id'] = $setting['Setting']['id'];
				$this->locationDefaults[$cleaned_key[1]]['value'] = $setting['Setting']['value'];
			}
			
	        $this->set('inputs', $this->locationDefaults);
			$this->set('title_for_layout',$location['Location']['name']);
			$this->set('location',$location);
			$this->set('all_locations',$all_locations);
			$this->set('reservations',$reservations);
			$this->set('options',$options);
			$this->set('promos',$promos);
			$this->set('dates',$dates);
			
		} else {
			
			$this->Session->setFlash(__('Invalid Location', true));
            $this->redirect(array('action'=>'index'));
			
		}
	}

	public function index($location_id = null) {
		
		
		$promos = $this->Paginate('LocationPromo');
		$location = $this->Location->read(null,$location_id);
		
		$this->set('location',$location);
		$this->set('promos',$promos);
		
	}

}
