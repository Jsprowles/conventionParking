<?php

App::uses('Configure', 'Core');
App::uses('View', 'View');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf' . DS . 'dompdf_config.inc.php');

ob_start();
if (defined('DOMPDF_TEMP_DIR')) {
	$dir = new SplFileInfo(DOMPDF_TEMP_DIR);
	if (!$dir->isDir() || $dir->isWritable()) {
		trigger_error(__('%s is not writable', DOMPDF_TEMP_DIR), E_USER_WARNING);
	}
}
$errors = ob_get_contents();
ob_end_clean();

$download = false;
$name = pathinfo($this->here, PATHINFO_BASENAME);
$paperOrientation = 'portrait';
$paperSize = 'letter';

extract($this->viewVars, EXTR_IF_EXISTS);

$dompdf = new DOMPDF();
$dompdf->load_html(utf8_decode($content_for_layout), Configure::read('App.encoding'));
//$dompdf->load_html($errors . utf8_decode($content_for_layout), Configure::read('App.encoding'));
$dompdf->set_protocol('');
$dompdf->set_protocol(WWW_ROOT);
$dompdf->set_base_path('/');
$dompdf->set_paper($paperSize, $paperOrientation);
$dompdf->render();
$dompdf->stream($name, array('Attachment' => $download));

?>