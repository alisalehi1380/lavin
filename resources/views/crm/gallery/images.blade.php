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
                            تصاویر گالری
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
                                            <b class="IRANYekanRegular">افزودن تصویر جدید</b>
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
                                                        <form action="{{ route('admin.gallery.images.store',$gallery) }}"  method="POST" class="d-inline" id="addform" enctype="multipart/form-data">
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
                                @foreach($images as $image)

                                <div class="col-sm-6 col-xl-3 filter-item all web illustrator">
                                    <div class="gal-box">
                                        <a href="" class="image-popup">
                                            <img src="{{ $image->getImagePath('medium') }}" alt="{{ $image->alt }}" title="{{ $image->title }}" class="img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="gall-info">
                                   
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
                                                            <h5 class="IRANYekanRegular">آیا مطمئن هستید که می‌خواهید این تصویر را حذف نمایید؟</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('admin.gallery.images.destroy',[$gallery,$image]) }}"  method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" title="حذف" class="btn btn-danger px-8">حذف</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
 
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

