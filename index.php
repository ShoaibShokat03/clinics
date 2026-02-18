<?php
/**
 * Request Logger
 * Logs GET, POST, and other requests to separate files.
 */

function logRequest()
{
    // Define log directory (ensure the script has write permissions here)
    $logDir = __DIR__ . '/logs';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    $method = $_SERVER['REQUEST_METHOD'];
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    $url = $_SERVER['REQUEST_URI'] ?? 'UNKNOWN';

    // Prepare the log entry
    $logEntry = "[$timestamp] IP: $ip | URL: $url" . PHP_EOL;

    if ($method === 'GET') {
        $logFile = $logDir . '/get_requests.txt';
        $logEntry .= "Data: " . json_encode($_GET) . PHP_EOL;
    } elseif ($method === 'POST') {
        $logFile = $logDir . '/post_requests.txt';
        $logEntry .= "Data: " . json_encode($_POST) . PHP_EOL;

        // Also capture raw input for JSON/API requests
        $rawInput = file_get_contents('php://input');
        if (!empty($rawInput)) {
            $logEntry .= "Raw Body: " . $rawInput . PHP_EOL;
        }
    } else {
        $logFile = $logDir . '/other_requests.txt';
        $logEntry .= "Method: $method | Data: " . file_get_contents('php://input') . PHP_EOL;
    }

    $logEntry .= str_repeat('-', 50) . PHP_EOL;

    // Write to the appropriate log file
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}
logRequest();
?>

<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is maintenance / demo mode via the "down" command we
| will require this file so that any prerendered template can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists(__DIR__ . '/storage/framework/maintenance.php')) {
    require __DIR__ . '/storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__ . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);
