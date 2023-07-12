@extends('crm.master')

@section('content')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                         
                                </ol>
                            </div>
                            <h4 class="page-title">داشبورد</h4>
                        </div>
                    </div>
                </div>     
                <!-- end page title --> 
                @include('crm.include.info')

                <div class="row mt-3">
                    <div class="clo-12 col-md-6">
                        <div class="card-box  bg-success">
                            <h4 class="mt-0 font-16 IRANYekanRegular text-light">امتیاز شما</h4>
                            <h2 class="text-primary my-3 text-center IR text-light"><span data-plugin="counterup">{{ number_format(Auth::user()->point) }}</span></h2>
                        </div>
                    </div>
               
                    <div class="clo-12 col-md-6">
                        <div class="card-box  bg-danger">
                            <h4 class="mt-0 font-16 IRANYekanRegular text-light">سطح شما</h4>
                            <h2 class="text-primary my-3 text-center IR text-light"><span>{{ Auth::user()->level->title }}</span></h2>
                        </div>
                    </div>

                </div>

            </div>
        </div> 
    </div>
@endsection

@section('script')

        <script type="text/javascript">
        $("#since").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#since",
            textFormat: "yyyy/MM/dd",
            isGregorian: false,
            modalMode: false,
            englishNumber: false,
            enableTimePicker: false,
            selectedDateToShow: new Date(),
            calendarViewOnChange: function(param1){
            console.log(param1);
            }
        });

        $("#until").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#until",
            textFormat: "yyyy/MM/dd",
            isGregorian: false,
            modalMode: false,
            englishNumber: false,
            enableTimePicker: false,
            selectedDateToShow: new Date(),
            calendarViewOnChange: function(param1){
            console.log(param1);
            }
        });
    </script>
@endsection    
