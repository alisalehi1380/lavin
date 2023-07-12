
<section class="col-12 pt-5 px-0 blogs">
    <div class="container">
        <div class="text-center">
            <h2 class="heading-4 text-center dima pb-3">مقالات اخیر</h2>
            <div>از آخرین اخبار و مقالات ما بازدید نمایید </div>
        </div>

        <div class="col-12">
            <ul class="nav nav-tabs d-flex justify-content-center py-3" id="myTab" role="tablist">
                @foreach($articleCategories as $category)
                <li class="nav-item mb-2">
                    <a class="nav-link @if($loop->first) active @endif" id="article-{{ $category->id }}-tab" data-toggle="tab" href="#article-{{ $category->id }}" role="tab"
                       aria-selected="true">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="col-12 row mx-0 px-0 px-md-3 tab-content" id="myTabContent">

            @foreach($articleCategories as $category)
                <div class="tab-pane fade w-100 @if($loop->first) show active @endif" id="article-{{ $category->id }}">
                    <div class="col-12 row mx-0 px-0">
                        @foreach($category->articles as $index=>$article)
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
                    </div>

                    @if(count($category->articles)>3)
                    <div class="col-12 d-flex justify-content-center pb-5">
                        <a href="{{ route('website.articles.blog',['category'=>$category->slug]) }}" class="col-md-3 btn btn-accent-outline small">دیدن همه مقالات</a>
                    </div>
                    @endif
                </div>
            @endforeach

        </div>

    </div>

</section>

@push('css')
    <style scoped>
        .blogs{
            background-color: #EAF1EE;
        }
        .nav-tabs .nav-link{
            border: 2px solid #2ed3ae !important;
            color:#2ed3ae;
            border-radius: 5px;
            padding: 6px 5px 3px 5px;
            line-height: 1;
            margin-right: 5px;
            font-size: 15px;
        }
        .nav-tabs .nav-link.active{
            background-color: #2ed3ae;
            color: white !important;
        }
    </style>
@endpush

