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
                            {{ Breadcrumbs::render('socialmedia') }}
                        </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fab fa-instagram page-icon"></i>
                             شبکه های اجتماعی
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
      
                                <div class="col-12 text-right"> 
                                    @if(Auth::guard('admin')->user()->can('socialmedia.create'))
                                    <div class="btn-group" >
                                        <a href="{{ route('admin.socialmedia.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">ایجاد شبکه اجتماعی جدید</b>
                                        </a>
                                    </div>
                                    @endif
                               </div>
                            </div>

                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">
                                        <div class="form-group justify-content-center mt-3">
                                            <label for="name" class="control-label IRANYekanRegular">عنوان شبکه اجتماعی</label>
                                            <input type="text"  class="form-control input" id="name-filter" name="name" placeholder="عنوان را وارد کنید" value="{{ request('name') }}">
                                        </div>
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
                                            <th><b class="IRANYekanRegular">عنوان</b></th>
                                            <th><b class="IRANYekanRegular">لینک</b></th>
                                            <th><b class="IRANYekanRegular">آیکن</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $row = 0;  @endphp
                                        @foreach($socialmedias as $socialmedia)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$row }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $socialmedia->name }}</strong></td>
                                            <td><a target="_blanck" href="{{ $socialmedia->link }}" class="IRANYekanRegular">{{ $socialmedia->link }}</a></td>
                                            <td>{{ $socialmedia->icon }} <br><i class="{{ $socialmedia->icon }}"></i></td>
                                            <td>
                                                @if($socialmedia->status == App\Enums\Status::Deactive)
                                                 <span class="badge badge-danger IR p-1">غیرفعال</span>
                                                @elseif($socialmedia->status == App\Enums\Status::Active)
                                                <span class="badge badge-primary IR p-1">فعال</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($socialmedia->trashed())
                                                     @if(Auth::guard('admin')->user()->can('socialmedia.delete'))
                                                    <a href="#recycle{{ $socialmedia->id }}" data-toggle="modal" class="p-3" title="بازیابی">
                                                        <i class="fa fa-recycle text-danger"></i>
                                                    </a>

                                                    <!-- Recycle Modal -->
                                                     <div class="modal fade" id="recycle{{ $socialmedia->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title" id="newReviewLabel">بازیابی ورزش</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5>آیا مطمئن هستید که میخواهید شبکه اجتماعی {{ $socialmedia->name }} را بازیابی کنید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.socialmedia.recycle', $socialmedia->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-info px-8" title="بازیابی" >بازیابی</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @else

                                                    @if(Auth::guard('admin')->user()->can('socialmedia.edit'))
                                                    <a class="btn  btn-icon font-18" href="{{ route('admin.socialmedia.edit', $socialmedia) }}">
                                                        <i class="fa fa-edit text-primary"></i>
                                                    </a>
                                                    @endif

                                                    @if(Auth::guard('admin')->user()->can('socialmedia.delete'))
                                                    <a href="#remove{{ $socialmedia->id }}" data-toggle="modal" class="btn btn-icon font-18" title="حذف">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>

                                                    <!-- Remove Modal -->
                                                    <div class="modal fade" id="remove{{ $socialmedia->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                       <div class="modal-dialog modal-xs">
                                                          <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                   <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف شبکه‌های اجتماعی</h5>
                                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                   </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                   <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید شبکه اجتماعی  {{ $socialmedia->name }} را حذف کنید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                   <form action="{{ route('admin.socialmedia.delete', $socialmedia->id) }}"  method="POST" class="d-inline">
                                                                      @csrf
                                                                      @method('DELETE')
                                                                      <button type="submit" title="حذف" class="btn btn-danger px-8">حذف</button>
                                                                   </form>
                                                                   <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                          </div>
                                                       </div>
                                                    </div>
                                                    @endif
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
