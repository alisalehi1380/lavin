<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Enums\Status;
use Illuminate\Validation\Rule;

class JobController extends Controller
{ 
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('jobs.index');

        $jobs = Job::orderBy('title','asc')->withTrashed()->paginate(10);
        return view('admin.jobs.all',compact('jobs'));
    }

  
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('jobs.create');

        return view('admin.jobs.create');
    }

 
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('jobs.create');

        $request->validate(
        [   
            "title"=>['required','max:255','unique:jobs'],
        ],
        [
            "title.required"=>"* الزامی است.",
            "title.max"=>"* حداکثر 255 کارکتر",
            "title.unique"=>"* تکراری است.",
        ]);

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            Job::create([
                'title'=> $request->title,
                'status'=> $request->status,
             ]);

             toast('شغل جدید ثبت شد.','success')->position('bottom-end');
        }

        return  redirect(route('admin.jobs.index'));
    }

 
    public function show($id)
    {
        //
    }
 
    public function edit(Job $job)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('jobs.edit');

        return view('admin.jobs.edit',compact('job'));
    }
 
    public function update(Request $request,Job $job)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('jobs.edit');

        $request->validate(
        [   
            "title"=>['required','max:255',Rule::unique('jobs')->ignore($job->id)],
        ],
        [
            "title.required"=>"* الزامی است.",
            "title.max"=>"* حداکثر 255 کارکتر",
            "title.unique"=>"* تکراری است.",
        ]);
 

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            $job->update([
                'title'=> $request->title,
                'status'=> $request->status,
             ]);

            toast('بروزرسانی انجام شد.','success')->position('bottom-end');
        }

        return  redirect(route('admin.jobs.index'));
    }

 
    public function destroy(Job $job)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('jobs.destroy');

        $job->delete();
        toastr()->error('شغل  مورد نظر حذف  شد.');
        return redirect(route('admin.jobs.index'));
    }

    public function recycle($id)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('jobs.destroy');


        $admin = Job::withTrashed()->find($id);
        $admin->restore();
        toast('شغل مورد نظر بازیابی شد.','error')->position('bottom-end');
        return back();
    }
}
