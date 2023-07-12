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
                                {{ Breadcrumbs::render('roles') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-universal-access page-icon"></i>
                               نقش‌ها
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
                                                <label for="name" class="control-label IRANYekanRegular">عنوان</label>
                                                <input type="text"  class="form-control input" id="name-filter" name="name" placeholder="عنوان را وارد کنید" value="{{ request('name') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="description" class="control-label IRANYekanRegular">توضیحات</label>
                                                <input type="text"  class="form-control input" id="description-filter" name="description" placeholder="توضیحات  را وارد کنید" value="{{ request('description') }}">
                                            </div>

                                          
                                            <div class="form-group justify-content-center col-6">
                                                <label for="name" class="control-label IRANYekanRegular">دسترسی ها</label>
                                                 <select name="permissions[]" id="permissions-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... نقش‌های مورد نظر را انتخاب نمایید"> 
                                                    @foreach($permissions as $permission)
                                                    <option value="{{ $permission->id }}" @if(request('permissions')!=null) {{ in_array($permission->id,request('permissions'))?'selected':'' }} @endif>({{ $permission->description }}) {{ $permission->name }} </option>
                                                    @endforeach
                                                </select>
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
                                                    document.getElementById("email-filter").value = "";
                                                    document.getElementById("mobile-filter").value = "";
                                                    $("#roles-filter").val(null).trigger("change")
                      
                                                }
                                            </script>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            @if(Auth::guard('admin')->user()->can('add-role'))
                            <div class="btn-group" >
                                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus plusiconfont"></i>
                                    <b class="IRANYekanRegular">افزودن نقش جدید</b>
                                </a>
                            </div>
                            @endif
                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">عنوان</b></th>
                                            <th><b class="IRANYekanRegular">توضیحات</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $row = 0;  @endphp
                                        @foreach($roles as $role)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$row }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $role->name }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $role->description }}</strong></td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->can('edit-role'))
                                                <a class="btn  btn-icon" href="{{ route('admin.roles.edit',$role) }}" title="ویرایش">
                                                    <i class="fa fa-edit text-primary"></i>
                                                </a>
                                                @endif

                                                @if(Auth::guard('admin')->user()->can('delete-role'))
                                                <a href="#remove{{ $role->id }}" data-toggle="modal" class="btn btn-icon" title="حذف">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
                                                @endif
                                            
                                                <!-- Remove Modal -->
                                                <div class="modal fade" id="remove{{ $role->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xs">
                                                        <div class="modal-content">
                                                            <div class="modal-header py-3">
                                                                <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف نظر</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="IRANYekanRegular">آیا مطمئن هستید که می‌خواهید نقش {{ $role->name }} را حذف نمایید؟</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('admin.roles.destroy', $role) }}"  method="POST" class="d-inline">
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
                                {{ $roles->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
