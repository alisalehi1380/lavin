
<div class="row">
    <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <a href="{{ route('website.account.numbers.create') }}" class="IR text-dark">
                در صورت ثبت هر شماره موبایل جدید 2 امتیاز به شما اضافه شده و اگر صاحب موبایل در آینده عضو سایت شود 3 امتیاز دیگر به شما اضافه می شود.
            </a>
        </div>
    </div>    
</div>

@if(Auth::user()->address == null)
<div class="row">
    <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <a href="{{ route('website.account.profile.index',['#focus-address']) }}" class="IR text-dark">
                در صورت تکمیل آدرس محل سکونت 3 امتیاز به شما تعلق می شود. 
            </a>
        </div>
    </div>    
</div>
@endif

@if(Auth::user()->bank == null)
<div class="row">
    <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <a href="{{ route('website.account.profile.index',['#focus-address']) }}" class="IR text-dark">
                در صورت تکمیل مشخصات بانکی 3 امتیاز به شما تعلق می شود. 
            </a>
        </div>
    </div>    
</div>
@endif

@if(Auth::user()->info == null)
<div class="row">
    <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <a href="{{ route('website.account.profile.index',['#focus-info']) }}" class="IR text-dark">
                در صورت تکمیل سایر مشخصات شخصی 3 امتیاز به شما تعلق می شود. 
            </a>
        </div>
    </div>    
</div>
@endif