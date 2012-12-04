<?php

	Croogo::hookRoutes('Qparc');

	Croogo::hookBehavior('Qparc.Iparc', 'Qparc.PaymentProfile', 'Qparc.Geocoding', array());

	Croogo::hookHelper('Nodes', 'Qparc.Qrcode','Qparc.GoogleMapV3');
	
	//Croogo::hookComponent('*', 'Example.Example');

/**
 * Admin menu (navigation)
 */
    CroogoNav::add('extensions.children.qparc', array(
        'title' => __('Qparc'),
        'url' => '/admin/qparc'
    ));


	/**
	 'children' => array(
            'reservations' => array(
                'title' => __('Reservations Manager'),
                'url' => '/admin/qparc/reservations',
            ),
            'promos' => array(
                'title' => __('Promotions Manager'),
                'url' => '/admin/qparc/promos',
            ),
            'system' => array(
                'title' => __('System Settings'),
                'url' => '/admin/qparc',
            ),
        ),
	 */
/**
 * Admin row action
 *
 * When browsing the content list in admin panel (Content > List),
 * an extra link called 'Example' will be placed under 'Actions' column.
 */
	//Croogo::hookAdminRowAction('Nodes/admin_index', 'Example', 'plugin:example/controller:example/action:index/:id');

/**
 * Admin tab
 *
 * When adding/editing Content (Nodes),
 * an extra tab with title 'Example' will be shown with markup generated from the plugin's admin_tab_node element.
 *
 * Useful for adding form extra form fields if necessary.
 */
	//Croogo::hookAdminTab('Nodes/admin_add', 'qParc', 'qparc.admin_tab_node');
	//Croogo::hookAdminTab('Nodes/admin_edit', 'qParc', 'qparc.admin_tab_node');
	Croogo::hookAdminTab('Users/admin_edit', 'Profile', 'Qparc.admin_user_edit');
