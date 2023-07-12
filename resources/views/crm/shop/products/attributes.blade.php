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
                             <i class="fa fa-info page-icon"></i>
                            ویژگی‌های محصول
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

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <button type="button" title="افزودن" class="btn btn-primary IR" onclick="add()">
                                            افزودن ویژگی جدید 
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <input type="hidden" id="index" value="{{ $product->attributes!=null?count(json_decode($product->attributes,true))+1:0 }}">
                                    </div>
                                </div>


                                <form class="form-horizontal" action="{{ route('admin.shop.products.attributes.update',$product) }}" method="post">
                                    {{ csrf_field() }}
                                    @method('patch')

                                    <div id="attributes">
                                        @if($product->attributes!=null)
                                            @foreach (json_decode($product->attributes) as $key=>$value)
                                                <div  class="row mt-2" id="row{{ $loop->index }}">
                                                    <div class="col-5">
                                                        <input type="text" class="form-control  @error('property') is-invalid @enderror" name="property[]" id="property" value="{{ $key }}"   placeholder="ویژگی">
                                                    </div>

                                                    <div class="col-5">
                                                        <input type="text" class="form-control  @error('value') is-invalid @enderror" name="value[]" id="value" value="{{ $value }}"   placeholder="مقدار">
                                                    </div>

                                                    <div class="col-2">
                                                        <button type='button' title='حدف' class='btn btn-danger' onclick='remove({{ $loop->index }})'>
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div  class="row mt-2" id="row0">
                                                <div class="col-5">
                                                    <input type="text" class="form-control  @error('property') is-invalid @enderror" name="property[]" id="property" value=""   placeholder="ویژگی">
                                                </div>

                                                <div class="col-5">
                                                    <input type="text" class="form-control  @error('value') is-invalid @enderror" name="value[]" id="value" value=""   placeholder="مقدار">
                                                </div>

                                                <div class="col-2">
                                                 
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" title="بروزرسانی" class="btn btn-success IR">
                                                 بروزرسانی
                                            </button>
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
@endsection

@section('script')
    <script>
        function add()
        {
            var index = document.getElementById('index').value;
            document.getElementById('index').value = ++index;
            
            var str_append = `<div class='row mt-2' id='row${index}'>
                <div class='col-5'>
                    <input type='text' class='form-control  @error('property') is-invalid @enderror' name='property[]' id='property${index}' value=''  placeholder='ویژگی'>
                </div>

                <div class='col-5'>
                    <input type='text' class='form-control  @error('value') is-invalid @enderror' name='value[]' id='value${index}' value=''  placeholder='مقدار'>
                </div>

                <div class='col-2'>
                    <button type='button' title='حدف' class='btn btn-danger' onclick='remove(${index})'>
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>`;
 
            document.getElementById('attributes').innerHTML  += str_append;
           
        }

        function remove(index)
        {
            var row = 'row'+index;
            document.getElementById(row).remove();
        }
    </script>
@endsection
