<?php

class AmazonController extends AmazonAppController
{
	public $name = "Amazon";
	
	public $defaults = array();
	
	public $uses = array('Setting');
	
	public function beforeFilter() {
		
        parent::beforeFilter();

		$this->loadModel('Setting');

		$settings = $this->Setting->find('all', array('conditions'=>array('Setting.key LIKE'=>'Amazon.%')));
		foreach($settings as $setting){
			$cleaned_key = explode('.', $setting['Setting']['key']);
			$this->defaults[$cleaned_key[1]]['id'] = $setting['Setting']['id'];
			$this->defaults[$cleaned_key[1]]['value'] = $setting['Setting']['value'];
		}
		
        $this->set('defaults', $this->defaults);
    	
    }

    public function admin_index() {
    	
        $this->set('title_for_layout', __('AWS Settings', true));
        
        if(!empty($this->data)) {
            $settings =& ClassRegistry::init('Setting');
			
            foreach ($this->data['Amazon'] as $key=>$setting) {
                $settings->id = $setting['id'];
                $settings->saveField('value',$setting['value']);
            }            
            $this->Session->setFlash(__('Amazon Settings have been saved', true));
            $this->redirect("/admin/amazon");
        }
		
        $this->set('inputs', $this->defaults);
    }
}
