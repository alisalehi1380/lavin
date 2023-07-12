<a href="{{ route('website.articles.show',$slug)}}">
    <div class="bg-light p-3 p-xl-4">
        <div class="badge bg-pink text-white pt-2">{{ $date }}</div>
        <div class="font-weight-bold text-black">{{ $title }}</div>
        <div class="small text-muted mt-3" style="word-wrap: break-word;">{!! substr($content,0,200) !!}</div>

        <hr class="w-100 mt-3 pb-2" style="border-block-color: #dadada;">

        <div class="row mx-0 col-12 ">
            @if($categories)
                @foreach($categories as $index=>$category)
                 @if($index>0) , @endif
                 <span><a href="{{ route('website.articles.blog',['category'=>$category->slug]) }}">{{ $category->name }}</a></span>
                @endforeach
            @endif
        </div>
    </div>
</a>
