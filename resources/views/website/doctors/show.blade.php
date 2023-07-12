 @extends('layouts.master')
 @section('content')
<div id="doctor">
    @include('layouts.header')
</div>

 <div class="col-12 px-0 bg-white position-relative doctor-bg"></div>

 @if($doctor->doctor!=null)
 <div class="border-top-rgba-gray" style="margin-top: -100px">
     <div class="container">
         <div class="col-12 row mx-0 px-0 px-md-3">
       
                <div class="col-lg-3">

                    <div class="rounded-xl my-4 text-center position-relative bg-white box-shadow" style="top: -120px;">
                        @if($doctor->image != null)
                        <img src="{{ $doctor->get_image('medium') }}" width="130" height="130" class="rounded-circle my-4" alt="{{ $doctor->image->alt }}" title="{{ $doctor->image->title }}">
                        @endIf
                        <div class="text-dark">{{ $doctor->fullname }}</div>
    
                        <div class="my-3">
                            <span class="badge badge-light badge-pill px-4 box-shadow d-inline-flex">
                                <span style="font-size: 10px" class="my-2 font-weight-light text-muted pl-1">تخصص</span><span class="my-auto">{{ $doctor->doctor->speciality ?? ''}}</span>
                            </span>
                        </div>

                        <div class="my-3">
                            <span class="badge badge-light badge-pill px-4 box-shadow d-inline-flex">
                                <span style="font-size: 10px" class="my-2 font-weight-light text-muted pl-1">کدنظام پزشکی</span><span class="my-auto">{{ $doctor->doctor->code ?? ''}}</span>
                            </span>
                        </div>
                        
                        
                        <div class="my-3">
                            <small>تاریخ صدور: {{ $doctor->doctor->startDate() }}</small>
                        </div>
                        

                        <div class="my-3">
                            <small>تاریخ انقضا: {{ $doctor->doctor->expireDate() }}</small>
                        </div>
                        
                    </div>

                </div>
       
                <div class="col-lg-9 px-0 px-md-3">
                    <div class="col-12" style="top: -40px"></div>
                    <div class="col-12 row mx-0 d-flex justify-content-center pb-5">
                        <div class="col-12 p-3 box-shadow rounded-xl mb-5 text-dark">
                            {{ $doctor->doctor->desc ?? ''}}
                        </div>

                        @if($doctor->doctor->video != null)
                        <div class="col-12 p-3 box-shadow rounded-xl mb-5 text-dark">
                        <video poster="{{ $doctor->get_image('large') }}" class="w-100" controls>
                                <source src="{{ $doctor->doctor->video }}" type="video/mp4">
                                <source src="{{ $doctor->doctor->video }}" type="video/ogg">
                                Your browser does not support HTML video.
                                </video>
                        </div>
                        @endif

                        @foreach($doctor->services as $service)
                            <div class="col-md-4 text-center mb-3">
                                <div class="shadow rounded box-shadow p-3">
                                    <div class="flex">
                                        <img src="/images/000/dentist.png" width="30" class="float-right">
                                        <span class="ml-4 text-dark">{{ $service->name }}</span>
                                    </div>
                                    <small class="mt-4 mb-3">{{ $service->breif }}</small>
                                    <div>
                                        <a href="{{ route('website.services.show',$service->slug) }}" class="btn btn-accent-outline btn-sm">نمایش</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
         </div>
     </div>
 </div>
 @else

 <div class="border-top-rgba-gray" style="margin-top: -100px">
     <div class="container text-center">
            <div class="">اطلاعاتی از پزشک جهت نمایش وجود ندارد </div>
     </div>
</div>
 @endif




 @stop

 @push('js')


 @endpush

 @push('css')
     <style>
         .doctor-bg{
            background-image: url("/images/front/doctor-profile.jpg");
             background-size: 100% 100%;
             background-position: bottom;
             top:-100px;
             height: 200px
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
         .rd-navbar-static:not(.rd-navbar--is-stuck) .rd-navbar-nav > li > a{
             color: #eeeeee;
         }
         #doctor .rd-navbar-static:not(.rd-navbar--is-stuck) .rd-navbar-nav > li > a:hover {
             color: white;
         }
         @media (max-width: 992px) {
            .doctor-bg{
                height: 100px
            }
         }
     </style>
 @endpush
