<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        $groupedNotification = $notifications->groupBy(function ($notification){
            return Carbon::parse($notification->created_at)->format('j F Y');
        });
        // dd($notifications);
        // if(auth()->user()->unreadNotifications){
        //     foreach(auth()->user()->unreadNotifications as $notification){
        //         $notification->markAsRead();
        //     }
        // }
        
        return view('dosen.notification.index', compact('notifications', 'groupedNotification'));
    }

    public function markAsRead($id)
    {   
        $notification = auth()->user()->notifications->find($id);

        if($notification) {
            $notification->markAsRead();
            return redirect($notification->data['url']);
        }

        return redirect()->back();
    }
}
