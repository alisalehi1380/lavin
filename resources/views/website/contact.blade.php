@extends('layouts.master')

@section('content')
    <div>
        @include('layouts.header',['title'=>'ارتباط با ما','background'=>'/images/front/service-bg.jpg'])
        <div class="px-lg-5 text-center pt-4">
            <p>
                <b class="font-weight-bold">آدرس: </b>رشت ، بلوار دیلمان ، چهار راه شهید بهشتی ، بلوار عرفان ، ابتدای کوه یخ ، درمانگاه لاوین رشت
            </p>
            <div class="contact">
                <b class="font-weight-bold">شماره تماس: </b>

                <div class="row mx-0 col-12 justify-content-center">
                    @foreach($phones as $phone)
                    <div class="col-md-3 mt-3">
                        <div class="border rounded d-flex">
                            <div class="bg-light-grey rounded-left label">{{ $phone->title }}</div>
                            <a href="tel:013335487" class="m-auto">{{ $phone->phone }}</a>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
            <div class="row mx-0 justify-content-center my-5">
                @foreach($socialmedias as $socialmedia)
                <a class="badge bg-light rounded-circle d-flex mr-1" style="width: 30px; height: 30px;" href="http://{{ $socialmedia->link }}" title="{{ $socialmedia->name }}" target="_blanck">
                    <i class="{{ $socialmedia->icon }} m-auto"></i>
                </a>
                @endforeach
            </div>
            <div class="col-12 row mx-0 mb-xl-4">
                <div class="col-md-7 px-xl-5 mb-4">
                    <form action="{{ route('website.message') }}" method="post" class="border border-accent rounded py-4 px-md-5" style="border-width:2px !important;">
                        @csrf
                       <h2 class="font-weight-bold h5">فرم تماس با ما</h2>
                        <div class="text-right row mx-0">
                            <div class="col-12 col-md-6 form-control w-100 mt-2">
                                <label class="w-100 mb-0 small text-black">نام و نام خانوادگی</label>
                                <input type="text" name="fullname" id="fullname" class="w-100 px-3" value="{{ old('fullname') }}">
                                <span class="form-text text-danger erroralarm"> {{ $errors->first('fullname') }} </span>
                            </div>
                            <div class="col-12 col-md-6 form-control w-100 mt-2">
                                <label class="w-100 mb-0 small text-black">تلفن همراه</label>
                                <input type="text" name="mobile" id="mobile" class="w-100 px-3 text-left" value="{{ old('mobile') }}">
                                <span class="form-text text-danger erroralarm"> {{ $errors->first('mobile') }} </span>
                            </div>

                            <div class="col-12 form-control w-100 mt-2">
                                <label class="w-100 mb-0 small text-black">توضیحات</label>
                                <textarea name="content" id="content" cols="30" rows="3" class="w-100 p-3">{{ old('content') }}</textarea>
                                <span class="form-text text-danger erroralarm"> {{ $errors->first('content') }} </span>
                            </div>

                            <div class="col-12 mt-3 text-center">
                                <input type="submit" class="button button-black" value="ارسال فرم">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 mb-4">
                    <iframe width="100%" height="100%" style="margin-bottom: -14px" scrolling="no" marginwidth="0"
                            src="https://maps.google.com/maps?q=Gilan%20Province%2C%20Rasht%2C%20District%201%2C%20Erfan%D8%8C%20%D8%AF%D8%B1%D9%85%D8%A7%D9%86%DA%AF%D8%A7%D9%87%20%D9%84%D8%A7%D9%88%DB%8C%D9%86&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near"
                            aria-label="Gilan Province, Rasht, District 1, Erfan، درمانگاه لاوین" frameborder="0"></iframe>
                </div>
            </div>
        </div>



    </div>
@stop

@push('css')
    <style>
        .contact a{
            direction: ltr;
            display: inline-block;
            color: gray;
            padding: 0 5px;
        }
        .contact a:hover{
            color: #2ed3ae;
        }
        .border-accent{
            border-color:#2ed3ae !important;
        }
        .contact span{
            font-weight: bold;
        }
    </style>
@endpush
