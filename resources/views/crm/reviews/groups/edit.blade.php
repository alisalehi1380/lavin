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
                            <ol class="breadcrumb m-0">
                            {{ Breadcrumbs::render('article-add-cat') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-layer-group page-icon"></i>
                             ویرایش گروه بازخورد 
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

                                <form class="form-horizontal" action="{{ route('admin.rewiewGroups.update',$group) }}" method="post">
                                    {{ csrf_field() }}
                                    @method('PATCH')

                                    <div class="form-group">
                                        <div class="co-12">
                                            <label for="title" class="control-label IRANYekanRegular">عنوان گروه</label>
                                            <input type="text" class="form-control input" name="title" id="title" placeholder="عنوان گروه را وارد کنید" value="{{ old('title') ?? $group->title }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                        </div>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-12" style="display:inherit;">
                                            <input type="radio" id="active" name="status" value="{{ App\Enums\Status::Active }}" @if($group->status==App\Enums\Status::Active) checked @endif>
                                            &nbsp;
                                            <label for="active">فعال</label><br>
                                            &nbsp;&nbsp; &nbsp;
                                            <input type="radio" id="deactive" name="status" value="{{ App\Enums\Status::Deactive }}" @if($group->status==App\Enums\Status::Deactive) checked @endif>
                                            &nbsp;
                                            <label for="deactive">غیرفعال</label><br>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button type="submit" title="بروزرسانی" class="btn btn-primary">بروزرسانی</button>
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
