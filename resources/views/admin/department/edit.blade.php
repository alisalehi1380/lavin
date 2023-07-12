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
                                {{ Breadcrumbs::render('ticket.departments.edit',$department) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-building page-icon"></i>
                              ویرایش واحد
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

                                <form class="form-horizontal" action="{{ route('admin.departments.update',$department) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}

                                    <div class="row my-2">
                                        <div class="col-sm-12">
                                            <label for="name" class="control-label IRANYekanRegular">عنوان واحد</label>
                                            <input type="text" class="form-control input" name="name" id="name" placeholder="عنوان را وارد کنید" value="{{ old('name') ?? $department->name }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-12" style="display:inherit;">
                                            <input type="radio" id="active" name="status" value="{{ App\Enums\Status::Active }}" @if(App\Enums\Status::Active==old('status') || App\Enums\Status::Active==$department->status) checked @endif>
                                            &nbsp;
                                            <label for="active">فعال</label><br>
                                            &nbsp;&nbsp; &nbsp;
                                            <input type="radio" id="deactive" name="status" value="{{ App\Enums\Status::Deactive }}" @if(App\Enums\Status::Deactive==old('status') || App\Enums\Status::Deactive==$department->status) checked @endif>
                                            &nbsp;
                                            <label for="deactive">غیرفعال</label><br>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">بروزرسانی</button>
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
