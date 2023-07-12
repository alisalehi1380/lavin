<?php

namespace App\Providers;

use App\Enums\seenStatus;
use Illuminate\Support\ServiceProvider;
use App\Models\Service;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\View;
use App\Enums\Status;
use App\Models\Notification;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['*'], function($view)
        {
            // $services = Service::with('details')->where('status',Status::Active)
            // ->whereHas('details')->orderBy('name','asc')->get();
            
            $services = Service::with('details')->where('status',Status::Active)->orderBy('name','asc')->get();
            
            $productCategories = ProductCategory::where('status',Status::Active)->where('parent_id',0)->orderBy('name','asc')->get();

            $noteFicationCount=0;
            if(Auth::check())
            {
                $noteFicationCount = Notification::whereHas('users',function($q){
                    $q->where('user_id',Auth::id())->where('seen',seenStatus::unseen);
                })->count();
            }

            $view->with([
                'services'=>$services,
                'productCategories'=>$productCategories,
                'noteFicationCount'=>$noteFicationCount
            ]);
        });
                    
    }
}
