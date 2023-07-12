
@if(count($doctors))
<section class="col-12 mt-5 px-0 py-5">
    <div class="doctors owl-carousel px-xl-0">
       @foreach($doctors as $doctor)
        <a href="{{ route('website.doctor',$doctor) }}">
            <div class="p-3 p-xl-4 text-center">
                <div class="position-relative">
                    <div class="rgba-black w-100 position-absolute h-100 d-flex justify-content-center align-items-center">
                        <div class="p-2">
                            <small class="rgba-light">کدنظام پزشکی <span>{{ $doctor->doctor->code ?? '' }}</span></small>
                        </div>
                    </div>
                    
                    @if($doctor->image == null)
                    <img src="{{ url('/') }}/panel/assets/images/profile.png">
                    @else
                    <img src="{{ $doctor->get_image('medium') }}" class="rounded-circle border-thick w-100" alt="{{ $doctor->fullname }}">
                    @endif
        
                </div>
                <div class="text-black">دکتر {{ $doctor->fullname }}</div>
                <div class="small text-secondary">{{ $doctor->doctor->speciality ?? '' }}</div>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif

@push('js')
    <script>
        $(document).ready(function(){
            $(".doctors.owl-carousel").owlCarousel({
                rtl:true,
                items:5,
                loop:true,
                autoplay:true,
                dots:false,
                autoplaySpeed: 3000,
                autoplayHoverPause: true,
                responsive : {
                    // breakpoint from 0 up
                    0 : {
                        items:1.2,

                    },
                    // breakpoint from 480 up
                    530 : {
                        items:3,
                    },
                    // breakpoint from 768 up
                    1200 : {
                        items:5,

                    }
                }
            });

        });
    </script>
@endpush

@push('css')
    <style>
        .border-thick{
            border:6px solid darkgrey;
        }
        .rgba-light{
            color:#dadada
        }
        .doctors .owl-nav{
            display: none;
        }
        @media (max-width:1000px) {
            .owl-nav{
                display: none;
            }
        }
    </style>
@endpush
