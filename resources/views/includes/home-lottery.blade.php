<section id="lottery" class="col-12 row mx-0">
    <div class="col-12 pr-xl-5 my-auto text-center text-md-right">
        <div>
            <h3 class="dima mb-4">شانس تو امتحان کن</h3>
            <div class="mb-5 heading-6">هر هفته میتونی از گردونه شانس استفاده کنی و از لاوین جایزه ببری</div>
            <div>
                <a href="{{ route('website.lottery.index') }}" data-aos="zoom-in-left" data-aos-delay="700"
                   class="button button-black"> این فرصت رو از دست نمیدم </a>
            </div>
        </div>
    </div>
</section>

@push('css')
    <style>
        #lottery{
            background-image: url('/images/front/chance.jpg');
            min-height:400px;
            background-size: cover;
        }
        @media (max-width: 890px) {
            #lottery{
                background-color: rgba(0, 0, 0, 0.38);
                background-blend-mode: darken;
            }
            #lottery h3, #lottery .heading-6{
                color: white !important;
            }
        }
    </style>
@endpush
