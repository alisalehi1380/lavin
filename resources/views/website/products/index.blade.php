@extends('layouts.master')

@section('content')
    @include('layouts.header',['title'=>'فروشگاه کلینیک لاوین','background'=>'/images/front/service-bg.jpg'])

    <div class="row mx-0 mt-4 py-4">
        <aside class="col-12 col-md-3 d-none d-md-flex">
            @include('includes.product-filter', ['id' => 'bf'])
        </aside>
        <div class="col-12 col-md-9 row mx-0">
            <div class="col-12 d-block mb-5">
                <div class="col-12 rounded-0 p-2">
                    @if(request('name')!=null)
                        <a href="?name=&&category={{ request('category') }}&&sort={{ request('sort') }}">
                            <span class="badge bg-accent text-white font-weight-light rounded-0 p-2 mx-1 mb-2"><i class="fa fa-times-circle"></i>{{ request('name') }}</span>
                        </a>
                    @endif

                    @if(request('category')!=null)
                        <a href="?name={{ request('name') }} &&category=&&sort={{ request('sort') }}">
                    <span class="badge bg-accent text-white font-weight-light rounded-0 p-2 mx-1 mb-2"><i class="fa fa-times-circle"></i>
                        {{ App\Models\ProductCategory::find(request('category'))->name ?? ''  }}
                    </span>
                        </a>
                    @endif

                    @if(request('sort')!=null)
                        <a href="?name={{ request('name') }} &&category={{ request('category') }}&&sort=">
                    <span class="badge bg-accent text-white font-weight-light rounded-0 p-2 mx-1 mb-2"><i class="fa fa-times-circle"></i>
                        @switch(request('sort'))
                            @case(App\Enums\ProductSortType::Newests)
                            {{ "جدیدترین‌ها" }}
                            @break
                            @case(App\Enums\ProductSortType::Cheapests)
                            {{ "ارزانترین ها" }}
                            @break
                            @case(App\Enums\ProductSortType::MostExpinsives)
                            {{ "گرانترین ها" }}
                            @break
                        @endswitch
                    </span>
                        </a>
                    @endif
                </div>
            </div>
            @foreach($products as $product)
                <div class="col-12 col-md-3 px-2 mb-3" >
                    @include('includes.elements.product-card',
                        [
                        'thumbnail' => $product->get_thumbnail('medium'),
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'specialPrice' => $product->specialPrice,
                        'special' => $product->special,
                        'specialDateTime' => $product->specialDateTime,
                        'secondImage' => $product->images,
                        ])
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center mb-5">
        <div class="pagination border">
            {!! $products->render() !!}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="filter-product" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog m-0" role="document">
            <div class="modal-content border-0 rounded-0">
                <div class="modal-body">
                    @include('includes.product-filter', ['id' => 'mf'])
                </div>
            </div>
        </div>
    </div>
    <a href="#filter-product" data-toggle="modal" class="ui-to-top fa fa-sort-amount-down active d-md-none" style="right: unset;left: 15px;"></a>
@stop
