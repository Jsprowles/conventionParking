<?php

	Croogo::hookRoutes('Amazon');
	Croogo::hookComponent('*', 'Amazon.Amazon');

/**
 * Admin menu (navigation)
 */
    CroogoNav::add('extensions.children.aws', array(
        'title' => __('AWS'),
        'url' => '/admin/amazon'
    ));