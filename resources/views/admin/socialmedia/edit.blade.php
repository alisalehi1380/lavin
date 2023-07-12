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
                                {{ Breadcrumbs::render('socialmedia.edit',$socialmedia) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fab fa-facebook page-icon"></i>
                             ویرایش شکبه اجتماعی
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

                                <form class="form-horizontal" action="{{ route('admin.socialmedia.update',$socialmedia) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @method('PATCH')


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="name" class="control-label IRANYekanRegular">عنوان</label>
                                            <input type="text" class="form-control input" name="name" id="name" placeholder="عنوان را وارد کنید" value="{{ $socialmedia->name }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="link" class="control-label IRANYekanRegular">لینک</label>
                                            <input type="text" class="form-control input" name="link" id="link" placeholder="لینک را وارد کنید" value="{{ $socialmedia->link }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('link') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="icon" class="control-label IRANYekanRegular">آیکن</label>
                                            <input type="text" class="form-control input" name="icon" id="icon" placeholder="آیکن را وارد کنید" value="{{ $socialmedia->icon }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('icon') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="account" class="col-form-label IRANYekanRegular">وضعیت</label>
                                        <select name="status" id="st" class="form-control dropdown IR">
                                            <option value="{{ App\Enums\Status::Active }}" {{ App\Enums\Status::Active==$socialmedia->status?'selected':'' }}>فعال</option>
                                            <option value="{{ App\Enums\Status::Deactive }}" {{ App\Enums\Status::Deactive==$socialmedia->status?'selected':'' }}>غیرفعال</option>
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
