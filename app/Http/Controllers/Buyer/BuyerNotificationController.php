<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class BuyerNotificationController extends Controller
{
    /**
     * Hiển thị danh sách thông báo theo vai trò người dùng
     * (Admin/Seller/Buyer tùy route sử dụng)
     *
     * Gợi ý route: GET /notifications
     */
    public function index()
    {
        $notifications = Notification::where('role', Auth::user()->role)
                            ->orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();

        return view('notifications.index', compact('notifications'));
    }
}
