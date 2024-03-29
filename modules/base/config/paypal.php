<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/17/2018
 * Time: 11:06 AM
 */

return [
    // Client ID của app mà bạn đã đăng ký trên PayPal Dev
    'client_id' => env('PAYPAL_CLIENT_ID'),
    // Secret của app
    'secret' => env('PAYPAL_SECRET'),
    'settings' => [
        // PayPal mode, sandbox hoặc live
        'mode' => env('PAYPAL_MODE'),
        // Thời gian của một kết nối (tính bằng giây)
        'http.ConnectionTimeOut' => 30,
        // Có ghi log khi xảy ra lỗi
        'log.logEnabled' => true,
        // Đường dẫn đền file sẽ ghi log
        'log.FileName' => storage_path() . '/logs/paypal.log',
        // Kiểu log
        'log.LogLevel' => 'FINE'
    ],
];