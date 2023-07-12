@extends('layouts.master')

@section('content')
    @include('layouts.header',['title'=>'خدمات کلینیک لاوین','background'=>'/images/front/service-bg.jpg'])

    <div class="col-md-12 row mx-0 mt-4 py-4 px-xl-5">
        @foreach($pageServices as $index=>$service)
            <div class="col-12 col-sm-6 col-lg-3 px-2" data-aos-delay="0" data-aos="fade-up" data-aos-anchor-placement="top-center">
                @include('includes.elements.service-card', [ 'name' => $service->name,'desc'=>$service->desc,'details'=>$service->details,'image' =>$service->get_thumbnail('thumbnail')])
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mb-5">
        <div class="pagination border">
             {!! $pageServices->render() !!}
        </div>
    </div>
@stop
