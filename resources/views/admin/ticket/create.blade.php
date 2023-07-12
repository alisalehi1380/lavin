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
                            {{ Breadcrumbs::render('tickets.create') }}
                        </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-ticket-alt page-icon"></i>
                             ارسال تیکت جدید
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

                                <form class="form-horizontal" action="{{ route('admin.tickets.store') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="name" class="control-label IRANYekanRegular">عنوان</label>
                                            <input type="text" class="form-control input" name="name" id="name" placeholder="عنوان را وارد کنید" value="{{ old('name') }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="priority" class="control-label IRANYekanRegular">اولیت</label>
                                            <select class="form-control dropdopwn"  name="priority" id="priority"  @error('priority') is-invalid @enderror">
                                                <option value="{{ App\Enums\TicketPriority::Low }}" {{ App\Enums\TicketPriority::Low==old('priority')?'selected':'' }}>کم</option>
                                                <option value="{{ App\Enums\TicketPriority::Medium }}" {{ App\Enums\TicketPriority::Medium==old('priority')?'selected':'' }}>متوسط</option>
                                                <option value="{{ App\Enums\TicketPriority::High }}" {{ App\Enums\TicketPriority::High==old('priority')?'selected':'' }}>زیاد</option>
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('priority') }} </span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="department" class="control-label IRANYekanRegular">واحد</label>
                                            <select class="form-control dropdopwn"  name="department" id="department"  @error('department') is-invalid @enderror">
                                                <option value="">واحد مورد نظر را انتخاب نمایید...</option>
                                                @foreach(App\Models\Department::orderBy('name','desc')->get() as $department)
                                                <option value="{{ $department->id }}" {{ $department->id==old('department')?'selected':'' }}>{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('priority') }} </span>
                                        </div>
                                    </div>
 
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="name" class="control-label IRANYekanRegular">متن</label>
                                            <textarea type="text" class="form-control input" name="content" id="content" placeholder="متن را وارد کنید">{{ old('content') }}</textarea>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('content') }} </span>
                                        </div>
                                    </div>

                                    <br> <br>
                                    <div class="form-group row">
                                        <label for="attach" class="col-md-2 col-form-label text-md-right IRANYekanRegular">فایل ضمیمه:</label>
                                        <div class="fileupload btn btn-success waves-effect waves-light mb-3">
                                            <span><i class="mdi mdi-cloud-upload mr-1"></i>ضمیمه</span>
                                            <input type="file" class="upload" name="attach" value="{{ old('attach') }}">
                                        </div>
                                        &nbsp;&nbsp;
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('attach') }} </span>
                                    </div>

                   
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">ثبت</button>
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

<script>

 
function audience(id)
{
    $.ajax({
        url: 'getaudience/'+id,
        type: 'get',
        dataType: 'json',
        success: function(response)
        {
            var len = 0;
            $('#audience').empty();
            if(response['data'] != null){
                len = response['data'].length;
            }

            var tr_str ="<label for='audience_id' class='control-label IRANYekanRegular'>مخاطب</label>"+
                "<select class='form-control dropdopwn' name='audience_id' id='audience_id'>"+
                "<option value='' class='dropdopwn'>مخاطب تیکت را انتخاب نمایید</option>";
            for(var i=0; i<len; i++)
            {
                tr_str += "<option value='"+response['data'][i].id+"' class='dropdopwn'>"+response['data'][i].info.name+"</option>";
            }
            tr_str +="</select>";


            $("#audience").append(tr_str);

        }
    });
}

</script>
@endsection
