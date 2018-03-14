<?php 

namespace App\Observers;

use App\Workshop;
use App\Admin;
use App\Notifications\NewWorkshop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Notification;

class WorkshopObserver
{
	public function saving(Workshop $workshop)
    {
    	$admins = Admin::all();
    	Notification::send($admins, new NewWorkshop($workshop));
    }

}