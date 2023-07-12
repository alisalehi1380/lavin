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
                                {{ Breadcrumbs::render('numbers') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-phone page-icon"></i>
                              نمابر
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
                                <div class="col-12">
                                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="collapseExample" title="فیلتر">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                </div>
 
                            </div>

                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">

                                        <div class="row">
                                            <div class="form-group justify-content-center col-6">
                                                <label for="name" class="control-label IRANYekanRegular">نام و نام خانوادگی</label>
                                                <input type="text"  class="form-control input" id="name-filter" name="name" placeholder="نام و نام خانوادگی را وارد کنید" value="{{ request('name') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="mobile-filter" class="control-label IRANYekanRegular">موبایل</label>
                                                <input type="text"  class="form-control input text-right" id="mobile-filter" name="mobile" placeholder="موبایل را وارد کنید" value="{{ request('mobile') }}">
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
                                                    document.getElementById("name-filter").value = "";
                                                    document.getElementById("mobile-filter").value = "";
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
                                            <th><b class="IRANYekanRegular">شماره موبایل</b></th>
                                            <th><b class="IRANYekanRegular">معرف</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($numbers as $index=>$number)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $number->name }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $number->mobile }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $number->user->firstname.' '.$number->user->lastname.' ('.$number->user->mobile.')' }}</strong></td>
 
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $numbers->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
