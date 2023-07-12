<?php

namespace App\Http\Controllers\Website\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\Provider;
use App\Models\Club;
use App\Models\User;
use App\Models\Admin;
use App\Models\Department;
use App\Enums\TicketStatus;
use App\Enums\TicketPriority;
use Auth;
use Response;
use App\Services\FunctionService;


class TicketController extends Controller
{
    private $fuctionService;
    public function __construct()
    {
        $this->fuctionService = new FunctionService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $tickets = Ticket::with('department')->where('user_id',Auth::id())->paginate(10);
        return  view('crm.ticket.all',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::orderby('name','asc')->get();
         return view('crm.ticket.create',compact('departments'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'title' => ['required', 'string', 'max:255'],
            'priority' => ['required'],
            'department' => ['required'],
            'content' => ['required','string'],
            'attach' => ['max:4096'],
        ],
        [
            'title.required'=> '* عنوان تیکت الزامی است.',
            'title.max'=> '* حداکثر طول مجاز عنوان تیکت 255 کارکتر می باشد.',
            'priority.required'=> '* انتخاب اولویت الزامی است.',
            'content.required'=> '* متن تیکت الزامی است.',
            'attach.max'=> '* حداکثر حجم فایل مجاز 4 مگابایت می باشد.',
        ]);
 

        if($request->priority == TicketPriority::Low || $request->priority == TicketPriority::Medium || $request->priority == TicketPriority::High)
       {
            //ایجاد شماره تیکت
            $number = Ticket::max("number");
            $number==null?$number=1000:++$number;
            
            $ticket = Ticket::create([
                'department_id' => $request->department,
                'user_id'=>Auth::id(),
                'number'=>$number,
                'title'=>$request->title,
                'priority'=>$request->priority,
            ]);

            if($request->file('attach'))
            {
                $attach = $this->fuctionService->uploadFile($request->file('attach'));
            }
            else
            {
                $attach = null;
            }

            TicketMessage::create([
                'ticket_id' => $ticket->id,
                'content' => $request->content,
                'attach' => $attach,
                'sender_type'=>'App\Models\User',
                'sender_id' => Auth::id()
            ]);

            toastr()->success('تیکت شما ارسال شد.');
       }

        return redirect(route('website.account.tickets.index'));
        
    }


    public function ticketmessage(Ticket $ticket,Request $request)
    {
        $this->validate($request,
        [
            'content' => ['required','string'],
            'attach' => ['max:4096'],
        ],
        [
            'content.required'=> '* متن تیکت الزامی است.',
            'attach.max'=> '* حداکثر حجم فایل مجاز 4 مگابایت می باشد.',
        ]);

        if($request->file('attach'))
        {
            $attach = $this->fuctionService->uploadFile($request->file('attach'));
        }
        else
        {
            $attach = null;
        }
        
        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'content' => $request->content,
            'attach' => $attach,
            'sender_type'=> 'App\Models\User',
            'sender_id' => Auth::id()
        ]);

        toastr()->success('تیکت شما ارسال شد.');

        return back();
    }

 
    public function show($id)
    {
        $ticket = Ticket::with('department','TicketMessage')->find($id);
        return view('crm.ticket.show',compact('ticket'));
    }
 
    public function edit(Ticket $ticket)
    {
      //  return view('admin.ticket.show',compact('ticket'));
    }
 
    public function update(Request $request,Ticket $ticket)
    {
        if($request->status==TicketStatus::Waiting
        || $request->status==TicketStatus::Pending
        || $request->status==TicketStatus::Answerd
        || $request->status==TicketStatus::Close
        )
        {
            if($request->priority==TicketPriority::Low
            || $request->priority==TicketPriority::Medium
            || $request->priority==TicketPriority::High
            )
            {
                $ticket->update([
                    "status" => $request->status,
                    "priority" => $request->priority,
                    "department_id" => $request->department
                ]);
                    
                toastr()->info('عملیات بروزرسانی با موفقیت انجام شد');

                return redirect(route('provider.tickets.index'));
            }
    
        }
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getaudience($id)
    {
        if($id == Part::Club)
        {
            $audience = Club::with('info')->get();
            $subcat["data"] = $audience->toArray();
            return Response::json($subcat);
        }
        else if($id == Part::Admin)
        {
            $audience = Admin::all();
            $subcat["data"] = $audience->toArray();
            return Response::json($subcat);
        }
    }
}
