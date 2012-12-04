<?php
	CroogoRouter::connect('/profile', array('plugin' => 'qparc', 'controller' => 'user_profiles', 'action' => 'index'));
	CroogoRouter::connect('/reservations', array('plugin' => 'qparc', 'controller' => 'location_reservations', 'action' => 'index'));
	CroogoRouter::connect('/promos', array('plugin' => 'qparc', 'controller' => 'location_promos', 'action' => 'index'));
	CroogoRouter::connect('/promos/*', array('plugin' => 'qparc', 'controller' => 'location_promos', 'action' => 'view'));
	CroogoRouter::connect('/locations',array('plugin'=>'qparc', 'controller' => 'locations', 'action' => 'index'));
	CroogoRouter::connect('/reserve/*',array('plugin'=>'qparc', 'controller' => 'locations', 'action' => 'reserve'));
	CroogoRouter::connect('/reservation/confirmation/*',array('plugin'=>'qparc', 'controller' => 'location_reservations', 'action' => 'confirmation'));
	CroogoRouter::connect('/parking/option/*',array('plugin'=>'qparc', 'controller' => 'location_reservation_options', 'action' => 'view'));
