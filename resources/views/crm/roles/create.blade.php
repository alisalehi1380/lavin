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
                              {{ Breadcrumbs::render('add-role') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-universal-access page-icon"></i>
                            افزودن نقش جدید
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body" style="padding:70px;">

                            <form method="POST" action="{{ route('admin.roles.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-12 col-form-label text-md-left IRANYekanRegular">عنوان:</label>
                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autofocus placeholder="عنوان">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                    </div>
                                </div>

                                <div class="form-group row" >
                                    <label for="name" class="col-md-12 col-form-label text-md-left IRANYekanRegular">توضیحات:</label>
                                    <div class="col-md-12">
                                        <input id="description" type="text" class="form-control  @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"  autofocus placeholder="توضیحات">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('description') }} </span>
                                    </div>
                                </div>
 
 
                                <div class="form-group row">
                                    <label for="password" class="col-md-12 col-form-label text-md-left IRANYekanRegular">دسترسی‌ها:</label>
                                    <div class="col-md-12">
                                    <select name="permissions[]" id="permissions" class="select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="انتخاب نقش‌ها...">
                                        @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}">({{ $permission->description }}) {{ $permission->name }}</option>
                                       @endforeach
                                    </select>
                                    <span class="form-text text-danger erroralarm"> {{ $errors->first('permissions') }} </span>
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

