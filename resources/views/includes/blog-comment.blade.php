<div class="col-12 px-0 px-md-3">
    <div class="col-lg-9 pb-5 px-0 px-md-3">
        <h6 class="dima">3 دیدگاه</h6>
        @foreach($article->comments as $comment)
            <div class="mt-4 p-3 col-12 bg-light">
                <div class="mb-4">
                    <img src="{{ Gravatar::get($comment->email) }}" title="{{ $comment->fullname }}" alt="{{ $comment->fullname }}" class="rounded-circle pl-2" width="55" height="55">
                    <b class="text-black">{{ $comment->fullname }}</b>
                    <span class="badge bg-pink text-white font-weight-light pb-0 rounded-0 mr-2">{{ $article->publish_date() }}</span>
                </div>
                <p class="small" style="white-space: pre-line">{{ $comment->comment }}</p>
                
                @if($comment->answer!=null)
                <div class="mt-4 p-3 col-12 text-light bg-dark">
                    <b class="text-light">پاسخ ادمین:</b>
                    <p class="small" style="white-space: pre-line">{{ $comment->answer }}</p>
                </div>
                @endif
            </div>

          
        @endforeach

       

        <div class="col-12 mt-5">
            <h6 class="dima mb-4">دیدگاه خودت را ثبت کن</h6>
            <form action="{{ route('website.articles.comments.store',$article) }}" method="post">
                @csrf
                <div class="col-12 px-0 form-control w-100 mt-2">
                    <textarea name="comment" placeholder="توضیحات" rows="3" class="w-100 p-3"></textarea>
                    <span class="form-text text-danger erroralarm"> {{ $errors->first('comment') }} </span>
                </div>
                <div class="col-12 row mx-0 px-0">
                    <div class="col-12 col-md-6 form-control w-100 mt-2 px-0 pr-md-0 pl-md-1">
                        <input type="text" placeholder="نام و نام خانوادگی" class="w-100 px-3" name="fullname">
                        <span class="form-text text-danger erroralarm"> {{ $errors->first('fullname') }} </span>
                    </div>
                    <div class="col-12 col-md-6 form-control w-100 mt-2 px-0 pr-md-1 pl-md-0">
                        <input type="text" placeholder="ایمیل" class="w-100 px-3" name="email">
                        <span class="form-text text-danger erroralarm"> {{ $errors->first('email') }} </span>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <input type="submit" class="button button-black" value="ثبت نظر">
                </div>
            </form>
        </div>
    </div>
</div>
