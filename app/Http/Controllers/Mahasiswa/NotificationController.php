<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        // dd($notifications);
        // if(auth()->user()->unreadNotifications){
        //     foreach(auth()->user()->unreadNotifications as $notification){
        //         $notification->markAsRead();


        //     }
        // }

        return view('mahasiswa.notification.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications->find($id);

        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['url']);
        }

        return back();
    }
}
