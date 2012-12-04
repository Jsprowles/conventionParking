<?php
/**
 * Reservations Controller
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
class LocationReservationsController extends QparcAppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'LocationReservations';
	
	public $components = array('Session','RequestHandler');
	
	/**
	 * Models used by the Controller
	 *
	 * @var array
	 * @access public
	 */
	public $uses = array(
		'LocationReservation', 
		'LocationPromo',
		'LocationDate',
		'LocationReservationOption',
		'Location',
		'Setting'
	);
	
	public $helpers = array('Js','Qparc.Qrcode');
	
	public function admin_index($location_id = null) {
		
		if (!$location_id)
		{
			$this->Session->setFlash('Invalid Location');
			$this->redirect(array('controller'=>'LocationReservations','action'=>'admin_index'));
		} else {
			$this->set('title_for_layout', __('Reservation Manager'));
			
			$this->paginate = array(
		        'conditions' => array('LocationReservation.location_id' => $location_id)
		    );
			
			$reservations = $this->Paginate('LocationReservation');
			$location = $this->Location->read(null,$location_id);
			$this->set('location',$location);
			$this->set('reservations',$reservations);
		}
		
	}
	
	public function admin_process() 
	{
		$location_id = $this->request->data['LocationReservation']['location_id'];
		$action = $this->request->data['LocationReservation']['action'];
		$ids = array();
		
		foreach ($this->request->data['LocationReservation'] as $id => $value) {
			if ($id != 'action' && $value['id'] == 1) {
				$ids[] = $id;
			}
		}

		if (count($ids) == 0 || $action == null) {
			$this->Session->setFlash(__('No items selected.'), 'default', array('class' => 'error'));
			$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#reservations");
		}
		
		if ($action == 'delete' &&
			$this->LocationReservation->deleteAll(array('LocationReservation.id' => $ids), true, true)) {
			$this->Session->setFlash(__('Reservations deleted.'), 'default', array('class' => 'success'));
		} elseif ($action == 'publish' &&
			$this->LocationReservation->updateAll(array('LocationReservation.status' => 1), array('LocationReservation.id' => $ids))) {
			$this->Session->setFlash(__('Reservations published'), 'default', array('class' => 'success'));
		} elseif ($action == 'unpublish' &&
			$this->LocationReservation->updateAll(array('LocationReservation.status' => 0), array('LocationReservation.id' => $ids))) {
			$this->Session->setFlash(__('Reservations unpublished'), 'default', array('class' => 'success'));
		} elseif ($action == 'promote' &&
			$this->LocationReservation->updateAll(array('LocationReservation.promote' => 1), array('LocationReservation.id' => $ids))) {
			$this->Session->setFlash(__('Reservations promoted'), 'default', array('class' => 'success'));
		} elseif ($action == 'unpromote' &&
			$this->LocationReservation->updateAll(array('LocationReservation.promote' => 0), array('LocationReservation.id' => $ids))) {
			$this->Session->setFlash(__('Reservations unpromoted'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__('An error occurred.'), 'default', array('class' => 'error'));
		}
		
		$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#reservations");
	}

	public function index() {
			
		$this->set('title_for_layout', __('Reserations'));
		
		$user_id = $this->Auth->user('id');
		$locations = $this->Location->find('all',array('conditions'=>array('Location.status'=>1)));
		
		if ($this->request->data) {
				
			$location_id = $this->request->data['LocationReservation']['location_id'];
			
			$reservations = $this->Paginate('LocationReservation',array(
				'LocationReservation.user_id' => $user_id,
				'LocationReservation.location_id'=>$location_id
				));
			$options = $this->Paginate('LocationReservationOption',array(
				'LocationReservationOption.location_id' => $location_id
				));
			
			$this->set('current_location',$location_id);
				
		} else {
			$reservations = $this->Paginate('LocationReservation',array('LocationReservation.user_id' => $user_id));
			$options = $this->Paginate('LocationReservationOption');
			$this->set('current_location',$locations[0]['Location']['id']);
		}
		
		$this->set('location_options',$options);
		$this->set('locations',$locations);
		$this->set('nodes',$reservations);
		
	}

	public function admin_edit($id = null)
	{
		// Check the request data
		if (!empty($this->request->data)) 
		{
			if ( $this->LocationReservation->save($this->request->data) ) 
			{
				//$this->sendUserReservationEmail($this->request->data);
				$this->Session->setFlash(__("Reservation Updated"));
				$this->redirect("/admin/qparc/qparc/manage/" . $this->request->data['LocationReservation']['location_id'] . "#reservations");
				//$this->redirect("/reservation/confirmation/" . $this->LocationReservation->getLastInsertID());
			} else {
				$this->Session->setFlash(__("Sorry, Your Reservation could not be created, please try again."), 'default', array('class' => 'error'));
				$this->redirect("/admin/qparc/qparc/manage/" . $this->request->data['LocationReservation']['location_id'] . "#reservations");
			}
		} else {
			$this->request->data = $this->LocationReservation->read(null,$id);
			$location = $this->Location->read(null,$this->request->data['LocationReservation']['location_id']);
			$blackouts = $this->LocationDate->find('all',array('conditions'=>array('status'=>1)));
			$blackout_dates = array();

			foreach ($blackouts AS $blackout)
			{
				if ($blackout['LocationDate']['status']) {
					$from = date("Y-m-d",strtotime($blackout['LocationDate']['from']));
					$to = date("Y-m-d",strtotime($blackout['LocationDate']['to']));
					$dates = $this->createDateRangeArray($from, $to);
					
						foreach ($dates AS $date) {
							array_push($blackout_dates,$date);
						}
				}
			}
			$this->set('blackouts',$blackout_dates);
			$this->set('location',$location);
		}
	}
	
	public function edit($id = null)
	{
		// Check the request data
		if (!empty($this->request->data)) 
		{	
			if ( $this->LocationReservation->save($this->request->data) ) 
			{
				//$this->sendUserReservationEmail($this->request->data);
				$this->Session->setFlash(__("Reservation Updated"));
				$this->redirect("/admin/qparc/qparc/manage/" . $this->request->data['LocationReservation']['location_id'] . "#reservations");
				//$this->redirect("/reservation/confirmation/" . $this->LocationReservation->getLastInsertID());
			} else {
				$this->Session->setFlash(__("Sorry, Your Reservation could not be created, please try again."), 'default', array('class' => 'error'));
				$this->redirect("/admin/qparc/qparc/manage/" . $this->request->data['LocationReservation']['location_id'] . "#reservations");
			}
		} else {
			$this->request->data = $this->LocationReservation->read(null,$id);
		}
	}
		
	public function add()
	{
		// Check the request data
		if (!empty($this->request->data)) 
		{
				
			$this->request->data['LocationReservation']['qrcode'] = $this->str_rand(15);
			
			//@TODO Check if iParc is enabled and create CSV file
			
			if ( $this->LocationReservation->save($this->request->data) ) 
			{
				//$this->sendUserReservationEmail($this->request->data);
				$this->Session->setFlash(__("Thank you, Your Reservation was Created! You should recieve a confirmation email shortly."));
				$this->redirect("/reservation/confirmation/" . $this->LocationReservation->getLastInsertID());
			} else {
				$this->Session->setFlash(__("Sorry, Your Reservation could not be created, please try again."), 'default', array('class' => 'error'));
				$this->redirect("/reserve/" . $this->request->data['LocationReservation'] . "/" . $this->request->data['LocationReservation']['location_id']);
			}
			
		}
	}

	public function confirmation($id = null)
	{
		if($id) {
			
			$reservation = $this->LocationReservation->read(null,$id);
			$location = $this->Location->read(null,$reservation['LocationReservation']['location_id']);
			$option = $this->LocationReservationOption->read(null,$reservation['LocationReservation']['location_reservation_option_id']);
			if (isset($reservation['LocationReservation']['location_promo_id']) && $reservation['LocationReservation']['location_promo_id'] > 0)
			{
				$promo = $this->LocationPromo->read(null,$reservation['LocationReservation']['location_promo_id']);
				$this->set('promo',$promo);
			}
			$this->set('option',$option);
			$this->set('location',$location);
			$this->set('reservation',$reservation);
			
		}
	}
	
	public function admin_export()
	{
		ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
		
		//create a file
		$filename = "qparc_export_reservations_".date("Y.m.d").".csv";
		$csv_file = fopen('php://output', 'w');
	
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
	
	    $results = $this->LocationReservation->find('all', array());
	
		// The column headings of your .csv file
		$header_row = array("ID", "Location ID","User ID", "Location Option", "Promotion", "Entrance", "Exit", "Created","Modified");
		fputcsv($csv_file,$header_row,',','"');
	
		// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
		foreach($results as $result)
		{
			// Array indexes correspond to the field names in your db table(s)
			$row = array(
				$result['LocationReservation']['id'],
				$result['LocationReservation']['location_id'],
				$result['LocationReservation']['user_id'],
				$result['LocationReservation']['location_reservation_option_id'],
				$result['LocationReservation']['location_promo_id'],
				$result['LocationReservation']['entrance'],
				$result['LocationReservation']['exit'],
				$result['LocationReservation']['created'],
				$result['LocationReservation']['modified']
			);
	
			fputcsv($csv_file,$row,',','"');
		}
		$this->layout = "ajax";
		$this->set('results',$results);
		fclose($csv_file);
	}

}
