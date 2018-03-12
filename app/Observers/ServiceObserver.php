<?php

namespace App\Observers;

use App\Service;
use Session;

class ServiceObserver
{
    /**
     * Listen to the Service created event.
     *
     * @param  \App\Service  $service
     * @return void
     */
    public function created(Service $service)
    {
        $inactive_services  = Service::onlyTrashed()->where('name',$service->name)->where('is_doorstep',$service->is_doorstep)->get();
        foreach($inactive_services as $inactive_service)
        {
            $inactive_service->forcedelete();
        }
    }

    /**
     * Listen to the Service deleting event.
     *
     * @param  \App\Service  $service
     * @return void
     */
    public function deleting(Service $service)
    {
        foreach($service->services as $child)
        {
            $child->service_parent  = !is_null($service->parent($service->service_parent))?$service->parent($service->service_parent)['id']:0;
            $child->update();
        }
    }
}