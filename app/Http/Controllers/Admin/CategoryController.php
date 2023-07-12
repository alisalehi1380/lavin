<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleCategories;
use Illuminate\Validation\Rule;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Enums\Status;
class CategoryController extends Controller
{
 
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.categorys.index');

        $categorys = ArticleCategories::orderby('name','ASC')->filter()->paginate(10);
        return view('admin.category.all',compact('categorys'));
    }

 
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.categorys.create');

        return view('admin.category.create');
    }

 
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.categorys.create');

        $request->validate(
        [
            'name' => ['required','max:255','unique:article_categories'],
        ],
        [
            "name.required" => "* عنوان دسته را وارد نمایید.",
            "name.max" => "* حداکثر طول مجاز برای عنوان دسته 255 کارکتر است.",
            "name.unique"=> "* این دسته قبلا ثبت شده است.",
        ]);
 

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            ArticleCategories::create(
                [
                    "name"=>$request->name,
                    'slug' => SlugService::createSlug(ArticleCategories::class, 'slug', $request->name),
                    'status'=>$request->status
                ]
            );
        }
       
        alert()->success('پیام شما ثبت شد.', 'تبریک');

        return back();
    }
 
    public function show($id)
    {
        //
    }
 
    public function edit(ArticleCategories $category)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.categorys.edit');

        return view('admin.category.edit',compact('category'));
    }

 
    public function update(Request $request,ArticleCategories $category)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.categorys.edit');

        $id = $category->id;
        $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('article_categories')->where(function($query) use ($id){
                        $query->where('id','<>',$id);
                    }),
                ]
            ],
            [
                "name.required" => "* عنوان دسته را وارد نمایید.",
                "name.max" => "* حداکثر طول مجاز برای عنوان دسته 255 کارکتر است.",
                "name.unique"=> "* این دسته قبلا ثبت شده است.",
            ]);

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            $category->update(
            [
                "name" =>  $request->name,
                'slug' => SlugService::createSlug(ArticleCategories::class, 'slug', $request->name),
                'status'=>$request->status
            ]);
        }

        toastr()->info('عملایت بروزرسانی با موفقیت انجام شد');

        return redirect(route('admin.article.categorys.index'));
    }

  
    public function destroy(ArticleCategories $category)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.categorys.delete');

        $category->delete();
        toastr()->error('دسته  مورد نظر حذف  شد.');
        return redirect(route('admin.article.categorys.index'));
    }
}
