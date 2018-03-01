<?php

namespace App\Observers;

use App\Service;

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
        //
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