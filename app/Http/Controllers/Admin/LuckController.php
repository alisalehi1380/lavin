<?php

namespace App\Http\Controllers\Admin;
use App\Enums\Status;
use App\Models\Service;
use App\Models\Luck;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Validator;

class LuckController extends Controller
{
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('luck.index');

        $lucks = Luck::with('lucktable')->orderBy('probability','desc')->get();
        return view('admin.luck',compact('lucks'));
    }

    public function store(Request $request)
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('luck.store');

        $pr=0;
        if(isset($request->probability))
        {
            $pr = $request->probability;
        }
        $probability = luck::sum('probability')+$pr;
        if($probability>100)
        {
            Validator::extend('percent_validator',function(){return false;});
        }
        else
        {
            Validator::extend('percent_validator',function(){return true;});
        }

        $request->validate(
        [
            "service"=>['required','integer'],
            "detail"=>['required','integer','unique:lucks,detail_id'],
            "probability"=>['required','regex:/^[0-9]+$/','digits_between:0,100','percent_validator'],
            "discount"=>['required','regex:/^[0-9]+$/','digits_between:0,100']
        ],
        [
            "service.required"=>"* انتخاب سرویس الزامی است.",
            "detail.required"=>"* انتخاب جزئیات سرویس الزامی است.",
            "detail.unique"=>"* جزئیات این سرویس قبلا ثبت شده است.",
            "probability.required"=>"* احتمال برد الزامی است..",
            "probability.regex"=>"* احتمال برد باید عددی بین 0 تا صد باشد.",
            "probability.digits_between"=>"* احتمال برد باید بین 0 تا صد باشد.",
            "probability.percent_validator"=>"* مجموع احتمالات نبایداز 100% بیشتر باشد.",
            "discount.required"=>"* درصد تخفیف الزامی است.",
            "discount.regex"=>"* احتمال تخفیف باید عددی بین 0 تا صد باشد.",
            "discount.digits_between"=>"* احتمال تخفیف باید عددی بین 0 تا صد باشد.",
        ]);

        Luck::create([
            'service_id' => $request->service,
            'detail_id' => $request->detail,
            'probability' => $request->probability,
            'discount' => $request->discount,
        ]);

        return redirect(route('admin.luck.index'));
    }


    public function update(Request $request,Luck $luck)
    {
        
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('luck.update');

        $pr=0;
        if(isset($request->probability))
        {
            $pr = $request->probability;
        }
        $probability = luck::sum('probability')+$pr;
        if($probability>100)
        {
            Validator::extend('percent_validator',function(){return false;});
        }
        else
        {
            Validator::extend('percent_validator',function(){return true;});
        }

        $request->validate(
            [
                "probability"=>['required','regex:/^[0-9]+$/','digits_between:0,100','percent_validator'],
                "discount"=>['required','regex:/^[0-9]+$/','digits_between:0,100']
            ],
            [
                "probability.required"=>"* احتمال برد الزامی است..",
                "probability.regex"=>"* احتمال برد باید عددی بین 0 تا صد باشد.",
                "probability.digits_between"=>"* احتمال برد باید بین 0 تا صد باشد.",
                "probability.percent_validator"=>"* مجموع احتمالات نبایداز 100% بیشتر باشد.",
                "discount.required"=>"* درصد تخفیف الزامی است.",
                "discount.regex"=>"* احتمال تخفیف باید عددی بین 0 تا صد باشد.",
                "discount.digits_between"=>"* احتمال تخفیف باید عددی بین 0 تا صد باشد.",
            ]);

            $luck->update([
                'probability' => $request->probability,
                'discount' => $request->discount,
            ]);

            toast('بروزرسانی با موفقیت انجام شد.','success')->position('bottom-end');
            return redirect(route('admin.luck.index'));

    }

    public function destroy(Luck $luck)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('luck.destroy');

               
        $luck->delete();
        return  back();
    }
}
