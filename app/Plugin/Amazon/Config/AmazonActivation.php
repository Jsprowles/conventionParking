<?php

class AmazonActivation {
	
	
	public function beforeActivation(&$controller) {
		return true;
	}
	
	
	public function onActivation(&$controller) {
		
		// Credentials
		$controller->Setting->write('Amazon.key','',array('description' => 'Amazon API Key','editable' => 1));
		$controller->Setting->write('Amazon.secret','',array('description' => 'Amazon API Secret','editable' => 1));
		
		// SNS
		$controller->Setting->write('Amazon.sns_port','',array('description' => 'Amazon SNS Port','editable' => 1));
		$controller->Setting->write('Amazon.sns_host','',array('description' => 'Amazon SNS Host','editable' => 1));
		$controller->Setting->write('Amazon.sns_username','',array('description' => 'Amazon SNS Username','editable' => 1));
		$controller->Setting->write('Amazon.sns_password','',array('description' => 'Amazon SNS Password','editable' => 1));
		
	}
	
	/**
	 * onDeactivate will be called if this returns true
	 *
	 * @param  object $controller Controller
	 * @return boolean
	 */
    public function beforeDeactivation(&$controller) {
        return true;
    }
	
	/**
	 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
	 *
	 * @param object $controller Controller
	 * @return void
	 */
    public function onDeactivation(&$controller) {
		
	}
}

?>