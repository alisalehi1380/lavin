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
                                {{ Breadcrumbs::render('phones.create') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-phone page-icon"></i>
                             ایجاد  تلفن جدید
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

                                <form class="form-horizontal" action="{{ route('admin.phones.store') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="name" class="control-label IRANYekanRegular">عنوان</label>
                                            <input type="text" class="form-control input" name="title" id="title" placeholder="عنوان را وارد کنید" value="{{ old('title') }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="phone" class="control-label IRANYekanRegular">تلفن تماس</label>
                                            <input type="text" class="form-control input text-right" name="phone" id="phone" placeholder="تلفن تماس را وارد کنید" value="{{ old('phone') }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('phone') }} </span>
                                        </div>
                                    </div>

    
                       
                                    <div class="form-group col-md-4">
                                        <label for="account" class="col-form-label IRANYekanRegular">وضعیت</label>
                                        <select name="status" id="st" class="form-control dropdown IR">
                                            <option value="{{ App\Enums\Status::Active }}" {{ App\Enums\Status::Active==old('status')?'selected':'' }}>فعال</option>
                                            <option value="{{ App\Enums\Status::Deactive }}" {{ App\Enums\Status::Deactive==old('status')?'selected':'' }}>غیرفعال</option>
                                        </select>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('status') }} </span>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">ثبت</button>
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
