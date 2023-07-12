<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\User;
use App\Enums\Status;

class LevelController extends Controller
{
 
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('levels.index');

       $levels = Level::orderBy('point','desc')->withTrashed()->get();
       return view('admin.levels.all',compact('levels'));
    }

 
    public function create()
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('levels.create');

        return view('admin.levels.create');
    }
 
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('levels.create');

        $request->validate(
        [   
            "title"=>['required','max:255','unique:levels'],
            "point"=>['required','regex:/^[0-9]+$/','unique:levels'],
            "status"=>['required','integer'],
        ],
        [
            "title.required"=>"* الزامی است.",
            "title.max"=>"* حداکثر 255 کارکتر.",
            "title.unique"=>"* قبلا ثبت شده است.",
            "point.unique"=>"* برای سطح دیگری ثبت شده است.",
            "point.regex"=>"* لطفا مقدار عددی وارد کنید",
            "required.required"=>"* .الزامی است",
        ]);

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            Level::create([
                'title'=> $request->title,
                'point'=> $request->point,
                'status'=> $request->status
            ]);
        }
        
        toast('.سطح جدید ثبت شد','success')->position('bottom-end');        
        return redirect(route('admin.levels.index'));
    }

 
    public function show($id)
    {
        //
    }

 
    public function edit(Level $level)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('levels.edit');

        return view('admin.levels.edit',compact('level'));
    }

    
    public function update(Request $request,Level $level)
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('levels.edit');

        $request->validate(
        [   
            "title"=>'required|max:255|unique:levels,title,'.$level->id,
            "point"=>'required|regex:/^[0-9]+$/|unique:levels,point,'.$level->id,
            "status"=>'required|integer',
        ],
        [
            "title.required"=>"* الزامی است.",
            "title.max"=>"* حداکثر 255 کارکتر.",
            "title.unique"=>"* قبلا ثبت شده است.",
            "point.unique"=>"* برای سطح دیگری ثبت شده است.",
            "point.regex"=>"* لطفا مقدار عددی وارد کنید",
            "required.required"=>"* .الزامی است",
        ]);


        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            $level->update([
                'title'=> $request->title,
                'point'=> $request->point,
                'status'=> $request->status
            ]);
        }
        
        toast('بروزرسانی انجام شد.','success')->position('bottom-end');        
        return redirect(route('admin.levels.index'));
    }

  
    public function destroy(Level $level)
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('levels.destroy');

        $level->delete();
        toast('سطح مورد نظر حذف  شد.','error')->position('bottom-end');        
        return redirect(route('admin.levels.index'));
    }

    public function recycle($id)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('levels.destroy');

        $level = Level::withTrashed()->find($id);
        $level->restore();
        toast('سطح مورد نظر بازیابی  شد.','error')->position('bottom-end');        
        return redirect(route('admin.levels.index'));
    }

    public function users()
    {
        $array =array();
        $levels = request('levles');
        $levels = explode(',',$levels);
         
         for($i=0;$i<count($levels);$i++)
         {
            array_push($array,$levels[$i]);
         }
 
        $users = User::whereIn('level_id',$array)->orderBy('firstname','asc')->orderBy('lastname','asc')->get();
        $selected = $users->pluck('id');

        return response()->json(['selected'=>$selected],200);
    }
}
