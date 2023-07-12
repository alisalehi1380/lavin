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
                            <ol class="breadcrumb m-0 IR">
                            {{ Breadcrumbs::render('messages.show',$message) }}
                            </ol> 
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-envelope-square page-icon"></i>
                            {{ $message->fullname ?? 'ناشناس' }} 
                            {{$message->mobile??'' }}
                        </h4>
                    </div>
                </div>
            </div>
 
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <p class="text-justify IR" style="white-space: pre-line;">{{ $message->content }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                     <h5 class="IR"> {{ $message->created_at() }}</h5>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

<script type="text/javascript">

$(document).ready(function() {
    $('#table').DataTable( {
        "bPaginate": false,
        "bFilter": false,
        "lengthChange": false,
        "info": false
    } );
} );


</script>

 @endsection
