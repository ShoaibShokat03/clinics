<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    protected $fillable = [
        'user_id',
        'device_token',
        'device_type',
        'app_version',
        'status'
    ];

    public static function getActiveTokenForUser($userId)
    {
        return self::where('user_id', $userId)
            ->where('status', 'active')
            ->get();
    }
    public static function getAllActiveTokens()
    {
        return self::where('status', 'active')->get();
    }
    public static function getActiveTokensForUser($userId)
    {
        return self::where('user_id', $userId)
            ->where('status', 'active')
            ->get();
    }
    public static function registerToken($userId, $deviceToken, $deviceType = 'android', $appVersion = null)
    {
        return self::updateOrCreate(
            ['user_id' => $userId, 'device_token' => $deviceToken],
            ['device_type' => $deviceType, 'app_version' => $appVersion, 'status' => 'active']
        );
    }
}
