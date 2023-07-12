<?php

namespace App\Http\Controllers\Admin;

use App\Enums\seenStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
   public function index()
   { 
      //اجازه دسترسی
      config(['auth.defaults.guard' => 'admin']);
      $this->authorize('messages.index');

      $messages = Message::orderBy('created_at','desc')->filter()->paginate(10);
      return view('admin.messages.all',compact('messages'));
   }

   public function show(Message $message)
   {
      //اجازه دسترسی
      config(['auth.defaults.guard' => 'admin']);
      $this->authorize('messages.show');
      
      $message->seen = seenStatus::seen;
      $message->save();
      return view('admin.messages.show',compact('message'));
   }
}
