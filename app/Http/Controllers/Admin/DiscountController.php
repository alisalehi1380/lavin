<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\User;
use App\Models\Level;
use App\Enums\Status;
use App\Enums\DiscountType;
use App\Models\Product;
use App\Models\Service;
use Validator;
use App\Services\FunctionService;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Redirect;
use \Morilog\Jalali\Jalalian;
class DiscountController extends Controller
{
    private $fuctionService;
    public function __construct()
    {
        $this->fuctionService = new FunctionService();
    }
  
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('discounts.index');

        $users = User::orderBy('firstname','asc')->orderBy('lastname','asc')->get();
        $levels = Level::orderBy('point','desc')->get();
      
        $discounts = Discount::withTrashed()->orderBy('created_at','desc')->filter()->paginate(10);
        return view('admin.discount.all',compact('discounts','users','levels'));
    }

  
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('discounts.create');


        return view('admin.discount.create');
    }

     
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('discounts.create');

        if($request->unit == DiscountType::percet && ($request->value>100 || $request->value<0))
        {
            Validator::extend('percent_validator',function(){return false;});
        }
        else
        {
            Validator::extend('percent_validator',function(){return true;});
        }

        $request->validate(
        [   
            "code"=>['required','max:20','unique:discounts'],
            "unit"=>['required','integer'],
            "value"=>['required','percent_validator','regex:/^[0-9]+$/'],
            "status"=>['required','integer'],
        ],
        [
            "code.required"=>"* الزامی است.",
            "code.max"=>"* حداکثر 20 کارکتر.",
            "code.unique"=>"* قبلا ثبت شده است.",
            "value.required"=>"* .الزامی است",
            "value.percent_validator"=>"* بین صفر تا 100 درصد",
            "value.regex"=>"* لطفا مقدار عددی وارد کنید",

        ]);

        if(($request->unit == DiscountType::percet || $request->unit == DiscountType::toman)
           &&($request->status == Status::Active || $request->status == Status::Deactive))
        {
            $expire =null;

            if(isset($request->expire))
            {
                $expire =  $this->fuctionService->faToEn($request->expire);
                $expire = Jalalian::fromFormat('Y/m/d H:i:s', $expire)->toCarbon("Y-m-d H:i:s");
            }

            Discount::create([
                'code'=>$request->code,
                'unit'=>$request->unit,
                'expire'=>$expire,
                'value'=>$request->value,
                'status'=>$request->status,
            ]);

            toast('کد تخفیف جدید ثبت شد. ','success')->position('bottom-end');        
        }

       return redirect(route('admin.discounts.index'));
    }
 
    public function show($id)
    {
        //
    }

 
    public function edit(Discount $discount)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('discounts.edit');

        return view('admin.discount.edit',compact('discount'));
    }
 

    public function update(Request $request,Discount $discount)
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('discounts.edit');

        if($request->unit == DiscountType::percet && ($request->value>100 || $request->value<0))
        {
            Validator::extend('percent_validator',function(){return false;});
        }
        else
        {
            Validator::extend('percent_validator',function(){return true;});
        }

        $request->validate(
        [   
            "code"=>['required','max:20','unique:discounts,code,'.$discount->id],
            "unit"=>['required','integer'],
            "value"=>['required','percent_validator','regex:/^[0-9]+$/'],
            "status"=>['required','integer'],
        ],
        [
            "code.required"=>"* الزامی است.",
            "code.max"=>"* حداکثر 20 کارکتر.",
            "code.unique"=>"* قبلا ثبت شده است.",
            "value.required"=>"* .الزامی است",
            "value.percent_validator"=>"* بین صفر تا 100 درصد",
            "value.regex"=>"* لطفا مقدار عددی وارد کنید",

        ]);
        
        if(($request->unit == DiscountType::percet || $request->unit == DiscountType::toman)
           &&($request->status == Status::Active || $request->status == Status::Deactive))
        {
            $expire =null;

            if(isset($request->expire))
            {
                $expire =  $this->fuctionService->faToEn($request->expire);
                $expire = Jalalian::fromFormat('Y/m/d H:i:s', $expire)->toCarbon("Y-m-d H:i:s");
            }

            $discount->update([
                'code'=>$request->code,
                'unit'=>$request->unit,
                'expire'=>$expire,
                'value'=>$request->value,
                'status'=>$request->status,
            ]);

            toast('بروزرسانی انجام شد.','success')->position('bottom-end');        
        }

        return redirect(route('admin.discounts.index'));
    }

   
    public function destroy(Discount $discount)
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('discounts.destroy');

        $discount->delete();
        toast('کد تخفیف مورد نظر حذف شد.','error')->position('bottom-end'); 
        return back();       
    }


    public function recycle($id)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('discounts.destroy');
                 
        $service = Discount::withTrashed()->find($id);
        $service->restore();
        toast('کد تخفیف مورد نظر بازیابی  شد.','error')->position('bottom-end');        
        return back();
    }

    public function code()
    {
         $code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,10);
         $discount = Discount::where('code',$code)->first();
         if($discount!=null)
         {
            return $this->code();
         }

        return response()->json(['code'=>$code],200);
    }

    public function users_show(Discount $discount)
    {        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('discounts.show');

        $discount = Discount::with('users')->find($discount->id);
        $users = User::orderBy('firstname','asc')->orderBy('lastname','asc')->get();
        $levels = Level::where('status',Status::Active)->orderBy('point','asc')->get();
        return view('admin.discount.users',compact('users','levels','discount'));
    }

    public function users_update(Request $request,Discount $discount)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('discounts.create');

        $request->validate(
        [   
            "users"=>['required'],
        ],
        [
            "users.required"=>"* الزامی است.",
        ]);
 
        $discount->users()->sync($request->users);

        return redirect(route('admin.discounts.index'));
    }
   
    public function services_show(Discount $discount)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('discounts.show');

        $discount = Discount::with('services')->find($discount->id);
        $services = Service::with('details')->whereHas('details',function($q){
            $q->orderBy('name','asc');
        })->where('status',Status::Active)->orderBy('name','asc')->get();

        $products = Product::where('status',Status::Active)->orderBy('name','asc')->get();
 
        return view('admin.discount.services',compact('services','discount','products'));
    }

    public function services_update(Request $request,Discount $discount)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('discounts.create');

        $request->validate(
        [   
            "services"=>['required'],
        ],
        [
            "services.required"=>"* الزامی است.",
        ]);
 
        if(isset($request->services))
        {
            $discount->services()->sync($request->services);
        }

        if(isset($request->products))
        {
            $discount->products()->sync($request->products);
        }
        

        return redirect(route('admin.discounts.index'));
    }
}
