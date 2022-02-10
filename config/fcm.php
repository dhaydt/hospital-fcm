<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAFhS4gQE:APA91bGqQ7NDoEieUd6hRvRJagJ-nnxWBp7fuh7Z1Qmz8Z7O2NRTwG2hFj-BOf3-xpYATs7RLN5aSScaLUgND1ghyjEChXqdMQFsJNS-vvu_YvIZ-_Hiuwpv6FfSazM4kdKV36Glg0p7'),
        'sender_id' => env('FCM_SENDER_ID', 'Your sender id'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
