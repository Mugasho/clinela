<?php
use clinela\database\DB;


$db = new DB();
$page = new \clinela\template\Page('Patient Profile');
$id = isset($match['params']['id']) ? $match['params']['id'] : null;
$db->hasAccess('doctor/patient/' . $id, 1);
$doctor_id = $_SESSION['id'];
$page->setPageVars($id);
if (isset($_POST['prescriptions'])) {
    $prescriptions = $_POST['prescriptions'];
    foreach ($prescriptions as $prescription) {
        $drug_name = filter_var($prescription['drug_name'],FILTER_SANITIZE_STRING);
        $frequency = filter_var($prescription['frequency'],FILTER_SANITIZE_STRING);
        $days = filter_var($prescription['days'],FILTER_SANITIZE_STRING);
        $total = filter_var($prescription['total'],FILTER_SANITIZE_STRING);
        $advice = filter_var($prescription['advice'],FILTER_SANITIZE_STRING);
        $db->addPrescription($id, $doctor_id, $drug_name, $frequency, $days, $advice, $total);
        }
    $page->setPageError('Prescription added', 'Success', 'success');
}
if (isset($_GET['d'], $_GET['sub'])) {
    switch ($_GET['sub']) {
        case 'trash':
            $db->deletePrescription($_GET['d']);
            break;
    }
    $page->setPageError('Prescription Deleted', 'Success', 'error');
}
$page->addScripts('ResizeSensor.js', CONTENT_PATH . 'public/plugins/theia-sticky-sidebar/');
$page->addScripts('theia-sticky-sidebar.js', CONTENT_PATH . 'public/plugins/theia-sticky-sidebar/');
$page->addScripts('profile-settings.js', CONTENT_PATH . 'public/js/');
$page->setPageContent('doctor/patient-profile.blade.php');
$page->makePage();