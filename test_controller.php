<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Http\Controllers\dashboard\dash_feature\PelanggaranController;

echo "Testing PelanggaranController exportPdf method...\n";

try {
    $controller = new PelanggaranController();
    $response = $controller->exportPdf();

    echo "Method executed successfully\n";
    echo "Response status: " . $response->getStatusCode() . "\n";
    echo "Content-Type: " . $response->headers->get('Content-Type') . "\n";
    echo "Content-Disposition: " . $response->headers->get('Content-Disposition') . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
