<?php

namespace App\Livewire;

use App\Events\sendMessage;
use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;
use Log;

class ChatBox extends Component
{
    public $messages;
    public $message;
    public function render()
    {
        return view('livewire.chat-box');
    }
    public function mount(){
        $this->messages = Message::all();
    }
    public function save(){
        $model = new Message();
        $model->message = $this->message; // Replace 'field_name' with your actual column name
        $model->save();
        // broadcast(new SendMessage())->toOthers();
        sendMessage::dispatch($this->message);
        Log::info('chatBox save');
        $this->reset('message');
    }

    #[On('echo:broadcastme,.sendMessage')]
    public function sendMessage($message){
        Log::info('chatBox sendMessage');
        $this->messages = Message::all();
    }
}

