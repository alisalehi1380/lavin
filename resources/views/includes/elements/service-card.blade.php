
<div class="service-card bg-white mb-3 mx-auto py-4 rounded">
    <div class="w-100 text-center">
        <div class="d-flex justify-content-center">
        <span class="rounded-circle d-flex">
            <img class="m-auto" src="{{ $image }}" alt="{{ $name }}" title="{{ $name }}">
        </span>
        </div>
        <h2 class="h6 mt-3">{{ $name }}</h2>
        <p class="text-dark desc small mt-2 px-1 px-lg-3">{{ $desc }}</p>
        <div class="text-pink px-2 text-right mb-1" style="line-height: 12px;">خدمات:</div>
        <div class="service-items table-responsive">
            @foreach($details as $detail)
                <a href="{{ route('website.services.show',$detail->slug) }}" class="badge bg-accent service-item font-weight-light px-2 py-1 mr-1 mb-1">{{ $detail->name }}</a>
            @endforeach
        </div>
    </div>
</div>

@once
    @push('css')
        <style>
            .service-card .rounded-circle{
                background-color: rgba(46, 211, 174, 0.1);
                border: 3px solid rgb(46, 211, 174);
                width: 60px;
                height: 60px;
            }
            .service-card{
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.11);
                transition: all .3s;
                max-width: 300px;
            }
            .service-card .desc{
                -webkit-line-clamp:4;
                overflow:hidden;
                text-overflow:ellipsis;
                display:-webkit-box !important;
                -webkit-box-orient:vertical;
                min-height: 106px;
            }
            a:hover .service-card{
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
                transform: scale(1.02);
                z-index: 1;
            }
            .bg-accent{
                background-color: white;
                border: 2px solid rgb(46, 211, 174);
                color: rgb(46, 211, 174);
            }
            .bg-accent:hover{
                background-color: rgb(46, 211, 174);
                color: white;
            }
            .service-items{
                scroll-snap-type: x mandatory;
                display: flex;
                scrollbar-width: thin;
            }
            .service-items::-webkit-scrollbar {
                height: 7px;
                background: #eee;
            }
            .service-items::-webkit-scrollbar-thumb {
                background: #ccc;
            }
        </style>
    @endpush
@endonce
