 @extends('layouts.master')
 @section('content')

     <div>
         @include('layouts.header',['title'=>'نمونه کارهای کلینیک لاوین','background'=>'/images/front/service-bg.jpg'])
         <div class="col-12 text-center">
             <div class="b-crumb col-12 small my-4">
                 <a href="/" class="text-muted">خانه</a>
                 <i class="fa fa-chevron-left px-2"></i>
                 <span class="text-black">نمونه کارها</span>
             </div>
             <div class="container">
                 <div class="col-12 mx-0 row">
                    @foreach($portfolios as $portfolio)
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('website.portfolios.show',$portfolio->slug) }}">
                            @if($portfolio->after_img != null)
                            <img src="{{ $portfolio->after_img->getImagePath('medium') }}" class="w-100" alt="{{ $portfolio->after_img->alt }}" title="{{ $portfolio->after_img->title }}">
                            @endif
                            <h3 class="h6 mt-3">{{ $portfolio->title }}</h3>
                            <div class="small text-pink"></div>
                        </a>
                    </div>
                    @endforeach


                 </div>
             </div>
             <div class="d-flex justify-content-center mb-5">
                 <div class="pagination border">
                     {!! $portfolios->render() !!}
                 </div>
             </div>
         </div>

     </div>

 @stop
