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
                                {{ Breadcrumbs::render('notifications.create') }}
                            </ol> 
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-bell page-icon"></i>
                            ارسال اعلان جدید
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <strong>
                                        {!! implode('<br/>', $errors->all('<span class="IR">:message</span>')) !!}
                                    </strong>
                                </div>
                            @endif


                            <form method="POST" action="{{ route('admin.notifications.store') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <label for="title" class="col-form-label text-md-right IRANYekanRegular">عنوان:</label>
                                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"  autofocus placeholder="عنوان">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="message" class="col-form-label text-md-right IRANYekanRegular">متن پیام:</label>
                                        <textarea id="message" row="10" name="message"  autofocus placeholder="متن پیام...">{{ old('message') }}</textarea>     
                                    </div>
                                </div>

                                <!-- <div class="row mt-1">
                                    <div class="col-12">
                                        <label for="users" class="control-label IRANYekanRegular">کاربران (نام و نام خانوادگی یا موبایل...)</label>
                                        <select class="select2 select2-multiple IRANYekanRegular" multiple="multiple" multiple data-placeholder="انتخاب کاربران..." name="users[]" id="users"></select>
                                    </div>
                                </div> -->

                                <div class="row">
                                    <div class="col-12">
                                        <label for="users" class="col-form-label IRANYekanRegular">کاربران:</label>
                                            <select name="users[]" id="users" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ $user->id==old('users')?'selected':'' }}>{{ $user->firstname.' '.$user->lastname.' ('.$user->mobile.')' }}</option>
                                                @endforeach
                                            </select>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('users') }} </span>
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-12">
                                        <fieldset style="border:1px solid #ced4da" class="p-3">
                                            <legend style="width:100px;" >سطوح کاربران:</legend>
                                            @foreach($levels as $level)
                                            <div class="m-2" style="display: inline-block">
                                                <input type="checkbox" name="levels[]" id="levles{{ $level->id }}" value="{{ $level->id }}">
                                                <label  for="levles{{ $level->id }}" class="control-label IRANYekanRegular">{{ $level->title }}</label>
                                            </div>
                                            @endforeach
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12" style="display:inherit;">
                                        <input type="radio" id="active" name="status" value="{{ App\Enums\Status::Active }}" checked>
                                         &nbsp;
                                        <label for="active">فعال</label><br>
                                         &nbsp;&nbsp; &nbsp;
                                        <input type="radio" id="deactive" name="status" value="{{ App\Enums\Status::Deactive }}">
                                         &nbsp;
                                        <label for="deactive">غیرفعال</label><br>
                                    </div>
                                </div>


                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <button type="submit" title="ثبت" class="btn btn-primary">ثبت</button>
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


<!-- @section('script')

    <script type="text/javascript">
        $("#users").select2({
            placeholder: '...نام و نام خانوادگی یا شماره موبایل',
            ajax: {
                url: '{{ route("admin.users.fetch") }}',
                processResults: function (data, params) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id,
                                data: item
                            };
                        })
                    };
                }
            }
        });
    </script>

@endsection -->



@endsection

