<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        // dd($notifications);
        if(auth()->user()->unreadNotifications){
            foreach(auth()->user()->unreadNotifications as $notification){
                $notification->markAsRead();
            }
        }
        
        return view('dosen.notification.index', compact('notifications'));
    }
}
