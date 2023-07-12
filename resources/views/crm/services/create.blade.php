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
                            <!-- {{ Breadcrumbs::render('article-add-cat') }} -->
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fab fa-servicestack page-icon"></i>
                             ایجاد سرویس جدید
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

                                <form class="form-horizontal" action="{{ route('admin.services.store') }}" method="post">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="name" class="control-label IRANYekanRegular">نام سرویس</label>
                                            <input type="text" class="form-control input" name="name" id="name" placeholder="نام سرویس را وارد کنید" value="{{ old('name') }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                        </div>
                                    </div>

                                    <div class="row mt-2">

                                        <div class="col-md-6">
                                            <label for="prent" class="col-form-label text-md-right IRANYekanRegular" id="prent" >دسته اصلی:</label>
                                            <select class='form-control dropdopwn' name='parent' id='parent' onchange="subcat(this.value)">
                                                <option value='' class='dropdopwn'>دسته اصلی را وارد نمایید...</option>
                                                @foreach($parents as $parent)
                                                    <option value="{{ $parent->id }}" class="dropdopwn" {{ $parent->id==old('parent')?'selected':'' }}>{{ $parent->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('sport_league') }} </span>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="child" class="col-form-label text-md-right IRANYekanRegular" id="prent" >دسته فرعی:</label>
                                            <div id="child_cat">
                                                <select class='form-control dropdopwn' name='child' id='child'>
                                                    <option value='' class='dropdopwn'>دسته فرعی را وارد نمایید...</option>
                                                    @if(old('parent'))
                                                    @foreach(App\Models\ServiceCategory::where('parent_id',old('parent'))->where('status',App\Enums\Status::Active)->get() as $cat)
                                                    <option value='{{ $cat->id }}' class='dropdopwn' {{ $cat->id==old('child')?'selected':'' }}>{{ $cat->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('child') }} </span>
                                        </div>
                                        
                                    </div>



                                    <div class="row mt-2">
                                        <div class="col-12">
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

@section('script')  
    <script>
    
        //گرفتن  زیردسته های مربوطه توسط ایجکس
        function subcat(cat_id)
        {
            $.ajax({
                url: "{{ route('admin.services.categories.fetch_child') }}",
                type: 'get',
                dataType: 'json',
                data:'cat_id='+cat_id,
                success: function(response)
                {
                    var len = 0;
                    $('#child_cat').empty();
                    if(response['childs'] != null){
                        len = response['childs'].length;
                    }

                    var tr_str ="<select class='form-control dropdopwn' name='child' id='child'>"+
                        "<option value='' class='dropdopwn'>دسته فرعی را انتخاب کنید...</option>";
                    for(var i=0; i<len; i++)
                    {
                        tr_str += "<option value='"+response['childs'][i].id+"' class='dropdopwn'>"+response['childs'][i].name+"</option>";
                    }
                    tr_str +="</select>";


                    $("#child_cat").append(tr_str);

                }
            });
        }

    </script>
@endsection