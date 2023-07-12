<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;


class ServiceDetailVideo extends Model
{
    protected $table='service_detail_videos';

    protected $fillable=['detil_id','title','link'];
 
    public function poster()
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    public function detail()
    {
        return $this->belongsTo(ServiceDetail::class,'id','detil_id');
    }

    public function destroyVideo()
    {
        //remove video file
        if($this->link!=null)
        {
            $this->remove_video($this->link);
        }

        //remove video poster
        if($this->poster!=null)
        {
            $this->poster->destroyImage();
        }
        $this->delete();
        return back();
    }

    public function remove_video($link)
    {
        $home = url('/').'/';

        $file = str_replace($home,'',$link);
        if(file_exists($file))
        {
            File::delete($file);
        }
    }


}
