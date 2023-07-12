<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use  Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceCategoryController extends Controller
{
 
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.index');

       $categories = ServiceCategory::where('parent_id',0)->orderBy('name','asc')->paginate(10);
       return view('admin.services.categories.all',compact('categories'));
    }
 
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.create');

        return view('admin.services.categories.create');
    }

  
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.create');
        
        $category = ServiceCategory::where('parent_id',0)->where('name',$request->name)->first();
        if($category==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }

        $request->validate(
        [
            'name' => ['required','max:255','unique_validator'],
            'status' => ['required','integer']
        ],
        [
            "name.required" => "* عنوان دسته را وارد نمایید.",
            "name.max" => "* حداکثر طول مجاز برای عنوان دسته 255 کارکتر است.",
            "name.unique_validator"=> "* این دسته قبلا ثبت شده است.",
        ]);

        ServiceCategory::create([
            "name"=>$request->name,
            'slug' => SlugService::createSlug(ServiceCategory::class, 'slug', $request->name),
            "status"=>$request->status,
        ]);

        toast('.دسته بندی جدید ثبت شد','success')->position('bottom-end');        
        return redirect(route('admin.services.categories.index'));
    }

  
    public function show($id)
    {
        //
    }

 
    public function edit(ServiceCategory $category)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.edit');
        
        return view('admin.services.categories.edit',compact('category'));
    }
 
    public function update(Request $request,ServiceCategory $category)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.edit');

        $cat = ServiceCategory::where('parent_id',0)->where('name',$request->name)->where('id','<>',$category->id)->first();
        if($cat==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }

        $request->validate(
        [
            'name' => ['required','max:255','unique_validator'],
            'status' => ['required','integer']
        ],
        [
            "name.required" => "* عنوان دسته را وارد نمایید.",
            "name.max" => "* حداکثر طول مجاز برای عنوان دسته 255 کارکتر است.",
            "name.unique_validator"=> "* این دسته قبلا ثبت شده است.",
        ]);

        $category->update([
            "name"=>$request->name,
            'slug' => SlugService::createSlug(ServiceCategory::class, 'slug', $request->name),
            "status"=>$request->status,
        ]);

        toast('.بروزرسانی انجام شد','success')->position('bottom-end');        
        return redirect(route('admin.services.categories.index'));
    }

  
    public function destroy(ServiceCategory $category)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.delete');

        $category->delete();
        toast('دسته بندی مورد نظر حذف شد.','error')->position('bottom-end');        
        return back();
    }

    public function subindex(ServiceCategory $parent)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.sub.index');

       $categories = ServiceCategory::where('parent_id',$parent->id)->orderBy('name','asc')->paginate(10);
       return view('admin.services.categories.sub.all',compact('categories','parent'));
    }


    public function subcreate(ServiceCategory $parent)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.sub.create');

        return view('admin.services.categories.sub.create',compact('parent'));
    }


    public function substore(Request $request,ServiceCategory $parent)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.sub.create');

        $category = ServiceCategory::where('parent_id',$parent->id)->where('name',$request->name)->first();
        if($category==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }

        $request->validate(
        [
            'name' => ['required','max:255','unique_validator'],
            'status' => ['required','integer']
        ],
        [
            "name.required" => "* عنوان دسته را وارد نمایید.",
            "name.max" => "* حداکثر طول مجاز برای عنوان دسته 255 کارکتر است.",
            "name.unique_validator"=> "* این دسته قبلا ثبت شده است.",
        ]);

        ServiceCategory::create([
            'parent_id'=>$parent->id,
            "name"=>$request->name,
            'slug' => SlugService::createSlug(ServiceCategory::class, 'slug', $request->name),
            "status"=>$request->status,
        ]);

        toast('.زیردسته جدید ثبت شد','success')->position('bottom-end');        
        return redirect(route('admin.services.categories.sub.index',$parent));
    }

    public function subedit(ServiceCategory $parent,ServiceCategory $category)
    {
        return view('admin.services.categories.sub.edit',compact('parent','category'));
    }

    public function subupdate(Request $request,ServiceCategory $parent,ServiceCategory $category)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.sub.edit');

        $cat = ServiceCategory::where('parent_id',$parent->id)->where('name',$request->name)->where('id','<>',$category->id)->first();
        if($cat==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }

        $request->validate(
        [
            'name' => ['required','max:255','unique_validator'],
            'status' => ['required','integer']
        ],
        [
            "name.required" => "* عنوان دسته را وارد نمایید.",
            "name.max" => "* حداکثر طول مجاز برای عنوان دسته 255 کارکتر است.",
            "name.unique_validator"=> "* این دسته قبلا ثبت شده است.",
        ]);

        $category->update([
            "name"=>$request->name,
            'slug' => SlugService::createSlug(ServiceCategory::class, 'slug', $request->name),
            "status"=>$request->status,
        ]);

        toast('.بروزرسانی انجام شد','success')->position('bottom-end');        
        return redirect(route('admin.services.categories.sub.index',$parent));
    }

    public function subdestroy(ServiceCategory $parent,ServiceCategory $category)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.categories.sub.delete');

        $category->delete();
        toast('دسته بندی مورد نظر حذف شد.','error')->position('bottom-end');        
        return back();
    }

    public function fetch_child()
    {
        $cat_id = request('cat_id');
        $childs = ServiceCategory::where('parent_id',$cat_id)->where('status',Status::Active)->get();
        return response()->json(['childs'=>$childs],200);
    }

}
