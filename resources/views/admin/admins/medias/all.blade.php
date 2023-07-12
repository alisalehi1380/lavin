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
                            {{ Breadcrumbs::render('admins.medias',$admin) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fab fa-instagram page-icon"></i>
                            شبکه‌های اجتماعی ادمین
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                           
                                <div class="col-12 text-right">
                                    <div class="btn-group" >
                                        <a href="{{ route('admin.admins.medias.create',$admin) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">ایجاد شبکه اجتماعی جدید</b>
                                        </a>
                                    </div>
                                </div>

                            </div>
 

                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">رشته</b></th>
                                            <th><b class="IRANYekanRegular">مقطع</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $row = 0;  @endphp
                                        @foreach($medias as $media)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$row }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $media->name }}</strong></td>
                                            <td>
                                                <a href="{{ $media->link }}" target="_blanck">
                                                    <strong class="IRANYekanRegular">{{ $media->link }}</strong>
                                                </a>
                                            </td>
                                            <td>
                                               
                                              <a class="font18 m-1" href="{{ route('admin.admins.medias.edit',[$admin,$media]) }}" title="ویرایش">
                                                <i class="fa fa-edit text-primary"></i>
                                              </a>

                                              <a href="#remove{{ $media->id }}" data-toggle="modal" class="font18 m-1" title="حذف">
                                                 <i class="fa fa-trash text-danger"></i>
                                               </a>

                                               <!-- Remove Modal -->
                                                <div class="modal fade" id="remove{{ $media->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xs">
                                                        <div class="modal-content">
                                                            <div class="modal-header py-3">
                                                                <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف رشته</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید شبکه اجتماعی {{ $media->name }} را حذف کنید؟</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('admin.admins.medias.destroy', [$admin,$media]) }}"  method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" title="حذف" class="btn btn-danger px-8">حذف</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
 
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
