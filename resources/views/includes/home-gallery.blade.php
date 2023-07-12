<section class="pt-5 px-md-5">
    <div class="px-md-5">
        <div class="text-center">
            <h2 class="heading-4 text-center dima pb-3">گالری تصاویر</h2>
        </div>
        <div class="col-12 my-md-4 px-0 px-md-3">

            <div class="container-fluid">
                <div class="row g-0 pl-1 pl-md-0">
                    @foreach($galleries as $index=>$gallery)
                        @if($index<4)
                        <div class="col-4 col-xl-3 pl-0 pr-1 px-md-3 lgallery mt-2">
                            <a class="pointer thumb-modern item" data-src="{{ $gallery->images[0]->getImagePath('medium') }}">
                                <figure class="rounded mb-0">
                                    <img src="{{ $gallery->images[0]->getImagePath('medium') }}" title="{{ $gallery->images[0]->title }}" alt="{{ $gallery->images[0]->alt }}" width="100%">
                                </figure>
                                <div class="col-12 row mx-0 px-1">
                                    <div class="col-md-7 px-0 text-truncate">{{ $gallery->name }}</div>
                                    <div class="col px-0"><span class="bg-accent rounded small d-inline px-2 py-0 mt-1 float-left">{{ count($gallery->images) }}مورد</span></div>
                                </div>
                            </a>
                            @foreach($gallery->images as $index=>$image)
                                @if($index>0)
                                <span class="item d-none" data-src="{{ $image->getImagePath('medium') }}"><img src="{{ $image->getImagePath('medium') }}"></span>
                                @endif
                            @endforeach
                        </div>
                        @endif
                    @endforeach

                </div>

                @if(count($galleries) > 4)
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center pb-5">
                            <a href="{{ route('website.gallery') }}" class="col-md-3 btn btn-accent-outline small">دیدن همه گالری‌ها</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>

@push('css')
    <link rel="stylesheet" href="/light-gallery/css/lightgallery.css">
    <style>
        .thumb-modern img{
            transition: all .2s;
        }
        .thumb-modern img:hover{
            transform: scale(1.1);
        }
        .thumb-modern figure{
            overflow: hidden;
            border: 1px solid gray;
        }
        .thumb-modern .bg-accent{
            background-color: white !important;
            color: #2ed3ae !important;
        }
    </style>
@endpush

@push('js')
    <script src="/light-gallery/js/lightgallery-all.js"></script>
    <script>
        $(document).ready(function () {
            $('.lgallery').lightGallery({
                thumbnail: true,
                selector: '.item'
            });
        });
    </script>
@endpush
