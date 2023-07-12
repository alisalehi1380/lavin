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
                            <ol class="breadcrumb m-0 IR">
                              
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body" style="padding:70px;">

                            <form method="POST" action="{{ route('website.account.numbers.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-12 col-form-label text-md-left IRANYekanRegular">نام و نام خانوادگی:</label>
                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autofocus placeholder="نام و نام خانوادگی">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                    </div>
                                </div>

                                <div class="form-group row" >
                                    <label for="name" class="col-md-12 col-form-label text-md-left IRANYekanRegular">شماره موبایل:</label>
                                    <div class="col-md-12">
                                        <input id="mobile" type="text" class="text-right form-control  @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}"  autofocus placeholder="شماره موبایل">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('mobile') }} </span>
                                    </div>
                                </div>

                                <div class="form-group row">
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

