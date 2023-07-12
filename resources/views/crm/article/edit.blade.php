@extends('admin.master')

@section('script')

        <script type="text/javascript">
        $("#dt_class").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#dt_class",
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
    
    <script src="/ckeditor/ckeditor.js"></script>

    <script type="text/javascript">
 
        const ck_config = {
            contentsLangDirection : 'rtl',
            toolbar: [
                ['Styles','Format','Font','FontSize'],
                ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Print'],
                ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source'],
            ],
            filebrowserUploadUrl:"{{ route('admin.article.ckeditor', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        };
        CKEDITOR.replace('content',ck_config);

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
                            {{ Breadcrumbs::render('admin-create',$article) }}                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-newspaper page-icon"></i>
                           ویرایش مقاله
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

                                <form class="form-horizontal" action="{{ route('admin.article.update',$article) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                     @method('patch')

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="name" class="control-label IRANYekanRegular">عنوان مقاله</label>
                                            <input type="text" class="form-control input" name="title" id="title" placeholder="عنوان مقاله را وارد کنید" value="{{ old('title') ?? $article->title }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="content" class="control-label IRANYekanRegular">متن</label>
                                             <textarea class="ckeditor form-control" row="100" class="form-control" name="content" id="content" placeholder="متن مقاله را وارد کنید...">{!! old('content') ?? $article->content !!}</textarea>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('content') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="account" class="col-form-label IRANYekanRegular">وضعیت</label>
                                             <select name="status" id="st" class="form-control dropdown IR">
                                                    <option value="{{ App\Enums\ArticleStatus::publish }}" {{ App\Enums\ArticleStatus::publish==old('status') || App\Enums\ArticleStatus::publish == $article->status ?'selected':'' }}>منتشر شده</option>
                                                    <option value="{{ App\Enums\ArticleStatus::preview }}" {{ App\Enums\ArticleStatus::preview==old('status') || App\Enums\ArticleStatus::preview == $article->status ?'selected':'' }}>پیش نویس</option>
                                             </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('status') }} </span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="account" class="col-form-label IRANYekanRegular">زمان انتشار</label>
                                            <input type="text"   class="form-control" id="dt_class" name="publishDateTime" value="{{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i:s',strtotime($article->publishDateTime))) }}" readonly>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('publishDateTime') }} </span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="categories" class="col-form-label IRANYekanRegular">دسته بندی‌ها</label>
                                            <select name="categories[]" id="categories" class="select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="انتخاب نقش‌ها...">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ in_array($category->id,$article->categories->pluck('id')->toArray())?'selected':'' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('categories') }} </span>
                                             
                                        </div>

                                    </div>

                                    <div class="form-group col-12">
                                        <label for="categories" class="col-form-label IRANYekanRegular">پیوندها</label>
                                        <div class="tags-default">
                                            <input type="text" name="tags" id="tags" value="{{ $article->tags }}" data-role="tagsinput" placeholder="افزودن پیوند"/>
                                        </div>
                                    </div>
 
                                
                                    <div class="form-group col-md-4">
                                        <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                            <span><i class="mdi mdi-cloud-upload mr-1"></i>تصویر شاخص</span>
                                            <input type="file" class="upload" name="thumbnail" value="" accept="image/*">
                                        </div>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('thumbnail') }} </span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <img src="{{  $article->thumbnail->getImagePath('medium') }}" width="200">
                                    </div>
                                
                                    

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">بروزرسانی</button>
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
</div>
@endsection
