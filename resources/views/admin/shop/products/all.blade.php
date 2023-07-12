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
                            {{ Breadcrumbs::render('products') }}
                        </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fab fa-product-hunt page-icon"></i>
                              محصولات
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row" style="margin-bottom: 20px;">
                               
                                <div class="col-6">
                                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="collapseExample" title="فیلتر">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                </div>

                                <div class="col-6 text-right">
                                    @if(Auth::guard('admin')->user()->can('shop.products.create'))
                                    <div class="btn-group" >
                                        <a href="{{ route('admin.shop.products.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">ایجاد‌ محصول جدید</b>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">
                                        <div class="row">

                                            <div class="form-group justify-content-center col-6">
                                                <label for="name" class="control-label IRANYekanRegular">عنوان دسته بندی</label>
                                                <input type="text"  class="form-control input" id="name-filter" name="name" placeholder="عنوان را وارد کنید" value="{{ request('name') }}">
                                            </div>

                                        </diV>

                                 

                                        <div class="form-group col-12 d-flex justify-content-center mt-3">

                                            <button type="submit" class="btn btn-info col-lg-2 offset-lg-4 cursor-pointer">
                                                <i class="fa fa-filter fa-sm"></i>
                                                <span class="pr-2">فیلتر</span>
                                            </button>

                                            <div class="col-lg-2">
                                                <a onclick="reset()" class="btn btn-light border border-secondary cursor-pointer">
                                                    <i class="fas fa-undo fa-sm"></i>
                                                    <span class="pr-2">پاک کردن</span>
                                                </a>
                                            </div>


                                            <script>
                                                function reset()
                                                {
                                                    document.getElementById("name-filter").value = "";
                                                }
                                            </script>

                                        </div>
                                    </form>
                                </div>
                            </div>


                           
                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">نام</b></th>
                                            <th><b class="IRANYekanRegular">تصویر شاخص</b></th>
                                            <th><b class="IRANYekanRegular">دسته اصلی</b></th>
                                            <th><b class="IRANYekanRegular">دسته فرعی</b></th>
                                            <th><b class="IRANYekanRegular">قیمت</b></th>
                                            <th><b class="IRANYekanRegular">موجودی</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $row = 0;  @endphp
                                        @foreach($products as $product)

                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$row }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $product->name }}</strong></td>
                                            <td>                     
                                                <img src="{{ $product->get_thumbnail('thumbnail') }}" width="50" height="50" class="rounded-circle my-2 px-2" title="{{ $product->thumbnail->title }}" alt="{{ $product->thumbnail->alt }}">
                                            </td>
                                            <td><strong class="IRANYekanRegular">{{ $product->parent_cat->name ?? '' }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $product->child_cat->name ?? '' }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ number_format($product->price) }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ number_format($product->stock) }}</strong></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                    @if($product->status == App\Enums\Status::Active)
                                                    <span class="badge badge-primary IR p-1">فعال</span>
                                                    @elseif($product->status == App\Enums\Status::Deactive)
                                                    <span class="badge badge-danger IR p-1">غیرفعال</span>
                                                    @endif
                                                </strong>
                                            </td>
                                            <td>
                                                @if($product->trashed())
                                                     @if(Auth::guard('admin')->user()->can('shop.products.delete'))
                                                    <a class="font18 m-1" href="#recycle{{ $product->id }}" data-toggle="modal" title="بازیابی">
                                                        <i class="fa fa-recycle text-danger"></i>
                                                    </a>

                                                    <!-- Recycle Modal -->
                                                    <div class="modal fade" id="recycle{{ $product->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IR" id="newReviewLabel">بازیابی سرویس</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که می‌خواهید محصول  {{ $product->name }} را بازیابی نمایید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.shop.products.recycle', $product) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('patch')
                                                                        <button type="submit"  title="بازیابی" class="btn btn-info px-8">بازیابی</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @else
                                                     @if(Auth::guard('admin')->user()->can('shop.products.luck.create'))
                                                    <a class="font18 m-1" href="{{ route('admin.shop.products.luck.create',$product) }}" title="افزودن به گردونه شانس">
                                                        <i class="fas fa-hockey-puck text-success"></i>
                                                    </a>
                                                    @endif

                                                    @if(Auth::guard('admin')->user()->can('shop.products.attributes.show'))
                                                    <a class="font18 m-1" href="{{ route('admin.shop.products.attributes.show', $product) }}" title="ویژگی ها">
                                                        <i class="fa fa-info text-secondary"></i>
                                                    </a>
                                                    @endif
                                                   
                                                    @if(Auth::guard('admin')->user()->can('shop.products.images.show'))
                                                    <a class="font18 m-1" href="{{ route('admin.shop.products.images.show', $product) }}" title="تصاویر">
                                                        <i class="fas fa-images text-warning"></i>
                                                    </a>
                                                    @endif
 
                                                    @if(Auth::guard('admin')->user()->can('shop.products.edit'))
                                                    <a class="font18 m-1" href="{{ route('admin.shop.products.edit', $product) }}" title="ویرایش">
                                                        <i class="fa fa-edit text-info"></i>
                                                    </a>
                                                    @endif

                                                     
                                                    @if(Auth::guard('admin')->user()->can('shop.products.delete'))
                                                    <a href="#remove{{ $product->id }}" data-toggle="modal" class="font18 m-1" title="حذف">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>

                                                    <!-- Remove Modal -->
                                                    <div class="modal fade" id="remove{{ $product->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف محصول</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید محصول {{ $product->name }} را حذف کنید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.shop.products.delete', $product) }}"  method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger px-8" title="حذف" >حذف</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                               @endif
 
                                            </td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $products->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
