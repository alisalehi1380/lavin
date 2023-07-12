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
                            {{-- {{ Breadcrumbs::render('admin-edit',$admin) }} --}}
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-map-marker-alt page-icon"></i>
                            آدرس ادمین
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.admins.address.update',[$admin,$address]) }}" >
                                @csrf
                                @method('patch')
                                
                                <div class="row">

                                    <div class="col-md-6">
                                        <label for="province" class="IRANYekanRegular">استان</label>
                                        <select class='form-control dropdown' name='province' id='province' onchange="getCities(this.value)">
                                            <option value="">استان مورد نظر را انتخاب کنید...</option>
                                            @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" {{ $province->id==old('province') || $province->id==$address->provance_id?'selected':'' }}>{{ $province->name }}</option>
                                           @endforeach
                                        </select>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('province') }} </span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="city" class="IRANYekanRegular">شهر</label>
                                        <div id="fetch_city">
                                            <select class='form-control dropdown' name='city' id='city'>
                                            <option value="">شهر مورد نظر را انتخاب کنید...</option>
                                            @if(old('province'))
                                            @foreach(App\Models\City::where('province_id',old('province'))->get() as $city)
                                            <option value="{{ $city->id }}" {{ $city->id==old('city')?'selected':'' }}>{{ $city->name }}</option>
                                            @endforeach
                                            @elseIf($address->provance_id!=null)
                                            @foreach(App\Models\City::where('province_id',$address->provance_id)->get() as $city)
                                            <option value="{{ $city->id }}" {{ $city->id==$address->city_id?'selected':'' }}>{{ $province->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        </div>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('city') }} </span>
                                    </div>

                                </div>

                                <div class="row mt-2">
                                    
                                    <div class="col-md-6">
                                        <label for="postalCode" class="IRANYekanRegular">کدپستی:</label>
                                        <input id="postalCode" type="text" class="form-control @error('postalCode') is-invalid @enderror ltr" name="postalCode"  value="{{ old('postalCode') ?? $address->postalCode }}" placeholder="کدپستی">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('postalCode') }} </span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="address" class="IRANYekanRegular">آدرس:</label>
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"  value="{{ old('address') ?? $address->address }}" placeholder="آدرس">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('address') }} </span>
                                    </div>

                                </div>

                                <div class="row mt-2">
                                    
                                    <div class="col-md-6">
                                        <label for="longitude" class="IRANYekanRegular">طول جغرافیایی:</label>
                                        <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror text-latitude" name="longitude"  value="{{ old('longitude') ?? $address->longitude }}" placeholder="طول جغرافیایی">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('longitude') }} </span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="latitude" class="IRANYekanRegular">عرض جغرافیایی:</label>
                                        <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror text-right" name="latitude"  value="{{ old('latitude') ?? $address->latitude }}" placeholder="عرض جغرافیایی">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('latitude') }} </span>
                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <button type="submit" title="ثبت" class="btn btn-primary">ثبت</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
</div>
 
<script>     
    //گرفتن  زیردسته های مربوطه توسط ایجکس
    function getCities(provance_id)
    {
        $.ajax({
            url: "{{ route('admin.fetch_cities') }}",
            type: 'get',
            dataType: 'json',
            data:'provance_id='+provance_id,
            success: function(response)
            {
                var len = 0;
                 $('#fetch_city').empty();
                if(response['cities'] != null)
                {
                    len = response['cities'].length;
                }

                var tr_str ="<select class='form-control dropdown' name='city' id='city'>"+
                    "<option value='' class='dropdopwn'>شهر مورد نظر را انتخاب کنید...</option>";
                for(var i=0; i<len; i++)
                {
                    tr_str += "<option value='"+response['cities'][i].id+"'>"+response['cities'][i].name+"</option>";
                }
                tr_str +="</select>";

                $("#fetch_city").append(tr_str);

            }
        });
    }
</script>

@endsection

