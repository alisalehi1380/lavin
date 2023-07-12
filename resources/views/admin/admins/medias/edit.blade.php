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
                            {{ Breadcrumbs::render('admins.medias.edit',$admin,$media) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fab fa-instagram page-icon"></i>
                              ویرایش شبکه‌اجتماعی 
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

                                <form class="form-horizontal" action="{{ route('admin.admins.medias.update',[$admin,$media]) }}" method="post">
                                    {{ csrf_field() }}
                                    @method('PATCH')

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="feild" class="control-label IRANYekanRegular">نام شبکه اجتماعی</label>
                                            <input type="text" class="form-control input" name="name" id="name" placeholder="نام  شبکه اجتماعی را وارد کنید" value="{{ old('name') ?? $media->name }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="link" class="control-label IRANYekanRegular">لینک</label>
                                            <input type="text" class="form-control input text-right" name="link" id="link" placeholder="لینک شبکه‌های اجتماعی را وارد کنید" value="{{ old('link') ?? $media->link }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('link') }} </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" title="ثبت" class="btn btn-info">بروزرسانی</button>
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
