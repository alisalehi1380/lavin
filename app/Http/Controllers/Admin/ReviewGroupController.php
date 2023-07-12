<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewGroup;
use App\Enums\ReviewGroupType;
use Validator;


class ReviewGroupController extends Controller
{
 
    public function index()
    {
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reviewgroup.index');

       $groups = ReviewGroup::orderBy('created_at','desc')->get();
       return view('admin.reviews.groups.all',compact('groups'));
    }
 
    public function create()
    {
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reviewgroup.create');

        return view('admin.reviews.groups.create');
    }

 
    public function store(Request $request)
    {
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reviewgroup.create');

        $group = ReviewGroup::where('type',$request->type)->where('title',$request->title)->first();
        if($group==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }

        $request->validate([
            'title'=>'required|max:255|unique_validator',
        ],
        [
            'title.required'=>'* الزامی است.',
            'title.max'=>'* حداکثر 255 کارکتر.',
            'title.unique_validator'=>'* تکراری است.',
        ]);

        if($request->type==ReviewGroupType::Service || $request->type==ReviewGroupType::Shop)
        {
            ReviewGroup::create([
                'title'=>$request->title,
                'type'=>$request->type,
                'status'=>$request->status,
            ]);

            toast('.گروه بازخورد جدید ثبت شد','success')->position('bottom-end');        
        }
   
        return redirect(route('admin.rewiewGroups.index'));
    }
 
    public function show(ReviewGroup $group)
    {
      
    }
 
    public function edit(ReviewGroup $group)
    {
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reviewgroup.edit');

        return view('admin.reviews.groups.edit',compact('group'));
    }
 
    public function update(Request $request,ReviewGroup $group)
    {
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reviewgroup.edit');
        
        $gr = ReviewGroup::where('type',$request->type)->where('title',$request->title)
        ->where('id','<>',$group->id)->first();

        if($gr==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }
        $request->validate([
            'title'=>'required|max:255|unique_validator',
        ],
        [
            'title.required'=>'* الزامی است.',
            'title.max'=>'* حداکثر 255 کارکتر.',
            'title.unique_validator'=>'* تکراری است.',
        ]);

        if($request->type==ReviewGroupType::Service || $request->type==ReviewGroupType::Shop)
        {
            $group->update([
                'title'=>$request->title,
                'type'=>$request->type,
                'status'=>$request->status,
            ]);

            toast('.بروزرسانی انجام شد','success')->position('bottom-end'); 
        }
       
        return redirect(route('admin.rewiewGroups.index'));
    }
 
    public function delete(ReviewGroup $group)
    {
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reviewgroup.destroy');

        $group->delete();
        toast('گروه بازخورد مورد نظر حذف شد.','error')->position('bottom-end');        
        return back();
    }
}
