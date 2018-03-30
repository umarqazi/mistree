<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Workshop;
use View;

class NotificationsController extends Controller
{
    public function markOneAsRead()
    {
        if (Auth::guard('admin')->check())
        {
            Auth::guard('admin')->user()->unreadNotifications->where('id',$_GET['id'])->markAsRead();

            echo true;
        }
        elseif (Auth::guard('workshop')->check())
        {
            Auth::guard('workshop')->user()->unreadNotifications->where('id',$_GET['id'])->markAsRead();

            echo true;
        }
    }

    public function index()
    {
        return View::make('notification.index');
    }
}
