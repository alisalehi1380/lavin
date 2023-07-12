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
                            {{ Breadcrumbs::render('admins.feilds.create',$admin) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-user-graduate page-icon"></i>
                             ایجاد رشته جدید
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

                                <form class="form-horizontal" action="{{ route('admin.admins.feilds.store',$admin) }}" method="post">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="feild" class="control-label IRANYekanRegular">عنوان رشته</label>
                                            <input type="text" class="form-control input" name="feild" id="feild" placeholder="عنوان رشته را وارد کنید" value="{{ old('feild') }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('feild') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="level" class="control-label IRANYekanRegular">مقطع تحصیلی</label>
                                            <input type="text" class="form-control input" name="level" id="level" placeholder=" مقطع تحصیلی را وارد کنید" value="{{ old('level') }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('level') }} </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" title="ثبت" class="btn btn-primary">ثبت</button>
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
