<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function markOneAsRead()
    {
        if (Auth::guard('admin')->check())
        {
            Auth::guard('admin')->user()->unreadNotifications->where('id',$_GET['id'])->markAsRead();

            echo true;
        }
    }
}
