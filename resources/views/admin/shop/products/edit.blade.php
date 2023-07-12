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
                              {{ Breadcrumbs::render('products.edit',$product) }}  
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fab fa-product-hunt page-icon"></i>
                            ویرایش محصول
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

                                <form class="form-horizontal" action="{{ route('admin.shop.products.update',$product) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @method('patch')

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="name" class="control-label IRANYekanRegular">نام محصول</label>
                                            <input type="text" class="form-control input" name="name" id="name" placeholder="نام محصول را وارد کنید" value="{{ old('name') ?? $product->name }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                        </div>
                                    </div>

                                    <div class="row mt-2">

                                        <div class="col-md-6">
                                            <label for="prent" class="col-form-label text-md-right IRANYekanRegular" id="prent" >دسته اصلی:</label>
                                            <select class='form-control dropdopwn' name='parent' id='parent' onchange="subcat(this.value)">
                                                <option value='' class='dropdopwn'>دسته اصلی را وارد نمایید...</option>
                                                @foreach($parents as $parent)
                                                    <option value="{{ $parent->id }}" class="dropdopwn" {{ $parent->id==old('parent')||$product->parent?'selected':'' }}>{{ $parent->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('parent') }} </span>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="child" class="col-form-label text-md-right IRANYekanRegular" id="prent" >دسته فرعی:</label>
                                            <div id="child_cat">
                                                <select class='form-control dropdopwn' name='child' id='child'>
                                                    <option value='' class='dropdopwn'>دسته فرعی را وارد نمایید...</option>
                                                    @if(old('parent'))
                                                    @foreach(App\Models\ProductCategory::where('parent_id',old('parent'))->where('status',App\Enums\Status::Active)->get() as $cat)
                                                    <option value='{{ $cat->id }}' class='dropdopwn' {{ $cat->id==old('child')?'selected':'' }}>{{ $cat->name }}</option>
                                                    @endforeach
                                                    @else
                                                    @foreach(App\Models\ProductCategory::where('parent_id',$product->parent)->where('status',App\Enums\Status::Active)->get() as $cat)
                                                    <option value='{{ $cat->id }}' class='dropdopwn' {{ $cat->id==$product->child?'selected':'' }}>{{ $cat->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('child') }} </span>
                                            </div>
                                            
                                        </div>
                                   </div>

                                    <div class="row  mt-2">
                                        <div class="col-12 col-md-6">
                                            <label for="price" class="control-label IRANYekanRegular">قمیت(تومان)</label>
                                            <input type="text" class="form-control input text-right" name="price" id="price" placeholder="قیمت را وارد کنید" value="{{ old('price') ?? $product->price  }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('price') }} </span>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="stock" class="control-label IRANYekanRegular">موجودی</label>
                                            <input type="text" class="form-control input text-right" name="stock" id="stock" placeholder="موجودی را وارد کنید" value="{{ old('stock') ?? $product->stock  }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('stock') }} </span>
                                        </div>
                                    </div>

                                    <div class="row  mt-2">
                                        <div class="col-12 col-md-2">
                                            <div class="custom-control custom-checkbox mt-4">
                                                <input type="checkbox" class="custom-control-input" id="special" name="special" {{ old('special')=='on'|| $product->special?'checked':'' }}>
                                                <label class="custom-control-label IRANYekanRegular" for="special"> ویژه</label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-5">
                                            <label for="specialDateTime" class="control-label IRANYekanRegular">مهلت فروش ویژه:</label>
                                            
                                            <div class="input-group-append">
                                            <input type="text" class="form-control text-center" id="specialDateTime" name="specialDateTime" value="{{ old('specialDateTime') ?? \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i:s',strtotime($product->specialDateTime)))  }}"  readonly>
                                                  <button class="btn btn-danger" type="button" onclick="reset()">
                                                  <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('specialDateTime') }} </span>
                                        </div>

                                        <div class="col-12 col-md-5">
                                            <label for="specialPrice" class="control-label IRANYekanRegular">قیمت ویژه (تومان):</label>
                                            <input id="specialPrice" type="text" class="form-control  @error('specialPrice') is-invalid @enderror text-right" name="specialPrice" value="{{ old('specialPrice') ?? $product->specialPrice  }}"  autofocus placeholder="قیمت ویژه (تومان):">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('specialPrice') }} </span>
                                        </div>
                                    </div>
                                        

                                    <div class="row my-2">
                                        <div class="col-sm-12">
                                            <label for="description" class="control-label IRANYekanRegular">توضیحات</label>
                                             <textarea class="form-control" row="100" class="form-control" name="description" id="description" placeholder="توضیحات...">{{ old('description') ?? $product->description }}</textarea>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('description') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <img src="{{ $product->thumbnail->getImagePath('medium') }}" >
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                            <span><i class="mdi mdi-cloud-upload mr-1"></i>تصویر شاخص</span>
                                            <input type="file" class="upload" name="thumbnail" value="" accept="image/*">
                                        </div>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('thumbnail') }} </span>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-12" style="display:inherit;">
                                            <input type="radio" id="active" name="status" value="{{ App\Enums\Status::Active }}"  @if(old('status')==App\Enums\Status::Active || $product->status ==App\Enums\Status::Active) checked @endif>
                                            &nbsp;
                                            <label for="active">فعال</label><br>
                                            &nbsp;&nbsp; &nbsp;
                                            <input type="radio" id="deactive" name="status" value="{{ App\Enums\Status::Deactive }}" @if(old('status')==App\Enums\Status::Deactive || $product->status ==App\Enums\Status::Deactive) checked @endif>
                                            &nbsp;
                                            <label for="deactive">غیرفعال</label><br>
                                        </div>
                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-sm-12">
                                            <button type="submit" title="بروزرسانی" class="btn btn-info">بروزرسانی</button>
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
    
        function reset()
        {
            document.getElementById('specialDateTime').value='';
        }


        $("#specialDateTime").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#specialDateTime",
            textFormat: "yyyy/MM/dd HH:mm:ss",
            isGregorian: false,
            modalMode: false,
            englishNumber: false,
            enableTimePicker: true,
            selectedDateToShow: new Date(),
            calendarViewOnChange: function(param1){
            console.log(param1);
            }
        });

 
        //گرفتن  زیردسته های مربوطه توسط ایجکس
        function subcat(cat_id)
        {
            $.ajax({
                url: "{{ route('admin.shop.products.categories.fetch_child') }}",
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
