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
                               {{ Breadcrumbs::render('commnets') }} 
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fa fa-comment"></i>
                             نظرات
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
                                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="collapseExample" title="فیلتر">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </div>

                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">
                                        <div class="row">
                                           
                                       

                                            <div class="form-group justify-content-center col-6">
                                                <label for="status-filter" class="control-label IRANYekanRegular">وضعیت پرداخت</label>
                                                <select class="form-control dropdopwn"  name="status" id="status-filter"  @error('status') is-invalid @enderror">
                                                    <option value="">وضعیت پرداخت را انتخاب نمایید...</option>
 
                                                </select>
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="status-filter" class="control-label IRANYekanRegular">وضعیت تحویل</label>
                                                <select class="form-control dropdopwn"  name="delivery" id="delivery-filter"  @error('delivery') is-invalid @enderror">
                                                <option value="">وضعیت تحویل را انتخاب نمایید...</option>
 
                                                </select>
                                            </div>

                                       
                                           
                                            <div class="form-group justify-content-center col-6">
                                                <label for="since" class="col-form-label IRANYekanRegular">از تاریخ</label>
                                                <input type="text"   class="form-control" id="since" name="since"  readonly value="{{ request('since') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="until" class="col-form-label IRANYekanRegular">تا تاریخ</label>
                                                <input type="text"   class="form-control" id="until" name="until"  readonly value="{{ request('until') }}">
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
                                                    document.getElementById("code-filter").value = "";
                                                    document.getElementById("ref-filter").value = "";
                                                    document.getElementById("since").value = "";
                                                    document.getElementById("until").value = "";
                                                    document.getElementById("state_id-filter").selectedIndex = "0";
                                                    document.getElementById("club_id-filter").selectedIndex = "0";
                                                    document.getElementById("provider_id-filter").selectedIndex = "0";
                                                    document.getElementById("status-filter").selectedIndex = "0";
                                                    document.getElementById("delivery-filter").selectedIndex = "0";
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
                                            <th><b class="IRANYekanRegular">نام و نام خانوادگی</b></th>
                                            <th><b class="IRANYekanRegular">آدرس ایمیل</b></th>
                                            <th><b class="IRANYekanRegular">عنوان مقاله</b></th>
                                            <th><b class="IRANYekanRegular">تاریخ - ساعت</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $row = 0;  @endphp
                                        @foreach($comments as $comment)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$row }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $comment->fullname }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $comment->email }}</strong></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                  @if($comment->commentable_type=="App\Models\Article")
                                                    {{ App\Models\Article::find($comment->commentable_id)->title ?? "" }}
                                                   @endif
                                                </strong></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                {{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('تاریخ Y/m/d ساعت H:i:s',strtotime($comment->created_at))) }}
                                                </strong>
                                            </td>
     
                                            <td>
                                                @if($comment->approved==App\Enums\CommentStatus::unapproved)
                                                <span class="badge badge-danger IR  p-1">تایید نشده</span>
                                                @elseif($comment->approved==App\Enums\CommentStatus::approved)
                                                <span class="badge badge-success IR  p-1">تایید شده</span>
                                                 @endif
                                            </td>
                                           
                                            <td>
 
                                                <a href="#info{{ $comment->id }}" data-toggle="modal" title="نمایش نظر">
                                                    <i class="fas fa-info font-18" style="color: #186a3b;"></i>
                                                </a>
                                               
                                            
                                                 <div class="modal fade" id="info{{ $comment->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header py-3">
                                                                <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">نمایش نظر</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="text-left">
                                                                    <p class="IRANYekanRegular">{{ $comment->comment }}</p>
                                                                </div>

                                                                <div class="text-center">
                                                                   
                                                                    <textarea id="answer{{ $comment->id }}" name="answer" form="update{{ $comment->id }}">{{ $comment->answer }}</textarea>

                                                                    <div class="text-left mt-3">
                                                                        <label class="IRANYekanRegular" for="status{{ $comment->id }}">وضعیت:</label>
                                                                        <select name="status" id="status{{ $comment->id }}" class="dropdown IRANYekanRegular"  form="update{{ $comment->id }}">
                                                                            <option value="{{ App\Enums\CommentStatus::unapproved}}" {{ App\Enums\CommentStatus::unapproved== $comment->approved?'selected':'' }}>تایید نشده</option>
                                                                            <option value="{{ App\Enums\CommentStatus::approved}}" {{  App\Enums\CommentStatus::approved== $comment->approved?'selected':'' }}>تایید شده</option>
                                                                        </select>
                                                                    </div>
                                                                   
                                                                </div>
                                                                


                                                            </div>
                                                            <div class="modal-footer">
                                                                @if(Auth::guard('admin')->user()->can('comments.update'))
                                                                <form method="post" action="{{ route('admin.comments.update', $comment) }}" id="update{{ $comment->id }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="submit" class="btn btn-primary" title="بروزرسانی" id="update" value="بروزرسانی"> 
                                                                </form>
                                                                @endif
                                                                &nbsp;&nbsp;
                                                                <button type="button" class="btn btn-danger" title="بستن" data-dismiss="modal">بستن</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                @if(Auth::guard('admin')->user()->can('comments.destroy'))
                                                <a href="#remove{{ $comment->id }}" data-toggle="modal" class="btn btn-icon" title="حذف">
                                                    <i class="fa fa-trash text-danger font-18"></i>
                                                </a>
                                                <!-- Remove Modal -->
                                                <div class="modal fade" id="remove{{ $comment->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lx">
                                                        <div class="modal-content">
                                                            <div class="modal-header py-3">
                                                                <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف مقاله</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="IRANYekanRegular">آیا شما مطمئن هستید که میخواهید این نظر را حذف نمایید؟</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('admin.comments.destroy', $comment) }}"  method="POST" class="d-inline">
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
                                {{ $comments->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')

        <script type="text/javascript">
        $("#since").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#since",
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

        $("#until").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#until",
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