<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Enums\Status;


class DepartmentController extends Controller
{
   
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('departments.index');

        $departments = Department::orderby('name','asc')->get();
        return view('admin.department.all',compact('departments'));
    }

 
    public function create()
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('departments.create');

        return view('admin.department.create');
    }
 
    public function store(Request $request)
    { 
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('departments.create');

        $this->validate($request,
            [
                'name' => ['required','max:255','unique:departments,name'],
                'status' => ['required'],
            ],
            [
                'name.required' => '* عنوان واحد الزامی است.',
                'name.unique' => '* تکراری است',
                'name.max' => '* حداکثر طول تعداد کارکترهای عنوان 255 عدد  می باشد.',
                'status.required' => '* تعیین وضعیت الزامی است.',
            ]
        );

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            Department::create(["name"=>$request->name,"status"=>$request->status]);
        }

        toast('واحد جدید افزوده شد.','success')->position('bottom-end'); 

        return redirect(route('admin.departments.index'));
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit(Department $department)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('departments.edit');

        return view('admin.department.edit',compact('department'));
    }

 
    public function update(Department $department,Request $request)
    {
        
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('departments.update');

        $this->validate($request,
            [
                'name' => ['required','max:255','unique:departments,name,'.$department->id],
                'status' => ['required'],
            ],
            [
                'name.required' => '* عنوان واحد الزامی است.',
                'name.unique' => '* تکراری است',
                'name.max' => '* حداکثر طول تعداد کارکترهای عنوان 255 عدد  می باشد.',
                'status.required' => '* تعیین وضعیت الزامی است.',
            ]
        );

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            $department->update(["name"=>$request->name,"status"=>$request->status]);
        }

        toast('بروزرسانی انجام شد.','success')->position('bottom-end'); 

        return redirect(route('admin.departments.index'));
    }

  
    public function destroy(Department $department)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('departments.delete');

        $department->delete();
        toast('واحد مورد نظر حذف شد.','error')->position('bottom-end'); 
        return back();
    }
}
