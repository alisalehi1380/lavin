@extends('layouts.master')

@section('content')
    <div id="visit">
        @include('layouts.header')
        <div class="d-flex justify-content-center align-items-center" style="height: 200px">
            <div class="col-7 text-center">
                <h1 class="h3 dima text-white">ثبت درخواست مشاوره از پزشکان</h1>
                <p class="text-white py-3">پس از ثبت درخواست مشاوره به صورت ویزیت حضوری یا آنلاین، پیامی از طریق کنیک لاوین حاوی اطلاعات زمان مشاوره برای شما ارسال می شود.بدین ترتیب به راحتی از تخصص پزشکان مجرب لاوین بهره‌مند خواهید شد.
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 row mx-0 justify-content-center icons-background">
        <div class="my-5 bg-white border col-md-7 ml-lg-5">
            <form action="" id="advice-form" class="py-4 px-md-5">
                <div class="form-control w-100 mt-3">
                    <label class="w-100 small text-black mb-0">نوع ارتباط با پزشک</label>
                    <select name="connection" class="w-100 text-left px-2 text-right" onchange="getNextOption(this, '/')">
                        <option value="-1" selected disabled>انتخاب کنید</option>
                        <option value="1">مشاوره آنلاین</option>
                        <option value="2">مشاوره حضوری (ویزیت پزشک در منزل)</option>
                    </select>
                </div>
                <div class="form-control w-100 mt-3">
                    <label class="w-100 small text-black mb-0">عنوان تخصص</label>
                    <select name="profession" class="w-100 text-left px-2 text-right" disabled onchange="getNextOption(this, '/')">
                    </select>
                </div>
                <div class="form-control w-100 mt-3">
                    <label class="w-100 small text-black mb-0">نام پزشک</label>
                    <select name="doctor" class="w-100 text-left px-2 text-right" disabled>
                    </select>
                </div>
                <div class="form-control w-100 mt-3">
                    <label class="w-100 small text-black mb-2">توضیحات کامل درباره مشکلی که میخواهید با پزشک درمیان بگذارید بنویسید.این اطلاعات به صورت محرمانه خواهد بود و قابل نمایش برای عموم قرار نخواهد گرفت.</label>
                    <textarea name="description" id="" cols="30" rows="3" class="w-100 p-3"></textarea>
                </div>
                <div class="form-control w-100 mt-2">
                    <label class="w-100 small text-black">ارسال فایل (اختیاری)</label>
                    <div class="bg-light row mx-0 rounded border border-secondary p-2" dir="ltr">
                        <input type="file" name="file" class="filestyle" data-text="انتخاب فایل" data-size="sm">
                    </div>
                </div>
                <div class="col-12 mt-4 text-center">
                    <span @auth onclick="$('#advice-form').submit()" @else
                          onclick="$('#loginModal').modal()"
                          @endauth class="button button-black">ثبت درخواست</span>
                </div>
            </form>
        </div>
        <div class="col-md-3 my-auto">
            <img src="/images/front/doctors.jpg" class="w-100" alt="">
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.min.js" integrity="sha512-HfRdzrvve5p31VKjxBhIaDhBqreRXt4SX3i3Iv7bhuoeJY47gJtFTRWKUpjk8RUkLtKZUhf87ONcKONAROhvIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function getNextOption(el, endpoint){

            let nextOption = $(el).parent().next().children().last();
            //empty options
            $(nextOption).find('option').remove();

            let options = [
                {
                    value: '111',
                    text: 'مقدار یک'
                },
                {
                    value: '222',
                    text: 'مقدار دو'
                },
            ];

            $(nextOption).removeAttr('disabled');

            $.each(options, function (i, item) {
                $(nextOption).append($('<option>', {
                    value: item.value,
                    text : item.text
                }));
            });

            axios.post(endpoint , { "value":el.value }).then(res => {

            })
        }
    </script>
@endpush

@push('css')
    <style>
        #visit{
            background-image: url("/images/front/banner.jpg");
            background-position: bottom;
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.77);
            background-blend-mode: color;
        }
        .icons-background{
            background-image: url("/images/front/background-1.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .form-control[type=text]{
            width: 100%;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border: 1px solid #dadada;
        }
        .rd-navbar-static:not(.rd-navbar--is-stuck) .rd-navbar-nav > li > a{
            color: #eeeeee;
        }
    </style>
@endpush
