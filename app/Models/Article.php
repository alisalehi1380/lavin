<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\FunctionService;
use App\Enums\CommentStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use \Morilog\Jalali\Jalalian;
use Morilog\Jalali\CalendarUtils;

class Article extends Model
{
    use SoftDeletes;
    use Sluggable;  
  
    protected $fillable = ['autor_id','title','slug','content','publishDateTime','tags','status'];
 
    public function autor()
    {
        return $this->belongsTo(Admin::class);
    }
 
    public function categories()
    {
        return $this->belongsToMany(ArticleCategories::class);
    }

    public function get_thumbnail($size)
    {
        return url('/').'/'.$this->thumbnail->path.$this->thumbnail->name[$size];
    }

    public function publish_date_time()
    {
       return CalendarUtils::convertNumbers(CalendarUtils::strftime('H:i:s - Y/m/d',strtotime($this->publishDateTime)));
    }

    public function publish_date()
    {
       return CalendarUtils::convertNumbers(CalendarUtils::strftime('d %B Y',strtotime($this->publishDateTime)));
    }

  

    public function scopeFilter($query)
    {
         //فیلتر عنوان
         $title = request('title');
         if(isset($title) &&  $title!='')
         {
             $query->where('title','like', '%'.$title.'%');
         }

       //فیلتر وضعیت
        $status = request('status');
        if(isset($status) &&  $status!='')
        {
            $query->where('status',$status);
        }

         //فیلتر زمان انتشار از
         $since = request('since');
         if(isset($since) &&  $since!='')
         {
            $since =  $this->fuctionService->faToEn($since);
            $since = Jalalian::fromFormat('Y/m/d H:i:s', $since)->toCarbon("Y-m-d H:i:s");
             $query->where('publishDateTime','>=', $since);
         }

        //فیلتر زمان انتشار تا
        $until = request('until');
        if(isset($until) &&  $until!='')
        {
            $until =  $this->fuctionService->faToEn($until);
            $until = Jalalian::fromFormat('Y/m/d H:i:s', $until)->toCarbon("Y-m-d H:i:s");
            $query->where('publishDateTime','<=', $until);
        }

        //فیلتر محتوا
        $content = request('content');
        if(isset($content) &&  $content!='')
        {
            $query->where('content','like', '%'.$content.'%');
        }

        $category = request('category');
        if(isset($category) && $category!='')
        {
            $query->whereHas('categories',function($qc) use($category){
                $qc->where('slug',$category);
            });
        }

        $tag = request('tag');
        if(isset($tag) && $tag!='')
        {
            $query->where('tags','like','%'.$tag.'%');
        }

        return $query;
    }

    public function thumbnail()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getThumbnail()
    {
        return Image::where('imageable_id',$this->id)->where('imageable_type',get_class($this))->first(['name','alt','title']);
    }

    
    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable')->where('approved',CommentStatus::approved);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
 

}
