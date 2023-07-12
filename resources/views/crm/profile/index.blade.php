@extends('crm.master')

@section('content')

<div class="content-page">

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

        <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            {{-- {{ Breadcrumbs::render('article-categories') }} --}}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-user page-icon"></i>
                              پروفایل
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @include('crm.include.info')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                             @if ($errors->any())
                                <div class="bg-danger p-2 border-2 mb-5">
                                    @foreach ($errors->all() as $error)
                                        <div class="text-light IRANYekanRegular">{{$error}}</div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="accordion mb-3" id="accordionExample">
                                
                                <div class="card-header pointer" id="heading1" data-toggle="collapse" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    <h5 class="my-0">
                                        <a class="text-primary IR" data-toggle="collapse1" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                            #مشخصات شخصی
                                        </a>
                                    </h2>
                                </div>

                                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionExample">
                                    <div class="card-body" style="min-height: 200px;border:1px solid #e7eaed;">
                                        
                                      
    
                                        <div class="row mt-2">
                                                
                                            <div class="col-12 text-center">
                                                <form  action="{{ route('website.account.profile.updatepro') }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="form-group row">
                                                        <label for="firstname" class="col-sm-3 col-form-label IRANYekanRegular">نام</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control IRANYekanRegular" id="firstname" name="firstname" placeholder="نام" value="{{ old('lastname') ?? $user->firstname}}">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('firstname') }} </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="lastname" class="col-sm-3 col-form-label IRANYekanRegular">نام خانوادگی</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control IRANYekanRegular" id="lastname" name="lastname" placeholder="نام خانوادگی" value="{{ old('lastname') ?? $user->lastname}}">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('lastname') }} </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label for="mobile" class="col-sm-3 col-form-label IRANYekanRegular">کدملی</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control IRANYekanRegular text-right" id="nationcode" name="nationcode" placeholder="کدملی" value="{{ old('nationcode') ?? $user->nationcode}}">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('nationcode') }} </span>
                                                        </div>
                                                     </div>

                                                    <div class="form-group row">
                                                        <label for="mobile" class="col-sm-3 col-form-label IRANYekanRegular">شماره موبایل</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control IRANYekanRegular text-right" id="mobile" name="mobile" placeholder="شماره موبایل" value="{{ old('mobile') ?? $user->mobile}}">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('mobile') }} </span>
                                                        </div>
                                                    </div>
                                            
                                                    <div class="form-group row">
                                                        <label for="gender" class="col-sm-3 col-form-label IRANYekanRegular">جنسیت</label>
                                                        <div class="col-sm-9">
                                                            <select name="gender" id="gender" class="form-control dropdown text-center IRANYekanRegular"  data-placeholder="انتخاب جنسیت...">
                                                                <option value="{{ App\Enums\genderType::male }}" @if(old('gender')==App\Enums\genderType::male || $user->gender==App\Enums\genderType::male) selected @endif>مرد</option>
                                                                <option value="{{ App\Enums\genderType::famale }}" @if(old('gender')==App\Enums\genderType::famale || $user->gender==App\Enums\genderType::famale) selected @endif>زن</option>
                                                                <option value="{{ App\Enums\genderType::other }}" @if(old('gender')==App\Enums\genderType::other || $user->gender==App\Enums\genderType::other) selected @endif>غیره...</option>
                                                            </select>
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('gender') }} </span>
                                                        </div>
                                                    </div>
                                            
                                                    
                                                    <div class="form-group mb-0 justify-content-end row">
                                                        <div class="col-sm-9">
                                                            <button type="submit"  title="بروزرسانی" class="btn btn-info waves-effect waves-light">بروزرسانی</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-header pointer" id="heading2" data-toggle="collapse" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                    <h5 class="my-0">
                                        <a class="text-primary IR" data-toggle="collapse2" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                            # تغییر رمز عبور
                                        </a>
                                    </h2>
                                </div>

                                <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
                                    <div class="card-body" style="min-height: 200px;border:1px solid #e7eaed;">
                                        <div class="row mt-2">
                                            <div class="col-12 text-center">                                                <form  action="{{ route('website.account.profile.updatepass') }}" method="post">
                                                    @csrf
                                                    @method('patch')

                                                    <div class="form-group row">
                                                        <label for="password" class="col-sm-3 col-form-label IRANYekanRegular">رمز جدید</label>
                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control IRANYekanRegular text-right" id="password" name="password" placeholder="رمز جدید" value="">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('password') }} </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="repassword" class="col-sm-3 col-form-label IRANYekanRegular">رمز جدید</label>
                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control IRANYekanRegular text-right" id="password_confirmation" name="password_confirmation" placeholder="تکراری رمز جدید" value="">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('password_confirmation') }} </span>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group mb-0 justify-content-end row">
                                                        <div class="col-sm-9">
                                                            <button type="submit" title="بروزرسانی" class="btn btn-info waves-effect waves-light">بروزرسانی</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header pointer" id="heading3" data-toggle="collapse" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                    <h5 class="my-0">
                                        <a class="text-primary IR" data-toggle="collapse3" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                            # آدرس محل سکونت
                                        </a>
                                    </h2>
                                </div>

                                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
                                    <div class="card-body" style="min-height: 200px;border:1px solid #e7eaed;">
                                        <div class="row mt-2">
                                            <div class="col-12 text-center">
                                                <form  action="{{ route('website.account.profile.updateaddress') }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="form-group row">
                                                        <label for="province" class="col-sm-3 col-form-label IRANYekanRegular">استان</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control dropdopwn IR text-center"  name="province_id" id="province_id  @error('province') is-invalid @enderror" onchange="cities(this.value)">
                                                                <option value=""> استان محل سکونت خود را انتخاب نمایید...</option>
                                                                @foreach($provinces as $province)
                                                                <option value="{{ $province->id }}" class="dropdopwn" @if($province->id==old('province_id')) selected @elseif($address!=null && $province->id==$address->province_id) selected @endif>{{ $province->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('province_id') }} </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="city" class="col-sm-3 col-form-label IRANYekanRegular">شهر</label>
                                                        <div class="col-sm-9">
                                                            @if(old('province_id')!=null)
                                                                <div id="city_list">
                                                                    <select class="form-control dropdopwn IR text-center"  name="city_id" id="city_id  @error('city') is-invalid @enderror" onchange='parts(this.value)'>
                                                                        <option value=""> شهر محل سکونت خود را انتخاب نمایید...</option>
                                                                        @foreach(App\Models\City::where('province_id',old('province_id'))->where('status',App\Enums\Status::Active)->orderBy('name','asc')->get() as $city)
                                                                        <option value="{{ $city->id }}" @if($city->id==old('city_id')) selected @elseif($address!=null && $city->id==$address->city_id) selected @endif>{{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>  
                                                            @elseif($address!=null)
                                                                <div id="city_list">
                                                                    <select class="form-control dropdopwn IR text-center"  name="city_id" id="city_id  @error('city') is-invalid @enderror" onchange='parts(this.value)'>
                                                                        <option value=""> شهر محل سکونت خود را انتخاب نمایید...</option>
                                                                        @foreach(App\Models\City::where('province_id',$address->province_id)->where('status',App\Enums\Status::Active)->orderBy('name','asc')->get() as $city)
                                                                        <option value="{{ $city->id }}" {{ $city->id==$address->city_id?'selected':'' }}>{{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>  
                                                            @else
                                                                <div id="city_list">
                                                                    <select class="form-control dropdopwn IR text-center"  name="city_id" id="city_id  @error('city') is-invalid @enderror" onchange='parts(this.value)'>
                                                                        <option value=""> شهر محل سکونت خود را انتخاب نمایید...</option>
                                                                    </select>
                                                                </div>
                                                            @endif
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('city_id') }} </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="part" class="col-sm-3 col-form-label IRANYekanRegular">ناحیه</label>
                                                        <div class="col-sm-9">
                                                            @if(old('city_id')!=null)
                                                                <div id="part_list">
                                                                    <select class="form-control dropdopwn IR text-center"  name="part_id" id="part_id  @error('city') is-invalid @enderror">
                                                                        <option value=""> ناحیه محل سکونت خود را انتخاب نمایید...</option>
                                                                        @foreach(App\Models\CityPart::where('city_id',old('city_id'))->where('status',App\Enums\Status::Active)->orderBy('name','asc')->get() as $part)
                                                                        <option value="{{ $part->id }}" {{ $part->id==old('part_id')?'selected':'' }}>{{ $part->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @elseif($address!=null)
                                                                <div id="part_list">
                                                                    <select class="form-control dropdopwn IR text-center"  name="part_id" id="part_id  @error('city') is-invalid @enderror">
                                                                        <option value=""> ناحیه محل سکونت خود را انتخاب نمایید...</option>
                                                                        @foreach(App\Models\CityPart::where('city_id',$address->city_id)->where('status',App\Enums\Status::Active)->orderBy('name','asc')->get() as $part)
                                                                        <option value="{{ $part->id }}" {{ $part->id==$address->part_id?'selected':'' }}>{{ $part->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @else
                                                            <div id="part_list">
                                                                <select class="form-control dropdopwn IR text-center"  name="part_id" id="part_id  @error('part') is-invalid @enderror">
                                                                    <option value=""> ناحیه محل سکونت خود را انتخاب نمایید...</option>
                                                                </select>
                                                            </div>
                                                            @endif
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('part_id') }} </span>
                                                        </div>
                                                    </div>
                                            
                                                    <div class="form-group row">
                                                        <label for="text" class="col-sm-3 col-form-label IRANYekanRegular">آدرس</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control IRANYekanRegular" id="address" name="address" placeholder="آدرس محل سکونت..." value="@if(old('address')!=null) {{ old('address') }} @elseIf($address!=null) {{ $address->address }} @endif">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('address') }} </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="postalcode" class="col-sm-3 col-form-label IRANYekanRegular">کدپستی</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control IRANYekanRegular text-right" id="postalcode" name="postalcode" placeholder="کدپستی..." value="@if(old('postalcode')!=null) {{ old('postalcode') }} @elseIf($address!=null) {{ $address->postalcode }} @endif">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('postalcode') }} </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group mb-0 justify-content-end row">
                                                        <div class="col-sm-9">
                                                            <button type="submit" title="بروزرسانی" class="btn btn-info waves-effect waves-light">بروزرسانی</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-header pointer" id="heading4" data-toggle="collapse" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                    <h5 class="my-0">
                                        <a class="text-primary IR" data-toggle="collapse4" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                            # مشخصات بانکی  
                                        </a>
                                    </h2>
                                </div>

                                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
                                    <div class="card-body" style="min-height: 200px;border:1px solid #e7eaed;">
                                        <div class="row mt-2">
                                            <div class="col-12 text-center">
                                                <form  action="{{ route('website.account.profile.updatebank') }}" method="post">
                                                    @csrf
                                                    @method('patch')

                                                    <div class="form-group row">
                                                        <label for="name" class="col-sm-3 col-form-label IRANYekanRegular">نام بانک</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control IRANYekanRegular" id="name" name="name" placeholder="نام بانک" value="@if(old('name')!=null) {{ old('name') }} @elseIf($bank!=null) {{ $bank->name }} @endif">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="cart" class="col-sm-3 col-form-label IRANYekanRegular">شماره کارت</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control IRANYekanRegular text-right" id="cart" name="cart" placeholder="شماره کارت" value="@if(old('cart')!=null) {{ old('cart') }} @elseIf($bank!=null) {{ $bank->cart }} @endif">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('cart') }} </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="account" class="col-sm-3 col-form-label IRANYekanRegular">شماره حساب</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control IRANYekanRegular text-right" id="account" name="account" placeholder="شماره حساب" value="@if(old('account')!=null) {{ old('account') }} @elseIf($bank!=null) {{ $bank->account }} @endif">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('account') }} </span>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-group row">
                                                        <label for="account" class="col-sm-3 col-form-label IRANYekanRegular">شماره شبا</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control IRANYekanRegular text-right" id="shaba" name="shaba" placeholder="شماره شبا" value="@if(old('shaba')!=null) {{ old('shaba') }} @elseIf($bank!=null) {{ $bank->shaba }} @endif">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('shaba') }} </span>
                                                        </div>
                                                    </div>


                                                    
                                                    <div class="form-group mb-0 justify-content-end row">
                                                        <div class="col-sm-9">
                                                            <button type="submit" title="بروزرسانی" class="btn btn-info waves-effect waves-light">بروزرسانی</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-header pointer" id="heading5" data-toggle="collapse" href="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                    <h5 class="my-0">
                                        <a class="text-primary IR" data-toggle="collapse5" href="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                            # سایر مشخصات 
                                        </a>
                                    </h2>
                                </div>

                                <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
                                    <div class="card-body" style="min-height: 200px;border:1px solid #e7eaed;">
                                        <div class="row mt-2">
                                            <div class="col-12 text-center">
                                                <form  action="{{ route('website.account.profile.updateinfo') }}" method="post">
                                                    @csrf
                                                    @method('patch')

                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label for="job_id" class="col-form-label IRANYekanRegular">شغل</label>
                                                            <select class="form-control dropdopwn IR text-center"  name="job_id" id="job_id  @error('job_id') is-invalid @enderror">
                                                                <option value="">شغل خود را انتخاب نمایید...</option>
                                                                @foreach($jobs as $job)
                                                                <option value="{{ $job->id }}" class="dropdopwn" @if($job->id==old('job_id')) selected @elseif($info !=null && $job->id==$info->job_id) selected @endif>{{ $job->title }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('province_id') }} </span>
                                                        </div>

                            
                                                    </div>


                                                    <div class="form-group row">
                                                    
                                                        <div class="col-12 col-md-6">
                                                            <label for="email" class="col-form-label IRANYekanRegular">ایمیل</label>
                                                            <input type="text" class="form-control IRANYekanRegular text-right" id="email" name="email" placeholder="آدرس ایمیل" value="@if(old('email')!=null) {{ old('email') }} @elseIf($info!=null) {{ $info->email }} @endif">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('email') }} </span>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <label for="birthDate" class="col-form-label IRANYekanRegular">تاریخ تولد</label>
                                                            <input type="text" class="form-control IRANYekanRegular text-center" id="birthDate" name="birthDate" placeholder="تایخ تولد" value="@if(old('birthDate')!=null) {{ old('birthDate') }} @elseIf($info!=null) {{ $info->birth_date() }} @endif">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('birthDate') }} </span>
                                                        </div>

                                                    </div>

                                                    
                                                    <div class="form-group row">
                                                        <div class="col-12 col-md-6">
                                                            <input type="checkbox" id="maried" name="maried" value="maried" onclick="marriage()" @if(old('checkbox') || ($info!=null && $info->married)) {{ 'checked' }} @endif>
                                                            <label for="maried" class="col-form-label IRANYekanRegular">متاهل</label>
                                                            <br>
                                                            <label for="marriageDate" class="col-form-label IRANYekanRegular">تاریخ ازدواج</label>
                                                            <input type="text" class="form-control IRANYekanRegular text-center" id="marriageDate" name="marriageDate" placeholder="تایخ ازدواج" value="@if(old('birthDate')!=null) {{ old('birthDate') }} @elseIf($info!=null && $info->marriageDate!=null) {{ $info->marriage_date() ?? '' }}  @endif">
                                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('marriageDate') }} </span>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-group mb-0 justify-content-end row">
                                                        <div class="col-12">
                                                            <button type="submit" title="بروزرسانی" class="btn btn-info waves-effect waves-light">بروزرسانی</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
 
                        </div>
                    </div>
 
 
                </div>
            </div>

        </div>
    </div>


@endsection



@section('script')

    <script type="text/javascript">

        
        function marriage(res)
        {
            document.getElementById("marriageDate").value='';
        }

        $("#birthDate").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#birthDate",
            textFormat: "yyyy/MM/dd",
            isGregorian: false,
            modalMode: false,
            englishNumber: false,
            enableTimePicker: false,
            selectedDateToShow: new Date(),
            calendarViewOnChange: function(param1){
            console.log(param1);
            }
        });

        $("#marriageDate").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#marriageDate",
            textFormat: "yyyy/MM/dd",
            isGregorian: false,
            modalMode: false,
            englishNumber: false,
            enableTimePicker: false,
            selectedDateToShow: new Date(),
            calendarViewOnChange: function(param1){
            console.log(param1);
            }
        });


        //تطبیق رمز عبور
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("confirm_password");

        function validatePassword()
        {
            if(password.value != confirm_password.value)
            {
                confirm_password.setCustomValidity("رمز عبور مطابقت ندارد");
                confirm_password.style.border="2px solid #f24040";
            }
            else
            {
                confirm_password.setCustomValidity('');
                confirm_password.style.border="0px";
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

        //گرفتن شهرها توسط ایجکس
        function cities(province_id)
        {
            $.ajax({
                url:"{{ route('website.fetchcities') }}",
                type: 'get',
                data:'province_id='+province_id,
                dataType: 'json',
                success: function(response)
                {
                    var len = 0;
                    $('#city_list').empty();
                    
                    if(response['cityes'] != null){
                        len = response['cityes'].length;
                    }

                    var tr_str ="<select class='form-control dropdopwn  IR text-center' name='city_id' id='city_id' onchange='parts(this.value)'>"+
                        "<option value='' class='dropdopwn'>شهر مورد نظر را انتخاب نمایید...</option>";
                    for(var i=0; i<len; i++)
                    {
                        tr_str += "<option value='"+response['cityes'][i].id+"' class='dropdopwn'>"+response['cityes'][i].name+"</option>";
                    }
                    tr_str +="</select>";


                    $("#city_list").append(tr_str);

                }
            });
        }



        //گرفتن نواحی شهر توسط ایجکس
        function parts(city_id)
        {
            $.ajax({
                url:"{{ route('website.fetchparts') }}",
                type: 'get',
                data:'city_id='+city_id,
                dataType: 'json',
                success: function(response)
                {
                    var len = 0;
                    $('#part_list').empty();
                    if(response['parts'] != null){
                        len = response['parts'].length;
                    }

                    var tr_str ="<select class='form-control dropdopwn  IR text-center' name='part_id' id='part_id'>"+
                        "<option value='' class='dropdopwn'>ناحیه مورد نظر را انتخاب نمایید...</option>";
                    for(var i=0; i<len; i++)
                    {
                        tr_str += "<option value='"+response['parts'][i].id+"' class='dropdopwn'>"+response['parts'][i].name+"</option>";
                    }
                    tr_str +="</select>";


                    $("#part_list").append(tr_str);

                }
            });
        }

 
    </script>
@endsection