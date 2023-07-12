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
                            <ol class="breadcrumb m-0">
                           
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-layer-group page-icon"></i>
                            ویرایش سطح 
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body" style="padding:70px;">

                            <form method="POST" action="{{ route('admin.levels.update',$level) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="title" class="col-md-12 col-form-label text-md-left IRANYekanRegular">عنوان:</label>
                                        <input id="title" type="text" class="form-control  @error('name') is-invalid @enderror" name="title" value="{{ old('title') ?? $level->title }}"  autofocus placeholder="عنوان">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="point" class="col-md-12 col-form-label text-md-left IRANYekanRegular">امتیاز:</label>
                                        <input id="point" type="number" class="form-control text-center  @error('point') is-invalid @enderror" name="point" value="{{ old('point') ?? $level->point }}"  autofocus placeholder="امتیاز">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('point') }} </span>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12" style="display:inherit;">
                                        <input type="radio" id="active" name="status" value="{{ App\Enums\Status::Active }}" @if(old('status')==App\Enums\Status::Active || $level->status==App\Enums\Status::Active) checked @endif>
                                        &nbsp;
                                        <label for="active">فعال</label><br>
                                        &nbsp;&nbsp; &nbsp;
                                        <input type="radio" id="deactive" name="status" value="{{ App\Enums\Status::Deactive }}" @if(old('status')==App\Enums\Status::Deactive || $level->status==App\Enums\Status::Deactive) checked @endif>
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

