 @extends('layouts.master')
 @section('content')

     <div>
         @include('layouts.header', ['title'=>'لیست مقالات', 'background'=>'/images/front/service-bg.jpg'])
         <div class="col-12 mt-3">
             <div class="px-lg-5">
                 <div class="col-12 mx-0 row">

                     <div class="col-md-12 px-0 px-md-3 mb-4">

                         <form class="col-12 p-3 row mx-0 bg-light border rounded" method="get">
                             <div class="col-md-9 px-0 px-md-3 my-auto">
                                 <div class="b-crumb px-0 px-md-3 col-12 small">
                                     <a href="/" class="text-muted">خانه</a>
                                     <i class="fa fa-chevron-left px-2"></i>
                                     <span class="text-black">مقالات</span>
                                 </div>
                             </div>
                             <div class="col-md-3">

                                 <small>نام دسته</small>
                                 <div>
                                     <select name="category" onchange="this.form.submit()" class="w-100 py-1" id="">
                                         <option value="">همه دسته‌بندی ها</option>
                                         @foreach ($categories as $category)
                                            <option value="{{ $category->slug }}" {{ $category->id==request('category')?'selected':'' }}>{{ $category->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>

                             </div>
                         </form>

                         @if(request('category')!=null)
                             <div class="col-12 my-2">
                             <span class="bg-light px-3 heading-4">
                                <span class="text-pink pl-2 font-weight-bold">#</span>{{ request('category') }}
                             </span>
                             </div>
                         @elseif(request('tag')!=null)
                             <div class="col-12 my-2">
                             <span class="bg-light px-3 heading-4">
                                <span class="text-pink pl-2 font-weight-bold">#</span>{{ request('tag') }}
                             </span>
                             </div>
                         @endif

                         <div class="col-12 blogs pb-3 px-0">

                             <div class="col-12 px-1 row mx-0 mt-3">
                                 @foreach($articles as $article)
                                    <div class="col-lg-3 py-4">
                                        @include('includes.elements.blog-card',['title'=>$article->title,'slug'=>$article->slug,'content'=>$article->content,'date'=>$article->publish_date(),'categories'=>$article->categories])
                                    </div>
                                 @endforeach
                             </div>
                             <div class="d-flex justify-content-center mb-3">
                                {!! $articles->render() !!}
                             </div>
                         </div>

                     </div>


                 </div>
             </div>

         </div>

     </div>

 @stop

 @push('js')

 @endpush
 @push('css')
     <style>
         .blogs, .alert-info{
             background-color: #EAF1EE;
         }
         .blogs img{
             width: 25px;
             height: 25px;
         }
     </style>
 @endpush
