<?php 

namespace App\Observers;

use App\WorkshopImages;
use Illuminate\Support\Facades\Storage;

class WorkshopImagesObserver
{
	public function deleting(WorkshopImages $image)
    {	
    	$s3_bucket_path = config('app.s3_bucket_url');
    	$file = str_replace($s3_bucket_path,"", $image->url);    	
    	if(Storage::disk('s3')->exists($file)){
			Storage::disk('s3')->delete($file);
    	} 
    }

}