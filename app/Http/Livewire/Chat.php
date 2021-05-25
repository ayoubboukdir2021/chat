<?php

namespace App\Http\Livewire;

//use Illuminate\View\Component;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Chat extends Component
{
    public $messageText;

    public function render()
    {
        $messages = Message::with('users')->latest()->take(10)->get()->sortBy('id');
        return view('livewire.chat', ['messages'=>$messages]);
    }

    public function sendMessage()
    {
       if($this->messageText !=""){
        Message::create([
            'user_id' => auth()->user()->id,
            'messages_text' => $this->messageText,
        ]);
       }

        $this->reset('messageText');
    }
}
