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
                            {{-- {{ Breadcrumbs::render('article-add-cat') }} --}}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-pusers page-icon"></i>
                             سرویس‌ها و کالاها کد تخفیف
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

                                <form class="form-horizontal" action="{{ route('admin.discounts.services.update',$discount) }}" method="post">
                                    {{ csrf_field() }}
                                    @method('PATCH')
                                    
                                      <div class="row">
                                          <label for="services" class="col-form-label IRANYekanRegular">سرویس‌ها:</label>
                                        <div class="col-12">
                                             <select name="services[]" id="services" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-live-search="true"  data-style="btn-light" data-placeholder="... سطوح کابران"> 
                                                @foreach($services as $service)
                                                <optgroup label="{{ $service->name }}">
                                                    @foreach ($service->details as $details)
                                                    <option value="{{ $details->id }}" {{ $details->id==old('services')|| in_array(trim($details->id),$discount->services->pluck('id')->toArray())?'selected':'' }}>{{ $details->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endforeach  
                                             </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('services') }} </span>
                                        </div>
  
                                    </div>  

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" title="بروزرسانی" class="btn btn-info">بروزرسانی</button>
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



@section('script')

    <script type="text/javascript">
   
         $('#levels').on('change.select2', function (e) {
                var levles = $('#levels').val();

                $.ajax({
                    type:'get',
                    url:"{{ route('admin.discounts.users.fetch',$discount) }}",
                    data:'levles='+levles,
                    dataType: 'json',
                    success: function(data)
                    {
                        $("#users").val(data['selected']).trigger("change")
                    }
                });
             
            });
                
       
            
         
        
    </script>
 
@endsection
