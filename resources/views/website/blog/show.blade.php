@extends('layouts.master')

@section('content')
    @include('layouts.header', ['title'=>$article->title, 'background'=>'/images/front/service-bg.jpg'])
    <div class="col-12 text-right px-0 px-md-3">
        <div class="container">
            <div class="b-crumb col-12 small mt-4">
                <a href="/" class="text-muted">خانه</a>
                <i class="fa fa-chevron-left px-2"></i>
                <a href="#" class="text-muted">نمونه کارها</a>
                <i class="fa fa-chevron-left px-2"></i>
                <span class="text-black">درمان درد زانو</span>
            </div>
            <div class="col-12 mx-0 row px-0 px-md-3">
                <div class="col-md-9 px-md-5 mb-5">
                    @if($article->thumbnail != null)
                    <div>
                        <div class="col-12 text-center my-3">
                            <img  src="{{ $article->get_thumbnail('large') }}" class="w-100">
                        </div>
                    </div>
                    @endif
                    
                    <div class="col-12">
                        <span class="badge bg-accent text-white font-weight-light rounded-0 p-2 mx-1 mb-2">{{ $article->publish_date() }}</span>
                    </div>

                    <div class="col-12 mb-4">
                        <h2 class="h6 dima">{{ $article->title }}</h2>
                        <div class="text-dark mt-4">{!! $article->content !!}</div>
                    </div>
                    <hr class="mb-3 border">

                </div>

                <div class="col-md-3 px-0 pb-4">
                    <div  class="position-sticky" style="top:7rem">
                        <div class="font-weight-bold text-black">دسته بندی:</div>

                             @foreach($article->categories as $category)
                             <a href="{{ route('website.articles.blog',['category'=>$category->slug]) }}">
                                 <span class="badge bg-accent text-white font-weight-light rounded-0 p-2 mx-1 mb-2">{{ $category->name }}</span>
                             </a>
                             @endforeach


                            <div class="font-weight-bold text-black">مقالات جدید</div>
                            @foreach($lastArticles as $ar)
                            <a href="{{ route('website.articles.show',$ar->slug)}}">
                                <div class="row mx-0 col-12 mb-3">
                                     @if($ar->thumbnail != null)
                                    <img src="{{ $ar->get_thumbnail('thumbnail') }}" width="40" height="40"  alt="{{ $ar->title }}" alt="{{ $ar->title }}">
                                    @endif
                                    <small class="text-secondary mr-3 my-auto text-dark">{{ $ar->title }}
                                        <small class="text-secondary my-auto" style="line-height: 1">{{ $ar->publish_date_time() }}</small>
                                    </small>
                                </div>
                            </a>
                            @endforeach


                        <h6 class="mb-3 mt-5">تگ ها</h6>
                        <div class="alert alert-info rounded-0 p-2">
                            <?php
                             $tags = explode(',',$article->tags);
                            ?>

                            @foreach($tags as $tag)
                            <a href="{{ route('website.articles.blog',['tag'=>$tag]) }}">
                                <span class="badge bg-accent text-white font-weight-light rounded-0 p-2 mx-1 mb-2">{{ $tag }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                @include('includes.blog-comment')
            </div>
        </div>
    </div>
@stop

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush
