<?php 

namespace App\Observers;

use App\WorkshopImages;
use Illuminate\Support\Facades\Storage;

class WorkshopImagesObserver
{
	public function deleting(WorkshopImages $image)
    {	    	    	        
		Storage::disk('s3')->delete($image->url);
    }

}