@extends('admin.master')


@section('script')

    <script type="text/javascript">
        $("#since-filter").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#since-filter",
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

        $("#until-filter").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#until-filter",
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
    </script>
  
@endsection

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
                            {{ Breadcrumbs::render('articles') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-newspaper page-icon"></i>
                              مقالات
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
                                <div class="col-6">
                                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="collapseExample" title="فیلتر">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                </div>

                                <div class="col-6 text-right">
                                    <div class="btn-group" >
                                        <a href="{{ route('admin.article.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">ایجاد مقاله جدید</b>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">
                                        <div class="row">
                                            <div class="form-group justify-content-center col-6">
                                                <label for="name" class="control-label IRANYekanRegular">عنوان مقاله</label>
                                                <input type="text"  class="form-control input" id="title-filter" name="title" placeholder="عنوان مقاله را وارد کنید" value="{{ request('title') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="name" class="control-label IRANYekanRegular">وضعیت</label>
                                                <select class="form-control dropdopwn"  name="status" id="status-filter"  @error('status') is-invalid @enderror">
                                                    <option value=""> وضعیت مقاله را انتخاب نمایید ...</option>
                                                    <option value="{{ App\Enums\ArticleStatus::publish }}" {{ App\Enums\ArticleStatus::publish==request('status')?'selected':'' }}>منتشر شده</option>
                                                    <option value="{{ App\Enums\ArticleStatus::preview }}" {{ App\Enums\ArticleStatus::preview==request('status')?'selected':'' }}>پیش نویس</option>
                                                </select>
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="since" class="control-label IRANYekanRegular">از تاریخ</label>
                                                <input type="text"   class="form-control" id="since-filter" name="since" value="{{ request('since') }}" readonly>
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="since" class="control-label IRANYekanRegular">تا تاریخ</label>
                                                <input type="text"   class="form-control" id="until-filter" name="until" value="{{ request('until') }}" readonly>
                                            </div>


                                            <div class="form-group justify-content-center col-12">
                                                <label for="name" class="control-label IRANYekanRegular">محتوا</label>
                                                <input type="text"  class="form-control input" id="content-filter" name="content" placeholder="محتوا را وارد کنید" value="{{ request('content') }}">
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
                                                    document.getElementById("title-filter").value = "";
                                                    document.getElementById("status-filter").selectedIndex = "0";
                                                    document.getElementById("since-filter").value = "";
                                                    document.getElementById("until-filter").value = "";
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
                                            <th><b class="IRANYekanRegular">تصویر شاخص</b></th>
                                            <th><b class="IRANYekanRegular">تاریخ انتشار</b></th>
                                            <th><b class="IRANYekanRegular">دسته بندی ها</b></th>
                                            <th><b class="IRANYekanRegular">پیوندها</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $row = 0;  @endphp
                                        @foreach($articles as $article)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$row }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $article->title }}</strong></td>
                                            <td><img src="{{  $article->thumbnail->getImagePath('thumbnail') }}" width="40" height="40"></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                {{ $article->publish_date_time() }}
                                                </strong>
                                            </td>
                                            <td>
                                                <P class="IRANYekanRegular">
                                                 @foreach($article->categories as $index=>$category)
                                                   @if($index>0) , @endif
                                                  {{ $category->name }} 
                                                 @endforeach
                                                </P>
                                            </td>
                                            <td>
                                                <P class="IRANYekanRegular">
                                                {{ $article->tags }}  
                                                </P>
                                            </td>
                                            <td>
                                                @if($article->status == App\Enums\ArticleStatus::publish)
                                                 <span class="badge badge-primary IR p-1">منتشر شده</span>
                                                @elseif($article->status == App\Enums\ArticleStatus::preview)
                                                <span class="badge badge-success IR p-1">پیش نویس</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($article->trashed())
                                                    <a href="#recycle{{ $department->id }}" data-toggle="modal" class="p-3 font-18" title="بازیابی">
                                                        <i class="fa fa-recycle text-danger"></i>
                                                    </a>
                                                @else
                                                    <a href="#remove{{ $article->id }}" data-toggle="modal" class="btn btn-icon font-18" title="حذف">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                    <a class="btn  btn-icon font-18" href="{{ route('admin.article.edit', $article) }}" title="ویرایش">
                                                        <i class="fa fa-edit text-primary"></i>
                                                    </a> 

                                                       <!-- Remove Modal -->
                                                    <div class="modal fade" id="remove{{ $article->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lx">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف مقاله</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید مقاله  {{ $article->title }} را حذف کنید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.article.destroy', $article) }}"  method="POST" class="d-inline">
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
                                {{ $articles->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection