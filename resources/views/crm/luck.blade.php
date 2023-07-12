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
                            {{ Breadcrumbs::render('comments') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-hockey-puck page-icon"></i>
                             گردونه شانس
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="bg-danger p-2 border-2 mb-5">
                                    @foreach ($errors->all() as $error)
                                        <div class="text-light IRANYekanRegular">{{$error}}</div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-1 text-right">
                                    <strong class="IRANYekanRegular">نوع</strong>
                                </div>
                                <div class="col-11 col-md-5 text-center">
                                    <strong class="IRANYekanRegular">عنوان</strong>
                                </div>
                                <div class="col-6 col-md-2 text-center">
                                    <strong class="IRANYekanRegular">تخفیف(%)</strong>
                                </div>

                                <div class="col-6 col-md-2 text-center">
                                    <strong class="IRANYekanRegular">احتمال برد(%)</strong>
                                </div>

                                <div class="col-6 col-md-2">
                                    <strong class="IRANYekanRegular">اقدامات</strong>
                                </div>

                            </div>
                            @foreach ($lucks as $index=>$luck)
                                <form method="post" action="{{ route('admin.luck.update', $luck) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row m-1">

                                        <div class="col-1 text-right">
                                            @if($luck->lucktable_type=='App\Models\ServiceDetail')
                                            <span class="badge badge-primary IR  p-1">سرویس</span>
                                            @elseif($luck->lucktable_type=='App\Models\Product')
                                            <span class="badge badge-success IR  p-1">محصول</span>
                                             @endif
                                        </div>

                                        <div class="col-11 col-md-5 ">
                                            <input type="text" class="form-control input  text-center"  value="{{ $luck->lucktable->name }}" readonly>
                                        </div>

                                        <div class="col-6 col-md-2">
                                            <input type="number" min="0" max="100" class="form-control input  text-center" name="discount" id="discount{{ $index }}" placeholder="میزان تخفیف" value="{{ $luck->discount  }}">
                                        </div>

                                        <div class="col-6 col-md-2">
                                            <input type="number" min="0" max="100" class="form-control input  text-center" name="probability" id="probability{{ $index }}" placeholder="احتمال برد" value="{{ $luck->probability  }}">
                                        </div>

                                        <div class="col-6 col-md-2">
                                            <button type="submit" title="بروزرسانی" class="btn btn-info">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <a href="#remove{{ $luck->id }}" data-toggle="modal" title="حذف" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                        </div>
                                    </div>
                                </form>

                                    <!-- Remove Modal -->
                                    <div class="modal fade" id="remove{{ $luck->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xs">
                                            <div class="modal-content">
                                                <div class="modal-header py-3">
                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف شانس</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید  شانس را حذف نمایید؟</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.luck.destroy', $luck) }}"  method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="حذف" class="btn btn-danger px-8">حذف</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
         //گرفتن  زیردسته های مربوطه توسط ایجکس
        function details(service_id,id)
        {
            $.ajax({
                url: "{{ route('admin.services.fetch_details') }}",
                type: 'get',
                dataType: 'json',
                data:'service_id='+service_id,
                success: function(response)
                {
                    var len = 0;
                    $('#detail_service'+id).empty();
                    if(response['details'] != null){
                        len = response['details'].length;
                    }

                    var tr_str ="<select class='form-control dropdopwn' name='detail' id='detail'>"+
                        "<option value='' class='dropdopwn'>جزئیات سرویس ...</option>";
                    for(var i=0; i<len; i++)
                    {
                        tr_str += "<option value='"+response['details'][i].id+"' class='dropdopwn'>"+response['details'][i].name+"</option>";
                    }
                    tr_str +="</select>";


                    $("#detail_service"+id).append(tr_str);

                }
            });
        }
    </script>
@endsection
