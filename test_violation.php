<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\ViolationPoint;

echo "Testing ViolationPoint model...\n";

try {
    $violations = ViolationPoint::with(['rule', 'student'])->take(1)->get();
    echo "Found " . $violations->count() . " violations\n";

    if ($violations->count() > 0) {
        $violation = $violations->first();
        echo "First violation:\n";
        echo "  Student: " . ($violation->student->name ?? 'null') . "\n";
        echo "  Rule: " . ($violation->rule->name ?? 'null') . "\n";
        echo "  Points: " . ($violation->rule->points ?? 'null') . "\n";
        echo "  Date: " . $violation->date . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
