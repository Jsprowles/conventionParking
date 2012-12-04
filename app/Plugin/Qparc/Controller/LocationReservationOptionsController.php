<?php
/**
 * Location Reservation Options Controller
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
class LocationReservationOptionsController extends QparcAppController {
	/**
	 * Controller name
	 *
	 * @var string
	 * @access public
	 */
	public $name = 'LocationReservationOptions';
	
	/**
	 * Models used by the Controller
	 *
	 * @var array
	 * @access public
	 */
	public $uses = array('LocationReservationOption','Location','Setting');
	

	public function admin_index() {
		$this->set('title_for_layout', __('Parking Options Manager'));
	}
	
	public function admin_add($location_id = null)
	{
		$this->set('title_for_layout',__('New Parking Option'));
		
		if (!$location_id)
		{
			$this->Session->setFlash('Invalid Location');
			$this->redirect(array('controller'=>'qparc','action'=>'admin_manage'));
		} else {
			
			if (empty($this->request->data)) {
				$this->set('title_for_layout','Add Parking Option');
				$this->set('location_id',$location_id);
			} else {
				if ($this->LocationReservationOption->save($this->request->data)) 
				{
					$this->Session->setFlash($this->request->data['LocationReservationOption']['name'] . ' Saved');
					$this->redirect(array('controller'=>'qparc','action'=>'admin_manage',$this->request->data['LocationReservationOption']['location_id']));
				} else {
					$this->Session->setFlash($this->request->data['LocationReservationOption']['name'] . ' Could not be saved');
					$this->redirect(array('controller'=>'qparc','action'=>'admin_manage',$this->request->data['LocationReservationOption']['location_id']));
				}
			}	
		}
	}
	
	public function admin_edit($id = null)
	{
		$this->set('title_for_layout',__('Edit Parking Option'));
		
		if (!$id)
		{
			$this->Session->setFlash('Invalid Parking Option');
			$this->redirect(array('controller'=>'qparc','action'=>'admin_manage'));
		} else {
			if (empty($this->request->data)) {
				
				$this->set('title_for_layout','Edit Parking Option');
				$data = $this->LocationReservationOption->read(null,$id);
				$this->request->data = $data;
				
			} else {
				if ($this->LocationReservationOption->save($this->request->data)) 
				{
					$this->Session->setFlash($this->request->data['LocationReservationOption']['name'] . ' Saved');
					$this->redirect(array('controller'=>'qparc','action'=>'admin_manage',$this->request->data['LocationReservationOption']['location_id']));
				} else {
					$this->Session->setFlash($this->request->data['LocationReservationOption']['name'] .' Could not be saved');
					$this->redirect(array('controller'=>'qparc','action'=>'admin_manage',$this->request->data['LocationReservationOption']['location_id']));
				}
			}	
		}
	}

	public function admin_process() {
		
		$location_id = $this->request->data['LocationReservationOption']['location_id'];
		$action = $this->request->data['LocationReservationOption']['action'];
		$method = $this->request->data['LocationReservationOption']['method'];
		
		$ids = array();
		
		foreach ($this->request->data['LocationReservationOption'] as $id => $value) {
			if ($id != 'action' && $id != 'method' && $id != 'copy' && $value['id'] == 1) {
				$ids[] = $id;
			}
		}

		if (count($ids) == 0) {
			$this->Session->setFlash(__('No items selected.'), 'default', array('class' => 'error'));
			$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#options");
		} else if ($action == null && $method == 'action') {
			$this->Session->setFlash(__('No action selected.'), 'default', array('class' => 'error'));
			$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#options");
		} else if ($this->request->data['LocationReservationOption']['copy'] == null && $method == 'copy') {
			$this->Session->setFlash(__('No location selected.'), 'default', array('class' => 'error'));
			$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#options");
		}
		
		if ($method == 'action') {
			if ($action == 'delete' &&
				$this->LocationReservationOption->deleteAll(array('LocationReservationOption.id' => $ids), true, true)) {
				$this->Session->setFlash(__('Parking Options deleted.'), 'default', array('class' => 'success'));
			} elseif ($action == 'publish' &&
				$this->LocationReservationOption->updateAll(array('LocationReservationOption.status' => 1), array('LocationReservationOption.id' => $ids))) {
				$this->Session->setFlash(__('Parking Options published'), 'default', array('class' => 'success'));
			} elseif ($action == 'unpublish' &&
				$this->LocationReservationOption->updateAll(array('LocationReservationOption.status' => 0), array('LocationReservationOption.id' => $ids))) {
				$this->Session->setFlash(__('Parking Options unpublished'), 'default', array('class' => 'success'));
			} elseif ($action == 'promote' &&
				$this->LocationReservationOption->updateAll(array('LocationReservationOption.promote' => 1), array('LocationReservationOption.id' => $ids))) {
				$this->Session->setFlash(__('Parking Options promoted'), 'default', array('class' => 'success'));
			} elseif ($action == 'unpromote' &&
				$this->LocationReservationOption->updateAll(array('LocationReservationOption.promote' => 0), array('LocationReservationOption.id' => $ids))) {
				$this->Session->setFlash(__('Parking Options unpromoted'), 'default', array('class' => 'success'));
			} else {
				$this->Session->setFlash(__('An error occurred.'), 'default', array('class' => 'error'));
			}
		} else if($method == 'copy') {
			
			$options = $this->LocationReservationOption->find('all',array('conditions'=>array('LocationReservationOption.id'=>$ids)));
			$copies = array();
			foreach ($options AS $option)
			{
				unset($option['LocationReservationOption']['id']);
				$option['LocationReservationOption']['location_id'] = $this->request->data['LocationReservationOption']['copy'];
				array_push($copies,$option);
			}
			
			if ($this->LocationReservationOption->saveAll($copies)) {
				$this->Session->setFlash(__('All Options have been copied to Location ' . $this->request->data['LocationReservationOption']['copy']), 'default', array('class' => 'success'));
			} else {
				$this->Session->setFlash(__('An error occurred attempting to copy the options.'), 'default', array('class' => 'error'));
			}
		}
			
		$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#options");
	}

	public function admin_copy()
	{
		
	}
	
	public function view($id = null)
	{
		if($id)
		{
			$option = $this->LocationReservationOption->read(null,$id);
			$this->set('title_for_layout',$option['LocationReservationOption']['name']);
			$this->set('option',$option);
		} else {
			$this->Session->setFlash(__('Invalid Parking Option'));
			$this->redirect('/reservations');
		}
	}
	
	public function index() {
		$this->set('title_for_layout', __('Parking Options'));
	}

}
