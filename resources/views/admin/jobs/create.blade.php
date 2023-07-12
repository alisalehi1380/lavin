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
                               {{ Breadcrumbs::render('jobs.create') }} 
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fa fa-graduation-cap page-icon"></i>
                            افزودن شغل جدید
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body p-3">

                            <form method="POST" action="{{ route('admin.jobs.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <label for="title" class="col-md-12 col-form-label text-md-left IRANYekanRegular">عنوان:</label>
                                        <input id="title" type="text" class="form-control  @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"  autofocus placeholder="عنوان">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12" style="display:inherit;">
                                        <input type="radio" id="active" name="status" value="{{ App\Enums\Status::Active }}" @if(old('status')!=App\Enums\Status::Deactive) checked @endif>
                                        &nbsp;
                                        <label for="active">فعال</label><br>
                                        &nbsp;&nbsp; &nbsp;
                                        <input type="radio" id="deactive" name="status" value="{{ App\Enums\Status::Deactive }}" @if(old('status')==App\Enums\Status::Deactive) checked @endif>
                                        &nbsp;
                                        <label for="deactive">غیرفعال</label><br>
                                    </div>
                                </div>

 

                                <div class="mt-2 row">
                                    <div class="col-md-1 text-right">
                                        <button type="submit" class="btn btn-primary">ثبت</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
</div>
 
@endsection

