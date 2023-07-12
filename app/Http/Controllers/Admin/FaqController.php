<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Enums\Status;


class FaqController extends Controller
{
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('faq.index');

        $faqs = FAQ::orderBy('created_at','desc')->get();
        return view('admin.faq.all',compact('faqs'));
    }

 
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('faq.create');

        return view('admin.faq.create');
    }

 
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('faq.create');

        $request->validate([
            'question'=>'required|max:255',
            'answer'=>'required|max:63000',
        ],[
            'question.required'=>'* الزامی است.',
            'question.max'=>'* حداکثر 255 کارکتر.',
            'answer.required'=>'* الزامی است.',
            'answer.max'=>'* حداکثر 63000 کارکتر.',
        ]);

        if($request->display==Status::Active || $request->display==Status::Deactive)
        {
             FAQ::create([
                'question' => $request->question,
                'answer' => $request->answer,
                'display' => $request->display,
            ]);
        }
        
        return  redirect(route('admin.faq.index'));
    }
 
    public function show($id)
    {
        //
    }

 
    public function edit(FAQ $faq)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('faq.edit');

        return view('admin.faq.edit',compact('faq'));
    }

   
    public function update(Request $request,FAQ $faq)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('faq.edit');

        $request->validate([
            'question'=>'required|max:255',
            'answer'=>'required|max:63000',
        ],[
            'question.required'=>'* الزامی است.',
            'question.max'=>'* حداکثر 255 کارکتر.',
            'answer.required'=>'* الزامی است.',
            'answer.max'=>'* حداکثر 63000 کارکتر.',
        ]);

        $faq->question = $request->question;
        $faq->answer = $request->answer;

        if($request->display==Status::Active || $request->display==Status::Deactive)
        {
            $faq->display = $request->display;
        }

        $faq->save();

        return  redirect(route('admin.faq.index'));
    }
 
    public function destroy(FAQ $faq)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('faq.destroy');

        $faq->delete();
        toastr()->error('پرسش و پاسخ مورد نظر شد.');
        return back();
    }
}
