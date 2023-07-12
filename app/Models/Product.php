<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Image;
use Carbon\Carbon;
use App\Enums\ProductSortType;

class Product extends Model
{
    use Sluggable;
    use SoftDeletes;

    protected $fillable=['name','slug','parent','child','description','attributes',
    'price','stock','special','specialDateTime','specialPrice','status'];

    public function parent_cat()
    {
        return $this->hasOne(ProductCategory::class,'id','parent');
    }

    public function child_cat()
    {
        return $this->hasOne(ProductCategory::class,'id','child');
    }

    public function thumbnail()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function get_thumbnail($size)
    {
        return url('/').'/'.$this->thumbnail->path.$this->thumbnail->name[$size];
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function reviews()
    {
       return  $this->morphMany(Review::class,'reviewable');
    }

    public function specialDays()
    {
        $now = Carbon::now()->format('Y-m-d');
        $datework = Carbon::createFromDate($this->specialDateTime);
        $days = $datework->diffInDays($now);
        return $days;
    }

    public function scopeFilter1($query)
    {
        
        $name = request('name');
        if(isset($name) && $name !='')
        {
            $query->where('name','like','%'.$name.'%');
        }

        $category = request('category');
        if(isset($category) && $category !='')
        {
            $query->where('parent',$category);
        }

        $child = request('child');
        if(isset($child) && $child !='')
        {
            $query->where('child',$child);
        }

        $sort = request('sort');
        if(isset($sort))
        {
            switch($sort)
            {
                case  ProductSortType::Newests : $query->orderBy('created_at','desc');break;
                case  ProductSortType::Cheapests : $query->orderBy('price','asc');break;
                case  ProductSortType::MostExpinsives : $query->orderBy('price','desc');break;
            }
        }

        return $query;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
