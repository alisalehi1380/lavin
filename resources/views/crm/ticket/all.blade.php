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
                             تیکت ها
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                
                                <div class="col-4" >
                                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="collapseExample" title="فیلتر">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                </div>
                    

                                <div class="col-8 text-right" >
                                    <a href="{{ route('website.account.tickets.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus plusiconfont"></i>
                                        <b class="IRANYekanRegular">تیکت جدید</b>
                                    </a>
                                </div>

                            </div>

                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">
                                        <div class="row">
                                            <div class="form-group justify-content-center col-6">
                                                <label for="name" class="control-label IRANYekanRegular">عنوان تیکت</label>
                                                <input type="text"  class="form-control input" id="title-filter" name="title" placeholder="عنوان تیکت را وارد کنید" value="{{ request('title') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="number" class="control-label IRANYekanRegular">شماره تیکت</label>
                                                <input type="text"  class="form-control input" id="number-filter" name="number" placeholder="شماره تیکت را وارد کنید" value="{{ request('number') }}">
                                            </div>
 

                                            <div class="form-group justify-content-center col-4">
                                                <label for="priority" class="control-label IRANYekanRegular">اولویت</label>
                                                <select class="form-control dropdopwn"  name="priority" id="priority-filter"  @error('priority') is-invalid @enderror">
                                                    <option value="" > اولویت تیکت را انتخاب نمایید...</option>
                                                    <option value="{{ App\Enums\TicketPriority::Low }}" {{ App\Enums\TicketPriority::Low==request('priority')?'selected':'' }}>کم</option>
                                                    <option value="{{ App\Enums\TicketPriority::Medium }}" {{ App\Enums\TicketPriority::Medium==request('priority')?'selected':'' }}>متوسط</option>
                                                    <option value="{{ App\Enums\TicketPriority::High }}" {{ App\Enums\TicketPriority::High==request('priority')?'selected':'' }}>زیاد</option>
                                                </select>
                                            </div>

                                            <div class="form-group justify-content-center col-4">
                                                <label for="status" class="control-label IRANYekanRegular">وضعیت</label>
                                                <select class="form-control dropdopwn"  name="status" id="status-filter"  @error('status') is-invalid @enderror">
                                                    <option value="" > وضعیت تیکت را انتخاب نمایید...</option>
                                                    <option value="{{ App\Enums\TicketPriority::Low }}" {{ App\Enums\TicketStatus::Waiting==request('status')?'selected':'' }}>درانتظار پاسخ</option>
                                                    <option value="{{ App\Enums\TicketPriority::Medium }}" {{ App\Enums\TicketStatus::Pending==request('status')?'selected':'' }}>درحال بررسی</option>
                                                    <option value="{{ App\Enums\TicketPriority::High }}" {{ App\Enums\TicketStatus::Answerd==request('status')?'selected':'' }}>پاسخ داده شده</option>
                                                    <option value="{{ App\Enums\TicketPriority::High }}" {{ App\Enums\TicketStatus::Close==request('status')?'selected':'' }}>بسته شده</option>
                                                </select>
                                            </div>

                                            <div class="form-group justify-content-center col-4">
                                                <label for="department" class="control-label IRANYekanRegular">واحد</label>
                                                <select class="form-control dropdopwn"  name="department" id="department-filter"  @error('department') is-invalid @enderror">
                                                    <option value="" > واحد تیکت را انتخاب نمایید...</option>
                                                    @foreach(App\Models\Department::orderBy('name','desc')->get() as $department)
                                                    <option value="{{ $department->id }}" {{ $department->id==request('department')?'selected':'' }}>{{ $department->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </diV>
                                        <div class="form-group col-12 d-flex justify-content-center mt-3">

                                            <button type="submit" class="btn btn-info col-lg-2 offset-lg-4 cursor-pointer">
                                                <i class="fa fa-filter fa-sm"></i>
                                                <span class="pr-2">فیلتر</span>
                                            </button>

                                            <div class="col-lg-2">
                                                <a onclick="reset()" class="btn btn-light border border-secondary cursor-pointer">
                                                    <i class="fas fa-undo fa-sm"></i>
                                                    <span class="pr-2">پاک کردن</span>
                                                </a>
                                            </div>


                                            <script>
                                                function reset()
                                                {
                                                    document.getElementById("title-filter").value = "";
                                                    document.getElementById("number-filter").value = "";
                                                    document.getElementById("sender-filter").selectedIndex = "0";
                                                    document.getElementById("audience-filter").selectedIndex = "0";
                                                    document.getElementById("priority-filter").selectedIndex = "0";
                                                    document.getElementById("status-filter").selectedIndex = "0";
                                                    document.getElementById("department-filter").selectedIndex = "0";
                                                }
                                            </script>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">شماره تیکت</b></th>
                                            <th><b class="IRANYekanRegular">عنوان</b></th>
                                            <th><b class="IRANYekanRegular">واحد</b></th>
                                            <th><b class="IRANYekanRegular">اولویت</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($tickets as $index=>$ticket)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $ticket->number }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $ticket->title }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $ticket->department->name }}</strong></td>
                                            <td>
                                                @if($ticket->priority == App\Enums\TicketPriority::Low)
                                                <span class="badge badge-danger IR p-1">کم</span>
                                                @elseif($ticket->priority == App\Enums\TicketPriority::Medium)
                                                <span class="badge badge-info IR p-1">متوسط</span>
                                                @elseif($ticket->priority == App\Enums\TicketPriority::High)
                                                <span class="badge badge-primary IR p-1">زیاد</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($ticket->status == App\Enums\TicketStatus::Waiting)
                                                <span class="badge badge-warning IR p-1">در انتظار پاسخ</span>
                                                @elseif($ticket->status == App\Enums\TicketStatus::Pending)
                                                <span class="badge badge-info IR p-1">درحال بررسی</span>
                                                @elseif($ticket->status == App\Enums\TicketStatus::Answerd)
                                                <span class="badge badge-primary IR p-1">پاسخ داده شده</span>
                                                @elseif($ticket->status == App\Enums\TicketStatus::Close)
                                                <span class="badge badge-danger IR p-1">بسته شده</span>
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <a class="btn  btn-icon" href="{{ route('website.account.tickets.show', $ticket->id) }}" title="نمایش">
                                                    <i class="fas fa-eye text-primary font-22"></i>
                                                </a>

                                            </td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $tickets->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
