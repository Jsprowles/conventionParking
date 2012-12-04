<?php

class UserProfilesController extends QparcAppController
{
	public $name = "UserProfiles";
	
	public $components = array(
        'Email',
        'RequestHandler',
        'Auth',
        'Session'
    );
	
	public $helpers = array('Js');
	
	public function admin_index()
	{
		
	}
	
	public function index()
	{
	 	
		$this->set('title_for_layout', __('My Profile', true));
		
		$this->UserProfile->Behaviors->load('Qparc.PaymentProfile');
				
		// User does NOT have a Profile
		if ( !$this->UserProfile->find('first',array('conditions'=>array('UserProfile.user_id'=>$this->Session->read('Auth.User.id')))) ) {
			
			// create a NEW EMPTY profile
			$this->UserProfile->create();
			$this->request->data['UserProfile']['user_id'] = $this->Session->read('Auth.User.id');
			$this->request->data['User'] = $this->Session->read('Auth.User');
			
			// Save the NEW profile	
	 		if($this->UserProfile->save($this->data)) {
	 			$this->Session->setFlash(__('Please Complete Your Profile and add a Payment Method before Scheduling a Ride.', true));
				$this->redirect(array('action' => 'index'));
	 		} else {
	 			$this->Session->setFlash(__('Please Complete Your Profile and add a Payment Method before Scheduling a Ride.', true));
				$this->redirect(array('action' => 'index'));
	 		}	
						
		// User Does have a profile
		// Set the profile data
		} else if ($this->UserProfile->find('first',array('conditions'=>array('UserProfile.user_id'=>$this->Session->read('Auth.User.id')))) ) {
			$this->request->data = $this->UserProfile->find('first',array('conditions'=>array('UserProfile.user_id'=>$this->Session->read('Auth.User.id'))));
		}
	 }
	 
	 /**
	  * creating or updating a profile
	  */
	 public function add()
	 {
		
		// mobile app will use ajax to update profile
		if ($this->RequestHandler->isAjax())
		{
			$this->autoRender = false;
			$this->layout = 'ajax';
			
			//return json_encode($this->data);
			
			if($this->UserProfile->saveAll($this->data)) {
	 			//$this->Session->setFlash(__('Your Profile has been Updated.', true));
				return 1;
	 		} else {
	 			//$this->Session->setFlash(__('Failed to Update Profile. Please complete all fields <strong>and a Payment Method</strong>', true));
				return 0;
	 		}
		}	
		
		if (!empty($this->data)) {
			
			// This is a NEW profile
			if ( !$this->UserProfile->find('first',array('conditions'=>array('UserProfile.user_id'=>$this->Session->read('Auth.User.id')))) ) {
				$this->UserProfile->create();
				$this->data['UserProfile']['user_id'] = $this->Session->read('Auth.User.id');
			}
			// Save the profile
	 		if($this->UserProfile->saveAll($this->data)) {
	 			$this->Session->setFlash(__('Your Profile has been Updated.', true));
				$this->redirect(array('action' => 'index'));
	 		} else {
	 			$this->Session->setFlash(__('Failed to Update Profile. Please complete all fields <strong>and a Payment Method</strong>', true));
				$this->redirect(array('action' => 'index'));
	 		}
		} else {
			$this->Session->setFlash(__('There was no data posted, Please try again..', true));
			$this->redirect(array('action' => 'index'));
		}
	
	 }
	 
	public function edit($id) {
	 	
	    //Has any form data been POSTed?
	    if(!empty($this->data)) {
	        //If the form data can be validated and saved...
	        return $this->UserProfile->save($this->data);
	    }
	 
	    //If no form data, find the recipe to be edited
	    //and hand it to the view.
	    //$this->data = $this->UserProfile->findById($id);
	}
	
	public function reset_password($id = null) {
	$this->loadModel('User');
	
	    if (!$id && empty($this->data)) {
	        $this->Session->setFlash(__('Invalid User', true));
	        $this->redirect(array('action' => 'index'));
	    }
	    if (!empty($this->data)) {
	        $user = $this->User->findById($id);
			
	        if ($user['User']['password'] == Security::hash($this->request->data['User']['current_password'], null, true)) {
	            if ($this->User->save($this->data)) {
	                $this->Session->setFlash(__('Password has been reset.', true));
	                $this->redirect(array('action' => 'index'));
	            } else {
	                $this->Session->setFlash(__('Password could not be reset. Please, try again.', true));
					$this->redirect(array('action' => 'index'));
	            }
	        } else {
	            $this->Session->setFlash(__('Current password did not match. Please, try again.', true));
				$this->redirect(array('action' => 'index'));
	        }
	    }
		
	}	
}
