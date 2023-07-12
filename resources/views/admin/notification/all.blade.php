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
                                {{ Breadcrumbs::render('notifications') }}
                            </ol> 
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-bell page-icon"></i>
                               اعلانات
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
                                     @if(Auth::guard('admin')->user()->can('notifications.create'))
                                    <div class="btn-group">
                                        <a href="{{ route('admin.notifications.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">جدید</b>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="title" class="control-label IRANYekanRegular">عنوان</label>
                                                <input type="text"  class="form-control input" id="title-filter" name="title" placeholder="عنوان پیام را وارد نمایید..." value="{{ request('title') }}">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="status" class="control-label IRANYekanRegular">وضعیت</label>
                                                <select name="status[]" id="status-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="...وضعیت را انتخاب نمایید">
                                                    <option value="{{ App\Enums\Status::Active }}" @if(request('status')!=null) {{ in_array(App\Enums\Status::Active,request('status'))?'selected':'' }} @endif>فعال</option>
                                                    <option value="{{ App\Enums\Status::Deactive }}" @if(request('status')!=null) {{ in_array(App\Enums\Status::Deactive,request('status'))?'selected':'' }} @endif>غیرفعال</option>
                                                </select>
                                            </div>
                                        </diV>

                                        <div class="row">
                                            <div class="form-group justify-content-center col-6">
                                                <label for="since-filter" class="col-form-label IRANYekanRegular">از تاریخ </label>
                                                <input type="text"   class="form-control text-center" id="since-filter" name="since"  readonly value="{{ request('since') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="until-filter" class="col-form-label IRANYekanRegular">تا تاریخ </label>
                                                <input type="text"   class="form-control text-center" id="until-filter" name="until"  readonly value="{{ request('until') }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group justify-content-center col-12">
                                                <label for="users-filter" class="control-label IRANYekanRegular">پرسنل</label>
                                                 <select name="users[]" id="users-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... پرسنل مورد نظر را انتخاب نمایید">
                                                    @foreach($users as $user)
                                                    <option value="{{ $user->id }}" @if(request('users')!=null) {{ in_array($user->id,request('users'))?'selected':'' }} @endif>{{ $user->first_name.' '.$user->last_name.' ('.$user->code.')' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
                                                    document.getElementById("title-filter").value = "";
                                                    document.getElementById("since-filter").value = "";
                                                    document.getElementById("until-filter").value = "";
                                                    $("#users-filter").val(null).trigger("change");
                                                    $("#status-filter").val(null).trigger("change");
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
                                            <th><b class="IRANYekanRegular">زمان درج</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($notifications as $index=>$notification)
                                            <tr>
                                                <td>
                                                    <strong class="IRANYekanRegular">{{ ++$index }}</strong>
                                                </td>

                                                <td><strong class="IRANYekanRegular">{{ $notification->title }}</strong></td>
                                                <td><strong class="IRANYekanRegular">{{ $notification->created_at() }}</strong></td>

                                                <td>
                                                    @if($notification->status==App\Enums\Status::Deactive)
                                                    <span class="badge badge-danger IR  p-1">غیرفعال</span>
                                                    @elseif($notification->status==App\Enums\Status::Active)
                                                    <span class="badge badge-success IR  p-1">فعال</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="#info{{ $notification->id }}" data-toggle="modal" class="font18 m-1" title="نمایش جزئیات">
                                                        <i class="fa fa-info-circle text-info"></i>
                                                    </a>

                                                    <!-- info Modal -->
                                                    <div class="modal fade" id="info{{ $notification->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">{{ $notification->title }}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12 text-left">
                                                                            <h3 class="IRANYekanRegular">
                                                                                زمان درج:
                                                                                {{ $notification->created_at() }}
                                                                            </h3>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <p class="IRANYekanRegular text-justify">{{ $notification->message }}</p>
                                                                        </div>
                                                                    </div>

                                                                
                                                                </div>
                                                                <div class="modal-footer">
                                                                    @if(Auth::guard('admin')->user()->can('notifications.update'))
                                                                    <form action="{{ route('admin.notifications.update', $notification) }}"  method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('patch')
                                                                        @if($notification->status == App\Enums\Status::Deactive)
                                                                            <input name="status" type="hidden" value="{{ App\Enums\Status::Active }}">
                                                                            <button type="submit" title="فعال" class="btn btn-primary px-8">فعال</button>
                                                                        @elseif($notification->status == App\Enums\Status::Active)
                                                                            <input name="status" type="hidden" value="{{ App\Enums\Status::Deactive }}">
                                                                            <button type="submit" title="غیرفعال" class="btn btn-warning px-8">غیرفعال</button>
                                                                        @endif
                                                                    </form>
                                                                    @endif
                                                                    
                                                                    <button type="button" class="btn btn-secondary" title="بستن" data-dismiss="modal">بستن</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                

 
                                                        @if(!$notification->trashed())
                                                            @if(Auth::guard('admin')->user()->can('admin.notifications.destroy'))
                                                            <a class="m-1 font18" href="#remove{{ $notification->id }}" data-toggle="modal" class="btn btn-icon" title="حذف" class="btn btn-icon">
                                                                <i class="fa fa-trash text-danger"></i>
                                                            </a>
                                                            <!-- Remove Modal -->
                                                            <div class="modal fade" id="remove{{ $notification->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xs">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header py-3">
                                                                            <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف اعلان</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید این اعلان را حذف نمایید؟</h5>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form action="{{ route('admin.notifications.destroy', $notification) }}"  method="POST" class="d-inline">
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

                                                        @else
                                                            @if(Auth::guard('admin')->user()->can('notifications.destroy'))
                                                            <a class="m-1 font18" href="#recycle{{ $notification->id }}" data-toggle="modal" title="بازیابی">
                                                                <i class="fa fa-recycle text-danger"></i>
                                                            </a>
                                                            <!-- Recycle Modal -->
                                                            <div class="modal fade" id="recycle{{ $notification->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xs">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header py-3">
                                                                            <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">بازیابی اعلان</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید این اعلان را بازیابی نمایید؟</h5>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form action="{{ route('admin.notifications.recycle',$notification->id) }}" method="post" class="d-inline">
                                                                                @csrf
                                                                                <button type="submit" title="بازیابی" class="btn btn-info px-8">بازیابی</button>
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

                            </div>
                            {!! $notifications->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

<script type="text/javascript">

$(document).ready(function() {
    $('#table').DataTable( {
        "bPaginate": false,
        "bFilter": false,
        "lengthChange": false,
        "info": false
    } );
} );

$("#since-filter").MdPersianDateTimePicker({
    targetDateSelector: "#showDate_class",
    targetTextSelector: "#since-filter",
    textFormat: "yyyy/MM/dd",
    isGregorian: false,
    modalMode: false,
    englishNumber: false,
    enableTimePicker: false,
    selectedDateToShow: new Date(),
    calendarViewOnChange: function(param1){
    console.log(param1);
    }
});

$("#until-filter").MdPersianDateTimePicker({
    targetDateSelector: "#showDate_class",
    targetTextSelector: "#until-filter",
    textFormat: "yyyy/MM/dd",
    isGregorian: false,
    modalMode: false,
    englishNumber: false,
    enableTimePicker: false,
    selectedDateToShow: new Date(),
    calendarViewOnChange: function(param1){
    console.log(param1);
    }
});

</script>

 @endsection
