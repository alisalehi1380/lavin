@extends('layouts.master')
@section('content')

    <div>
        @include('layouts.header')
        <div class="col-12">
            <div class="col-12 d-flex justify-content-center">
                <form   id="search-form" class="col-md-5">
                    <div  class="position-relative">
                        <i class="fa fa-search position-absolute text-pink pointer" onclick="$('#search-form').submit()" style="top: 23%;right: 1vw"></i>
                        <input type="text" class="w-100 pr-5" placeholder="جستجو کنید" name='search'>
                    </div>
                    <small style="color: #c9c9c9">جستجو در میان نمونه کارها ، مقالات و اسامی پزشکان</small>
                </form>
            </div>
            <div class="container">
                <div class="col-12 row mx-0 px-0">
                    <div class="col-md-9">
                        <h1 class="h5 text-muted dima">جستجو</h1>
                        <div class="b-crumb heading-4 col-12 dima text-pink mt-2 mb-4">{{ request('search') }}</div>
                    </div>
                    <div class="col-md-3 text-left">
                        <div class="mb-1 font-11">
                            <span onclick="sectionController(this, 'portfolio')" class="bg-gray-lighter px-2 py-1 d-inline-block text-center"
                                  style="width: 120px"><i class="fa fa-times ml-1 float-right my-1"></i> مشاهده نمونه کارها</span>
                        </div>
                        <div class="mb-1 font-11">
                            <span onclick="sectionController(this, 'blog')" class="bg-gray-lighter px-2 py-1 d-inline-block text-center"
                                  style="width: 120px"><i class="fa fa-times ml-1 float-right my-1"></i>مشاهده مقالات</span>
                        </div>
                        <div class="mb-1 font-11">
                            <span onclick="sectionController(this, 'doctor')" class="bg-gray-lighter px-2 py-1 d-inline-block text-center"
                                  style="width: 120px"><i class="fa fa-times ml-1 float-right my-1"></i>مشاهده پزشکان</span>
                        </div>
                    </div>
                </div>
                <hr>

                <section id="portfolio" class="col-12 mx-0 row mt-3">
                    <div class="col-12 text-black py-3">در نمونه کارها</div>
                    
                    @if(count($articles)>0)
                         @foreach($portfolios as $index=>$portfolio)
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('website.portfolios.show',$portfolio->slug) }}">
                                <img src="/images/000/port1.png" class="w-100" alt="">
                                <h3 class="h6 mt-3">نمونه کار {{ request('search') }}</h3>
                                <div class="small text-pink">{{  $portfolio->title }}</div>
                            </a>
                        </div>
                        @endforeach
                   @endIf
 
                </section>

                <section id="blog" class="col-12 mx-0 row mt-3">
                    <div class="col-12 text-black pb-3">در مقالات</div>

                        @if(count($articles)>0)
                            @foreach($articles as $index=>$article)
                                @if($index<3)
                                    <div class="col-lg-4 py-4">
                                        @include('includes.elements.blog-card',[
                                            'title'=>$article->title,
                                            'slug'=>$article->slug,
                                            'content'=>substr($article->content,0,185),
                                            'date'=>$article->publish_date(),
                                            'categories'=> $article->categories])
                                    </div>
                                @endIf
                            @endforeach
                        @endIf
                </section>

                <section id="doctor" class="col-12 mx-0 row mt-3">
                    <div class="col-12 text-black pb-3">در پزشکان</div>
                    @if(count($doctors)>0)
                         @foreach($doctors as $index=>$doctor)
                            <div class="col-lg-3 pb-4 px-2">
                                <div class="p-3 p-xl-4 text-center">
                                    <img src="{{ $doctor->get_image('medium') }}" class="rounded-circle border-thick" alt="">
                                    <div class="text-black">دکتر  {{ $doctor->fullname }}</div>
                                    <div class="small text-secondary">{{ $doctor->doctor->speciality ?? '' }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    

                </section>

            </div>

        </div>

    </div>

@stop

@push('js')
    <script>
        function sectionController(el ,sec) {
            let section = $('#'+sec)[0];
            el.classList.contains('text-muted') ? $(el).removeClass('text-muted') : $(el).addClass('text-muted');
            section.classList.contains('d-none') ? $(section).removeClass('d-none') : $(section).addClass('d-none');
        }
    </script>
@endpush

@push('css')
    <style>
        .bg-gray-lighter{
            color:black
        }
        .bg-gray-lighter:hover{
            cursor: pointer;
            background-color: #d9d9d9 !important;
        }
        .text-muted{
            color: #b4b4b4 !important;
        }
    </style>
@endpush
