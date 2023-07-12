@extends('crm.master')

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
                            <ol class="breadcrumb m-0 IRANYekanRegular">
                              
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-bell page-icon"></i>
                                {{ $notification->title }}
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            @include('crm.include.info')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <p class="text-justify IR" style="white-space: pre-line;">{!! $notification->message !!}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                     <h5 class="IR"> {{ $notification->created_at() }}</h5>
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
