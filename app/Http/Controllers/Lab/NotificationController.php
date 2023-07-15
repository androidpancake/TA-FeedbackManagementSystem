<?php

namespace App\Http\Controllers\Lab;

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
        
        return view('lab.notification.index', compact('notifications'));
    }
}
