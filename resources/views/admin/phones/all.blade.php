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
                                {{ Breadcrumbs::render('phones') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-phone page-icon"></i>
                             تلفن های تماس
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                                <div class="col-12text-right"> 
                                    @if(Auth::guard('admin')->user()->can('phones.create'))
                                    <div class="btn-group" >
                                        <a href="{{ route('admin.phones.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">ایجاد  تلفن جدید</b>
                                        </a>
                                    </div>
                                    @endif
                               </div>
                         

                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">عنوان</b></th>
                                            <th><b class="IRANYekanRegular">تلفن</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                     
                                        @foreach($phones as $index=>$phone)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $phone->title }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $phone->phone }}</strong></td>
                                           
                                            <td>
                                                @if($phone->status == App\Enums\Status::Deactive)
                                                 <span class="badge badge-danger IR p-1">غیرفعال</span>
                                                @elseif($phone->status == App\Enums\Status::Active)
                                                <span class="badge badge-primary IR p-1">فعال</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->can('phones.edit'))
                                                    <a class="btn  btn-icon font-18" href="{{ route('admin.phones.edit', $phone) }}">
                                                        <i class="fa fa-edit text-primary"></i>
                                                    </a>
                                                @endif

                                                @if(Auth::guard('admin')->user()->can('phones.delete'))
                                                    <a href="#remove{{ $phone->id }}" data-toggle="modal" class="btn btn-icon font-18" title="حذف">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                    <!-- Remove Modal -->
                                                    <div class="modal fade" id="remove{{ $phone->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف تلفن تماس</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">
                                                                        آیا مطمئن هستید که میخواهید تلفن تماس  {{ $phone->title }} را حذف کنید؟  
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.phones.delete', $phone) }}"  method="POST" class="d-inline">
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
 
                                            </td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
