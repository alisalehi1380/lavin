 @extends('layouts.master')
 @section('content')
<div id="faq">
    @include('layouts.header')
</div>

 <div class="col-12 text-center d-flex justify-content-center align-items-center px-0 bg-white position-relative doctor-bg">
     <h1 class="h3 font-weight-bold dima ">سوالات متداول</h1>
 </div>


 <div class="container position-relative" style="top: -50px;">

     <div class="col-lg-12 px-0 px-md-3">
         <div class="col-12 h5 text-accent mb-3">پرسش‌های رایج درباره‌ی کلینیک</div>
         <div class="col-12 row mx-0 d-flex justify-content-center pb-3">
            @foreach($faqs as $faq)
             <div class="col-12 px-0 p-3 box-shadow rounded-xl mb-4 text-dark">
                 <div class="col-12 px-0 px-md-3 d-flex justify-content-between" data-toggle="collapse" data-target="#faq{{ $faq->id }}">
                     <span>{{ $faq->question }}</span>
                     <span class="btn-accent-outline circle-chevron px-1 d-flex justify-content-center align-items-center"><i class="fa fa-chevron-down"></i></span>
                 </div>
                 <div id="faq{{ $faq->id }}" class="collapse px-xl-5">
                     <small class="pt-4">{{ $faq->answer }}</small>
                 </div>
             </div>
             @endforeach
         </div>
     </div>

 </div>





 @stop

 @push('js')


 @endpush

 @push('css')
     <style>
         .doctor-bg{
            background-image: url("/images/front/faq.jpeg");
             background-size: 100% 100%;
             background-position: top;
             top:-100px;
             height: 180px
         }
         .page{
             min-height: 100px !important;
         }
         .box-shadow{
             box-shadow: 0 0 5px rgba(0,0,0,0.18)
         }
         .border-top-rgba-gray{
             border-top: 50px solid rgba(201, 255, 146, 0.1);
         }

         #faq .rd-navbar-static:not(.rd-navbar--is-stuck) .rd-navbar-nav > li > a:hover {
             color: black;
         }

         .circle-chevron{
             border-radius: 150px !important;
             width: 30px;
             height: 30px;
         }
         @media (max-width: 992px) {
            .doctor-bg{
                height: 100px
            }
         }
     </style>
 @endpush
