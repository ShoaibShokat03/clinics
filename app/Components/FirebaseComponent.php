<?php

namespace App\Components;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Exception;

class FirebaseComponent
{
    protected $messaging;

    public function __construct()
    {
        // ✅ Read from config/firebase.php
        $serviceAccountPath = config('firebase.service_account_path');
        $databaseUrl = config('firebase.database_url');

        if (empty($serviceAccountPath) || !is_file($serviceAccountPath)) {
            throw new Exception("Service account file not found at: {$serviceAccountPath}");
        }

        $factory = (new Factory)->withServiceAccount($serviceAccountPath);

        if (!empty($databaseUrl)) {
            $factory = $factory->withDatabaseUri($databaseUrl);
        }

        $this->messaging = $factory->createMessaging();
    }

    /**
     * Test Firebase connection
     */
    public function testConnection()
    {
        try {
            $dummyToken = 'YOUR_DUMMY_DEVICE_TOKEN';
            $notification = Notification::create('Test', 'Test message');
            $message = CloudMessage::withTarget('token', $dummyToken)
                ->withNotification($notification);

            $result = $this->messaging->send($message);

            return ['success' => true, 'result' => $result];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'error_class' => get_class($e)
            ];
        }
    }

    /**
     * Send to single device
     */
    public function sendToDevice(string $deviceToken, string $title, string $body, array $data = [])
    {
        try {
            $notification = Notification::create($title, $body);

            $message = CloudMessage::withTarget('token', $deviceToken)
                ->withNotification($notification);

            if (!empty($data)) {
                $message = $message->withData($data);
            }

            $result = $this->messaging->send($message);
            return ['success' => true, 'messageId' => $result];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Send to multiple devices
     */
    public function sendToMultipleDevices(array $deviceTokens, string $title, string $body, array $data = [])
    {
        try {
            $notification = Notification::create($title, $body);
            $message = CloudMessage::new()->withNotification($notification);

            if (!empty($data)) {
                $message = $message->withData($data);
            }

            $result = $this->messaging->sendMulticast($message, $deviceTokens);

            return [
                'success' => true,
                'successCount' => $result->successes()->count(),
                'failureCount' => $result->failures()->count(),
                'results' => $result
            ];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Send to topic
     */
    public function sendToTopic(string $topic, string $title, string $body, array $data = [])
    {
        try {
            $notification = Notification::create($title, $body);

            $message = CloudMessage::withTarget('topic', $topic)
                ->withNotification($notification);

            if (!empty($data)) {
                $message = $message->withData($data);
            }

            $result = $this->messaging->send($message);
            return ['success' => true, 'messageId' => $result];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Subscribe to topic
     */
    public function subscribeToTopic(array $deviceTokens, string $topic)
    {
        try {
            $result = $this->messaging->subscribeToTopic($topic, $deviceTokens);
            return ['success' => true, 'result' => $result];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Unsubscribe from topic
     */
    public function unsubscribeFromTopic(array $deviceTokens, string $topic)
    {
        try {
            $result = $this->messaging->unsubscribeFromTopic($topic, $deviceTokens);
            return ['success' => true, 'result' => $result];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
