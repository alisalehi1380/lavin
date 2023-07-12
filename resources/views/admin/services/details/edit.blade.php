@extends('admin.master')

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
                            <ol class="breadcrumb m-0 IR">
                            {{ Breadcrumbs::render('services.detiles.edit',$service,$detail) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fa fa-info page-icon"></i>
                              ویرایش  سرویس
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="margin:auto">

                                <form class="form-horizontal" action="{{ route('admin.services.details.update',[$service,$detail]) }}" method="post">
                                    {{ csrf_field() }}
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="name" class="control-label IRANYekanRegular">عنوان</label>
                                            <input type="text" class="form-control input" name="name" id="name" placeholder="عنوان را وارد کنید..." value="{{ old('name') ?? $detail->name }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="price" class="control-label IRANYekanRegular">قیمت:</label>
                                            <input type="text" class="form-control input text-right" name="price" id="price" placeholder="قیمت را وارد کنید..." value="{{ old('price') ?? $detail->price }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('price') }} </span>
                                        </div>
                                    </div>

                                    
                                    <div class="row mt-2">

                                        <div class="col-12 col-md-6">
                                            <label for="point" class="control-label IRANYekanRegular">امتیاز سرویس</label>
                                            <input type="number" class="form-control input text-center" name="point" id="point" placeholder="متیاز سرویس را وارد کنید..." value="{{ old('point') ?? $detail->point }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('point') }} </span>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="porsant" class="control-label IRANYekanRegular">امتیاز معرف</label>
                                            <input type="number" class="form-control input text-center" name="porsant" id="porsant" placeholder="امتیاز معرف را وارد کنید..." value="{{ old('porsant') ?? $detail->porsant }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('porsant') }} </span>
                                        </div>

                                    </div>

                                    
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="breif" class="control-label IRANYekanRegular">توضیح کوتاه</label>
                                            <input type="text" class="form-control input" name="breif" id="breif" placeholder="توضیح کوتاه را وارد کنید..." value="{{ old('breif') ?? $detail->breif }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('breif') }} </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="breif" class="control-label IRANYekanRegular">توضیح</label>
                                            <textarea name="desc" id="desc" row="9">{{ old('desc') ?? $detail->desc }}</textarea>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('desc') }} </span>
                                        </div>
                                    </div>
                                                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="doctors" class="ol-form-label text-md-right IRANYekanRegular">پزشکان مرتبط:</label>
                                            <select name="doctors[]" id="doctors" class="select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="انتخاب نقش‌ها..." @error('serviceses') is-invalid @enderror>
                                                @foreach($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}" {{ in_array($doctor->id,$detail->doctors->pluck('id')->toArray())?'selected':'' }}>{{ $doctor->fullname }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('doctors') }} </span>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-12" style="display:inherit;">
                                            <input type="radio" id="active" name="status" value="{{ App\Enums\Status::Active }}" @if(App\Enums\Status::Active==old('status') || $detail->status== App\Enums\Status::Active) checked @endif>
                                            &nbsp;
                                            <label for="active">فعال</label><br>
                                            &nbsp;&nbsp; &nbsp;
                                            <input type="radio" id="deactive" name="status" value="{{ App\Enums\Status::Deactive }}" @if(App\Enums\Status::Deactive==old('status') || $detail->status== App\Enums\Status::Deactive) checked @endif>
                                            &nbsp;
                                            <label for="deactive">غیرفعال</label><br>
                                        </div>
                                    </div>

                                    


                                    <div class="row mt-2">
                                        <div class="col-sm-12">
                                            <button type="submit" title="بروزرسانی" class="btn btn-info">بروزرسانی</button>
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
@endsection
