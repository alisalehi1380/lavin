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
                            <ol class="breadcrumb m-0 IRANYekanRegular">
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-images page-icon"></i>
                            گالری‌ها
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
         
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                        @if ($errors->any())
                            <div class="row">
                                <div class="col-12 alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="IR">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif


                            <div class="row">
                                <div class="col-12">
                                    <div class="btn-group mb-3" >
                                        <a  href="#add" data-toggle="modal" class="btn btn-sm btn-primary">
                                            <i class="fas fa-images plusiconfont"></i>
                                            <b class="IRANYekanRegular">افزودن گالری جدید</b>
                                        </a>

                                        <!-- add Modal -->
                                        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xs">
                                                <div class="modal-content">
                                                    <div class="modal-header py-3">
                                                        <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">افزودن گالری</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.gallery.store') }}"  method="POST" class="d-inline" id="addform" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <label for="name" class="col-form-label IRANYekanRegular">عنوان</label>
                                                                    <input type="text" class="form-control input" name="name" id="name" placeholder="عنوان را وارد کنید" value="{{ old('name') }}">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="fileupload btn btn-success waves-effect waves-light mt-2">
                                                                        <span><i class="mdi mdi-cloud-upload mr-1"></i>تصویر </span>
                                                                        <input type="file" class="upload" name="image" value="" accept="image/*">
                                                                    </div>
                                                                </div>

                                                                <div class="col-6 text-right mt-2">
                                                                    <input  type="checkbox" name="status"  checked data-plugin="switchery" data-color="#00b19d" data-size="small"/>
                                                                </div>
                                                            </div>
                                                           
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" title="ثبت" class="btn btn-primary mr-1" form="addform">ثبت</button>
                                                        <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
 
                                    </div>
                                </div>
                            </div>
            
                          
                            <div class="row filterable-content">
                                @foreach($galleries as $gallery)

                                <div class="col-sm-6 col-xl-3 filter-item all web illustrator">
                                    <div class="gal-box">
                                
                                        <img src="{{ $gallery->images[0]->getImagePath('medium') }}" alt="{{ $gallery->images[0]->alt }}" title="{{ $gallery->images[0]->title }}" class="img-fluid" alt="work-thumbnail">
                                         
                                        <div class="gall-info">
                                            <h4 class="font-16 mt-0 IR">{{ $gallery->name }}</h4>
                                            
                                            <a href="{{ route('admin.gallery.images.index',$gallery) }}" class="btn btn-icon font-18 p-1" title="تصاویر گالری">
                                                <i class="fa fa-images text-warning"></i>
                                            </a>
                                            
                                            <a href="#edit{{ $gallery->id }}" data-toggle="modal" class="btn btn-icon font-18 p-1" title="ویرایش">
                                                <i class="fa fa-edit text-success"></i>
                                            </a>

                                            <!-- edit Modal -->
                                            <div class="modal fade" id="edit{{ $gallery->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xs">
                                                    <div class="modal-content">
                                                        <div class="modal-header py-3">
                                                            <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">ویرایش گالری</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.gallery.update',$gallery) }}"  method="POST" class="d-inline" id="editform{{ $gallery->id }}" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label for="name" class="col-form-label IRANYekanRegular">عنوان</label>
                                                                        <input type="text" class="form-control input" name="name" id="name" placeholder="عنوان را وارد کنید" value="{{ $gallery->name }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-12 text-right p-2">
                                                                        <input  type="checkbox" name="status" @if($gallery->status==App\Enums\Status::Active) checked @endif data-plugin="switchery" data-color="#00b19d" data-size="small"/>
                                                                    </div>
                                                                </div>
                                                            
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" title="بروزرسانی" class="btn btn-success mr-1" form="editform{{ $gallery->id }}">بروزرسانی</button>
                                                            <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
     
                    
                                            <a href="#remove{{ $gallery->id }}" data-toggle="modal" class="btn btn-icon font-18 p-1" title="حذف">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                            <!-- Remove Modal -->
                                            <div class="modal fade" id="remove{{ $gallery->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xs">
                                                    <div class="modal-content">
                                                        <div class="modal-header py-3">
                                                            <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف تصویر</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h5 class="IRANYekanRegular">آیا مطمئن هستید که می‌خواهید این گالری  را حذف نمایید؟</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('admin.gallery.destroy',$gallery) }}"  method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" title="حذف" class="btn btn-danger px-8">حذف</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <strong class="IRANYekanRegular" style="float:left">
                                                @if($gallery->status == App\Enums\Status::Active)
                                                <span class="badge badge-primary IR p-1">فعال</span>
                                                @elseif($gallery->status == App\Enums\Status::Deactive)
                                                <span class="badge badge-danger IR p-1">غیرفعال</span>
                                                @endif
                                            </strong>
                                             
                                        </div> <!-- gallery info -->
                                    </div> <!-- end gal-box -->
                                </div> <!-- end col -->

                                @endforeach
                            </div>
                             
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        
        </div>
    </div>
</div>
@endsection

