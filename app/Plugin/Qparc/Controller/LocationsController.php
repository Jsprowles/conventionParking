<?php
/**
 * Locations Controller
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
class LocationsController extends QparcAppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Locations';
	
	public $components = array('Session','RequestHandler');
	
	public $helpers = array('Qparc.Qrcode','Qparc.GoogleMapV3');

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	//public $uses = array('Location','Setting');

	public function admin_index() {
		$this->set('title_for_layout', __('Locations Manager'));
		$locations = $this->Paginate('Location');
		$this->set('locations',$locations);
	}

	public function index() {
		$this->set('title_for_layout', __('Locations'));
		
		$this->paginate = array(
	        'limit' => 5,
	        'order' => array('Location.promote' => 'desc')
	    );
		$locations = $this->Paginate('Location',array('status' => 1));
		$this->set('nodes',$locations);
	}
	
	public function view($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash('Invalid Location');
			$this->redirect(array('action'=>'index'));
		} else {
			$location = $this->Location->read(null,$id);
			$this->set('title_for_layout',$location['Location']['name']);
			$this->set('location',$location);
		}
	}
	
	public function reserve($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(__('Invalid Location'), 'default', array('class'=>'error'));
			$this->redirect('/locations');
		} else {
			// Check the request data
			if (empty($this->request->data))
			{
				$location = $this->Location->read(null,$id);
				
				$blackouts = $location['LocationDate'];
				$blackout_dates = array();
				
 				foreach ($blackouts AS $blackout)
				{
					if ($blackout['status']) {
						$from = date("Y-m-d",strtotime($blackout['from']));
						$to = date("Y-m-d",strtotime($blackout['to']));
						$dates = $this->createDateRangeArray($from, $to);
						
							foreach ($dates AS $date) {
								$date = date("n-j-Y",strtotime($date));
								array_push($blackout_dates,$date);
							}
					}
				}
				$this->set('blackouts',$blackout_dates);
				$this->set('location',$location);
				
			} else {
				
				if ( $this->LocationReservation->save($this->request->data) ) 
				{
					$this->Session->setFlash(__("Thank you, Your Reservation was Created!"), 'default', array('class' => 'success'));
					$this->redirect("/");
				} else {
					$this->Session->setFlash(__("Sorry, Your Reservation could not be created, please try again."), 'default', array('class' => 'error'));
					$this->redirect("/");
				}
			}
		}
	}

	public function delete_reservation($id=null)
	{
		$this->loadModel('LocationReservation');
		$reservation = $this->LocationReservation->read(null,$id);
		$user_id = $this->Auth->user('id');
		
		if (!$user_id)
		{
			$this->Session->setFlash(__("You must be logged in to do that."), 'default', array('class' => 'error'));
			$this->redirect("/");
		}

		if ($id && $this->Auth->user('id') == $reservation['LocationReservation']['user_id']) {
			
			if ( $this->LocationReservation->delete($reservation['LocationReservation']) ) {
				$this->Session->setFlash(__("Reservation Deleted."));
				$this->redirect("/reservations");
			} else {
				$this->Session->setFlash(__("The Reservation could not be deleted."), 'default', array('class' => 'success'));
				$this->redirect("/reservations");
			}
		}
	}

	public function admin_edit_reservation($id = null)
	{
		if (empty($this->request->data))
		{
			$this->loadModel('LocationReservation');
			$reservation = $this->LocationReservation->read(null,$id);
			$location = $this->Location->read(null,$reservation['LocationReservation']['location_id']);
			
			$blackouts = $location['LocationDate'];
			$blackout_dates = array();
				
 				foreach ($blackouts AS $blackout)
				{
					if ($blackout['status']) {
						$from = date("Y-m-d",strtotime($blackout['from']));
						$to = date("Y-m-d",strtotime($blackout['to']));
						$dates = $this->createDateRangeArray($from, $to);
						
							foreach ($dates AS $date) {
								$date = date("n-j-Y",strtotime($date));
								array_push($blackout_dates,$date);
							}
					}
				}

			$this->request->data = $reservation;
			$this->set('reservation',$reservation);
			$this->set('blackouts',$blackout_dates);
			$this->set('location',$location);
			
		} else {
			
			if ( $this->LocationReservation->save($this->request->data) ) 
			{
				$this->Session->setFlash(__("Thank you, Your Reservation was Created! You should recieve a confirmation email shortly."), 'default', array('class' => 'success'));
				$this->redirect("/");
			} else {
				$this->Session->setFlash(__("Sorry, Your Reservation could not be created, please try again."), 'default', array('class' => 'error'));
				$this->redirect("/");
			}
			
		}
	}

	public function edit_reservation($id = null)
	{
		if (empty($this->request->data))
		{
			$this->loadModel('LocationReservation');
			$reservation = $this->LocationReservation->read(null,$id);
			$location = $this->Location->read(null,$reservation['LocationReservation']['location_id']);
			
			$blackouts = $location['LocationDate'];
			$blackout_dates = array();
				
 				foreach ($blackouts AS $blackout)
				{
					if ($blackout['status']) {
						$from = date("Y-m-d",strtotime($blackout['from']));
						$to = date("Y-m-d",strtotime($blackout['to']));
						$dates = $this->createDateRangeArray($from, $to);
						
							foreach ($dates AS $date) {
								$date = date("n-j-Y",strtotime($date));
								array_push($blackout_dates,$date);
							}
					}
				}

			$this->request->data = $reservation;
			$this->set('reservation',$reservation);
			$this->set('blackouts',$blackout_dates);
			$this->set('location',$location);
			
		} else {
			
			if ( $this->LocationReservation->save($this->request->data) ) 
			{
				$this->Session->setFlash(__("Thank you, Your Reservation was Created! You should recieve a confirmation email shortly."), 'default', array('class' => 'success'));
				$this->redirect("/");
			} else {
				$this->Session->setFlash(__("Sorry, Your Reservation could not be created, please try again."), 'default', array('class' => 'error'));
				$this->redirect("/");
			}
			
		}
	}

	public function admin_view($id = null)
	{
		if ($this->request->data) {
			$id = $this->request->data['Location']['id'];
		}
		$location = $this->Location->read(null,$id);
		$all_locations = $this->Location->find('all',array('conditions'=>array('Location.status'=>1)));
		$this->set('all_locations',$all_locations);
		$this->set('location',$location);
	}
	
	public function admin_add()
	{
		$this->set('title_for_layout', __('New Location'));
		
		if (!empty($this->data))
		{
			if ( $this->Location->save($this->data) )
			{
				// Add the settings for this Location
				$name = 'Qparc' . $this->Location->getInsertID();
				// Global Checks
				$this->Setting->write($name . '.authnet_use_global','1',array('description' => 'Individual Location setting to use Authorize.net','editable' => 1));
				$this->Setting->write($name . '.iparc_use_global','1',array('description' => 'Individual Location setting to use iParc Integration','editable' => 1));
				$this->Setting->write($name . '.reservations_use_global','1',array('description' => 'Individual Location setting to use Reservations Settings','editable' => 1));
				$this->Setting->write($name . '.email_use_global','1',array('description' => 'Individual Location setting to use Email Settings','editable' => 1));
				// Authorize.net settings
				$this->Setting->write($name . '.authnet_transaction_key','',array('description' => 'Authorize.net Login for location ' . $this->Location->getInsertID(),'editable' => 1));
				$this->Setting->write($name . '.authnet_login','',array('description' => 'Authorize.net Transaction Key for location ' . $this->Location->getInsertID(),'editable' => 1));
				// reservation settings
				$this->Setting->write($name . '.reservations_show_promos','',array('description' => 'Show Promotions on reservation for location ' . $this->Location->getInsertID(),'editable' => 1));
				$this->Setting->write($name . '.reservations_show_payment','',array('description' => 'Show Payment option on reservation for location ' . $this->Location->getInsertID(),'editable' => 1));
				// iParc settings
				$this->Setting->write($name . '.iparc_enabled','0',array('description' => 'Enable iParc for location ' . $this->Location->getInsertID(),'editable' => 1));
				$this->Setting->write($name . '.iparc_validation','',array('description' => 'iParc Store Validation Number for location ' . $this->Location->getInsertID(),'editable' => 1));
				// Email settings
				$this->Setting->write($name . '.email_enabled','0',array('description' => 'Enable Email Reporting for location ' . $this->Location->getInsertID(),'editable' => 1));
				$this->Setting->write($name . '.email_frequency','',array('description' => 'Email Frequency for location ' . $this->Location->getInsertID(),'editable' => 1));
				$this->Setting->write($name . '.email_addresses','',array('description' => 'Email Addresses for location ' . $this->Location->getInsertID(),'editable' => 1));
				
				$this->Session->setFlash("Location Saved");
				$this->redirect(array('controller'=>'qparc','action'=>'admin_index'));
				
			} else {
				$this->Session->setFlash("Location Could not be Saved");
				$this->redirect(array('action'=>'admin_add'));
			}
		}
	}
	
	public function admin_edit($id = null)
	{
		$this->set('title_for_layout', __('Edit Location'));
		
		if (!empty($this->data))
		{
			$this->Location->Behaviors->load('Qparc.Geocoding');
			$this->Location->Behaviors->enable('Qparc.Geocoding');
			
			if ( $this->Location->save($this->data) )
			{
				$this->Session->setFlash("Location Saved");
				$this->redirect(array('controller'=>'qparc','action'=>'admin_index'));
			} else {
				$this->Session->setFlash("Location Could not be Saved");
				$this->redirect(array('controller'=>'qparc','action'=>'admin_index'));
			}
		} else {
			
			$data = $this->Location->read(null,$id);
			$this->request->data = $data;
			
		}
	}
	
	public function admin_process() {
		
		$action = $this->request->data['Location']['action'];
		$ids = array();
		
		foreach ($this->request->data['Location'] as $id => $value) {
			if ($id != 'action' && $value['id'] == 1) {
				$ids[] = $id;
			}
		}

		if (count($ids) == 0 || $action == null) {
			$this->Session->setFlash(__('No items selected.'), 'default', array('class' => 'error'));
			$this->redirect(array('controller'=>'qparc','action' => 'admin_index'));
		}
		
		if ($action == 'delete' &&
			$this->Location->deleteAll(array('Location.id' => $ids), true, true)) {
			//Remove all the settings for this location
			foreach ($ids AS $id) {
				$condition = 'Qparc' . $id . ".%";
				$settings = $this->Setting->find('all', array('conditions'=>array('Setting.key LIKE'=>$condition)));
				foreach($settings as $setting){
					$this->Setting->deleteKey($setting['Setting']['key']);
				}
			}
			$this->Session->setFlash(__('Locations deleted.'), 'default', array('class' => 'success'));
		} elseif ($action == 'publish' &&
			$this->Location->updateAll(array('Location.status' => 1), array('Location.id' => $ids))) {
			$this->Session->setFlash(__('Locations published'), 'default', array('class' => 'success'));
		} elseif ($action == 'unpublish' &&
			$this->Location->updateAll(array('Location.status' => 0), array('Location.id' => $ids))) {
			$this->Session->setFlash(__('Locations unpublished'), 'default', array('class' => 'success'));
		} elseif ($action == 'promote' &&
			$this->Location->updateAll(array('Location.promote' => 1), array('Location.id' => $ids))) {
			$this->Session->setFlash(__('Locations promoted'), 'default', array('class' => 'success'));
		} elseif ($action == 'unpromote' &&
			$this->Location->updateAll(array('Location.promote' => 0), array('Location.id' => $ids))) {
			$this->Session->setFlash(__('Locations unpromoted'), 'default', array('class' => 'success'));
		} elseif ($action == 'copyto') {
			
		} else {
			$this->Session->setFlash(__('An error occurred.'), 'default', array('class' => 'error'));
		}

		$this->redirect(array('controller'=>'qparc','action' => 'admin_index'));
	}

}
