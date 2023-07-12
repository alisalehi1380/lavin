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
                            {{ Breadcrumbs::render('provinces.cities.index',$province) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-map-marker page-icon"></i>
                              شهرهای استان {{ $province->name }}
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
                                    @if(Auth::guard('admin')->user()->can('provinces.cities.create'))
                                    <div class="btn-group" >
                                        <a href="{{ route('admin.provinces.cities.create', $province) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">ایجاد شهر جدید</b>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
 
                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">نام استان</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($cities as $index=>$city)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $city->name }}</strong></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                    @if($city->status == App\Enums\Status::Active)
                                                    <span class="badge badge-primary IR p-1">فعال</span>
                                                    @elseif($city->status == App\Enums\Status::Deactive)
                                                    <span class="badge badge-danger IR p-1">غیرفعال</span>
                                                    @endif
                                                </strong>
                                            </td>
                                            <td>

                                            @if(Auth::guard('admin')->user()->can('provinces.cities.parts.index'))
                                            <a class="btn  btn-icon" href="{{ route('admin.provinces.cities.parts.index', [$province,$city]) }}" title="نواحی">
                                                <i class="fas fa-map-marker text-success font-20"></i>
                                            </a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->can('provinces.cities.edit'))
                                              <a class="btn  btn-icon" href="{{ route('admin.provinces.cities.edit',[$province,$city]) }}" title="ویرایش">
                                                <i class="fa fa-edit text-primary font-20"></i>
                                              </a>
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
