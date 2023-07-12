@extends('crm.master')

@section('content')

<div class="content-page">

    <div class="content">
  
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-ticket-alt page-icon"></i>
                             ارسال تیکت جدید
                        </h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="margin:auto">

                                <form class="form-horizontal" action="{{ route('website.account.tickets.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="title" class="control-label IRANYekanRegular">عنوان</label>
                                            <input type="text" class="form-control input" name="title" id="title" placeholder="عنوان را وارد کنید" value="{{ old('title') }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="form-group col-12 col-md-6">
                                            <label for="priority" class="control-label IRANYekanRegular">اولیت</label>
                                            <select class="form-control dropdopwn"  name="priority" id="priority"  @error('priority') is-invalid @enderror">
                                                <option value="{{ App\Enums\TicketPriority::Low }}" {{ App\Enums\TicketPriority::Low==old('priority')?'selected':'' }}>کم</option>
                                                <option value="{{ App\Enums\TicketPriority::Medium }}" {{ App\Enums\TicketPriority::Medium==old('priority')?'selected':'' }}>متوسط</option>
                                                <option value="{{ App\Enums\TicketPriority::High }}" {{ App\Enums\TicketPriority::High==old('priority')?'selected':'' }}>زیاد</option>
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('priority') }} </span>
                                        </div>

                                        <div class="form-group col-12 col-md-6">
                                            <label for="department" class="control-label IRANYekanRegular">واحد</label>
                                            <select class="form-control dropdopwn"  name="department" id="department"  @error('department') is-invalid @enderror">
                                                <option value="">واحد مورد نظر را انتخاب نمایید...</option>
                                                @foreach(App\Models\Department::orderBy('name','desc')->get() as $department)
                                                <option value="{{ $department->id }}" {{ $department->id==old('department')?'selected':'' }}>{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('department') }} </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="name" class="control-label IRANYekanRegular">متن</label>
                                            <textarea type="text" class="form-control input" name="content" id="content" placeholder="متن را وارد کنید...">{{ old('content') }}</textarea>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('content') }} </span>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <label for="attach" class="col-2 col-form-label  IRANYekanRegular">ضمیمه:</label>
                                        <div class="fileupload btn btn-success waves-effect waves-light mb-3">
                                            <span><i class="mdi mdi-cloud-upload mr-1"></i>ضمیمه</span>
                                            <input type="file" class="upload" name="attach" value="{{ old('attach') }}">
                                        </div>
                                        &nbsp;&nbsp;
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('attach') }} </span>
                                    </div>

                   
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">ارسال</button>
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
