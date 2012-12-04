<?php
/**
 * qParc Activation
 *
 * Activation class for qParc core plugin.
 * This is optional, and is required only if you want to perform tasks when your plugin is activated/deactivated.
 *
 * @package  Qparc
 * @author   Michael Labieniec <contact@codecreator.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.qparc.net
 */
class QparcActivation {
/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
	public function beforeActivation(&$controller) {
		return true;
	}

/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
	public function onActivation(&$controller) {
		// ACL: set ACOs with permissions
		$controller->Croogo->addAco('Qparc');
		$controller->Croogo->addAco('Qparc/admin_manage');
		
		$controller->Croogo->addAco('UserProfiles'); 
		$controller->Croogo->addAco('UserProfiles/admin_index'); 
		$controller->Croogo->addAco('UserProfiles/admin_add'); 
		$controller->Croogo->addAco('UserProfiles/admin_edit'); 
		$controller->Croogo->addAco('UserProfiles/admin_delete'); 
		$controller->Croogo->addAco('UserProfiles/admin_view'); 
		
		$controller->Croogo->addAco('UserProfiles/index', array('registered'));
		$controller->Croogo->addAco('UserProfiles/add', array('registered'));
		$controller->Croogo->addAco('UserProfiles/edit', array('registered'));
		$controller->Croogo->addAco('UserProfiles/view', array('registered'));
		
		$controller->Croogo->addAco('Locations'); 
		$controller->Croogo->addAco('Locations/admin_index'); 
		$controller->Croogo->addAco('Locations/admin_add'); 
		$controller->Croogo->addAco('Locations/admin_edit'); 
		$controller->Croogo->addAco('Locations/admin_delete'); 
		$controller->Croogo->addAco('Locations/admin_view'); 
		$controller->Croogo->addAco('Locations/admin_dates'); 
		
		$controller->Croogo->addAco('Locations/reserve',array('registered')); 
		$controller->Croogo->addAco('Locations/edit_reservation',array('registered')); 
		$controller->Croogo->addAco('Locations/index', array('registered'));
		$controller->Croogo->addAco('Locations/view', array('registered'));
		
		$controller->Croogo->addAco('LocationDates'); 
		$controller->Croogo->addAco('LocationDates/admin_index'); 
		$controller->Croogo->addAco('LocationDates/admin_add'); 
		$controller->Croogo->addAco('LocationDates/admin_edit'); 
		$controller->Croogo->addAco('LocationDates/admin_delete'); 
		$controller->Croogo->addAco('LocationDates/admin_view'); 
		$controller->Croogo->addAco('LocationDates/admin_dates'); 
		
		$controller->Croogo->addAco('LocationDates/index', array('registered'));
		$controller->Croogo->addAco('LocationDates/view', array('registered'));
		
		$controller->Croogo->addAco('LocationReservations'); 
		$controller->Croogo->addAco('LocationReservations/admin_index'); 
		$controller->Croogo->addAco('LocationReservations/admin_add'); 
		$controller->Croogo->addAco('LocationReservations/admin_edit'); 
		$controller->Croogo->addAco('LocationReservations/admin_delete'); 
		$controller->Croogo->addAco('LocationReservations/admin_view'); 
		$controller->Croogo->addAco('LocationReservations/admin_dates'); 
		
		$controller->Croogo->addAco('LocationReservations/index', array('registered'));
		$controller->Croogo->addAco('LocationReservations/add', array('public','registered'));
		$controller->Croogo->addAco('LocationReservations/edit', array('registered'));
		$controller->Croogo->addAco('LocationReservations/delete', array('registered'));
		$controller->Croogo->addAco('LocationReservations/view', array('registered'));
		$controller->Croogo->addAco('LocationReservations/confirmation', array('registered'));
		
		$controller->Croogo->addAco('LocationReservationOptions'); 
		$controller->Croogo->addAco('LocationReservationOptions/admin_index');
		$controller->Croogo->addAco('LocationReservationOptions/admin_add'); 
		$controller->Croogo->addAco('LocationReservationOptions/admin_edit');
		$controller->Croogo->addAco('LocationReservationOptions/admin_delete');
		$controller->Croogo->addAco('LocationReservationOptions/index', array('registered', 'public'));
		$controller->Croogo->addAco('LocationReservationOptions/view', array('registered', 'public'));
		
		$controller->Croogo->addAco('LocationPromos'); 
		$controller->Croogo->addAco('LocationPromos/admin_index'); 
		$controller->Croogo->addAco('LocationPromos/admin_edit'); 
		$controller->Croogo->addAco('LocationPromos/admin_delete'); 
		$controller->Croogo->addAco('LocationPromos/admin_view'); 
		
		$controller->Croogo->addAco('LocationPromos/index', array('registered', 'public'));
		$controller->Croogo->addAco('LocationPromos/view', array('registered', 'public'));

		// Main menu: add a reservations link
		$mainMenu = $controller->Link->Menu->findByAlias('main');
		$controller->Link->Behaviors->attach('Tree', array(
			'scope' => array(
				'Link.menu_id' => $mainMenu['Menu']['id'],
			),
		));
		/*
		$controller->Link->save(array(
			'menu_id' => $mainMenu['Menu']['id'],
			'title' => 'qParc',
			'link' => '/reservations',
			'status' => 1
		));
		
		$controller->Link->save(array(
			'menu_id' => $mainMenu['Menu']['id'],
			'title' => 'qParc',
			'link' => '/promos',
			'status' => 1
		));
		*/
		$controller->Setting->write('Qparc.reservations_public','',array('description' => 'Reservations Public/Private','editable' => 1,'value'=>1));
		$controller->Setting->write('Qparc.reservations_show_promos','',array('description' => 'Show Promotions when Reserving','editable' => 1,'value'=>1));
		$controller->Setting->write('Qparc.reservations_show_payment','',array('description' => 'Show Payment when Reserving (Prepaid Reservations)','editable' => 1,'value'=>1));
		
		$controller->Setting->write('Qparc.authnet_test','1',array('description' => 'Authorize.net Login','editable' => 1));
		$controller->Setting->write('Qparc.authnet_login','',array('description' => 'Authorize.net Login','editable' => 1));
		$controller->Setting->write('Qparc.authnet_transaction_key','',array('description' => 'Authorize.net Transaction Key','editable' => 1));
		
		$controller->Setting->write('Qparc.iparc_enabled','',array('description' => 'iParc Integration','editable' => 1));
		$controller->Setting->write('Qparc.iparc_site_id','',array('description' => 'iParc Site ID','editable' => 1));
		$controller->Setting->write('Qparc.iparc_identifier','',array('description' => 'Identifier','editable' => 1));
		$controller->Setting->write('Qparc.iparc_validation','',array('description' => 'Store Validation Number','editable' => 1));

		$controller->Setting->write('Qparc.email_enabled','',array('description' => 'Enable Email Reservation Reports','editable' => 1));
		$controller->Setting->write('Qparc.email_addresses','',array('description' => 'Email Address to send Reservation Reports.','editable' => 1));
		$controller->Setting->write('Qparc.email_frequency','',array('description' => 'Frequency to email reports','editable' => 1));
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
		// ACL: remove ACOs with permissions
		$controller->Croogo->removeAco('Qparc');
		$controller->Croogo->removeAco('Locations');
		$controller->Croogo->removeAco('LocationReservations');
		$controller->Croogo->removeAco('LocationReservationOptions');
		$controller->Croogo->removeAco('LocationPromos');
		$controller->Croogo->removeAco('LocationDates');
	}
}
