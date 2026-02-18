<?php

function callGemini($apiKey, $prompt)
{
    $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

    // Request payload
    $payload = [
        "contents" => [
            [
                "parts" => [
                    ["text" => $prompt]
                ]
            ]
        ],
        // Optional: disable thinking if you want faster + cheaper response
        // "generationConfig" => [ "thinkingConfig" => [ "thinkingBudget" => 0 ] ]
    ];

    // Initialize cURL
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'x-goog-api-key: ' . $apiKey
        ],
        CURLOPT_POSTFIELDS => json_encode($payload)
    ]);

    // Execute request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    // Handle response
    if ($error) {
        throw new Exception("cURL Error: " . $error);
    }

    if ($httpCode !== 200) {
        throw new Exception("HTTP $httpCode Error: " . $response);
    }

    return $response;
}

// 🧪 Example usage
try {
    $apiKey = 'AIzaSyDEciWigJXzgDeCxgWNNXFJfeAdMXQgbq8';
    $prompt = 'Explain recursion in one line';
    $result = callGemini($apiKey, $prompt);
    print_r($result);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
