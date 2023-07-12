<?php


namespace App\Services;


use DOMDocument;
use DOMXPath;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\ServiceReserve;
 
class ReserveService
{
    public function reserve($user_id,$service_id,$detail_id,$doctor_id)
    {
        $service = Service::find($service_id);
        $detail = ServiceDetail::find($detail_id);
 
        ServiceReserve::create([
            'user_id'=>$user_id,
            'service_id'=>$service->id,
            'service_name'=>$service->name,
            'detail_id'=> $detail->id,
            'detail_name'=> $detail->name,
            'doctor_id'=>$doctor_id,
        ]);
    }
}