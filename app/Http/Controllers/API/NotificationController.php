<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __invoke()
    {
        $notifications = Auth::user()->unreadNotifications;
        $countNotifications = count($notifications);
        // if (!$notifications) return response()->json(['Notifications' => 'Not Fount'], 404, []);
        return response()->json(['notifications' => $notifications, 'count' => $countNotifications], 200, []);
    }
}
