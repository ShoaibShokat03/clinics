<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseUpdateController extends Controller
{
    public function applyChanges()
    {
        try {
            // Run any pending migrations for the current tenant
            \Illuminate\Support\Facades\Artisan::call('migrate', [
                '--force' => true
            ]);

            $output = \Illuminate\Support\Facades\Artisan::output();

            // Return the data as JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Database changes applied successfully.',
                'details' => $output
            ]);
        } catch (\Exception $e) {
            // Return the actual error message for debugging
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to apply database changes: ' . $e->getMessage()
            ], 500);
        }
    }
}
