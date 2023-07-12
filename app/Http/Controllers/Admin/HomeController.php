<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Permission;
use App\Models\Province;
use App\Models\ServiceDetail;
use App\Models\User;
use App\Models\ServiceReserve;
use App\Models\ReservePayment;
use App\Models\Order;
use App\Models\Admin;
use App\Models\Level;
use App\Models\Ticket;
use App\Models\Review;
use App\Enums\Status;
use App\Enums\PaymentStatus;
use App\Enums\DeliveryStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UxWeb\SweetAlert\SweetAlert;
use App\Http\Resources\ServiceCollection;
use App\Http\Resources\DoctorCollection;

class HomeController extends Controller
{
     public function dashboard()
     {
            
        //اجازه دسترسی
        //  config(['auth.defaults.guard' => 'admin']);
        //  $this->authorize('dashboard'); 

        $reserves = ServiceReserve::whereHas('payment',function($q){
          $q->where('status',PaymentStatus::paid);
        })->filter()->count();

        $reservesSum = ReservePayment::where('status',PaymentStatus::paid)
        ->whereHas('reserve',function($q){
          $q->filter();
        })->sum('price');

   

        $orders = Order::where([['status',PaymentStatus::paid],['delivery','<>',DeliveryStatus::repay]])->filter()->count();
        $ordersSum = Order::where([['status',PaymentStatus::paid],['delivery','<>',DeliveryStatus::repay]])->filter()->sum('price');
  
        $users = User::filter()->count();
        $doctors = Admin::whereHas('roles', function($q){$q->where('name', 'doctor');})->filter()->count();
        $tickets = Ticket::FilterDashboard()->count();
        $reviews = Review::filter()->count();

        $levels = Level::all();

  
        $doctorsList = Admin::whereHas('roles', function($q){$q->where('name', 'doctor');})->get();
    
        
         return view('admin.dashboard',
         compact('reserves','reservesSum','levels','orders','ordersSum','users','doctors','tickets','reviews','doctorsList'));
     }

     
    public function fetch_cities()
    {
        $provance_id = request('provance_id');
        $cities = City::where('province_id',$provance_id)->get();
        return response()->json(['cities'=>$cities],200);
    }

    public function servicefetch()
    {
      $keyword = request('term');
      if(isset($keyword) && strlen($keyword)>2)
      {
        $services = ServiceDetail::where('name','like','%'.$keyword.'%')->get();
      }
      else
      {
         return null;
      }
      
      return new ServiceCollection($services);
    }

    public function detailsfetch()
    {
        $service = request('service');
        $details = ServiceDetail::where('status',Status::Active)->where('service_id',$service)
        ->orderBy('name','asc')->get();

        return response()->json(['details'=>$details],200);
    }  

    public function doctorsfetch()
    {
       $service = request('service');
       $service = ServiceDetail::with('doctors')->find($service);
       $docors = new DoctorCollection($service->doctors);
       return response()->json(['doctors'=>$docors],200);
    }   
 
}
