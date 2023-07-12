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
                              {{ Breadcrumbs::render('discounts.users',$discount) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-pusers page-icon"></i>
                             کاربران کد تخفیف
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

                                <form class="form-horizontal" action="{{ route('admin.discounts.users.update',$discount) }}" method="post">
                                    {{ csrf_field() }}
                                    @method('PATCH')
                                    
                                      <div class="row">
                                        <div class="col-12">
                                            <label for="levels" class="col-form-label IRANYekanRegular">سطح کابران:</label>
                                             <select name="levels[]" id="levels" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-live-search="true"  data-style="btn-light" data-placeholder="... سطوح کابران"> 
                                                @foreach($levels as $level)
                                                <option value="{{ $level->id }}" {{ $level->id==old('levels')?'selected':'' }}>{{ $level->title }}</option>
                                                @endforeach  
                                             </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('status') }} </span>
                                        </div>
 
                                        <div class="col-12">
                                            <label for="users" class="col-form-label IRANYekanRegular">کاربران:</label>
                                             <select name="users[]" id="users" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $user->id==old('users')|| in_array(trim($user->id),$discount->users->pluck('id')->toArray())?'selected':'' }}>{{ $user->firstname.' '.$user->lastname.' ('.$user->mobile.')'}}</option>
                                                @endforeach
                                             </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('users') }} </span>
                                        </div>
                                    </div>  

                                    @if(Auth::guard('admin')->user()->can('discounts.user.update'))
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" title="بروزرسانی" class="btn btn-info">بروزرسانی</button>
                                        </div>
                                    </div>
                                    @endif
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
