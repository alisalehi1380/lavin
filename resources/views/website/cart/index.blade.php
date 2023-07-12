 @extends('layouts.master')
 @section('content')
<div id="cart">
    @include('layouts.header')
</div>

 <div class="col-12 px-0 bg-white position-relative cart-bg">
     <h1 class="h3 text-center pt-5 dima text-white">سبد خرید</h1>
 </div>
 @php $sum=0; @endphp
 <div class="container" style="margin-top: -50px;">
     <div class="col-12 row mx-0 px-0">

         <div class="col-lg-8">

            <form action="{{ route('website.shop.cart.update') }}" method="post">
                @csrf
  
                @foreach($carts as $cart)
                <div class="row mx-0 mb-4 rounded-xl text-center mt-0 position-relative bg-white box-shadow">
                    <div class="col-lg-2 my-auto">
                        <img src="{{ $cart->product->get_thumbnail('thumbnail') }}" width="130" height="130" class="rounded-circle my-2 px-2" title="{{ $cart->product->thumbnail->title }}" alt="{{ $cart->product->thumbnail->alt }}">
                    </div>
                    <div class="col-lg-4 text-dark my-auto text-right">{{ $cart->product->name }}</div>
                    <div class=" col-lg-2 my-auto px-0">
                        @if($cart->product->special==true && $cart->product->specialDateTime >Carbon\Carbon::now()->format('Y-m-d H:i:s'))
                        <div class="text-dark"><span data-price="">{{ $cart->product->specialPrice }}</span> <span class="small d-inline">تومان</span></div>
                        <s class="small "><span data-price="">{{ $cart->product->price }}</span> <span class="d-inline">تومان</span></s>
                        @else
                        <div class="text-dark"><span data-price="">{{ $cart->product->price }}</span> <span class="small d-inline">تومان</span></div>
                        @endif
                        </div>
                    <div class="col-lg-2 my-auto">
                    <div class="badge position-relative badge-light badge-pill px-4 box-shadow d-inline-flex">
                        <span class="bg-accent label rounded-circle position-absolute"
                            onclick="$(this).next().val(+$(this).next().val()+1)" style="right: 2px;">+</span>
                        <input type="number" data-id="01" class="bg-transparent border-0 w-100 text-center py-1" name="{{ $cart->product->id }}" value="{{ $cart->count }}" min="1">
                        <span class="bg-accent label rounded-circle position-absolute"
                            onclick="$(this).prev().val(+$(this).prev().val()-1)" style="left: 2px;">-</span>
                    </div>
                    </div>
                    <div class="col-lg-2 my-auto px-1">
                        <small>مبلغ کل</small>
                        <div class="text-dark">
                            <strong data-price="true">
                            @if($cart->product->special==true && $cart->product->specialDateTime >Carbon\Carbon::now()->format('Y-m-d H:i:s'))
                                {{ $cart->product->specialPrice*$cart->count }}
                                @php $sum+=$cart->product->specialPrice*$cart->count @endphp
                            @else
                                {{ $cart->product->price*$cart->count }}
                                 @php $sum+=$cart->product->price*$cart->count @endphp
                            @endif
                            </strong> 
                            <span class="small d-inline">تومان</span></div>
                    </div>
                    <a href="{{ route('website.shop.cart.remove',$cart) }}">
                        <span class="label bg-light pointer rounded-circle border position-absolute text-dark"
                        style="left: 0; top:-15px; width: 35px; height: 35px">&times</span>
                    </a>
                    </div>
                @endforeach
    
                <div class="text-left mb-3">
                    <button type="submite" class="btn btn-sm pointer"> به روزرسانی سبد <span class="mr-1 font-weight-light">⟳</span></button>
                </div>

             </form>

         </div>
         <div class="col-lg-4 px-0 px-md-3">

             <form action="{{ route('website.shop.cart.order') }}" id="gateway" method="post">
                 @csrf
                 <small class="text-muted" title="postal-code">نام و نام خانوادگی</small>
                 <input type="text" id="full_name" class="form-control py-0 small w-100 mb-2 px-3"  name="full_name" placeholder="نام و نام خانوادگی" value="{{ old('full_name') ?? Auth::user()->firstname.' '.Auth::user()->lastname }}">
                 <span class="form-text text-danger erroralarm font-14"> {{ $errors->first('full_name') }} </span>

                 <small class="text-muted" title="شماره موبایل">شماره موبایل</small>
                 <input type="text" id="mobile" class="form-control py-0 small w-100 mb-2 px-3 text-left "  name="mobile" placeholder="شماره موبایل" value="{{ old('mobile') ?? $mobile }}">
                 <span class="form-text text-danger erroralarm font-14"> {{ $errors->first('mobile') }} </span>

                 <small class="text-muted" title="کدپستی">کدپستی</small>
                 <input type="text" id="postal_code" class="form-control py-0 small w-100 mb-2 px-3 text-left"  name="postal_code" placeholder="کدپستی 10 رقمی"
                  @if(old('postal_code')!== null) value="{{ old('postal_code') }}" @elseIf($address!=null) value="{{  $address->postalcode  }}" @endif>
                  <span class="form-text text-danger erroralarm font-14"> {{ $errors->first('postal_code') }} </span>

                 <small class="text-muted" title="آدرس">آدرس</small>
                 <textarea class="form-control w-100 mb-3 px-3 small border border-secondary" rows="2" name="address" placeholder="آدرس">@if(old('address')!== null) {{ old('address') }} @elseif($address !=null){{ $address->province->name.'-'.$address->city->name.'-'.$address->address }}@endif</textarea>
                 <span class="form-text text-danger erroralarm font-14"> {{ $errors->first('address') }} </span>

                 <input type="hidden" name="code" value="{{ Session::get('code') }}">
             </form>

             <div class="col-12 row mx-0 d-flex justify-content-center pb-5">
                 <div class="col-12 p-3 box-shadow rounded-xl mb-5 text-dark"  style="border:2px solid #2ed3ae;background-color: rgba(255,255,255,0.45)">

                     <form action="{{ route('website.shop.cart.discount') }}" method="post" class="w-100 position-relative">
                         @csrf
                         <input type="text" class="form-control w-100 mb-3 px-3 " name="code" value="{{ Session::get('code') }}" placeholder="کد تخفیف">
                         <button class="btn btn-sm py-0 btn-accent-outline pointer position-absolute" style="left: 8px;top: 7px">اعمال</button>
                     </form>

                     <div class="text-muted small">جمع سبد خرید</div>
                     <hr class="mt-2">
                     <div class="col-12 d-flex justify-content-between">
                         <div>جمع کل خرید:</div>
                         <div>
                             <span data-price="">{{ $sum }}</span><span class="small d-inline-flex pr-1">تومان</span>
                         </div>
                     </div>

                     @if(Session::has('offer'))
                     <div class="col-12 d-flex justify-content-between">
                         <div>{{ Session::get('typeDiscount') }}:</div>
                      </div>    
                      <div class="col-12 d-flex justify-content-between">
                        <span data-price="">{{ Session::get('offer') }}</span><span class="small d-inline-flex pr-1">تومان</span>
                       </div>
                    
                     @endif

                     <div class="col-12 text-accent d-flex mt-3 justify-content-between">
                         <div>مبلغ قابل پرداخت:</div>
                         <div>
                         @if(Session::has('offer'))
                             <strong data-price="">{{ $sum-Session::get('offer') }}</strong><span class="small d-inline-flex pr-1">تومان</span>
                         @else
                             <strong data-price="">{{ $sum }}</strong><span class="small d-inline-flex pr-1">تومان</span>
                         @endif

                         </div>
                     </div>

                     <div class="col-12 text-center mt-4 px-0">
                         <input type="submit" form="gateway" class="button button-black" value="پرداخت از طریق درگاه بانک" form="gateway">
                     </div>

                 </div>
             </div>

         </div>

     </div>
 </div>


 @stop

 @push('js')

 <script>

     function reload(){
         let data = [];
         $.map($('input[type=number]'), (item,index) =>{
             data[index] = {
                 'key': item.dataset.id,
                 'value': item.value
             }
         });
         axios.post('/iehf',data).then(res => {
             if(res.status == 200){
                 console.log(res.data.message);
             }
         }).catch(error => {
             console.log(error.response.data);
         })
     }

 </script>

 @endpush

 @push('css')
     <style>
         .cart-bg{
            background-image: url("/images/front/cart-bg.jpg");
             background-size: 100% 100%;
             background-position: bottom;
             top:-100px;
             height: 200px
         }
         .page{
             min-height: 100px !important;
         }
         .box-shadow{
             box-shadow: 0 0 5px rgba(0,0,0,0.18)
         }
         .rd-navbar-static:not(.rd-navbar--is-stuck) .rd-navbar-nav > li > a{
             color: #eeeeee;
         }
         #cart .rd-navbar-static:not(.rd-navbar--is-stuck) .rd-navbar-nav > li > a:hover {
             color: white;
         }
         @media (max-width: 992px) {
            .cart-bg{
                height: 100px
            }
         }
         /* Chrome, Safari, Edge, Opera */
         input::-webkit-outer-spin-button,
         input::-webkit-inner-spin-button {
             -webkit-appearance: none;
             margin: 0;
         }

         /* Firefox */
         input[type=number] {
             -moz-appearance: textfield;
         }
         .bg-accent:hover{
             background-color: #2fa78b;
             cursor: pointer;
         }
         .bg-accent::-moz-selection ,.bg-accent::selection{
             background: transparent;
         }
     </style>
 @endpush
