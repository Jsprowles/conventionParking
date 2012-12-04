<?php
class LocationDatesController extends QparcAppController
{
		
	public $name = "LocationDates";
	
	public $uses = array('LocationDate','Location');
	
	public function admin_index() 
	{
		$this->set('title_for_layout', __('Date Manager'));
		$dates = $this->Paginate('LocationDate');
		$this->set('dates',$dates);
	}
	
	public function admin_add($location_id = null)
	{
		$this->set('title_for_layout', __('New Black out Date'));
		$this->set('location_id',$location_id);
		
		if (!empty($this->data))
		{
			if ( !$this->request->data['LocationDate']['range'] )
			{
				$this->request->data['LocationDate']['to'] = $this->request->data['LocationDate']['from'];
			}
			if ( $this->LocationDate->save($this->data) )
			{
				$this->Session->setFlash('Date Saved');
				$this->redirect('/admin/qparc/qparc/manage/' . $this->request->data['LocationDate']['location_id'] . "#dates");
				//$this->redirect(array('controller'=>'qparc','action'=>'admin_manage',$this->request->data['LocationReservationOption']['location_id']));
			} else {
				$this->Session->setFlash('Sorry, Date could not be Saved');
				$this->redirect('/admin/qparc/qparc/manage/' . $this->request->data['LocationDate']['location_id'] . "#dates");
				//$this->redirect(array('controller'=>'qparc','action'=>'admin_manage',$this->request->data['LocationReservationOption']['location_id']));
			}
		}
	}

	public function admin_export()
	{
		ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
		
		//create a file
		$filename = "qparc_export_blackouts_".date("Y.m.d").".csv";
		$csv_file = fopen('php://output', 'w');
	
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
	
	    $results = $this->LocationDate->find('all', array());
	
		// The column headings of your .csv file
		$header_row = array("ID", "Location ID","Start Date", "End Date", "Notes", "Status");
		fputcsv($csv_file,$header_row,',','"');
	
		// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
		foreach($results as $result)
		{
			// Array indexes correspond to the field names in your db table(s)
			$row = array(
				$result['LocationDate']['id'],
				$result['LocationDate']['location_id'],
				$result['LocationDate']['from'],
				$result['LocationDate']['to'],
				$result['LocationDate']['notes'],
				$result['LocationDate']['status']
			);
	
			fputcsv($csv_file,$row,',','"');
		}
		$this->layout = "ajax";
		$this->set('results',$results);
		fclose($csv_file);
	}

	public function admin_edit($id = null)
		{
			$this->set('title_for_layout', __('Edit Black out Date'));
			
			if (!empty($this->data))
			{
				if ( !$this->request->data['LocationDate']['range'] )
				{
					$this->request->data['LocationDate']['to'] = $this->request->data['LocationDate']['from'];
				}
				if ( $this->LocationDate->save($this->data) )
				{
					$this->Session->setFlash('Date Saved');
					$this->redirect('/admin/qparc/qparc/manage/' . $this->request->data['LocationDate']['location_id'] . "#dates");
					//$this->redirect(array('controller'=>'qparc','action'=>'admin_manage',$this->request->data['LocationReservationOption']['location_id']));
				} else {
					$this->Session->setFlash('Sorry, Date could not be Saved');
					$this->redirect('/admin/qparc/qparc/manage/' . $this->request->data['LocationDate']['location_id'] . "#dates");
					//$this->redirect(array('controller'=>'qparc','action'=>'admin_manage',$this->request->data['LocationReservationOption']['location_id']));
				}
			} else {
				$this->request->data = $this->LocationDate->read(null,$id);
			}
		}
	
	public function admin_delete($id = null)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Date'), 'default', array('class' => 'error'));
			$this->redirect('/admin/qparc/qparc/manage/' . $this->request->data['LocationDate']['location_id'] . "#dates");
		}
		if ($this->LocationDate->delete($id)) {
			$this->Session->setFlash(__('Date deleted'), 'default', array('class' => 'success'));
			$this->redirect('/admin/qparc/qparc/manage/' . $this->request->data['LocationDate']['location_id'] . "#dates");
		}
	}

	public function admin_process() {
		
		$location_id = $this->request->data['LocationDate']['location_id'];
		$action = $this->request->data['LocationDate']['action'];
		$method = $this->request->data['LocationDate']['method'];
		$ids = array();
		
		foreach ($this->request->data['LocationDate'] as $id => $value) {
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
		} else if ($this->request->data['LocationDate']['copy'] == null && $method == 'copy') {
			$this->Session->setFlash(__('No location selected.'), 'default', array('class' => 'error'));
			$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#options");
		}
		
		if ($method == 'action') {
			if ($action == 'delete' &&
				$this->LocationDate->deleteAll(array('LocationDate.id' => $ids), true, true)) {
				$this->Session->setFlash(__('Date deleted.'), 'default', array('class' => 'success'));
			} elseif ($action == 'publish' &&
				$this->LocationDate->updateAll(array('LocationDate.status' => 1), array('LocationDate.id' => $ids))) {
				$this->Session->setFlash(__('Date published'), 'default', array('class' => 'success'));
			} elseif ($action == 'unpublish' &&
				$this->LocationDate->updateAll(array('LocationDate.status' => 0), array('LocationDate.id' => $ids))) {
				$this->Session->setFlash(__('Date unpublished'), 'default', array('class' => 'success'));
			} elseif ($action == 'promote' &&
				$this->LocationDate->updateAll(array('LocationDate.promote' => 1), array('LocationDate.id' => $ids))) {
				$this->Session->setFlash(__('Date promoted'), 'default', array('class' => 'success'));
			} elseif ($action == 'unpromote' &&
				$this->LocationDate->updateAll(array('LocationDate.promote' => 0), array('LocationDate.id' => $ids))) {
				$this->Session->setFlash(__('Date unpromoted'), 'default', array('class' => 'success'));
			} else {
				$this->Session->setFlash(__('An error occurred.'), 'default', array('class' => 'error'));
			}
		} else if($method == 'copy') {
			
			$options = $this->LocationDate->find('all',array('conditions'=>array('LocationDate.id'=>$ids)));
			$copies = array();
			foreach ($options AS $option)
			{
				unset($option['LocationDate']['id']);
				$option['LocationDate']['location_id'] = $this->request->data['LocationDate']['copy'];
				array_push($copies,$option);
			}
			
			if ($this->LocationDate->saveAll($copies)) {
				$this->Session->setFlash(__('All Dates have been copied to Location ' . $this->request->data['LocationDate']['copy']), 'default', array('class' => 'success'));
			} else {
				$this->Session->setFlash(__('An error occurred attempting to copy the options.'), 'default', array('class' => 'error'));
			}
		}
		
		$this->redirect('/admin/qparc/qparc/manage/' . $location_id . "#dates");
	}

	public function index() {
		$this->set('title_for_layout', __('Black out Dates'));
	}
	
}
