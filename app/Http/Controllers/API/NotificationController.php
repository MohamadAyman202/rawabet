<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function __invoke()
    {
        $notifications = Auth::user()->unreadNotifications;
        $countNotifications = count($notifications);
        // if (!$notifications) return response()->json(['Notifications' => 'Not Fount'], 404, []);
        return response()->json(['notifications' => $notifications, 'count' => $countNotifications], 200, []);
    }

    public function readyNotifications($id)
    {
        $notifications = auth()->user()->unreadNotifications->where('id', $id)->first();
        if ($notifications) {
            $notificationData = $notifications->data['data'];
            $notifications->markAsRead();
            return to_route('product_details', $notificationData['slug']);
        }
        return response()->json(['msg' => 'Error'], 500, []);
    }
}
