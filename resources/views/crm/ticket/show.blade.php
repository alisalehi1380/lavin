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
                            <ol class="breadcrumb m-0">


                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-ticket-alt page-icon"></i>
                             نمایش تیکت
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="container-fluid">
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <h5 class="IRANYekanRegular">شماره تیکت: {{ $ticket->number }} </h5>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="IRANYekanRegular"> عنوان: {{ $ticket->title }} </h5>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="IRANYekanRegular">واحد: {{ $ticket->department->name }}</h5>
                                </div>

                                <div class="col-md-6">اولویت:
                                    @if($ticket->priority == App\Enums\TicketPriority::Low)
                                    <span class="badge badge-danger IR p-1">کم</span>
                                    @elseif($ticket->priority == App\Enums\TicketPriority::Medium)
                                    <span class="badge badge-info IR p-1">متوسط</span>
                                    @elseif($ticket->priority == App\Enums\TicketPriority::High)
                                    <span class="badge badge-primary IR p-1">زیاد</span>
                                    @endif
                                </div>

                                <div class="col-md-6 mt-2">
                                    @if($ticket->status == App\Enums\TicketStatus::Waiting)
                                    <span class="badge badge-warning IR p-1">در انتظار پاسخ</span>
                                    @elseif($ticket->status == App\Enums\TicketStatus::Pending)
                                    <span class="badge badge-info IR p-1">درحال بررسی</span>
                                    @elseif($ticket->status == App\Enums\TicketStatus::Answerd)
                                    <span class="badge badge-primary IR p-1">پاسخ داده شده</span>
                                    @elseif($ticket->status == App\Enums\TicketStatus::Close)
                                    <span class="badge badge-danger IR p-1">بسته شده</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="container-fluid">

                            <div class="row">
                                    <div class="col-12">
                                        <div class="timeline" dir="ltr">

                                        @foreach($ticket->TicketMessage as $message)

                                            @if($message->sender_type ==  "App\Models\Admin")
                                            <article class="timeline-item timeline-item-left">
                                                <div class="timeline-desk">
                                                    <div class="timeline-box">
                                                        <span class="arrow-alt"></span>
                                                        <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                                        <img class="rounded-circle" src="{{ Gravatar::get( $ticket->user->email()) }}" alt="{{ $ticket->user->firstname.' '.$ticket->user->lastname }}" title="{{ $ticket->user->firstname.' '.$ticket->user->lastname }}" width="50px">
                                                        <p class="text-muted"><small class="IRANYekanRegular">{{  $message->date() }}</small></p>
                                                        <p class="mb-0 IR ticket-text">{{ $message->content }}</p>

                                                        @if($message->attach != null)
                                                        <hr>
                                                        <a href="{{ $message->attach }}" target="_blanck" rel="download" title="فایل ضمیمه" class="font-22">
                                                            <i class="fas fa-paperclip"></i>
                                                        </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </article>
                                            @elseIf($message->sender_type ==  "App\Models\User")
                                            <article class="timeline-item">
                                                <div class="timeline-desk">
                                                    <div class="timeline-box">
                                                        <span class="arrow"></span>

                                                        <img class="rounded-circle" src="{{ Gravatar::get( $ticket->user->email()) }}" alt="{{ $ticket->user->firstname.' '.$ticket->user->lastname }}" title="{{ $ticket->user->firstname.' '.$ticket->user->lastname }}" width="50px">

                                                        <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                                        <h4 class="mt-0 font-16 IRANYekanRegular">{{ $ticket->user->firstname.' '.$ticket->user->lastname }}</h4>
                                                        <p class="text-muted"><small class="IRANYekanRegular">{{  $message->date()  }}</small></p>
                                                        <p class="mb-0 IR ticket-text">{{ $message->content }}</p>

                                                        @if($message->attach != null)
                                                        <hr>
                                                        <a href="{{ $message->attach }}" target="_blanck" rel="download" title="فایل ضمیمه" class="font-22">
                                                            <i class="fas fa-paperclip"></i>
                                                        </a>
                                                        @endif
                                                    </div>

                                                </div>
                                            </article>
                                         @endif

                                    @endforeach

                                        </div>
                                        <!-- end timeline -->
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

                            </div> <!-- container -->

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                            <div class="container-fluid">

                                <form class="form-horizontal" action="{{ route('website.account.tickets.ticketmessage',$ticket) }}" method="post" enctype="multipart/form-data">
                                   {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-12 p-3">
                                            <label for="name" class="control-label IRANYekanRegular">متن</label>
                                            <textarea type="text" class="form-control input" name="content" id="content" placeholder="متن را وارد کنید">{{ old('content') }}</textarea>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('content') }} </span>
                                        </div>

                                        <div class="col-sm-12">

                                            <div class="fileupload btn btn-success waves-effect waves-light">
                                                <span><i class="mdi mdi-cloud-upload"></i>&nbsp;ضمیمه</span>
                                                <input type="file" class="upload" name="attach" value="{{ old('attach') }}">
                                            </div>
                                            &nbsp;&nbsp;
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('attach') }} </span>
                                        </div>

                                        <div class="col-sm-10 p-3">
                                            <input type="hidden" name="tecket_id" value="{{ $ticket->id }}">
                                            <button title="ارسال" type="submit" class="btn btn-primary">ارسال</button>
                                         </div>

                                         <div class="col-sm-2 p-3">
                                            <a  href="{{ route('website.account.tickets.index') }}" class="btn btn-light border border-secondary cursor-pointer" title="بازگشت">
                                                <i class="fas fa-undo fa-sm"></i>
                                                <span class="pr-2">بازگشت</span>
                                            </a>
                                        </div>

                                    </div>

                                </form>

                            </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
