@extends('layouts.master')

@section('content')
    <div id="profile">
        @include('layouts.header' ,['title' => 'لیست جوایز'])
    </div>
    <div class="col-12 row mx-0 justify-content-center mb-5">

        <div class="mt-5 bg-white border col-md-8 pb-3">
            <div class="font-weight-bold p-2 text-black">جوایز</div>
            <div class="col-12 row mx-0 mt-1 bg-light" style="font-size: 14px">
                <div class="col-md-4 px-0">کرم ضد افتاب 20 درصد تخفیف</div>
                <div class="col-md-4 px-0">شرکت در قرعه کشی گردونه 1400/11/10</div>
                <div class="col-md-3 px-0 font-weight-bold text-black">s5a154a1d</div>
                <div class="col-md-1 px-0 font-weight-bold text-black"><span class="badge badge-warning font-weight-light"> استفاده نشده</span></div>
            </div>
            <div class="col-12 row mx-0 mt-1 bg-light" style="font-size: 14px">
                <div class="col-md-4 px-0">الکل شستوشو پس از آرایش</div>
                <div class="col-md-4 px-0">شرکت در قرعه کشی گردونه 1400/11/27</div>
                <div class="col-md-3 px-0 font-weight-bold text-black">8r7348r7h</div>
                <div class="col-md-1 px-0 font-weight-bold text-black"><span class="badge badge-warning font-weight-light"> منقضی شده</span></div>
            </div>
        </div>
    </div>

@stop

@push('css')
    <style>
        #profile{
            background-image: url("/images/front/background-1.jpg");
            background-position: bottom;
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.15);
            background-blend-mode: color;
        }
    </style>
@endpush
