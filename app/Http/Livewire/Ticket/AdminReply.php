<?php

namespace App\Http\Livewire\Ticket;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Jobs\SendEmail;
use App\Models\Reply;

class AdminReply extends Component
{
    use WithFileUploads;
    public $admin;
    public $message;
    public $val;
    public $settings;

    public function close(){
        $this->val->update([
            'status' => 1
        ]);
        dispatch(new SendEmail($this->val->user->email, $this->val->user->first_name . ' ' . $this->val->user->last_name, 'Ticket Closed:' . $this->val->ticket_id, 'This is to inform you that we have closed your ticket'));
        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', 'Ticked closed');
    }

    public function open(){
        $this->val->update([
            'status' => 0
        ]);
        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', 'Ticked opened');
    }

    public function reply(){
        $this->validate([
            'message' => ['required', 'string', 'max:255'],
        ]);

        Reply::create([
            'reply' => $this->message,
            'ticket_id' => $this->val->id,
            'status' => 1,
            'staff_id' => $this->admin->id,
            'user_id' => $this->val->user_id,
            'business_id' => $this->val->business_id,
        ]);

        dispatch(new SendEmail($this->val->user->email, $this->val->user->first_name . ' ' . $this->val->user->last_name, 'Ticket Reply:' . $this->val->ticket_id, 'Reply to your ticket ' . $this->val->ticket_id . '<br>' . $this->message));
        $this->reset(['message']);
        $this->emit('newChat');
    }

    public function render()
    {
        return view('livewire.ticket.admin-reply');
    }
}
