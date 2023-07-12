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
                                {{ Breadcrumbs::render('rewiewgroups.create') }}
                        </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-layer-group page-icon"></i>
                               ایجاد گروه بازخورد جدید
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

                                <form class="form-horizontal" action="{{ route('admin.rewiewGroups.store') }}" method="post">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <div class="co-12">
                                            <label for="title" class="control-label IRANYekanRegular">عنوان گروه</label>
                                            <input type="text" class="form-control input" name="title" id="title" placeholder="عنوان گروه را وارد کنید" value="{{ old('title') }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                        </div>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-6">
                                            <label for="type" class="control-label IRANYekanRegular">نوع</label>
                                            <select class="form-control IR" name="type" id="type">
                                                <option value="{{ App\Enums\ReviewGroupType::Service }}" @if(App\Enums\ReviewGroupType::Service==old("type")) {{ 'selected' }} @endif)>سرویس‌ها</option>
                                                <option value="{{ App\Enums\ReviewGroupType::Shop }}" @if(App\Enums\ReviewGroupType::Shop==old('type')) {{ 'selected' }} @endif>محصولات</option>
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('type') }} </span>
                                        </div>
                                        <div class="col-6" style="display:inherit;">
                                            <input type="radio" id="active" name="status" value="{{ App\Enums\Status::Active }}" @if(App\Enums\Status::Deactive!=old("status")) {{ 'checked' }} @endif>
                                            &nbsp;
                                            <label for="active" class="mt-3">فعال</label><br>
                                            &nbsp;&nbsp; &nbsp;
                                            <input type="radio" id="deactive" name="status" value="{{ App\Enums\Status::Deactive }}" @if(App\Enums\Status::Deactive==old("status")) {{ 'checked' }} @endif>
                                            &nbsp;
                                            <label for="deactive" class="mt-3">غیرفعال</label><br>
                                        </div>
                                    </div>


                                    <div class="row mt-3">
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
