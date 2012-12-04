<?php
/**
 * Location Promos Controller
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
class LocationPromosController extends QparcAppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'LocationPromos';

	/**
	 * Models used by the Controller
	 *
	 * @var array
	 * @access public
	 */
	public $uses = array('LocationPromo', 'Location');
	
	public $helpers = array('Qparc.Qrcode');

	public function admin_index($location_id = null) 
	{
		if (!$location_id)
		{
			$this->Session->setFlash('Invalid Location');
			$this->redirect(array('controller'=>'qparc','action'=>'admin_index'));
		} else {
			$this->set('title_for_layout', __('Promotions Manager'));
			
			$this->paginate = array(
		        'conditions' => array('LocationPromo.location_id' => $location_id)
		    );
			
			$promos = $this->Paginate('LocationPromo');
			$location = $this->Location->read(null,$location_id);
			$this->set('location',$location);
			$this->set('nodes',$promos);
		}
	}
	
	public function admin_add($location_id = null)
	{
		$this->set('title_for_layout', __('New Promotion'));
			
		if (!empty($this->data))
		{
			if (Configure::read('Qparc.iparc_enabled'))
				$this->request->data['LocationPromo']['code'] = $this->str_rand(15);
				
			if ( $this->LocationPromo->save($this->data) )
			{
				if (Configure::read('Qparc.iparc_enabled'))
				{
					$date = $this->LocationPromo['LocationPromo']['start'];
					$date_string = $date['month'].$date['day'].$date['year'].'_'.date("hi");
					$start_date = $date['month'].$date['day'].$date['year'].'_0000';
					
					//@TODO these settings should be added when 
					//creating a location if iParc is enabled
					$store_id = '';
					$lot_id = '';
					
					$this->create_iparc_csv(
					1,
					$this->LocationPromo['LocationPromo']['code'],
					$date_string,
					$start_date,
					$store_id,
					$lot_id = '',
					$prepaid_amount = '', 
					$first_name = '',
					$last_name = '',
					$number_of_uses = '-1',
					$uses_per_transaction = '1',
					$expiration = '',
					$identifier = '1'
					);
				}
				
				$this->Session->setFlash("Promotion Saved");
				$this->redirect('/admin/qparc/qparc/manage/' . $this->request->data['LocationPromo']['location_id'] . "#promos");
			} else {
				$this->Session->setFlash("Promotion could not be Saved");
				$this->redirect('/admin/qparc/qparc/manage/' . $this->request->data['LocationPromo']['location_id'] . "#promos");
			}
		} else {
			if (!$location_id)
			{
				$this->Session->setFlash('Invalid Location');
				$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#promos");
			} else {
				$this->set("location_id",$location_id);
			}
		}

	}
	
	public function admin_export()
	{
		ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
		
		//create a file
		$filename = "qparc_export_promotions_".date("Y.m.d").".csv";
		$csv_file = fopen('php://output', 'w');
	
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
	
	    $results = $this->LocationPromo->find('all', array());
	
		// The column headings of your .csv file
		$header_row = array("ID", "Location ID","Name", "Details", "QR Code", "Start Date", "Expiration Date","Number of Uses","Status","Featured","Created","Modified");
		fputcsv($csv_file,$header_row,',','"');
	
		// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
		foreach($results as $result)
		{
			// Array indexes correspond to the field names in your db table(s)
			$row = array(
				$result['LocationPromo']['id'],
				$result['LocationPromo']['location_id'],
				$result['LocationPromo']['name'],
				$result['LocationPromo']['details'],
				$result['LocationPromo']['code'],
				$result['LocationPromo']['start'],
				$result['LocationPromo']['expiration'],
				$result['LocationPromo']['number_of_uses'],
				$result['LocationPromo']['status'],
				$result['LocationPromo']['promote'],
				$result['LocationPromo']['created'],
				$result['LocationPromo']['modified']
			);
	
			fputcsv($csv_file,$row,',','"');
		}
		$this->layout = "ajax";
		$this->set('results',$results);
		fclose($csv_file);
	}

	public function admin_edit($id = null)
	{
		$this->set('title_for_layout', __('Edit Promotion'));
		
		if (!empty($this->data))
		{
			if ( $this->LocationPromo->save($this->data) )
			{
				$this->Session->setFlash("Promotion Saved");
				$this->redirect('/admin/qparc/qparc/manage/' . $this->request->data['LocationPromo']['location_id'] . "#promos");
				//$this->redirect('/admin/qparc/location_promos/index/' . $this->request->data['LocationPromo']['location_id']);
			} else {
				$this->Session->setFlash("Promotion Could not be Saved");
				$this->redirect('/admin/qparc/qparc/manage/' . $this->request->data['LocationPromo']['location_id'] . "#promos");
				//$this->redirect('/admin/qparc/location_promos/index/' . $this->request->data['LocationPromo']['location_id']);
			}
		} else {
			
			$data = $this->LocationPromo->read(null,$id);
			$this->request->data = $data;
			
		}
	}

	public function admin_view($id = null)
	{
		if ($id)
		{
			$promo = $this->LocationPromo->read(null,$id);
			$this->set('promo',$promo);
		} else {
			$this->Session->setFlash('Invalid Promotion');
			$this->redirect(array('action'=>'admin_index'));
		}
	}
	
	public function view($id = null)
	{
		if ($id)
		{
			$promo = $this->LocationPromo->read(null,$id);
			$this->set('promo',$promo);
		} else {
			$this->Session->setFlash('Invalid Promotion');
			$this->redirect(array('controller' => 'locations', 'action'=>'index'));
		}
	}
	
	public function admin_process() {
		
		$location_id = $this->request->data['LocationPromo']['location_id'];
		$action = $this->request->data['LocationPromo']['action'];
		$method = $this->request->data['LocationPromo']['method'];
		$ids = array();
		
		foreach ($this->request->data['LocationPromo'] as $id => $value) {
			if ($id != 'action' && $id != 'method' && $id != 'copy' && $value['id'] == 1) {
				$ids[] = $id;
			}
		}

		if (count($ids) == 0) {
			$this->Session->setFlash(__('No items selected.'), 'default', array('class' => 'error'));
			$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#promos");
		} else if ($action == null && $method == 'action') {
			$this->Session->setFlash(__('No action selected.'), 'default', array('class' => 'error'));
			$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#promos");
		} else if ($this->request->data['LocationPromo']['copy'] == null && $method == 'copy') {
			$this->Session->setFlash(__('No location selected.'), 'default', array('class' => 'error'));
			$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#promos");
		}
		
		if ($method == 'action') {
			if ($action == 'delete' &&
				$this->LocationPromo->deleteAll(array('LocationPromo.id' => $ids), true, true)) {
				$this->Session->setFlash(__('Promotions deleted.'), 'default', array('class' => 'success'));
			} elseif ($action == 'publish' &&
				$this->LocationPromo->updateAll(array('LocationPromo.status' => 1), array('LocationPromo.id' => $ids))) {
				$this->Session->setFlash(__('Promotions published'), 'default', array('class' => 'success'));
			} elseif ($action == 'unpublish' &&
				$this->LocationPromo->updateAll(array('LocationPromo.status' => 0), array('LocationPromo.id' => $ids))) {
				$this->Session->setFlash(__('Promotions unpublished'), 'default', array('class' => 'success'));
			} elseif ($action == 'promote' &&
				$this->LocationPromo->updateAll(array('LocationPromo.promote' => 1), array('LocationPromo.id' => $ids))) {
				$this->Session->setFlash(__('Promotions promoted'), 'default', array('class' => 'success'));
			} elseif ($action == 'unpromote' &&
				$this->LocationPromo->updateAll(array('LocationPromo.promote' => 0), array('LocationPromo.id' => $ids))) {
				$this->Session->setFlash(__('Promotions unpromoted'), 'default', array('class' => 'success'));
			} else {
				$this->Session->setFlash(__('An error occurred.'), 'default', array('class' => 'error'));
			}
		} else if($method == 'copy') {
			
			$options = $this->LocationPromo->find('all',array('conditions'=>array('LocationPromo.id'=>$ids)));
			$copies = array();
			foreach ($options AS $option)
			{
				unset($option['LocationPromo']['id']);
				$option['LocationPromo']['location_id'] = $this->request->data['LocationPromo']['copy'];
				array_push($copies,$option);
			}
			
			if ($this->LocationPromo->saveAll($copies)) {
				$this->Session->setFlash(__('All Promotions have been copied to Location ' . $this->request->data['LocationPromo']['copy']), 'default', array('class' => 'success'));
			} else {
				$this->Session->setFlash(__('An error occurred attempting to copy the promotions.'), 'default', array('class' => 'error'));
			}
		}
		
		$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#promos");
	}

	public function index() {
		$this->set('title_for_layout', __('Promotions'));
	}

}
