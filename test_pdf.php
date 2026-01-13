<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

echo "Autoload loaded\n";

use Dompdf\Dompdf;

echo "Dompdf loaded\n";

try {
    $dompdf = new Dompdf();
    $dompdf->loadHtml('<h1>Test PDF</h1><img src="' . __DIR__ . '/public/assets/images/dashboard/logo smkn-1-cibinong.png" height="60">');
    $dompdf->render();
    file_put_contents(__DIR__ . '/public/test_simple.pdf', $dompdf->output());
    echo 'PDF saved successfully';
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
