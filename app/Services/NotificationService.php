<?php

namespace App\Services;

use App\Models\AppNotifications;
use Carbon\Carbon;
use App\Models\DeviceToken;
use Exception;

class NotificationService
{
    /**
     * Send notification to specific user
     */
    public static function sendToUser($userId, $title, $body, $data = [])
    {
        $deviceTokens = DeviceToken::getActiveTokenForUser($userId);
        if ($deviceTokens->isEmpty()) {
            return ['status' => 'error', 'message' => 'No active device tokens found for user'];
        }
        try {
            $appNotification = new AppNotifications();
            $appNotification->user_id = $userId;
            $appNotification->title = $title;
            $appNotification->description = $body;
            $appNotification->status = "unread";
            $appNotification->created_at = Carbon::now();
            $appNotification->updated_at = Carbon::now();
            $appNotification->save();
            // Keep only the latest 300 notifications globally
            $idsToKeep = AppNotifications::orderBy('created_at', 'desc')
                ->limit(300)
                ->pluck('id')
                ->toArray();

            AppNotifications::whereNotIn('id', $idsToKeep)->delete();
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Failed: ' . $e->getMessage()];
        }
        // Send notification via Firebase
        return app('firebase')->sendToDevice($deviceTokens->first()->device_token, $title, $body, $data);
    }
    /**
     * Send notification to all users
     */
    public static function sendToAllUsers($title, $body, $data = [])
    {
        $deviceTokens = DeviceToken::getAllActiveTokens();

        if ($deviceTokens->isEmpty()) {
            return ['status' => 'error', 'message' => 'No active device tokens found'];
        }
        $tokens = $deviceTokens->map(function ($token) {
            return [
                'token' => $token->device_token,
                'user_id' => $token->user_id,
            ];
        });
        $batches = $tokens->chunk(500); // FCM limit
        $results = [];
        foreach ($batches as $batch) {
            foreach ($batch as $tokenData) {
                try {
                    $appNotification = new AppNotifications();
                    $appNotification->user_id = $tokenData['user_id'];
                    $appNotification->title = $title;
                    $appNotification->description = $body;
                    $appNotification->status = "unread";
                    $appNotification->created_at = Carbon::now();
                    $appNotification->updated_at = Carbon::now();
                    $appNotification->save();

                    // Keep only the latest 300 notifications
                    $idsToKeep = AppNotifications::orderBy('created_at', 'desc')
                        ->limit(300)
                        ->pluck('id')
                        ->toArray();

                    AppNotifications::whereNotIn('id', $idsToKeep)->delete();
                } catch (Exception $e) {
                    return ['status' => 'error', 'message' => 'Failed: ' . $e->getMessage()];
                }

                $results[] = app('firebase')->sendToDevice($tokenData['token'], $title, $body, $data);
            }
        }
        return $results;
    }
    /**
     * Send notification to topic
     */
    public static function sendToTopic($topic, $title, $body, $data = [])
    {
        return app('firebase')->sendToTopic($topic, $title, $body, $data);
    }
    /**
     * Register device token
     */
    public static function registerDeviceToken($userId, $deviceToken, $deviceType = 'android', $appVersion = null)
    {
        return DeviceToken::registerToken($userId, $deviceToken, $deviceType, $appVersion);
    }
    /**
     * Subscribe user to topic
     */
    public static function subscribeUserToTopic($userId, $topic)
    {
        $deviceTokens = DeviceToken::getActiveTokensForUser($userId);

        if ($deviceTokens->isEmpty()) {
            return ['status' => 'error', 'message' => 'No active device tokens found for user'];
        }

        $tokens = $deviceTokens->pluck('device_token')->toArray();

        return app('firebase')->subscribeToTopic($tokens, $topic);
    }
}
