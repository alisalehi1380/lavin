<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\Admin;
use App\Models\Provider;
use App\Models\Department;
use App\Models\Club;
use App\Models\User;
use App\Enums\Part;
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

  
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('tickets.index');

        $tickets = Ticket::with('department')->orderby('status','asc')->orderby('created_at','desc')->filter()->paginate(10);
        $admins = Admin::with('roles')->orderBy('fullname','asc')->get();
        $departments = Department::orderBy('name','desc')->get();
        return  view('admin.ticket.all',compact('tickets','admins','departments'));
    }

    
    public function create()
    {
        abort(404);
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('tickets.create');

         return view('admin.ticket.create');
    }
 
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('tickets.create');
        
        $this->validate($request,
        [
            'name' => ['required', 'string', 'max:255'],
            'priority' => ['required'],
            'department' => ['required'],
            'audience_type' => ['required'],
            'audience_id' => ['required'],
            'content' => ['required','string'],
            'attach' => ['max:8192'],
        ],
        [
            'name.required'=> '* عنوان تیکت الزامی است.',
            'name.max'=> '* حداکثر طول مجاز عنوان تیکت 255 کارکتر می باشد.',
            'priority.required'=> '* انتخاب اولویت الزامی است.',
            'audience_type.required'=> '* انتخاب بخش الزامی است.',
            'audience_id.required'=> '* انتخاب مخاطب الزامی است.',
            'content.required'=> '* متن تیکت الزامی است.',
            'activity_id.required'=> '* انتخاب فعالیت الزامی است.',
            'attach.max'=> '* حداکثر حجم فایل مجاز 5 کیلوبایت می باشد.',
        ]);

        if($request->audience_type == Part::Provider)
        {
            $audience_type="App\Models\Provider";
        }
        else  if($request->audience_type == Part::Club)
        {
            $audience_type="App\Models\Club";
        }
        else  if($request->audience_type == Part::User)
        {
            $audience_type="App\Models\User";
        }

          //ایجاد فاکتور
          $number = Ticket::max("number");
          $number==null?$number=1000:++$number;

          
            $ticket = Ticket::create([
            'department_id' => $request->department,
            'number'=>$number,
            'title'=>$request->name,
            'sender_type'=>'App\Models\Admin',
            'sender_id' => Auth::guard('admin')->id(),
            'audience_type' => $audience_type,
            'audience_id' => $request->audience_id,
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
            'sender_type'=>'App\Models\Admin',
            'sender_id' => Auth::guard('admin')->id()
        ]);

        toastr()->success('تیکت شما ارسال شد.');

        return redirect(route('admin.tickets.index'));
        
    }


    public function ticketmessage(Ticket $ticket,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('tickets.reply');

        $this->validate($request,
        [
            'content' => ['required','string'],
            'attach' => ['max:8192'],
        ],
        [
            'content.required'=> '* متن تیکت الزامی است.',
            'attach.max'=> '* حداکثر حجم فایل مجاز 5 کیلوبایت می باشد.',
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
            'sender_type'=>'App\Models\Admin',
            'sender_id' => Auth::guard('admin')->id()
        ]);

        toastr()->success('تیکت شما ارسال شد.');

        return back();
    }
 
    public function show($id)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('tickets.show');

        $ticket = Ticket::with('department','TicketMessage')->find($id);
        return view('admin.ticket.show',compact('ticket'));
    }

  
    public function edit(Ticket $ticket)
    {
      //  return view('admin.ticket.show',compact('ticket'));
    }

     
    public function update(Request $request,Ticket $ticket)
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('tickets.changestatus');

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
                    'admin_id' => $request->admin,
                    "status" => $request->status,
                    "priority" => $request->priority,
                    "department_id" => $request->department
                ]);
                    
                toastr()->success('.عملیات بروزرسانی با موفقیت انجام شد');
 
                return redirect(route('admin.tickets.index'));
            }
    
        }
   
    }
 
    public function destroy($id)
    {
        //
    }
 
}
