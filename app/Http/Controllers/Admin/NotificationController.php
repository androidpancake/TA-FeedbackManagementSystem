<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        if(auth()->user()->unreadNotifications){
            foreach(auth()->user()->unreadNotifications as $notification){
                $notification->markAsRead();

                
            }
        }
        return view('admin.notification.index', compact('notifications'));
    }
}
