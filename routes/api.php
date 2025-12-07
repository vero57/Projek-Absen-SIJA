<?php
Route::middleware('auth:sanctum')->get('/face-data', [\App\Http\Controllers\Api\FaceController::class, 'getFaceData']);